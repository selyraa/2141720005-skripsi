<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkup;
use App\Models\DietRecommendation;
use App\Models\LlmContext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DietRecommendationController extends Controller
{
    /**
     * Display a listing of the diet recommendations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        
        $recommendations = DietRecommendation::with(['checkup.programEnrollment.user', 'llmContext'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
        
        $perPageOptions = [5, 10, 20, 50, 100];
        
        return view('pages.dashboard.admin.diet-recommendations.index', compact('recommendations', 'perPage', 'perPageOptions'));
    }

    /**
     * Show the form for creating a new diet recommendation.
     *
     * @param  int  $checkupId
     * @return \Illuminate\Http\Response
     */
    public function create($checkupId)
    {
        $checkup = Checkup::with(['programEnrollment.user', 'programEnrollment.dietProgram'])->findOrFail($checkupId);
        $llmContexts = LlmContext::orderBy('title')->get();
        
        // Check if recommendation already exists for this checkup
        $existingRecommendation = DietRecommendation::where('checkup_id', $checkupId)->first();
        if ($existingRecommendation) {
            return redirect()->route('diet-recommendations.edit', $existingRecommendation->id)
                ->with('info', 'A diet recommendation already exists for this checkup. You can edit it here.');
        }
        
        return view('pages.dashboard.admin.diet-recommendations.create', compact('checkup', 'llmContexts'));
    }

    /**
     * Store a newly created diet recommendation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'checkup_id' => 'required|exists:checkups,id',
            'llm_context_id' => 'required|exists:llm_contexts,id',
            'custom_prompt' => 'nullable|string',
        ]);
        
        // Get the checkup and LLM context data
        $checkup = Checkup::with(['programEnrollment.user', 'programEnrollment.dietProgram'])->findOrFail($validated['checkup_id']);
        $llmContext = LlmContext::findOrFail($validated['llm_context_id']);
        
        // Create prompt by replacing placeholders in the context
        $prompt = $llmContext->context;
        
        // Replace placeholders with actual data
        $prompt = str_replace('{tinggi_badan}', $checkup->height, $prompt);
        $prompt = str_replace('{berat_badan}', $checkup->weight, $prompt);
        $prompt = str_replace('{lemak_tubuh}', $checkup->body_fat, $prompt);
        $prompt = str_replace('{lemak_perut}', $checkup->belly_fat, $prompt);
        $prompt = str_replace('{massa_otot}', $checkup->muscle_mass, $prompt);
        $prompt = str_replace('{kebutuhan_kalori}', $checkup->calories_needs, $prompt);
        $prompt = str_replace('{usia_sel}', $checkup->cell_age, $prompt);
        $prompt = str_replace('{kepadatan_tulang}', $checkup->bone_density, $prompt);
        $prompt = str_replace('{kadar_air}', $checkup->water_content, $prompt);
        
        // Add program diet information if available
        $programDiet = $checkup->programEnrollment->dietProgram->name ?? 'Tidak tersedia';
        $prompt = str_replace('{program_diet}', $programDiet, $prompt);
        
        // Add user information if available
        $userData = '';
        if ($checkup->programEnrollment && $checkup->programEnrollment->user) {
            $user = $checkup->programEnrollment->user;
            $userData .= "Nama: " . $user->name . "\n";
            $userData .= "Jenis Kelamin: " . ($user->gender ?? 'Tidak tersedia') . "\n";
            $userData .= "Umur: " . ($user->birth_date ? now()->diffInYears($user->birth_date) . ' tahun' : 'Tidak tersedia') . "\n";
        }
        $prompt = str_replace('{user_data}', $userData, $prompt);
        
        // Add custom prompt if provided
        if (!empty($validated['custom_prompt'])) {
            $prompt .= "\n\nTambahan: " . $validated['custom_prompt'];
        }
        
        // Call Google Gemini API
        try {
            $geminiApiKey = config('services.gemini.api_key');
            $geminiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-lite:generateContent?key=" . $geminiApiKey;
            
            $response = Http::post($geminiUrl, [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $prompt
                            ]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 2048,
                ]
            ]);
            
            if ($response->successful()) {
                $result = $response->json();
                $generatedText = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'No result generated.';
                
                // Create the diet recommendation
                $recommendation = DietRecommendation::create([
                    'checkup_id' => $validated['checkup_id'],
                    'llm_context_id' => $validated['llm_context_id'],
                    'prompt' => $prompt,
                    'result' => $generatedText,
                ]);
                
                return redirect()->route('diet-recommendations.show', $recommendation->id)
                    ->with('success', 'Diet recommendation generated successfully!');
            } else {
                Log::error('Gemini API error: ' . $response->body());
                return back()->with('error', 'Failed to generate recommendation from Gemini API. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Error calling Gemini API: ' . $e->getMessage());
            return back()->with('error', 'Error generating recommendation: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified diet recommendation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recommendation = DietRecommendation::with(['checkup.programEnrollment.user', 'llmContext'])
            ->findOrFail($id);
        
        return view('pages.dashboard.admin.diet-recommendations.show', compact('recommendation'));
    }

    /**
     * Show the form for editing the specified diet recommendation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recommendation = DietRecommendation::with(['checkup.programEnrollment.user', 'llmContext'])
            ->findOrFail($id);
        $llmContexts = LlmContext::orderBy('title')->get();
        
        return view('pages.dashboard.admin.diet-recommendations.edit', compact('recommendation', 'llmContexts'));
    }

    /**
     * Update the specified diet recommendation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'llm_context_id' => 'required|exists:llm_contexts,id',
            'custom_prompt' => 'nullable|string',
        ]);
        
        $recommendation = DietRecommendation::findOrFail($id);
        $checkup = Checkup::with(['programEnrollment.user', 'programEnrollment.dietProgram'])
            ->findOrFail($recommendation->checkup_id);
        $llmContext = LlmContext::findOrFail($validated['llm_context_id']);
        
        // Create prompt by replacing placeholders in the context
        $prompt = $llmContext->context;
        
        // Replace placeholders with actual data
        $prompt = str_replace('{tinggi_badan}', $checkup->height, $prompt);
        $prompt = str_replace('{berat_badan}', $checkup->weight, $prompt);
        $prompt = str_replace('{lemak_tubuh}', $checkup->body_fat, $prompt);
        $prompt = str_replace('{lemak_perut}', $checkup->belly_fat, $prompt);
        $prompt = str_replace('{massa_otot}', $checkup->muscle_mass, $prompt);
        $prompt = str_replace('{kebutuhan_kalori}', $checkup->calories_needs, $prompt);
        $prompt = str_replace('{usia_sel}', $checkup->cell_age, $prompt);
        $prompt = str_replace('{kepadatan_tulang}', $checkup->bone_density, $prompt);
        $prompt = str_replace('{kadar_air}', $checkup->water_content, $prompt);
        
        // Add program diet information if available
        $programDiet = $checkup->programEnrollment->dietProgram->name ?? 'Tidak tersedia';
        $prompt = str_replace('{program_diet}', $programDiet, $prompt);
        
        // Add user information if available
        $userData = '';
        if ($checkup->programEnrollment && $checkup->programEnrollment->user) {
            $user = $checkup->programEnrollment->user;
            $userData .= "Nama: " . $user->name . "\n";
            $userData .= "Jenis Kelamin: " . ($user->gender ?? 'Tidak tersedia') . "\n";
            $userData .= "Umur: " . ($user->birth_date ? now()->diffInYears($user->birth_date) . ' tahun' : 'Tidak tersedia') . "\n";
        }
        $prompt = str_replace('{user_data}', $userData, $prompt);
        
        // Add custom prompt if provided
        if (!empty($validated['custom_prompt'])) {
            $prompt .= "\n\nTambahan: " . $validated['custom_prompt'];
        }
        
        // Call Google Gemini API
        try {
            $geminiApiKey = config('services.gemini.api_key');
            $geminiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-lite:generateContent?key=" . $geminiApiKey;
            
            $response = Http::post($geminiUrl, [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $prompt
                            ]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 2048,
                ]
            ]);
            
            if ($response->successful()) {
                $result = $response->json();
                $generatedText = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'No result generated.';
                
                // Update the diet recommendation
                $recommendation->update([
                    'llm_context_id' => $validated['llm_context_id'],
                    'prompt' => $prompt,
                    'result' => $generatedText,
                ]);
                
                return redirect()->route('diet-recommendations.show', $recommendation->id)
                    ->with('success', 'Diet recommendation updated successfully!');
            } else {
                Log::error('Gemini API error: ' . $response->body());
                return back()->with('error', 'Failed to generate recommendation from Gemini API. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Error calling Gemini API: ' . $e->getMessage());
            return back()->with('error', 'Error generating recommendation: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified diet recommendation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recommendation = DietRecommendation::findOrFail($id);
        $recommendation->delete();
        
        return redirect()->route('diet-recommendations.index')
            ->with('success', 'Diet recommendation deleted successfully!');
    }
}

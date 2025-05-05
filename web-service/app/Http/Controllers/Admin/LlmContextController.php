<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LlmContext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LlmContextController extends Controller
{
    /**
     * Display a listing of the llm contexts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        
        $llmContexts = LlmContext::orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
        
        $perPageOptions = [5, 10, 20, 50, 100];
        
        return view('pages.dashboard.admin.llm-contexts.index', compact('llmContexts', 'perPage', 'perPageOptions'));
    }

    /**
     * Show the form for creating a new llm context.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Define available placeholders for the context
        $placeholders = [
            'User data' => '{user_data}',
            'Tinggi badan' => '{tinggi_badan}',
            'Berat badan' => '{berat_badan}',
            'Lemak tubuh' => '{lemak_tubuh}',
            'Lemak perut' => '{lemak_perut}',
            'Massa otot' => '{massa_otot}',
            'Kebutuhan kalori' => '{kebutuhan_kalori}',
            'Usia sel' => '{usia_sel}',
            'Kepadatan tulang' => '{kepadatan_tulang}',
            'Kadar air' => '{kadar_air}',
            'Program diet' => '{program_diet}',
            'Is_halal' => '{is_halal}',
            'Negara' => '{negara}'
        ];
        
        return view('pages.dashboard.admin.llm-contexts.create', compact('placeholders'));
    }

    /**
     * Store a newly created llm context in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'context' => 'required|string',
        ]);
        
        LlmContext::create($validated);
        
        return redirect()->route('llm-contexts.index')
            ->with('success', 'LLM Context created successfully.');
    }

    /**
     * Display the specified llm context.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $llmContext = LlmContext::findOrFail($id);
        
        return view('pages.dashboard.admin.llm-contexts.show', compact('llmContext'));
    }

    /**
     * Show the form for editing the specified llm context.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $llmContext = LlmContext::findOrFail($id);
        
        // Define available placeholders for the context
        $placeholders = [
            'User data' => '{user_data}',
            'Tinggi badan' => '{tinggi_badan}',
            'Berat badan' => '{berat_badan}',
            'Lemak tubuh' => '{lemak_tubuh}',
            'Lemak perut' => '{lemak_perut}',
            'Massa otot' => '{massa_otot}',
            'Kebutuhan kalori' => '{kebutuhan_kalori}',
            'Usia sel' => '{usia_sel}',
            'Kepadatan tulang' => '{kepadatan_tulang}',
            'Kadar air' => '{kadar_air}',
            'Program diet' => '{program_diet}',
            'Is_halal' => '{is_halal}',
            'Negara' => '{negara}'
        ];
        
        return view('pages.dashboard.admin.llm-contexts.edit', compact('llmContext', 'placeholders'));
    }

    /**
     * Update the specified llm context in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $llmContext = LlmContext::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'context' => 'required|string',
        ]);
        
        $llmContext->update($validated);
        
        return redirect()->route('llm-contexts.index')
            ->with('success', 'LLM Context updated successfully.');
    }

    /**
     * Remove the specified llm context from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $llmContext = LlmContext::findOrFail($id);
        
        // Check if this context is being used
        if ($llmContext->dietRecommendations()->count() > 0) {
            return redirect()->route('llm-contexts.index')
                ->with('error', 'This LLM Context is being used by diet recommendations and cannot be deleted.');
        }
        
        $llmContext->delete();
        
        return redirect()->route('llm-contexts.index')
            ->with('success', 'LLM Context deleted successfully.');
    }
}
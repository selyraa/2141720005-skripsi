<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\DietPrediction;
use App\Models\DietProgram;
use App\Models\PredictionResult;
use App\Models\ProgramEnrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class PredictionController extends Controller
{
    public function index()
    {
        // If there's prediction data in session, pass it to the view
        $predictionData = session('prediction_data') ?? null;
        return view('pages.dashboard.admin.predictions.index', compact('predictionData'));
    }

    public function predict(Request $request)
    {
        $request->validate([
            'age' => 'required|numeric|min:1|max:120',
            'height' => 'required|numeric|min:100|max:250',
            'weight' => 'required|numeric|min:30|max:200',
            'bodyFat' => 'required|numeric|min:0|max:100',
            'bellyFat' => 'required|numeric|min:0|max:100',
            'muscleMass' => 'required|numeric|min:0|max:100',
            'calorieNeeds' => 'required|numeric|min:500|max:5000',
            'cellAge' => 'required|numeric|min:1|max:120',
            'boneDensity' => 'required|numeric|min:0|max:100',
            'waterContent' => 'required|numeric|min:0|max:100',
        ], [
            'age.required' => 'Umur harus diisi',
            'age.numeric' => 'Umur harus berupa angka',
            'age.min' => 'Umur minimal 1 tahun',
            'age.max' => 'Umur maksimal 120 tahun',

            'height.required' => 'Tinggi badan harus diisi',
            'height.numeric' => 'Tinggi badan harus berupa angka',
            'height.min' => 'Tinggi badan minimal 100 cm',
            'height.max' => 'Tinggi badan maksimal 250 cm',

            'weight.required' => 'Berat badan harus diisi',
            'weight.numeric' => 'Berat badan harus berupa angka',
            'weight.min' => 'Berat badan minimal 30 kg',
            'weight.max' => 'Berat badan maksimal 200 kg',

            'bodyFat.required' => 'Lemak tubuh harus diisi',
            'bodyFat.numeric' => 'Lemak tubuh harus berupa angka',
            'bodyFat.min' => 'Lemak tubuh minimal 0%',
            'bodyFat.max' => 'Lemak tubuh maksimal 100%',

            'bellyFat.required' => 'Lemak perut harus diisi',
            'bellyFat.numeric' => 'Lemak perut harus berupa angka',
            'bellyFat.min' => 'Lemak perut minimal 0%',
            'bellyFat.max' => 'Lemak perut maksimal 100%',

            'muscleMass.required' => 'Massa otot harus diisi',
            'muscleMass.numeric' => 'Massa otot harus berupa angka',
            'muscleMass.min' => 'Massa otot minimal 0 kg',
            'muscleMass.max' => 'Massa otot maksimal 100 kg',

            'calorieNeeds.required' => 'Kebutuhan kalori harus diisi',
            'calorieNeeds.numeric' => 'Kebutuhan kalori harus berupa angka',
            'calorieNeeds.min' => 'Kebutuhan kalori minimal 500 kkal',
            'calorieNeeds.max' => 'Kebutuhan kalori maksimal 5000 kkal',

            'cellAge.required' => 'Usia sel harus diisi',
            'cellAge.numeric' => 'Usia sel harus berupa angka',
            'cellAge.min' => 'Usia sel minimal 1 tahun',
            'cellAge.max' => 'Usia sel maksimal 120 tahun',

            'boneDensity.required' => 'Kepadatan tulang harus diisi',
            'boneDensity.numeric' => 'Kepadatan tulang harus berupa angka',
            'boneDensity.min' => 'Kepadatan tulang minimal 0',
            'boneDensity.max' => 'Kepadatan tulang maksimal 100',

            'waterContent.required' => 'Kadar air harus diisi',
            'waterContent.numeric' => 'Kadar air harus berupa angka',
            'waterContent.min' => 'Kadar air minimal 0%',
            'waterContent.max' => 'Kadar air maksimal 100%',
        ]);

        try {
            $predictionUrl = config('app.prediction_url');

            $response = Http::post($predictionUrl . "/predict", [
                'age' => (float) $request->age,
                'height' => (float) $request->height,
                'weight' => (float) $request->weight,
                'bodyFat' => (float) $request->bodyFat,
                'bellyFat' => (float) $request->bellyFat,
                'muscleMass' => (float) $request->muscleMass,
                'calorieNeeds' => (float) $request->calorieNeeds,
                'cellAge' => (float) $request->cellAge,
                'boneDensity' => (float) $request->boneDensity,
                'waterContent' => (float) $request->waterContent,
            ]);

            if ($response->successful() && $response->json('status') === 'success') {
                // Store prediction data and results in the session (not as flash data)
                session([
                    'prediction_data' => [
                        'age' => (float) $request->age,
                        'height' => (float) $request->height,
                        'weight' => (float) $request->weight,
                        'bodyFat' => (float) $request->bodyFat,
                        'bellyFat' => (float) $request->bellyFat,
                        'muscleMass' => (float) $request->muscleMass,
                        'calorieNeeds' => (float) $request->calorieNeeds,
                        'cellAge' => (float) $request->cellAge,
                        'boneDensity' => (float) $request->boneDensity,
                        'waterContent' => (float) $request->waterContent,
                    ],
                    'result' => $response->json('result')
                ]);
                
                return redirect()->route('predictions.result');
            }

            return back()->with('error', 'Failed to get prediction from server');
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to prediction server: ' . $e->getMessage());
        }
    }

    public function result()
    {
        if (!session()->has('result')) {
            return redirect()->route('predictions.index')->with('error', 'Tidak ada data prediksi yang tersedia');
        }

        // Get users with role 'user' for the dropdown selection
        $users = User::all();

        return view('pages.dashboard.admin.predictions.result', compact('users'));
    }
    
    public function saveResult(Request $request)
    {
        if (!session()->has('result') || !session()->has('prediction_data')) {
            return redirect()->route('predictions.index')->with('error', 'Tidak ada data prediksi yang tersedia');
        }
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'decision' => 'required|in:agree,change',
            'prediction' => 'required|string',
            'alternative_program' => 'required_if:decision,change|string',
        ], [
            'user_id.required' => 'Pelanggan harus dipilih',
            'user_id.exists' => 'Pelanggan tidak valid'
        ]);
        
        $predictionData = session('prediction_data');
        $predictionResult = session('result');
        
        // Determine selected program based on user decision
        $selectedProgram = $request->decision === 'agree' 
            ? $request->prediction 
            : $request->alternative_program;
            
        // 1. First, create the checkup record without program enrollment id
        $checkup = Checkup::create([
            'program_enrollment_id' => null, // Initially empty as required
            'checkup_date' => now(),
            'height' => $predictionData['height'],
            'weight' => $predictionData['weight'],
            'body_fat' => $predictionData['bodyFat'],
            'belly_fat' => $predictionData['bellyFat'],
            'bone_density' => $predictionData['boneDensity'],
            'calories_needs' => $predictionData['calorieNeeds'],
            'cell_age' => $predictionData['cellAge'],
            'muscle_mass' => $predictionData['muscleMass'],
            'water_content' => $predictionData['waterContent'],
        ]);
        
        // 2. Create diet prediction record linked to the checkup
        $dietPrediction = DietPrediction::create([
            'checkup_id' => $checkup->id,
            'prediction_date' => now(),
        ]);
        
        // Find or create diet program records and save prediction results
        $selectedDietProgramId = null;
        
        foreach ($predictionResult['probabilities'] as $programName => $probability) {
            // Find or create the diet program
            $dietProgram = DietProgram::firstOrCreate(['name' => $programName]);
            
            // Store selected program ID for later use
            if ($programName === $selectedProgram) {
                $selectedDietProgramId = $dietProgram->id;
            }
            
            // Create prediction result with confidence score
            PredictionResult::create([
                'diet_prediction_id' => $dietPrediction->id,
                'diet_program_id' => $dietProgram->id,
                'confidence_score' => $probability,
                'is_selected' => ($programName === $selectedProgram), // Mark only the selected program as true
            ]);
        }
        
        // 3. Create program enrollment with the selected diet program
        $programEnrollment = ProgramEnrollment::create([
            'user_id' => $request->user_id, // Use selected user instead of authenticated user
            'diet_program_id' => $selectedDietProgramId,
            'status' => 0, // 0 = on going
        ]);
        
        // 4. Update the checkup with the program enrollment ID
        $checkup->update([
            'program_enrollment_id' => $programEnrollment->id
        ]);
        
        // Clear the session data
        session()->forget(['result', 'prediction_data']);
        
        // Redirect to enrollments.index with success message
        return redirect()->route('enrollments.index')->with('success', 'Program diet berhasil disimpan');
    }
}

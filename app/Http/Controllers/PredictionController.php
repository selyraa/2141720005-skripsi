<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PredictionController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.admin.predictions.index');
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
            $response = Http::post('http://localhost:5001/predict', [
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

            // return response()->json($response->json());

            if ($response->successful() && $response->json('status') === 'success') {
                return redirect()
                    ->route('predictions.result')
                    ->with('result', $response->json('result'));
            }

            return response()->json(["error" => "Failed to get prediction from server"]);

            return back()->with('error', 'Failed to get prediction from server');
        } catch (\Exception $e) {
            return back()->with('error', 'Error connecting to prediction server: ' . $e->getMessage());
        }
    }

    public function result()
    {
        if (!session()->has('result')) {
            return redirect()->route('predictions.index');
        }
        
        return view('pages.dashboard.admin.predictions.result');
    }
}

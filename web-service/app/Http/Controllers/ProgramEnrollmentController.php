<?php

namespace App\Http\Controllers;

use App\Casts\ProgramEnrollmentStatusCast;
use App\Models\Checkup;
use App\Models\DietPrediction;
use App\Models\DietProgram;
use App\Models\PredictionResult;
use App\Models\ProgramEnrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ProgramEnrollmentController extends Controller
{
    /**
     * Display a listing of program enrollments
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        
        $enrollments = ProgramEnrollment::with(['user', 'dietProgram', 'checkup'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
        
        $perPageOptions = [5, 10, 20, 50, 100];
        
        return view('pages.dashboard.admin.enrollments.index', compact('enrollments', 'perPage', 'perPageOptions'));
    }

    /**
     * Show the form for creating a new program enrollment
     */
    public function create()
    {
        $users = User::all();

        $dietPrograms = DietProgram::all();
        
        return view('pages.dashboard.admin.enrollments.create', compact('users', 'dietPrograms'));
    }

    /**
     * Store a newly created program enrollment
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'diet_program_id' => 'required|exists:diet_programs,id',
            'status' => 'required|integer|in:0,1,2,3',
            // Checkup data
            'height' => 'required|numeric|min:100|max:250',
            'weight' => 'required|numeric|min:30|max:200',
            'body_fat' => 'required|numeric|min:0|max:100',
            'belly_fat' => 'required|numeric|min:0|max:100',
            'bone_density' => 'required|numeric|min:0|max:100',
            'calories_needs' => 'required|numeric|min:500|max:5000',
            'cell_age' => 'required|numeric|min:1|max:120',
            'muscle_mass' => 'required|numeric|min:0|max:100',
            'water_content' => 'required|numeric|min:0|max:100',
        ], [
            'user_id.required' => 'Pengguna harus dipilih',
            'user_id.exists' => 'Pengguna tidak valid',
            'diet_program_id.required' => 'Program diet harus dipilih',
            'diet_program_id.exists' => 'Program diet tidak valid',
            'status.required' => 'Status harus dipilih',
            'status.integer' => 'Status harus berupa angka',
            'status.in' => 'Status yang dipilih tidak valid',
            'height.required' => 'Tinggi badan harus diisi',
            'height.numeric' => 'Tinggi badan harus berupa angka',
            'height.min' => 'Tinggi badan minimal 100 cm',
            'height.max' => 'Tinggi badan maksimal 250 cm',
            'weight.required' => 'Berat badan harus diisi',
            'weight.numeric' => 'Berat badan harus berupa angka',
            'weight.min' => 'Berat badan minimal 30 kg',
            'weight.max' => 'Berat badan maksimal 200 kg',
            'body_fat.required' => 'Lemak tubuh harus diisi',
            'body_fat.numeric' => 'Lemak tubuh harus berupa angka',
            'body_fat.min' => 'Lemak tubuh minimal 0%',
            'body_fat.max' => 'Lemak tubuh maksimal 100%',
            'belly_fat.required' => 'Lemak perut harus diisi',
            'belly_fat.numeric' => 'Lemak perut harus berupa angka',
            'belly_fat.min' => 'Lemak perut minimal 0%',
            'belly_fat.max' => 'Lemak perut maksimal 100%',
            'bone_density.required' => 'Kepadatan tulang harus diisi',
            'bone_density.numeric' => 'Kepadatan tulang harus berupa angka',
            'bone_density.min' => 'Kepadatan tulang minimal 0',
            'bone_density.max' => 'Kepadatan tulang maksimal 100',
            'calories_needs.required' => 'Kebutuhan kalori harus diisi',
            'calories_needs.numeric' => 'Kebutuhan kalori harus berupa angka',
            'calories_needs.min' => 'Kebutuhan kalori minimal 500 kkal',
            'calories_needs.max' => 'Kebutuhan kalori maksimal 5000 kkal',
            'cell_age.required' => 'Usia sel harus diisi',
            'cell_age.numeric' => 'Usia sel harus berupa angka',
            'cell_age.min' => 'Usia sel minimal 1 tahun',
            'cell_age.max' => 'Usia sel maksimal 120 tahun',
            'muscle_mass.required' => 'Massa otot harus diisi',
            'muscle_mass.numeric' => 'Massa otot harus berupa angka',
            'muscle_mass.min' => 'Massa otot minimal 0 kg',
            'muscle_mass.max' => 'Massa otot maksimal 100 kg',
            'water_content.required' => 'Kadar air harus diisi',
            'water_content.numeric' => 'Kadar air harus berupa angka',
            'water_content.min' => 'Kadar air minimal 0%',
            'water_content.max' => 'Kadar air maksimal 100%',
        ]);

        // Create program enrollment
        $programEnrollment = ProgramEnrollment::create([
            'user_id' => $validatedData['user_id'],
            'diet_program_id' => $validatedData['diet_program_id'],
            'status' => $validatedData['status'],
        ]);

        // Create checkup record
        $checkup = Checkup::create([
            'program_enrollment_id' => $programEnrollment->id,
            'checkup_date' => now(),
            'height' => $validatedData['height'],
            'weight' => $validatedData['weight'],
            'body_fat' => $validatedData['body_fat'],
            'belly_fat' => $validatedData['belly_fat'],
            'bone_density' => $validatedData['bone_density'],
            'calories_needs' => $validatedData['calories_needs'],
            'cell_age' => $validatedData['cell_age'],
            'muscle_mass' => $validatedData['muscle_mass'],
            'water_content' => $validatedData['water_content'],
        ]);
        
        // Create diet prediction record
        $dietPrediction = DietPrediction::create([
            'checkup_id' => $checkup->id,
            'prediction_date' => now(),
        ]);
        
        // Create prediction result for the selected program with 100% confidence
        PredictionResult::create([
            'diet_prediction_id' => $dietPrediction->id,
            'diet_program_id' => $validatedData['diet_program_id'],
            'confidence_score' => 1.0,
            'is_selected' => true,
        ]);

        return redirect()->route('enrollments.index')
            ->with('success', __('app.program_enrollment_created_successfully'));
    }

    /**
     * Display the specified program enrollment
     */
    public function show($id)
    {
        $enrollment = ProgramEnrollment::with(['user', 'dietProgram', 'checkup', 'checkup.dietPrediction', 'checkup.dietPrediction.predictionResults'])
            ->findOrFail($id);
        
        return view('pages.dashboard.admin.enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified program enrollment
     */
    public function edit($id)
    {
        $enrollment = ProgramEnrollment::with(['user', 'dietProgram', 'checkup'])->findOrFail($id);
        $users = User::whereHas('role', function($query) {
            $query->where('name', 'user');
        })->get();
        $dietPrograms = DietProgram::all();
        
        return view('pages.dashboard.admin.enrollments.edit', compact('enrollment', 'users', 'dietPrograms'));
    }

    /**
     * Update the specified program enrollment
     */
    public function update(Request $request, $id)
    {
        $enrollment = ProgramEnrollment::findOrFail($id);

        $validatedData = $request->validate([
            'diet_program_id' => 'required|exists:diet_programs,id',
            'status' => 'required|in:0,1,2,3',
        ], [
            'diet_program_id.required' => 'Program diet harus dipilih',
            'diet_program_id.exists' => 'Program diet tidak valid',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status yang dipilih tidak valid',
        ]);

        $statusCast = new ProgramEnrollmentStatusCast();
        $statuses = $statusCast->getStatuses();
        
        $status = $validatedData['status'];
        if (is_numeric($status)) {
            $status = (int) $status;
        }
        else if (is_string($status) && in_array($status, $statuses)) {
            $status = array_search($status, $statuses);
        }
        
        $enrollment->update([
            'diet_program_id' => $validatedData['diet_program_id'],
            'status' => $status,
        ]);

        // If program changed, update the prediction results
        if ($enrollment->wasChanged('diet_program_id')) {
            $latestCheckup = $enrollment->checkup()->latest()->first();
            if ($latestCheckup && $latestCheckup->dietPrediction) {
                PredictionResult::where('diet_prediction_id', $latestCheckup->dietPrediction->id)
                    ->update(['is_selected' => false]);
                
                $predictionResult = PredictionResult::where('diet_prediction_id', $latestCheckup->dietPrediction->id)
                    ->where('diet_program_id', $validatedData['diet_program_id'])
                    ->first();
                
                if ($predictionResult) {
                    $predictionResult->update(['is_selected' => true]);
                } else {
                    PredictionResult::create([
                        'diet_prediction_id' => $latestCheckup->dietPrediction->id,
                        'diet_program_id' => $validatedData['diet_program_id'],
                        'confidence_score' => 1.0,
                        'is_selected' => true,
                    ]);
                }
            }
        }

        return redirect()->route('enrollments.index')
            ->with('success', __('app.program_enrollment_updated_successfully'));
    }

    /**
     * Remove the specified program enrollment
     */
    public function destroy($id)
    {
        $enrollment = ProgramEnrollment::findOrFail($id);
        $enrollment->delete();
        
        return redirect()->route('enrollments.index')
            ->with('error', __('app.program_enrollment_deleted_successfully'));
    }
    
    /**
     * Show the form for creating a new checkup for an existing enrollment
     */
    public function createCheckup($id)
    {
        $enrollment = ProgramEnrollment::with('user')->findOrFail($id);
        $dietPrograms = DietProgram::all();
        
        return view('pages.dashboard.admin.enrollments.create_checkup', compact('enrollment', 'dietPrograms'));
    }
    
    /**
     * Store a new checkup for an existing enrollment
     */
    public function storeCheckup(Request $request, $id)
    {
        $enrollment = ProgramEnrollment::findOrFail($id);
        
        $validatedData = $request->validate([
            'diet_program_id' => 'nullable|exists:diet_programs,id',
            'height' => 'required|numeric|min:100|max:250',
            'weight' => 'required|numeric|min:30|max:200',
            'body_fat' => 'required|numeric|min:0|max:100',
            'belly_fat' => 'required|numeric|min:0|max:100',
            'bone_density' => 'required|numeric|min:0|max:100',
            'calories_needs' => 'required|numeric|min:500|max:5000',
            'cell_age' => 'required|numeric|min:1|max:120',
            'muscle_mass' => 'required|numeric|min:0|max:100',
            'water_content' => 'required|numeric|min:0|max:100',
        ], [
            'diet_program_id.exists' => 'Program diet tidak valid',
            'height.required' => 'Tinggi badan harus diisi',
            'height.numeric' => 'Tinggi badan harus berupa angka',
            'height.min' => 'Tinggi badan minimal 100 cm',
            'height.max' => 'Tinggi badan maksimal 250 cm',
            'weight.required' => 'Berat badan harus diisi',
            'weight.numeric' => 'Berat badan harus berupa angka',
            'weight.min' => 'Berat badan minimal 30 kg',
            'weight.max' => 'Berat badan maksimal 200 kg',
            'body_fat.required' => 'Lemak tubuh harus diisi',
            'body_fat.numeric' => 'Lemak tubuh harus berupa angka',
            'body_fat.min' => 'Lemak tubuh minimal 0%',
            'body_fat.max' => 'Lemak tubuh maksimal 100%',
            'belly_fat.required' => 'Lemak perut harus diisi',
            'belly_fat.numeric' => 'Lemak perut harus berupa angka',
            'belly_fat.min' => 'Lemak perut minimal 0%',
            'belly_fat.max' => 'Lemak perut maksimal 100%',
            'bone_density.required' => 'Kepadatan tulang harus diisi',
            'bone_density.numeric' => 'Kepadatan tulang harus berupa angka',
            'bone_density.min' => 'Kepadatan tulang minimal 0',
            'bone_density.max' => 'Kepadatan tulang maksimal 100',
            'calories_needs.required' => 'Kebutuhan kalori harus diisi',
            'calories_needs.numeric' => 'Kebutuhan kalori harus berupa angka',
            'calories_needs.min' => 'Kebutuhan kalori minimal 500 kkal',
            'calories_needs.max' => 'Kebutuhan kalori maksimal 5000 kkal',
            'cell_age.required' => 'Usia sel harus diisi',
            'cell_age.numeric' => 'Usia sel harus berupa angka',
            'cell_age.min' => 'Usia sel minimal 1 tahun',
            'cell_age.max' => 'Usia sel maksimal 120 tahun',
            'muscle_mass.required' => 'Massa otot harus diisi',
            'muscle_mass.numeric' => 'Massa otot harus berupa angka',
            'muscle_mass.min' => 'Massa otot minimal 0 kg',
            'muscle_mass.max' => 'Massa otot maksimal 100 kg',
            'water_content.required' => 'Kadar air harus diisi',
            'water_content.numeric' => 'Kadar air harus berupa angka',
            'water_content.min' => 'Kadar air minimal 0%',
            'water_content.max' => 'Kadar air maksimal 100%',
        ]);

        // Create checkup record
        $checkup = Checkup::create([
            'program_enrollment_id' => $enrollment->id,
            'checkup_date' => now(),
            'height' => $validatedData['height'],
            'weight' => $validatedData['weight'],
            'body_fat' => $validatedData['body_fat'],
            'belly_fat' => $validatedData['belly_fat'],
            'bone_density' => $validatedData['bone_density'],
            'calories_needs' => $validatedData['calories_needs'],
            'cell_age' => $validatedData['cell_age'],
            'muscle_mass' => $validatedData['muscle_mass'],
            'water_content' => $validatedData['water_content'],
        ]);
        
        // Create diet prediction record
        $dietPrediction = DietPrediction::create([
            'checkup_id' => $checkup->id,
            'prediction_date' => now(),
        ]);
        
        if (!empty($validatedData['diet_program_id']) && $validatedData['diet_program_id'] != $enrollment->diet_program_id) {
            $enrollment->update([
                'diet_program_id' => $validatedData['diet_program_id'],
                'status' => 0, 
            ]);
            
            // Create prediction result for the selected program with 100% confidence
            PredictionResult::create([
                'diet_prediction_id' => $dietPrediction->id,
                'diet_program_id' => $validatedData['diet_program_id'],
                'confidence_score' => 1.0,
                'is_selected' => true,
            ]);
        } else {
            PredictionResult::create([
                'diet_prediction_id' => $dietPrediction->id,
                'diet_program_id' => $enrollment->diet_program_id,
                'confidence_score' => 1.0,
                'is_selected' => true,
            ]);
        }

        return redirect()->route('enrollments.show', $enrollment->id)
            ->with('success', 'New checkup added successfully!');
    }
}
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
    public function index()
    {
        // Load enrollments with related data
        $enrollments = ProgramEnrollment::with(['user', 'dietProgram', 'checkup'])
            ->get();
        
        return view('pages.dashboard.admin.enrollments.index', compact('enrollments'));
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
        // Validate input data
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
            'confidence_score' => 1.0, // 100% confidence for manual selection
            'is_selected' => true,
        ]);

        return redirect()->route('enrollments.index')
            ->with('success', 'Program enrollment created successfully!');
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
                
                // Find if there's an existing prediction result for this program
                $predictionResult = PredictionResult::where('diet_prediction_id', $latestCheckup->dietPrediction->id)
                    ->where('diet_program_id', $validatedData['diet_program_id'])
                    ->first();
                
                if ($predictionResult) {
                    // Update existing result
                    $predictionResult->update(['is_selected' => true]);
                } else {
                    // Create new result
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
            ->with('success', 'Program enrollment updated successfully!');
    }

    /**
     * Remove the specified program enrollment
     */
    public function destroy($id)
    {
        $enrollment = ProgramEnrollment::findOrFail($id);
        $enrollment->delete();
        
        return redirect()->route('enrollments.index')
            ->with('success', 'Program enrollment deleted successfully!');
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
        
        // Validate input data
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
        
        // Check if diet program was changed
        if (!empty($validatedData['diet_program_id']) && $validatedData['diet_program_id'] != $enrollment->diet_program_id) {
            // Update enrollment with new program
            $enrollment->update([
                'diet_program_id' => $validatedData['diet_program_id'],
                'status' => 0, // Reset status to "on going"
            ]);
            
            // Create prediction result for the selected program with 100% confidence
            PredictionResult::create([
                'diet_prediction_id' => $dietPrediction->id,
                'diet_program_id' => $validatedData['diet_program_id'],
                'confidence_score' => 1.0,
                'is_selected' => true,
            ]);
        } else {
            // Use current program
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
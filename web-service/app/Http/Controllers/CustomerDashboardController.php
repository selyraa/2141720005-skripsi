<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\DietRecommendation;
use App\Models\ProgramEnrollment;
use App\Models\DietProgram;
use App\Http\Controllers\Admin\ReportController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
        /**
     * Display the customer dashboard with relevant information
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get the customer's current active enrollment
        $enrollment = ProgramEnrollment::with('dietProgram')
            ->where('user_id', $user->id)
            ->where('status', 'On going')
            ->latest()
            ->first();
            
        // If no active enrollment, try to get the most recent one regardless of status
        if (!$enrollment) {
            $enrollment = ProgramEnrollment::with('dietProgram')
                ->where('user_id', $user->id)
                ->latest()
                ->first();
        }
        
        // Initialize variables
        $currentWeight = null;
        $firstCheckupWeight = null;
        $daysInProgram = 0;
        $checkups = collect();
        $weightTrendData = [
            'dates' => [],
            'weights' => []
        ];
        $bodyCompositionData = [
            'dates' => [],
            'bodyFat' => [],
            'bellyFat' => [],
            'muscleMass' => []
        ];
        $programName = 'Belum terdaftar dalam program';
        $bmiCategory = null;
        $bmiValue = null;
        $registrationDate = null;
        $latestNutritionData = [
            'calories_needs' => null,
            'water_content' => null
        ];
        $userInfo = [
            'height' => null,
            'age' => null,
            'gender' => $user->gender,
            'name' => $user->name
        ];
        
        // Fetch latest diet recommendation for health tips
        $latestDietRecommendation = null;
        
        if ($enrollment) {
            // Get all checkups for this enrollment, ordered by date
            $checkups = Checkup::where('program_enrollment_id', $enrollment->id)
                ->orderBy('checkup_date')
                ->get();
                
            // Get first checkup weight and height
            $firstCheckup = $checkups->first();
            if ($firstCheckup) {
                $firstCheckupWeight = $firstCheckup->weight;
                $userInfo['height'] = $firstCheckup->height;
            }
            
            // Get latest checkup for current weight and other metrics
            $latestCheckup = $checkups->last();
            if ($latestCheckup) {
                $currentWeight = $latestCheckup->weight;
                $bmiValue = $latestCheckup->calculateBmi();
                $bmiCategory = $latestCheckup->getBmiCategory();
                
                // Update latest nutrition data
                $latestNutritionData['calories_needs'] = $latestCheckup->calories_needs;
                $latestNutritionData['water_content'] = $latestCheckup->water_content;
                $userInfo['height'] = $latestCheckup->height;
                
                // Fetch the latest diet recommendation
                $latestDietRecommendation = DietRecommendation::where('checkup_id', $latestCheckup->id)
                    ->latest()
                    ->first();
            }
            
            // If no recommendation found for the latest checkup, try to find any latest recommendation
            if (!$latestDietRecommendation && $checkups->isNotEmpty()) {
                $checkupIds = $checkups->pluck('id')->toArray();
                $latestDietRecommendation = DietRecommendation::whereIn('checkup_id', $checkupIds)
                    ->latest()
                    ->first();
            }
            
            // Calculate days in program and get registration date
            $registrationDate = $enrollment->created_at;
            $daysInProgram = ReportController::calculateDuration($registrationDate);
            
            // Get program name
            if ($enrollment->dietProgram) {
                $programName = $enrollment->dietProgram->name;
            }
            
            // Prepare weight trend data and body composition data
            foreach ($checkups as $checkup) {
                $date = $checkup->checkup_date->format('d M Y');
                
                // Weight trend data
                $weightTrendData['dates'][] = $date;
                $weightTrendData['weights'][] = round($checkup->weight, 1);
                
                // Body composition data
                $bodyCompositionData['dates'][] = $date;
                $bodyCompositionData['bodyFat'][] = round($checkup->body_fat, 1);
                $bodyCompositionData['bellyFat'][] = round($checkup->belly_fat, 1);
                $bodyCompositionData['muscleMass'][] = round($checkup->muscle_mass, 1);
            }
        }
        
        // Calculate user age if birth date is available
        if ($user->birth_date) {
            $userInfo['age'] = Carbon::parse($user->birth_date)->age;
        }
        
        // Get total checkups
        $totalCheckups = $checkups->count();
        
        // Calculate weight change if possible
        $weightChange = null;
        $weightChangePercent = null;
        
        if ($currentWeight !== null && $firstCheckupWeight !== null) {
            $weightChange = $currentWeight - $firstCheckupWeight;
            $weightChangePercent = $firstCheckupWeight > 0 ? 
                round(($weightChange / $firstCheckupWeight) * 100, 1) : 0;
        }
        
        // Calculate target weight based on BMI (if height is available)
        $idealWeightMin = null;
        $idealWeightMax = null;
        
        if ($userInfo['height']) {
            $heightInMeters = $userInfo['height'] / 100;
            $idealWeightMin = round(18.5 * $heightInMeters * $heightInMeters, 1);
            $idealWeightMax = round(24.9 * $heightInMeters * $heightInMeters, 1);
        }
        
        return view('pages.dashboard.customer.dashboard', compact(
            'currentWeight',
            'firstCheckupWeight',
            'daysInProgram',
            'weightTrendData',
            'bodyCompositionData',
            'checkups',
            'programName',
            'totalCheckups',
            'weightChange',
            'weightChangePercent',
            'bmiCategory',
            'bmiValue',
            'registrationDate',
            'latestNutritionData',
            'userInfo',
            'idealWeightMin',
            'idealWeightMax',
            'latestDietRecommendation'
        ));
    }
}

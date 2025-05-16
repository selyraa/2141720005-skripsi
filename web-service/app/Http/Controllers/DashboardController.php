<?php

namespace App\Http\Controllers;

use App\Models\DietProgram;
use App\Models\ProgramEnrollment;
use App\Models\User;
use App\Models\Checkup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard with statistics
     */
    public function index()
    {
        $customerCount = User::whereHas('role', function ($query) {
            $query->where('name', 'pelanggan');
        })->count();

        $dietPrograms = DietProgram::all()->pluck('id', 'name');

        $weightGainCount = ProgramEnrollment::whereHas('dietProgram', function ($query) {
            $query->where('name', 'like', '%Naik BB%');
        })->count();

        $weightLossCount = ProgramEnrollment::whereHas('dietProgram', function ($query) {
            $query->where('name', 'like', '%Turun BB%');
        })->count();

        $fatLossCount = ProgramEnrollment::whereHas('dietProgram', function ($query) {
            $query->where('name', 'like', '%Turun Lemak%');
        })->count();

        $totalEnrollments = $weightGainCount + $weightLossCount + $fatLossCount;

        $programStatusCounts = ProgramEnrollment::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        $programStatusLabels = ['On going', 'Completed', 'Cancelled', 'Changed'];
        $programStatusData = [];

        foreach ($programStatusLabels as $status) {
            $programStatusData[] = $programStatusCounts[$status] ?? 0;
        }

        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $checkups = Checkup::with(['programEnrollment.dietProgram', 'programEnrollment.user'])
            ->where('checkup_date', '>=', $sixMonthsAgo)
            ->whereNotNull('program_enrollment_id')
            ->orderBy('checkup_date')
            ->get();

        // Calculate BMI distribution
        $latestCheckups = Checkup::select('checkups.program_enrollment_id', DB::raw('MAX(checkups.id) as latest_id'))
            ->join('program_enrollments', 'checkups.program_enrollment_id', '=', 'program_enrollments.id')
            ->whereNull('checkups.deleted_at')
            ->whereNull('program_enrollments.deleted_at')
            ->groupBy('checkups.program_enrollment_id')
            ->pluck('latest_id');

        $latestCheckupsData = Checkup::whereIn('id', $latestCheckups)->get();

        $bmiDistribution = [
            'underweight' => 0,
            'normal' => 0,
            'overweight' => 0,
            'obese' => 0
        ];

        foreach ($latestCheckupsData as $checkup) {
            $category = $checkup->getBmiCategory();
            if (isset($bmiDistribution[$category])) {
                $bmiDistribution[$category]++;
            }
        }

        $availablePrograms = DietProgram::all();
        
        $customersData = [];
        
        $allCheckupDates = [];
        $uniqueDates = [];
        
        foreach ($checkups as $checkup) {
            if (!$checkup->checkup_date) continue;
            
            $dateStr = $checkup->checkup_date->format('Y-m-d');
            if (!in_array($dateStr, $uniqueDates)) {
                $uniqueDates[] = $dateStr;
            }
        }
        
        sort($uniqueDates);
        
        $formattedDates = [];
        foreach ($uniqueDates as $dateStr) {
            $date = Carbon::parse($dateStr);
            $formattedDates[] = $date->format('d M Y');
        }
        
        foreach ($checkups as $checkup) {
            if (!$checkup->programEnrollment || !$checkup->programEnrollment->dietProgram || !$checkup->programEnrollment->user) {
                continue;
            }
            
            $userId = $checkup->programEnrollment->user->id;
            $userName = $checkup->programEnrollment->user->name;
            $programId = $checkup->programEnrollment->dietProgram->id;
            $programName = $checkup->programEnrollment->dietProgram->name;
            $dateStr = $checkup->checkup_date->format('Y-m-d');
            $displayDate = $checkup->checkup_date->format('d M Y');
            
            if (!in_array($dateStr, $uniqueDates)) {
                continue;
            }
            
            $programType = null;
            if (str_contains($programName, 'Naik BB')) {
                $programType = 'weightGain';
            } elseif (str_contains($programName, 'Turun BB')) {
                $programType = 'weightLoss';
            } elseif (str_contains($programName, 'Turun Lemak')) {
                $programType = 'fatLoss';
            }
            
            if (!isset($customersData[$userId])) {
                $customersData[$userId] = [
                    'id' => $userId,
                    'name' => $userName,
                    'programId' => $programId,
                    'programName' => $programName,
                    'programType' => $programType,
                    'weights' => array_fill_keys($formattedDates, null)
                ];
            }
            
            $customersData[$userId]['weights'][$displayDate] = round($checkup->weight, 1);
        }
        
        $customerWeightData = array_values($customersData);
        
        $weightGainData = array_fill(0, count($formattedDates), 0);
        $weightLossData = array_fill(0, count($formattedDates), 0);
        $fatLossData = array_fill(0, count($formattedDates), 0);
        $weightGainCounts = array_fill(0, count($formattedDates), 0);
        $weightLossCounts = array_fill(0, count($formattedDates), 0);
        $fatLossCounts = array_fill(0, count($formattedDates), 0);
        
        foreach ($customerWeightData as $customer) {
            foreach ($customer['weights'] as $date => $weight) {
                if ($weight === null) continue;
                
                $dateIndex = array_search($date, $formattedDates);
                if ($dateIndex === false) continue;
                
                switch ($customer['programType']) {
                    case 'weightGain':
                        $weightGainData[$dateIndex] += $weight;
                        $weightGainCounts[$dateIndex]++;
                        break;
                    case 'weightLoss':
                        $weightLossData[$dateIndex] += $weight;
                        $weightLossCounts[$dateIndex]++;
                        break;
                    case 'fatLoss':
                        $fatLossData[$dateIndex] += $weight;
                        $fatLossCounts[$dateIndex]++;
                        break;
                }
            }
        }
        
        for ($i = 0; $i < count($formattedDates); $i++) {
            $weightGainData[$i] = $weightGainCounts[$i] > 0 ? round($weightGainData[$i] / $weightGainCounts[$i], 1) : 0;
            $weightLossData[$i] = $weightLossCounts[$i] > 0 ? round($weightLossData[$i] / $weightLossCounts[$i], 1) : 0;
            $fatLossData[$i] = $fatLossCounts[$i] > 0 ? round($fatLossData[$i] / $fatLossCounts[$i], 1) : 0;
        }
        
        $weightTrendData = [
            'dates' => $formattedDates,
            'weightGainData' => $weightGainData,
            'weightLossData' => $weightLossData,
            'fatLossData' => $fatLossData,
            'customerData' => $customerWeightData
        ];

        // Calculate age distribution of customers who follow diet programs
        $ageDistributionLabels = ['<18', '18-24', '25-34', '35-44', '45-54', '55+'];
        $ageDistributionData = array_fill(0, count($ageDistributionLabels), 0);
        
        // Create array for detailed age breakdown
        $ageDetailedBreakdown = [
            // For <18
            0 => [],
            // For 18-24
            1 => [],
            // For 25-34
            2 => [],
            // For 35-44
            3 => [],
            // For 45-54
            4 => [],
            // For 55+
            5 => [],
        ];
        
        $customers = User::whereHas('role', function($query) {
                $query->where('name', 'pelanggan');
            })
            ->whereHas('programEnrollments')
            ->get();
            
        foreach ($customers as $customer) {
            if (!$customer->birth_date) continue;
            
            // Ensure birth_date is properly parsed to calculate age
            $birthDate = $customer->birth_date;
            if (is_string($birthDate)) {
                $birthDate = Carbon::parse($birthDate);
            }
            $age = $birthDate->age;
            
            if ($age < 18) {
                $ageDistributionData[0]++; 
                $ageDetailedBreakdown[0][$age] = isset($ageDetailedBreakdown[0][$age]) ? $ageDetailedBreakdown[0][$age] + 1 : 1;
            }
            elseif ($age >= 18 && $age <= 24) {
                $ageDistributionData[1]++;
                $ageDetailedBreakdown[1][$age] = isset($ageDetailedBreakdown[1][$age]) ? $ageDetailedBreakdown[1][$age] + 1 : 1;
            }
            elseif ($age >= 25 && $age <= 34) {
                $ageDistributionData[2]++;
                $ageDetailedBreakdown[2][$age] = isset($ageDetailedBreakdown[2][$age]) ? $ageDetailedBreakdown[2][$age] + 1 : 1;
            }
            elseif ($age >= 35 && $age <= 44) {
                $ageDistributionData[3]++;
                $ageDetailedBreakdown[3][$age] = isset($ageDetailedBreakdown[3][$age]) ? $ageDetailedBreakdown[3][$age] + 1 : 1;
            }
            elseif ($age >= 45 && $age <= 54) {
                $ageDistributionData[4]++;
                $ageDetailedBreakdown[4][$age] = isset($ageDetailedBreakdown[4][$age]) ? $ageDetailedBreakdown[4][$age] + 1 : 1;
            }
            else {
                $ageDistributionData[5]++;
                $ageDetailedBreakdown[5][$age] = isset($ageDetailedBreakdown[5][$age]) ? $ageDetailedBreakdown[5][$age] + 1 : 1;
            }
        }

        return view('pages.dashboard.admin.dashboard', compact(
            'customerCount',
            'weightGainCount',
            'weightLossCount',
            'fatLossCount',
            'totalEnrollments',
            'weightTrendData',
            'programStatusLabels',
            'programStatusData',
            'bmiDistribution',
            'availablePrograms',
            'ageDistributionLabels',
            'ageDistributionData',
            'ageDetailedBreakdown'
        ));
    }
}

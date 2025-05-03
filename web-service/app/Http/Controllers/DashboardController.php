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

        // Get all checkups from the last 6 months
        $checkups = Checkup::with(['programEnrollment.dietProgram'])
            ->where('checkup_date', '>=', $sixMonthsAgo)
            ->whereNotNull('program_enrollment_id')
            ->orderBy('checkup_date')
            ->get();

        // Calculate BMI distribution
        // Get the latest checkup for each user to reflect current state
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

        $dates = [];
        $weightGainData = [];
        $weightLossData = [];
        $fatLossData = [];

        $months = [];
        for ($i = 0; $i < 6; $i++) {
            $date = Carbon::now()->subMonths(5 - $i)->format('M Y');
            $months[] = $date;
            $dates[] = $date;
            $weightGainData[] = 0;
            $weightLossData[] = 0;
            $fatLossData[] = 0;
        }

        if ($checkups->isNotEmpty()) {
            // Group checkups by month and program
            $groupedCheckups = $checkups->groupBy(function ($checkup) {
                if (!$checkup->programEnrollment || !$checkup->programEnrollment->dietProgram) {
                    return null;
                }

                $programType = null;
                $programName = $checkup->programEnrollment->dietProgram->name;

                if (str_contains($programName, 'Naik BB')) {
                    $programType = 'weightGain';
                } elseif (str_contains($programName, 'Turun BB')) {
                    $programType = 'weightLoss';
                } elseif (str_contains($programName, 'Turun Lemak')) {
                    $programType = 'fatLoss';
                }

                $month = Carbon::parse($checkup->checkup_date)->format('M Y');
                return $programType . '_' . $month;
            });

            // Calculate average weights
            foreach ($groupedCheckups as $key => $group) {
                if ($key === null) continue;

                // Split the key into program type and month, checking if the key contains an underscore
                $keyParts = explode('_', $key);
                if (count($keyParts) < 2) continue; // Skip if we don't have both program type and month

                $programType = $keyParts[0];
                $month = $keyParts[1];

                $avgWeight = $group->avg('weight');

                $monthIndex = array_search($month, $months);
                if ($monthIndex !== false) {
                    switch ($programType) {
                        case 'weightGain':
                            $weightGainData[$monthIndex] = round($avgWeight, 1);
                            break;
                        case 'weightLoss':
                            $weightLossData[$monthIndex] = round($avgWeight, 1);
                            break;
                        case 'fatLoss':
                            $fatLossData[$monthIndex] = round($avgWeight, 1);
                            break;
                    }
                }
            }
        }

        // Prepare the weight trend data for the view
        $weightTrendData = [
            'dates' => $dates,
            'weightGainData' => $weightGainData,
            'weightLossData' => $weightLossData,
            'fatLossData' => $fatLossData
        ];

        return view('pages.dashboard.admin.dashboard', compact(
            'customerCount',
            'weightGainCount',
            'weightLossCount',
            'fatLossCount',
            'totalEnrollments',
            'weightTrendData',
            'programStatusLabels',
            'programStatusData',
            'bmiDistribution'
        ));
    }
}

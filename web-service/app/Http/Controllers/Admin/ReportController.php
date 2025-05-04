<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DietProgram;
use App\Models\ProgramEnrollment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display the program enrollment reports with filters
     */
    public function index(Request $request)
    {
        // Get filter parameters
        $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date'))->startOfMonth() : Carbon::now()->startOfMonth();
        $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date'))->endOfMonth() : Carbon::now()->endOfMonth();
        $programId = $request->get('program');

        // Get all diet programs for the filter dropdown
        $dietPrograms = DietProgram::all();

        // Build the query for program enrollments
        $query = ProgramEnrollment::with(['user', 'dietProgram'])
            ->whereBetween('created_at', [$startDate, $endDate]);

        // Apply program filter if selected
        if ($programId) {
            $query->where('diet_program_id', $programId);
        }

        // Fetch paginated results
        $enrollments = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.dashboard.admin.reports.index', compact('enrollments', 'dietPrograms'));
    }

    /**
     * Export the filtered program enrollments to PDF
     */
    public function exportPdf(Request $request)
    {
        // Get filter parameters
        $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date'))->startOfMonth() : Carbon::now()->startOfMonth();
        $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date'))->endOfMonth() : Carbon::now()->endOfMonth();
        $programId = $request->get('program');

        // Get selected program if applicable
        $program = $programId ? DietProgram::find($programId) : null;

        // Build the query for program enrollments
        $query = ProgramEnrollment::with(['user', 'dietProgram'])
            ->whereBetween('created_at', [$startDate, $endDate]);

        // Apply program filter if selected
        if ($programId) {
            $query->where('diet_program_id', $programId);
        }

        // Get all enrollments without pagination for PDF
        $enrollments = $query->orderBy('created_at', 'desc')->get();

        // Generate PDF
        $pdf = PDF::loadView('pages.dashboard.admin.reports.pdf', compact('enrollments', 'startDate', 'endDate', 'program'));
        
        // Set filename with date range
        $filename = 'enrollment_report_' . $startDate->format('Y_m') . '_to_' . $endDate->format('Y_m') . '.pdf';
        
        // Download the PDF file
        return $pdf->download($filename);
    }
    
    /**
     * Calculate the duration in days between enrollment date and today
     * 
     * @param Carbon|null $enrollmentDate The enrollment date
     * @return int The duration in days (whole number)
     */
    public static function calculateDuration($enrollmentDate)
    {
        if (!$enrollmentDate) {
            return 0;
        }
        
        $todayDate = Carbon::now();
        
        // Calculate whole days between dates by starting both at beginning of day
        return abs($todayDate->startOfDay()->diffInDays($enrollmentDate->startOfDay()));
    }
    
    /**
     * Calculate progress percentage based on days elapsed and program duration
     * 
     * @param Carbon|null $enrollmentDate The enrollment date
     * @param int|null $programDuration The total duration of the program in days
     * @return int The progress percentage (0-100)
     */
    public static function calculateProgress($enrollmentDate, $programDuration)
    {
        if (!$enrollmentDate || !$programDuration || $programDuration <= 0) {
            return 0;
        }
        
        $daysElapsed = self::calculateDuration($enrollmentDate);
        
        // Calculate progress percentage and cap at 100%
        return min(100, round(($daysElapsed / $programDuration) * 100));
    }
}

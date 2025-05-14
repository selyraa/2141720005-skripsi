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
        $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date'))->startOfMonth() : Carbon::now()->startOfMonth();
        $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date'))->endOfMonth() : Carbon::now()->endOfMonth();
        $programId = $request->get('program');
        
        $perPage = $request->input('per_page', 10);

        $dietPrograms = DietProgram::all();

        $query = ProgramEnrollment::with(['user', 'dietProgram'])
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($programId) {
            $query->where('diet_program_id', $programId);
        }

        $enrollments = $query->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
            
        $perPageOptions = [5, 10, 20, 50, 100];

        return view('pages.dashboard.admin.reports.index', compact('enrollments', 'dietPrograms', 'perPage', 'perPageOptions'));
    }

    /**
     * Export the filtered program enrollments to PDF
     */
    public function exportPdf(Request $request)
    {
        $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date'))->startOfMonth() : Carbon::now()->startOfMonth();
        $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date'))->endOfMonth() : Carbon::now()->endOfMonth();
        $programId = $request->get('program');

        $program = $programId ? DietProgram::find($programId) : null;

        $query = ProgramEnrollment::with(['user', 'dietProgram'])
            ->whereBetween('created_at', [$startDate, $endDate]);

        if ($programId) {
            $query->where('diet_program_id', $programId);
        }

        $enrollments = $query->orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('pages.dashboard.admin.reports.pdf', compact('enrollments', 'startDate', 'endDate', 'program'));
        
        $filename = 'enrollment_report_' . $startDate->format('Y_m') . '_to_' . $endDate->format('Y_m') . '.pdf';
        
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
        
        return abs($todayDate->startOfDay()->diffInDays($enrollmentDate->startOfDay()));
    }
    
    /**
     * Calculate progress percentage based on days elapsed and program duration
     * 
     * @param Carbon|null $enrollmentDate The enrollment date
     * @param int|null $programDuration The total duration of the program in days
     * @return int The progress percentage (0-100)
     */
}

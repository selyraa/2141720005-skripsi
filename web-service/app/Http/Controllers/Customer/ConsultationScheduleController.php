<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RoleMiddleware;
use App\Models\ConsultationSchedule;
use App\Models\ProgramEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationScheduleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(RoleMiddleware::class . ':pelanggan');
    }
    
    /**
     * Display a listing of the customer's consultation schedules.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get enrollments for the current user
        $enrollments = ProgramEnrollment::where('user_id', $user->id)->pluck('id')->toArray();
        
        // Get consultation schedules for these enrollments
        $schedules = ConsultationSchedule::with(['programEnrollment.user', 'programEnrollment.dietProgram'])
            ->whereIn('program_enrollment_id', $enrollments)
            ->orderBy('schedule_date', 'desc')
            ->paginate(10);
        
        return view('pages.dashboard.customer.consultation-schedules.index', compact('schedules'));
    }

    /**
     * Display the specified consultation schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        
        // Get enrollments for the current user
        $enrollments = ProgramEnrollment::where('user_id', $user->id)->pluck('id')->toArray();
        
        // Find the specified consultation schedule and ensure it belongs to the current user
        $schedule = ConsultationSchedule::with(['programEnrollment.user', 'programEnrollment.dietProgram'])
            ->whereIn('program_enrollment_id', $enrollments)
            ->findOrFail($id);
        
        // Security check: Ensure the schedule belongs to the current user
        if ($schedule->programEnrollment->user_id !== $user->id) {
            abort(403, 'Unauthorized access to consultation schedule.');
        }
        
        return view('pages.dashboard.customer.consultation-schedules.show', compact('schedule'));
    }
}

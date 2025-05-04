<?php

namespace App\Http\Controllers\Admin;

use App\Casts\ConsultationScheduleStatusCast;
use App\Http\Controllers\Controller;
use App\Models\ConsultationSchedule;
use App\Models\ProgramEnrollment;
use Illuminate\Http\Request;

class ConsultationScheduleController extends Controller
{
    /**
     * Display a listing of the consultation schedules.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = ConsultationSchedule::with(['programEnrollment.user', 'programEnrollment.dietProgram'])
            ->orderBy('schedule_date', 'desc')
            ->get();

        return view('pages.dashboard.admin.consultation-schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new consultation schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enrollments = ProgramEnrollment::with(['user', 'dietProgram'])
            ->where('status', 0) // Only active/ongoing enrollments
            ->get();

        $statusCast = new ConsultationScheduleStatusCast();
        $statuses = $statusCast->getStatuses();

        return view('pages.dashboard.admin.consultation-schedules.create', compact('enrollments', 'statuses'));
    }

    /**
     * Store a newly created consultation schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_enrollment_id' => 'required|exists:program_enrollments,id',
            'schedule_date' => 'required|date',
            'status' => 'required|integer|in:0,1,2',
        ]);
        
        ConsultationSchedule::create($validated);
        
        return redirect()->route('consultation-schedules.index')
            ->with('success', 'Jadwal konsultasi berhasil dibuat!');
    }

    /**
     * Display the specified consultation schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = ConsultationSchedule::with(['programEnrollment.user', 'programEnrollment.dietProgram'])
            ->findOrFail($id);
            
        return view('pages.dashboard.admin.consultation-schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified consultation schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = ConsultationSchedule::findOrFail($id);
        $enrollments = ProgramEnrollment::with(['user', 'dietProgram'])
            ->where('status', 0) // Only active/ongoing enrollments
            ->get();
            
        $statusCast = new ConsultationScheduleStatusCast();
        $statuses = $statusCast->getStatuses();
        
        return view('pages.dashboard.admin.consultation-schedules.edit', compact('schedule', 'enrollments', 'statuses'));
    }

    /**
     * Update the specified consultation schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $schedule = ConsultationSchedule::findOrFail($id);
        
        $validated = $request->validate([
            'program_enrollment_id' => 'required|exists:program_enrollments,id',
            'schedule_date' => 'required|date',
            'status' => 'required|integer|in:0,1,2',
        ]);
        
        $schedule->update($validated);
        
        return redirect()->route('consultation-schedules.index')
            ->with('success', 'Jadwal konsultasi berhasil diperbarui!');
    }

    /**
     * Remove the specified consultation schedule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = ConsultationSchedule::findOrFail($id);
        $schedule->delete();
        
        return redirect()->route('consultation-schedules.index')
            ->with('success', 'Jadwal konsultasi berhasil dihapus!');
    }
}
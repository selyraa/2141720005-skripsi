<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Checkup;
use App\Models\ProgramEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckupDataController extends Controller
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
     * Display a listing of the customer's checkup data.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get enrollments for the current user
        $enrollments = ProgramEnrollment::where('user_id', $user->id)->pluck('id')->toArray();
        
        // Get checkups for these enrollments
        $checkups = Checkup::with(['programEnrollment.dietProgram'])
            ->whereIn('program_enrollment_id', $enrollments)
            ->orderBy('checkup_date', 'desc')
            ->paginate(10);
        
        return view('pages.dashboard.customer.checkups.index', compact('checkups'));
    }

    /**
     * Display the specified checkup's details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        
        // Get enrollments for the current user
        $enrollments = ProgramEnrollment::where('user_id', $user->id)->pluck('id')->toArray();
        
        // Find the specified checkup and ensure it belongs to the current user
        $checkup = Checkup::with([
            'programEnrollment.dietProgram', 
            'dietPrediction.predictionResults.dietProgram',
        ])
        ->whereIn('program_enrollment_id', $enrollments)
        ->findOrFail($id);
        
        // Security check: Ensure the checkup belongs to the current user
        if ($checkup->programEnrollment->user_id !== $user->id) {
            abort(403, 'Unauthorized access to checkup data.');
        }
        
        // Get all checkups for this enrollment for history
        $userCheckups = Checkup::where('program_enrollment_id', $checkup->program_enrollment_id)
            ->orderBy('checkup_date', 'desc')
            ->get();
            
        return view('pages.dashboard.customer.checkups.show', compact('checkup', 'userCheckups'));
    }
}

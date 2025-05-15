<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RoleMiddleware;
use App\Models\DietRecommendation;
use App\Models\ProgramEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DietRecommendationController extends Controller
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
     * Display a listing of the customer's diet recommendations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->input('per_page', 10);
        
        // Get enrollments for the current user
        $enrollments = ProgramEnrollment::where('user_id', $user->id);
        
        // Apply diet program filter if provided
        if ($request->filled('diet_program')) {
            $enrollments = $enrollments->where('diet_program_id', $request->input('diet_program'));
        }
        
        $enrollmentIds = $enrollments->pluck('id')->toArray();
        
        // Get checkups for these enrollments
        $checkupsQuery = \App\Models\Checkup::whereIn('program_enrollment_id', $enrollmentIds);
        
        // Apply date filters if provided
        if ($request->filled('date_from')) {
            $checkupsQuery->where('checkup_date', '>=', $request->input('date_from'));
        }
        
        if ($request->filled('date_to')) {
            $checkupsQuery->where('checkup_date', '<=', $request->input('date_to') . ' 23:59:59');
        }
        
        $checkupIds = $checkupsQuery->pluck('id')->toArray();
        
        // Get diet recommendations for these checkups
        $recommendations = DietRecommendation::with(['checkup.programEnrollment.user', 'checkup.programEnrollment.dietProgram', 'llmContext'])
            ->whereIn('checkup_id', $checkupIds)
            ->orderBy('created_at', 'desc')
            ->orderBy('checkup_id', 'desc')
            ->paginate($perPage)
            ->withQueryString();
        
        $perPageOptions = [5, 10, 20, 50, 100];
        
        // Get all diet programs that the user is enrolled in
        $dietPrograms = \App\Models\DietProgram::whereIn('id', 
            ProgramEnrollment::where('user_id', $user->id)->pluck('diet_program_id')->toArray()
        )->get();
        
        return view('pages.dashboard.customer.diet-recommendations.index', 
            compact('recommendations', 'perPage', 'perPageOptions', 'dietPrograms'));
    }

    /**
     * Display the specified diet recommendation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $recommendation = DietRecommendation::with(['checkup.programEnrollment.user', 'checkup.programEnrollment.dietProgram', 'llmContext'])
            ->findOrFail($id);
        
        // Check if recommendation belongs to the current user
        if ($recommendation->checkup->programEnrollment->user_id !== $user->id) {
            abort(403, 'Unauthorized access to diet recommendation.');
        }
        
        return view('pages.dashboard.customer.diet-recommendations.show', compact('recommendation'));
    }
}
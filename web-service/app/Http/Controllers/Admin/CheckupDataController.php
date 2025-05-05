<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkup;
use App\Models\User;
use App\Models\ProgramEnrollment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CheckupDataController extends Controller
{
    /**
     * Display a listing of checkup data.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        
        $latestCheckups = Checkup::select('checkups.program_enrollment_id', DB::raw('MAX(checkups.id) as latest_id'))
                        ->join('program_enrollments', 'checkups.program_enrollment_id', '=', 'program_enrollments.id')
                        ->whereNull('checkups.deleted_at')
                        ->whereNull('program_enrollments.deleted_at')
                        ->groupBy('checkups.program_enrollment_id')
                        ->pluck('latest_id');
        
        $checkups = Checkup::with(['programEnrollment.user', 'programEnrollment.dietProgram'])
                    ->whereIn('id', $latestCheckups)
                    ->whereHas('programEnrollment', function ($query) {
                        $query->whereNull('deleted_at');
                    })
                    ->orderBy('checkup_date', 'desc')
                    ->paginate($perPage)
                    ->withQueryString();
        
        $perPageOptions = [5, 10, 20, 50, 100];
        
        return view('pages.dashboard.admin.checkups.index', compact('checkups', 'perPage', 'perPageOptions'));
    }

    /**
     * Show the form for creating a new checkup.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enrollments = ProgramEnrollment::with(['user', 'dietProgram'])->get();
        return view('pages.dashboard.admin.checkups.create', compact('enrollments'));
    }

    /**
     * Store a newly created checkup in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_enrollment_id' => 'required|exists:program_enrollments,id',
            'checkup_date' => 'required|date',
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
        
        Checkup::create($validated);
        
        return redirect()->route('checkups.index')
            ->with('success', 'Checkup data added successfully!');
    }

    /**
     * Display the specified checkup's details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checkup = Checkup::with([
            'programEnrollment.user', 
            'programEnrollment.dietProgram', 
            'dietPrediction.predictionResults.dietProgram',
        ])->findOrFail($id);

        $userCheckups = Checkup::where('program_enrollment_id', $checkup->program_enrollment_id)
                        ->orderBy('checkup_date', 'desc')
                        ->get();
        
        return view('pages.dashboard.admin.checkups.show', compact('checkup', 'userCheckups'));
    }

    /**
     * Show the form for editing the specified checkup.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checkup = Checkup::findOrFail($id);
        $enrollments = ProgramEnrollment::with(['user', 'dietProgram'])->get();
        
        return view('pages.dashboard.admin.checkups.edit', compact('checkup', 'enrollments'));
    }

    /**
     * Update the specified checkup in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $checkup = Checkup::findOrFail($id);
        
        $validated = $request->validate([
            'program_enrollment_id' => 'required|exists:program_enrollments,id',
            'checkup_date' => 'required|date',
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
        
        $checkup->update($validated);
        
        return redirect()->route('checkups.index')
            ->with('success', 'Checkup data updated successfully!');
    }

    /**
     * Remove the specified checkup from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkup = Checkup::findOrFail($id);
        $checkup->delete();
        
        return redirect()->route('checkups.index')
            ->with('success', 'Checkup data deleted successfully!');
    }
}

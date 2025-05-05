<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DietProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DietProgramController extends Controller
{
    /**
     * Display a listing of diet programs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        
        $dietPrograms = DietProgram::orderBy('name')
            ->paginate($perPage)
            ->withQueryString();
        
        $perPageOptions = [5, 10, 20, 50, 100];
        
        return view('pages.dashboard.admin.diet-programs.index', compact('dietPrograms', 'perPage', 'perPageOptions'));
    }

    /**
     * Show the form for creating a new diet program.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->role || !in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi'])) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('pages.dashboard.admin.diet-programs.create');
    }

    /**
     * Store a newly created diet program in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->role || !in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:diet_programs,name,NULL,id,deleted_at,NULL',
            'description' => 'nullable|string',
        ]);
        
        DietProgram::create($validated);
        
        return redirect()->route('diet-programs.index')
            ->with('success', 'Diet program created successfully!');
    }

    /**
     * Display the specified diet program.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->role || !in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $dietProgram = DietProgram::findOrFail($id);
        
        $enrollments = $dietProgram->programEnrollments()
            ->with('user')
            ->take(10)
            ->get();
            
        return view('pages.dashboard.admin.diet-programs.show', compact('dietProgram', 'enrollments'));
    }

    /**
     * Show the form for editing the specified diet program.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->role || !in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $dietProgram = DietProgram::findOrFail($id);
        
        return view('pages.dashboard.admin.diet-programs.edit', compact('dietProgram'));
    }

    /**
     * Update the specified diet program in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->role || !in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $dietProgram = DietProgram::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:diet_programs,name,' . $id . ',id,deleted_at,NULL',
            'description' => 'nullable|string',
        ]);
        
        $dietProgram->update($validated);
        
        return redirect()->route('diet-programs.index')
            ->with('success', 'Diet program updated successfully!');
    }

    /**
     * Remove the specified diet program from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->role || !in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $dietProgram = DietProgram::findOrFail($id);
        
        if ($dietProgram->programEnrollments()->count() > 0) {
            return redirect()->route('diet-programs.index')
                ->with('error', 'Diet program cannot be deleted as it is currently in use.');
        }
        
        $dietProgram->delete();
        
        return redirect()->route('diet-programs.index')
            ->with('success', 'Diet program deleted successfully!');
    }
}
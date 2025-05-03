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
    public function index()
    {
        // Check if user has required role (nutritionist or assistant)
        if (!auth()->user()->role || !in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi'])) {
            abort(403, 'Unauthorized action.');
        }
        
        // Get all diet programs
        $dietPrograms = DietProgram::all();
        
        return view('pages.dashboard.admin.diet-programs.index', compact('dietPrograms'));
    }

    /**
     * Show the form for creating a new diet program.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Check if user has required role
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
        // Check if user has required role
        if (!auth()->user()->role || !in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi'])) {
            abort(403, 'Unauthorized action.');
        }
        
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:diet_programs,name,NULL,id,deleted_at,NULL',
            'description' => 'nullable|string',
        ]);
        
        // Create new diet program
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
        // Check if user has required role
        if (!auth()->user()->role || !in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $dietProgram = DietProgram::findOrFail($id);
        
        // Get enrollments associated with this diet program
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
        // Check if user has required role
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
        // Check if user has required role
        if (!auth()->user()->role || !in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $dietProgram = DietProgram::findOrFail($id);
        
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:diet_programs,name,' . $id . ',id,deleted_at,NULL',
            'description' => 'nullable|string',
        ]);
        
        // Update diet program
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
        // Check if user has required role
        if (!auth()->user()->role || !in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi'])) {
            abort(403, 'Unauthorized action.');
        }
        
        $dietProgram = DietProgram::findOrFail($id);
        
        // Check if diet program is in use before deleting
        if ($dietProgram->programEnrollments()->count() > 0) {
            return redirect()->route('diet-programs.index')
                ->with('error', 'Diet program cannot be deleted as it is currently in use.');
        }
        
        // Soft delete diet program
        $dietProgram->delete();
        
        return redirect()->route('diet-programs.index')
            ->with('success', 'Diet program deleted successfully!');
    }
}
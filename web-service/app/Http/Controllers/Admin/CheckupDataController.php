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
        ], [
            'program_enrollment_id.required' => 'Program pendaftaran harus dipilih',
            'program_enrollment_id.exists' => 'Program pendaftaran tidak valid',
            'checkup_date.required' => 'Tanggal checkup harus diisi',
            'checkup_date.date' => 'Format tanggal checkup tidak valid',
            'height.required' => 'Tinggi badan harus diisi',
            'height.numeric' => 'Tinggi badan harus berupa angka',
            'height.min' => 'Tinggi badan minimal 100 cm',
            'height.max' => 'Tinggi badan maksimal 250 cm',
            'weight.required' => 'Berat badan harus diisi',
            'weight.numeric' => 'Berat badan harus berupa angka',
            'weight.min' => 'Berat badan minimal 30 kg',
            'weight.max' => 'Berat badan maksimal 200 kg',
            'body_fat.required' => 'Lemak tubuh harus diisi',
            'body_fat.numeric' => 'Lemak tubuh harus berupa angka',
            'body_fat.min' => 'Lemak tubuh minimal 0%',
            'body_fat.max' => 'Lemak tubuh maksimal 100%',
            'belly_fat.required' => 'Lemak perut harus diisi',
            'belly_fat.numeric' => 'Lemak perut harus berupa angka',
            'belly_fat.min' => 'Lemak perut minimal 0%',
            'belly_fat.max' => 'Lemak perut maksimal 100%',
            'bone_density.required' => 'Kepadatan tulang harus diisi',
            'bone_density.numeric' => 'Kepadatan tulang harus berupa angka',
            'bone_density.min' => 'Kepadatan tulang minimal 0',
            'bone_density.max' => 'Kepadatan tulang maksimal 100',
            'calories_needs.required' => 'Kebutuhan kalori harus diisi',
            'calories_needs.numeric' => 'Kebutuhan kalori harus berupa angka',
            'calories_needs.min' => 'Kebutuhan kalori minimal 500 kkal',
            'calories_needs.max' => 'Kebutuhan kalori maksimal 5000 kkal',
            'cell_age.required' => 'Usia sel harus diisi',
            'cell_age.numeric' => 'Usia sel harus berupa angka',
            'cell_age.min' => 'Usia sel minimal 1 tahun',
            'cell_age.max' => 'Usia sel maksimal 120 tahun',
            'muscle_mass.required' => 'Massa otot harus diisi',
            'muscle_mass.numeric' => 'Massa otot harus berupa angka',
            'muscle_mass.min' => 'Massa otot minimal 0 kg',
            'muscle_mass.max' => 'Massa otot maksimal 100 kg',
            'water_content.required' => 'Kadar air harus diisi',
            'water_content.numeric' => 'Kadar air harus berupa angka',
            'water_content.min' => 'Kadar air minimal 0%',
            'water_content.max' => 'Kadar air maksimal 100%',
        ]);
        
        Checkup::create($validated);
        
        return redirect()->route('checkups.index')
            ->with('success', __('app.checkup_created_successfully'));
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
        ], [
            'program_enrollment_id.required' => 'Program pendaftaran harus dipilih',
            'program_enrollment_id.exists' => 'Program pendaftaran tidak valid',
            'checkup_date.required' => 'Tanggal checkup harus diisi',
            'checkup_date.date' => 'Format tanggal checkup tidak valid',
            'height.required' => 'Tinggi badan harus diisi',
            'height.numeric' => 'Tinggi badan harus berupa angka',
            'height.min' => 'Tinggi badan minimal 100 cm',
            'height.max' => 'Tinggi badan maksimal 250 cm',
            'weight.required' => 'Berat badan harus diisi',
            'weight.numeric' => 'Berat badan harus berupa angka',
            'weight.min' => 'Berat badan minimal 30 kg',
            'weight.max' => 'Berat badan maksimal 200 kg',
            'body_fat.required' => 'Lemak tubuh harus diisi',
            'body_fat.numeric' => 'Lemak tubuh harus berupa angka',
            'body_fat.min' => 'Lemak tubuh minimal 0%',
            'body_fat.max' => 'Lemak tubuh maksimal 100%',
            'belly_fat.required' => 'Lemak perut harus diisi',
            'belly_fat.numeric' => 'Lemak perut harus berupa angka',
            'belly_fat.min' => 'Lemak perut minimal 0%',
            'belly_fat.max' => 'Lemak perut maksimal 100%',
            'bone_density.required' => 'Kepadatan tulang harus diisi',
            'bone_density.numeric' => 'Kepadatan tulang harus berupa angka',
            'bone_density.min' => 'Kepadatan tulang minimal 0',
            'bone_density.max' => 'Kepadatan tulang maksimal 100',
            'calories_needs.required' => 'Kebutuhan kalori harus diisi',
            'calories_needs.numeric' => 'Kebutuhan kalori harus berupa angka',
            'calories_needs.min' => 'Kebutuhan kalori minimal 500 kkal',
            'calories_needs.max' => 'Kebutuhan kalori maksimal 5000 kkal',
            'cell_age.required' => 'Usia sel harus diisi',
            'cell_age.numeric' => 'Usia sel harus berupa angka',
            'cell_age.min' => 'Usia sel minimal 1 tahun',
            'cell_age.max' => 'Usia sel maksimal 120 tahun',
            'muscle_mass.required' => 'Massa otot harus diisi',
            'muscle_mass.numeric' => 'Massa otot harus berupa angka',
            'muscle_mass.min' => 'Massa otot minimal 0 kg',
            'muscle_mass.max' => 'Massa otot maksimal 100 kg',
            'water_content.required' => 'Kadar air harus diisi',
            'water_content.numeric' => 'Kadar air harus berupa angka',
            'water_content.min' => 'Kadar air minimal 0%',
            'water_content.max' => 'Kadar air maksimal 100%',
        ]);
        
        $checkup->update($validated);
        
        return redirect()->route('checkups.index')
            ->with('success', __('app.checkup_updated_successfully'));
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
            ->with('error', __('app.checkup_deleted_successfully'));
    }
}

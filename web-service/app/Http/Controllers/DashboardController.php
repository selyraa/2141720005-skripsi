<?php

namespace App\Http\Controllers;

use App\Models\DietProgram;
use App\Models\ProgramEnrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard with statistics
     */
    public function index()
    {
        // Get number of users with customer role (pelanggan)
        $customerCount = User::whereHas('role', function($query) {
            $query->where('name', 'pelanggan');
        })->count();

        // Get diet program stats
        $dietPrograms = DietProgram::all()->pluck('id', 'name');

        // Count enrollments for each program type
        $weightGainCount = ProgramEnrollment::whereHas('dietProgram', function($query) {
            $query->where('name', 'like', '%Naik BB%');
        })->count();

        $weightLossCount = ProgramEnrollment::whereHas('dietProgram', function($query) {
            $query->where('name', 'like', '%Turun BB%');
        })->count();

        $fatLossCount = ProgramEnrollment::whereHas('dietProgram', function($query) {
            $query->where('name', 'like', '%Turun Lemak%');
        })->count();

        return view('pages.dashboard.admin.dashboard', compact(
            'customerCount',
            'weightGainCount',
            'weightLossCount',
            'fatLossCount'
        ));
    }
}

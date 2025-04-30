<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    /**
     * Display login page
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('pages.auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

    /**
     * Display registration page
     */
    // public function showRegister()
    // {
    //     if (Auth::check()) {
    //         return redirect()->route('dashboard');
    //     }
        
    //     return view('pages.auth.register');
    // }

    // /**
    //  * Handle registration request
    //  */
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //         'phone_number' => 'nullable|string|max:15',
    //         'gender' => 'nullable|in:male,female',
    //         'birth_date' => 'nullable|date',
    //     ]);

    //     // Get default user role (assuming you have a 'user' role in your roles table)
    //     $userRole = Role::where('name', 'user')->first();
    //     if (!$userRole) {
    //         // If 'user' role doesn't exist, get the first role or create one
    //         $userRole = Role::first() ?? Role::create(['name' => 'user']);
    //     }

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'phone_number' => $request->phone_number,
    //         'gender' => $request->gender,
    //         'birth_date' => $request->birth_date,
    //         'role_id' => $userRole->id,
    //     ]);

    //     event(new Registered($user));
        
    //     Auth::login($user);

    //     return redirect()->route('dashboard');
    // }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('login');
    }
}

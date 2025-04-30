<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check if user has required role
        if (Gate::denies('manage-users')) {
            abort(403, 'Unauthorized action.');
        }
        
        // Get all users, ordered by name
        $users = User::with('role')->get();
        
        return view('pages.dashboard.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('manage-users')) {
            abort(403, 'Unauthorized action.');
        }
        
        // Get all roles for the dropdown
        $roles = Role::orderBy('name')->get();
        
        return view('pages.dashboard.admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('manage-users')) {
            abort(403, 'Unauthorized action.');
        }
        
        // Validate input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'phone_number' => 'nullable|string|max:15',
            'gender' => 'nullable|in:male,female',
            'birth_date' => 'nullable|date',
        ]);
        
        // Create user
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully!');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('manage-users')) {
            abort(403, 'Unauthorized action.');
        }
        
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name')->get();
        
        return view('pages.dashboard.admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('manage-users')) {
            abort(403, 'Unauthorized action.');
        }
        
        $user = User::findOrFail($id);
        
        // Validate input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'phone_number' => 'nullable|string|max:15',
            'gender' => 'nullable|in:male,female',
            'birth_date' => 'nullable|date',
        ]);
        
        // Update password only if provided
        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        
        $user->update($validatedData);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('manage-users')) {
            abort(403, 'Unauthorized action.');
        }
        
        $user = User::findOrFail($id);
        
        // Prevent deletion of own account
        if (auth()->user()->id === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account!');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }
}
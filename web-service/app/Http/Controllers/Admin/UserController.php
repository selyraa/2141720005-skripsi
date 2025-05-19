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
    public function index(Request $request)
    {
        if (Gate::denies('manage-users')) {
            abort(403, 'Unauthorized action.');
        }
        
        $perPage = $request->input('per_page', 10);
        
        $users = User::with('role')
            ->orderBy('name')
            ->paginate($perPage)
            ->withQueryString();
        
        $perPageOptions = [5, 10, 20, 50, 100];
        
        return view('pages.dashboard.admin.users.index', compact('users', 'perPage', 'perPageOptions'));
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
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'phone_number' => 'nullable|string|max:15',
            'gender' => 'nullable|in:male,female',
            'birth_date' => 'nullable|date',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role_id.required' => 'Role harus dipilih',
            'role_id.exists' => 'Role yang dipilih tidak valid',
            'phone_number.max' => 'Nomor telepon maksimal 15 karakter',
            'gender.in' => 'Jenis kelamin harus male atau female',
            'birth_date.date' => 'Format tanggal lahir tidak valid',
        ]);
        
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        
        return redirect()->route('admin.users.index')
            ->with('success', __('app.user_created_successfully'));
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
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role_id.required' => 'Role harus dipilih',
            'role_id.exists' => 'Role yang dipilih tidak valid',
            'phone_number.max' => 'Nomor telepon maksimal 15 karakter',
            'gender.in' => 'Jenis kelamin harus male atau female',
            'birth_date.date' => 'Format tanggal lahir tidak valid',
        ]);
        
        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        
        $user->update($validatedData);
        
        return redirect()->route('admin.users.index')
            ->with('success', __('app.user_updated_successfully'));
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
        
        if (auth()->user()->id === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', __('app.cannot_delete_own_account'));
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('error', __('app.user_deleted_successfully'));
    }
}
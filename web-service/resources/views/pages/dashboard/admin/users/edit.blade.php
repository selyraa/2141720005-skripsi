@extends('pages.dashboard.admin.layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        Edit Pengguna: {{ $user->name }}
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                Home
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('admin.users.index') }}">
                                Kelola Pengguna
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            Edit Pengguna
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        @if ($errors->any())
            <div class="bg-lighterror dark:bg-darkerror text-error px-4 py-3 rounded relative mb-4" role="alert">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                    <i class="ti ti-x"></i>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-4">Form Edit Pengguna</h3>

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="form-group">
                            <label for="name" class="form-label block mb-2 font-medium text-dark dark:text-white">Nama <span class="text-error">*</span></label>
                            <input type="text" class="form-control w-full" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label block mb-2 font-medium text-dark dark:text-white">Email <span class="text-error">*</span></label>
                            <input type="email" class="form-control w-full" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="form-group">
                            <label for="password" class="form-label block mb-2 font-medium text-dark dark:text-white">Password <span class="text-error">*</span></label>
                            <input type="password" class="form-control w-full" id="password" name="password">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Kosongkan jika tidak ingin mengubah password</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label block mb-2 font-medium text-dark dark:text-white">Konfirmasi Password <span class="text-error">*</span></label>
                            <input type="password" class="form-control w-full" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="form-group">
                            <label for="role_id" class="form-label block mb-2 font-medium text-dark dark:text-white">Role <span class="text-error">*</span></label>
                            <select class="form-select w-full" id="role_id" name="role_id" required>
                                <option value="">Pilih Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone_number" class="form-label block mb-2 font-medium text-dark dark:text-white">Nomor Telepon</label>
                            <input type="text" class="form-control w-full" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="form-group">
                            <label for="gender" class="form-label block mb-2 font-medium text-dark dark:text-white">Jenis Kelamin</label>
                            <select class="form-select w-full" id="gender" name="gender">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="birth_date" class="form-label block mb-2 font-medium text-dark dark:text-white">Tanggal Lahir</label>
                            <input type="date" class="form-control w-full" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}">
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-2">
                            <i class="ti ti-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
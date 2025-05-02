@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-12">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        Create New Program Enrollments
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                Home
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('enrollments.index') }}">
                                Program Enrollments
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            Create
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Registration Information</h3>
                    
                    @if($errors->any())
                        <div class="bg-lighterror dark:bg-darkerror text-error px-4 py-3 rounded relative mb-4" role="alert">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                                <i class="ti ti-x"></i>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('enrollments.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label for="user_id" class="form-label block mb-2 font-medium text-dark dark:text-white">User <span class="text-red-500">*</span></label>
                                <select id="user_id" name="user_id" class="form-select w-full" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="diet_program_id" class="form-label block mb-2 font-medium text-dark dark:text-white">Diet Program <span class="text-red-500">*</span></label>
                                <select id="diet_program_id" name="diet_program_id" class="form-select w-full" required>
                                    <option value="">Select Diet Program</option>
                                    @foreach($dietPrograms as $program)
                                        <option value="{{ $program->id }}" {{ old('diet_program_id') == $program->id ? 'selected' : '' }}>
                                            {{ $program->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status" class="form-label block mb-2 font-medium text-dark dark:text-white">Status <span class="text-red-500">*</span></label>
                                <select id="status" name="status" class="form-select w-full" required>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>On Going</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Completed</option>
                                    <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Canceled</option>
                                    <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Changed</option>
                                </select>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 my-6"></div>

                        <h3 class="text-lg font-medium text-dark dark:text-white mb-4">Initial Checkup Data</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="form-group">
                                <label for="height" class="form-label block mb-2 font-medium text-dark dark:text-white">Height (cm) <span class="text-red-500">*</span></label>
                                <input type="number" id="height" name="height" value="{{ old('height') }}" min="100" max="250" step="0.01" class="form-control w-full" required>
                            </div>

                            <div class="form-group">
                                <label for="weight" class="form-label block mb-2 font-medium text-dark dark:text-white">Weight (kg) <span class="text-red-500">*</span></label>
                                <input type="number" id="weight" name="weight" value="{{ old('weight') }}" min="30" max="200" step="0.01" class="form-control w-full" required>
                            </div>

                            <div class="form-group">
                                <label for="body_fat" class="form-label block mb-2 font-medium text-dark dark:text-white">Body Fat (%) <span class="text-red-500">*</span></label>
                                <input type="number" id="body_fat" name="body_fat" value="{{ old('body_fat') }}" min="0" max="100" step="0.01" class="form-control w-full" required>
                            </div>

                            <div class="form-group">
                                <label for="belly_fat" class="form-label block mb-2 font-medium text-dark dark:text-white">Belly Fat (%) <span class="text-red-500">*</span></label>
                                <input type="number" id="belly_fat" name="belly_fat" value="{{ old('belly_fat') }}" min="0" max="100" step="0.01" class="form-control w-full" required>
                            </div>

                            <div class="form-group">
                                <label for="bone_density" class="form-label block mb-2 font-medium text-dark dark:text-white">Bone Density <span class="text-red-500">*</span></label>
                                <input type="number" id="bone_density" name="bone_density" value="{{ old('bone_density') }}" min="0" max="100" step="0.01" class="form-control w-full" required>
                            </div>

                            <div class="form-group">
                                <label for="calories_needs" class="form-label block mb-2 font-medium text-dark dark:text-white">Calories Needs (kcal) <span class="text-red-500">*</span></label>
                                <input type="number" id="calories_needs" name="calories_needs" value="{{ old('calories_needs') }}" min="500" max="5000" step="1" class="form-control w-full" required>
                            </div>

                            <div class="form-group">
                                <label for="cell_age" class="form-label block mb-2 font-medium text-dark dark:text-white">Cell Age <span class="text-red-500">*</span></label>
                                <input type="number" id="cell_age" name="cell_age" value="{{ old('cell_age') }}" min="1" max="120" step="1" class="form-control w-full" required>
                            </div>

                            <div class="form-group">
                                <label for="muscle_mass" class="form-label block mb-2 font-medium text-dark dark:text-white">Muscle Mass (%) <span class="text-red-500">*</span></label>
                                <input type="number" id="muscle_mass" name="muscle_mass" value="{{ old('muscle_mass') }}" min="0" max="100" step="0.01" class="form-control w-full" required>
                            </div>

                            <div class="form-group">
                                <label for="water_content" class="form-label block mb-2 font-medium text-dark dark:text-white">Water Content (%) <span class="text-red-500">*</span></label>
                                <input type="number" id="water_content" name="water_content" value="{{ old('water_content') }}" min="0" max="100" step="0.01" class="form-control w-full" required>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('enrollments.index') }}" class="btn btn-secondary me-2">
                                <i class="ti ti-x me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-12">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        Add New Checkup
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
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('enrollments.show', $enrollment->id) }}">
                                Details
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            New Checkup
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 md:col-span-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Registration Information</h3>
                    
                    <div class="space-y-4">
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                            <h4 class="text-lg font-medium text-dark dark:text-white">User Information</h4>
                            <div class="flex items-center mt-2">
                                <div class="w-12 h-12 rounded-full overflow-hidden mr-4 bg-gray-200 dark:bg-gray-700 flex-shrink-0">
                                    <img src="{{ $enrollment->user->profile_photo_url ?? asset('assets/images/profile/user-1.jpg') }}" alt="User" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h5 class="font-medium text-dark dark:text-white">{{ $enrollment->user->name ?? 'N/A' }}</h5>
                                    <p class="text-gray-500 text-sm">{{ $enrollment->user->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 dark:border-gray-700 py-4">
                            <h4 class="text-lg font-medium text-dark dark:text-white">Current Program</h4>
                            <div class="mt-2">
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    <span class="text-gray-500">Program:</span>
                                    <span class="text-dark dark:text-white font-medium">{{ $enrollment->dietProgram->name ?? 'N/A' }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    <span class="text-gray-500">Status:</span>
                                    <span>
                                        @if($enrollment->status === 0)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                On Going
                                            </span>
                                        @elseif($enrollment->status === 1)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Completed
                                            </span>
                                        @elseif($enrollment->status === 2)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Canceled
                                            </span>
                                        @elseif($enrollment->status === 3)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Changed
                                            </span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">New Checkup Data</h3>

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
                    
                    <form action="{{ route('enrollments.store-checkup', $enrollment->id) }}" method="POST" class="space-y-6">
                        @csrf

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

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <div class="form-group">
                                <label for="diet_program_id" class="form-label block mb-2 font-medium text-dark dark:text-white">Change Diet Program? (Optional)</label>
                                <select id="diet_program_id" name="diet_program_id" class="form-select w-full">
                                    <option value="">Keep Current Program</option>
                                    @foreach($dietPrograms as $program)
                                        @if($program->id != $enrollment->diet_program_id)
                                            <option value="{{ $program->id }}" {{ old('diet_program_id') == $program->id ? 'selected' : '' }}>
                                                {{ $program->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Select only if you want to change the current diet program based on this checkup.</p>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('enrollments.index', $enrollment->id) }}" class="btn btn-secondary me-2">
                                <i class="ti ti-x me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i> Save Checkup
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
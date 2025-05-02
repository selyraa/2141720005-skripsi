@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-12">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        Edit Program Enrollments
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
                            Edit
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
                    <h3 class="card-title mb-4">Edit Registration Information</h3>
                    
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

                    <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-group">
                                <label class="form-label block mb-2 font-medium text-dark dark:text-white">User</label>
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-full overflow-hidden mr-3 bg-gray-200 dark:bg-gray-700 flex-shrink-0">
                                        <img src="{{ $enrollment->user->profile_photo_url ?? asset('assets/images/profile/user-1.jpg') }}" alt="User" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h6 class="font-medium text-dark dark:text-white">{{ $enrollment->user->name }}</h6>
                                        <p class="text-gray-500 text-sm">{{ $enrollment->user->email }}</p>
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" value="{{ $enrollment->user_id }}">
                            </div>

                            <div class="form-group">
                                <label for="diet_program_id" class="form-label block mb-2 font-medium text-dark dark:text-white">Diet Program <span class="text-red-500">*</span></label>
                                <select id="diet_program_id" name="diet_program_id" class="form-select w-full" required>
                                    <option value="">Select Diet Program</option>
                                    @foreach($dietPrograms as $program)
                                        <option value="{{ $program->id }}" {{ old('diet_program_id', $enrollment->diet_program_id) == $program->id ? 'selected' : '' }}>
                                            {{ $program->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status" class="form-label block mb-2 font-medium text-dark dark:text-white">Status <span class="text-red-500">*</span></label>
                                <select id="status" name="status" class="form-select w-full" required>
                                    <option value="0" {{ old('status', $enrollment->status) === 0 ? 'selected' : '' }}>On Going</option>
                                    <option value="1" {{ old('status', $enrollment->status) === 1 ? 'selected' : '' }}>Completed</option>
                                    <option value="2" {{ old('status', $enrollment->status) === 2 ? 'selected' : '' }}>Canceled</option>
                                    <option value="3" {{ old('status', $enrollment->status) === 3 ? 'selected' : '' }}>Changed</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('enrollments.index', $enrollment->id) }}" class="btn btn-secondary me-2">
                                <i class="ti ti-x me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
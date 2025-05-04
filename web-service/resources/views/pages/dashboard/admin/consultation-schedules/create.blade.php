@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.create_schedule') }}
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                {{ __('app.home') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('consultation-schedules.index') }}">
                                {{ __('app.consultation_schedules') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            {{ __('app.create_schedule') }}
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end">
                        <a href="{{ route('consultation-schedules.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-1"></i> {{ __('app.back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">{{ __('app.create_schedule_form') }}</h3>
                    
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

                    <form action="{{ route('consultation-schedules.store') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label for="program_enrollment_id" class="block text-sm font-medium mb-2 text-dark dark:text-white">
                                {{ __('app.enrollment') }} <span class="text-error">*</span>
                            </label>
                            <select name="program_enrollment_id" id="program_enrollment_id" 
                                class="form-select w-full @error('program_enrollment_id') border-error @enderror" required>
                                <option value="">-- {{ __('app.select_enrollment') }} --</option>
                                @foreach($enrollments as $enrollment)
                                    <option value="{{ $enrollment->id }}" {{ old('program_enrollment_id') == $enrollment->id ? 'selected' : '' }}>
                                        {{ $enrollment->user->name }} - {{ $enrollment->dietProgram->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('program_enrollment_id')
                                <div class="text-error text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="schedule_date" class="block text-sm font-medium mb-2 text-dark dark:text-white">
                                    {{ __('app.date') }} & {{ __('app.time') }} <span class="text-error">*</span>
                                </label>
                                <input type="datetime-local" 
                                    class="form-control w-full @error('schedule_date') border-error @enderror" 
                                    id="schedule_date" name="schedule_date" value="{{ old('schedule_date') }}" required>
                                @error('schedule_date')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium mb-2 text-dark dark:text-white">
                                    {{ __('app.status') }} <span class="text-error">*</span>
                                </label>
                                <select name="status" id="status" 
                                    class="form-select w-full @error('status') border-error @enderror" required>
                                    @foreach($statuses as $key => $value)
                                        <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="text-error text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i> {{ __('app.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
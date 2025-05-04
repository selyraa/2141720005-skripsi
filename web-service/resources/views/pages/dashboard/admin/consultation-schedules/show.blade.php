@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.schedule_details') }}
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
                            {{ __('app.schedule_details') }}
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('consultation-schedules.edit', $schedule->id) }}" class="btn btn-warning">
                            <i class="ti ti-pencil me-1"></i> {{ __('app.edit') }}
                        </a>
                        <a href="{{ route('consultation-schedules.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-1"></i> {{ __('app.back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- Customer Details -->
        <div class="col-span-12 md:col-span-4">
            <div class="card">
                <div class="card-body">
                    <div class="space-y-4">
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                            <h4 class="text-lg font-medium text-dark dark:text-white">{{ __('app.user_information') }}</h4>
                            <div class="flex items-center mt-2">
                                <div class="w-12 h-12 rounded-full overflow-hidden mr-4 bg-gray-200 dark:bg-gray-700 flex-shrink-0">
                                    <img src="{{ $schedule->programEnrollment->user->profile_photo_url ?? asset('assets/images/profile/user-1.jpg') }}" 
                                         alt="{{ __('app.user') }}" class="w-full h-full object-cover">
                                </div>
                                <div class="ml-4">
                                    <h5 class="font-medium text-dark dark:text-white">{{ $schedule->programEnrollment->user->name ?? 'N/A' }}</h5>
                                    <p class="text-gray-500 text-sm">{{ $schedule->programEnrollment->user->email ?? 'N/A' }}</p>
                                    <p class="text-gray-500 text-sm">{{ $schedule->programEnrollment->user->phone_number ?? __('app.no_phone_number') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 dark:border-gray-700 py-4">
                            <h4 class="text-lg font-medium text-dark dark:text-white">{{ __('app.program_information') }}</h4>
                            <div class="mt-2">
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    <span class="text-gray-500">{{ __('app.program') }}:</span>
                                    <span class="text-dark dark:text-white font-medium">{{ $schedule->programEnrollment->dietProgram->name ?? 'N/A' }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    <span class="text-gray-500">{{ __('app.status') }}:</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $schedule->programEnrollment->status == 0 ? 'bg-lightsuccess dark:bg-darksuccess text-success' : 'bg-lighterror dark:bg-darkerror text-error' }}">
                                        {{ $schedule->programEnrollment->status == 0 ? 'On going' : 'Completed' }}
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <span class="text-gray-500">{{ __('app.description') }}:</span>
                                    <span class="text-dark dark:text-white">{{ $schedule->programEnrollment->dietProgram->description ?? __('app.no_description') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Schedule Details -->
        <div class="col-span-12 md:col-span-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex items-center">
                        <i class="ti ti-calendar text-xl mr-2"></i> {{ __('app.schedule_details') }}
                        <span class="ml-auto text-sm bg-lightsuccess dark:bg-darksuccess text-success px-2 py-1 rounded">
                            {{ $schedule->schedule_date->format('d M Y') }}
                        </span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.date') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $schedule->schedule_date->format('d M Y') }}</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.time') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $schedule->schedule_date->format('H:i') }}</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.status') }}</div>
                            <div class="text-lg font-semibold">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium 
                                    {{ $schedule->status === 'Pending' ? 'bg-lightwarning dark:bg-darkwarning text-warning' : 
                                       ($schedule->status === 'Completed' ? 'bg-lightsuccess dark:bg-darksuccess text-success' : 
                                        'bg-lighterror dark:bg-darkerror text-error') }}">
                                    {{ $schedule->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schedule Notes -->
            <div class="card mt-6">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex items-center">
                        <i class="ti ti-notes text-xl mr-2"></i> {{ __('app.notes') }}
                    </h3>

                    <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded">
                        @if(isset($schedule->notes) && !empty($schedule->notes))
                            <p class="text-dark dark:text-white">{{ $schedule->notes }}</p>
                        @else
                            <p class="text-gray-500 italic">{{ __('app.no_notes_available') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
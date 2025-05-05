@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.program_details') }}
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                {{ __('app.home') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('diet-programs.index') }}">
                                {{ __('app.manage_diet_programs') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            {{ $dietProgram->name }}
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('diet-programs.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-1"></i> {{ __('app.back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- Program Details -->
        <div class="col-span-12 lg:col-span-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex items-center">
                        <i class="ti ti-info-circle text-xl mr-2"></i> {{ __('app.program_details') }}
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.program_name') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $dietProgram->name }}</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.description') }}</div>
                            <div class="text-dark dark:text-white">{{ $dietProgram->description ?: __('app.no_description') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Program Enrollments -->
        <div class="col-span-12 lg:col-span-7">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex items-center">
                        <i class="ti ti-users text-xl mr-2"></i> {{ __('app.program_registration') }}
                    </h3>
                    
                    <div class="overflow-x-auto">
                        @if($enrollments->count() > 0)
                            <table class="table-auto w-full text-left border-spacing-0 border-separate">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.customer') }}</th>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.status') }}</th>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enrollments as $enrollment)
                                        <tr>
                                            <td class="px-4 py-3 border-b">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 rounded-full overflow-hidden bg-gray-200 dark:bg-gray-700 flex-shrink-0 mr-3">
                                                        <img src="{{ $enrollment->user->profile_photo_url ?? asset('assets/images/profile/user-1.jpg') }}" alt="User Avatar" class="w-full h-full object-cover">
                                                    </div>
                                                    <div class="ml-4">
                                                        <p class="font-medium text-dark dark:text-white">{{ $enrollment->user->name }}</p>
                                                        <p class="text-xs text-gray-500">{{ $enrollment->user->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 border-b">
                                                {{ $enrollment->status }}
                                            </td>
                                            <td class="px-4 py-3 border-b">
                                                <a href="{{ route('enrollments.show', $enrollment->id) }}" 
                                                    class="btn btn-sm btn-outline-primary" 
                                                    title="{{ __('app.view') }}">
                                                    <i class="ti ti-eye me-1"></i> {{ __('app.view') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            @if($dietProgram->programEnrollments()->count() > 10)
                                <div class="text-center mt-4">
                                    <p class="text-sm text-gray-500">{{ __('app.showing_x_of_y_enrollments', ['x' => 10, 'y' => $dietProgram->programEnrollments()->count()]) }}</p>
                                </div>
                            @endif
                        @else
                            <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                                {{ __('app.no_enrollments_found') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
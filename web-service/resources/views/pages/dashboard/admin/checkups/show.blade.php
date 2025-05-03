@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.checkup_details') }}
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                {{ __('app.home') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('checkups.index') }}">
                                {{ __('app.customer_checkup_data') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            {{ __('app.checkup_details') }}
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end">
                        <a href="{{ route('checkups.index') }}" class="btn btn-secondary">
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
                    <h3 class="card-title mb-4 flex items-center">
                        <i class="ti ti-user-circle text-xl mr-2"></i> {{ __('app.customer_data') }}
                    </h3>
                    
                    @if($checkup->programEnrollment && $checkup->programEnrollment->user)
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.name') }}</span>
                                <span class="font-semibold text-dark dark:text-white">{{ $checkup->programEnrollment->user->name }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.email') }}</span>
                                <span class="font-semibold text-dark dark:text-white">{{ $checkup->programEnrollment->user->email }}</span>
                            </div>
                            @if($checkup->programEnrollment->user->phone_number)
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.phone_number') }}</span>
                                <span class="font-semibold text-dark dark:text-white">{{ $checkup->programEnrollment->user->phone_number }}</span>
                            </div>
                            @endif
                            @if($checkup->programEnrollment->user->gender)
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.gender') }}</span>
                                <span class="font-semibold text-dark dark:text-white">{{ $checkup->programEnrollment->user->gender == 'male' ? __('app.male') : __('app.female') }}</span>
                            </div>
                            @endif
                            @if($checkup->programEnrollment->user->birth_date)
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.birth_date') }}</span>
                                <span class="font-semibold text-dark dark:text-white">{{ \Carbon\Carbon::parse($checkup->programEnrollment->user->birth_date)->format('d M Y') }}</span>
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="p-4 bg-lighterror dark:bg-darkerror text-error rounded">
                            <p>{{ __('app.customer_data_unavailable') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Program Details -->
            <div class="card mt-6">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex items-center">
                        <i class="ti ti-clipboard-check text-xl mr-2"></i> {{ __('app.diet_program') }}
                    </h3>
                    
                    @if($checkup->programEnrollment && $checkup->programEnrollment->dietProgram)
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.program_name') }}</span>
                                <span class="font-semibold text-dark dark:text-white">{{ $checkup->programEnrollment->dietProgram->name }}</span>
                            </div>
                            @if($checkup->programEnrollment->dietProgram->description)
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.description') }}</span>
                                <span class="text-dark dark:text-white">{{ $checkup->programEnrollment->dietProgram->description }}</span>
                            </div>
                            @endif
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.program_status') }}</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $checkup->programEnrollment->status == 'On going' ? 'bg-lightsuccess dark:bg-darksuccess text-success' : 'bg-lighterror dark:bg-darkerror text-error' }}">
                                    {{ $checkup->programEnrollment->status }}
                                </span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.enrollment_date') }}</span>
                                <span class="font-semibold text-dark dark:text-white">{{ $checkup->programEnrollment->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    @else
                        <div class="p-4 bg-lighterror dark:bg-darkerror text-error rounded">
                            <p>{{ __('app.diet_program_data_unavailable') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Checkup Details -->
        <div class="col-span-12 md:col-span-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex items-center">
                        <i class="ti ti-heartbeat text-xl mr-2"></i> {{ __('app.checkup_data') }}
                        <span class="ml-auto text-sm bg-lightsuccess dark:bg-darksuccess text-success px-2 py-1 rounded">
                            {{ $checkup->checkup_date ? $checkup->checkup_date->format('d M Y') : 'N/A' }}
                        </span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.height') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $checkup->height }} <span class="text-sm font-normal">cm</span></div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.weight') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $checkup->weight }} <span class="text-sm font-normal">kg</span></div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">BMI</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">
                                {{ number_format($checkup->weight / (($checkup->height / 100) * ($checkup->height / 100)), 2) }}
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.body_fat') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $checkup->body_fat }} <span class="text-sm font-normal">%</span></div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.belly_fat') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $checkup->belly_fat }} <span class="text-sm font-normal">%</span></div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.muscle_mass') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $checkup->muscle_mass }} <span class="text-sm font-normal">kg</span></div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.calorie_needs') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $checkup->calories_needs }} <span class="text-sm font-normal">kkal</span></div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.cell_age') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $checkup->cell_age }} <span class="text-sm font-normal">{{ __('app.years') }}</span></div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.bone_density') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $checkup->bone_density }}</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.water_content') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $checkup->water_content }} <span class="text-sm font-normal">%</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkup History -->
            <div class="card mt-6">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex items-center">
                        <i class="ti ti-history text-xl mr-2"></i> {{ __('app.checkup_history') }}
                    </h3>

                    @if($userCheckups->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full text-left">
                                <thead>
                                    <tr class="bg-gray-50 dark:bg-gray-800">
                                        <th class="px-4 py-2">{{ __('app.date') }}</th>
                                        <th class="px-4 py-2">{{ __('app.weight') }}</th>
                                        <th class="px-4 py-2">{{ __('app.body_fat') }}</th>
                                        <th class="px-4 py-2">{{ __('app.muscle_mass') }}</th>
                                        <th class="px-4 py-2">{{ __('app.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userCheckups as $item)
                                    <tr class="{{ $item->id === $checkup->id ? 'bg-lightprimary/10 dark:bg-darkprimary/10' : '' }}">
                                        <td class="border-b px-4 py-2">{{ $item->checkup_date ? $item->checkup_date->format('d M Y') : 'N/A' }}</td>
                                        <td class="border-b px-4 py-2">{{ $item->weight }} kg</td>
                                        <td class="border-b px-4 py-2">{{ $item->body_fat }}%</td>
                                        <td class="border-b px-4 py-2">{{ $item->muscle_mass }} kg</td>
                                        <td class="border-b px-4 py-2">
                                            <a href="{{ route('checkups.show', $item->id) }}" class="btn btn-sm btn-primary {{ $item->id === $checkup->id ? 'opacity-50 cursor-not-allowed' : '' }}"
                                               {{ $item->id === $checkup->id ? 'disabled' : '' }}>
                                                <i class="ti ti-eye"></i> {{ __('app.details') }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4 bg-lighterror dark:bg-darkerror text-error rounded">
                            <p>{{ __('app.no_checkup_history') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
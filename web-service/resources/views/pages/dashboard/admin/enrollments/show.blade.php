@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.enrollment_details') }}
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                {{ __('app.home') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('enrollments.index') }}">
                                {{ __('app.program_registration') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            {{ __('app.details') }}
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btn btn-info">
                            <i class="ti ti-edit me-1"></i> {{ __('app.edit') }}
                        </a>
                        <a href="{{ route('enrollments.create-checkup', $enrollment->id) }}" class="btn btn-success">
                            <i class="ti ti-heartbeat me-1"></i> {{ __('app.new_checkup') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- Registration Information -->
        <div class="col-span-12 md:col-span-4">
            <div class="card">
                <div class="card-body">
                    {{-- <h3 class="card-title mb-4">{{ __('app.registration_information') }}</h3> --}}
                    
                    @if(session('success'))
                        <div class="bg-lightsuccess dark:bg-darksuccess text-success px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                                <i class="ti ti-x"></i>
                            </button>
                        </div>
                    @endif

                    <div class="space-y-4">
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                            <h4 class="text-lg font-medium text-dark dark:text-white">{{ __('app.user_information') }}</h4>
                            <div class="flex items-center mt-2">
                                <div class="w-12 h-12 rounded-full overflow-hidden mr-4 bg-gray-200 dark:bg-gray-700 flex-shrink-0">
                                    <img src="{{ $enrollment->user->profile_photo_url ?? asset('assets/images/profile/user-1.jpg') }}" alt="{{ __('app.user') }}" class="w-full h-full object-cover">
                                </div>
                                <div class="ml-4">
                                    <h5 class="font-medium text-dark dark:text-white">{{ $enrollment->user->name ?? 'N/A' }}</h5>
                                    <p class="text-gray-500 text-sm">{{ $enrollment->user->email ?? 'N/A' }}</p>
                                    <p class="text-gray-500 text-sm">{{ $enrollment->user->phone_number ?? __('app.no_phone_number') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 dark:border-gray-700 py-4">
                            <h4 class="text-lg font-medium text-dark dark:text-white">{{ __('app.program_information') }}</h4>
                            <div class="mt-2">
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    <span class="text-gray-500">{{ __('app.program') }}:</span>
                                    <span class="text-dark dark:text-white font-medium">{{ $enrollment->dietProgram->name ?? 'N/A' }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    <span class="text-gray-500">{{ __('app.status') }}:</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $enrollment->status == 'On going' ? 'bg-lightsuccess dark:bg-darksuccess text-success' : 'bg-lighterror dark:bg-darkerror text-error' }}">
                                        {{ $enrollment->status }}
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    <span class="text-gray-500">{{ __('app.enrollment_date') }}:</span>
                                    <span class="text-dark dark:text-white">{{ $enrollment->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <span class="text-gray-500">{{ __('app.description') }}:</span>
                                    <span class="text-dark dark:text-white">{{ $enrollment->dietProgram->description ?? __('app.no_description') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Checkup Data -->
        <div class="col-span-12 md:col-span-8">
            <div class="card">
                <div class="card-body">
                    <div id="checkup-history-header">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="card-title">{{ __('app.checkup_history') }}</h3>
                        </div>
                    </div>
                    
                    <!-- Checkup History Table View -->
                    <div id="checkup-history-table" class="{{ $enrollment->checkup()->count() === 0 ? '' : '' }}">
                        @if($enrollment->checkup()->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full text-left border-spacing-0 border-separate">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.date') }}</th>
                                            <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.height') }}</th>
                                            <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.weight') }}</th>
                                            <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.body_fat') }}</th>
                                            <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($enrollment->checkup()->latest('checkup_date')->get() as $checkup)
                                            <tr>
                                                <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                    {{ $checkup->checkup_date->format('d M Y') }}
                                                </td>
                                                <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                    {{ $checkup->height }} <span class="text-xs text-gray-500">{{ __('app.cm') }}</span>
                                                </td>
                                                <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                    {{ $checkup->weight }} <span class="text-xs text-gray-500">{{ __('app.kg') }}</span>
                                                </td>
                                                <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                    {{ $checkup->body_fat }}%
                                                </td>
                                                <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                    <div class="flex gap-2">
                                                        <button type="button" 
                                                            class="btn btn-sm btn-primary view-details-btn" 
                                                            data-checkup-id="{{ $checkup->id }}">
                                                            <i class="ti ti-eye"></i> {{ __('app.details') }}
                                                        </button>
                                                        <a href="{{ route('diet-recommendations.create.checkup', $checkup->id) }}" 
                                                            class="btn btn-sm btn-success">
                                                            <i class="ti ti-message-2"></i> {{ __('app.generate_recommendation') }}
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-gray-500 p-4">{{ __('app.no_checkup_data') }}</div>
                        @endif
                    </div>
                    
                    <!-- Checkup Details View (Initially Hidden) -->
                    <div id="checkup-details-view" class="hidden">
                        <div class="flex justify-between items-center mb-4">
                            <button id="back-to-history" class="btn btn-sm btn-secondary">
                                <i class="ti ti-arrow-left mr-1"></i> {{ __('app.back_to_history') }}
                            </button>
                            <h4 id="checkup-date-title" class="text-lg font-semibold text-dark dark:text-white"></h4>
                        </div>
                        
                        <div id="checkup-details-content" class="pt-2">
                            <!-- Checkup details content will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Store checkup data for details view
        const checkupData = {
            @foreach($enrollment->checkup()->latest('checkup_date')->get() as $checkup)
                {{ $checkup->id }}: {
                    date: "{{ $checkup->checkup_date->format('d M Y') }}",
                    height: "{{ $checkup->height }}",
                    weight: "{{ $checkup->weight }}",
                    bodyFat: "{{ $checkup->body_fat }}",
                    bellyFat: "{{ $checkup->belly_fat }}",
                    muscleMass: "{{ $checkup->muscle_mass }}",
                    boneDensity: "{{ $checkup->bone_density }}",
                    caloriesNeeds: "{{ $checkup->calories_needs }}",
                    cellAge: "{{ $checkup->cell_age }}",
                    waterContent: "{{ $checkup->water_content }}"
                },
            @endforeach
        };
        
        // DOM elements
        const historyTableView = document.getElementById('checkup-history-table');
        const detailsView = document.getElementById('checkup-details-view');
        const detailsContent = document.getElementById('checkup-details-content');
        const dateTitle = document.getElementById('checkup-date-title');
        const backButton = document.getElementById('back-to-history');
        
        // Set up event listeners for detail buttons
        document.querySelectorAll('.view-details-btn').forEach(button => {
            button.addEventListener('click', function() {
                const checkupId = this.getAttribute('data-checkup-id');
                showCheckupDetails(checkupId);
            });
        });
        
        // Set up back button
        backButton.addEventListener('click', function() {
            showCheckupHistory();
        });
        
        // Function to show checkup details view
        function showCheckupDetails(checkupId) {
            const data = checkupData[checkupId];
            
            if (data) {
                // Update header with date
                dateTitle.textContent = `{{ __('app.checkup_details') }} - ${data.date}`;
                
                // Create details view content
                let content = `
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">{{ __('app.height') }}</h5>
                            <p class="text-xl font-bold text-primary">${data.height} <span class="text-sm text-gray-500">{{ __('app.cm') }}</span></p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">{{ __('app.weight') }}</h5>
                            <p class="text-xl font-bold text-primary">${data.weight} <span class="text-sm text-gray-500">{{ __('app.kg') }}</span></p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">{{ __('app.body_fat') }}</h5>
                            <p class="text-xl font-bold text-primary">${data.bodyFat}%</p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">{{ __('app.belly_fat') }}</h5>
                            <p class="text-xl font-bold text-primary">${data.bellyFat}%</p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">{{ __('app.muscle_mass') }}</h5>
                            <p class="text-xl font-bold text-primary">${data.muscleMass}%</p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">{{ __('app.bone_density') }}</h5>
                            <p class="text-xl font-bold text-primary">${data.boneDensity}</p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">{{ __('app.calorie_needs') }}</h5>
                            <p class="text-xl font-bold text-primary">${data.caloriesNeeds} <span class="text-sm text-gray-500">kcal</span></p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">{{ __('app.cell_age') }}</h5>
                            <p class="text-xl font-bold text-primary">${data.cellAge} <span class="text-sm text-gray-500">{{ __('app.years') }}</span></p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">{{ __('app.water_content') }}</h5>
                            <p class="text-xl font-bold text-primary">${data.waterContent}%</p>
                        </div>
                    </div>
                `;
                
                // Add diet prediction results if available
                @foreach($enrollment->checkup()->latest('checkup_date')->get() as $checkup)
                    if ({{ $checkup->id }} == checkupId && {{ $checkup->dietPrediction ? 'true' : 'false' }}) {
                        content += `
                            <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="text-lg font-semibold text-dark dark:text-white mb-4">{{ __('app.diet_program_prediction') }}</h4>
                                <div class="space-y-4">
                                    @if($checkup->dietPrediction && $checkup->dietPrediction->predictionResults->count() > 0)
                                        @foreach($checkup->dietPrediction->predictionResults as $result)
                                            <div class="flex items-center">
                                                <span class="w-1/3">{{ $result->dietProgram->name }}</span>
                                                <div class="w-2/3 flex items-center">
                                                    <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700 mr-4">
                                                        <div class="bg-primary h-4 rounded-full" style="width: {{ $result->confidence_score * 100 }}%"></div>
                                                    </div>
                                                    <span class="mr-2">{{ number_format($result->confidence_score * 100, 1) }}%</span>
                                                    @if($result->is_selected)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            {{ __('app.selected') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-gray-500">{{ __('app.no_prediction_results') }}</p>
                                    @endif
                                </div>
                            </div>
                        `;
                    }
                @endforeach
                
                // Update content and show details view
                detailsContent.innerHTML = content;
                historyTableView.classList.add('hidden');
                detailsView.classList.remove('hidden');
            }
        }
        
        // Function to show checkup history view
        function showCheckupHistory() {
            historyTableView.classList.remove('hidden');
            detailsView.classList.add('hidden');
        }
    });
</script>
@endpush
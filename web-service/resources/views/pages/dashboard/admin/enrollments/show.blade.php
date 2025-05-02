@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        Program Enrollments Details
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
                            Details
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btn btn-info">
                            <i class="ti ti-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('enrollments.create-checkup', $enrollment->id) }}" class="btn btn-success">
                            <i class="ti ti-heartbeat me-1"></i> New Checkup
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
                    <h3 class="card-title mb-4">Registration Information</h3>
                    
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
                            <h4 class="text-lg font-medium text-dark dark:text-white">User Information</h4>
                            <div class="flex items-center mt-2">
                                <div class="w-12 h-12 rounded-full overflow-hidden mr-4 bg-gray-200 dark:bg-gray-700 flex-shrink-0">
                                    <img src="{{ $enrollment->user->profile_photo_url ?? asset('assets/images/profile/user-1.jpg') }}" alt="User" class="w-full h-full object-cover">
                                </div>
                                <div class="ml-4">
                                    <h5 class="font-medium text-dark dark:text-white">{{ $enrollment->user->name ?? 'N/A' }}</h5>
                                    <p class="text-gray-500 text-sm">{{ $enrollment->user->email ?? 'N/A' }}</p>
                                    <p class="text-gray-500 text-sm">{{ $enrollment->user->phone_number ?? 'No Phone Number' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 dark:border-gray-700 py-4">
                            <h4 class="text-lg font-medium text-dark dark:text-white">Program Information</h4>
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
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    <span class="text-gray-500">Registration Date:</span>
                                    <span class="text-dark dark:text-white">{{ $enrollment->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <span class="text-gray-500">Description:</span>
                                    <span class="text-dark dark:text-white">{{ $enrollment->dietProgram->description ?? 'No Description' }}</span>
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
                            <h3 class="card-title">Checkup History</h3>
                        </div>
                    </div>
                    
                    <!-- Checkup History Table View -->
                    <div id="checkup-history-table" class="{{ $enrollment->checkup()->count() === 0 ? '' : '' }}">
                        @if($enrollment->checkup()->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full text-left border-spacing-0 border-separate">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Date</th>
                                            <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Height</th>
                                            <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Weight</th>
                                            <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Body Fat</th>
                                            <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($enrollment->checkup()->latest('checkup_date')->get() as $checkup)
                                            <tr>
                                                <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                    {{ $checkup->checkup_date->format('d M Y') }}
                                                </td>
                                                <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                    {{ $checkup->height }} <span class="text-xs text-gray-500">cm</span>
                                                </td>
                                                <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                    {{ $checkup->weight }} <span class="text-xs text-gray-500">kg</span>
                                                </td>
                                                <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                    {{ $checkup->body_fat }}%
                                                </td>
                                                <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                    <button type="button" 
                                                        class="btn btn-sm btn-primary view-details-btn" 
                                                        data-checkup-id="{{ $checkup->id }}">
                                                        <i class="ti ti-eye"></i> Details
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-gray-500 p-4">No checkup data available</div>
                        @endif
                    </div>
                    
                    <!-- Checkup Details View (Initially Hidden) -->
                    <div id="checkup-details-view" class="hidden">
                        <div class="flex justify-between items-center mb-4">
                            <button id="back-to-history" class="btn btn-sm btn-secondary">
                                <i class="ti ti-arrow-left mr-1"></i> Back to History
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
                dateTitle.textContent = `Checkup Details - ${data.date}`;
                
                // Create details view content
                let content = `
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">Height</h5>
                            <p class="text-xl font-bold text-primary">${data.height} <span class="text-sm text-gray-500">cm</span></p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">Weight</h5>
                            <p class="text-xl font-bold text-primary">${data.weight} <span class="text-sm text-gray-500">kg</span></p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">Body Fat</h5>
                            <p class="text-xl font-bold text-primary">${data.bodyFat}%</p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">Belly Fat</h5>
                            <p class="text-xl font-bold text-primary">${data.bellyFat}%</p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">Muscle Mass</h5>
                            <p class="text-xl font-bold text-primary">${data.muscleMass}%</p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">Bone Density</h5>
                            <p class="text-xl font-bold text-primary">${data.boneDensity}</p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">Calories Needs</h5>
                            <p class="text-xl font-bold text-primary">${data.caloriesNeeds} <span class="text-sm text-gray-500">kcal</span></p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">Cell Age</h5>
                            <p class="text-xl font-bold text-primary">${data.cellAge} <span class="text-sm text-gray-500">years</span></p>
                        </div>
                        
                        <div class="space-y-1">
                            <h5 class="font-medium text-dark dark:text-white">Water Content</h5>
                            <p class="text-xl font-bold text-primary">${data.waterContent}%</p>
                        </div>
                    </div>
                `;
                
                // Add diet prediction results if available
                @foreach($enrollment->checkup()->latest('checkup_date')->get() as $checkup)
                    if ({{ $checkup->id }} == checkupId && {{ $checkup->dietPrediction ? 'true' : 'false' }}) {
                        content += `
                            <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="text-lg font-semibold text-dark dark:text-white mb-4">Diet Program Prediction</h4>
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
                                                            Selected
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-gray-500">No prediction results available.</p>
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
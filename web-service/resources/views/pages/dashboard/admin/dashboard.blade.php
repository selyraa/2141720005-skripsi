@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="w-full px-5 py-5">
        <div class="grid grid-cols-12 gap-6">
            <!---Top Cards--->
            <div class="col-span-12">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="card mb-0 shadow-none bg-lightprimary dark:bg-darkprimary w-full">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="flex justify-center">
                                    <img src="./assets/images/svgs/icon-user-male.svg" width="40" height="40"
                                        class="mb-3" alt>
                                </div>
                                <p class="font-semibold text-primary mb-1">{{ __('app.customer_count') }}</p>
                                <h5 class="text-lg font-semibold text-primary mb-0">{{ $customerCount }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-0 shadow-none bg-lightwarning dark:bg-darkwarning w-full">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="flex justify-center">
                                    <img src="./assets/images/svgs/icon-briefcase.svg" width="40" height="40"
                                        class="mb-3" alt>
                                </div>
                                <p class="font-semibold text-blue mb-1">{{ __('app.weight_gain_count_program') }}</p>
                                <h5 class="text-lg font-semibold text-blue mb-0">{{ $weightGainCount }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-0 shadow-none bg-lightinfo dark:bg-darkinfo w-full">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="flex justify-center">
                                    <img src="./assets/images/svgs/icon-mailbox.svg" width="40" height="40"
                                        class="mb-3" alt>
                                </div>
                                <p class="font-semibold text-info mb-1">{{ __('app.weight_loss_count_program') }}</p>
                                <h5 class="text-lg font-semibold text-info mb-0">{{ $weightLossCount }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-0 shadow-none bg-lighterror dark:bg-darkerror w-full transition duration-300 hover:shadow-lg">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="flex justify-center">
                                    <img src="./assets/images/svgs/icon-favorites.svg" width="40" height="40"
                                        class="mb-3" alt>
                                </div>
                                <p class="font-semibold text-error mb-1">{{ __('app.fat_loss_count_program') }}</p>
                                <h5 class="text-lg font-semibold text-error mb-0">{{ $fatLossCount }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---Top Cards End--->

            <!---Diet Program Statistics Cards--->
            <div class="lg:col-span-12 col-span-12">
                <div class="grid grid-cols-12 gap-6">
                    <!---Diet Program Distribution Pie Chart--->
                    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('app.diet_program_distribution') }}</h5>
                                <p class="card-subtitle">{{ __('app.percentage_of_programs_followed') }}</p>
                                <div id="diet-program-chart" class="my-8"
                                    data-weight-gain="{{ $weightGainCount }}"
                                    data-weight-loss="{{ $weightLossCount }}"
                                    data-fat-loss="{{ $fatLossCount }}"></div>
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div class="flex items-center">
                                        <span class="h-3 w-3 bg-success rounded-full mr-2"></span>
                                        <span class="text-sm">{{ __('app.weight_gain_program') }} ({{ $weightGainCount }})</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="h-3 w-3 bg-warning rounded-full mr-2"></span>
                                        <span class="text-sm">{{ __('app.weight_loss_program') }} ({{ $weightLossCount }})</span>
                                    </div>
                                    <div class="flex items-center col-span-2">
                                        <span class="h-3 w-3 bg-info rounded-full mr-2"></span>
                                        <span class="text-sm">{{ __('app.fat_loss_program') }} ({{ $fatLossCount }})</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---Diet Program Distribution Pie Chart End--->
                    
                    <!---BMI Distribution Chart--->
                    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('app.bmi_distribution') ?? 'BMI Distribution' }}</h5>
                                <p class="card-subtitle">{{ __('app.customer_bmi_categories') ?? 'Customer distribution across BMI categories' }}</p>
                                <div id="bmi-distribution-chart" class="my-8"
                                    data-underweight="{{ $bmiDistribution['underweight'] }}"
                                    data-normal="{{ $bmiDistribution['normal'] }}"
                                    data-overweight="{{ $bmiDistribution['overweight'] }}"
                                    data-obese="{{ $bmiDistribution['obese'] }}"></div>
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div class="flex items-center">
                                        <span class="h-3 w-3 bg-info rounded-full mr-2"></span>
                                        <span class="text-sm">{{ __('app.underweight') ?? 'Underweight' }} (<18.5): {{ $bmiDistribution['underweight'] }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="h-3 w-3 bg-success rounded-full mr-2"></span>
                                        <span class="text-sm">{{ __('app.normal') ?? 'Normal' }} (18.5-24.9): {{ $bmiDistribution['normal'] }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="h-3 w-3 bg-warning rounded-full mr-2"></span>
                                        <span class="text-sm">{{ __('app.overweight') ?? 'Overweight' }} (25-29.9): {{ $bmiDistribution['overweight'] }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="h-3 w-3 bg-error rounded-full mr-2"></span>
                                        <span class="text-sm">{{ __('app.obese') ?? 'Obese' }} (>30): {{ $bmiDistribution['obese'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---BMI Distribution Chart End--->
                </div>
            </div>
            <!---Diet Program Statistics Cards End--->
            
            <!---Average Customer Weight Trend--->
            <div class="lg:col-span-12 col-span-12">
                <div class="grid grid-cols-12 gap-6">
                    <div class="lg:col-span-12 md:col-span-12 sm:col-span-12 col-span-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('app.weight_trend_by_program') }}</h5>
                                <p class="card-subtitle">{{ __('app.customer_weight_trend') }}</p>
                                <div class="flex flex-wrap gap-4 mb-4 mt-4">
                                    <div class="w-full md:w-1/3 lg:w-1/4">
                                        <label for="programFilter" class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.filter_by_program') }}</label>
                                        <select id="programFilter" class="form-select">
                                            <option value="all">{{ __('app.all_programs') }}</option>
                                            <option value="weightGain">{{ __('app.weight_gain_program') }}</option>
                                            <option value="weightLoss">{{ __('app.weight_loss_program') }}</option>
                                            <option value="fatLoss">{{ __('app.fat_loss_program') }}</option>
                                        </select>
                                    </div>
                                    <div class="w-full md:w-1/3 lg:w-1/4">
                                        <label for="customerFilter" class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.select_customer') }}</label>
                                        <select id="customerFilter" class="form-select">
                                            <option value="all">{{ __('app.all_customers') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="weight-trend-chart" class="my-4"
                                    data-dates='{{ json_encode($weightTrendData['dates']) }}'
                                    data-weight-gain='{{ json_encode($weightTrendData['weightGainData']) }}'
                                    data-weight-loss='{{ json_encode($weightTrendData['weightLossData']) }}'
                                    data-fat-loss='{{ json_encode($weightTrendData['fatLossData']) }}'
                                    data-customer-data='{{ json_encode($weightTrendData['customerData']) }}'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---Average Customer Weight Trend End--->
            
            <!---Progress & Body Composition Charts--->
            <div class="lg:col-span-12 col-span-12">
                <div class="grid grid-cols-12 gap-6">
                    <!---Program Success Rate Chart--->
                    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('app.program_status_distribution') ?? 'Program Status Distribution' }}</h5>
                                <p class="card-subtitle">{{ __('app.program_status_summary') ?? 'Summary of program enrollment statuses' }}</p>
                                <div id="program-status-chart" class="my-8"
                                     data-labels='{{ json_encode($programStatusLabels) }}'
                                     data-values='{{ json_encode($programStatusData) }}'></div>
                            </div>
                        </div>
                    </div>
                    <!---Program Success Rate Chart End--->
                    
                    <!---Body Composition Chart--->
                    <div class="lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('app.body_composition_changes') ?? 'Body Composition Changes' }}</h5>
                                <p class="card-subtitle">{{ __('app.average_changes_after_programs') ?? 'Average changes after program completion' }}</p>
                                <div id="body-composition-chart" class="my-8"></div>
                            </div>
                        </div>
                    </div>
                    <!---Body Composition Chart End--->
                </div>
            </div>
            <!---Progress & Body Composition Charts End--->
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards/diet-charts/dashboard-diet-charts.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards/diet-charts/dashboard-additional-charts.js') }}"></script>
@endpush

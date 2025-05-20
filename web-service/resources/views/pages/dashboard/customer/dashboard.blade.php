@extends('pages.dashboard.admin.layouts.app')

@section('title', 'Dashboard Pelanggan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/recommendation-preview.css') }}">
@endpush

@section('content')
    <div class="w-full px-5 py-5">
        <!-- Welcome Header Card -->
        <div
            class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
            <div class="card-body md:py-3 py-5">
                <div class="flex items-center grid grid-cols-12 gap-6">
                    <div class="col-span-9">
                        <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                            Selamat Datang, {{ $userInfo['name'] }}
                        </h4>
                        <p class="text-gray-600">Program Diet Anda: <span
                                class="font-semibold text-primary">{{ $programName }}</span></p>
                    </div>
                    <div class="col-span-3">
                        <div class="bg-lightprimary dark:bg-darkprimary px-4 py-3 rounded-lg text-center">
                            <p class="font-semibold text-primary">Mengikuti Program</p>
                            <h5 class="text-xl font-bold text-primary mb-0">{{ $daysInProgram }} hari</h5>
                            @if ($registrationDate)
                                <p class="text-xs text-gray-600 mt-1">Terdaftar sejak:
                                    {{ $registrationDate->format('d M Y') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overview Stats Cards -->
        <div class="grid grid-cols-12 gap-6 mb-6">
            <!-- Current Weight Card -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3">
                <div class="card mb-0 shadow-none bg-lightprimary dark:bg-darkprimary w-full">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="flex justify-center">
                                <img src="/assets/images/svgs/icon-user-male.svg" width="40" height="40"
                                    class="mb-3" alt="">
                            </div>
                            <p class="font-semibold text-primary mb-1">Berat Badan Terkini</p>
                            <h5 class="text-lg font-semibold text-primary mb-0">
                                {{ $currentWeight ? number_format($currentWeight, 1) . ' kg' : '-- kg' }}</h5>
                            @if ($weightChange !== null)
                                <div class="flex justify-center mt-2">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $weightChange > 0 ? 'bg-lightsuccess text-success' : 'bg-lighterror text-error' }}">
                                        {{ $weightChange > 0 ? '+' : '' }}{{ number_format($weightChange, 1) }} kg
                                        ({{ $weightChange > 0 ? '+' : '' }}{{ $weightChangePercent }}%)
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Starting Weight Card -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3">
                <div class="card mb-0 shadow-none bg-lightblue dark:bg-darkblue w-full">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="flex justify-center">
                                <img src="/assets/images/svgs/icon-briefcase.svg" width="40" height="40"
                                    class="mb-3" alt="">
                            </div>
                            <p class="font-semibold text-blue mb-1">Berat Badan Awal</p>
                            <h5 class="text-lg font-semibold text-blue mb-0">
                                {{ $firstCheckupWeight ? number_format($firstCheckupWeight, 1) . ' kg' : '-- kg' }}</h5>
                            <p class="text-xs text-gray-600 mt-2">Pemeriksaan pertama</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BMI Card -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3">
                <div class="card mb-0 shadow-none bg-lightinfo dark:bg-darkinfo w-full">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="flex justify-center">
                                <img src="/assets/images/svgs/icon-mailbox.svg" width="40" height="40" class="mb-3"
                                    alt="">
                            </div>
                            <p class="font-semibold text-info mb-1">BMI</p>
                            <h5 class="text-lg font-semibold text-info mb-0">
                                {{ $bmiValue ? number_format($bmiValue, 1) : '--' }}</h5>
                            @if ($bmiCategory)
                                <div class="flex justify-center mt-2">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                        {{ $bmiCategory == 'underweight' ? 'bg-lightinfo text-info' : '' }}
                                        {{ $bmiCategory == 'normal' ? 'bg-lightsuccess text-success' : '' }}
                                        {{ $bmiCategory == 'overweight' ? 'bg-lightwarning text-warning' : '' }}
                                        {{ $bmiCategory == 'obese' ? 'bg-lighterror text-error' : '' }}">
                                        @if ($bmiCategory == 'underweight')
                                            Berat Badan Kurang
                                        @elseif($bmiCategory == 'normal')
                                            Berat Badan Normal
                                        @elseif($bmiCategory == 'overweight')
                                            Kelebihan Berat Badan
                                        @elseif($bmiCategory == 'obese')
                                            Obesitas
                                        @endif
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calorie Needs Card -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3">
                <div class="card mb-0 shadow-none bg-lightsuccess dark:bg-darksuccess w-full">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="flex justify-center">
                                <img src="/assets/images/svgs/icon-favorites.svg" width="40" height="40"
                                    class="mb-3" alt="">
                            </div>
                            <p class="font-semibold text-success mb-1">Kebutuhan Kalori</p>
                            <h5 class="text-lg font-semibold text-success mb-0">
                                {{ $latestNutritionData['calories_needs'] ? number_format($latestNutritionData['calories_needs']) . ' kkal' : '-- kkal' }}
                            </h5>
                            <p class="text-xs text-gray-600 mt-2">Berdasarkan data pemeriksaan terakhir</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="grid grid-cols-12 gap-6">
            <!-- Left Column - Large Charts and Summary -->
            <div class="lg:col-span-8 col-span-12">
                <!-- Weight Trend Chart -->
                <div class="card mb-6">
                    <div class="card-body">
                        <h5 class="card-title">Tren Berat Badan</h5>
                        <p class="card-subtitle">Progres berat badan Anda selama mengikuti program</p>
                        @if (count($weightTrendData['dates']) > 0)
                            <div class="card-body p-4 border rounded-lg bg-light/5 mt-5 mb-3">
                                <div id="weight-trend-chart" class="my-4"
                                    data-dates='{{ json_encode($weightTrendData['dates']) }}'
                                    data-weights='{{ json_encode($weightTrendData['weights']) }}'>
                                </div>
                                <div class="flex justify-center mt-2">
                                    <div class="flex items-center">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2"
                                            style="background-color: var(--color-primary);"></span>
                                        <span class="text-xs font-medium">Berat Badan (kg)</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center justify-center h-80 bg-gray-50 dark:bg-gray-800 rounded-lg my-8">
                                <div class="text-center">
                                    <i class="ti ti-chart-line text-gray-400 text-4xl mb-3"></i>
                                    <p class="text-gray-500 dark:text-gray-400">Belum ada data tren berat badan.</p>
                                    <p class="text-xs text-gray-400 mt-2">Data akan ditampilkan setelah beberapa kali
                                        pemeriksaan.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Body Composition Chart -->
                <div class="card mb-6">
                    <div class="card-body">
                        <h5 class="card-title">Komposisi Tubuh</h5>
                        <p class="card-subtitle">Perubahan komposisi tubuh selama mengikuti program</p>
                        @if (count($bodyCompositionData['dates']) > 0)
                            <div class="card-body p-4 border rounded-lg bg-light/5 mt-5 mb-3">
                                <div id="body-composition-chart" class="my-4" style="min-height: 350px;"
                                    data-dates='{{ json_encode($bodyCompositionData['dates']) }}'
                                    data-body-fat='{{ json_encode($bodyCompositionData['bodyFat']) }}'
                                    data-belly-fat='{{ json_encode($bodyCompositionData['bellyFat']) }}'
                                    data-muscle-mass='{{ json_encode($bodyCompositionData['muscleMass']) }}'>
                                </div>
                                <div class="grid grid-cols-3 gap-3 mt-2">
                                    <div class="flex items-center justify-center">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2"
                                            style="background-color: #EC4899;"></span>
                                        <span class="text-xs font-medium">Lemak Tubuh (%)</span>
                                    </div>
                                    <div class="flex items-center justify-center">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2"
                                            style="background-color: #F97316;"></span>
                                        <span class="text-xs font-medium">Lemak Perut (%)</span>
                                    </div>
                                    <div class="flex items-center justify-center">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2"
                                            style="background-color: #10B981;"></span>
                                        <span class="text-xs font-medium">Massa Otot (kg)</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center justify-center h-60 bg-gray-50 dark:bg-gray-800 rounded-lg my-8">
                                <div class="text-center">
                                    <i class="ti ti-chart-pie text-gray-400 text-4xl mb-3"></i>
                                    <p class="text-gray-500 dark:text-gray-400">Belum ada data komposisi tubuh.</p>
                                    <p class="text-xs text-gray-400 mt-2">Data akan ditampilkan setelah pemeriksaan
                                        komposisi tubuh.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Checkup History -->
                <div class="card mb-6">
                    <div class="card-body">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h5 class="card-title">Riwayat Pemeriksaan</h5>
                                <p class="card-subtitle">Data pemeriksaan kesehatan Anda</p>
                            </div>
                            @if ($totalCheckups > 0)
                                <span class="bg-lightprimary text-primary text-xs px-3 py-1 rounded-full">Terakhir:
                                    {{ $checkups->last()->checkup_date->format('d M Y') }}</span>
                            @endif
                        </div>

                        @if (count($checkups) > 0)
                            <div class="overflow-x-auto mt-4 pb-2" style="max-width: 100%;">
                                <table class="table-bordered table-striped w-full">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="px-4 py-3 border-b text-left font-semibold text-sm">Tanggal</th>
                                            <th class="px-4 py-3 border-b text-left font-semibold text-sm">Berat (kg)</th>
                                            <th class="px-4 py-3 border-b text-left font-semibold text-sm">Tinggi (cm)</th>
                                            <th class="px-4 py-3 border-b text-left font-semibold text-sm">BMI</th>
                                            <th class="px-4 py-3 border-b text-left font-semibold text-sm">Lemak Tubuh (%)
                                            </th>
                                            <th class="px-4 py-3 border-b text-left font-semibold text-sm">Lemak Perut (%)
                                            </th>
                                            <th class="px-4 py-3 border-b text-left font-semibold text-sm">Massa Otot (kg)
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($checkups->sortByDesc('checkup_date') as $checkup)
                                            <tr class="hover:bg-light">
                                                <td class="px-4 py-3 border-b text-sm whitespace-nowrap">
                                                    {{ $checkup->checkup_date->format('d M Y') }}</td>
                                                <td class="px-4 py-3 border-b text-sm font-semibold whitespace-nowrap">
                                                    {{ number_format($checkup->weight, 1) }}</td>
                                                <td class="px-4 py-3 border-b text-sm whitespace-nowrap">
                                                    {{ number_format($checkup->height, 1) }}</td>
                                                <td class="px-4 py-3 border-b text-sm whitespace-nowrap">
                                                    {{ number_format($checkup->calculateBmi(), 1) }}</td>
                                                <td class="px-4 py-3 border-b text-sm whitespace-nowrap">
                                                    {{ $checkup->body_fat ? number_format($checkup->body_fat, 1) : '-' }}
                                                </td>
                                                <td class="px-4 py-3 border-b text-sm whitespace-nowrap">
                                                    {{ $checkup->belly_fat ? number_format($checkup->belly_fat, 1) : '-' }}
                                                </td>
                                                <td class="px-4 py-3 border-b text-sm whitespace-nowrap">
                                                    {{ $checkup->muscle_mass ? number_format($checkup->muscle_mass, 1) : '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-lg text-center mt-4">
                                <i class="ti ti-clipboard-list text-gray-400 text-4xl mb-3"></i>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada data pemeriksaan.</p>
                                <p class="text-sm text-gray-400 dark:text-gray-500 mt-3">Silakan hubungi ahli gizi untuk
                                    melakukan pemeriksaan.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column - User Profile and Tips -->
            <div class="lg:col-span-4 col-span-12">
                <!-- User Profile Summary -->
                {{-- <div class="card mb-6">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Pribadi</h5>
                        <p class="card-subtitle">Data profil Anda</p>

                        <div class="flex flex-col space-y-4 mt-8">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-full bg-lightprimary dark:bg-darkprimary flex items-center justify-center mr-3">
                                    <i class="ti ti-user text-primary"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Nama</p>
                                    <p class="text-base font-medium text-dark dark:text-white">{{ $userInfo['name'] }}</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-full bg-lightinfo dark:bg-darkinfo flex items-center justify-center mr-3">
                                    <i class="ti ti-ruler text-info"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Tinggi Badan</p>
                                    <p class="text-base font-medium text-dark dark:text-white">
                                        {{ $userInfo['height'] ? number_format($userInfo['height'], 1) . ' cm' : 'Belum diukur' }}
                                    </p>
                                </div>
                            </div>

                            @if ($userInfo['gender'])
                                <div class="flex items-center">
                                    <div
                                        class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                                        <p class="text-base font-medium text-gray-900">
                                            {{ $userInfo['gender'] == 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($userInfo['age'])
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Umur</p>
                                        <p class="text-base font-medium text-gray-900">{{ $userInfo['age'] }} tahun</p>
                                    </div>
                                </div>
                            @endif

                            @if ($latestNutritionData['calories_needs'])
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Kebutuhan Kalori</p>
                                        <p class="text-base font-medium text-gray-900">
                                            {{ number_format($latestNutritionData['calories_needs']) }} kkal/hari</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if ($bmiCategory)
                            <div class="mt-6 pt-6 border-t">
                                <h4 class="text-sm font-semibold text-gray-700 mb-2">Status BMI</h4>

                                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                                    <div
                                        class="h-2.5 rounded-full 
                                        {{ $bmiCategory == 'underweight' ? 'bg-blue-600 w-1/4' : '' }}
                                        {{ $bmiCategory == 'normal' ? 'bg-green-600 w-2/4' : '' }}
                                        {{ $bmiCategory == 'overweight' ? 'bg-yellow-600 w-3/4' : '' }}
                                        {{ $bmiCategory == 'obese' ? 'bg-red-600 w-full' : '' }}">
                                    </div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-600">
                                    <span>18.5</span>
                                    <span>18.5-24.9</span>
                                    <span>25-29.9</span>
                                    <span>≥30</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div> --}}

                <!-- Personalized Tips -->
                <div class="card mb-6">
                    <div class="card-body">
                        <h5 class="card-title">Tips dan Rekomendasi Program Diet</h5>
                        <p class="card-subtitle">Ringkasan rekomendasi personal untuk Anda</p>

                        <div class="grid grid-cols-1 gap-4 mt-5">
                            @if($latestDietRecommendation)
                                <!-- Display latest diet recommendation content -->
                                <div class="p-5 rounded-lg border border-{{ $programName == 'Naik BB' ? 'info' : ($programName == 'Turun BB' ? 'warning' : ($programName == 'Turun Lemak' ? 'danger' : 'success')) }}/20 bg-light{{ $programName == 'Naik BB' ? 'info' : ($programName == 'Turun BB' ? 'warning' : ($programName == 'Turun Lemak' ? 'danger' : 'success')) }}/10">
                                    <div class="">
                                        <h6 class="font-medium mb-3 text-{{ $programName == 'Naik BB' ? 'info' : ($programName == 'Turun BB' ? 'warning' : ($programName == 'Turun Lemak' ? 'danger' : 'success')) }}">
                                            <i class="ti ti-bulb me-1"></i> Rekomendasi untuk Program {{ $programName }}
                                        </h6>
                                        <div class="prose prose-sm text-gray-600 mt-2 recommendation-preview" style="max-height: 300px; overflow: hidden;">
                                            @php
                                                // Use DOMDocument to limit HTML content while preserving formatting
                                                $dom = new DOMDocument();
                                                libxml_use_internal_errors(true); // Suppress warnings for HTML5 tags
                                                $dom->loadHTML('<?xml encoding="utf-8" ?>' . $latestDietRecommendation->result);
                                                libxml_clear_errors();
                                                
                                                // Extract and count text nodes
                                                $text = $dom->textContent;
                                                $words = str_word_count($text, 1, 'àáãâéêíóôõúüçÀÁÃÂÉÊÍÓÔÕÚÜÇ1234567890');
                                                
                                                // Always display exactly 150 words while preserving HTML structure
                                                
                                                // Initialize variables to track if we exceed 150 words
                                                $hasMoreContent = count($words) > 150;
                                                
                                                // Create a new document for the limited content
                                                $limitedDom = new DOMDocument();
                                                $limitedDom->loadHTML('<?xml encoding="utf-8" ?>' . $latestDietRecommendation->result);
                                                
                                                // Find the point where exactly 150 words have been reached
                                                $xpath = new DOMXPath($limitedDom);
                                                $textNodes = $xpath->query('//text()');
                                                
                                                $wordCount = 0;
                                                $nodesToRemove = [];
                                                $stopProcessing = false;
                                                
                                                foreach ($textNodes as $node) {
                                                    if ($stopProcessing) {
                                                        $nodesToRemove[] = $node;
                                                        continue;
                                                    }
                                                    
                                                    $nodeWords = str_word_count($node->nodeValue, 1, 'àáãâéêíóôõúüçÀÁÃÂÉÊÍÓÔÕÚÜÇ1234567890');
                                                    $wordCount += count($nodeWords);
                                                    
                                                    if ($wordCount > 150) {
                                                        // Stop at this node and truncate to get exactly 150 words
                                                        $remaining = 150 - ($wordCount - count($nodeWords));
                                                        
                                                        if ($remaining > 0) {
                                                            // Truncate this node
                                                            $truncatedWords = array_slice($nodeWords, 0, $remaining);
                                                            $truncatedText = implode(' ', $truncatedWords);
                                                            if ($hasMoreContent) {
                                                                $truncatedText .= '...';
                                                            }
                                                            $node->nodeValue = $truncatedText;
                                                        } else {
                                                            // This node exceeds the limit
                                                            $nodesToRemove[] = $node;
                                                        }
                                                        $stopProcessing = true;
                                                    } else if ($wordCount == 150) {
                                                        // Exactly at 150 words
                                                        if ($hasMoreContent) {
                                                            $node->nodeValue .= '...';
                                                        }
                                                        $stopProcessing = true;
                                                    }
                                                }
                                                
                                                // Remove any nodes that exceed the word limit
                                                foreach ($nodesToRemove as $node) {
                                                    if ($node->parentNode) {
                                                        $node->parentNode->removeChild($node);
                                                    }
                                                }
                                                
                                                // Output the limited HTML content
                                                echo $limitedDom->saveHTML();
                                                if ($hasMoreContent) {
                                                    echo '<div class="fade-overlay"></div>';
                                                }
                                            @endphp
                                        </div>
                                        @if($hasMoreContent)
                                        <div class="mt-4 text-center">
                                            <a href="{{ route('customer.diet-recommendations.show', $latestDietRecommendation->id) }}" class="btn btn-{{ $programName == 'Naik BB' ? 'info' : ($programName == 'Turun BB' ? 'warning' : ($programName == 'Turun Lemak' ? 'danger' : 'success')) }} hover:shadow-lg transition-all">
                                                <i class="ti ti-article me-1"></i> Lihat rekomendasi lengkap
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <!-- Show message when no diet recommendation is available -->
                                <div class="p-4 rounded-lg border border-gray-200 bg-light/5">
                                    <div class="flex">
                                        <div class="flex-shrink-0 mr-3">
                                            <div class="w-10 h-10 rounded-full bg-lightinfo flex items-center justify-center mr-4">
                                                <i class="ti ti-info-circle text-info"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="font-medium mb-1">Belum Ada Rekomendasi Diet</h6>
                                            <p class="text-sm text-gray-600 mt-2">
                                                Anda belum memiliki rekomendasi diet personal. Silakan hubungi ahli gizi atau asisten ahli gizi untuk mendapatkan pemeriksaan dan rekomendasi diet yang sesuai dengan kebutuhan Anda.
                                            </p>
                                            <div class="mt-3">
                                                {{-- <a href="{{ route('customer.consultation-schedules.create') }}" class="btn btn-sm btn-primary">
                                                    <i class="ti ti-calendar-plus text-xs mr-1"></i> Jadwalkan Konsultasi
                                                </a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- <div class="p-4 bg-light/5 rounded-lg border">
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-3">
                                        <div class="w-10 h-10 rounded-full bg-lightprimary dark:bg-darkprimary flex items-center justify-center">
                                            <i class="ti ti-apple text-primary"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="font-medium mb-1">Tingkatkan Konsumsi Serat</h6>
                                        <p class="text-sm text-gray-600">Konsumsi buah dan sayuran yang kaya serat untuk
                                            melancarkan pencernaan dan menjaga berat badan ideal.</p>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="p-4 bg-light/5 rounded-lg border">
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-3">
                                        <div class="w-10 h-10 rounded-full bg-lightsuccess dark:bg-darksuccess flex items-center justify-center">
                                            <i class="ti ti-bottle text-success"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="font-medium mb-1">Jaga Hidrasi</h6>
                                        <p class="text-sm text-gray-600">Minum minimal 8 gelas air putih setiap hari untuk
                                            menjaga metabolisme tubuh tetap optimal.</p>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- @if ($latestNutritionData['calories_needs'])
                                <div class="p-4 bg-light/5 rounded-lg border">
                                    <div class="flex">
                                        <div class="flex-shrink-0 mr-3">
                                            <div class="w-10 h-10 rounded-full bg-lightwarn dark:bg-darkwarn flex items-center justify-center">
                                                <i class="ti ti-flame text-warning"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="font-medium mb-1">Kebutuhan Kalori Harian</h6>
                                            <p class="text-sm text-gray-600">Kebutuhan kalori harian Anda sekitar <span
                                                    class="font-semibold">{{ number_format($latestNutritionData['calories_needs']) }}
                                                    kkal</span> berdasarkan data terakhir Anda.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards/diet-charts/customer-dashboard-charts.js') }}"></script>
@endpush

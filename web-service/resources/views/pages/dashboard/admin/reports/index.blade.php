@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.reports') }}
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                {{ __('app.home') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            {{ __('app.reports') }}
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end">
                        <button id="export-pdf-btn" class="btn btn-primary" type="button">
                            <i class="ti ti-file-export me-1"></i> {{ __('app.export_to_pdf') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">{{ __('app.diet_program_report') }}</h3>
                    
                    @if(session('success'))
                        <div class="bg-lightsuccess dark:bg-darksuccess text-success px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                                <i class="ti ti-x"></i>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-lighterror dark:bg-darkerror text-error px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                                <i class="ti ti-x"></i>
                            </button>
                        </div>
                    @endif

                    <div class="mb-6">
                        <form id="filter-form" action="{{ route('reports.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                            <div class="flex-1">
                                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.start_date') }}</label>
                                <input 
                                    type="month" 
                                    id="start_date" 
                                    name="start_date" 
                                    value="{{ request('start_date', now()->startOfMonth()->format('Y-m')) }}" 
                                    class="border rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                >
                            </div>
                            <div class="flex-1">
                                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.end_date') }}</label>
                                <input 
                                    type="month" 
                                    id="end_date" 
                                    name="end_date" 
                                    value="{{ request('end_date', now()->format('Y-m')) }}" 
                                    class="border rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                >
                            </div>
                            <div class="flex-1">
                                <label for="program" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.diet_program') }}</label>
                                <select 
                                    id="program" 
                                    name="program" 
                                    class="border rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                >
                                    <option value="">{{ __('app.all_programs') }}</option>
                                    @foreach($dietPrograms as $program)
                                        <option value="{{ $program->id }}" {{ request('program') == $program->id ? 'selected' : '' }}>{{ $program->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-filter me-1"></i> {{ __('app.filter') }}
                                </button>
                                <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary ml-2">
                                    <i class="ti ti-refresh me-1"></i> {{ __('app.reset') }}
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table-auto w-full text-left border-spacing-0 border-separate">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.number') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.customer') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.diet_program') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.enrollment_date') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.duration') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.status') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.progress') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($enrollments as $index => $enrollment)
                                    <tr>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">{{ $index + $enrollments->firstItem() }}</td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $enrollment->user->name ?? 'N/A' }}
                                            <div class="text-xs text-gray-400">{{ $enrollment->user->email ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $enrollment->dietProgram->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $enrollment->created_at ? $enrollment->created_at->format('d M Y') : 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ \App\Http\Controllers\Admin\ReportController::calculateDuration($enrollment->created_at) }} {{ __('app.days') }}
                                        </td>
                                        <td class="px-4 py-3 border-b">
                                            @if($enrollment->status == 'active')
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">{{ __('app.active') }}</span>
                                            @elseif($enrollment->status == 'completed')
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">{{ __('app.completed') }}</span>
                                            @elseif($enrollment->status == 'cancelled')
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">{{ __('app.cancelled') }}</span>
                                            @elseif($enrollment->status == 'changed')
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-orange-800 bg-orange-100 rounded-full">{{ __('app.changed') }}</span>
                                            @else
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">{{ $enrollment->status }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            @php
                                                $progress = \App\Http\Controllers\Admin\ReportController::calculateProgress(
                                                    $enrollment->created_at, 
                                                    $enrollment->dietProgram ? $enrollment->dietProgram->duration : 0
                                                );
                                            @endphp
                                            
                                            <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700 h-2.5">
                                                <div class="bg-primary h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                                            </div>
                                            <span class="text-xs mt-1 inline-block">{{ $progress }}%</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-3 border-b text-center text-gray-500 dark:text-gray-400">{{ __('app.no_enrollments_found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @include('components.pagination', ['paginator' => $enrollments, 'perPage' => $perPage, 'perPageOptions' => $perPageOptions])
                </div>
            </div>
        </div>
    </div>

    <form id="export-form" action="{{ route('reports.export') }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="start_date" value="{{ request('start_date', now()->startOfMonth()->format('Y-m')) }}">
        <input type="hidden" name="end_date" value="{{ request('end_date', now()->format('Y-m')) }}">
        <input type="hidden" name="program" value="{{ request('program') }}">
    </form>
@endsection

@push('scripts')
<script>
    document.getElementById('export-pdf-btn').addEventListener('click', function() {
        document.getElementById('export-form').submit();
    });
</script>
@endpush
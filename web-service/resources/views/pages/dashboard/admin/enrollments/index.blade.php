@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.program_registration') }}
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                {{ __('app.home') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            {{ __('app.program_registration') }}
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end">
                        <a href="{{ route('predictions.index') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i> {{ __('app.add_registration') }}
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
                    <h3 class="card-title mb-4 flex justify-between items-center">
                        <span>{{ __('app.program_registration') }}</span>
                    </h3>
                    
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

                    <div class="overflow-x-auto">
                        <table class="table-auto w-full text-left border-spacing-0 border-separate">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.number') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.user') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.diet_program') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.status') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.last_checkup') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.enrollment_date') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($enrollments as $index => $enrollment)
                                    <tr>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">{{ $index + $enrollments->firstItem() }}</td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $enrollment->user->name ?? 'N/A' }}
                                            <div class="text-xs text-gray-400">{{ $enrollment->user->email ?? '' }}</div>
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">{{ $enrollment->dietProgram->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold leading-5 rounded-full
                                                @if($enrollment->status == 'active' || $enrollment->status == 'on_going') bg-green-100 text-green-800
                                                @elseif($enrollment->status == 'completed') bg-blue-100 text-blue-800
                                                @elseif($enrollment->status == 'cancelled') bg-red-100 text-red-800
                                                @elseif($enrollment->status == 'changed') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800
                                                @endif
                                            ">
                                                {{ $enrollment->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            @php
                                                $lastCheckup = $enrollment->checkup->count() > 0 
                                                    ? $enrollment->checkup->sortByDesc('checkup_date')->first() 
                                                    : null;
                                                $formattedDate = 'N/A';
                                                if ($lastCheckup && $lastCheckup->checkup_date) {
                                                    if (is_string($lastCheckup->checkup_date)) {
                                                        // If it's a string, convert to Carbon instance
                                                        $date = \Carbon\Carbon::parse($lastCheckup->checkup_date);
                                                        $formattedDate = $date->format('d M Y');
                                                    } elseif (is_object($lastCheckup->checkup_date)) {
                                                        // If it's already an object, we can format directly
                                                        $formattedDate = $lastCheckup->checkup_date->format('d M Y');
                                                    }
                                                }
                                            @endphp
                                            {{ $formattedDate }}
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">{{ $enrollment->created_at->format('d M Y') }}</td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            <div class="flex gap-2">
                                                <a href="{{ route('enrollments.show', $enrollment->id) }}" 
                                                    class="p-2 bg-lightblue dark:bg-dark rounded-full hover:bg-blue hover:text-white transition-all" 
                                                    title="{{ __('app.view') }}">
                                                    <i class="ti ti-eye text-blue hover:text-white"></i>
                                                </a>
                                                <a href="{{ route('enrollments.edit', $enrollment->id) }}"
                                                    class="p-2 bg-lightprimary dark:bg-darkprimary rounded-full hover:bg-primary hover:text-white transition-all" 
                                                    title="{{ __('app.edit') }}">
                                                    <i class="ti ti-edit text-primary hover:text-white"></i>
                                                </a>
                                                <a href="{{ route('enrollments.create-checkup', $enrollment->id) }}"
                                                    class="p-2 bg-lightsuccess dark:bg-darksuccess rounded-full hover:bg-success hover:text-white transition-all" 
                                                    title="{{ __('app.add_checkup') }}">
                                                    <i class="ti ti-heartbeat text-success hover:text-white"></i>
                                                </a>
                                                <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" class="inline" id="delete-enrollment-{{ $enrollment->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                        class="p-2 bg-lighterror dark:bg-darkerror rounded-full hover:bg-error hover:text-white transition-all" 
                                                        title="{{ __('app.delete') }}"
                                                        onclick="openConfirmationModal('delete', '{{ __('app.delete_enrollment') }}', '{{ __('app.confirm_delete', ['item' => $enrollment->user->name ?? __('app.this_user')]) }}', '{{ __('app.yes_delete') }}', 'document.getElementById(\'delete-enrollment-{{ $enrollment->id }}\').submit()')">
                                                        <i class="ti ti-trash text-error hover:text-white"></i>
                                                    </button>
                                                </form>
                                            </div>
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
@endsection

@push('scripts')
<script src="{{ asset('assets/js/components/confirmation-modal.js') }}"></script>
@endpush
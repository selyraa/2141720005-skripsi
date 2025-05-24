@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-4 sm:mb-6">
        <div class="card-body py-4 sm:py-5 md:py-3">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="w-full sm:w-auto">
                    <h4 class="font-semibold text-lg sm:text-xl text-dark dark:text-white mb-2 sm:mb-3">
                        {{ __('app.customer_checkup_data') }}
                    </h4>
                    <ol class="flex flex-wrap sm:flex-nowrap items-center text-xs sm:text-sm" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                {{ __('app.home') }}
                            </a>
                            <i class="ti ti-slash leading-tight font-medium mx-1 sm:mx-2"></i>
                        </li>
                        <li class="inline-flex items-center font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            {{ __('app.customer_checkup_data') }}
                        </li>
                    </ol>
                </div>
                <div class="w-full sm:w-auto mt-2 sm:mt-0">
                    <div class="flex justify-start sm:justify-end">
                        <a href="{{ route('checkups.create') }}" class="btn btn-xs sm:btn-sm md:btn-md btn-primary">
                            <i class="ti ti-plus me-1"></i> {{ __('app.add_checkup') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4 sm:gap-6">
        <div class="col-span-12">
            <div class="card">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3 sm:mb-4">
                        <h3 class="card-title text-base sm:text-lg mb-1 sm:mb-0">{{ __('app.customer_checkup_data') }}</h3>
                        <span class="text-xs sm:text-sm text-gray-500 font-normal">{{ __('app.latest_checkup_note') }}</span>
                    </div>
                    
                    @if(session('success'))
                        <div class="bg-lightsuccess dark:bg-darksuccess text-success px-3 sm:px-4 py-2 sm:py-3 rounded relative mb-3 sm:mb-4" role="alert">
                            <span class="block text-xs sm:text-sm">{{ session('success') }}</span>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-3 sm:px-4 py-2 sm:py-3" onclick="this.parentElement.style.display='none'">
                                <i class="ti ti-x text-xs sm:text-sm"></i>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-lighterror dark:bg-darkerror text-error px-3 sm:px-4 py-2 sm:py-3 rounded relative mb-3 sm:mb-4" role="alert">
                            <span class="block text-xs sm:text-sm">{{ session('error') }}</span>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-3 sm:px-4 py-2 sm:py-3" onclick="this.parentElement.style.display='none'">
                                <i class="ti ti-x text-xs sm:text-sm"></i>
                            </button>
                        </div>
                    @endif

                    <div class="overflow-x-auto -mx-4 sm:-mx-0">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden">
                                <table class="table-auto w-full text-left border-spacing-0 border-separate">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.number') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.name') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.age') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.height') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.weight') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.diet_program') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.checkup_date') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($checkups as $index => $checkup)
                                    <tr>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">{{ $index + $checkups->firstItem() }}</td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            @if($checkup->programEnrollment && $checkup->programEnrollment->user)
                                                {{ $checkup->programEnrollment->user->name }}
                                                <div class="text-xs text-gray-400">{{ $checkup->programEnrollment->user->email }}</div>
                                            @else
                                                <span class="text-red-500">{{ __('app.data_not_available') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $checkup->cell_age }} <span class="text-xs text-gray-500">{{ __('app.years') }}</span>
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $checkup->height }} <span class="text-xs text-gray-500">{{ __('app.cm') }}</span>
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $checkup->weight }} <span class="text-xs text-gray-500">{{ __('app.kg') }}</span>
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            @if($checkup->programEnrollment && $checkup->programEnrollment->dietProgram)
                                                {{ $checkup->programEnrollment->dietProgram->name }}
                                            @else
                                                <span class="text-red-500">{{ __('app.data_not_available') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $checkup->checkup_date ? $checkup->checkup_date->format('d M Y') : __('app.not_available') }}
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            <div class="flex gap-2">
                                                <a href="{{ route('checkups.show', $checkup->id) }}" 
                                                    class="p-2 bg-lightblue dark:bg-dark rounded-full hover:bg-blue hover:text-white transition-all" 
                                                    title="{{ __('app.view') }}">
                                                    <i class="ti ti-eye text-blue hover:text-white"></i>
                                                </a>
                                                <a href="{{ route('checkups.edit', $checkup->id) }}"
                                                    class="p-2 bg-lightprimary dark:bg-darkprimary rounded-full hover:bg-primary hover:text-white transition-all" 
                                                    title="{{ __('app.edit') }}">
                                                     <i class="ti ti-edit text-primary hover:text-white"></i>
                                                </a>
                                                <form action="{{ route('checkups.destroy', $checkup->id) }}" method="POST" class="inline" id="delete-form-{{ $checkup->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                        class="p-2 bg-lighterror dark:bg-darkerror rounded-full hover:bg-error hover:text-white transition-all" 
                                                        title="{{ __('app.delete') }}"
                                                        onclick="openConfirmationModal('delete', '{{ __('app.delete_checkup_data') }}', '{{ __('app.confirm_delete_checkup', ['name' => $checkup->programEnrollment->user->name ?? __('app.this_user')]) }}', '{{ __('app.yes_delete') }}', 'document.getElementById(\'delete-form-{{ $checkup->id }}\').submit()')">
                                                    <i class="ti ti-trash text-error hover:text-white"></i>
                                                </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-3 border-b text-center text-gray-500 dark:text-gray-400">{{ __('app.no_checkup_data_found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                            </div>
                        </div>
                    </div>

                    <!-- Add pagination component -->
                    <div class="mt-4 pt-2">
                        @include('components.pagination', ['paginator' => $checkups, 'perPage' => $perPage, 'perPageOptions' => $perPageOptions])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/components/confirmation-modal.js') }}"></script>
@endpush
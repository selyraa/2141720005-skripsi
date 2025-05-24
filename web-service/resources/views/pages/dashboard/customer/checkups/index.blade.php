@extends('pages.dashboard.admin.layouts.app')

@section('title', 'Data Pemeriksaan')

@section('content')
    <div class="w-full px-3 sm:px-5 py-4 sm:py-5">
        <!-- Title Header Card -->
        <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-4 sm:mb-6">
            <div class="card-body py-4 sm:py-5 md:py-3">
                <div class="flex flex-wrap items-center">
                    <div class="w-full">
                        <h4 class="font-semibold text-lg sm:text-xl text-dark dark:text-white mb-2 sm:mb-3">
                            {{ __('app.my_checkup_data') }}
                        </h4>
                        <ol class="flex flex-wrap sm:flex-nowrap items-center text-xs sm:text-sm" aria-label="Breadcrumb">
                            <li class="inline-flex items-center">
                                <a class="flex items-center text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                    {{ __('app.home') }}
                                </a>
                                <i class="ti ti-slash leading-tight font-medium mx-1 sm:mx-2"></i>
                            </li>
                            <li class="inline-flex items-center font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                                {{ __('app.my_checkup_data') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 sm:gap-6">
            <div class="col-span-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-base sm:text-lg mb-3 sm:mb-4">{{ __('app.my_checkup_history') }}</h3>

                        <div class="overflow-x-auto -mx-4 sm:-mx-0">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden">
                                    <table class="table-auto w-full text-left border-spacing-0 border-separate">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.date') }}</th>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.height') }}</th>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.weight') }}</th>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.body_fat') }}</th>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.diet_program') }}</th>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($checkups as $checkup)
                                        <tr>
                                            <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                {{ $checkup->checkup_date ? $checkup->checkup_date->format('d M Y') : __('app.not_available') }}
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
                                                @if($checkup->programEnrollment && $checkup->programEnrollment->dietProgram)
                                                    {{ $checkup->programEnrollment->dietProgram->name }}
                                                @else
                                                    <span class="text-red-500">{{ __('app.data_not_available') }}</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                                <a href="{{ route('customer.checkups.show', $checkup->id) }}" 
                                                   class="btn btn-xs sm:btn-sm btn-primary px-2 py-1">
                                                    <i class="ti ti-eye"></i> {{ __('app.details') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-4 py-3 border-b text-center text-gray-500 dark:text-gray-400">{{ __('app.no_checkup_data_found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                                </div>
                            </div>
                        </div>

                        <!-- Add pagination links -->
                        <div class="mt-4">
                            {{ $checkups->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

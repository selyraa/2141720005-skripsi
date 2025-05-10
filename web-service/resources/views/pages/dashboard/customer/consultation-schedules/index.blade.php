@extends('pages.dashboard.admin.layouts.app')

@section('title', __('app.consultation_schedules'))

@section('content')
    <div class="w-full px-5 py-5">
        <!-- Title Header Card -->
        <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
            <div class="card-body md:py-3 py-5">
                <div class="flex items-center grid grid-cols-12 gap-6">
                    <div class="col-span-12">
                        <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                            {{ __('app.my_consultation_schedules') }}
                        </h4>
                        <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                            <li class="inline-flex items-center">
                                <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                    {{ __('app.home') }}
                                </a>
                                <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                            </li>
                            <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                                {{ __('app.my_consultation_schedules') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-4">{{ __('app.my_consultation_schedules') }}</h3>

                        <div class="overflow-x-auto">
                            <table class="table-auto w-full text-left border-spacing-0 border-separate">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.date') }}</th>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.time') }}</th>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.diet_program') }}</th>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.status') }}</th>
                                        <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($schedules as $schedule)
                                        <tr>
                                            <td class="px-4 py-4 border-b">{{ $schedule->schedule_date->format('d M Y') }}</td>
                                            <td class="px-4 py-4 border-b">{{ $schedule->schedule_date->format('H:i') }}</td>
                                            <td class="px-4 py-4 border-b">{{ $schedule->programEnrollment->dietProgram->name }}</td>
                                            <td class="px-4 py-4 border-b">
                                                @if($schedule->status == 'Pending')
                                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-lightyellow text-warning">
                                                        {{ $schedule->status }}
                                                    </span>
                                                @elseif($schedule->status == 'Completed')
                                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-lightsuccess text-success">
                                                        {{ $schedule->status }}
                                                    </span>
                                                @elseif($schedule->status == 'Cancelled')
                                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-lightdanger text-danger">
                                                        {{ $schedule->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4 border-b">
                                                <a href="{{ route('customer.consultation-schedules.show', $schedule->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="ti ti-eye"></i> {{ __('app.details') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="px-4 py-4 border-b text-center" colspan="5">
                                                {{ __('app.no_consultation_schedules_found') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-5">
                            {{ $schedules->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

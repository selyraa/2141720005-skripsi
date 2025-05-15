@extends('pages.dashboard.admin.layouts.app')
@section('title', __('app.my_diet_recommendations'))

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.my_diet_recommendations') }}
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('customer.dashboard') }}">
                                {{ __('app.home') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            {{ __('app.diet_recommendations') }}
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
                    <h3 class="card-title mb-4 flex justify-between items-center">
                        <span>{{ __('app.my_diet_recommendations') }}</span>
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
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.checkup_date') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.diet_program') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.context_template') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.created_at') }}</th>
                                    <th class="px-4 py-3 border-b font-semibold text-gray-800 dark:text-gray-200">{{ __('app.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recommendations as $index => $recommendation)
                                    <tr>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">{{ $index + $recommendations->firstItem() }}</td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $recommendation->checkup->checkup_date->format('d M Y') }}
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $recommendation->checkup->programEnrollment->dietProgram->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $recommendation->llmContext->title ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            {{ $recommendation->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="px-4 py-3 border-b text-gray-500 dark:text-gray-400">
                                            <div class="flex gap-2">
                                                <a href="{{ route('customer.diet-recommendations.show', $recommendation->id) }}" 
                                                   class="p-2 bg-lightblue dark:bg-dark rounded-full hover:bg-blue hover:text-white transition-all" 
                                                   title="{{ __('app.view') }}">
                                                    <i class="ti ti-eye text-blue hover:text-white"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-3 border-b text-center text-gray-500 dark:text-gray-400">{{ __('app.no_diet_recommendations_found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        @include('components.pagination', ['paginator' => $recommendations, 'perPage' => $perPage, 'perPageOptions' => $perPageOptions])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
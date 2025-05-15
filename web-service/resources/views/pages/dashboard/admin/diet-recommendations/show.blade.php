@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.diet_recommendation_details') }}
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                {{ __('app.home') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('diet-recommendations.index') }}">
                                {{ __('app.diet_recommendations') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            {{ __('app.recommendation_details') }}
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('diet-recommendations.edit', $recommendation->id) }}" class="btn btn-primary">
                            <i class="ti ti-edit me-1"></i> {{ __('app.edit') }}
                        </a>
                        <a href="{{ route('diet-recommendations.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-1"></i> {{ __('app.back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- Patient Information -->
        <div class="col-span-12 md:col-span-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex items-center">
                        <i class="ti ti-user text-xl mr-2"></i> {{ __('app.patient_information') }}
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.patient_name') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $recommendation->checkup->programEnrollment->user->name ?? 'N/A' }}</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.checkup_date') }}</div>
                            <div class="text-dark dark:text-white">{{ $recommendation->checkup->checkup_date->format('d M Y') }}</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.diet_program') }}</div>
                            <div class="text-dark dark:text-white">{{ $recommendation->checkup->programEnrollment->dietProgram->name ?? 'N/A' }}</div>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.template_used') }}</div>
                            <div class="text-dark dark:text-white">{{ $recommendation->llmContext->title }}</div>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.generated_at') }}</div>
                            <div class="text-dark dark:text-white">{{ $recommendation->created_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-6">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex items-center">
                        <i class="ti ti-file-text text-xl mr-2"></i> {{ __('app.prompt_used') }}
                    </h3>
                    
                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                        <pre class="whitespace-pre-wrap text-sm text-gray-700 dark:text-gray-300">{{ $recommendation->prompt }}</pre>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recommendation Result -->
        <div class="col-span-12 md:col-span-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4 flex items-center">
                        <i class="ti ti-message-2 text-xl mr-2"></i> {{ __('app.recommendation_result') }}
                    </h3>
                    
                    @if(session('success'))
                        <div class="bg-lightsuccess dark:bg-darksuccess text-success px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                                <i class="ti ti-x"></i>
                            </button>
                        </div>
                    @endif
                    
                    <div class="p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="prose max-w-none dark:prose-dark">
                            {!! $recommendation->result !!}
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <form action="{{ route('diet-recommendations.destroy', $recommendation->id) }}" method="POST" id="delete-form-{{ $recommendation->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" 
                                class="btn btn-error" 
                                onclick="openConfirmationModal('delete', '{{ __('app.delete_diet_recommendation') }}', '{{ __('app.confirm_delete_diet_recommendation') }}', '{{ __('app.yes_delete') }}', 'document.getElementById(\'delete-form-{{ $recommendation->id }}\').submit()')">
                                <i class="ti ti-trash me-1"></i> {{ __('app.delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/components/confirmation-modal.js') }}"></script>
@endpush

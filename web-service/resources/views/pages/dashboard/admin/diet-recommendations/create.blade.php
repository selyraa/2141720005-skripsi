@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.add_diet_recommendation') }}
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
                            {{ __('app.add_diet_recommendation') }}
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end">
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
                    <h3 class="card-title mb-4">{{ __('app.user_information') }}</h3>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.customer_name') }}</div>
                            <div class="text-lg font-semibold text-dark dark:text-white">{{ $checkup->programEnrollment->user->name }}</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.checkup_date') }}</div>
                            <div class="text-dark dark:text-white">{{ $checkup->checkup_date->format('d M Y') }}</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.diet_program') }}</div>
                            <div class="text-dark dark:text-white">{{ $checkup->programEnrollment->dietProgram->name ?? 'N/A' }}</div>
                        </div>
                    </div>
                    
                    <h3 class="card-title mb-4 mt-6">{{ __('app.checkup_data') }}</h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.height') }}</div>
                            <div class="text-dark dark:text-white">{{ $checkup->height }} cm</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.weight') }}</div>
                            <div class="text-dark dark:text-white">{{ $checkup->weight }} kg</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.bmi') }}</div>
                            <div class="text-dark dark:text-white">{{ round($checkup->calculateBmi(), 1) }} ({{ $checkup->getBmiCategory() }})</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.body_fat') }}</div>
                            <div class="text-dark dark:text-white">{{ $checkup->body_fat }}%</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.belly_fat') }}</div>
                            <div class="text-dark dark:text-white">{{ $checkup->belly_fat }}%</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.muscle_mass') }}</div>
                            <div class="text-dark dark:text-white">{{ $checkup->muscle_mass }}%</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.bone_density') }}</div>
                            <div class="text-dark dark:text-white">{{ $checkup->bone_density }}%</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.water_content') }}</div>
                            <div class="text-dark dark:text-white">{{ $checkup->water_content }}%</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.calories_needs') }}</div>
                            <div class="text-dark dark:text-white">{{ $checkup->calories_needs }} kcal</div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded">
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.cell_age') }}</div>
                            <div class="text-dark dark:text-white">{{ $checkup->cell_age }} {{ __('app.years') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Generate Recommendation Form -->
        <div class="col-span-12 md:col-span-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">{{ __('app.add_diet_recommendation_form') }}</h3>
                    
                    @if($errors->any())
                        <div class="bg-lighterror dark:bg-darkerror text-error px-4 py-3 rounded relative mb-4" role="alert">
                            <ul class="list-disc ml-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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

                    <form action="{{ route('diet-recommendations.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="checkup_id" value="{{ $checkup->id }}">
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div class="form-group">
                                <label for="llm_context_id" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.context_template') }} <span class="text-red-500">*</span></label>
                                <select id="llm_context_id" name="llm_context_id" class="form-control w-full @error('llm_context_id') is-invalid @enderror" required>
                                    <option value="">{{ __('app.select_context_template') }}</option>
                                    @foreach($llmContexts as $context)
                                        <option value="{{ $context->id }}">{{ $context->title }}</option>
                                    @endforeach
                                </select>
                                @error('llm_context_id')
                                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="custom_prompt" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.additional_context') }} <span class="text-gray-500">({{ __('app.optional') }})</span></label>
                                <textarea id="custom_prompt" name="custom_prompt" rows="3" class="form-control w-full @error('custom_prompt') is-invalid @enderror">{{ old('custom_prompt') }}</textarea>
                                <p class="text-sm text-gray-500 mt-1">{{ __('app.additional_instructions_help') }}</p>
                                @error('custom_prompt')
                                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('diet-recommendations.index') }}" class="btn btn-secondary me-2">
                                <i class="ti ti-x me-1"></i> {{ __('app.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-message-2 me-1"></i> {{ __('app.generate_recommendation') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

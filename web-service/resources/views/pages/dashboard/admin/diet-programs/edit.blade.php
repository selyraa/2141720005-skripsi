@extends('pages.dashboard.admin.layouts.app')

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-9">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.edit_diet_program') }}
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                {{ __('app.home') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('diet-programs.index') }}">
                                {{ __('app.manage_diet_programs') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            {{ __('app.edit_diet_program') }}
                        </li>
                    </ol>
                </div>
                <div class="col-span-3">
                    <div class="flex justify-end">
                        <a href="{{ route('diet-programs.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-1"></i> {{ __('app.back') }}
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
                    <h3 class="card-title mb-4">{{ __('app.edit_diet_program') }}</h3>
                    
                    @if($errors->any())
                        <div class="bg-lighterror dark:bg-darkerror text-error px-4 py-3 rounded relative mb-4" role="alert">
                            <ul class="list-disc ml-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('diet-programs.update', $dietProgram->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div class="form-group">
                                <label for="name" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.program_name') }} <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name', $dietProgram->name) }}" class="form-control w-full" required>
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.description') }}</label>
                                <textarea id="description" name="description" rows="4" class="form-control w-full">{{ old('description', $dietProgram->description) }}</textarea>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('diet-programs.index') }}" class="btn btn-secondary me-2">
                                <i class="ti ti-x me-1"></i> {{ __('app.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i> {{ __('app.save_changes') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
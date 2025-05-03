@extends('pages.dashboard.admin.layouts.app')

@section('title', __('app.account_settings'))

@section('content')
    <div class="card bg-lightsuccess dark:bg-darkinfo shadow-none dark:shadow-none position-relative overflow-hidden mb-6">
        <div class="card-body md:py-3 py-5">
            <div class="flex items-center grid grid-cols-12 gap-6">
                <div class="col-span-12">
                    <h4 class="font-semibold text-xl text-dark dark:text-white mb-3">
                        {{ __('app.account_settings') }}
                    </h4>
                    <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                        <li class="inline-flex items-center">
                            <a class="flex items-center text-sm text-gray-500 hover:text-primary focus:outline-none focus:text-primary dark:focus:text-primary leading-tight" href="{{ route('dashboard') }}">
                                {{ __('app.home') }}
                            </a>
                            <i class="ti ti-slash text-sm leading-tight font-medium mx-2"></i>
                        </li>
                        <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-gray-200 leading-tight" aria-current="page">
                            {{ __('app.account_settings') }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-lightsuccess dark:bg-darksuccess text-success px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                    <i class="ti ti-x"></i>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-lighterror dark:bg-darkerror text-error px-4 py-3 rounded relative mb-4" role="alert">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                    <i class="ti ti-x"></i>
                </button>
            </div>
        @endif

        <div class="card mb-6">
            <div class="card-body">
                <div class="flex flex-col md:flex-row mb-6">
                    <div class="w-full md:w-1/4 flex flex-col items-center mb-6 md:mb-0">
                        <!-- Profile Photo Section with Header -->
                        <h5 class="text-base font-medium text-dark dark:text-white mb-2">{{ __('app.profile_photo') }}</h5>
                        <p class="text-xs text-gray-500 mb-4 text-center">{{ __('app.profile_photo_description') }}</p>
                        
                        <div class="relative w-48 h-48 rounded-full overflow-hidden mb-4 group">
                            <img src="{{ $user->profile_photo_url }}" alt="{{ __('app.profile_image') }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <label for="profile_photo" class="cursor-pointer flex flex-col items-center justify-center">
                                    <i class="ti ti-upload text-white text-2xl mb-1"></i>
                                    <span class="text-white text-xs">{{ __('app.change_photo') }}</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Photo Upload Form -->
                        <form action="{{ route('account.profile.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center w-full px-4">
                            @csrf
                            @method('PUT')
                            <input type="file" name="profile_photo" id="profile_photo" class="hidden" accept="image/jpeg,image/png,image/gif" onchange="document.getElementById('photo-file-name').textContent = this.files[0].name; document.getElementById('upload-photo-btn').classList.remove('hidden')">
                            
                            <div class="flex flex-col items-center mb-4 w-full">
                                <div class="flex gap-2 w-full justify-center">
                                    <button type="button" onclick="document.getElementById('profile_photo').click()" class="btn btn-primary btn-sm flex items-center">
                                        <i class="ti ti-upload mr-1"></i>{{ __('app.choose_file') }}
                                    </button>
                                    @if($user->profile_photo)
                                    <button type="button" onclick="document.getElementById('delete-photo-form').submit()" class="btn btn-error btn-sm flex items-center">
                                        <i class="ti ti-trash mr-1"></i>{{ __('app.remove') }}
                                    </button>
                                    @endif
                                </div>
                                <span id="photo-file-name" class="text-sm text-gray-500 text-center mt-2"></span>
                                <button id="upload-photo-btn" type="submit" class="hidden btn btn-primary btn-sm mt-3 px-4">
                                    <i class="ti ti-device-floppy me-1"></i>{{ __('app.upload_photo') }}
                                </button>
                                <p class="text-xs text-gray-500 mt-2 text-center">{{ __('app.allowed_formats') }}</p>
                            </div>
                            
                            <!-- Hidden fields to preserve current user data when uploading photo -->
                            <input type="hidden" name="name" value="{{ $user->name }}">
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            <input type="hidden" name="phone_number" value="{{ $user->phone_number }}">
                            <input type="hidden" name="gender" value="{{ $user->gender }}">
                            <input type="hidden" name="birth_date" value="{{ $user->birth_date }}">
                        </form>
                        
                        <!-- User Info -->
                        <div class="flex flex-col items-center">
                            {{-- <h4 class="text-lg font-medium text-dark dark:text-white">{{ auth()->user()->name }}</h4>
                            <p class="text-sm text-gray-500">{{ auth()->user()->role->name ?? 'No Role' }}</p>
                            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p> --}}
                            
                            @if($user->profile_photo)
                            <form id="delete-photo-form" action="{{ route('account.profile-photo.delete') }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            @endif
                        </div>
                    </div>
                    
                    <div class="w-full md:w-3/4">
                        <!-- Tabs -->
                        <div class="hs-tabs-container">
                            <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
                                <nav class="flex space-x-2" aria-label="Tabs" role="tablist">
                                    <button type="button" class="hs-tabs-active:font-semibold hs-tabs-active:border-primary hs-tabs-active:text-primary py-4 px-1 inline-flex items-center gap-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-primary active" id="profile-tab" data-hs-tab="#profile-tab-content" aria-controls="profile-tab-content" role="tab">
                                        <i class="ti ti-user-circle text-lg"></i> {{ __('app.profile_information') }}
                                    </button>
                                    <button type="button" class="hs-tabs-active:font-semibold hs-tabs-active:border-primary hs-tabs-active:text-primary py-4 px-1 inline-flex items-center gap-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-primary" id="password-tab" data-hs-tab="#password-tab-content" aria-controls="password-tab-content" role="tab">
                                        <i class="ti ti-lock text-lg"></i> {{ __('app.change_password') }}
                                    </button>
                                </nav>
                            </div>

                            <div class="mt-3">
                                <!-- Profile Tab Content -->
                                <div id="profile-tab-content" role="tabpanel" aria-labelledby="profile-tab">
                                    <form action="{{ route('account.profile.update') }}" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                            <div class="form-group">
                                                <label for="name" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.name') }}</label>
                                                <input type="text" class="form-control w-full" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="email" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.email') }}</label>
                                                <input type="email" class="form-control w-full" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                            <div class="form-group">
                                                <label for="phone_number" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.phone_number') }}</label>
                                                <input type="text" class="form-control w-full" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="gender" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.gender') }}</label>
                                                <select class="form-select w-full" id="gender" name="gender">
                                                    <option value="">{{ __('app.select_gender') }}</option>
                                                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>{{ __('app.male') }}</option>
                                                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>{{ __('app.female') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="birth_date" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.birth_date') }}</label>
                                            <input type="date" class="form-control w-full" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}">
                                        </div>
                                        
                                        <div class="flex justify-end mt-6">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="ti ti-device-floppy me-1"></i>{{ __('app.save_changes') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- Password Tab Content -->
                                <div id="password-tab-content" class="hidden" role="tabpanel" aria-labelledby="password-tab">
                                    <form action="{{ route('account.password.update') }}" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="form-group">
                                            <label for="current_password" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.current_password') }}</label>
                                            <input type="password" class="form-control w-full" id="current_password" name="current_password" required>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                            <div class="form-group">
                                                <label for="password" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.new_password') }}</label>
                                                <input type="password" class="form-control w-full" id="password" name="password" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="password_confirmation" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.confirm_new_password') }}</label>
                                                <input type="password" class="form-control w-full" id="password_confirmation" name="password_confirmation" required>
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-end mt-6">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="ti ti-key me-1"></i>{{ __('app.update_password') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tab functionality
        const tabsContainer = document.querySelector('.hs-tabs-container');
        const tabs = tabsContainer.querySelectorAll('[data-hs-tab]');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                // Hide all tab contents
                document.querySelectorAll('[role="tabpanel"]').forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Remove active state from all tabs
                tabs.forEach(t => {
                    t.classList.remove('active', 'border-primary', 'text-primary', 'font-semibold');
                    t.classList.add('text-gray-500');
                });
                
                // Show selected tab content
                const targetId = this.getAttribute('data-hs-tab');
                document.querySelector(targetId).classList.remove('hidden');
                
                // Set active state on selected tab
                this.classList.add('active', 'border-primary', 'text-primary', 'font-semibold');
            });
        });
    });
</script>
@endsection
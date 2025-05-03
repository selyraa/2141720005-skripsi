<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr" data-color-theme="NutCastle_Theme" class="light selected"
    data-layout="vertical" data-boxed-layout="boxed" data-card="shadow">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/logos/favicon.ico')}}" />
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <!-- Core Css -->
    <link rel="stylesheet" href="{{asset('assets/css/theme.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />
    <title>{{ __('app.login') }} | {{ __('app.app_name') }}</title>
</head>

<body class="DEFAULT_THEME bg-white dark:bg-dark">	
    <main>
        <!--start the project-->
        <div id="main-wrapper" class="flex">
            <!-- Main Content -->
            <main class="h-screen w-full bg-lightsuccess dark:bg-darkinfo">
                <div class="h-full w-full flex justify-center items-center">
                    <div class="flex justify-center w-full">
                        <div class="xl:w-2/6 lg:w-2/5 md:w-1/2 sm:w-3/4 w-11/12">
                            <div class="max-w-[500px] px-5 mx-auto">
                                <div class="card shadow-lg">
                                    <div class="card-body p-6">
                                        <div class="mx-auto text-center mb-6">
                                            <div class="flex justify-center">
                                                <div class="brand-logo flex items-center">
                                                    {{-- <a href="/" class="text-nowrap logo-img">
                                                        <img
                                                            src="{{asset('assets/images/logos/dark-logo.svg')}}"
                                                            class="dark:hidden block rtl:hidden"
                                                            alt="Logo-Dark"
                                                        />
                                                    </a> --}}
                                                </div>
                                            </div>
                                            <h4 class="font-semibold text-xl text-dark dark:text-white mt-4 mb-1">
                                                {{ __('app.welcome_back') }}
                                            </h4>
                                            <p class="text-gray-500 dark:text-gray-400 mb-4">{{ __('app.sign_in_to_continue') }}</p>
                                        </div>
                                        
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
                                        
                                        <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                                            @csrf
                                            <div class="form-group">
                                                <label for="email" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.email') }}</label>
                                                <input type="email" name="email" id="email" class="form-control w-full" value="{{ old('email') }}" required autofocus />
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="password" class="form-label block mb-2 font-medium text-dark dark:text-white">{{ __('app.password') }}</label>
                                                <input type="password" name="password" id="password" class="form-control w-full" required />
                                            </div>
                                            
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="remember" id="remember" 
                                                        class="border-gray-200 rounded text-primary focus:ring-primary dark:bg-dark dark:border-gray-700 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-primary" />
                                                    <label for="remember" class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('app.remember_me') }}</label>
                                                </div>
                                                <a href="#" class="text-sm font-medium text-primary hover:underline">{{ __('app.forgot_password') }}</a>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary w-full py-3">{{ __('app.sign_in') }}</button>
                                            
                                            <div class="relative my-4">
                                                <div class="absolute inset-0 flex items-center">
                                                    <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                                                </div>
                                                <div class="relative flex justify-center">
                                                    <span class="bg-white dark:bg-dark px-4 text-sm text-gray-500 dark:text-gray-400">{{ __('app.or_sign_in_with') }}</span>
                                                </div>
                                            </div>
                                            
                                            <div class="grid grid-cols-2 gap-4">
                                                <a href="javascript:void(0)"
                                                class="border border-light-dark rounded-md py-2.5 px-3 justify-center flex items-center hover:text-primary dark:hover:text-primary">
                                                <img src="../assets/images/svgs/google-icon.svg" alt=""
                                                    class="me-2" width="18" height="18">
                                                <span class="shrink-0">Google</span>
                                            </a>
                                            <a href="javascript:void(0)"
                                            class="border border-light-dark rounded-md py-2.5 px-3 justify-center flex items-center hover:text-primary dark:hover:text-primary">
                                            <img src="../assets/images/svgs/facebook-icon.svg" alt=""
                                                class="me-2" width="18" height="18">
                                            <span class="shrink-0">Facebook</span>
                                        </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="text-center mt-5">
                                    <p class="text-gray-600 dark:text-gray-400">
                                        {{ __('app.dont_have_account') }} <a href="#" class="font-medium text-primary hover:underline">{{ __('app.sign_up') }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Main Content End -->
        </div>
        <!--end of project-->
    </main>
    
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('assets/js/theme/app.init.js')}}"></script>
    <script src="{{asset('assets/js/theme/app.min.js')}}"></script>
    <script src="{{asset('assets/js/theme.js')}}"></script>
</body>
</html>
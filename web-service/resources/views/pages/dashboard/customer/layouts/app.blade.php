<!DOCTYPE html>
<html lang="en" dir="ltr" data-color-theme="NutCastle_Theme" class="light selected" data-layout="vertical"
    data-boxed-layout="boxed" data-card="shadow">

<head>
    <!-- Required meta tags -->
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
    <title>@yield('title', 'Customer Portal') - NutCastle</title>
    @stack('css')
</head>

<body class="DEFAULT_THEME bg-white dark:bg-dark">
    <main>
        <!--start the project-->
        <div id="main-wrapper" class="flex">
            @include('pages.dashboard.admin.layouts.sidebar')
            <div class="page-wrapper w-full" role="main">
                <!--  Header Start -->
                @include('pages.dashboard.admin.layouts.header')
                <!--  Header End -->

                <!-- Main content -->
                <div class="py-6 px-5 pt-3">
                    @yield('content')
                </div>

                <!-- modals -->
                <div id="confirmation-modal" class="hs-overlay hidden w-full h-full fixed top-0 left-0 z-[70] overflow-x-hidden overflow-y-auto">
                    <div class="hs-overlay-open:opacity-100 hs-overlay-open:duration-300 opacity-0 transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                        <div class="flex flex-col bg-white border shadow-sm rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
                                <h3 id="confirmation-modal-title" class="font-bold text-gray-800 dark:text-white">
                                    <!-- Modal title will be inserted here -->
                                </h3>
                                <button type="button" class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-sm dark:focus:ring-gray-700 dark:focus:ring-offset-gray-800" data-hs-overlay="#confirmation-modal">
                                    <span class="sr-only">Close</span>
                                    <i class="ti ti-x text-lg"></i>
                                </button>
                            </div>
                            
                            <div class="p-4 overflow-y-auto">
                                <p id="confirmation-modal-message" class="mt-1 text-gray-800 dark:text-gray-400">
                                    <!-- Modal message will be inserted here -->
                                </p>
                            </div>
                            
                            <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-gray-700">
                                <button type="button" class="btn btn-outline-secondary" data-hs-overlay="#confirmation-modal">
                                    {{ __('app.cancel') }}
                                </button>
                                <button id="confirm-modal-action" type="button" class="btn btn-primary">
                                    <!-- Button text will be inserted here -->
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="py-6"></div>

                <!-- Footer -->
                <footer class="shadow-none border-t dark:border-t dark:border-darkmode px-5 py-3">
                    <div class="flex justify-between">
                        <div>
                            <span class="text-sm text-gray-600 dark:text-gray-400">
                                © {{ date('Y') }} NutCastle. {{ __('app.all_rights_reserved') }}
                            </span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </main>

    <!-- Import Js Files -->
    <script src="{{ asset('assets/js/theme/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme/app.min.js') }}"></script>
    @include('components.confirmation-modal')
    @stack('scripts')
</body>
</html>

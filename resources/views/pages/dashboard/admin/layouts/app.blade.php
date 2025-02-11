<!DOCTYPE html>
<html lang="en" dir="ltr" data-color-theme="Blue_Theme" class="light selected" data-layout="vertical"
    data-boxed-layout="boxed" data-card="shadow">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <!-- Core Css -->
    <link rel="stylesheet" href="../assets/css/theme.css" />
    <title>Modernize TailwindCSS HTML Admin Template</title>
    <link rel="stylesheet" href="../assets/libs/owl.carousel/dist/assets/owl.carousel.min.css">
</head>

<body class="DEFAULT_THEME bg-white dark:bg-dark">
    <!-- Toast -->
    <div id="dismiss-toast"
        class="toast-onload opacity-0   hs-removing:translate-x-5 hs-removing:opacity-0 transition duration-300 max-w-xs bg-primary rounded-md"
        role="alert">
        <div class="flex gap-2 p-3">
            <i class="ti ti-alert-circle text-white text-lg"></i>
            <div>
                <h5 class="font-semibold text-white">Welcome to Modernize</h5>
                <p class="text-fs_12 text-white">Easy to costomize the Template!!!</p>
            </div>
            <div class="ms-auto">
                <button type="button" data-hs-remove-element="#dismiss-toast">
                    <i class="ti ti-x text-lg text-white opacity-70 leading-none"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- End Toast -->
    <main>
        <!--start the project-->
        <div id="main-wrapper" class="flex">
            @include('pages.dashboard.admin.layouts.sidebar')
            <div class="page-wrapper w-full" role="main">
                <!--  Header Start -->
                @include('pages.dashboard.admin.layouts.header')
                <!--  Header End -->

                <!-- Main Content -->
                <div class="max-w-full pt-6">
                    @yield('content')
                </div>
                <!-- Main Content End -->
            </div>
        </div>
        <!--end of project-->

    </main>
    <!-- Menu Canvas-->
    <div id="navbar-offcanvas-example-menu"
        class="lg:hidden bg-white hs-overlay  dark:bg-dark hs-overlay-open:translate-x-0  translate-x-full rtl:hs-overlay-open:translate-x-0  rtl:-translate-x-full  fixed top-0 right-0 rtl:left-0 rtl:right-auto transition-all duration-300 transform h-full max-w-xs  w-full z-[60] hidden"
        tabindex="-1" data-hs-overlay-close-on-resize>
        <div class="lg:flex gap-2  items-center ">
            <div class="flex lg:hidden lg:p-0 p-5">
                <div class="brand-logo flex  items-center ">
                    <a href="../main/index.html" class="text-nowrap logo-img">
                        <img src="../assets/images/logos/dark-logo.svg" class="dark:hidden block rtl:hidden"
                            alt="Logo-Dark" />
                        <img src="../assets/images/logos/light-logo.svg"
                            class="dark:block hidden rtl:hidden rtl:dark:hidden" alt="Logo-light" />

                        <img src="../assets/images/logos/dark-logo-rtl.svg"
                            class="dark:hidden hidden rtl:block rtl:dark:hidden" alt="Logo-Dark" />
                        <img src="../assets/images/logos/light-logo-rtl.svg"
                            class="dark:hidden hidden rtl:hidden rtl:dark:block" alt="Logo-light" />
                    </a>
                </div>

            </div>
            <div class="lg:p-0 p-5 lg:flex gap-2 items-center" data-simplebar=""
                style="height: calc(100vh - 100px)">
                <div class="lg:flex items-center">
                    <div
                        class="hs-dropdown lg:py-4  [--strategy:static] lg:[--strategy:absolute] [--adaptive:none] sm:[--trigger:hover] relative group/menu">
                        <button type="button"
                            class="header-link-btn group-hover/menu:bg-lightprimary group-hover/menu:text-primary">
                            <i class="ti ti-api-app lg:hidden lg:text-sm text-xl"></i>Apps
                            <i class="ti ti-chevron-down  ms-auto lg:text-sm text-lg"></i>
                        </button>

                        <div
                            class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 left-0 hidden z-10 sm:mt-3 top-full start-0 min-w-[15rem] lg:w-[900px] before:absolute lg:bg-white bg-transparent dark:bg-dark lg:shadow-md shadow-none">
                            <div class="grid grid-cols-12">
                                <div class="lg:col-span-8 col-span-12 flex items-stretch lg:px-5 lg:pr-0 px-0 py-5">
                                    <div class="grid grid-cols-12 lg:gap-3 w-full">
                                        <div class="col-span-12 lg:col-span-6 flex items-stretch">
                                            <ul>
                                                <li class="mb-5">
                                                    <a href="../main/app-chat.html"
                                                        class="flex gap-3 items-center  group relative">
                                                        <span class="apps-icons">
                                                            <img src="../assets/images/svgs/icon-dd-chat.svg"
                                                                class="h-6 w-6">
                                                        </span>
                                                        <div class="">
                                                            <h6
                                                                class="font-semibold text-sm group-hover:text-primary">
                                                                Chat Application
                                                            </h6>
                                                            <p class="text-xs">
                                                                New messages arrived</p>
                                                        </div>

                                                    </a>
                                                </li>
                                                <li class="mb-5">
                                                    <a href="../main/page-user-profile.html"
                                                        class="flex gap-3 items-center  group relative">
                                                        <span class="apps-icons">
                                                            <img src="../assets/images/svgs/icon-dd-invoice.svg"
                                                                class="h-6 w-6">
                                                        </span>
                                                        <div class="">
                                                            <h6
                                                                class="font-semibold text-sm group-hover:text-primary ">
                                                                User Profile App
                                                            </h6>
                                                            <p class="text-xs">
                                                                Get profile details</p>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="mb-5">
                                                    <a href="../main/app-contact.html"
                                                        class="flex gap-3 items-center group relative">
                                                        <span class="apps-icons">
                                                            <img src="../assets/images/svgs/icon-dd-mobile.svg"
                                                                class="h-6 w-6">
                                                        </span>
                                                        <div class="">
                                                            <h6
                                                                class="font-semibold text-sm group-hover:text-primary">
                                                                Contact Application
                                                            </h6>
                                                            <p class="text-xs">
                                                                2 Unsaved Contacts</p>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="mb-5">
                                                    <a href="../main/app-email.html"
                                                        class="flex gap-3 items-center group relative">
                                                        <span class="apps-icons">
                                                            <img src="../assets/images/svgs/icon-dd-message-box.svg"
                                                                class="h-6 w-6">
                                                        </span>
                                                        <div class="">
                                                            <h6
                                                                class="font-semibold text-sm group-hover:text-primary">
                                                                Email App
                                                            </h6>
                                                            <p class="text-xs">
                                                                Get new emails</p>
                                                        </div>

                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-span-12 lg:col-span-6 flex items-stretch">
                                            <ul>
                                                <li class="mb-5">
                                                    <a href="../main/eco-shop.html"
                                                        class="flex gap-3 items-center  group relative">
                                                        <span class="apps-icons">
                                                            <img src="../assets/images/svgs/icon-dd-cart.svg"
                                                                class="h-6 w-6">
                                                        </span>
                                                        <div class="">
                                                            <h6
                                                                class="font-semibold text-sm group-hover:text-primary">
                                                                eCommerce App

                                                            </h6>
                                                            <p class="text-xs">
                                                                learn more information</p>
                                                        </div>


                                                    </a>
                                                </li>
                                                <li class="mb-5">
                                                    <a href="../main/app-calendar.html"
                                                        class="flex gap-3 items-center group relative">
                                                        <span class="apps-icons">
                                                            <img src="../assets/images/svgs/icon-dd-mobile.svg"
                                                                class="h-6 w-6">
                                                        </span>
                                                        <div class="">
                                                            <h6
                                                                class="font-semibold text-sm group-hover:text-primary">
                                                                Calendar App
                                                            </h6>
                                                            <p class="text-xs">
                                                                Get dates</p>
                                                        </div>


                                                    </a>
                                                </li>
                                                <li class="mb-5">
                                                    <a href="../main/page-account-settings.html"
                                                        class="flex gap-3 items-center  group relative">
                                                        <span class="apps-icons">
                                                            <img src="../assets/images/svgs/icon-dd-lifebuoy.svg"
                                                                class="h-6 w-6">
                                                        </span>
                                                        <div class="">
                                                            <h6
                                                                class="font-semibold text-sm group-hover:text-primary ">
                                                                Account Setting App

                                                            </h6>
                                                            <p class="text-xs">
                                                                Account settings</p>
                                                        </div>

                                                    </a>
                                                </li>
                                                <li class="mb-5">
                                                    <a href="../main/app-notes.html"
                                                        class="flex gap-3 items-center group relative">
                                                        <span class="apps-icons">
                                                            <img src="../assets/images/svgs/icon-dd-application.svg"
                                                                class="h-6 w-6">
                                                        </span>
                                                        <div class="">
                                                            <h6
                                                                class="font-semibold text-sm group-hover:text-primary">
                                                                Notes Application

                                                            </h6>
                                                            <p class="text-xs">
                                                                To-do and Daily tasks</p>
                                                        </div>

                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div
                                            class="col-span-12 md:col-span-12 border-t border-border dark:border-darkborder hidden lg:flex items-stretch pt-4 pr-4">
                                            <div class="flex items-center justify-between w-full ">
                                                <div class="flex items-center text-dark dark:text-white group">
                                                    <i
                                                        class="ti ti-help text-lg text-dark dark:text-darklink group-hover:text-primary"></i>
                                                    <a href="../main/page-faq.html"
                                                        class="text-sm font-bold text-dark dark:text-darklink hover:text-primary  ml-2 group-hover:text-primary">
                                                        Frequently Asked Questions
                                                    </a>
                                                </div>
                                                <button type="button" class="btn py-2 px-4 ">
                                                    Check
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-4 col-span-12  flex items-strech">
                                    <div class="lg:p-5 lg:border-s border-border dark:border-darkborder">
                                        <h5 class="text-xl font-semibold mb-4 text-dark dark:text-white">
                                            Quick Links</h5>
                                        <ul>
                                            <li class="mb-4"><a href="../main/page-pricing.html"
                                                    class="card-title text-sm hover:text-primary">Pricing
                                                    Page</a></li>
                                            <li class="mb-4"><a href="../main/authentication-login.html"
                                                    class="card-title text-sm hover:text-primary">Authentication
                                                    Design</a></li>
                                            <li class="mb-4"><a href="../main/authentication-register.html"
                                                    class="card-title text-sm hover:text-primary">Register
                                                    Now</a></li>
                                            <li class="mb-4"><a href="../main/authentication-error.html"
                                                    class="card-title text-sm hover:text-primary">404
                                                    Error
                                                    Page</a></li>
                                            <li class="mb-4"><a href="../main/app-notes.html"
                                                    class="card-title text-sm hover:text-primary">Notes
                                                    App</a>
                                            </li>
                                            <li class="mb-4"><a href="../main/page-user-profile.html"
                                                    class="card-title text-sm hover:text-primary">User
                                                    Application</a></li>
                                            <li class="mb-4"><a href="../main/blog-posts.html"
                                                    class="card-title text-sm hover:text-primary">Blog
                                                    Design</a></li>
                                            <li class="mb-4"><a href="../main/eco-checkout.html"
                                                    class="card-title text-sm hover:text-primary">Shopping
                                                    Cart</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="../main/app-chat.html" class="header-link-btn">
                        <i class="ti ti-message-dots lg:hidden lg:text-sm text-xl"></i>Chat</a>
                </div>
                <div>
                    <a href="../main/app-calendar.html" class="header-link-btn">
                        <i class="ti ti-calendar lg:hidden lg:text-sm text-xl"></i>Calender</a>
                </div>
                <div>
                    <a href="../main/app-email.html" class="header-link-btn">
                        <i class="ti ti-mail lg:hidden lg:text-sm text-xl"></i>Email</a>
                </div>
            </div>
        </div>
    </div>



    <div id="hs-focus-management-modal"
        class="hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden w-full h-full fixed top-0 start-0 z-[60] opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none">
        <div
            class="hs-overlay-open:opacity-100 hs-overlay-open:duration-500 opacity-0 transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white dark:bg-dark  shadow-md dark:shadow-dark-md rounded-md pointer-events-auto">
                <div class="p-4 overflow-y-auto">
                    <input type="email" class="w-full form-control" placeholder="you@site.com" autofocus>
                </div>
                <div class="items-center gap-x-2 py-3 px-4 border-t border-border dark:border-darkborder">

                    <div class="overflow-hidden">
                        <h5 class="text-lg  mb-4 px-4">Quick Page Links</h5>
                        <div class="message-body max-h-[300px]" data-simplebar="">
                            <ul>
                                <li class="light-dark-hoverbg rounded-md  mb-2 px-4 py-2">
                                    <a href="#" class="font-semibold text-sm text-link dark:text-darklink ">
                                        Modern
                                        <p class="text-sm text-link dark:text-darklink opacity-50 font-normal">
                                            /dashboards/modern</p>
                                    </a>
                                </li>
                                <li class="light-dark-hoverbg rounded-md  mb-2 px-4 py-2">
                                    <a href="#" class="font-semibold text-sm text-link dark:text-darklink">
                                        eCommerce
                                        <p class="text-sm text-link dark:text-darklink opacity-50 font-normal">
                                            /dashboards/ecommerce</p>
                                    </a>
                                </li>
                                <li class="light-dark-hoverbg rounded-md  mb-2 px-4 py-2">
                                    <a href="#" class="font-semibold text-sm text-link dark:text-darklink">
                                        Contacts
                                        <p class="text-sm text-link dark:text-darklink opacity-50 font-normal">
                                            /apps/contacts</p>
                                    </a>
                                </li>
                                <li class="light-dark-hoverbg rounded-md  mb-2 px-4 py-2">
                                    <a href="#" class="font-semibold text-sm text-link dark:text-darklink">
                                        Shop
                                        <p class="text-sm text-link dark:text-darklink opacity-50 font-normal">
                                            /ecommerce/products</p>
                                    </a>
                                </li>
                                <li class="light-dark-hoverbg rounded-md  mb-2 px-4 py-2">
                                    <a href="#" class="font-semibold text-sm text-link dark:text-darklink">
                                        Checkout
                                        <p class="text-sm text-link dark:text-darklink opacity-50 font-normal">
                                            /ecommerce/checkout</p>
                                    </a>
                                </li>
                                <li class="light-dark-hoverbg rounded-md  mb-2 px-4 py-2">
                                    <a href="#" class="font-semibold text-sm text-link dark:text-darklink">
                                        Chats
                                        <p class="text-sm text-link dark:text-darklink opacity-50 font-normal">
                                            /apps/chats</p>
                                    </a>
                                </li>
                                <li class="light-dark-hoverbg rounded-md  mb-2 px-4 py-2">
                                    <a href="#" class="font-semibold text-sm text-link dark:text-darklink">
                                        Notes
                                        <p class="text-sm text-link dark:text-darklink opacity-50 font-normal">
                                            /apps/notes</p>
                                    </a>
                                </li>
                                <li class="light-dark-hoverbg rounded-md  mb-2 px-4 py-2">
                                    <a href="#" class="font-semibold text-sm text-link dark:text-darklink">
                                        Pricing
                                        <p class="text-sm text-link dark:text-darklink opacity-50 font-normal">
                                            /pages/pricing</p>
                                    </a>
                                </li>
                                <li class="light-dark-hoverbg rounded-md  mb-2 px-4 py-2">
                                    <a href="#" class="font-semibold text-sm text-link dark:text-darklink">
                                        Account Setting
                                        <p class="text-sm text-link dark:text-darklink opacity-50 font-normal">
                                            /pages/account-settings</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!------- Customizer Options--------->

    <div id="hs-overlay-right-cart"
        class=" bg-white hs-overlay  dark:bg-dark hs-overlay-open:translate-x-0  translate-x-full rtl:hs-overlay-open:translate-x-0  rtl:-translate-x-full  fixed top-0 right-0 rtl:left-0 rtl:right-auto transition-all duration-300 transform h-full max-w-xs  w-full z-[60] hidden "
        tabindex="-1">

        <div class="card-body h-full">
            <div class="flex items-center  justify-between mb-5">
                <h3 class="mb-0 text-lg">
                    Shopping Cart</h3>
                <span class="text-xs badge-md bg-primary text-white">
                    5 new</span>
            </div>
            <div data-simplebar="" class="h-full" style="max-height: calc(100vh - 270px);">
                <div class="flex flex-col gap-5">
                    <a href="#" class="flex gap-4">
                        <img class="object-cover w-[95px] h-[75px] rounded-md"
                            src="../assets/images/products/product-1.jpg" alt="" aria-hidden="true">
                        <div class="">
                            <h6 class="text-sm mb-1 hover:text-primary ">
                                Supreme toys cooker
                            </h6>
                            <p class="text-xs text-link dark:text-darklink font-normal">
                                Kitchenware Item</p>
                            <div class="flex justify-between items-center mt-1">
                                <h6 class="text-xs text-link dark:text-darklink ">
                                    $250
                                </h6>
                                <!----Input Quantity----->
                                <div class="flex" data-hs-input-number>
                                    <div class="flex items-center gap-x-1.5">
                                        <button type="button"
                                            class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm bg-lightsuccess dark:bg-darksuccess rounded-s-md"
                                            data-hs-input-number-decrement>
                                            <i class="ti ti-minus text-xs text-success"></i>
                                        </button>
                                        <input
                                            class="p-0 w-6 bg-transparent text-xs border-0 text-center text-link dark:text-darklink"
                                            type="text" value="0" data-hs-input-number-input>
                                        <button type="button"
                                            class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm bg-lightsuccess dark:bg-darksuccess rounded-e-md"
                                            data-hs-input-number-increment>
                                            <i class="ti ti-plus text-xs text-success"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- End Input Quantity Number -->
                            </div>
                        </div>
                    </a>

                    <a href="#" class="flex gap-4">
                        <img class="object-cover w-[95px] h-[75px] rounded-md"
                            src="../assets/images/products/product-2.jpg" alt="" aria-hidden="true">
                        <div class="">
                            <h6 class="text-sm  mb-1  hover:text-primary ">
                                Supreme toys cooker
                            </h6>
                            <p class="text-xs text-link dark:text-darklink font-normal">
                                Kitchenware Item</p>
                            <div class="flex justify-between items-center mt-1">
                                <h6 class="font-semibold text-xs text-link dark:text-darklink ">
                                    $250
                                </h6>
                                <!----Input Quantity----->
                                <div class="flex" data-hs-input-number>
                                    <div class="flex items-center gap-x-1.5">
                                        <button type="button"
                                            class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm bg-lightsuccess dark:bg-darksuccess rounded-s-md"
                                            data-hs-input-number-decrement>
                                            <i class="ti ti-minus text-xs text-success"></i>
                                        </button>
                                        <input
                                            class="p-0 w-6 bg-transparent text-xs border-0 text-center text-link dark:text-darklink"
                                            type="text" value="0" data-hs-input-number-input>
                                        <button type="button"
                                            class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm bg-lightsuccess dark:bg-darksuccess rounded-e-md"
                                            data-hs-input-number-increment>
                                            <i class="ti ti-plus text-xs text-success"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- End Input Quantity Number -->
                            </div>
                        </div>
                    </a>
                    <a href="#" class="flex gap-4">
                        <img class="object-cover w-[95px] h-[75px] rounded-md"
                            src="../assets/images/products/product-3.jpg" alt="" aria-hidden="true">
                        <div class="">
                            <h6 class="text-sm  mb-1 hover:text-primary ">
                                Supreme toys cooker
                            </h6>
                            <p class="text-xs text-link dark:text-darklink font-normal">
                                Kitchenware Item</p>
                            <div class="flex justify-between items-center mt-1">
                                <h6 class="font-semibold text-xs text-link dark:text-darklink ">
                                    $250
                                </h6>
                                <!----Input Quantity----->
                                <div class="flex" data-hs-input-number>
                                    <div class="flex items-center gap-x-1.5">
                                        <button type="button"
                                            class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm bg-lightsuccess dark:bg-darksuccess rounded-s-md"
                                            data-hs-input-number-decrement>
                                            <i class="ti ti-minus text-xs text-success"></i>
                                        </button>
                                        <input
                                            class="p-0 w-6 bg-transparent text-xs border-0 text-center text-link dark:text-darklink"
                                            type="text" value="0" data-hs-input-number-input>
                                        <button type="button"
                                            class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm bg-lightsuccess dark:bg-darksuccess rounded-e-md"
                                            data-hs-input-number-increment>
                                            <i class="ti ti-plus text-xs text-success"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- End Input Quantity Number -->
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-------Qty Footer-------->
            <div class="mt-8 flex flex-col gap-8">
                <div class="flex justify-between ">
                    <div class="text-sm text-link dark:text-darklink">Sub Total</div>
                    <h6 class="font-semibold text-sm text-link dark:text-darklink">$2530</h6>
                </div>
                <div class="flex justify-between ">
                    <div class="text-sm text-link dark:text-darklink">Total</div>
                    <h6 class="font-semibold text-sm text-link dark:text-darklink">$6830</h6>
                </div>
                <a href="../main/eco-checkout.html" class="btn btn-outline-primary">Go to shopping cart </a>
            </div>


        </div>


    </div>
    <!------- Customizer button--------->
    <button type="button"
        class="btn overflow-hidden  sm:h-14 sm:w-14 h-10 w-10 rounded-full fixed sm:bottom-8 bottom-5 right-8 flex justify-center items-center rtl:left-8 rtl:right-auto z-10"
        data-hs-overlay="#hs-overlay-right">
        <i class="ti ti-settings sm:text-2xl text-lg text-white"></i>
    </button>

    <!------- Customizer Options--------->
    <div id="hs-overlay-right"
        class="customizer  rounded-none hs-overlay bg-white dark:bg-dark hs-overlay-open:translate-x-0  translate-x-full rtl:hs-overlay-open:translate-x-0  rtl:-translate-x-full  fixed top-0 right-0 rtl:left-0 rtl:right-auto transition-all duration-300 transform h-full max-w-xs  w-full z-[60] hidden "
        tabindex="-1">
        <div class="flex justify-between items-center  border-border dark:border-darkborder  border-b py-3 px-6 ">
            <h3 class="font-semibold text-lg text-dark dark:text-white">
                Settings
            </h3>
            <button type="button"
                class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white text-sm "
                data-hs-overlay="#hs-overlay-right">
                <span class="sr-only">Close modal</span>
                <i class="ti ti-x text-xl text-dark dark:text-white"></i>
            </button>
        </div>

        <!-------Light/Dark Theme--------->
        <div class="px-6 py-6" data-simplebar="" style="height: calc(100vh - 80px)">
            <h6 class="font-semibold text-dark dark:text-white mb-2">Theme</h6>
            <div class="flex flex-row gap-3 customizer-box mb-8" role="group">
                <input type="radio" class=" btn-check" name="theme-layout" autocomplete="off" />
                <label
                    class="btn btn-outline border border-border dark:border-darkborder text-primary h-full py-3 px-5 hs-dark-mode-active:text-darklink cursor-pointer"
                    for="light-layout" data-hs-theme-click-value="light"><i
                        class="icon ti ti-sun text-2xl me-2 "></i> Light</label>
                <input type="radio" class="btn-check" name="theme-layout" autocomplete="off" />
                <label
                    class="btn btn-outline border border-border dark:border-darkborder text-link  h-full py-3 px-5 cursor-pointer hs-dark-mode-active:text-primary"
                    for="dark-layout" data-hs-theme-click-value="dark"><i
                        class="icon ti ti-moon text-2xl me-2 "></i> Dark</label>
            </div>

            <!-------Theme Direction--------->
            <h6 class="font-semibold mb-2 text-dark dark:text-white">Theme Direction</h6>
            <div class="flex flex-row gap-3 customizer-box mb-8" role="group">
                <input type="radio" class="btn-check" name="direction-l" id="ltr-layout"
                    autocomplete="off" />
                <label
                    class="btn btn-outline border border-border dark:border-darkborder text-link dark:text-darklink h-full py-3 px-5 cursor-pointer"
                    for="ltr-layout"><i class="icon ti ti-text-direction-ltr text-2xl me-2"></i>LTR</label>
                <input type="radio" class="btn-check" name="direction-l" id="rtl-layout"
                    autocomplete="off" />
                <label
                    class="btn btn-outline border border-border dark:border-darkborder text-link dark:text-darklink h-full py-3 px-5 cursor-pointer"
                    for="rtl-layout">
                    <i class="icon ti ti-text-direction-rtl text-2xl me-2"></i>RTL</label>
            </div>

            <!-------Theme Colors--------->
            <h6 class="font-semibold mb-2 text-dark dark:text-white">Theme Colors</h6>
            <div class="flex flex-row flex-wrap gap-3 customizer-box color-pallete mb-8" role="group">
                <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme"
                    autocomplete="off" />
                <label
                    class="hs-tooltip btn py-4 px-5 btn-outline border border-border dark:border-darkborder flex items-center  justify-center hs-tooltip-toggle cursor-pointer"
                    onclick="handleColorTheme('Blue_Theme')" for="Blue_Theme" data-bs-title="BLUE_THEME">
                    <div class="color-box rounded-full flex items-center justify-center skin-1">
                        <i class="ti ti-check  flex icon text-white fs-5"></i>
                    </div>
                    <span
                        class="rounded-md hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0  absolute invisible z-10 text-fs_12 py-1 px-2 bg-dark dark:bg-darkgray  text-white dark:text-gray-300"
                        role="tooltip">
                        Blue_Theme
                    </span>
                </label>

                <input type="radio" class="btn-check" name="color-theme-layout" id="Aqua_Theme"
                    autocomplete="off" />
                <label
                    class="hs-tooltip hs-tooltip-toggle btn py-4 px-5 btn-outline border border-border dark:border-darkborder flex items-center  justify-center cursor-pointer"
                    onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-title="AQUA_THEME">
                    <div class="color-box rounded-full flex items-center justify-center skin-2">
                        <i class="ti ti-check text-white flex icon fs-5"></i>
                    </div>
                    <span
                        class="rounded-md hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0  absolute invisible z-10 text-fs_12 py-1 px-2 bg-dark dark:bg-darkgray  text-white dark:text-gray-300"
                        role="tooltip">
                        Aqua_Theme
                    </span>
                </label>

                <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme"
                    autocomplete="off" />
                <label
                    class="hs-tooltip hs-tooltip-toggle btn py-4 px-5 btn-outline border border-border dark:border-darkborder flex items-center  justify-center cursor-pointer"
                    onclick="handleColorTheme('Purple_Theme')" for="Purple_Theme" data-bs-title="PURPLE_THEME">
                    <div class="color-box rounded-full flex items-center justify-center skin-3">
                        <i class="ti ti-check text-white flex icon fs-5"></i>
                    </div>
                    <span
                        class="rounded-md hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0  absolute invisible z-10 text-fs_12 py-1 px-2 bg-dark dark:bg-darkgray  text-white dark:text-gray-300"
                        role="tooltip">
                        Purple_Theme
                    </span>
                </label>

                <input type="radio" class="btn-check" name="color-theme-layout" id="green-theme-layout"
                    autocomplete="off" />
                <label
                    class="hs-tooltip hs-tooltip-toggle btn py-4 px-5 btn-outline border border-border dark:border-darkborder flex items-center  justify-center cursor-pointer"
                    onclick="handleColorTheme('Green_Theme')" for="green-theme-layout"
                    data-bs-title="GREEN_THEME">
                    <div class="color-box rounded-full flex items-center justify-center skin-4">
                        <i class="ti ti-check text-white flex icon fs-5"></i>
                    </div>
                    <span
                        class="rounded-md hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0  absolute invisible z-10 text-fs_12 py-1 px-2 bg-dark dark:bg-darkgray  text-white dark:text-gray-300"
                        role="tooltip">
                        Green_Theme
                    </span>
                </label>

                <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout"
                    autocomplete="off" />
                <label
                    class="hs-tooltip hs-tooltip-toggle btn py-4 px-5 btn-outline border border-border dark:border-darkborder flex items-center  justify-center cursor-pointer"
                    onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout" data-bs-title="CYAN_THEME">
                    <div class="color-box rounded-full flex items-center justify-center skin-5">
                        <i class="ti ti-check text-white flex icon fs-5"></i>
                    </div>
                    <span
                        class="rounded-md hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0  absolute invisible z-10 text-fs_12 py-1 px-2 bg-dark dark:bg-darkgray  text-white dark:text-gray-300"
                        role="tooltip">
                        Cyan_Theme
                    </span>
                </label>

                <input type="radio" class="btn-check" name="color-theme-layout" id="orange-theme-layout"
                    autocomplete="off" />
                <label
                    class="hs-tooltip hs-tooltip-toggle btn py-4 px-5 btn-outline border border-border dark:border-darkborder flex items-center  justify-center cursor-pointer"
                    onclick="handleColorTheme('Orange_Theme')" for="orange-theme-layout"
                    data-bs-title="ORANGE_THEME">
                    <div class="color-box rounded-full flex items-center justify-center skin-6">
                        <i class="ti ti-check text-white flex icon fs-5"></i>
                    </div>
                    <span
                        class="rounded-md hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0  absolute invisible z-10 text-fs_12 py-1 px-2 bg-dark dark:bg-darkgray  text-white dark:text-gray-300"
                        role="tooltip">
                        Orange_Theme
                    </span>
                </label>
            </div>

            <!-- Layput Options  -->
            <h6 class="font-semibold mb-2 text-dark dark:text-white">Layout Type</h6>
            <div class="flex flex-row gap-3 customizer-box mb-8" role="group">
                <div>
                    <input type="radio" class="btn-check" name="page-layout" id="vertical-layout"
                        autocomplete="off" />
                    <label
                        class="btn btn-outline border border-border dark:border-darkborder text-link dark:text-darklink h-full py-3 px-5 cursor-pointer"
                        for="vertical-layout">
                        <i class="icon ti ti-layout-sidebar-right text-2xl me-2"></i> Vertical</label>
                </div>
                <div>
                    <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout"
                        autocomplete="off" />
                    <label
                        class="btn btn-outline border border-border dark:border-darkborder text-link dark:text-darklink h-full py-3 px-5 cursor-pointer"
                        for="horizontal-layout">
                        <i class=" icon ti ti-layout-navbar text-2xl me-2"></i> Horizontal</label>
                </div>
            </div>

            <!-- Container Options  -->
            <h6 class="font-semibold mb-2 text-dark dark:text-white">Container Option</h6>
            <div class="flex flex-row gap-3 customizer-box mb-8" role="group">
                <input type="radio" class="btn-check" name="layout" id="boxed-layout" autocomplete="off" />
                <label
                    class="btn btn-outline border border-border dark:border-darkborder text-link dark:text-darklink h-full py-3 px-5 cursor-pointer"
                    for="boxed-layout">
                    <i class="icon ti ti-layout-distribute-vertical text-2xl me-2"></i>
                    Boxed</label>

                <input type="radio" class="btn-check" name="layout" id="full-layout" autocomplete="off" />
                <label
                    class="btn btn-outline border border-border dark:border-darkborder text-link dark:text-darklink h-full py-3 px-5 cursor-pointer"
                    for="full-layout">
                    <i class="icon ti ti-layout-distribute-horizontal text-2xl me-2"></i> Full</label>
            </div>

            <!-- Sidebar Type Options  -->
            <h6 class="font-semibold mb-2 text-dark dark:text-white">Sidebar Type</h6>
            <div class="flex flex-row gap-3 customizer-box mb-8" role="group">
                <a href="javascript:void(0)" class="fullsidebar">
                    <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar"
                        autocomplete="off" />
                    <label
                        class="btn btn-outline border border-border dark:border-darkborder text-link dark:text-darklink h-full py-3 px-5 cursor-pointer"
                        for="full-sidebar"><i class="icon ti ti-layout-sidebar-right text-2xl me-2"></i>
                        Full</label>
                </a>
                <div>
                    <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar"
                        autocomplete="off" />
                    <label
                        class="btn btn-outline border border-border dark:border-darkborder text-link dark:text-darklink h-full py-3 px-5 cursor-pointer"
                        for="mini-sidebar">
                        <iconify-icon icon="solar:siderbar-outline"
                            class="icon fs-7 me-2"></iconify-icon>Collapse</label>
                </div>
            </div>

            <!-- Border-sahdow Card Options  -->
            <h6 class="font-semibold mb-2 text-dark dark:text-white">Card With</h6>
            <div class="flex flex-row gap-3 customizer-box mb-8" role="group">
                <input type="radio" class="btn-check" name="card-layout" id="card-with-border"
                    autocomplete="off" />
                <label
                    class="btn btn-outline border border-border dark:border-darkborder text-link dark:text-darklink h-full py-3 px-5 cursor-pointer"
                    for="card-with-border"><i class="icon ti ti-border-outer text-2xl me-2"></i>Border</label>

                <input type="radio" class="btn-check" name="card-layout" id="card-without-border"
                    autocomplete="off" />
                <label
                    class="btn btn-outline border border-border dark:border-darkborder text-link dark:text-darklink h-full py-3 px-5 cursor-pointer"
                    for="card-without-border">
                    <i class="icon ti ti-border-none text-2xl me-2"></i>Shadow</label>
            </div>

        </div>
    </div>

    <script>
        function handleColorTheme(e) {
            document.documentElement.setAttribute("data-color-theme", e);
        }
    </script>
    <script src="../assets/js/vendor.min.js"></script>

    <script src="../assets/js/theme/app.init.js"></script>
    <script src="../assets/js/theme/app.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../assets/libs/preline/dist/preline.js"></script>
    <script src="../assets/libs/@preline/input-number/index.js"></script>
    <script src="../assets/libs/@preline/tooltip/index.js"></script>
    <script src="../assets/libs/@preline/stepper/index.js"></script>



    <script src="../assets/libs/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/js/dashboards/dashboard.js"></script>
</body>

</html>

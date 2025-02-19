<header
    class="sticky top-header top-0 inset-x-0 z-[1] flex flex-wrap md:justify-start md:flex-nowrap text-sm bg-white dark:bg-dark ">
    <div class="with-vertical w-full py-3">
        <div class="w-full mx-auto px-4 lg:py-1 py-3 lg:px-4" aria-label="Global">
            <div class="relative md:flex md:items-center md:justify-between">
                <div class="hs-collapse  grow md:block">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <div class="relative">
                                <a class="xl:flex hidden text-xl icon-hover cursor-pointer text-link dark:text-darklink sidebartoggler h-10 w-10 hover:text-primary light-dark-hoverbg  justify-center items-center rounded-full"
                                    id="headerCollapse" href="javascript:void(0)">
                                    <i class="ti ti-menu-2 relative z-[1] "></i>
                                </a>
                                <!--Mobile Sidebar Toggle -->
                                <div class="sticky top-0 inset-x-0 xl:hidden">
                                    <div class="flex items-center">
                                        <!-- Navigation Toggle -->
                                        <a class="text-xl icon-hover cursor-pointer text-link dark:text-darklink sidebartoggler h-10 w-10 hover:text-primary light-dark-hoverbg flex justify-center items-center rounded-full"
                                            data-hs-overlay="#application-sidebar-brand"
                                            aria-controls="application-sidebar-brand" aria-label="Toggle navigation">
                                            <i class="ti ti-menu-2 relative z-[1] "></i>
                                        </a>
                                        <!-- End Navigation Toggle -->
                                    </div>
                                </div>
                                <!-- End Sidebar Toggle -->
                            </div>

                            <a class="hidden lg:flex relative hs-dropdown-toggle cursor-pointer text-xl hover:text-primary text-link dark:text-darklink h-10 w-10 light-dark-hoverbg  justify-center items-center rounded-full"
                                data-hs-overlay="#hs-focus-management-modal">
                                <i class="ti ti-search relative"></i>
                            </a>

                            <div class="lg:hidden">
                                <button type="button"
                                    class="p-2 inline-flex h-10 w-10 text-link dark:text-darklink hover:text-primary light-dark-hoverbg  justify-center items-center rounded-full"
                                    data-hs-overlay="#navbar-offcanvas-example-menu"
                                    aria-controls="navbar-offcanvas-example-menu" aria-label="Toggle navigation">
                                    <i class="ti ti-apps text-xl"></i>
                                </button>
                            </div>

                            <!-- Menu-->
                            <div id="navbar-offcanvas-example"
                                class="hs-overlay hs-overlay-open:translate-x-0 z-[2] -translate-x-full fixed top-0 start-0 transition-all duration-300 transform h-full max-w-xs bg-white dark:bg-dark  basis-full grow sm:order-1 lg:static lg:block lg:h-auto sm:max-w-none w-[270px] lg:border-r-transparent lg:transition-none lg:translate-x-0  lg:basis-auto hidden "
                                tabindex="-1" data-hs-overlay-close-on-resize>
                                <div class="lg:flex gap-2  items-center ">
                                    <div class="flex lg:hidden lg:p-0 p-5">
                                        <div class="brand-logo flex  items-center ">
                                            <a href="../main/index.html" class="text-nowrap logo-img">
                                                <img src="{{ asset('assets/images/logos/logo.png') }}"
                                                    class="block w-48" alt="Logo" />
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="icon-nav items-center gap-3 lg:gap-4 flex">
                            <!-- Theme Toggle  -->
                            <button type="button"
                                class="hs-dark-mode-active:hidden icon-hover block hs-dark-mode group items-center font-medium hover:text-primary text-link dark:text-darklink h-10 w-10 light-dark-hoverbg  justify-center rounded-full"
                                data-hs-theme-click-value="dark" id="dark-layout">
                                <i
                                    class="ti ti-moon text-xl  text-link dark:text-darklink relative  hover:text-primary"></i>
                            </button>
                            <button type="button"
                                class="hs-dark-mode-active:block icon-hover hidden hs-dark-mode group  items-center  font-medium hover:text-primary text-link dark:text-darklink h-10 w-10 light-dark-hoverbg  justify-center rounded-full"
                                data-hs-theme-click-value="light" id="light-layout">
                                <i
                                    class="ti ti-sun text-xl  text-link dark:text-darklink relative  hover:text-primary"></i>
                            </button>

                            <!-- Notifications DD -->

                            <div
                                class="hs-dropdown [--strategy:absolute] [--adaptive:none] sm:[--trigger:hover] sm:relative group/menu">
                                <a id="hs-dropdown-hover-event-notification"
                                    class="relative hs-dropdown-toggle h-10 w-10 text-link dark:text-darklink cursor-pointer hover:bg-lightprimary  hover:text-primary dark:hover:bg-darkprimary flex justify-center items-center rounded-full group-hover/menu:bg-lightprimary group-hover/menu:text-primary">
                                    <i class="ti ti-bell-ringing text-xl relative z-[1]"></i>
                                    <div
                                        class="absolute inline-flex items-center justify-center  text-white text-[11px] font-medium  bg-primary p-[5px] rounded-full -top-[-5px] -right-[0px]">
                                    </div>
                                </a>
                                <div class="card hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 right-0 rtl:right-auto rtl:left-0 mt-2 min-w-max top-auto w-full sm:w-[360px] hidden z-[2]"
                                    aria-labelledby="hs-dropdown-hover-event-notification">
                                    <div class="flex items-center py-4 px-7 justify-between">
                                        <h3 class="mb-0 card-title">
                                            Notifications</h3>
                                        <span class="text-xs badge-md bg-primary text-white">5
                                            new</span>
                                    </div>
                                    <div class="message-body max-h-[350px]" data-simplebar="">
                                        <a href="javascript:void(0)"
                                            class="px-7 py-3 flex items-center light-dark-hoverbg">
                                            <span
                                                class="flex-shrink-0 h-12 w-12 rounded-full bg-lightprimary dark:bg-darkprimary flex justify-center items-center">
                                                <i class="ti ti-dashboard text-primary text-xl"></i>
                                            </span>
                                            <div class="ps-4">
                                                <h5 class="text-sm">
                                                    Launch Admin
                                                </h5>
                                                <span>Just see the my new
                                                    admin!</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="px-7 py-3 flex items-center light-dark-hoverbg">
                                            <span
                                                class="flex-shrink-0 h-12 w-12 rounded-full bg-lighterror dark:bg-darkerror flex justify-center items-center">
                                                <i class="ti ti-screen-share text-error text-xl"></i>
                                            </span>
                                            <div class="ps-4">
                                                <h5 class="text-sm">
                                                    Meeting Today
                                                </h5>
                                                <span>Check your schedule</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="px-7 py-3 flex items-center light-dark-hoverbg">
                                            <span
                                                class="flex-shrink-0 h-12 w-12 rounded-full bg-lightsuccess dark:bg-darksuccess flex justify-center items-center">
                                                <i class="ti ti-coin text-success text-xl"></i>
                                            </span>
                                            <div class="ps-4">
                                                <h5 class="text-sm">
                                                    New Payment received
                                                </h5>
                                                <span>Check
                                                    your
                                                    earnings</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="px-7 py-3 flex items-center light-dark-hoverbg">
                                            <span
                                                class="flex-shrink-0 h-12 w-12 rounded-full bg-lightwarning dark:bg-darkwarning flex justify-center items-center">
                                                <i class="ti ti-credit-card text-warning text-xl"></i>
                                            </span>
                                            <div class="ps-4">
                                                <h5 class="text-sm">
                                                    Pay Bills
                                                </h5>
                                                <span>Just a reminder that you have pay</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="px-7 py-3 flex items-center light-dark-hoverbg">
                                            <span
                                                class="flex-shrink-0 h-12 w-12 rounded-full bg-lightinfo dark:bg-darkinfo flex justify-center items-center">
                                                <i class="ti ti-calendar-month text-info text-xl font-thin"></i>
                                            </span>
                                            <div class="ps-4">
                                                <h5 class="text-sm">
                                                    Go for Event
                                                </h5>
                                                <span>Just a reminder for
                                                    event</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="pt-3 pb-6 px-7">
                                        <a href="#" class="btn btn-outline-primary block w-full">
                                            See All Notifications
                                        </a>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>

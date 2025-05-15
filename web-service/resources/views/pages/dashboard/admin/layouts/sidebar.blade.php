<aside id="application-sidebar-brand"
    class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full xl:rtl:-translate-x-0 rtl:translate-x-full  left-0 rtl:left-auto rtl:right-0 transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed top-0 with-vertical left-sidebar transition-all duration-300 h-screen xl:z-[2] z-[60] flex-shrink-0 border-r rtl:border-l rtl:border-r-0 w-[270px] border-border dark:border-darkborder bg-white dark:bg-dark">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="py-5 px-5">
        <div class="brand-logo">
            <a href="#" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/logo-nutcastle.png') }}" class="block w-14" alt="Logo" />
            </a>
        </div>
    </div>

    <div class="overflow-hidden">
        <div class="scroll-sidebar" data-simplebar="">
            <div class="px-6 mt-8 mini-layout" data-te-sidenav-menu-ref>
                <nav class="hs-accordion-group w-full flex flex-col">
                    <ul data-te-sidenav-menu-ref id="sidebarnav">
                        <div class="caption">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">{{ __('app.home') }}</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('dashboard') ? 'activemenu' : '' }}" href="{{ route('dashboard') }}">
                                <i class="ti ti-layout-dashboard text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.dashboard') }}</span>
                            </a>
                        </li>

                        @if(auth()->check() && auth()->user()->role && auth()->user()->role->name === 'pelanggan')
                        <div class="caption mt-8">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">{{ __('app.my_data') }}</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('customer.checkups.*') ? 'activemenu' : '' }}" href="{{ route('customer.checkups.index') }}">
                                <i class="ti ti-heartbeat text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.my_checkup_data') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('customer.consultation-schedules.*') ? 'activemenu' : '' }}" href="{{ route('customer.consultation-schedules.index') }}">
                                <i class="ti ti-calendar text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.my_consultation_schedules') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('customer.diet-recommendations.*') ? 'activemenu' : '' }}" href="{{ route('customer.diet-recommendations.index') }}">
                                <i class="ti ti-message-2 text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.my_diet_recommendations') }}</span>
                            </a>
                        </li>
                        @endif
                        
                        @if(auth()->check() && auth()->user()->role && in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi']))
                        <div class="caption mt-8">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">{{ __('app.management') }}</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('admin.users.*') ? 'activemenu' : '' }}" href="{{ route('admin.users.index') }}">
                                <i class="ti ti-users text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.manage_users') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('diet-programs.*') ? 'activemenu' : '' }}" href="{{ route('diet-programs.index') }}">
                                <i class="ti ti-apple text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.manage_diet_programs') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('llm-contexts.*') ? 'activemenu' : '' }}" href="{{ route('llm-contexts.index') }}">
                                <i class="ti ti-message-circle text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.llm_contexts') }}</span>
                            </a>
                        </li>
                        
                        
                        <div class="caption mt-8">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">{{ __('app.customer_data') }}</span>
                        </div>
                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('customers.*') ? 'activemenu' : '' }}" href="#">
                                <i class="ti ti-users text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.customer_data') }}</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('checkups.*') ? 'activemenu' : '' }}" href="{{ route('checkups.index') }}">
                                <i class="ti ti-heartbeat text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.customer_checkup_data') }}</span>
                            </a>
                        </li>
                        
                        <div class="caption mt-8">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">{{ __('app.prediction_recommendation') }}</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('predictions.*') ? 'activemenu' : '' }}" href="{{ route('predictions.index') }}">
                                <i class="ti ti-brain text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.diet_program_prediction') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('enrollments.*') ? 'activemenu' : '' }}" href="{{ route('enrollments.index') }}">
                                <i class="ti ti-clipboard-check text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.program_registration') }}</span>
                            </a>
                        </li>
                        
                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('recommendations.*') ? 'activemenu' : '' }}" href="#">
                                <i class="ti ti-message text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.diet_recommendation') }}</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('diet-recommendations.*') ? 'activemenu' : '' }}" href="{{ route('diet-recommendations.index') }}">
                                <i class="ti ti-message-2 text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.diet_recommendations') }}</span>
                            </a>
                        </li>
                        @endif
                        @if(auth()->check() && auth()->user()->role && !in_array(auth()->user()->role->name, ['pelanggan']))
                        <div class="caption mt-8">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">{{ __('app.consultation') }}</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('consultation-schedules.*') ? 'activemenu' : '' }}" href="{{ route('consultation-schedules.index') }}">
                                <i class="ti ti-calendar text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.schedule') }}</span>
                            </a>
                        </li>
                        @endif
                        <div class="caption mt-8">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">{{ __('app.settings') }}</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('account.settings') ? 'activemenu' : '' }}" href="{{ route('account.settings') }}">
                                <i class="ti ti-settings text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.account_settings') }}</span>
                            </a>
                        </li>

                        @if(auth()->check() && auth()->user()->role && in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi']))
                        <div class="caption mt-8">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">{{ __('app.reports_analysis') }}</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('reports.*') ? 'activemenu' : '' }}" href="{{ route('reports.index') }}">
                                <i class="ti ti-file-report text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">{{ __('app.reports') }}</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</aside>

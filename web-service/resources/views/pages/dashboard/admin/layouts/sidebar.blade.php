<aside id="application-sidebar-brand"
    class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full xl:rtl:-translate-x-0 rtl:translate-x-full  left-0 rtl:left-auto rtl:right-0 transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed top-0 with-vertical left-sidebar transition-all duration-300 h-screen xl:z-[2] z-[60] flex-shrink-0 border-r rtl:border-l rtl:border-r-0 w-[270px] border-border dark:border-darkborder bg-white dark:bg-dark">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="py-5 px-5">
        <div class="brand-logo">
            <a href="#" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/lightbulb.png') }}" class="block w-8" alt="Logo" />
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
                            <span class="hide-menu">Home</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link" href="{{ route('dashboard') }}">
                                <i class="ti ti-layout-dashboard text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">Dashboard</span>
                            </a>
                        </li>

                        @if(auth()->check() && auth()->user()->role && in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi']))
                        <div class="caption mt-8">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">Administrasi</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link" href="{{ route('admin.users.index') }}">
                                <i class="ti ti-users text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">Kelola Pengguna</span>
                            </a>
                        </li>
                        

                        <div class="caption mt-8">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">Data Pelanggan</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link" href="#">
                                <i class="ti ti-users text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">Data Pelanggan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link" href="#">
                                <i class="ti ti-heartbeat text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">Data Checkup Pelanggan</span>
                            </a>
                        </li>
                        @endif
                        <div class="caption mt-8">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">Prediksi & Rekomendasi</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link" href="{{ route('predictions.index') }}">
                                <i class="ti ti-brain text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">Prediksi Program Diet</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link" href="#">
                                <i class="ti ti-message text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">Rekomendasi Diet</span>
                            </a>
                        </li>
                        <div class="caption mt-8">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">Konsultasi</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link" href="#">
                                <i class="ti ti-calendar text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">Jadwal</span>
                            </a>
                        </li>
                        <div class="caption mt-8">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">Pengaturan</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link" href="{{ route('account.settings') }}">
                                <i class="ti ti-settings text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">Pengaturan Akun</span>
                            </a>
                        </li>

                        @if(auth()->check() && auth()->user()->role && in_array(auth()->user()->role->name, ['ahli gizi', 'asisten ahli gizi']))
                        <div class="caption mt-8">
                            <i class="ti ti-dots nav-small-cap-icon "></i>
                            <span class="hide-menu">Laporan & Analisis</span>
                        </div>
                        <li class="sidebar-item">
                            <a class="sidebar-link dark-sidebar-link" href="#">
                                <i class="ti ti-file-report text-xl flex-shrink-0"></i> <span
                                    class="hide-menu flex-shrink-0">Laporan</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</aside>

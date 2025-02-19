<aside id="application-sidebar-brand"
    class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full xl:rtl:-translate-x-0 rtl:translate-x-full  left-0 rtl:left-auto rtl:right-0 transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed top-0 with-vertical  left-sidebar transition-all duration-300 h-screen xl:z-[2] z-[60] flex-shrink-0 border-r rtl:border-l rtl:border-r-0 w-[270px] border-border dark:border-darkborder bg-white dark:bg-dark">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="py-5 px-5 flex justify-between">
        <div class="brand-logo flex justify-center w-full  items-center ">
            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/logo.png') }}" class="block w-48" alt="Logo" />
            </a>
        </div>
    </div>

    <div class="overflow-hidden">
        <div class="scroll-sidebar" data-simplebar="">
            <div class="px-6 mt-8 mini-layout" data-te-sidenav-menu-ref>
                <nav class="hs-accordion-group w-full flex flex-col">
                    <ul data-te-sidenav-menu-ref id="sidebarnav">

                    </ul>
                </nav>
            </div>
        </div>
    </div>

</aside>

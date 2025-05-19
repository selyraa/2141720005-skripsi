<header
    class="sticky top-header top-0 inset-x-0 z-[5] flex flex-wrap md:justify-start md:flex-nowrap text-sm px-0 sm:py-6 py-3  bg-white dark:bg-dark ">
    <div class="container container-xl flex items-center">
        <div class="flex-1">
            <div class="brand-logo flex  items-center ">
                <a href="../main/index.html" class="text-nowrap logo-img">
                    <img src="../assets/images/logos/logo-nutcastle.png" class="dark:hidden block rtl:hidden w-20" alt="Logo-Dark" />
                    <img src="../assets/images/logos/logo-nutcastle.png" class="dark:block hidden rtl:hidden rtl:dark:hidden"
                        alt="Logo-light" />

                    <img src="../assets/images/logos/dark-logo-rtl.svg"
                        class="dark:hidden hidden rtl:block rtl:dark:hidden" alt="Logo-Dark" />
                    <img src="../assets/images/logos/light-logo-rtl.svg"
                        class="dark:hidden hidden rtl:hidden rtl:dark:block" alt="Logo-light" />
                </a>
            </div>
        </div>
        <!---Lp Mobile Toggle Icons--->
        <div class="xl:hidden">
            <a class="rounded-full icon-hover h-10 w-10 flex justify-center text-link dark:text-darklink items-center hover:text-primary  relative hover:bg-lightprimary dark:hover:bg-darkprimary "
                data-hs-overlay="#application-sidebar-lp">
                <i class="ti ti-menu-2 text-xl relative "></i>
            </a>
        </div>

        <!-- Menu-->
        <div>
            <ul class="xl:flex hidden items-center gap-7">
                <li>
                    <a href="#"
                        class="hover:text-primary dark:hover:text-primary text-link dark:text-darklink text-base">Home</a>
                </li>
                <li>
                    <a href="#about-us"
                        class="hover:text-primary dark:hover:text-primary text-link dark:text-darklink text-base">About Us</a>
                </li>
                <li>
                    <a href="#services"
                        class="hover:text-primary dark:hover:text-primary text-link dark:text-darklink text-base">Services</a>
                </li>
                <li>
                    <a href="#activities"
                        class="hover:text-primary dark:hover:text-primary text-link dark:text-darklink text-base">Activities</a>
                </li>
                <li>
                    <a href="#location"
                        class="hover:text-primary dark:hover:text-primary text-link dark:text-darklink text-base">Location</a>
                </li>
                <li>
                    <a href="{{ route('login') }}" class="btn">Login</a>
                </li>
            </ul>
        </div>
    </div>
</header>

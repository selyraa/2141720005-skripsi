@extends('pages.landing.layouts.app')

@section('content')
    <div class="max-w-full">

        <!-- Hero Section -->
        <section class="hero-section overflow-hidden items-center mb-12">
            <div class="container container-xl">
                <div class="grid grid-cols-12 gap-6 items-center">
                    <div class="xl:col-span-6 col-span-12">
                        <div class="xl:pt-0 pt-8">
                            <h6 class="flex items-center gap-2 text-base mb-3" data-aos="fade-up" data-aos-delay="200"
                                data-aos-duration="1000">
                                <i class="ti ti-rocket text-secondary text-lg"></i>Kick
                                start
                                your project with
                            </h6>
                            <h1 class="font-bold mb-7 lg:text-[55px] lg:leading-[66px] text-4xl" data-aos="fade-up"
                                data-aos-delay="400" data-aos-duration="1000">
                                Bimbel
                                <br>
                                <span class="text-primary">
                                    ASN Indonesia</span>
                            </h1>
                            <p class="text-lg mb-10" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                                Belajar seru dengan para Mentor ASN Terbaik! Yuk gabung bersama kami dan taklukan tes CPNS
                                dengan mudah!
                            </p>
                            <div class="md:flex  items-center  gap-3.5" data-aos="fade-up" data-aos-delay="800"
                                data-aos-duration="1000">
                                <a class="btn py-3 px-12 mb-3 sm:mb-0 flex justify-center"
                                    href="../main/authentication-login.html">Masuk</a>
                                <a class="btn btn-outline-primary scroll-link px-6 py-3 flex justify-center"
                                    href="#production-template">Daftar</a>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-6 col-span-12 xl:block hidden">
                        <div class="hero-img-slide position-relative bg-lightprimary p-4 rounded overflow-hidden">
                            <div class="flex flex-row">
                                <div class>
                                    <div class="banner-img-1 slideup">
                                        <img src="../assets/images/hero-img/bannerimg1.svg" alt class />
                                    </div>
                                    <div class="banner-img-1 slideup">
                                        <img src="../assets/images/hero-img/bannerimg1.svg" alt class />
                                    </div>
                                </div>
                                <div class>
                                    <div class="banner-img-2 slideDown">
                                        <img src="../assets/images/hero-img/bannerimg2.svg" alt class />
                                    </div>
                                    <div class="banner-img-2 slideDown">
                                        <img src="../assets/images/hero-img/bannerimg2.svg" alt class />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End-->

        <!-- Hero Section -->
        <section class="hero-section overflow-hidden items-center mb-12">
            <div class="container container-xl">
                <div class="grid grid-cols-12 gap-6 items-center">
                    <div class="xl:col-span-6 col-span-12">
                        <div class="xl:pt-0 pt-8">
                            <div class="banner-img-1 slideup">
                                <img src="../assets/images/hero-img/bannerimg1.svg" alt class />
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-6 col-span-12 xl:block hidden">
                        <div class="xl:pt-0 pt-8">
                            <h1 class="font-bold mb-7 lg:text-[55px] lg:leading-[66px] text-4xl" data-aos="fade-up"
                                data-aos-delay="400" data-aos-duration="1000">
                                Tentang
                                <br>
                                <span class="text-primary">
                                    ASN Indonesia</span>
                            </h1>
                            <p class="text-lg mb-10" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                                ASN Indonesia sudah banyak bantu calon ASN lulus ujian sejak 2019. Kami memahami masalah dan kendala belajar yang dialami pejuang ASN selama ini.
<br>
Lami ingin membantu lebih banyak calon ASN untuk lulus seleksi dan meraih mimpinya. Selalu berupaya memberikan fasilitas belajar terbaik untuk meningkatkan pemahaman dan kesiapan calon ASN menghadapi tes seleksi
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End-->

        <!-- Product Section -->
        <section class="mb-10" id="production-template">
            <div class="container relative container-xl">
                <div class="lg:w-3/5 w-full mx-auto" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">

                    <h2 class="text-center font-bold md:text-4xl text-2xl mb-14">
                        Paket Belajar
                    </h2>
                    <p class="text-lg mb-10 text-center" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                        Pilih paket yang paling sesuai untuk mendukung proses belajar kamu
                    </p>
                </div>

                <!-- Demos -->
                <div class="text-center mb-8">
                    <span class="items-center badge-md text-base bg-primary text-white py-2">Demos</span>
                </div>
                <div class="container full-container py-5">


                    <!---Pricing Card--->
                    <div class="grid grid-cols-12 gap-6 mt-6">
                        <div class="lg:col-span-4 md:col-span-6 sm:col-span-12 col-span-12">
                            <div class="card">
                                <div class="card-body">
                                    <span class="font-bold text-xs text-dark dark:text-darklink uppercase
                                    ">Silver</span>
                                    <div class="my-7">
                                        <img src="../assets/images/backgrounds/silver.png" alt=""
                                            class="h-20 w-20">
                                    </div>
                                    <h2 class="font-bold text-5xl mb-3">Free</h2>
                                    <ul class="mb-7">
                                        <li class="flex items-center gap-2 py-2">
                                            <i class="ti ti-check text-primary text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink
                                          ">3 Members</span>
                                        </li>
                                        <li class="flex items-center gap-2 py-2">
                                            <i class="ti ti-check text-primary text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink
                                          ">Single Device</span>
                                        </li>
                                        <li class="flex items-center gap-2 py-2">
                                            <i
                                                class="ti ti-x text-link dark:text-darklink opacity-60 text-base "></i>
                                            <span class="text-sm text-link dark:text-darklink opacity-60
                                          ">50GB Storage</span>
                                        </li>
                                        <li class="flex items-center gap-2 py-2">
                                            <i
                                                class="ti ti-x text-link dark:text-darklink opacity-60 text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink opacity-60
                                          ">Monthly Backups</span>
                                        </li>
                                        <li class="flex items-center gap-2 py-2">
                                            <i
                                                class="ti ti-x text-link dark:text-darklink opacity-60 text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink opacity-60
                                          ">Permissions & workflows</span>
                                        </li>
                                    </ul>
                                    <button class="btn w-full  py-3.5">Choose Silver</button>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-span-4 md:col-span-6 sm:col-span-12 col-span-12">
                            <div class="card">
                                <div class="card-body relative">
                                    <div class="absolute right-6 top-4">
                                        <span
                                            class="flex  badge-md ms-auto items-center justify-end bg-lightwarning dark:bg-darkwarning text-xs  text-warning w-fit">POPULAR</span>
                                    </div>
                                    <span class="font-bold text-xs text-dark dark:text-darklink uppercase
                                    ">Bronze</span>
                                    <div class="my-7">
                                        <img src="../assets/images/backgrounds/bronze.png" alt=""
                                            class="h-20 w-20">
                                    </div>
                                    <div class="flex mb-3">
                                        <h5 class="font-bold mb-0 text-lg">$</h5>
                                        <h2 class="font-bold text-5xl ms-2 mb-0">4.99</h2>
                                        <span class="text-link dark:text-white ms-2 text-base flex items-center">/mo</span>
                                      </div>
                                    <ul class="mb-7">
                                        <li class="flex items-center gap-2 py-2">
                                            <i class="ti ti-check text-primary text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink
                                          ">4 Members</span>
                                        </li>
                                        <li class="flex items-center gap-2 py-2">
                                            <i class="ti ti-check text-primary text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink
                                          ">Single Device</span>
                                        </li>
                                        <li class="flex items-center gap-2 py-2">
                                            <i
                                                class="ti ti-check text-primary text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink
                                          ">80GB Storage</span>
                                        </li>
                                        <li class="flex items-center gap-2 py-2">
                                            <i
                                                class="ti ti-x text-link dark:text-darklink opacity-60 text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink opacity-60
                                          ">Monthly Backups</span>
                                        </li>
                                        <li class="flex items-center gap-2 py-2">
                                            <i
                                                class="ti ti-x text-link dark:text-darklink opacity-60 text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink opacity-60
                                          ">Permissions & workflows</span>
                                        </li>
                                    </ul>
                                    <button class="btn w-full  py-3.5">Choose Bronze</button>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-span-4 md:col-span-6 sm:col-span-12 col-span-12">
                            <div class="card">
                                <div class="card-body">
                                    <span class="font-bold text-xs text-dark dark:text-darklink uppercase
                                    ">Gold</span>
                                    <div class="my-7">
                                        <img src="../assets/images/backgrounds/gold.png" alt=""
                                            class="h-20 w-20">
                                    </div>
                                    <div class="flex mb-3">
                                        <h5 class="font-bold mb-0 text-lg">$</h5>
                                        <h2 class="font-bold text-5xl ms-2 mb-0">9.99</h2>
                                        <span class="text-link dark:text-white ms-2 text-base flex items-center">/mo</span>
                                      </div>
                                    <ul class="mb-7">
                                        <li class="flex items-center gap-2 py-2">
                                            <i class="ti ti-check text-primary text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink
                                          ">5 Members</span>
                                        </li>
                                        <li class="flex items-center gap-2 py-2">
                                            <i class="ti ti-check text-primary text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink
                                          ">Single Device</span>
                                        </li>
                                        <li class="flex items-center gap-2 py-2">
                                            <i
                                                class="ti ti-check text-primary text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink
                                          ">120GB Storage</span>
                                        </li>
                                        <li class="flex items-center gap-2 py-2">
                                            <i
                                                class="ti ti-check text-primary text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink
                                          ">Monthly Backups</span>
                                        </li>
                                        <li class="flex items-center gap-2 py-2">
                                            <i
                                                class="ti ti-check text-primary text-base"></i>
                                            <span class="text-sm text-link dark:text-darklink
                                          ">Permissions & workflows</span>
                                        </li>
                                    </ul>
                                    <button class="btn w-full  py-3.5">Choose Gold</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---Pricing Card End--->

                </div>

                <!-- Apps -->
                <div class="mt-10">
                    <div class="text-center mb-8">
                        <span class="items-center badge-md text-base bg-primary text-white py-2">Apps</span>
                    </div>
                    <div class="grid grid-cols-12  gap-6">
                        <div class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                            <div
                                class="border border-light-dark overflow-hidden rounded-md relative flex justify-center items-center group ">
                                <img src="../assets/images/apps/app-calendar.jpg" alt class="max-w-full w-full" />
                                <a target="_blank" href="../main/app-calendar.html"
                                    class="preview-btn text-sm py-2 px-4 ">Live
                                    Preview</a>
                                <div class="bg-overlay">
                                </div>
                            </div>
                            <div class="text-center p-3 text-sm font-medium text-dark dark:text-white">Calendar</div>
                        </div>
                        <div class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                            <div
                                class="border border-light-dark overflow-hidden rounded-md relative flex justify-center items-center group ">
                                <img src="../assets/images/apps/app-chat.jpg" alt class="max-w-full w-full" />
                                <a target="_blank" href="../main/app-chat.html"
                                    class="preview-btn text-sm py-2 px-4 ">Live
                                    Preview</a>
                                <div class="bg-overlay">
                                </div>
                            </div>
                            <div class="text-center p-3 text-sm font-medium text-dark dark:text-white">Chat</div>
                        </div>
                        <div class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                            <div
                                class="border border-light-dark overflow-hidden rounded-md relative flex justify-center items-center group">
                                <img src="../assets/images/apps/app-email.jpg" alt class="max-w-full w-full" />
                                <a target="_blank" href="../main/app-email.html"
                                    class="preview-btn text-sm py-2 px-4 ">Live
                                    Preview</a>
                                <div class="bg-overlay">
                                </div>
                            </div>
                            <div class="text-center p-3 text-sm font-medium text-dark dark:text-white">Email</div>
                        </div>
                        <div class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                            <div
                                class="border border-light-dark overflow-hidden rounded-md relative flex justify-center items-center group">
                                <img src="../assets/images/apps/app-contact.jpg" alt class="max-w-full w-full" />
                                <a target="_blank" href="../main/app-contact.html"
                                    class="preview-btn text-sm py-2 px-4 ">Live
                                    Preview</a>
                                <div class="bg-overlay">
                                </div>
                            </div>
                            <div class="text-center p-3 text-sm font-medium text-dark dark:text-white">Contact</div>
                        </div>
                        <div class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                            <div
                                class="border border-light-dark overflow-hidden rounded-md relative flex justify-center items-center group">
                                <img src="../assets/images/apps/app-invoice.jpg" alt class="max-w-full w-full" />
                                <a target="_blank" href="../main/app-invoice.html"
                                    class="preview-btn text-sm py-2 px-4 ">Live
                                    Preview</a>
                                <div class="bg-overlay">
                                </div>
                            </div>
                            <div class="text-center p-3 text-sm font-medium text-dark dark:text-white">Invoice</div>
                        </div>
                        <div class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                            <div
                                class="border border-light-dark overflow-hidden rounded-md relative flex justify-center items-center group">
                                <img src="../assets/images/apps/modernize-bt-app-contact-list.jpg" alt
                                    class="max-w-full w-full" />
                                <a target="_blank" href="../main/app-contact2.html"
                                    class="preview-btn text-sm py-2 px-4 ">Live
                                    Preview</a>
                                <div class="bg-overlay">
                                </div>
                            </div>
                            <div class="text-center p-3 text-sm font-medium text-dark dark:text-white">Contact
                                List
                            </div>
                        </div>
                        <div class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                            <div
                                class="border border-light-dark overflow-hidden rounded-md relative flex justify-center items-center group">
                                <img src="../assets/images/apps/app-user-profile.jpg" alt class="max-w-full w-full" />
                                <a target="_blank" href="../main/page-user-profile.html"
                                    class="preview-btn text-sm py-2 px-4 ">Live
                                    Preview</a>
                                <div class="bg-overlay">
                                </div>
                            </div>
                            <div class="text-center p-3 text-sm font-medium text-dark dark:text-white">User
                                Profile
                            </div>
                        </div>
                        <div class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                            <div
                                class="border border-light-dark overflow-hidden rounded-md relative flex justify-center items-center group">
                                <img src="../assets/images/apps/modernize-vue-app-blog.jpg" alt
                                    class="max-w-full w-full" />
                                <a target="_blank" href="../main/blog-posts.html"
                                    class="preview-btn text-sm py-2 px-4 ">Live
                                    Preview</a>
                                <div class="bg-overlay">
                                </div>
                            </div>
                            <div class="text-center p-3 text-sm font-medium text-dark dark:text-white">Blog
                            </div>
                        </div>
                        <div class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                            <div
                                class="border border-light-dark overflow-hidden rounded-md relative flex justify-center items-center group">
                                <img src="../assets/images/apps/modernize-vue-app-blog-detail.jpg" alt
                                    class="max-w-full w-full" />
                                <a target="_blank" href="../main/blog-detail.html"
                                    class="preview-btn text-sm py-2 px-4 ">Live
                                    Preview</a>
                                <div class="bg-overlay">
                                </div>
                            </div>
                            <div class="text-center p-3 text-sm font-medium text-dark dark:text-white">Blog
                                Detail
                            </div>
                        </div>
                        <div class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                            <div
                                class="border border-light-dark overflow-hidden rounded-md relative flex justify-center items-center group">
                                <img src="../assets/images/apps/modernize-vue-app-shop.jpg" alt
                                    class="max-w-full w-full" />
                                <a target="_blank" href="../main/eco-shop.html"
                                    class="preview-btn text-sm py-2 px-4 ">Live
                                    Preview</a>
                                <div class="bg-overlay">
                                </div>
                            </div>
                            <div class="text-center p-3 text-sm font-medium text-dark dark:text-white">eCommerce
                                Shop
                            </div>
                        </div>
                        <div class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                            <div
                                class="border border-light-dark overflow-hidden rounded-md relative flex justify-center items-center group">
                                <img src="../assets/images/apps/app-ecommerce-detail.jpg" alt class="max-w-full w-full" />
                                <a target="_blank" href="../main/eco-shop-detail.html"
                                    class="preview-btn text-sm py-2 px-4 ">Live
                                    Preview</a>
                                <div class="bg-overlay">
                                </div>
                            </div>
                            <div class="text-center p-3 text-sm font-medium text-dark dark:text-white">eCommerce
                                Detail
                            </div>
                        </div>
                        <div class="lg:col-span-3 md:col-span-6 sm:col-span-6 col-span-12">
                            <div
                                class="border border-light-dark overflow-hidden rounded-md relative flex justify-center items-center group">
                                <img src="../assets/images/apps/app-ecommerce-list.jpg" alt class="max-w-full w-full" />
                                <a target="_blank" href="../main/eco-product-list.html"
                                    class="preview-btn text-sm py-2 px-4 ">Live
                                    Preview</a>
                                <div class="bg-overlay">
                                </div>
                            </div>
                            <div class="text-center p-3 text-sm font-medium text-dark dark:text-white">eCommerce
                                List
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- Product Section End-->

        <!-- Curosel Section-->
        <section class="bg-lightgray dark:bg-darkprimary py-11">
            <div class="container container-xl">
                <div class="lg:w-3/5 w-full mx-auto">
                    <h2 class="text-center font-bold md:text-4xl text-2xl mb-10 pt-11">
                        Increase speed of your development and
                        launch quickly with Modernize
                    </h2>
                </div>
            </div>
            <div class="sliding-wrapper position-relative overflow-hidden">
                <div class="slide-background flex flex-row w-100">
                    <div class="slide">
                        <img src="../assets/images/slider/slider-group.png" alt="slide" height="100%" />
                    </div>
                    <div class="slide">
                        <img src="../assets/images/slider/slider-group.png" alt="slide" height="100%" />
                    </div>
                    <div class="slide">
                        <img src="../assets/images/slider/slider-group.png" alt="slide" height="100%" />
                    </div>
                </div>
            </div>
        </section>
        <!-- Curosel Section End-->

        <!-- Testimonial Section -->
        <section class="py-11 pb-0">
            <div class="container container-xl">
                <div class="lg:w-3/5 w-full mx-auto">
                    <h2 class="text-center font-bold md:text-4xl text-2xl mb-10 pt-11" data-aos="fade-up"
                        data-aos-delay="200" data-aos-duration="1000">
                        Don’t just take our words for it, See
                        what developers like you are saying
                    </h2>
                </div>
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12">
                        <div class="review-slider" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                            <div class="owl-carousel owl-theme">
                                <div class="item my-3">
                                    <div class="card">
                                        <div class="card-body p-6">
                                            <div class="flex justify-between mb-4">
                                                <div class="flex gap-3 items-center">
                                                    <img src="../assets/images/profile/user-7.jpg" alt
                                                        class="rounded-full h-10 w-10" />
                                                    <div>
                                                        <h6 class="text-base">Jenny
                                                            Wilson</h6>
                                                        <p class="mb-0">Features
                                                            avaibility</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <ul class="flex items-center justify-end gap-1 mb-0">
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-3 text-dark dark:text-white text-base">
                                                The dashboard
                                                template from
                                                adminmart has
                                                helped me
                                                provide a clean
                                                and sleek look
                                                to my dashboard
                                                and made
                                                it look exactly
                                                the way I wanted
                                                it to, mainly
                                                without
                                                having.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item my-3">
                                    <div class="card">
                                        <div class="card-body p-6">
                                            <div class="flex justify-between mb-4">
                                                <div class="flex gap-3 items-center">
                                                    <img src="../assets/images/profile/user-2.jpg" alt
                                                        class="rounded-full h-10 w-10" />
                                                    <div>
                                                        <h6 class="text-base">Minshan
                                                            Cui</h6>
                                                        <p class="mb-0">Features
                                                            avaibility</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <ul class="flex items-center justify-end gap-1 mb-0">
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-3 text-dark dark:text-white text-base">
                                                The quality of
                                                design is
                                                excellent,
                                                customizability
                                                and
                                                flexibility much
                                                better than the
                                                other products
                                                available in the
                                                market. I
                                                strongly
                                                recommend the
                                                AdminMart to
                                                other buyers.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item my-3">
                                    <div class="card">
                                        <div class="card-body p-6">
                                            <div class="flex justify-between mb-4">
                                                <div class="flex gap-3 items-center">
                                                    <img src="../assets/images/profile/user-3.jpg" alt
                                                        class="rounded-full h-10 w-10" />
                                                    <div>
                                                        <h6 class="text-base">Eminson
                                                            Mendoza</h6>
                                                        <p class="mb-0">Features
                                                            avaibility</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <ul class="flex items-center justify-end gap-1 mb-0">
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-3 text-dark dark:text-white text-base">
                                                This template is
                                                great, UI-rich
                                                and up-to-date.
                                                Although
                                                it is pretty
                                                much complete, I
                                                suggest to
                                                improve a bit
                                                of
                                                documentation.
                                                Thanks & Highly
                                                recomended!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item my-3">
                                    <div class="card">
                                        <div class="card-body p-6">
                                            <div class="flex justify-between mb-4">
                                                <div class="flex gap-3 items-center">
                                                    <img src="../assets/images/profile/user-7.jpg" alt
                                                        class="rounded-full h-10 w-10" />
                                                    <div>
                                                        <h6 class="text-base">Jenny
                                                            Wilson</h6>
                                                        <p class="mb-0">Features
                                                            avaibility</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <ul class="flex items-center justify-end gap-1 mb-0">
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-3 text-dark dark:text-white text-base">
                                                The dashboard
                                                template from
                                                adminmart has
                                                helped me
                                                provide a clean
                                                and sleek look
                                                to my dashboard
                                                and made
                                                it look exactly
                                                the way I wanted
                                                it to, mainly
                                                without
                                                having.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item my-3">
                                    <div class="card">
                                        <div class="card-body p-6">
                                            <div class="flex justify-between mb-4">
                                                <div class="flex gap-3 items-center">
                                                    <img src="../assets/images/profile/user-2.jpg" alt
                                                        class="rounded-full h-10 w-10" />
                                                    <div>
                                                        <h6 class="text-base">Minshan
                                                            Cui</h6>
                                                        <p class="mb-0">Features
                                                            avaibility</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <ul class="flex items-center justify-end gap-1 mb-0">
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-3 text-dark dark:text-white text-base">
                                                The quality of
                                                design is
                                                excellent,
                                                customizability
                                                and
                                                flexibility much
                                                better than the
                                                other products
                                                available in the
                                                market. I
                                                strongly
                                                recommend the
                                                AdminMart to
                                                other buyers.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item my-3">
                                    <div class="card">
                                        <div class="card-body p-6">
                                            <div class="flex justify-between mb-4">
                                                <div class="flex gap-3 items-center">
                                                    <img src="../assets/images/profile/user-3.jpg" alt
                                                        class="rounded-full h-10 w-10" />
                                                    <div>
                                                        <h6 class="text-base">Eminson
                                                            Mendoza</h6>
                                                        <p class="mb-0">Features
                                                            avaibility</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <ul class="flex items-center justify-end gap-1 mb-0">
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-3 text-dark dark:text-white text-base">
                                                This template is
                                                great, UI-rich
                                                and up-to-date.
                                                Although
                                                it is pretty
                                                much complete, I
                                                suggest to
                                                improve a bit
                                                of
                                                documentation.
                                                Thanks & Highly
                                                recomended!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item my-3">
                                    <div class="card">
                                        <div class="card-body p-6">
                                            <div class="flex justify-between mb-4">
                                                <div class="flex gap-3 items-center">
                                                    <img src="../assets/images/profile/user-7.jpg" alt
                                                        class="rounded-full h-10 w-10" />
                                                    <div>
                                                        <h6 class="text-base">Jenny
                                                            Wilson</h6>
                                                        <p class="mb-0">Features
                                                            avaibility</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <ul class="flex items-center justify-end gap-1 mb-0">
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-3 text-dark dark:text-white text-base">
                                                The dashboard
                                                template from
                                                adminmart has
                                                helped me
                                                provide a clean
                                                and sleek look
                                                to my dashboard
                                                and made
                                                it look exactly
                                                the way I wanted
                                                it to, mainly
                                                without
                                                having.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item my-3">
                                    <div class="card">
                                        <div class="card-body p-6">
                                            <div class="flex justify-between mb-4">
                                                <div class="flex gap-3 items-center">
                                                    <img src="../assets/images/profile/user-2.jpg" alt
                                                        class="rounded-full h-10 w-10" />
                                                    <div>
                                                        <h6 class="text-base">Minshan
                                                            Cui</h6>
                                                        <p class="mb-0">Features
                                                            avaibility</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <ul class="flex items-center justify-end gap-1 mb-0">
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-3 text-dark dark:text-white text-base">
                                                The quality of
                                                design is
                                                excellent,
                                                customizability
                                                and
                                                flexibility much
                                                better than the
                                                other products
                                                available in the
                                                market. I
                                                strongly
                                                recommend the
                                                AdminMart to
                                                other buyers.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item my-3">
                                    <div class="card">
                                        <div class="card-body p-6">
                                            <div class="flex justify-between mb-4">
                                                <div class="flex gap-3 items-center">
                                                    <img src="../assets/images/profile/user-3.jpg" alt
                                                        class="rounded-full h-10 w-10" />
                                                    <div>
                                                        <h6 class="text-base">Eminson
                                                            Mendoza</h6>
                                                        <p class="mb-0">Features
                                                            avaibility</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <ul class="flex items-center justify-end gap-1 mb-0">
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-3 text-dark dark:text-white text-base">
                                                This template is
                                                great, UI-rich
                                                and up-to-date.
                                                Although
                                                it is pretty
                                                much complete, I
                                                suggest to
                                                improve a bit
                                                of
                                                documentation.
                                                Thanks & Highly
                                                recomended!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item my-3">
                                    <div class="card">
                                        <div class="card-body p-6">
                                            <div class="flex justify-between mb-4">
                                                <div class="flex gap-3 items-center">
                                                    <img src="../assets/images/profile/user-7.jpg" alt
                                                        class="rounded-full h-10 w-10" />
                                                    <div>
                                                        <h6 class="text-base">Jenny
                                                            Wilson</h6>
                                                        <p class="mb-0">Features
                                                            avaibility</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <ul class="flex items-center justify-end gap-1 mb-0">
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href>
                                                                <img src="../assets/images/svgs/icon-star.svg" alt
                                                                    class="img-fluid">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-3 text-dark dark:text-white text-base">
                                                The dashboard
                                                template from
                                                adminmart has
                                                helped me
                                                provide a clean
                                                and sleek look
                                                to my dashboard
                                                and made
                                                it look exactly
                                                the way I wanted
                                                it to, mainly
                                                without
                                                having.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!---Testimonial Section End--->

        <!-- Feature Section -->
        <section class="py-11">
            <div class="container container-xl">
                <div class="lg:w-3/5 w-full mx-auto" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                    <div>
                        <p class="text-primary font-medium text-center mb-3">ALMOST
                            COVERED EVERYTHING</p>
                        <h2 class="text-center font-bold md:text-4xl text-2xl">
                            Other Amazing Features & Flexibility
                            Provided
                        </h2>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-x-4 gap-y-6 mt-12">
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-wand text-primary text-4xl mb-2"></i>
                            <h5 class="font-semibold text-lg mb-1">6
                                Theme Colors</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                We have included 6 pre-defined
                                Theme Colors with Elegant
                                Admin.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-layout-sidebar text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">Dark
                                & Light Sidebar</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                Included Dark and Light Sidebar
                                for getting desire look and
                                feel.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-archive text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">425+
                                Page Templates</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                Yes, we have 5 demos & 79+ Pages
                                per demo to make it easier.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-adjustments text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">150+
                                UI Components</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                Almost 150+ UI Components being
                                given with Modernize Admin
                                Pack.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-tag text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">Tailwind
                                3x</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                Its been made with Tailwind
                                3 and full responsive
                                layout.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-diamond text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">3400+
                                Font Icons</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                Lots of Icon Fonts are included
                                here in the package of
                                Elegant Admin.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-device-desktop text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">Fully
                                Responsive</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                All the layout of Modernize
                                Admin is Fully Responsive and
                                widely tested.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-database text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">Preline
                                UI</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                Built with Tailwind css preline
                                + gulp task manager.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-arrows-shuffle text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">Easy
                                to Customize</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                Customization will be easy as we
                                understand your pain.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-chart-pie text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">Lots
                                of Chart Options</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                You name it and we have it, Yes
                                lots of variations for
                                Charts.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-layers-intersect text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">Lots
                                of Table Examples</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                Data Tables are initial
                                requirement and we added them.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-refresh text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">Regular
                                Updates</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                We are constantly updating our
                                pack with new features.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-book text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">Detailed
                                Documentation</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                We have made detailed
                                documentation, so it will easy
                                to use.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-calendar text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">Calendar
                                Design</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                Calendar is available with our
                                package & in nice design.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 md:col-span-4 col-span-12" data-aos="fade-up" data-aos-delay="800"
                        data-aos-duration="1000">
                        <div class="text-center mb-5">
                            <i class="block ti ti-brand-wechat text-primary text-4xl mb-2"></i>
                            <h5 class="text-lg mb-1">Dedicated
                                Support</h5>
                            <p class="mb-0 text-dark dark:text-darklink">
                                We believe in supreme support is
                                key and we offer that.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Feature Section End-->

        <!-- Discord Section -->
        <section class="py-11">
            <div class="container container-xl">
                <div class="lg:w-2/4 w-full mx-auto" data-aos="fade-up" data-aos-delay="1600" data-aos-duration="1000">
                    <div class="card bg-center bg-no-repeat"
                        style="background-image: url(../assets/images/backgrounds/line-bg.svg);">
                        <div class="card-body pb-10 text-center">
                            <h3 class="text-2xl">
                                Haven't found an answer to your
                                question?
                            </h3>
                            <p class>
                                Connect with us either on
                                discord or email us
                            </p>
                            <div class="sm:flex justify-center gap-4 mt-8">
                                <a href="https://discord.com/invite/eMzE8F6Wqs" target="_blank"
                                    class="btn py-3 px-6 mb-3 sm:mb-0 flex justify-center" type="button">Ask on
                                    Discord</a>
                                <a href="https://adminmart.com/support" target="_blank"
                                    class="btn bg-transparent border border-secondary hover:bg-secondary text-secondary px-6 hover:text-white scroll-link  py-3 flex justify-center "
                                    type="button">Submit
                                    Ticket</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Discord Section End-->

        <!-- Login Section -->
        <section class=" mt-11 bg-primary overflow-hidden">
            <div class="container container-xl">
                <div class="grid grid-cols-12 gap-6 justify-between items-center">
                    <div class="xl:col-span-5 lg:col-span-7 col-span-12 lg:text-left text-center">
                        <h2 class="font-bold lg:text-4xl text-3xl text-white mb-7 lg:pt-0 pt-10">
                            Build your app with our highly
                            customizable Tailwind based
                            Dashboard
                        </h2>
                        <div class="sm:flex lg:justify-start justify-center gap-4">
                            <a href="../main/authentication-login.html"
                                class="btn bg-white text-primary hover:bg-white py-3  px-8 mb-3 sm:mb-0 flex justify-center">Login</a>
                            <a href="../main/authentication-register.html"
                                class="btn border border-white hover:bg-white text-white px-8 hover:text-primary py-3 flex justify-center">Register</a>
                        </div>
                    </div>
                    <div class="xl:col-span-7 lg:col-span-5 col-span-12">
                        <div class="flex lg:justify-end justify-center">
                            <img src="../assets/images/backgrounds/business-woman-checking-her-mail.png" alt
                                class="w-auto max-w-full lg:ms-auto  -mb-4 pt-7" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Login Section End-->

        <!-- Footer Section -->
        <section class="pt-8 pb-12">
            <div class="container container-xl">
                <div class="md:w-1/3 w-full mx-auto ">
                    <div class="text-center">
                        <a href="../index.html">
                            <img src="../assets/images/logos/favicon.png" alt class="mx-auto mb-4" />
                        </a>
                        <p class="text-dark dark:text-white">All
                            rights
                            reserved by Modernize. Designed &
                            Developed by</p>
                        <a class="text-dark dark:text-white underline underline-offset-4 decoration-primary hover:opacity-90"
                            href="https://adminmart.com/">AdminMart.</a>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

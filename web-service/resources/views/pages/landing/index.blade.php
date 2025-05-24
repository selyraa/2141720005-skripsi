@extends('pages.landing.layouts.app')

@section('content')
    <div class="max-w-full">

        <!-- Hero Section -->
        <section class="hero-section overflow-hidden items-center mb-12 bg-lightprimary dark:bg-darkprimary py-16">
            <div class="container container-xl">
                <div class="grid grid-cols-12 gap-6 items-center">
                    <div class="xl:col-span-6 col-span-12">
                        <div class="xl:pt-0 pt-8">
                            <h6 class="flex items-center gap-2 text-base mb-3" data-aos="fade-up" data-aos-delay="200"
                                data-aos-duration="1000">
                                <i class="ti ti-apple text-secondary text-lg"></i>Gaya Hidup Sehat & Kesehatan
                            </h6>
                            <h1 class="font-bold mb-7 lg:text-[55px] lg:leading-[66px] text-4xl" data-aos="fade-up"
                                data-aos-delay="400" data-aos-duration="1000">
                                Nut Castle
                                <br>
                                <span class="text-primary">
                                    Cafe</span>
                            </h1>
                            <p class="text-lg mb-10" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                                Destinasi utama Anda untuk kesehatan nutrisi dan gaya hidup sehat. Kami menggabungkan makanan lezat dengan panduan kesehatan ahli untuk membantu Anda mencapai kesejahteraan optimal.
                            </p>
                            <div class="md:flex items-center gap-3.5" data-aos="fade-up" data-aos-delay="800"
                                data-aos-duration="1000">
                                <a class="btn py-3 px-12 mb-3 sm:mb-0 flex justify-center"
                                    href="{{ route('login') }}">Masuk</a>
                                <a class="btn btn-outline-primary scroll-link px-6 py-3 flex justify-center"
                                    href="#services">Layanan Kami</a>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-6 col-span-12 xl:block hidden">
                        <div class="hero-img-slide position-relative p-4 rounded overflow-hidden">
                            <img src="../assets/images/hero-img/hero.jpg" alt="Healthy Food at Nut Castle Cafe" class="rounded-lg shadow-xl" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End-->

        <!-- About Us Section -->
        <section id="about-us" class="overflow-hidden items-center mb-12">
            <div class="container container-xl">
                <div class="grid grid-cols-12 gap-6 items-center">
                    <div class="xl:col-span-6 col-span-12">
                        <div class="xl:pt-0 pt-8">
                            <div class="rounded-lg overflow-hidden shadow-lg">
                                <img src="../assets/images/hero-img/about-us.jpg" alt="About Nut Castle" class="w-full h-auto" />
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-6 col-span-12">
                        <div class="xl:pt-0 pt-8">
                            <h2 class="font-bold mb-7 text-4xl" data-aos="fade-up"
                                data-aos-delay="400" data-aos-duration="1000">
                                Tentang
                                <span class="text-primary">
                                    Nut Castle Cafe</span>
                            </h2>
                            <p class="text-lg mb-6" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                                Didirikan pada tahun 2020, Nut Castle Cafe lebih dari sekadar kafe - ini adalah pusat kesehatan yang didedikasikan untuk mempromosikan hidup sehat melalui nutrisi dan kebugaran.
                            </p>
                            <p class="text-lg mb-6" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                                Misi kami adalah menciptakan komunitas di mana individu yang sadar kesehatan dapat menikmati makanan bergizi, menerima panduan ahli, dan berpartisipasi dalam kegiatan kesehatan yang meningkatkan kualitas hidup mereka.
                            </p>
                            <p class="text-lg mb-6" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                                Di Nut Castle, kami menggabungkan ilmu nutrisi dengan seni keunggulan kuliner untuk menciptakan hidangan yang lezat dan bermanfaat bagi tubuh Anda.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Us Section End-->

        <!-- Services Section -->
        <section id="services" class="mb-16 pt-8 pb-16 bg-lightgray dark:bg-darkprimary">
            <div class="container relative container-xl">
                <div class="lg:w-3/5 w-full mx-auto" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    <h2 class="text-center font-bold md:text-4xl text-2xl mb-6">
                        Layanan Kami
                    </h2>
                    <p class="text-lg mb-10 text-center" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                        Solusi kesehatan komprehensif yang disesuaikan dengan kebutuhan kesehatan Anda
                    </p>
                </div>

                <div class="grid grid-cols-12 gap-6 mt-6">
                    <!-- Service Card 1 -->
                    <div class="lg:col-span-4 md:col-span-6 sm:col-span-12 col-span-12">
                        <div class="card h-full">
                            <div class="card-body">
                                <div class="mb-6 text-primary">
                                    <i class="ti ti-stethoscope text-5xl"></i>
                                </div>
                                <h3 class="font-bold text-2xl mb-4">Pemeriksaan Kesehatan</h3>
                                <p class="mb-6">
                                    Penilaian kesehatan komprehensif termasuk perhitungan BMI, analisis komposisi tubuh, dan evaluasi gizi yang dilakukan oleh profesional kesehatan bersertifikat kami.
                                </p>
                                <a href="#" class="text-primary font-medium hover:underline flex items-center gap-2">
                                    Pelajari lebih lanjut <i class="ti ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Service Card 2 -->
                    <div class="lg:col-span-4 md:col-span-6 sm:col-span-12 col-span-12">
                        <div class="card h-full">
                            <div class="card-body">
                                <div class="mb-6 text-primary">
                                    <i class="ti ti-user-circle text-5xl"></i>
                                </div>
                                <h3 class="font-bold text-2xl mb-4">Konsultasi Kesehatan</h3>
                                <p class="mb-6">
                                    Sesi one-on-one dengan ahli gizi dan pakar kesehatan kami untuk membuat rencana nutrisi personal yang selaras dengan tujuan kesehatan dan preferensi diet Anda.
                                </p>
                                <a href="#" class="text-primary font-medium hover:underline flex items-center gap-2">
                                    Pelajari lebih lanjut <i class="ti ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Service Card 3 -->
                    <div class="lg:col-span-4 md:col-span-6 sm:col-span-12 col-span-12">
                        <div class="card h-full">
                            <div class="card-body">
                                <div class="mb-6 text-primary">
                                    <i class="ti ti-bike text-5xl"></i>
                                </div>
                                <h3 class="font-bold text-2xl mb-4">Kelas Olahraga</h3>
                                <p class="mb-6">
                                    Sesi kebugaran kelompok dan individu termasuk yoga, pilates, dan latihan kekuatan yang dirancang untuk melengkapi perjalanan nutrisi Anda dan meningkatkan kesehatan secara keseluruhan.
                                </p>
                                <a href="#" class="text-primary font-medium hover:underline flex items-center gap-2">
                                    Pelajari lebih lanjut <i class="ti ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Service Card 4 -->
                    <div class="lg:col-span-4 md:col-span-6 sm:col-span-12 col-span-12">
                        <div class="card h-full">
                            <div class="card-body">
                                <div class="mb-6 text-primary">
                                    <i class="ti ti-apple text-5xl"></i>
                                </div>
                                <h3 class="font-bold text-2xl mb-4">Program Diet</h3>
                                <p class="mb-6">
                                    Rencana diet yang disesuaikan dengan kebutuhan kesehatan spesifik Anda, baik itu manajemen berat badan, peningkatan massa otot, atau mengelola kondisi kesehatan melalui nutrisi.
                                </p>
                                <a href="#" class="text-primary font-medium hover:underline flex items-center gap-2">
                                    Pelajari lebih lanjut <i class="ti ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Service Card 5 -->
                    <div class="lg:col-span-4 md:col-span-6 sm:col-span-12 col-span-12">
                        <div class="card h-full">
                            <div class="card-body">
                                <div class="mb-6 text-primary">
                                    <i class="ti ti-chef-hat text-5xl"></i>
                                </div>
                                <h3 class="font-bold text-2xl mb-4">Kafe Sehat</h3>
                                <p class="mb-6">
                                    Nikmati menu makanan dan minuman bergizi kami yang terbuat dari bahan-bahan segar dan lokal yang mendukung tujuan kesehatan Anda sambil memanjakan lidah Anda.
                                </p>
                                <a href="#" class="text-primary font-medium hover:underline flex items-center gap-2">
                                    Lihat Menu <i class="ti ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Service Card 6 -->
                    <div class="lg:col-span-4 md:col-span-6 sm:col-span-12 col-span-12">
                        <div class="card h-full">
                            <div class="card-body">
                                <div class="mb-6 text-primary">
                                    <i class="ti ti-book text-5xl"></i>
                                </div>
                                <h3 class="font-bold text-2xl mb-4">Workshop Kesehatan</h3>
                                <p class="mb-6">
                                    Sesi edukasi dan kelas memasak untuk membantu Anda memahami nutrisi dengan lebih baik dan belajar cara menyiapkan makanan sehat di rumah untuk kesehatan berkelanjutan.
                                </p>
                                <a href="#" class="text-primary font-medium hover:underline flex items-center gap-2">
                                    Lihat Jadwal <i class="ti ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services Section End-->

        <!-- Activities Section -->
        <section id="activities" class="py-12">
            <div class="container container-xl">
                <div class="lg:w-3/5 w-full mx-auto">
                    <h2 class="text-center font-bold md:text-4xl text-2xl mb-10">
                        Kegiatan Rutin Kami
                    </h2>
                    <p class="text-lg mb-10 text-center" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                        Bergabunglah dengan komunitas kami dalam kegiatan kesehatan rutin ini
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Activity 1 -->
                    <div class="card overflow-hidden">
                        <div class="h-100 overflow-hidden">
                            <img src="../assets/images/backgrounds/activity-1.jpg" alt="Morning Yoga" class="w-full h-auto object-cover">
                        </div>
                        <div class="card-body">
                            <span class="badge-primary text-xs font-bold py-1 px-2 rounded mb-3 inline-block">Senin & Rabu</span>
                            <h3 class="text-xl font-bold mb-2">Yoga Pagi</h3>
                            <p class="mb-4">Mulai hari Anda dengan keseimbangan dan energi melalui sesi yoga terpandu kami yang cocok untuk semua level.</p>
                            <div class="flex items-center">
                                <span class="text-sm"><i class="ti ti-clock mr-1"></i> 7:00 - 8:30 Pagi</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Activity 2 -->
                    <div class="card overflow-hidden">
                        <div class="h-100 overflow-hidden">
                            <img src="../assets/images/backgrounds/activity-2.jpg" alt="Nutrition Consultation" class="w-full h-auto object-cover">
                        </div>
                        <div class="card-body">
                            <span class="badge-primary text-xs font-bold py-1 px-2 rounded mb-3 inline-block">Selasa & Kamis</span>
                            <h3 class="text-xl font-bold mb-2">Konsultasi Nutrisi</h3>
                            <p class="mb-4">Sesi one-on-one dengan ahli gizi bersertifikat kami untuk mempersonalisasi rencana diet Anda.</p>
                            <div class="flex items-center">
                                <span class="text-sm"><i class="ti ti-clock mr-1"></i> 10:00 Pagi - 4:00 Sore</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Activity 3 -->
                    <div class="card overflow-hidden">
                        <div class="h-100 overflow-hidden">
                            <img src="../assets/images/backgrounds/activity-3.jpg" alt="Cooking Workshop" class="w-full h-auto object-cover">
                        </div>
                        <div class="card-body">
                            <span class="badge-primary text-xs font-bold py-1 px-2 rounded mb-3 inline-block">Sabtu</span>
                            <h3 class="text-xl font-bold mb-2">Workshop Memasak Sehat</h3>
                            <p class="mb-4">Belajar menyiapkan makanan lezat dan bergizi dengan panduan dan tips dari chef kami.</p>
                            <div class="flex items-center">
                                <span class="text-sm"><i class="ti ti-clock mr-1"></i> 2:00 - 4:00 Sore</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Activities Section End-->

        <!-- Testimonial Section -->
        <section class="py-12 bg-lightgray dark:bg-darkprimary">
            <div class="container container-xl">
                <div class="lg:w-3/5 w-full mx-auto">
                    <h2 class="text-center font-bold md:text-4xl text-2xl mb-10" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                        Apa Kata Klien Kami
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Testimonial 1 -->
                    <div class="card p-6">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 flex">
                                <i class="ti ti-star-filled"></i>
                                <i class="ti ti-star-filled"></i>
                                <i class="ti ti-star-filled"></i>
                                <i class="ti ti-star-filled"></i>
                                <i class="ti ti-star-filled"></i>
                            </div>
                        </div>
                        <p class="mb-6 italic">"Program diet yang dipersonalisasi dari Nut Castle benar-benar mengubah hubungan saya dengan makanan. Saya berhasil menurunkan 15kg dalam 6 bulan dan merasa lebih berenergi dari sebelumnya!"</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                                <img src="../assets/images/profile/user-1.jpg" alt="Sarah M." class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h5 class="font-bold">Sarah M.</h5>
                                <span class="text-sm">Klien Program Diet</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 2 -->
                    <div class="card p-6">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 flex">
                                <i class="ti ti-star-filled"></i>
                                <i class="ti ti-star-filled"></i>
                                <i class="ti ti-star-filled"></i>
                                <i class="ti ti-star-filled"></i>
                                <i class="ti ti-star-filled"></i>
                            </div>
                        </div>
                        <p class="mb-6 italic">"Kelas yoga di Nut Castle sangat luar biasa. Instrukturnya berpengetahuan luas dan suasananya sangat menenangkan. Ini telah menjadi bagian favorit saya dalam seminggu!"</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                                <img src="../assets/images/profile/user-2.jpg" alt="Michael T." class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h5 class="font-bold">Michael T.</h5>
                                <span class="text-sm">Anggota Kelas Yoga</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 3 -->
                    <div class="card p-6">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 flex">
                                <i class="ti ti-star-filled"></i>
                                <i class="ti ti-star-filled"></i>
                                <i class="ti ti-star-filled"></i>
                                <i class="ti ti-star-filled"></i>
                                <i class="ti ti-star-filled"></i>
                            </div>
                        </div>
                        <p class="mb-6 italic">"Makanan di Nut Castle tidak hanya lezat, tetapi panduan nutrisi mereka juga telah membantu saya mengelola diabetes lebih baik dari sebelumnya. Saya sangat berterima kasih atas keahlian mereka!"</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                                <img src="../assets/images/profile/user-3.jpg" alt="Emma L." class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h5 class="font-bold">Emma L.</h5>
                                <span class="text-sm">Klien Konsultasi Kesehatan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonial Section End-->

        <!-- Location Section -->
        <section id="location" class="py-12">
            <div class="container container-xl">
                <div class="lg:w-3/5 w-full mx-auto mb-10">
                    <h2 class="text-center font-bold md:text-4xl text-2xl mb-6">Kunjungi Kami</h2>
                    <p class="text-lg text-center">Datang dan rasakan kesehatan di lokasi kami yang nyaman</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div class="card p-0 overflow-hidden">
                        <div class="h-96 w-full">
                            <!-- Replace with actual map or image of location -->
                            <img src="../assets/images/backgrounds/map.jpg" alt="Map location" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold mb-4">Informasi Kontak</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                 <i class="ti ti-map-pin text-primary text-xl mr-4"></i>

                                <p class="ml-2">Jl. Sigura - Gura No.Kav 2, Karangbesuki, Kec. Sukun,<br> Kota Malang, Jawa Timur 65147</p>
                            </div>
                            <div class="flex items-center">
                                <i class="ti ti-phone text-primary text-xl mr-4"></i>
                                <p class="ml-2">+62 816-565-232</p>
                            </div>
                            {{-- <div class="flex items-center">
                                <i class="ti ti-mail text-primary text-xl mr-4"></i>
                                <p>info@nutcastlecafe.com</p>
                            </div> --}}
                            <div class="space-y-2">
                                <h4 class="font-bold text-lg">Jam Operasional:</h4>
                                <p>Senin - Minggu: 7:00 Pagi - 3:00 Sore</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Location Section End-->

        <!-- CTA Section -->
        {{-- <section class="mt-8 bg-primary overflow-hidden py-16 text-white">
            <div class="container container-xl">
                <div class="grid grid-cols-12 gap-6 justify-between items-center">
                    <div class="xl:col-span-7 lg:col-span-7 col-span-12 lg:text-left text-center">
                        <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Memulai Perjalanan Kesehatan Anda?</h2>
                        <p class="text-lg mb-6 opacity-90">Bergabunglah dengan Nut Castle Cafe hari ini dan transformasikan gaya hidup Anda dengan layanan kesehatan dan nutrisi komprehensif kami.</p>
                    </div>
                    <div class="xl:col-span-5 lg:col-span-5 col-span-12 flex lg:justify-end justify-center">
                        <a href="{{ route('login') }}" class="btn bg-white text-primary hover:bg-lightprimary py-3 px-8 text-lg font-medium">Masuk Sekarang</a>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- CTA Section End-->

        <!-- Footer Section -->
        {{-- <section class="pt-12 pb-6">
            <div class="container container-xl">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <h4 class="text-lg font-bold mb-4">Nut Castle Cafe</h4>
                        <p class="mb-4">Mitra Anda dalam kesehatan dan nutrisi, didedikasikan untuk membantu Anda mencapai kesejahteraan optimal melalui layanan personal dan bimbingan ahli.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-primary hover:text-secondary"><i class="ti ti-brand-facebook"></i></a>
                            <a href="#" class="text-primary hover:text-secondary"><i class="ti ti-brand-instagram"></i></a>
                            <a href="#" class="text-primary hover:text-secondary"><i class="ti ti-brand-twitter"></i></a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-4">Tautan Cepat</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-primary">Beranda</a></li>
                            <li><a href="#about-us" class="hover:text-primary">Tentang Kami</a></li>
                            <li><a href="#services" class="hover:text-primary">Layanan</a></li>
                            <li><a href="#activities" class="hover:text-primary">Kegiatan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-4">Layanan</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-primary">Pemeriksaan Kesehatan</a></li>
                            <li><a href="#" class="hover:text-primary">Program Diet</a></li>
                            <li><a href="#" class="hover:text-primary">Kelas Olahraga</a></li>
                            <li><a href="#" class="hover:text-primary">Konsultasi</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-4">Buletin</h4>
                        <p class="mb-4">Berlangganan untuk menerima tips, resep, dan update tentang program kami.</p>
                        <div class="flex">
                            <input type="email" placeholder="Email Anda" class="form-input rounded-r-none">
                            <button class="btn btn-primary rounded-l-none">Kirim</button>
                        </div>
                    </div>
                </div>
                <div class="border-t pt-6">
                    <p class="text-center">© 2025 Nut Castle Cafe. Hak cipta dilindungi undang-undang.</p>
                </div>
            </div>
        </section> --}}
        <!-- Footer Section End -->
    </div>
@endsection

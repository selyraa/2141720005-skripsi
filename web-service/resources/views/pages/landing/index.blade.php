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
                                <i class="ti ti-apple text-secondary text-lg"></i>Healthy Living & Wellness
                            </h6>
                            <h1 class="font-bold mb-7 lg:text-[55px] lg:leading-[66px] text-4xl" data-aos="fade-up"
                                data-aos-delay="400" data-aos-duration="1000">
                                Nut Castle
                                <br>
                                <span class="text-primary">
                                    Cafe</span>
                            </h1>
                            <p class="text-lg mb-10" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                                Your ultimate destination for nutritional wellness and healthy lifestyle. We combine delicious food with expert health guidance to help you achieve your optimal well-being.
                            </p>
                            <div class="md:flex items-center gap-3.5" data-aos="fade-up" data-aos-delay="800"
                                data-aos-duration="1000">
                                <a class="btn py-3 px-12 mb-3 sm:mb-0 flex justify-center"
                                    href="{{ route('login') }}">Login</a>
                                <a class="btn btn-outline-primary scroll-link px-6 py-3 flex justify-center"
                                    href="#services">Our Services</a>
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
                                About
                                <span class="text-primary">
                                    Nut Castle Cafe</span>
                            </h2>
                            <p class="text-lg mb-6" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                                Established in 2020, Nut Castle Cafe is more than just a cafe - it's a wellness hub dedicated to promoting healthy living through nutrition and fitness.
                            </p>
                            <p class="text-lg mb-6" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                                Our mission is to create a community where health-conscious individuals can enjoy nutritious meals, receive expert guidance, and participate in wellness activities that enhance their quality of life.
                            </p>
                            <p class="text-lg mb-6" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                                At Nut Castle, we combine the science of nutrition with the art of culinary excellence to create dishes that are both delicious and beneficial for your body.
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
                        Our Services
                    </h2>
                    <p class="text-lg mb-10 text-center" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                        Comprehensive wellness solutions tailored to your health needs
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
                                <h3 class="font-bold text-2xl mb-4">Health Check-ups</h3>
                                <p class="mb-6">
                                    Comprehensive health assessments including BMI calculation, body composition analysis, and nutritional evaluation conducted by our certified health professionals.
                                </p>
                                <a href="#" class="text-primary font-medium hover:underline flex items-center gap-2">
                                    Learn more <i class="ti ti-arrow-right"></i>
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
                                <h3 class="font-bold text-2xl mb-4">Health Consultations</h3>
                                <p class="mb-6">
                                    One-on-one sessions with our nutritionists and health experts to create personalized nutrition plans that align with your health goals and dietary preferences.
                                </p>
                                <a href="#" class="text-primary font-medium hover:underline flex items-center gap-2">
                                    Learn more <i class="ti ti-arrow-right"></i>
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
                                <h3 class="font-bold text-2xl mb-4">Sports Classes</h3>
                                <p class="mb-6">
                                    Group and individual fitness sessions including yoga, pilates, and strength training designed to complement your nutritional journey and enhance overall wellness.
                                </p>
                                <a href="#" class="text-primary font-medium hover:underline flex items-center gap-2">
                                    Learn more <i class="ti ti-arrow-right"></i>
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
                                <h3 class="font-bold text-2xl mb-4">Diet Programs</h3>
                                <p class="mb-6">
                                    Customized diet plans tailored to your specific health needs, whether it's weight management, muscle gain, or managing health conditions through nutrition.
                                </p>
                                <a href="#" class="text-primary font-medium hover:underline flex items-center gap-2">
                                    Learn more <i class="ti ti-arrow-right"></i>
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
                                <h3 class="font-bold text-2xl mb-4">Healthy Cafe</h3>
                                <p class="mb-6">
                                    Enjoy our menu of nutritious meals and beverages made from fresh, locally-sourced ingredients that support your health goals while delighting your taste buds.
                                </p>
                                <a href="#" class="text-primary font-medium hover:underline flex items-center gap-2">
                                    View Menu <i class="ti ti-arrow-right"></i>
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
                                <h3 class="font-bold text-2xl mb-4">Wellness Workshops</h3>
                                <p class="mb-6">
                                    Educational sessions and cooking classes to help you understand nutrition better and learn how to prepare healthy meals at home for continued wellness.
                                </p>
                                <a href="#" class="text-primary font-medium hover:underline flex items-center gap-2">
                                    See Schedule <i class="ti ti-arrow-right"></i>
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
                        Our Regular Activities
                    </h2>
                    <p class="text-lg mb-10 text-center" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                        Join our community in these regular wellness activities
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Activity 1 -->
                    <div class="card overflow-hidden">
                        <div class="h-100 overflow-hidden">
                            <img src="../assets/images/backgrounds/activity-1.jpg" alt="Morning Yoga" class="w-full h-auto object-cover">
                        </div>
                        <div class="card-body">
                            <span class="badge-primary text-xs font-bold py-1 px-2 rounded mb-3 inline-block">Monday & Wednesday</span>
                            <h3 class="text-xl font-bold mb-2">Morning Yoga</h3>
                            <p class="mb-4">Start your day with balance and energy through our guided yoga sessions suitable for all levels.</p>
                            <div class="flex items-center">
                                <span class="text-sm"><i class="ti ti-clock mr-1"></i> 7:00 AM - 8:30 AM</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Activity 2 -->
                    <div class="card overflow-hidden">
                        <div class="h-100 overflow-hidden">
                            <img src="../assets/images/backgrounds/activity-2.jpg" alt="Nutrition Consultation" class="w-full h-auto object-cover">
                        </div>
                        <div class="card-body">
                            <span class="badge-primary text-xs font-bold py-1 px-2 rounded mb-3 inline-block">Tuesday & Thursday</span>
                            <h3 class="text-xl font-bold mb-2">Nutrition Consultations</h3>
                            <p class="mb-4">One-on-one sessions with our certified nutritionists to personalize your diet plan.</p>
                            <div class="flex items-center">
                                <span class="text-sm"><i class="ti ti-clock mr-1"></i> 10:00 AM - 4:00 PM</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Activity 3 -->
                    <div class="card overflow-hidden">
                        <div class="h-100 overflow-hidden">
                            <img src="../assets/images/backgrounds/activity-3.jpg" alt="Cooking Workshop" class="w-full h-auto object-cover">
                        </div>
                        <div class="card-body">
                            <span class="badge-primary text-xs font-bold py-1 px-2 rounded mb-3 inline-block">Saturday</span>
                            <h3 class="text-xl font-bold mb-2">Healthy Cooking Workshop</h3>
                            <p class="mb-4">Learn to prepare delicious and nutritious meals with our chef's guidance and tips.</p>
                            <div class="flex items-center">
                                <span class="text-sm"><i class="ti ti-clock mr-1"></i> 2:00 PM - 4:00 PM</span>
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
                        What Our Clients Say
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
                        <p class="mb-6 italic">"The personalized diet plan from Nut Castle completely transformed my relationship with food. I've lost 15kg in 6 months and feel more energetic than ever!"</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                                <img src="../assets/images/profile/user-1.jpg" alt="Sarah M." class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h5 class="font-bold">Sarah M.</h5>
                                <span class="text-sm">Diet Program Client</span>
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
                        <p class="mb-6 italic">"The yoga classes at Nut Castle are exceptional. The instructors are knowledgeable and the atmosphere is so calming. It's become my favorite part of the week!"</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                                <img src="../assets/images/profile/user-2.jpg" alt="Michael T." class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h5 class="font-bold">Michael T.</h5>
                                <span class="text-sm">Yoga Class Member</span>
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
                        <p class="mb-6 italic">"Not only is the food at Nut Castle delicious, but the nutritional guidance has helped me manage my diabetes better than ever. I'm so grateful for their expertise!"</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                                <img src="../assets/images/profile/user-3.jpg" alt="Emma L." class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h5 class="font-bold">Emma L.</h5>
                                <span class="text-sm">Health Consultation Client</span>
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
                    <h2 class="text-center font-bold md:text-4xl text-2xl mb-6">Visit Us</h2>
                    <p class="text-lg text-center">Come experience wellness at our convenient location</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div class="card p-0 overflow-hidden">
                        <div class="h-96 w-full">
                            <!-- Replace with actual map or image of location -->
                            <img src="../assets/images/backgrounds/map.jpg" alt="Map location" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold mb-4">Contact Information</h3>
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
                                <h4 class="font-bold text-lg">Opening Hours:</h4>
                                <p>Monday - Sunday: 7:00 AM - 3:00 PM</p>
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
                        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Start Your Wellness Journey?</h2>
                        <p class="text-lg mb-6 opacity-90">Join Nut Castle Cafe today and transform your lifestyle with our comprehensive health and nutrition services.</p>
                    </div>
                    <div class="xl:col-span-5 lg:col-span-5 col-span-12 flex lg:justify-end justify-center">
                        <a href="{{ route('login') }}" class="btn bg-white text-primary hover:bg-lightprimary py-3 px-8 text-lg font-medium">Login Now</a>
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
                        <p class="mb-4">Your partner in health and nutrition, dedicated to helping you achieve optimal wellness through personalized services and expert guidance.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-primary hover:text-secondary"><i class="ti ti-brand-facebook"></i></a>
                            <a href="#" class="text-primary hover:text-secondary"><i class="ti ti-brand-instagram"></i></a>
                            <a href="#" class="text-primary hover:text-secondary"><i class="ti ti-brand-twitter"></i></a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-4">Quick Links</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-primary">Home</a></li>
                            <li><a href="#about-us" class="hover:text-primary">About Us</a></li>
                            <li><a href="#services" class="hover:text-primary">Services</a></li>
                            <li><a href="#activities" class="hover:text-primary">Activities</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-4">Services</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-primary">Health Check-ups</a></li>
                            <li><a href="#" class="hover:text-primary">Diet Programs</a></li>
                            <li><a href="#" class="hover:text-primary">Sports Classes</a></li>
                            <li><a href="#" class="hover:text-primary">Consultations</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-4">Newsletter</h4>
                        <p class="mb-4">Subscribe to receive tips, recipes, and updates on our programs.</p>
                        <div class="flex">
                            <input type="email" placeholder="Your email" class="form-input rounded-r-none">
                            <button class="btn btn-primary rounded-l-none">Send</button>
                        </div>
                    </div>
                </div>
                <div class="border-t pt-6">
                    <p class="text-center">© 2025 Nut Castle Cafe. All rights reserved.</p>
                </div>
            </div>
        </section> --}}
        <!-- Footer Section End -->
    </div>
@endsection

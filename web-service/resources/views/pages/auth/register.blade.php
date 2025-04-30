<!DOCTYPE html>
<html lang="en" dir="ltr" data-color-theme="Blue_Theme" class="light selected"
    data-layout="vertical" data-boxed-layout="boxed" data-card="shadow">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/logos/favicon.png')}}" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
    rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <!-- Core Css -->
    <link rel="stylesheet" href="{{asset('assets/css/theme.css')}}" />
    <title>Register | Asn Indonesia</title>
</head>

<body class="DEFAULT_THEME bg-white dark:bg-dark">	
    <main>
        <!--start the project-->
        <div id="main-wrapper" class="flex">
            <!-- Main Content -->
            <main class="h-screen w-full bg-lightprimary">
                <div class="h-full w-full flex justify-center items-center">
                    <div class="flex justify-center w-full">
                        <div class="xl:w-2/6 w-full">
                            <div class="max-w-[500px] px-3 mx-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mx-auto text-center mb-8">
                                            <div class="flex justify-center"> <div class="brand-logo flex items-center">
                                            <a href="/" class="text-nowrap logo-img">
                                                <img
                                                src="{{asset('assets/images/logos/dark-logo.svg')}}"
                                                class="dark:hidden block rtl:hidden"
                                                alt="Logo-Dark"
                                                />
                                                <img
                                                src="{{asset('assets/images/logos/light-logo.svg')}}"
                                                class="dark:block hidden rtl:hidden rtl:dark:hidden"
                                                alt="Logo-light"
                                                />
                                                
                                                <img
                                                src="{{asset('assets/images/logos/dark-logo-rtl.svg')}}"
                                                class="dark:hidden hidden rtl:block rtl:dark:hidden"
                                                alt="Logo-Dark"
                                                />
                                                <img
                                                src="{{asset('assets/images/logos/light-logo-rtl.svg')}}"
                                                class="dark:hidden hidden rtl:hidden rtl:dark:block"
                                                alt="Logo-light"
                                                />
                                            </a>
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center mb-6">
                                            <h4 class="text-xl font-semibold">Create an account</h4>
                                            <p class="text-slate-500 dark:text-darktext mt-1">It's free and easy!</p>
                                        </div>
                                        
                                        @if ($errors->any())
                                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        
                                        <form method="POST" action="{{ route('register.post') }}">
                                            @csrf
                                            <div class="flex flex-col gap-4">
                                                <div>
                                                    <label for="name"
                                                        class="text-dark dark:text-darklink font-semibold mb-2 block">Full Name</label>
                                                    <input type="text" name="name" id="name" class="form-control py-2" value="{{ old('name') }}" required autofocus />
                                                </div>
                                                <div>
                                                    <label for="email"
                                                        class="text-dark dark:text-darklink font-semibold mb-2 block">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control py-2" value="{{ old('email') }}" required />
                                                </div>
                                                <div>
                                                    <label for="phone_number"
                                                        class="text-dark dark:text-darklink font-semibold mb-2 block">Phone Number</label>
                                                    <input type="text" name="phone_number" id="phone_number" class="form-control py-2" value="{{ old('phone_number') }}" />
                                                </div>
                                                <div>
                                                    <label for="gender"
                                                        class="text-dark dark:text-darklink font-semibold mb-2 block">Gender</label>
                                                    <select name="gender" id="gender" class="form-control py-2">
                                                        <option value="">Select Gender</option>
                                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="birth_date"
                                                        class="text-dark dark:text-darklink font-semibold mb-2 block">Birth Date</label>
                                                    <input type="date" name="birth_date" id="birth_date" class="form-control py-2" value="{{ old('birth_date') }}" />
                                                </div>
                                                <div>
                                                    <label for="password"
                                                        class="text-dark dark:text-darklink font-semibold mb-2 block">Password</label>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control py-2" required />
                                                </div>
                                                <div>
                                                    <label for="password_confirmation"
                                                        class="text-dark dark:text-darklink font-semibold mb-2 block">Confirm Password</label>
                                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                                        class="form-control py-2" required />
                                                </div>
                                                <div>
                                                    <label class="cursor-pointer label flex items-center">
                                                        <input type="checkbox" name="terms" class="border-bordergray w-4 h-4 rounded-md text-primary dark:border-darkborder bg-transparent dark:checked:bg-primary dark:checked:border-primary focus:ring-0 focus:ring-offset-0" id="terms" required>
                                                        <span class="label-text ms-2">I agree to all <a href="#" class="text-primary">Terms & Conditions</a></span>
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-md py-3">Sign Up</button>
                                                <div class="mt-2.5 text-center">
                                                    <span class="text-base font-medium">Already have an account? <a href="{{ route('login') }}"
                                                            class="text-primary font-medium text-sm ms-2">Sign In</a></span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Main Content End -->
        </div>
        <!--end of project-->
    </main>
</div>
    
<script src="{{asset('assets/js/theme/app.init.js')}}"></script>
<script src="{{asset('assets/js/theme/app.min.js')}}"></script>
<script src="{{asset('assets/js/theme.js')}}"></script>
</body>
</html>
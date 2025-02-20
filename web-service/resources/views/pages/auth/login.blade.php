<!DOCTYPE html>
<html  lang="en" dir="ltr" data-color-theme="Blue_Theme" class="light selected"
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
    <title>Login | Asn Indonesia</title>
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
                            <div class="max-w-[460px] px-3 mx-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mx-auto text-center mb-12">
                                            <div class="flex justify-center"> <div class="brand-logo flex  items-center ">
                                            <a href="../main/index.html" class="text-nowrap logo-img">
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
                                        <div class="grid grid-cols-2 gap-6 mb-4">
                                            <a href="javascript:void(0)"
                                                class="border border-light-dark rounded-md py-2.5 px-3 justify-center flex items-center hover:text-primary dark:hover:text-primary">
                                                <img src="{{asset('assets/images/svgs/google-icon.svg')}}" alt=""
                                                    class="me-2" width="18" height="18">
                                                <span class="shrink-0">with Google</span>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="border border-light-dark rounded-md py-2.5 px-3 justify-center flex items-center hover:text-primary dark:hover:text-primary">
                                                <img src="{{asset('assets/images/svgs/facebook-icon.svg')}}" alt=""
                                                    class="me-2" width="18" height="18">
                                                <span class="shrink-0">with FB</span>
                                            </a>
                                        </div>
                                        <div class="flex items-center text-base  before:flex-[1_1_0%] before:border-t before:border-border before:me-6 after:flex-[1_1_0%] after:border-t after:border-border after:ms-6 dark:text-white dark:before:border-darkborder dark:after:border-darkborder">or sign in with</div>
                                        <form>
                                            <div class="flex flex-col gap-4 mt-4">
                                                <div>
                                                    <label
                                                        class="text-dark dark:text-darklink font-semibold mb-2 block">Username</label>
                                                    <input type="text" class="form-control py-2" />
                                                </div>
                                                <div>
                                                    <label
                                                        class="text-dark dark:text-darklink font-semibold mb-2 block">Password</label>
                                                    <input type="password"
                                                        class="form-control py-2" />
                                                </div>
                                                <div>
                                                    <div class="flex justify-between my-2">
                                                        <div>
                                                            <label class="cursor-pointer label flex items-center ">
                                                                <input type="checkbox" class="border-bordergray w-4 h-4 rounded-md text-primary dark:border-darkborder bg-transparent dark:checked:bg-primary dark:checked:border-primary focus:ring-0 focus:ring-offset-0" checked id="checkbox1">
                                                                <span class="label-text ms-2">Remeber this Device</span>
                                                            </label>
                                                        </div>
                                                        <a href="../main/authentication-forgot-password.html"
                                                            class="text-primary font-semibold">Forgot Password ?</a>
                                                    </div>
                                                </div>
                                                <button class="btn btn-md py-3">Sign In</button>
                                                <div class="mt-2.5 text-center ">
                                                    <span class="text-base font-medium ">New to
                                                        Modernize? <a href="../main/authentication-register2.html"
                                                            class="text-primary font-medium text-sm ms-2">Create an
                                                            account</a></span>
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
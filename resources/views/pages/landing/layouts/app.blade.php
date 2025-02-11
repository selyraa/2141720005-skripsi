<!DOCTYPE html>
<html lang="en" dir="ltr" data-color-theme="Blue_Theme" class="light selected" data-layout="vertical"
    data-boxed-layout="boxed" data-card="shadow">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <!-- Core Css -->
    <link rel="stylesheet" href="../assets/css/theme.css" />
    <title>Modernize TailwindCSS HTML Admin Template</title>
    <link rel="stylesheet" href="../assets/libs/owl.carousel/dist/assets/owl.carousel.min.css">
</head>

<body class="DEFAULT_THEME bg-white dark:bg-dark">

    <main>
        <!--start the project-->
        <div id="main-wrapper" class="flex landingpage">

            <div class="w-full">
                @include('pages.landing.layouts.header')
                <!--  Header End -->

                <!-- Main Content -->
                <div class="max-w-full pt-6">
                    @yield('content')
                </div>

            </div>
            <!--  Header Start -->
            <!-- Main Content End -->

        </div>
        <!--end of project-->

    </main>


    <script>
        function handleColorTheme(e) {
            document.documentElement.setAttribute("data-color-theme", e);
        }
    </script>
    <script src="../assets/js/vendor.min.js"></script>

    <script src="../assets/js/theme/app.init.js"></script>
    <script src="../assets/js/theme/app.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../assets/libs/preline/dist/preline.js"></script>
    <script src="../assets/libs/@preline/input-number/index.js"></script>
    <script src="../assets/libs/@preline/tooltip/index.js"></script>
    <script src="../assets/libs/@preline/stepper/index.js"></script>



    <script src="../assets/libs/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/js/dashboards/dashboard.js"></script>
</body>

</html>

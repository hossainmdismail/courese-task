<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta -->
    <meta name="keywords"
        content="Laravel, Course Creator, LMS, Admin Dashboard, Module Management, Education Platform, Learning, PHP, jQuery">
    <meta name="author" content="Esmail Khalifa">
    <meta name="robots" content="index, follow">
    <meta name="description"
        content="A Laravel-based Course Creation System with dynamic modules and content, built using HTML, CSS, jQuery, and PHP. Designed for efficient learning content management.">

    <!-- Open Graph (Social Sharing) -->
    <meta property="og:title" content="Laravel Course Creation System – Dynamic Modules & Content">
    <meta property="og:description"
        content="Create courses with unlimited modules and content using this Laravel + jQuery powered learning management system. Built for flexibility, speed, and clean code.">
    <meta property="og:image" content="/images/social-preview.png"> <!-- Change path if needed -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://yourdomain.com"> <!-- Replace with actual project URL -->

    <!-- Mobile Specific -->
    <meta name="format-detection" content="telephone=no">

    <!-- Title -->
    <title>Laravel Course Builder – Create Courses, Modules & Content Easily</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="{{ asset('assets') }}/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/chartist/css/chartist.min.css">
    <link href="{{ asset('assets') }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet">
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
        rel="stylesheet">
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <div class="nav-header">
            <a href="#" class="brand-logo">
                <h1 class="logo-abbr">CR</h1>
                <h1 class="brand-title">Task</h1>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        @include('layout.header')
        @include('layout.sidebar')



        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        @include('layout.footer')

    </div>
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('assets') }}/vendor/global/global.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    {{-- <script src="{{ asset('assets') }}/vendor/chart-js/chart.bundle.min.js"></script> --}}
    <script src="{{ asset('assets') }}/js/custom.min.js"></script>
    <script src="{{ asset('assets') }}/js/deznav-init.js"></script>
    {{-- <script src="{{ asset('assets') }}/vendor/bootstrap-datetimepicker/js/moment.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script> --}}
    <!-- Chart piety plugin files -->
    <script src="{{ asset('assets') }}/vendor/peity/jquery.peity.min.js"></script>

    <!-- Apex Chart -->
    {{-- <script src="{{ asset('assets') }}/vendor/apexchart/apexchart.js"></script> --}}

    <!-- Dashboard 1 -->
    <script src="{{ asset('assets') }}/js/dashboard/dashboard-1.js"></script>
    <script>
        $(function() {
            $('#datetimepicker1').datetimepicker({
                inline: true,
            });
        });
    </script>
    @yield('script')
</body>

</html>

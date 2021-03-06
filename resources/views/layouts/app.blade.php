<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <?php $ApplicationName = Config::get('settings.company_name'); ?>

    <title>@yield('title', 'Welcome To | '.$ApplicationName)</title>

    <!-- Favicon-->

    <?php $image = Config::get('settings.company_logo') ?>

    <link rel="icon" href="{{ asset($image ) }}" type="image/x-icon">

    <!-- Google Fonts -->

    <link href="{{ asset('public/asset/css/font-g/font-1.css') }}" rel="stylesheet"
          type="text/css">

    <link href="{{ asset('public/asset/css/font-g/icon-1.css') }}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('public/asset/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('public/asset/plugins/node-waves/waves.css') }}" rel="stylesheet"/>

    <!-- Animation Css -->
    <link href="{{ asset('public/asset/plugins/animate-css/animate.css') }}" rel="stylesheet"/>

    <!-- Morris Chart Css-->
    <link href="{{ asset('public/asset/plugins/morrisjs/morris.css') }}" rel="stylesheet"/>

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('public/asset/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
          rel="stylesheet"/>

    <link rel="stylesheet" href="{{ asset('public/asset/css/toastr/toastr.css') }}">

    @stack('include-css')


<!-- Custom Css -->
    <link href="{{ asset('public/asset/css/style.css') }}" rel="stylesheet">

    {{--Fonts Awesome--}}

    <link rel="stylesheet" href="{{ asset('public/asset/css/fontawesome.css') }}">


    {{--Utility Css--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('public/asset/layout/css/util.css') }}">



    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('public/asset/css/themes/all-themes.css') }}" rel="stylesheet"/>





</head>

<body class="theme-light-blue">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->

<!-- #END# Search Bar -->
<!-- Top Bar -->
@yield('top-bar')
<!-- #Top Bar -->

<!-- Left Sidebar -->
@yield('left-sidebar')
<!-- #END# Left Sidebar -->

@yield('content')


<!-- Jquery Core Js -->
<script src="{{ asset('public/asset/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('public/asset/plugins/bootstrap/js/bootstrap.js') }}"></script>

<!-- Select Plugin Js -->
<script src="{{ asset('public/asset/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{ asset('public/asset/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset('public/asset/plugins/node-waves/waves.js') }}"></script>

<!-- Custom Js -->
<script src="{{ asset('public/asset/js/admin.js') }}"></script>

<script src="{{ asset('public/asset/js/pages/ui/tooltips-popovers.js') }}"></script>
<script src="{{ asset('public/asset/js/toastr.min.js') }}"></script>


<!-- Demo Js -->
<script src="{{ asset('public/asset/js/demo.js') }}"></script>
{{--page ways script--}}
@stack('include-js')

</body>

</html>

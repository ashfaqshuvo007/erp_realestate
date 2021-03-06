<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('public/asset/plugins/bootstrap/v400/bootstrap.min.css') }}" rel="stylesheet">

    {{--Report style--}}
    <link rel="stylesheet" href="{{ asset('public/asset/css/report.css') }}">


    <title>@yield('title', 'Report')</title>


    @stack('include-css')

    {{--Utility Css--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('public/asset/layout/css/util.css') }}">

    <script src="{{ asset('public/asset/js/pages/ui/tooltips-popovers.js') }}"></script>


</head>
<body>

@yield('content')

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<!-- Jquery Core Js -->
<script src="{{ asset('public/asset/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('public/asset/plugins/bootstrap/js/bootstrap.js') }}"></script>



</body>
</html>

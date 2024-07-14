<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin :: Space</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/bootstrap/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/morrisjs/morris.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css') }}" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap-select.css') }}">

    <link rel="stylesheet" href="{{ asset('admin-assets/css/color_skins.css') }}">

    <!-- toastr css cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>

</head>

<body class="theme-black">

    @include('admin.partials.admin-head')
    @include('admin.partials.admin-sidebar')
    @yield('content')

    <!-- Jquery Core Js -->
    <script src="{{ asset('admin-assets/bundles/libscripts.bundle.js') }}"></script>
    <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
    <script src="{{ asset('admin-assets/bundles/vendorscripts.bundle.js') }}"></script> <!-- slimscroll, waves Scripts Plugin Js -->

    <script src="{{ asset('admin-assets/bundles/knob.bundle.js') }}"></script> <!-- Jquery Knob-->
    <script src="{{ asset('admin-assets/bundles/jvectormap.bundle.js') }}"></script> <!-- JVectorMap Plugin Js -->
    <script src="{{ asset('admin-assets/bundles/morrisscripts.bundle.js') }}"></script> <!-- Morris Plugin Js -->
    <script src="{{ asset('admin-assets/bundles/sparkline.bundle.js') }}"></script> <!-- sparkline Plugin Js -->
    <script src="{{ asset('admin-assets/bundles/doughnut.bundle.js') }}"></script>

    <script src="{{ asset('admin-assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('admin-assets/js/pages/index.js') }}"></script>
    <script src="{{ asset('admin-assets/js/custom.js') }}"></script>
    
    <!-- toastr script cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- sweet alert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('admin-scripts')

</body>

</html>

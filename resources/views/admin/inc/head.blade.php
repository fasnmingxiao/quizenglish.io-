<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">


    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- inject:css-->

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/bootstrap/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/fontawesome.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/footable.standalone.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/fullcalendar@5.2.0.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/jquery-jvectormap-2.0.5.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/jquery.mCustomScrollbar.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/leaflet.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/line-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/MarkerCluster.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/MarkerCluster.Default.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/slick.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/star-rating-svg.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/trumbowyg.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor_assets/css/wickedpicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/style.css') }}">

    <!-- endinject -->

    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">

    {{-- toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

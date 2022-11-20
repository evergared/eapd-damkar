<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: auto;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} | {{ $title }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    @vite('resources/css/adminlte-dashboard.css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    @stack('stack-head')
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-mini layout-fixed  layout-navbar-fixed"
    style="height: auto;">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('damkar/logo_damkar_dki.png')}}" alt="Damkar" height="60"
                width="60">
        </div>

        @include('eapd.layouts.navigasi.adminlte-dashboard-topnav')

        @include('eapd.layouts.navigasi.adminlte-dashboard-sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>


        @include('eapd.layouts.footer.adminlte-dashboard-footer')
    </div>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    @stack('stack-body')

    @vite('resources/js/adminlte-dashboard.js')
    <script src="{{asset('admin-lte/adminlte.min.js')}}">
    </script>
    <script src="{{asset('admin-lte/demo.js')}}">
        </body>

</html>
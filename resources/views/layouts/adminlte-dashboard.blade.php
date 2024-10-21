<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: auto;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} | {{ $title }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    @vite('resources/css/adminlte-dashboard.css')
    @vite('resources/css/filter.css')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
    <!-- Alpine v3 -->
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    <!-- Focus plugin -->
    {{-- <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style> --}}
    @stack('stack-head')
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-mini layout-fixed  layout-navbar-fixed"
    style="height: auto;">
    <div class="wrapper">
    @include('helper.js-loader')

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('damkar/logo_damkar_dki.png')}}" alt="Damkar" height="60"
                width="60">
        </div>

        <livewire:layouts.navigasi.adminlte-pegawai-topnav>

        <livewire:layouts.navigasi.adminlte-pegawai-sidebar>

        <div class="content-wrapper">
            @yield('content')
        </div>


        @include('layouts.footer.adminlte-dashboard-footer')
    </div>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    @stack('stack-body')

    @vite('resources/js/adminlte-dashboard.js')
    @vite('public/admin-lte/adminlte.min.js')
    @vite('public/admin-lte/demo.js')
    @vite('public/admin-lte/filter.js')
    @include('helper.script-modal')
</body>

</html>
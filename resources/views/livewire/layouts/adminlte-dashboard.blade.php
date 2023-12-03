<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: auto;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EAPD') }} | {{ ($page_title) ? $page_title : '' }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <script src="{{asset('jquery-3.7.1.min.js')}}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    @vite('resources/js/app.js')
    @vite('resources/css/adminlte-dashboard.css')
    @vite('resources/css/filter.css')
    @stack('stack-head')
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-mini layout-fixed  layout-navbar-fixed"
    style="height: auto;">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('damkar/logo_damkar_dki.png')}}" alt="Damkar" height="60"
                width="60">
        </div>

        <livewire:layouts.navigasi.adminlte-pegawai-topnav>
        @auth("admin")
        <livewire:layouts.navigasi.adminlte-admin-sidebar>
        @endauth

        @auth("web")
        <livewire:layouts.navigasi.adminlte-pegawai-sidebar>
        @endauth
        

        <div class="content-wrapper">
            {{ $slot }}
        </div>


        @include('layouts.footer.adminlte-dashboard-footer')
    </div>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    @stack('stack-body')

  

    <script src="{{asset('admin-lte/adminlte.min.js')}}"></script>
    <script src="{{asset('admin-lte/ekko-lightbox.min.js')}}"></script>
    <script src="{{asset('admin-lte/demo.js')}}"></script>
    <script src="{{asset('admin-lte/filter.js')}}"></script>

    @include('helper.script-modal')
    @livewireScripts


</body>

</html>
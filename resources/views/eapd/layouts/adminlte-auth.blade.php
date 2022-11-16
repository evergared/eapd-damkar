<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: auto;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}|{{ $title }}</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    @vite('resources/css/adminlte-auth.css')
</head>

<body style="background: #063970">
    <div class="wrapper d-flex justify-content-center">
        @yield('content')
    </div>

    <footer>
        <div class="text-center text-white">
            <strong>
                &copy; 2022
                <?php if(date('Y') != '2022'){echo ' - ' . date('Y');}?>
            </strong>
        </div>
    </footer>

</body>

</html>
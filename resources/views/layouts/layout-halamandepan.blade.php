<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== REMIXICONS ===============-->
      <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="{{asset('utama/css/styles.css')}}">

      <title>Login E-Apd</title>
   </head>
   <body>
      <div class="login">
         @yield('content')
      </div>
      
      <!--=============== MAIN JS ===============-->
      <script src="{{asset('utama/js/main.js')}}"></script>
   </body>
</html>
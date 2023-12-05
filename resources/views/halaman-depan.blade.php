@extends('layouts.layout-halamandepan')

@section('content')


<img src="{{asset('utama/img/landing_page1.jpg')}}" alt="login image" class="login__img">
    <form method="POST" action="{{ route('login') }}" class="login__form">
         @csrf
         <h1 class="login__title">E-APD</h1>
            <h1 class="login__title">Login</h1>

            <div class="login__content">
               <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="text" autocomplete="off" required class="login__input" id="nrk" name="nrk" :value="old('nrk')" placeholder="">
                     <label for="nrk" class="login__label">NRK/NPJLP</label>
                  </div>
               </div>
               @error('nrk')
                  <small><i>{{$message}}</i></small>
               @enderror

               <div class="login__box">
                  <i class="ri-lock-2-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="password" required class="login__input" id="password"
                     name="password" autocomplete="current-password" placeholder="">
                     <label for="login-pass" class="login__label">Password</label>
                     <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                  </div>
               </div>
            </div>

            @error('password')
                  <small><i>{{$message}}</i></small>
            @enderror

            <div class="login__check">
               <div class="login__check-group">
                  <input type="checkbox" class="login__check-input" id="login-check" name="remember">
                  <label for="login-check" class="login__check-label">Remember me</label>
               </div>

            </div>

            <button type="submit" class="login__button">Login</button>

    </form>
@endsection

@extends('eapd.layouts.adminlte-auth',['title'=>'Login'])

@section('content')

<div class="card pt-2 mt-3" style="width: 500px">
    <div class="card-header text-center">
        <img src="{{ asset('damkar/logo_dki.png') }}" height="72" width="72">
        <img src="{{ asset('damkar/logo_damkar_dki.png') }}" height="72" width="72">
        <h1>eAPD</h1>
        <p class="mb-0">Sistem Informasi APD Petugas</p>
        <p class="mb-0" style="color: darkblue">Dinas Penanggulangan Kebakaran dan Penyelamatan</p>
        <p class="mb-0" style="color: darkblue">Provinsi DKI Jakarta</p>
    </div>
    <div class="card-body">

        @isset($pesan)
        <div class="alert alert-info" role="alert">
            {{ $pesan }}
        </div>
        @endisset

        @isset($error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
        @endisset

        <form action="{{ route('login')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="nrk">NRK / NO PJLP</label>
                <input class="form-control" type="text" id="nrk" name="nrk" placeholder="Masukan NRK / NO PJLP">
                @error('nrk')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password"
                    placeholder="Masukan Password">
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <input class="mr-1" type="checkbox" id="remember" name="remember">
                Ingat Saya
            </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
</div>


@endsection
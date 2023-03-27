@extends('eapd.layouts.adminlte-dashboard',['title'=>'Profil Pegawai'])



@section('content')

@include('eapd.dashboard.komponen.breadcrumbs',['halamanJudul'=>'Daftar Distribusi APD','halaman'=>'data-distribusi'])

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        
                        @livewireStyles
                        @livewire('eapd.form.data-distribusi')

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('stack-body')
@livewireScripts
@endpush
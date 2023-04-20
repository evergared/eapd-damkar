
@extends('eapd.layouts.adminlte-dashboard',['title'=>'Ukuran'])



@section('content')

@include('eapd.dashboard.komponen.breadcrumbs',['halamanJudul'=>'Daftar Ukuran APD','halaman'=>'ukuran'])

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="card-body">

                        
                        @livewireStyles
                        @livewire('eapd.form.ukuran')

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
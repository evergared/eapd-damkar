@extends('eapd.layouts.adminlte-dashboard',['title'=>'Pengaturan Barang
'])



@section('content')

@include('eapd.dashboard.komponen.breadcrumbs',['halamanJudul'=>'Request Item','halaman'=>'request-item'])
@include('eapd.dashboard.komponen.marquee-informasi')

<section class="content">
    <div class="container-fluid">
        
            @livewireStyles
            @livewire('eapd.layout.layout-pengaturan-barang')
    </div>
</section>



@endsection
@push('stack-body')
@livewireScripts
@endpush
@extends('eapd.layouts.adminlte-dashboard',['title'=>'Laporan APD Admin Sektor'])

@section('content')


@include('eapd.dashboard.komponen.breadcrumbs',[ 'halamanJudul'=>'Print Laporan','halaman'=>'print-laporan'])
@include('eapd.dashboard.komponen.marquee-informasi')
<section class="content">

    <div class="container-fluid">
        @livewireStyles
        {{-- @livewire('eapd.form.form-periode-setting') --}}
        @livewire('eapd.layout.layout-pengaturan-periode')
    </div>
    

</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

@endsection
@push('stack-body')
@livewireScripts
@endpush
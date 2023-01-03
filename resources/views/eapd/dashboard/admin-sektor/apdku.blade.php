@extends('eapd.layouts.adminlte-dashboard',['title'=>'APDku Admin Sektor'])

@section('content')


@include('eapd.dashboard.komponen.breadcrumbs',[ 'halamanJudul'=>'APDku','halaman'=>'apdku'])
@include('eapd.dashboard.komponen.marquee-informasi')

<section class="content">
  <div class="container-fluid">
    {{-- @include('eapd.dashboard.komponen.statbox') --}}
    <livewire:eapd.layout.layout-statbox>
      <div class="row">
        <!-- Left col -->
        <section class="content">

          @push('stack-head')
          @livewireStyles
          @endpush
          @push('stack-body')
          @livewireScripts
          @endpush


          <livewire:eapd.modal.modal-input-apd-pegawai-hal-apdku>


        </section>


        <livewire:eapd.layout.layout-daftar-input-apd-hal-apdku>

      </div>
  </div>
</section>



@endsection
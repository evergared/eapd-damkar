
 @extends('eapd.layouts.adminlte-dashboard',['title'=>'Laporan Dinas'])

@section('content')



@include('eapd.dashboard.komponen.breadcrumbs',[ 'halamanJudul'=>'Laporan Dinas','halaman'=>'progres-dinas'])
@include('eapd.dashboard.komponen.marquee-informasi')

<section class="content">
    <div class="container-fluid">
        {{-- <livewire:eapd.layout.layout-statbox> --}}
            {{-- @include('eapd.dashboard.komponen.statbox') --}}
            <div class="row">
              <section class="container-fluid">
                <div class="col-12">
                  <div class="card card-primary card-outline card-outline-tabs">


                    <div class="card-header p-0 border-bottom-0">
                      <ul class="nav nav-tabs" id="progress-dinas-tablist" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="capaian-input-tab" data-toggle="tab" data-target="#capaian-input-tabpanel" type="button" role="tab" aria-controls="capaian-input-tabpanel" aria-selected="true">Capaian Input Dinas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="progress-dinas-tab" data-toggle="tab" data-target="#progress-dinas-tabpanel" type="button" role="tab" aria-controls="progress-dinas-tabpanel" aria-selected="false">Progress Inputan Dinas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="tabel-rekap-tab" data-toggle="tab" data-target="#tabel-rekap-tabpanel" type="button" role="tab" aria-controls="tabel-rekap-tabpanel" aria-selected="false">Tabel Rekapitulasi</button>
                        </li>
                      </ul>
                    </div>

                    <div class="card-body">
                      <div class="tab-content" id="progress-dinas-tablistContent">
                        <div class="tab-pane fade show active" id="capaian-input-tabpanel" role="tabpanel" aria-labelledby="capaian-input-tab">
                          @livewire("eapd.layout.layout-capaian-inputan-dinas")
                        </div>
                        <div class="tab-pane fade" id="progress-dinas-tabpanel" role="tabpanel" aria-labelledby="progress-dinas-tab">
                          @livewire('eapd.layout.layout-progress-input-dinas-admin-dinas-hal-laporan-sektor')
                        </div>
                        <div class="tab-pane fade" id="tabel-rekap-tabpanel" role="tabpanel" aria-labelledby="tabel-rekap-tab">
                          @livewire('eapd.layout.layout-rekap-apd-admin-sektor')
                        </div>
                      </div>
                    </div>

                    
                    
                    <!-- /.card -->
                  </div>
                </div>
              
              </section>
                @once
                @push('stack-head')
                @livewireStyles
                @endpush

                @push('stack-body')
                @livewireScripts
                @livewire('livewire-ui-modal')
                @endpush
                @endonce
                <livewire:eapd.modal.modal-detail-progress-sudin>

                {{-- <livewire:eapd.modal.modal-progres-dinas> --}}

            </div>
    </div>
</section>
@endsection
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
                      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#progres-grafik" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Capaian Input Dinas</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#progres-dinas" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Progres Inputan Dinas</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#tabel-rekap" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Tabel Rekap</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="progres-grafik" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                          @livewire("eapd.layout.layout-capaian-inputan-dinas")
                        </div>
                        <div class="tab-pane fade" id="progres-dinas" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                          inputan dinas
                          {{-- @livewire('eapd.layout.layout-inputan-dinas') --}}

                        </div>
                        <div class="tab-pane fade" id="tabel-rekap" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                          rekap admin dinas
                          {{-- @livewire('eapd.layout.layout-rekap-apd-admin-sektor') --}}

                          
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
                {{-- <livewire:eapd.modal.modal-progres-dinas> --}}

            </div>
    </div>
</section>
@endsection
 @extends('eapd.layouts.adminlte-dashboard',['title'=>'Laporan Sektor'])

@section('content')


@include('eapd.dashboard.komponen.breadcrumbs',[ 'halamanJudul'=>'Laporan Sektor','halaman'=>'progres-sektor'])
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
                          <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#progres-anggota" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Progres Inputan Anggota</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#tabel-rekap" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Tabel Rekap</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="progres-grafik" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                          
                        </div>
                        <div class="tab-pane fade" id="progres-anggota" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                            <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                <div class="card-header p-0 border-bottom-0">
                                  <ul class="nav nav-tabs" id="custom-tabs" role="tablist">
                                    <li class="nav-item">
                                      <a class="nav-link active" id="grub-a-tab" data-toggle="pill" href="#grub-a" role="tab" aria-controls="grub-a" aria-selected="false">Grub A</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="grub-b-tab" data-toggle="pill" href="#grub-b" role="tab" aria-controls="grub-b" aria-selected="false">Grub B</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="grub-c-tab" data-toggle="pill" href="#grub-c" role="tab" aria-controls="grub-c" aria-selected="false">Grub C</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="staf-tab" data-toggle="pill" href="#staf" role="tab" aria-controls="staf" aria-selected="false">Staf</a>
                                    </li>
                                  </ul>
                                </div>
                                {{-- Tabel anggota berdasarkan kompi Start --}}
                                <div class="card-body">
                                  <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade show active" id="grub-a" role="tabpanel" aria-labelledby="grub-a-tab">
                                      kompi A

                                      {{-- @livewire('eapd.datatable.tabel-anggota-admin-sektor',['kompi'=>'A']) --}}

                                    </div>
                                    <div class="tab-pane fade" id="grub-b" role="tabpanel" aria-labelledby="grub-b-tab">
                                      
                                      {{-- @livewire('eapd.datatable.tabel-anggota-admin-sektor',['kompi'=>'B']) --}}

                                    </div>
                                    <div class="tab-pane fade" id="grub-c" role="tabpanel" aria-labelledby="grub-c-tab">

                                       {{-- @livewire('eapd.datatable.tabel-anggota-admin-sektor',['kompi'=>'C']) --}}

                                    </div>
                                    <div class="tab-pane" id="staf" role="tabpanel" aria-labelledby="user-tab">

                                      {{-- @livewire('eapd.datatable.tabel-anggota-admin-sektor',['kompi'=>'S']) --}}

                                    </div>
                                  </div>
                                </div>
                                {{-- Tabel anggota berdasarkan kompi End --}}
                            </div>
                            <!-- detail user  -->
                              @livewire('eapd.layout.layout-show-detail-tabel-anggota-admin')
                            <!-- detail user  -->
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
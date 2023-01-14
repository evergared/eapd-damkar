 @extends('eapd.layouts.adminlte-dashboard',['title'=>'Dashboard Admin Sektor'])

@section('content')


@include('eapd.dashboard.komponen.breadcrumbs',[ 'halamanJudul'=>'Dashboard','halaman'=>'dashboard'])
@include('eapd.dashboard.komponen.marquee-informasi')

<section class="content">
    <div class="container-fluid">
        <livewire:eapd.layout.layout-statbox>
            {{-- @include('eapd.dashboard.komponen.statbox') --}}
            <div class="row">


                {{-- @include('eapd.dashboard.komponen.progress-inputan') --}}

                <section class="d-flex justify-content-center col-lg-12 connectedSortable">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Kedinasan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                                <div id="accordion">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                    1. Peluncuran aplikasi e-APD
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid.
                                                3
                                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food
                                                truck
                                                quinoa
                                                nesciunt
                                                laborum
                                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin coffee
                                                nulla
                                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                                labore
                                                wes
                                                anderson cred
                                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                                Leggings
                                                occaecat craft
                                                beer
                                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                                                heard
                                                of
                                                them accusamus
                                                labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                                    2. Masa Percobaan Input e-APD
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid.
                                                3
                                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food
                                                truck
                                                quinoa
                                                nesciunt
                                                laborum
                                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin coffee
                                                nulla
                                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                                labore
                                                wes
                                                anderson cred
                                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                                Leggings
                                                occaecat craft
                                                beer
                                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                                                heard
                                                of
                                                them accusamus
                                                labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                                    3. Update Aplikasi e-APD
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid.
                                                3
                                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food
                                                truck
                                                quinoa
                                                nesciunt
                                                laborum
                                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin coffee
                                                nulla
                                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                                labore
                                                wes
                                                anderson cred
                                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                                Leggings
                                                occaecat craft
                                                beer
                                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                                                heard
                                                of
                                                them accusamus
                                                labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.card -->
                </section>
                <section class="container-fluid">
                    <div class="col-12">
                      <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                          <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#progres-grafik" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Progres Sektor</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#progres-anggota" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Progres Inputan</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#tabel-rekap" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Tabel Rekap</a>
                            </li>
                          </ul>
                        </div>
                        <div class="card-body">
                          <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="progres-grafik" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                              <div class="container">
                               <h4>Capaian Inputan {{ auth()->user()->data->penempatan->nama_penempatan }}</h4>
                                  <div class="progress progress-sm">
                                      <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="{{$maks_inputan}}" style="width: {{ ($value_inputan > 0 && $maks_inputan >0)? round(($value_inputan/$maks_inputan)*100,2) : 0}}%">
                                      </div>
                                  </div>
                                  <small>
                                      {{ ($value_inputan > 0 && $maks_inputan >0)? 'Terinput '.round(($value_inputan/$maks_inputan)*100,2).'%' : 'Belum ada data yang terinput'}}
                                  </small><br><br><br>
                                <h4>Capaian Validasi {{ auth()->user()->data->penempatan->nama_penempatan }}</h4>
                                  <div class="progress progress-sm">
                                      <div class="progress-bar bg-info progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="{{$maks_inputan}}" style="width: {{ ($value_tervalidasi > 0 && $maks_inputan >0)? round(($value_tervalidasi/$maks_inputan)*100,2) : 0}}%">
                                      </div>
                                  </div>
                                  <small>
                                      {{ ($value_tervalidasi > 0 && $maks_inputan >0)? 'Terinput '.round(($value_tervalidasi/$maks_inputan)*100,2).'%' : 'Belum ada data yang tervalidasi'}}
                                  </small>
                              </div>
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

                                          @livewire('eapd.datatable.tabel-anggota-admin-sektor',['kompi'=>'A'])

                                        </div>
                                        <div class="tab-pane fade" id="grub-b" role="tabpanel" aria-labelledby="grub-b-tab">
                                          
                                          @livewire('eapd.datatable.tabel-anggota-admin-sektor',['kompi'=>'B'])

                                        </div>
                                        <div class="tab-pane fade" id="grub-c" role="tabpanel" aria-labelledby="grub-c-tab">

                                           @livewire('eapd.datatable.tabel-anggota-admin-sektor',['kompi'=>'C'])

                                        </div>
                                        <div class="tab-pane" id="staf" role="tabpanel" aria-labelledby="user-tab">

                                          @livewire('eapd.datatable.tabel-anggota-admin-sektor',['kompi'=>'S'])

                                        </div>
                                      </div>
                                    </div>
                                    {{-- Tabel anggota berdasarkan kompi End --}}
                                </div>
                                <!-- detail user  -->
                                  @livewire('eapd.layout.layout-show-detail-tabel-anggota-admin')
                                <!-- detail user  -->
                            </div>
                            <div class="tab-pane fade" id="tabel-rekap" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                              
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


            </div>
    </div>
</section>
@endsection
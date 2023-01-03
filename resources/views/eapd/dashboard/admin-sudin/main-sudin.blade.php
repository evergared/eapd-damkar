 @extends('eapd.layouts.adminlte-dashboard',['title'=>'Dashboard Admin Sudin'])

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
                              <div class="card" id="rekap-tabel">
                                
                                    <div class="card-header">
                                        <h4 class="modal-title">Progress Rekap</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Triwulan ke-</h3>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body table-responsive p-0" style="height: 300px;">
                                                        <table class="table text-nowrap">
                                                            <thead class="text-center table-bordered" style="background-color: gray ;">
                                                                <tr >
                                                                    <th rowspan="2" style="vertical-align:middle; background-color: gray ;">#</th>
                                                                    <th style="width:20%; vertical-align:middle; background-color: gray ;" rowspan="2" >Jenis APD</th>
                                                                    <th style="width:50%; background-color: gray ;" class="text-center" colspan="4">Kondisi</th>
                                                                    <th style="width:20%; background-color: gray ;" colspan="2">Keberadaan</th>
                                                                    <th style="width:10%; vertical-align:middle; background-color: gray ;" rowspan="2">SubTotal</th>
                                                                </tr>
                                                                <tr class="table-head-fixed">
                                                                    <th>Baik</th>
                                                                    <th>Rusak Ringan</th>
                                                                    <th>Rusak Sedang</th>
                                                                    <th>Rusak Berat</th>
                                                                    <th>Belum Terima</th>
                                                                    <th>Hilang</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center text-wrap my-auto align-middle">1</td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Fire Jacket
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                      <a onclick="rekapDetail(filterJaketBaik())" href="#rekap-tabel">1</a>
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                      <a onclick="rekapDetail(filterJaketRingan())" href="#rekap-tabel">2</a>
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                      <a onclick="rekapDetail(filterJaketSedang())" href="#rekap-tabel">3</a>
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                      <a onclick="rekapDetail(filterJaketBerat())" href="#rekap-tabel">4</a>
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                      <a onclick="rekapDetail(filterJaketBelumTerima())" href="#rekap-tabel">5</a>
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                      <a onclick="rekapDetail(filterJaketHilang())" href="#rekap-tabel">6</a>
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                      <a onclick="rekapDetail(filterJaket())" href="#rekap-tabel">7</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                  <td class="text-center text-wrap my-auto align-middle">2</td>
                                                                  <td class="text-center text-wrap my-auto align-middle">Fire Helmet
                                                                  </td>
                                                                  <td class="text-center align-middle">
                                                                    <a href="#">1</a>
                                                                  </td>
                                                                  <td class="text-center align-middle">
                                                                    <a href="#">2</a>
                                                                  </td>
                                                                  <td class="text-center align-middle">
                                                                    <a href="#">3</a>
                                                                  </td>
                                                                  <td class="text-center align-middle">
                                                                    <a href="#">4</a>
                                                                  </td>
                                                                  <td class="text-center align-middle">
                                                                    <a href="#">5</a>
                                                                  </td>
                                                                  <td class="text-center align-middle">
                                                                    <a href="#">6</a>
                                                                  </td>
                                                                  <td class="text-center align-middle">
                                                                    <a href="#">7</a>
                                                                  </td>
                                                              </tr>
                                                              <tr>
                                                                <td class="text-center text-wrap my-auto align-middle">3</td>
                                                                <td class="text-center text-wrap my-auto align-middle">Fire Troser
                                                                </td>
                                                                <td class="text-center align-middle">
                                                                  <a href="#">1</a>
                                                                </td>
                                                                <td class="text-center align-middle">
                                                                  <a href="#">2</a>
                                                                </td>
                                                                <td class="text-center align-middle">
                                                                  <a href="#">3</a>
                                                                </td>
                                                                <td class="text-center align-middle">
                                                                  <a href="#">4</a>
                                                                </td>
                                                                <td class="text-center align-middle">
                                                                  <a href="#">5</a>
                                                                </td>
                                                                <td class="text-center align-middle">
                                                                  <a href="#">6</a>
                                                                </td>
                                                                <td class="text-center align-middle">
                                                                  <a href="#">7</a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                        
                                                <!-- {{-- Card untuk preview saat user klik satu gambar start --}} -->
                                                
                                                <!-- {{-- Cart untuk preview saat user klik satu gambar end --}} -->
                        
                                                <!-- /.card -->
                                            </div>
                                        </div>
                                    </div>
                                    
                                
                                  <!-- /.modal-content -->
                              </div>
                              <div id="rekapdetail" style="display:none;">
                                <a href="javascript:" onclick="backToRekap()" class="btn btn-success"> BACK</a>
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h4 class="modal-title">Progress Rekap</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <div class="row">
                                              <div class="col-12">
                                                  <div class="card">
                                                      <div class="card-header">
                                                          <h3 class="card-title">Triwulan ke-</h3>
                                                          <!-- <button onclick="filterTroser()">test</button>
                                                          <button onclick="filterAll()">all</button>
                                                          <button onclick="filterBerat()" id="ber">berat</button> -->
                                                      </div>
                                                      <!-- /.card-header -->
                                                      <div class="card-body table-responsive p-0" style="height: 300px;">
                                                          <table class="table table-head-fixed text-nowrap">
                                                              <thead class="text-center">
                                                                  <tr>
                                                                      <th>#</th>
                                                                      <th style="width:20%;">Item</th>
                                                                      <th style="width:20%;">Nama</th>
                                                                      <th style="width:20%;">Penempatan</th>
                                                                      <th style="width:50%; height: 60%;" class="text-center">Foto yang diupload
                                                                      </th>
                                                                      <th></th>
                                                                      <th style="width:20%;">Kondisi</th>
                                                                      <th style="width:20%;">Pesan</th>
                                                                      <th style="width:20%;">Status</th>
                                                                      <th>#</th>
                                                                  </tr>
                                                              </thead>
                                                              <tbody>
                                                                  <tr class="fire-jacket rusak-berat">
                                                                      <td class="text-center text-wrap my-auto align-middle">1</td>
                                                                      <td class="text-center text-wrap my-auto align-middle">Fire Jacket
                                                                      </td>
                                                                      <td class="text-center text-wrap my-auto align-middle">Agus Suripto</td>
                                                                      <td class="text-center text-wrap my-auto align-middle">Kantor Sektor I</td>
                                                                      <td>
                                                                          <div class=" d-none d-sm-block">
                                                                              <ul class="list-inline w-50">
                                                                                  <li class="list-inline-item w-75 ">
                                                                                      <a class="apd-foto" data-toggle="collapse"
                                                                                          data-target="#preview-foto-apd-anggota"
                                                                                          style="cursor: pointer;">
                                                                                          <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                              src="firejacket.jpg">
                                                                                      </a>
                                                                                  </li>
                                                                                  <li class="list-inline-item w-75">
                                                                                      <a class="apd-foto" data-toggle="collapse"
                                                                                          data-target="#preview-foto-apd-anggota"
                                                                                          style="cursor: pointer;">
                                                                                          <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                              src="firejacket.jpg">
                                                                                      </a>
                                                                                  </li>
                                                                                  <li class="list-inline-item w-75">
                                                                                      <a class="apd-foto" data-toggle="collapse"
                                                                                          data-target="#preview-foto-apd-anggota"
                                                                                          style="cursor: pointer;">
                                                                                          <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                              src="firejacket.jpg">
                                                                                      </a>
                                                                                  </li>
                                                                              </ul>
                                                                          </div>
                                                                          <div class="text-center align-middle d-block d-sm-none">
                          
                                                                              <button type="button" class="btn btn-primary btn-sm"
                                                                                  data-toggle="collapse"
                                                                                  data-target="#preview-semua-foto-apd-anggota">Lihat
                                                                                  Foto</button>
                                                                          </div>
                          
                                                                      </td>
                                                                      <td></td>
                                                                      <td class="text-center align-middle">Rusak Berat</td>
                                                                      <td class="text-center align-middle">
                                                                        <input type="text" placeholder="Pesan">
                                                                      </td>
                                                                      <td class="text-center align-middle">
                                                                        <div class="dropdown">
                                                                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Validasi<span class="caret"></span></button>
                                                                          <ul class="dropdown-menu">
                                                                            <li><a >Terivalidasi</a></li>
                                                                            <li><a >Tolak</a></li>
                                                                            <li><a >Update</a></li>
                                                                          </ul>
                                                                        </div>
                                                                      </td>
                                                                      <td class="text-center align-middle">
                                                                        <a class="btn btn-app">
                                                                          <i class="fas fa-save"></i> Save
                                                                        </a>
                                                                      </td>
                                                                  </tr>
                                                                  <tr  class="fire-troser baik">
                                                                    <td class="text-center text-wrap my-auto align-middle">2</td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Fire Troser
                                                                    </td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Reza</td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Kantor Sektor I</td>
                                                                    <td>
                                                                        <div class=" d-none d-sm-block">
                                                                            <ul class="list-inline w-50">
                                                                                <li class="list-inline-item w-75 ">
                                                                                    <a class="apd-foto" data-toggle="collapse"
                                                                                        data-target="#preview-foto-apd-anggota"
                                                                                        style="cursor: pointer;">
                                                                                        <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                            src="firejacket.jpg">
                                                                                    </a>
                                                                                </li>
                                                                                <li class="list-inline-item w-75">
                                                                                    <a class="apd-foto" data-toggle="collapse"
                                                                                        data-target="#preview-foto-apd-anggota"
                                                                                        style="cursor: pointer;">
                                                                                        <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                            src="firejacket.jpg">
                                                                                    </a>
                                                                                </li>
                                                                                <li class="list-inline-item w-75">
                                                                                    <a class="apd-foto" data-toggle="collapse"
                                                                                        data-target="#preview-foto-apd-anggota"
                                                                                        style="cursor: pointer;">
                                                                                        <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                            src="firejacket.jpg">
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="text-center align-middle d-block d-sm-none">
                        
                                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                                data-toggle="collapse"
                                                                                data-target="#preview-semua-foto-apd-anggota">Lihat
                                                                                Foto</button>
                                                                        </div>
                        
                                                                    </td>
                                                                    <td></td>
                                                                    <td class="text-center align-middle">Baik</td>
                                                                    <td class="text-center align-middle">
                                                                      <input type="text" placeholder="Pesan">
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                      <div class="dropdown">
                                                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Validasi<span class="caret"></span></button>
                                                                        <ul class="dropdown-menu">
                                                                          <li><a >Terivalidasi</a></li>
                                                                          <li><a >Tolak</a></li>
                                                                          <li><a >Update</a></li>
                                                                        </ul>
                                                                      </div>
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                      <a class="btn btn-app">
                                                                        <i class="fas fa-save"></i> Save
                                                                      </a>
                                                                    </td>
                                                                  </tr>
                                                                  <tr  class="fire-helmet rusak-ringan">
                                                                    <td class="text-center text-wrap my-auto align-middle">3</td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Fire Helmet
                                                                    </td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Indra Purwoko</td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Pos Gandaria City</td>
                                                                    <td>
                                                                      <div class=" d-none d-sm-block">
                                                                          <ul class="list-inline w-50">
                                                                              <li class="list-inline-item w-75 ">
                                                                                  <a class="apd-foto" data-toggle="collapse"
                                                                                      data-target="#preview-foto-apd-anggota"
                                                                                      style="cursor: pointer;">
                                                                                      <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                          src="firejacket.jpg">
                                                                                  </a>
                                                                              </li>
                                                                              <li class="list-inline-item w-75">
                                                                                  <a class="apd-foto" data-toggle="collapse"
                                                                                      data-target="#preview-foto-apd-anggota"
                                                                                      style="cursor: pointer;">
                                                                                      <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                          src="firejacket.jpg">
                                                                                  </a>
                                                                              </li>
                                                                              <li class="list-inline-item w-75">
                                                                                  <a class="apd-foto" data-toggle="collapse"
                                                                                      data-target="#preview-foto-apd-anggota"
                                                                                      style="cursor: pointer;">
                                                                                      <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                          src="firejacket.jpg">
                                                                                  </a>
                                                                              </li>
                                                                          </ul>
                                                                      </div>
                                                                      <div class="text-center align-middle d-block d-sm-none">
                      
                                                                          <button type="button" class="btn btn-primary btn-sm"
                                                                              data-toggle="collapse"
                                                                              data-target="#preview-semua-foto-apd-anggota">Lihat
                                                                              Foto</button>
                                                                      </div>
                      
                                                                  </td>
                                                                  <td></td>
                                                                  <td class="text-center align-middle">Rusak Ringan</td>
                                                                  <td class="text-center align-middle">
                                                                    <input type="text" placeholder="Pesan">
                                                                  </td>
                                                                  <td class="text-center align-middle">
                                                                    <div class="dropdown">
                                                                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Validasi<span class="caret"></span></button>
                                                                      <ul class="dropdown-menu">
                                                                        <li><a >Terivalidasi</a></li>
                                                                        <li><a >Tolak</a></li>
                                                                        <li><a >Update</a></li>
                                                                      </ul>
                                                                    </div>
                                                                  </td>
                                                                  <td class="text-center align-middle">
                                                                    <a class="btn btn-app">
                                                                      <i class="fas fa-save"></i> Save
                                                                    </a>
                                                                  </td>
                                                                  </tr>
                                                                  <tr  class="fire-helmet baik">
                                                                    <td class="text-center text-wrap my-auto align-middle">3</td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Fire Helmet
                                                                    </td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Reza Andhika</td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Pos Gandaria City</td>
                                                                    <td>
                                                                      <div class=" d-none d-sm-block">
                                                                          <ul class="list-inline w-50">
                                                                              <li class="list-inline-item w-75 ">
                                                                                  <a class="apd-foto" data-toggle="collapse"
                                                                                      data-target="#preview-foto-apd-anggota"
                                                                                      style="cursor: pointer;">
                                                                                      <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                          src="firejacket.jpg">
                                                                                  </a>
                                                                              </li>
                                                                              <li class="list-inline-item w-75">
                                                                                  <a class="apd-foto" data-toggle="collapse"
                                                                                      data-target="#preview-foto-apd-anggota"
                                                                                      style="cursor: pointer;">
                                                                                      <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                          src="firejacket.jpg">
                                                                                  </a>
                                                                              </li>
                                                                              <li class="list-inline-item w-75">
                                                                                  <a class="apd-foto" data-toggle="collapse"
                                                                                      data-target="#preview-foto-apd-anggota"
                                                                                      style="cursor: pointer;">
                                                                                      <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                          src="firejacket.jpg">
                                                                                  </a>
                                                                              </li>
                                                                          </ul>
                                                                      </div>
                                                                      <div class="text-center align-middle d-block d-sm-none">
                      
                                                                          <button type="button" class="btn btn-primary btn-sm"
                                                                              data-toggle="collapse"
                                                                              data-target="#preview-semua-foto-apd-anggota">Lihat
                                                                              Foto</button>
                                                                      </div>
                      
                                                                  </td>
                                                                  <td></td>
                                                                  <td class="text-center align-middle">Baik</td>
                                                                  <td class="text-center align-middle">
                                                                    <input type="text" placeholder="Pesan">
                                                                  </td>
                                                                  <td class="text-center align-middle">
                                                                    <div class="dropdown">
                                                                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Validasi<span class="caret"></span></button>
                                                                      <ul class="dropdown-menu">
                                                                        <li><a >Terivalidasi</a></li>
                                                                        <li><a >Tolak</a></li>
                                                                        <li><a >Update</a></li>
                                                                      </ul>
                                                                    </div>
                                                                  </td>
                                                                  <td class="text-center align-middle">
                                                                    <a class="btn btn-app">
                                                                      <i class="fas fa-save"></i> Save
                                                                    </a>
                                                                  </td>
                                                                  </tr>
                                                                  <tr  class="fire-helmet baik">
                                                                    <td class="text-center text-wrap my-auto align-middle">3</td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Fire Helmet
                                                                    </td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Hemdro Wibowo</td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Kantor Sektor</td>
                                                                    <td>
                                                                      <div class=" d-none d-sm-block">
                                                                          <ul class="list-inline w-50">
                                                                              <li class="list-inline-item w-75 ">
                                                                                  <a class="apd-foto" data-toggle="collapse"
                                                                                      data-target="#preview-foto-apd-anggota"
                                                                                      style="cursor: pointer;">
                                                                                      <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                          src="firejacket.jpg">
                                                                                  </a>
                                                                              </li>
                                                                              <li class="list-inline-item w-75">
                                                                                  <a class="apd-foto" data-toggle="collapse"
                                                                                      data-target="#preview-foto-apd-anggota"
                                                                                      style="cursor: pointer;">
                                                                                      <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                          src="firejacket.jpg">
                                                                                  </a>
                                                                              </li>
                                                                              <li class="list-inline-item w-75">
                                                                                  <a class="apd-foto" data-toggle="collapse"
                                                                                      data-target="#preview-foto-apd-anggota"
                                                                                      style="cursor: pointer;">
                                                                                      <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                          src="firejacket.jpg">
                                                                                  </a>
                                                                              </li>
                                                                          </ul>
                                                                      </div>
                                                                      <div class="text-center align-middle d-block d-sm-none">
                      
                                                                          <button type="button" class="btn btn-primary btn-sm"
                                                                              data-toggle="collapse"
                                                                              data-target="#preview-semua-foto-apd-anggota">Lihat
                                                                              Foto</button>
                                                                      </div>
                      
                                                                  </td>
                                                                  <td></td>
                                                                  <td class="text-center align-middle">Baik</td>
                                                                  <td class="text-center align-middle">
                                                                    <input type="text" placeholder="Pesan">
                                                                  </td>
                                                                  <td class="text-center align-middle">
                                                                    <div class="dropdown">
                                                                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Validasi<span class="caret"></span></button>
                                                                      <ul class="dropdown-menu">
                                                                        <li><a >Terivalidasi</a></li>
                                                                        <li><a >Tolak</a></li>
                                                                        <li><a >Update</a></li>
                                                                      </ul>
                                                                    </div>
                                                                  </td>
                                                                  <td class="text-center align-middle">
                                                                    <a class="btn btn-app">
                                                                      <i class="fas fa-save"></i> Save
                                                                    </a>
                                                                  </td>
                                                                  </tr>
                                                                  <tr  class="fire-troser baik">
                                                                    <td class="text-center text-wrap my-auto align-middle">2</td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Fire Troser
                                                                    </td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Taufik</td>
                                                                    <td class="text-center text-wrap my-auto align-middle">Kantor Sektor I</td>
                                                                    <td>
                                                                        <div class=" d-none d-sm-block">
                                                                            <ul class="list-inline w-50">
                                                                                <li class="list-inline-item w-75 ">
                                                                                    <a class="apd-foto" data-toggle="collapse"
                                                                                        data-target="#preview-foto-apd-anggota"
                                                                                        style="cursor: pointer;">
                                                                                        <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                            src="firejacket.jpg">
                                                                                    </a>
                                                                                </li>
                                                                                <li class="list-inline-item w-75">
                                                                                    <a class="apd-foto" data-toggle="collapse"
                                                                                        data-target="#preview-foto-apd-anggota"
                                                                                        style="cursor: pointer;">
                                                                                        <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                            src="firejacket.jpg">
                                                                                    </a>
                                                                                </li>
                                                                                <li class="list-inline-item w-75">
                                                                                    <a class="apd-foto" data-toggle="collapse"
                                                                                        data-target="#preview-foto-apd-anggota"
                                                                                        style="cursor: pointer;">
                                                                                        <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                            src="firejacket.jpg">
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="text-center align-middle d-block d-sm-none">
                        
                                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                                data-toggle="collapse"
                                                                                data-target="#preview-semua-foto-apd-anggota">Lihat
                                                                                Foto</button>
                                                                        </div>
                        
                                                                    </td>
                                                                    <td></td>
                                                                    <td class="text-center align-middle">Baik</td>
                                                                    <td class="text-center align-middle">
                                                                      <input type="text" placeholder="Pesan">
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                      <div class="dropdown">
                                                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Validasi<span class="caret"></span></button>
                                                                        <ul class="dropdown-menu">
                                                                          <li><a >Terivalidasi</a></li>
                                                                          <li><a >Tolak</a></li>
                                                                          <li><a >Update</a></li>
                                                                        </ul>
                                                                      </div>
                                                                    </td>
                                                                    <td class="text-center align-middle">
                                                                      <a class="btn btn-app">
                                                                        <i class="fas fa-save"></i> Save
                                                                      </a>
                                                                    </td>
                                                                  </tr>
                                                              </tbody>
                                                          </table>
                                                      </div>
                                                      <!-- /.card-body -->
                                                  </div>
                          
                                                  <!-- {{-- Card untuk preview saat user klik satu gambar start --}} -->
                                                  <div class="collapse" id="preview-foto-apd-anggota">
                                                      <div class="card">
                                                          <div class="card-header">
                                                              <div class="card-title">
                                                                  <h5>Preview Gambar APD</h5>
                                                              </div>
                                                              <div class="card-tools">
                                                                  <button type="button" class="close" data-toggle="collapse"
                                                                      data-target="#preview-foto-apd-anggota" aria-label="Close">
                                                                      <span aria-hidden="true">×</span>
                                                                  </button>
                                                              </div>
                                                          </div>
                                                          <div class="card-body">
                                                              isinya satu gambar yang diklik
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <!-- {{-- Cart untuk preview saat user klik satu gambar end --}} -->
                          
                                                  <!-- {{-- Card untuk preview saat viewport hp start --}} -->
                                                  <div class="collapse" id="preview-semua-foto-apd-anggota">
                                                      <div class="card">
                                                          <div class="card-header">
                                                              <div class="card-title">
                                                                  <h5>Nama APD</h5>
                                                              </div>
                                                              <div class="card-tools">
                                                                  <button type="button" class="close" data-toggle="collapse"
                                                                      data-target="#preview-semua-foto-apd-anggota" aria-label="Close">
                                                                      <span aria-hidden="true">×</span>
                                                                  </button>
                                                              </div>
                                                          </div>
                                                          <div class="card-body">
                                                              isinya semua gambar yang diupload
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <!-- {{-- Card untuk preview saat viewport hp end --}} -->
                          
                                                  <!-- /.card -->
                                              </div>
                                          </div>
                                      </div>
                                      <div class="modal-footer justify-content-between">
                                          
                                          <a class="btn btn-app">
                                            <i class="fas fa-save"></i> Save All
                                          </a>
                                      </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                              </div>
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
@extends('eapd.layouts.adminlte-dashboard',['title'=>'Kepegawaian Admin Sektor'])

@section('content')


@include('eapd.dashboard.komponen.breadcrumbs',[ 'halamanJudul'=>'Kepegawaian','halaman'=>'kepegawaian'])

<section class="content">
    <div class="container-fluid">
            <div class="row">



                <section class="d-flex justify-content-center col-lg-12 connectedSortable ui-sortable">

                  <div class="card">
                    <div class="card-header align-middle bg-info">
                      <h4>Data Pegawai <br class="d-block d-md-none">{{ auth()->user()->data->penempatan->nama_penempatan }}</h4>
                    </div>
                    <div class="card-body px-3 py-3">

                      <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="info-kepegawaian-1">
                        <div class="card-body">
                          <div class="card-tools">
                              <button type="button" class="close" data-toggle="collapse"
                                  data-target="#info-kepegawaian-1" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                          </div>
                          <div>
                            Dibawah ini merupakan daftar pegawai yang ada di <strong>{{auth()->user()->data->penempatan->nama_penempatan}}</strong>. <br>
                            Gunakan tabel dibawah untuk melakukan perubahan penempatan pos, grup jaga, status aktif pegawai, dan lain sebagainya. <br>
                            Perlu diingat lingkup data yang diubah merupakan lingkup kepegawaian tingkat sektor. <br>
                            Jika ada perubahan yang melebihi kendali data tingkat sektor, harap koordinasi dengan admin sudin. <br>
                            <ul class="mt-2">
                              <li>
                                Gunakan "Cari" untuk mencari data. Pencarian akan langsung dilakukan tanpa klik Enter.
                              </li>
                              <li>
                                Gunakan "Filter" untuk menyaring data.
                              </li>
                              <li>
                                Gunakan "Kolom" untuk menyembunyikan dan menampilkan kolom.
                              </li>
                              <li>
                                Jika anda menggunakan hp, klik tombol (+) untuk menampilkan data tambahan.
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>

                      @livewire('eapd.datatable.tabel-kepegawaian-admin-sektor')
                    </div>
                  </div>


                </section>

                {{-- modals --}}
                <div class="modal fade" id="modal-kepegawaian">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Data Pegawai</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="col-12">
                          <div class="card card-primary card-outline card-tabs">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                              <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Ubah Penempatan</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Ubah Password</a>
                                </li>
                                
                              </ul>
                            </div>
                            <div class="card-body">
                              <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                  <div class="card card-default">
                                    <div class="card-header">
                                      <h3 class="card-title">Agus Suripto</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label>Pilih Pos</label>
                                            <select class="form-control select2bs4" style="width: 100%;">
                                              <option selected="selected">Kantor Sektor Kebayoran Lama</option>
                                              <option>Gandaria City</option>
                                              <option>Grogol Utara</option>
                                              <option>Cipulir</option>
                                              <option>Tanah Kusir</option>
                                            </select>
                                          </div>
                                          <div class="form-group">
                                            <label>Pilih Grub</label>
                                            <select class="form-control select2bs4" style="width: 100%;">
                                              <option selected="selected">A</option>
                                              <option>B</option>
                                              <option>C</option>
                                            </select>
                                          </div>
                                          <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                      </div>
                                      <!-- /.row -->
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                  <div class="card card-default">
                                    <div class="card-header">
                                      <h3 class="card-title">Agus Suripto</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label>Password Baru</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukan Password">
                                          </div>
                                          <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                      </div>
                                      <!-- /.row -->
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                                </div>
                                
                              </div>
                            </div>
                            <!-- /.card -->
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                {{-- modals end --}}

            </div>
    </div>
</section>
@endsection

@once
    @push('stack-head')
        @livewireStyles
    @endpush
    @push('stack-body')
        @livewireScripts
        @include('helper.script-modal')
    @endpush
    

@endonce

<div>
    <section class="d-flex justify-content-center row connectedSortable ui-sortable">
        {{-- start card-list-periode --}}
        <div class="card card-info" id="card-list-periode">
            <div class="card-header">
                <h4>Pengaturan Periode dan Template Inputan</h4>
            </div>
            <div class="card-body px-3 py-3">
                {{-- start collapse-list-periode-info --}}
                    <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="collapse-list-periode-info">
                        <div class="card-body">
                          <div class="card-tools">
                              <button type="button" class="close" data-toggle="collapse"
                                  data-target="#collapse-list-periode-info" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                          </div>
                            <div>
                                Dibawah ini merupakan kendali untuk mengatur periode input.<br>
                                Pada kendali ini, dapat diatur : <br>
                                <ul class="mt-2">
                                  <li>
                                    Tanggal awal dan akhir periode input 
                                  </li>
                                  <li>
                                    Pesan Berjalan pada Dashboard
                                  </li>
                                  <li>
                                    Template inputan / Apa saja yang akan di input oleh tiap-tiap tipe pegawai pada periode tersebut
                                  </li>
                                </ul>
                                Periode inputan akan berjalan secara otomatis ketika sudah masuk tanggal awal jika periode di aktifkan.<br>
                            </div>
                        </div>
                      </div>
                {{-- end collapse-list-periode-info --}}

                {{-- start collapse-list-periode-loading --}}
                    <div wire:loading>
                            <div class="spinner-border spinner-border-sm" role="status"></div>
                            <small> Memuat data . . .</small>
                    </div>
                {{-- end collapse-list-periode-loading --}}

                {{-- start tabel-list-periode --}}
                {{-- end tabel-list-periode --}}
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Buat Periode Baru</button>
            </div>
        </div>
        {{-- end card-list-periode --}}
        
        {{-- start card-detail-periode --}}
        <div class="col-sm-12 collapse fade show active" id="collapse-card-detail-periode">
            <div class="card " id="card-detail-periode">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="close" data-toggle="collapse"
                            data-target="#collapse-card-detail-periode" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    {{-- start collapse-card-form-periode --}}
                    <div class="collapse fade show active" id="collapse-card-form-periode">
                        <div class="card col-sm-12" id="card-form-periode">
                            <div class="card-header">
                                <h5>Detail Periode</h5>
                            </div>
                            <div class="card-body">
                                {{-- Nama Periode --}}
                                <div class="form-group">
                                    <label for="input-nama-periode">Nama Periode</label>
                                    <input type="text" class="form-control" id="input-nama-periode">
                                </div>
                                {{-- Tanggal Awal --}}
                                <div class="form-group">
                                    <label for="input-tanggal-awal">Tanggal Awal</label>
                                    <div class="input-group date" id="input-group-tanggal-awal" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#input-group-tanggal-awal">
                                        <div class="input-group-append" data-target="#input-group-tanggal-awal" data-toggle="datetimepicker">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Tanggal akhir --}}
                                <div class="form-group">
                                        <label>Tanggal Akhir :</label>
                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- Pesan Berjalan --}}
                                <div class="form-group">
                                    <label for="input-pesan-berjalan">Pesan Berjalan</label>
                                    <textarea type="textarea" class="form-control" id="input-pesan-berjalan"></textarea>
                                </div>
                                {{-- switch Aktif --}}
                                <div class="form-group">
                                    <label>Aktif ? </label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="switch-periode-aktif">
                                        <label class="custom-control-label" for="switch-periode-aktif"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-info">Atur Template Inputan APD</button>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn btn-primary">Simpan</button>
                                        <button class="btn btn-secondary">Reset</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    {{-- end collapse-card-form-periode --}}

                    {{-- start collapse-card-tabel-inputan-apd --}}
                        <div class="collapse fade show active" id="collapse-card-tabel-inputan-apd">
                            <div class="card" id="card-tabel-inputan-apd">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h5>Atur Template Inputan APD</h5>
                                    </div>
                                    <div class="card-tools text-right">
                                        <a>&larr; <u>kembali</u></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{-- start collapse-card-tabel-inputan-apd-info --}}
                                    <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="collapse-card-tabel-inputan-apd-info">
                                        <div class="card-body">
                                            <div class="card-tools">
                                                <button type="button" class="close" data-toggle="collapse"
                                                    data-target="#collapse-card-tabel-inputan-apd-info" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div>
                                                Dibawah ini merupakan kendali untuk mengatur Template Inputan APD per Jabatan.<br>
                                                Kendali ini mengatur tipe apd apa saja yang perlu diinput oleh pegawai pada periode yang telah dipilih  <br>
                                                Berikut APD apa saja yang perlu diinput <br>
                                                Klik tombol "Tambah Banyak" untuk penambahan secara seragam
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end collapse-card-tabel-inputan-apd-info --}}

                                    {{-- start tabel-template --}}
                                    {{-- end tabel-template --}}
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col text-left">
                                            <button class="btn btn-info">Tambah Banyak</button>
                                            <button class="btn btn-info">Tambah Satu</button>
                                        </div>
                                        <div class="col text-right">
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- end collapse-card-tabel-inputan-apd --}}

                    {{-- start collapse-card-single-template-inputan-apd --}}
                    <div class="collapse fade show active" id="collapse-card-single-template-inputan-apd">
                        <div class="card" id="card-single-template-inputan-apd">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5>Tambah/Edit Template Inputan APD</h5>
                                </div>
                                <div class="card-tools text-right">
                                    <a>&larr; <u>kembali</u></a>
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- Jabatan --}}
                                <div class="form-group form-inline row">
                                    <label for="input-single-template-jabatan" class="col-sm-2 col-form-label col-form-label-lg">Jabatan</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="input-single-template-jabatan" disabled>
                                    </div>
                                    <button class="btn btn-outline-info"><u>Ubah</u></button>
                                </div>
                                {{-- Jenis APD --}}
                                <div class="form-group form-inline row">
                                    <label for="input-single-template-jenis-apd" class="col-sm-2 col-form-label col-form-label-lg">Jenis APD</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="input-single-template-jenis-apd" disabled>
                                    </div>
                                    <button class="btn btn-outline-info"><u>Ubah</u></button>
                                </div>
                                {{-- APD --}}
                                <div class="form-group form-inline row">
                                    <label for="input-single-template-apd" class="col-sm-2 col-form-label col-form-label-lg">APD</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="input-single-template-apd" disabled>
                                    </div>
                                    <button class="btn btn-outline-info"><u>Ubah</u></button>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                    {{-- end collapse-card-single-template-inputan-apd --}}

                    {{-- start collapse-card-multi-template-inputan-apd --}}
                    <div class="collapse fade show active" id="collapse-card-multi-template-inputan-apd">
                        <div class="card" id="collapse-card-multi-template-inputan-apd">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5>Tambah Template Inputan APD</h5>
                                </div>
                                <div class="card-tools text-right">
                                    <a>&larr; <u>kembali</u></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6><i>Klik pada item untuk menghapus</i></h6>
                                <div class="card-group">
                                    {{-- card untuk jabatan --}}
                                    <div class="card">
                                        <div class="card-header">
                                            Jabatan
                                        </div>
                                        <div class="card-body">
                                            <div class="jumbotron text-center">
                                                klik <u>+tambah</u> untuk menambahkan data.
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a style="cursor:pointer;"><u>+tambah</u></a>
                                        </div>
                                    </div>
                                    {{-- card untuk jenis apd --}}
                                    <div class="card">
                                        <div class="card-header">
                                            Jenis APD
                                        </div>
                                        <div class="card-body">
                                            <div class="jumbotron text-center">
                                                klik <u>+tambah</u> untuk menambahkan data.
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a style="cursor:pointer;"><u>+tambah</u></a>
                                        </div>
                                    </div>
                                    {{-- card untuk Apd --}}
                                    <div class="card">
                                        <div class="card-header">
                                            APD
                                        </div>
                                        <div class="card-body">
                                            <div class="jumbotron text-center">
                                                klik <u>+tambah</u> untuk menambahkan data.
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a style="cursor:pointer;"><u>+tambah</u></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                    {{-- end collapse-card-multi-template-inputan-apd --}}
                </div>
            </div>
        </div>
        {{-- end card-detail-periode --}}

    </section>

    @push('stack-body')
        <script src=""></script>
    @endpush

</div>

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
                @livewire('eapd.datatable.tabel-list-periode')
                {{-- end tabel-list-periode --}}
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" wire:click='CardListPeriodeBuatPeriodeBaru'>Buat Periode Baru</button>
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
                                @if ($card_form_periode_formEditMode)
                                    <h5>Detil Periode (ID Periode : {{$card_form_periode_formIdPeriode}})</h5>
                                @else
                                    <h5>Buat Periode Baru</h5>
                                @endif
                            </div>
                            <div class="card-body">

                                {{-- start collapse-list-periode-loading --}}
                                    <div wire:loading>
                                            <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                                            <small> Memproses . . .</small>
                                    </div>
                                {{-- end collapse-list-periode-loading --}}

                                {{-- Nama Periode --}}
                                <div class="form-group">
                                    <label for="input-nama-periode">Nama Periode</label>
                                    <input type="text" class="form-control" id="input-nama-periode" wire:model="card_form_periode_formNamaPeriode">
                                </div>
                                {{-- Tanggal Awal --}}
                                <div class="form-group">
                                    <label for="input-tanggal-awal">Tanggal Awal</label>
                                    <div class="input-group date" id="input-group-tanggal-awal" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#input-group-tanggal-awal" wire:model="card_form_periode_formTglAwal">
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
                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" wire:model="card_form_periode_formTglAkhir">
                                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- Pesan Berjalan --}}
                                <div class="form-group">
                                    <label for="input-pesan-berjalan">Pesan Berjalan</label>
                                    <textarea type="textarea" class="form-control" id="input-pesan-berjalan" wire:model="card_form_periode_formPesanBerjalan"></textarea>
                                </div>
                                {{-- switch Aktif --}}
                                <div class="form-group">
                                    <label>Aktif ? </label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="switch-periode-aktif" wire:model="card_form_periode_formAktif">
                                        <label class="custom-control-label" for="switch-periode-aktif"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-info" wire:click='CardFormPeriodeAturTemplateInputanApd'>Atur Template Inputan APD</button>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn btn-primary" wire:click='CardFormPeriodeSimpan'>Simpan</button>
                                        <button class="btn btn-secondary" wire:click='CardFormPeriodeReset'>Reset</button>
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
                                                berikut APD apa saja yang perlu diinput. <br>
                                                <ul>
                                                    <li>Jabatan melambangkan bahwa template ini efektif untuk pegawai dengan jabatan tersebut.</li>
                                                    <li>Jenis APD melambangkan kategori apd apa saja yang harus diinput oleh pegawai.</li>
                                                    <li>Opsi APD melambangkan apd apa saja yang menjadi pilihan saat melakukan inputan.</li>
                                                </ul>
                                                
                                                Klik tombol "Tambah Banyak" untuk penambahan secara seragam.<br>
                                                Template yang baru ditambahkan akan muncul di urut paling akhir sebelum di simpan.
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end collapse-card-tabel-inputan-apd-info --}}

                                    {{-- start collapse-list-periode-loading --}}
                                    <div wire:loading>
                                            <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                                            <small> Memproses . . .</small>
                                    </div>
                                    {{-- end collapse-list-periode-loading --}}

                                    {{-- start tabel-template --}}
                                    <div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="input-group input-group-sm" style="width: 250px;">
                                                    <input type="text" class="form-control" id="table-template-tools-cari" placeholder="Cari" wire:model="tabel_template_toolsCari">
                                                    <div class="input-group-append">
                                                        <select class="form-control-sm" id="tabel-template-tools-cari-column" wire:model="tabel_template_toolsCari_column">
                                                            @foreach ($tabel_template_toolsCari_column_option as $item)
                                                                <option value="{{$item['value']}}">{{$item['text']}}</option>
                                                            @endforeach
                                                        </select>
                                                        <button class="btn btn-secondary" wire:click="TabelTemplateCari"><i class="fa fa-search"></i></button>
                                                        @if ($tabel_template_toolsCari_init)
                                                            <small><a class="ml-1" href="#table-template-tools-cari" wire:click="TabelTemplateCariReset">reset</a></small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="input-group input-group-sm float-sm-right" style="width: 160px;">
                                                    <div class="input-group-prepend mr-1">
                                                        Tampilkan
                                                    </div>
                                                    <select class="form-control" id="tabel-template-tools-perPage" wire:model="tabel_template_toolsPerPage" wire:change='TabelTemplatePerPageChange()'>
                                                        @foreach ($tabel_template_toolsPerPage_option as $item)
                                                            @if ($item == 0)
                                                                <option value="0">Semua</option>
                                                            @else
                                                                <option>{{$item}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row table-responsive">
                                            <table class="table table-bordered table-hover text-nowrap" id="tabel-template">
                                                <thead class="text-center table-bordered">
                                                    <tr class="table-head-fixed">
                                                        <th wire:click="TabelTemplateSortirKolom('index')">No @if($tabel_template_toolsSort_column == "index") <i class="fa fa-chevron-circle-{{($tabel_template_toolsSort_order == "asc")? "up" : "down"}}"></i> @endif </th>
                                                        <th wire:click="TabelTemplateSortirKolom('jabatan')">[ID Jabatan] Jabatan @if($tabel_template_toolsSort_column == "jabatan") <i class="fa fa-chevron-circle-{{($tabel_template_toolsSort_order == "asc")? "up" : "down"}}"></i> @endif </th>
                                                        <th wire:click="TabelTemplateSortirKolom('jenis_apd')">[ID Jenis] Jenis APD Yang Harus Diinput @if($tabel_template_toolsSort_column == "jenis_apd") <i class="fa fa-chevron-circle-{{($tabel_template_toolsSort_order == "asc")? "up" : "down"}}"></i> @endif </th>
                                                        <th wire:click="TabelTemplateSortirKolom('opsi_apd')">[ID APD] Opsi APD @if($tabel_template_toolsSort_column == "opsi_apd") <i class="fa fa-chevron-circle-{{($tabel_template_toolsSort_order == "asc")? "up" : "down"}}"></i> @endif </th>
                                                        <th>Tindakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (is_array($tabel_template_data))
                                                        @forelse ($tabel_template_data as $index => $item)
                                                            <tr>
                                                                <td>{{/*$index + 1*/$item["index"]}}</td>
                                                                <td>{{$item["jabatan"]}}</td>
                                                                <td>{{$item["jenis_apd"]}}</td>
                                                                <td>{{$item["opsi_apd"]}}</td>
                                                                <td>
                                                                    <div class='btn-group' role='group' aria-label='tindakan'>
                                                                        <button type='button' id='tabel-template-edit' class='btn btn-info mx-1' wire:click="TabelTemplateEdit({{$item['index']}})">Edit</button>
                                                                        <button type='button' id='tabel-template-hapus' class='btn btn-danger mx-1' wire:click="TabelTemplateHapus({{$item['index']}})">Hapus</button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5" class="jumbotron text-center">
                                                                    Tidak ada yang dapat ditampilkan.
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    @else
                                                        <tr>
                                                            <td colspan="5" class="jumbotron text-center">
                                                                Tidak ditemukan data untuk {{$tabel_template_toolsCari}}.
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row text-muted">
                                            @if (is_array($tabel_template_data))
                                                <span class="font-italic">Menampilkan <strong>{{count($tabel_template_data)}}</strong> dari <strong>{{count($tabel_template_data_cache)}}</strong> hasil</span>
                                            @endif
                                        </div>
                                        <div class="row justify-content-center">
                                            @if ($tabel_template_pageTotal > 1)
                                                <nav aria-label="Tabel Template Navigasi">
                                                    <ul class="pagination">
                                                        <li class="page-item"><a class="page-link" href="#table-template" wire:click="TabelTemplatePageNavigate({{($tabel_template_pageCurrent > 0)? $tabel_template_pageCurrent - 1:1}})" >Previous</a></li>
                                                        <li class="page-item"><a class="page-link" href="#table-template" wire:click="TabelTemplatePageNavigate('min')" ><i class="fa fa-angle-double-left"></i></a></li>
                                                        @for ($i = 0; $i < $tabel_template_pageTotal; $i++)
                                                            <li class="page-item {{($tabel_template_pageCurrent == $i+1)? "active" : ""}}"><a class="page-link" href="#table-template" wire:click="TabelTemplatePageNavigate({{$i+1}})" >{{$i+1}}</a></li>
                                                        @endfor
                                                        
                                                        <li class="page-item"><a class="page-link" href="#table-template" wire:click="TabelTemplatePageNavigate('max')" ><i class="fa fa-angle-double-right"></i></a></li>
                                                        <li class="page-item"><a class="page-link" href="#table-template" wire:click="TabelTemplatePageNavigate({{($tabel_template_pageCurrent < $tabel_template_pageTotal)? $tabel_template_pageCurrent + 1:$tabel_template_pageTotal}})" >Next</a></li>
                                                    </ul>
                                                </nav>
                                            @endif
                                            
                                        </div>
                                    </div>
                                    
                                    {{-- end tabel-template --}}
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col text-left">
                                            <button class="btn btn-info">Tambah Banyak</button>
                                            <button class="btn btn-info">Tambah Satu</button>
                                        </div>
                                        <div class="col text-right">
                                            <button class="btn btn-primary" wire:click="CardTabelInputanApdSimpan">Simpan</button>
                                            <button class="btn btn-danger" wire:click="CardTabelInputanApdKosongkan">Kosongkan</button>
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
                                    @if ($card_single_template_inputan_apd_formEditMode)
                                        <h5>Edit Template Inputan APD</h5>
                                    @else
                                        <h5>Tambah Template Inputan APD</h5>
                                    @endif
                                </div>
                                <div class="card-tools text-right">
                                    <a>&larr; <u>kembali</u></a>
                                </div>
                            </div>
                            <div class="card-body">

                                {{-- start collapse-list-periode-loading --}}
                                    <div wire:loading>
                                            <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                                            <small> Memproses . . .</small>
                                    </div>
                                {{-- end collapse-list-periode-loading --}}

                                {{-- Jabatan --}}
                                <div class="form-group form-inline row">
                                    <label for="input-single-template-jabatan" class="col-sm-2 col-form-label col-form-label-lg">Jabatan</label>
                                    <div class="col-sm-4 input-group">
                                        <input type="text" class="form-control" id="input-single-template-jabatan" value="{{$card_single_template_inputan_apd_formJabatan}}" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-info" data-toggle="modal" wire:click="$set('modal_ubah_single_inputan_apd_mode','jabatan')" data-target="#modal-ubah-single-template-inputan-apd"><u>Ubah</u></button>
                                        </div>
                                    </div>
                                </div>
                                {{-- Jenis APD --}}
                                <div class="form-group form-inline row">
                                    <label for="input-single-template-jenis-apd" class="col-sm-2 col-form-label col-form-label-lg">Jenis APD</label>
                                    <div class="col-sm-4 input-group">
                                        <input type="text" class="form-control" id="input-single-template-jenis-apd" value="{{$card_single_template_inputan_apd_formJenisApd}}" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-info" data-toggle="modal" wire:click="$emit('InisiasiTabelAtributTemplateSingle','jenis_apd')" data-target="#modal-ubah-single-template-inputan-apd"><u>Ubah</u></button>
                                        </div>
                                    </div>
                                </div>
                                {{-- APD --}}
                                <div class="form-group form-inline row">
                                    <label for="input-single-template-apd" class="col-sm-2 col-form-label col-form-label-lg">APD</label>
                                    <div class="col-sm-4 input-group">
                                        <input type="text" class="form-control" id="input-single-template-apd" value="{{$card_single_template_inputan_apd_formApd}}" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-info" data-toggle="modal" wire:click="$emit('InisiasiTabelAtributTemplateSingle','opsi_apd')" data-target="#modal-ubah-single-template-inputan-apd"><u>Ubah</u></button>
                                        </div>
                                    </div>
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

                                {{-- start collapse-list-periode-loading --}}
                                <div wire:loading>
                                        <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                                        <small> Memproses . . .</small>
                                </div>
                                {{-- end collapse-list-periode-loading --}}

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

        {{-- start modal ubah single template inputan apd --}}
        <div class="modal fade" id="modal-ubah-single-template-inputan-apd" tabindex="-1" role="document" wire:ignore.self>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Tambah
                        </h5>
                        <button type="button" class="close" data-toggle="modal"
                            data-target="#modal-ubah-single-template-inputan-apd" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- start collapse-list-periode-loading --}}
                        <div wire:loading>
                            <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                            <small> Memproses . . .</small>
                        </div>
                        {{-- end collapse-list-periode-loading --}}

                        {{-- start bagian untuk tabel --}}
                        @if ($modal_ubah_single_inputan_apd_mode == "jabatan")
                            @livewire("eapd.datatable.tabel-jabatan-template-single")
                            
                        @elseif($modal_ubah_single_inputan_apd_mode == "jenis_apd")

                        @elseif($modal_ubah_single_inputan_apd_mode == "opsi_apd")

                        @else
                            <div class="jumbotron text-center">
                                Memuat data . . .
                            </div>
                        @endif
                        {{-- end bagian untuk tabel --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal ubah single template inputan apd --}}

    </section>

    @push('stack-body')
        {{-- untuk date picker --}}
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />
    @endpush

</div>

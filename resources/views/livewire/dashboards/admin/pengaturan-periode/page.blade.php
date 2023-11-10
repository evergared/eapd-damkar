<div>
    <section class="d-flex justify-content-center row connectedSortable ui-sortable">
        {{-- start card-list-periode --}}
        <div class="card card-info" id="tabel-periode">
            <div class="card-header">
                <h4>Pengaturan Periode dan Template Inputan</h4>
            </div>
            <div class="card-body px-3 py-3">
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

                @if (session()->has('card_list_periode_success'))
                    <div class="alert alert-success alert-dismissable fade show" role="alert">
                        {{session('card_list_periode_success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session()->has('card_list_periode_danger'))
                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                        {{session('card_list_periode_danger')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                    <div wire:loading>
                            <div class="spinner-border spinner-border-sm" role="status"></div>
                            <small> Memuat data . . .</small>
                    </div>
                @livewire('dashboards.admin.pengaturan-periode.tabel-list-periode')
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" wire:click='$emit("buatPeriodeBaru")'>Buat Periode Baru</button>
            </div>
        </div>
        
        <div class="col-sm-12 collapse fade" id="form-periode" wire:ignore.self>
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="close" data-toggle="collapse"
                            data-target="#form-periode" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('dashboards.admin.pengaturan-periode.form-periode')
                </div>
            </div>
        </div>

        <div class="col-sm-12 collapse fade" id="tabel-template" wire:ignore.self>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Atur Template Inputan APD</h5>
                    </div>
                    <div class="card-tools text-right" style="cursor:pointer;" onclick="kembaliKeFormPeriode()">
                        <a>&larr; <u>kembali</u></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="tabel-template-info">
                        <div class="card-body">
                            <div class="card-tools">
                                <button type="button" class="close" data-toggle="collapse"
                                    data-target="#tabel-template-info" aria-label="Close">
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

                    <div wire:loading>
                            <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                            <small> Memproses . . .</small>
                    </div>

                    @if (session()->has('tabel_inputan_apd_success'))
                        <div class="alert alert-success alert-dismissable fade show" role="alert">
                            {{session('tabel_inputan_apd_success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session()->has('tabel_inputan_apd_danger'))
                        <div class="alert alert-danger alert-dismissable fade show" role="alert">
                            {{session('tabel_inputan_apd_danger')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @livewire('dashboards.admin.pengaturan-periode.tabel-list-periode');
                    
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-left">
                            <button class="btn btn-info" wire:click="tambahBanyak">Tambah Banyak</button>
                            <button class="btn btn-info" wire:click="tambahSatu">Tambah Satu</button>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-primary" wire:click="SimpanTemplate">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 collapse fade" id="form-buat-satu-template" wire:ignore.self>
            @livewire('dashboards.admin.pengaturan-periode.form-buat-satu-template')
        </div>

        <div class="col-sm-12 collapse fade" id="form-buat-banyak-template" wire:ignore.self>
            @livewire('dashboards.admin.pengaturan-periode.form-buat-banyak-template')
        </div>

        {{-- start modal ubah single template inputan apd --}}
            @livewire('dashboards.admin.pengaturan-periode.modal-ubah-satu-template')
        {{-- end modal ubah single template inputan apd --}}

        {{-- start modal ubah multi template inputan apd --}}
            @livewire('dashboards.admin.pengaturan-periode.modal-ubah-banyak-template')
        {{-- end modal ubah multi template inputan apd --}}

    </section>

{{-- start Tempat untuk javascript --}}
    @push('stack-body')
        {{-- untuk date picker --}}
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />

        <script>
            function keTabelInputanApd()
            {
                $("#form-periode").hide(500);  
                $("#tabel-template").collapse("show");
            }

            function keSingleTemplate()
            {
                $("#tabel-template").hide(500)
                $("#collapse-card-single-template-inputan-apd").collapse("show")
            }

            function keMultiTemplate()
            {
                $("#tabel-template").hide(500)
                $("#collapse-card-multi-template-inputan-apd").collapse("show")
            }

            function kembaliKeFormPeriode()
            {
                $("#form-periode").show(500);
                $("#tabel-template").collapse("hide");
            }

            function kembaliKeTabelInputanApdDariSingle()
            {
                $("#tabel-template").show(500)
                $("#collapse-card-single-template-inputan-apd").collapse("hide")
            }

            function kembaliKeTabelInputanApdDariMulti()
            {
                $("#tabel-template").show(500)
                $("#collapse-card-multi-template-inputan-apd").collapse("hide")
            }


            window.addEventListener("card_detail_periode_tampil", event=> {
                $("#kendali-periode").collapse('show')
            })

            window.addEventListener("card_tabel_inputan_tampil", event=> {
                keTabelInputanApd()
            })

            window.addEventListener("card_single_template_inputan_apd_tampil", event=> {
                keSingleTemplate()
            })

            window.addEventListener("card_multi_template_inputan_apd_tampil", event=> {
                keMultiTemplate()
            })
        </script>
    @endpush
{{-- end Tempat untuk javascript --}}

</div>

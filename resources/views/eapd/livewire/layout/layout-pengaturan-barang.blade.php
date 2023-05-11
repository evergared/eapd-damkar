<div>
    <section class="d-flex justify-content-center row connectedSortable ui-sortable">

        {{-- Start card-kendali-utama --}}
        <div class="card col-lg-12" id="card-kendali-utama">
            <div class="card-header p-2">
                {{-- navigasi kendali utama --}}
                <ul class="nav nav-pills" id="card-kendali-utama-tablist" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pengaturan-jenis-tab" data-toggle="tab" data-target="#pengaturan-jenis-tabpanel" type="button" role="tab" aria-controls="pengaturan-jenis-tabpanel" aria-selected="true">Jenis APD</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pengaturan-barang-tab" data-toggle="tab" data-target="#pengaturan-barang-tabpanel" type="button" role="tab" aria-controls="pengaturan-barang-tabpanel" aria-selected="false">Barang APD</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pengaturan-ukuran-tab" data-toggle="tab" data-target="#pengaturan-ukuran-tabpanel" type="button" role="tab" aria-controls="pengaturan-ukuran-tabpanel" aria-selected="false">Opsi Ukuran</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pengaturan-kerusakan-tab" data-toggle="tab" data-target="#pengaturan-kerusakan-tabpanel" type="button" role="tab" aria-controls="pengaturan-kerusakan-tabpanel" aria-selected="false">Opsi Kerusakan</a>
                    </li>                     
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="card-kendali-utama-tablistContent">
                    {{-- start pengaturan jenis --}}
                    <div class="tab-pane fade show active" id="pengaturan-jenis-tabpanel" role="tabpanel" aria-labelledby="#pengaturan-jenis-tab">
                        <div class="card card-info mx-n3 my-n3">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan Jenis APD</h3>
                            </div>
                            <div class="card-body">
                                {{-- start info pengaturan jenis --}}
                                <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="info-pengaturan-jenis">
                                    <div class="card-body">
                                        <div class="card-tools">
                                            <button type="button" class="close" data-toggle="collapse"
                                                data-target="#info-pengaturan-jenis" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div>
                                        Dibawah ini merupakan kendali untuk mengatur jenis APD.<br>
                                        Gunakan kendali ini untuk menambah, mengedit, dan menghapus Jenis APD<br>
                                        Untuk menambah, mengubah, atau menghapus barang APD, silahkan pilih navigasi "Barang APD". <br>
                                        </div>
                                    </div>
                                </div>
                                {{-- end info pengaturan jenis --}}

                                {{-- start tabel pengaturan jenis --}}
                                @livewire('eapd.datatable.tabel-pengaturan-jenis-apd')
                                {{-- end tabel pengaturan jenis --}}
                            </div>
                            <div class="card-footer">
                                <button type="button" data-toggle="collapse" data-target="#collapse-card-detail-jenis" class="btn bg-gradient-primary float-right">Tambah Jenis APD</button>
                            </div>
                        </div>
                    </div>
                    {{-- end pengaturan jenis --}}

                    {{-- start pengaturan barang --}}
                    <div class="tab-pane fade" id="pengaturan-barang-tabpanel" role="tabpanel" aria-labelledby="#pengaturan-barang-tab">
                        <div class="card card-info mx-n3 my-n3">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan APD</h3>
                            </div>
                            <div class="card-body">
                                {{-- start info pengaturan barang --}}
                                <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="info-pengaturan-barang">
                                    <div class="card-body">
                                        <div class="card-tools">
                                            <button type="button" class="close" data-toggle="collapse"
                                                data-target="#info-pengaturan-barang" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div>
                                        Dibawah ini merupakan kendali untuk mengatur APD.<br>
                                        Gunakan kendali ini untuk menambah, mengedit, dan menghapus barang APD<br>
                                        Perlu diingat, kendali ini hanya mengatur Barang APD yang bersifat non-suplai. <br>
                                        {{-- Untuk Barang yang bersifat suplai, silahkan lanjut ke Pengaturan Barang Suplai APD.<br> --}}
                                        </div>
                                    </div>
                                </div>
                                {{-- end info pengaturan barang --}}

                                {{-- start tabel pengaturan barang --}}
                                @livewire('eapd.datatable.tabel-pengaturan-apd')
                                {{-- end tabel pengaturan barang --}}
                            </div>
                            <div class="card-footer">
                                <button type="button" aria-controls="card-detail-barang" class="btn bg-gradient-primary float-right">Tambah APD Baru</button>
                            </div>
                        </div>
                    </div>
                    {{-- end pengaturan barang --}}

                    {{-- start pengaturan ukuran --}}
                    <div class="tab-pane fade" id="pengaturan-ukuran-tabpanel" role="tabpanel" aria-labelledby="#pengaturan-ukuran-tab">
                        <div class="card card-info mx-n3 my-n3">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan Opsi Ukuran APD</h3>
                            </div>
                            <div class="card-body">
                                {{-- start info pengaturan ukuran --}}
                                <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="info-pengaturan-ukuran">
                                    <div class="card-body">
                                        <div class="card-tools">
                                            <button type="button" class="close" data-toggle="collapse"
                                                data-target="#info-pengaturan-ukuran" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div>
                                        Dibawah ini merupakan kendali untuk mengatur Opsi Ukuran APD.<br>
                                        Opsi ini akan muncul ketika user/pegawai melakukan input apd.<br>
                                        Value dari opsi yang dipilih oleh user/pegawai akan masuk ke database,<br>
                                        Jadi pastikan bahwa opsi ukuran yang dibuat sesuai dengan apd.<br>
                                        Opsi yang dibuat dapat dikaitkan dengan banyak apd.<br>
                                        Klik "Detail" untuk mengedit.
                                        </div>
                                    </div>
                                </div>
                                {{-- end info pengaturan ukuran --}}

                                {{-- start tabel pengaturan ukuran --}}
                                @livewire('eapd.datatable.tabel-pengaturan-ukuran-apd')
                                {{-- end tabel pengaturan ukuran --}}
                            </div>
                            <div class="card-footer">
                                <button type="button" aria-controls="card-detail-ukuran" class="btn bg-gradient-primary float-right">Tambah Opsi Ukuran APD</button>
                            </div>
                        </div>
                    </div>
                    {{-- end pengaturan ukuran --}}

                    {{-- start pengaturan kerusakan --}}
                    <div class="tab-pane fade" id="pengaturan-kerusakan-tabpanel" role="tabpanel" aria-labelledby="#pengaturan-kerusakan-tab">
                        <div class="card card-info mx-n3 my-n3">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan Opsi Kerusakan APD</h3>
                            </div>
                            <div class="card-body">
                                {{-- start info pengaturan kerusakan --}}
                                <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="info-pengaturan-kerusakan">
                                    <div class="card-body">
                                        <div class="card-tools">
                                            <button type="button" class="close" data-toggle="collapse"
                                                data-target="#info-pengaturan-kerusakan" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div>
                                        Dibawah ini merupakan kendali untuk mengatur Opsi Kerusakan APD.<br>
                                        Opsi ini akan muncul ketika user/pegawai melakukan input apd.<br>
                                        Value dari opsi yang dipilih oleh user/pegawai akan masuk ke database,<br>
                                        Opsi yang dibuat dapat dikaitkan dengan banyak apd.<br>
                                        Klik "Detail" untuk mengedit.
                                        </div>
                                    </div>
                                </div>
                                {{-- end info pengaturan kerusakan --}}

                                {{-- start tabel pengaturan kerusakan --}}
                                @livewire('eapd.datatable.tabel-pengaturan-kerusakan-apd')
                                {{-- end tabel pengaturan kerusakan --}}
                            </div>
                            <div class="card-footer">
                                <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-primary float-right">Tambah Opsi Kerusakan APD</button>
                            </div>
                        </div>
                    </div>
                    {{-- end pengaturan kerusakan --}}

                </div>
            </div>
        </div>
        {{-- end card-kendali-utama --}}

        {{-- start card detail jenis --}}
        <div class="col-lg-12 collapse fade show active" id="collapse-card-detail-jenis">
            <div class="card " id="card-detail-jenis">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Jenis APD</h3>
                    <div class="card-tools">
                        <button type="button" class="close" data-toggle="collapse"
                            data-target="#collapse-card-detail-jenis" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    {{-- start form tambah/edit jenis apd --}}
                    {{-- end form tambah/edit jenis apd --}}
                </div>
                <div class="card-footer">
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-primary float-right mx-1">Simpan</button>
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-secondary float-right mx-1">Reset</button>
                </div>
            </div>
        </div>
        {{-- end card detail jenis --}}

    </section>
</div>

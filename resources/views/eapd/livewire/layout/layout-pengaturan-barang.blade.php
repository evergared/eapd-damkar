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
                                <button type="button" data-toggle="collapse" data-target="#collapse-card-detail-jenis" class="btn bg-gradient-primary float-right" wire:click="CardDetailJenisTambahJenisBaru">Tambah Jenis APD</button>
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
                    @if ($detail_jenis_edit_mode)
                        <h3 class="card-title">Form Edit Jenis APD</h3>
                    @else
                        <h3 class="card-title">Form Tambah Jenis APD</h3>
                    @endif

                    <div class="card-tools">
                        <button type="button" class="close" data-toggle="collapse"
                            data-target="#collapse-card-detail-jenis" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                {{-- start form tambah/edit jenis apd --}}
                    {{-- ID Jenis --}}
                    <div class="form-group">
                        <label for="detail-jenis-id">ID Jenis</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="detail-jenis-id" placeholder="Jika kosong, ID akan dibuat secara otomatis oleh sistem" wire:model="detail_jenis_id" @if(!$detail_jenis_edit_id) disabled @endif>
                            <div class="input-group-append">
                                <button class="btn btn-info" wire:click="$set('detail_jenis_edit_id',1)">Ubah</button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Klik ubah untuk mengubah ID, jika kosong ID akan diisi secara acak oleh sistem.</small>
                    </div>
                    {{-- Nama Jenis --}}
                    <div class="form-group">
                        <label for="detail-jenis-nama">Nama Jenis</label>
                        <input type="text" class="form-control" id="detail-jenis-nama" wire:model="detail_jenis_nama">
                    </div>
                    {{-- keterangan --}}
                    <div class="form-group">
                        <label for="detail-jenis-keterangan">Keterangan / Catatan Tambahan</label>
                        <textarea class="form-control" id="detail-jenis-keterangan" cols="10" rows="5" wire:model="detail_jenis_keterangan"></textarea>
                    </div>
                {{-- end form tambah/edit jenis apd --}}
                </div>
                <div class="card-footer">
                    <button type="button" class="btn bg-gradient-primary float-right mx-1" wire:click="CardDetailJenisSimpan">Simpan</button>
                    <button type="button" class="btn bg-gradient-secondary float-right mx-1" wire:click="CardDetailJenisReset">Reset</button>
                </div>
            </div>
        </div>
        {{-- end card detail jenis --}}

        {{-- start card detail barang --}}
        <div class="col-lg-12 collapse fade show active" id="collapse-card-detail-barang">
            <div class="card " id="card-detail-barang">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Barang APD</h3>
                    <div class="card-tools">
                        <button type="button" class="close" data-toggle="collapse"
                            data-target="#collapse-card-detail-barang" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                {{-- start form tambah/edit barang apd --}}
                    {{-- ID barang --}}
                    <div class="form-group">
                        <label for="detail-barang-id">ID Barang</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="detail-barang-id" placeholder="Jika kosong, ID akan dibuat secara otomatis oleh sistem" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-info">Ubah</button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Klik ubah untuk mengubah ID, jika kosong ID akan diisi berdasarkan jenis dan merk barang acak oleh sistem.</small>
                    </div>
                    {{-- Nama barang --}}
                    <div class="form-group">
                        <label for="detail-barang-nama">Nama Barang</label>
                        <input type="text" class="form-control" id="detail-barang-nama">
                    </div>
                    {{-- Merk barang --}}
                    <div class="form-group">
                        <label for="detail-barang-merk">Merk / Pembuat</label>
                        <input type="text" class="form-control" id="detail-barang-merk">
                    </div>
                    {{-- Jenis barang --}}
                    <div class="form-group">
                        <label for="detail-barang-jenis">Jenis / Kategori Barang</label>
                        <select class="form-control" id="detail-barang-jenis">
                            <option value="" disabled>Pilih Jenis / Kategori</option>
                        </select>
                    </div>
                    {{-- Gambar Barang --}}
                    <div class="form-control">
                        <label for="detail-barang-gambar">Gambar (maks. 3)</label>
                        <input type="file" id="detail-barang-gambar" multiple>
                    </div>
                    {{-- keterangan --}}
                    <div class="form-group">
                        <label for="detail-barang-keterangan">Keterangan / Catatan Tambahan</label>
                        <textarea class="form-control" id="detail-barang-keterangan" cols="10" rows="5"></textarea>
                    </div>
                {{-- end form tambah/edit barang apd --}}
                </div>
                <div class="card-footer">
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-primary float-right mx-1">Simpan</button>
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-secondary float-right mx-1">Reset</button>
                </div>
            </div>
        </div>
        {{-- end card detail barang --}}

        {{-- start card detail ukuran --}}
        <div class="col-lg-12 collapse fade show active" id="collapse-card-detail-ukuran">
            <div class="card " id="card-detail-ukuran">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Opsi Ukuran APD</h3>
                    <div class="card-tools">
                        <button type="button" class="close" data-toggle="collapse"
                            data-target="#collapse-card-detail-ukuran" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                {{-- start form tambah/edit ukuran apd --}}
                    {{-- ID ukuran --}}
                    <div class="form-group">
                        <label for="detail-ukuran-id">ID Jenis</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="detail-ukuran-id" placeholder="Jika kosong, ID akan dibuat secara otomatis oleh sistem" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-info">Ubah</button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Klik ubah untuk mengubah ID, jika kosong ID akan diisi secara acak oleh sistem.</small>
                    </div>
                    {{-- Nama ukuran --}}
                    <div class="form-group">
                        <label for="detail-ukuran-nama">Nama Opsi Ukuran</label>
                        <input type="text" class="form-control" id="detail-ukuran-nama">
                    </div>
                    {{-- Opsi Ukuran --}}
                    <div class="form-group">
                        <label>Atur Opsi Ukuran</label>
                        <small class="form-text text-muted">Value merupakan nilai yang akan di simpan di database, Text merupakan tulisan yang tampil ke user saat mereka menginput.</small>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>Value</th>
                                    <th>Text</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>XL</td>
                                        <td>XL</td>
                                    </tr>
                                    <tr>
                                        <td>L</td>
                                        <td>L</td>
                                    </tr>
                                    <tr>
                                        <td>M</td>
                                        <td>M</td>
                                    </tr>
                                    <tr>
                                        <td>S</td>
                                        <td>S</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4">
                            <h6>Tambah Opsi Baru</h6>
                            <div class="row">
                                <div class="col"><input type="text" class="form-control" placeholder="Value"></div>
                                <div class="col"><input type="text" class="form-control" placeholder="Text"></div>
                            </div>
                            <div class="row">
                                <button class="btn btn-primary float-right" type="button">Simpan Opsi Baru</button>
                            </div>                                                                          
                        </div>
                        
                    </div>
                    {{-- keterangan --}}
                    <div class="form-group">
                        <label for="detail-ukuran-keterangan">Keterangan / Catatan Tambahan</label>
                        <textarea class="form-control" id="detail-ukuran-keterangan" cols="10" rows="5"></textarea>
                    </div>
                {{-- end form tambah/edit ukuran apd --}}
                </div>
                <div class="card-footer">
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-primary float-right mx-1">Simpan</button>
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-secondary float-right mx-1">Reset</button>
                </div>
            </div>
        </div>
        {{-- end card detail ukuran --}}

        {{-- start card detail kerusakan --}}
        <div class="col-lg-12 collapse fade show active" id="collapse-card-detail-kerusakan">
            <div class="card " id="card-detail-kerusakan">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Opsi Kerusakan APD</h3>
                    <div class="card-tools">
                        <button type="button" class="close" data-toggle="collapse"
                            data-target="#collapse-card-detail-kerusakan" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                {{-- start form tambah/edit kerusakan apd --}}
                    {{-- ID kerusakan --}}
                    <div class="form-group">
                        <label for="detail-kerusakan-id">ID Opsi Kerusakan</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="detail-kerusakan-id" placeholder="Jika kosong, ID akan dibuat secara otomatis oleh sistem" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-info">Ubah</button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Klik ubah untuk mengubah ID, jika kosong ID akan diisi secara acak oleh sistem.</small>
                    </div>
                    {{-- Nama kerusakan --}}
                    <div class="form-group">
                        <label for="detail-kerusakan-nama">Nama Opsi Kerusakan</label>
                        <input type="text" class="form-control" id="detail-kerusakan-nama">
                    </div>
                    {{-- Opsi Kerusakan --}}
                    <div class="form-group">
                        <label>Opsi Kerusakan</label>
                        <small class="form-text text-muted">Value merupakan nilai yang akan di simpan di database, Text merupakan tulisan yang tampil ke user saat mereka menginput.</small>
                            <div class="card-body">
                                <span class="d-none d-sm-block">
                                    <div class="form-group row">
                                        <label for="detail-kerusakan-opsi-title" class="col-sm-2 col-form-label bg-secondary text-center">Value</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext bg-gray text-center" id="detail-kerusakan-opsi-title" value="Text">
                                        </div>
                                    </div>
                                </span>
                                
                                <div class="form-group row">
                                    <label for="detail-kerusakan-opsi-baik" class="col-sm-2 col-form-label">baik</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="detail-kerusakan-opsi-baik" placeholder="Baik">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="detail-kerusakan-opsi-rusak-ringan" class="col-sm-2 col-form-label">rusakRingan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="detail-kerusakan-opsi-rusak-ringan" placeholder="Rusak Ringan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="detail-kerusakan-opsi-rusak-sedang" class="col-sm-2 col-form-label">rusakSedang</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="detail-kerusakan-opsi-rusak-sedang" placeholder="Rusak Sedang">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="detail-kerusakan-opsi-rusak-berat" class="col-sm-2 col-form-label">rusakBerat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="detail-kerusakan-opsi-rusak-berat" placeholder="Rusak Berat">
                                    </div>
                                </div>
                            </div>
                    </div>
                    {{-- keterangan --}}
                    <div class="form-group">
                        <label for="detail-kerusakan-keterangan">Keterangan / Catatan Tambahan</label>
                        <textarea class="form-control" id="detail-kerusakan-keterangan" cols="10" rows="5"></textarea>
                    </div>
                {{-- end form tambah/edit kerusakan apd --}}
                </div>
                <div class="card-footer">
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-primary float-right mx-1">Simpan</button>
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-secondary float-right mx-1">Reset</button>
                </div>
            </div>
        </div>
        {{-- end card detail kerusakan --}}

    </section>
</div>

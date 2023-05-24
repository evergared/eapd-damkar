<div>
    <section class="d-flex justify-content-center row connectedSortable ui-sortable">

        {{-- Start card-kendali-utama --}}
        <div class="card col-lg-12" id="card-kendali-utama">
            <div class="card-header p-2">
                {{-- navigasi kendali utama --}}
                <ul class="nav nav-pills" id="card-kendali-utama-tablist" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pengaturan-jenis-tab" data-toggle="tab" data-target="#pengaturan-jenis-tabpanel" type="button" role="tab" aria-controls="pengaturan-jenis-tabpanel" aria-selected="true" wire:ignore.self>Jenis APD</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pengaturan-barang-tab" data-toggle="tab" data-target="#pengaturan-barang-tabpanel" type="button" role="tab" aria-controls="pengaturan-barang-tabpanel" aria-selected="false" wire:ignore.self>Barang APD</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pengaturan-ukuran-tab" data-toggle="tab" data-target="#pengaturan-ukuran-tabpanel" type="button" role="tab" aria-controls="pengaturan-ukuran-tabpanel" aria-selected="false" wire:ignore.self>Opsi Ukuran</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pengaturan-kerusakan-tab" data-toggle="tab" data-target="#pengaturan-kerusakan-tabpanel" type="button" role="tab" aria-controls="pengaturan-kerusakan-tabpanel" aria-selected="false" wire:ignore.self>Opsi Kerusakan</a>
                    </li>                     
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="card-kendali-utama-tablistContent">
                    {{-- start pengaturan jenis --}}
                    <div class="tab-pane fade show active" id="pengaturan-jenis-tabpanel" role="tabpanel" aria-labelledby="#pengaturan-jenis-tab" wire:ignore.self>
                        <div class="card card-info mx-n3 my-n3">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan Jenis APD</h3>
                            </div>
                            <div class="card-body">
                                @if (session()->has('pengaturan_jenis_danger'))
                                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                        {{session('pengaturan_jenis_danger')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
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
                    <div class="tab-pane fade" id="pengaturan-barang-tabpanel" role="tabpanel" aria-labelledby="#pengaturan-barang-tab" wire:ignore.self>
                        <div class="card card-info mx-n3 my-n3">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan APD</h3>
                            </div>
                            <div class="card-body">
                                @if (session()->has('pengaturan_barang_danger'))
                                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                        {{session('pengaturan_barang_danger')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
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
                                <button type="button" aria-controls="card-detail-barang" class="btn bg-gradient-primary float-right" wire:click="CardDetailBarangTambahBarangBaru">Tambah APD Baru</button>
                            </div>
                        </div>
                    </div>
                    {{-- end pengaturan barang --}}

                    {{-- start pengaturan ukuran --}}
                    <div class="tab-pane fade" id="pengaturan-ukuran-tabpanel" role="tabpanel" aria-labelledby="#pengaturan-ukuran-tab" wire:ignore.self>
                        <div class="card card-info mx-n3 my-n3">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan Opsi Ukuran APD</h3>
                            </div>
                            <div class="card-body">
                                @if (session()->has('pengaturan_pengaturan_danger'))
                                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                        {{session('pengaturan_pengaturan_danger')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
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
                                <button type="button" aria-controls="card-detail-ukuran" class="btn bg-gradient-primary float-right" wire:click="CardDetailUkuranTambahUkuranBaru">Tambah Opsi Ukuran APD</button>
                            </div>
                        </div>
                    </div>
                    {{-- end pengaturan ukuran --}}

                    {{-- start pengaturan kerusakan --}}
                    <div class="tab-pane fade" id="pengaturan-kerusakan-tabpanel" role="tabpanel" aria-labelledby="#pengaturan-kerusakan-tab" wire:ignore.self>
                        <div class="card card-info mx-n3 my-n3">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan Opsi Kerusakan APD</h3>
                            </div>
                            <div class="card-body">
                                @if (session()->has('pengaturan_kerusakan_danger'))
                                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                        {{session('pengaturan_kerusakan_danger')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
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
                                <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-primary float-right" wire:click="CardDetailKerusakanTambahKerusakanBaru">Tambah Opsi Kerusakan APD</button>
                            </div>
                        </div>
                    </div>
                    {{-- end pengaturan kerusakan --}}

                </div>
            </div>
        </div>
        {{-- end card-kendali-utama --}}

        {{-- start card detail jenis --}}
        <div class="col-lg-12 collapse fade" id="collapse-card-detail-jenis">
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
                @if (session()->has('detail_jenis_danger'))
                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                        {{session('detail_jenis_danger')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('detail_jenis_success'))
                    <div class="alert alert-success alert-dismissable fade show" role="alert">
                        {{session('detail_jenis_success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- start form tambah/edit jenis apd --}}
                @if (!$detail_jenis_edit_mode)
                    {{-- ID Jenis --}}
                    <div class="form-group">
                        <label for="detail-jenis-id">ID Jenis</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="detail-jenis-id" placeholder="Jika kosong, ID akan dibuat secara otomatis oleh sistem" wire:model="detail_jenis_id">
                        </div>
                    </div>
                @endif
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
        <div class="col-lg-12 collapse fade" id="collapse-card-detail-barang">
            <div class="card " id="card-detail-barang">
                <div class="card-header">
                    @if ($detail_barang_edit_mode)
                        <h3 class="card-title">Form Edit Detail Barang APD</h3>
                    @else
                        <h3 class="card-title">Form Tambah Barang APD</h3>
                    @endif
                    <div class="card-tools">
                        <button type="button" class="close" data-toggle="collapse"
                            data-target="#collapse-card-detail-barang" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                @if (session()->has('detail_barang_danger'))
                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                        {{session('detail_barang_danger')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('detail_barang_success'))
                    <div class="alert alert-success alert-dismissable fade show" role="alert">
                        {{session('detail_barang_success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- start form tambah/edit barang apd --}}
                @if (!$detail_barang_edit_mode)
                    {{-- ID barang --}}
                    <div class="form-group">
                        <label for="detail-barang-id">ID Barang</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="detail-barang-id" placeholder="Jika kosong, ID akan dibuat secara otomatis oleh sistem" wire:model="detail_barang_id" @if(!$detail_barang_edit_id) disabled @endif>
                            <div class="input-group-append">
                                <button class="btn btn-info" wire:click="$set('detail_barang_edit_id',1)">Ubah</button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Klik ubah untuk mengubah ID, jika kosong ID akan diisi berdasarkan jenis dan merk barang oleh sistem.</small>
                    </div>
                @endif
                    {{-- Nama barang --}}
                    <div class="form-group">
                        <label for="detail-barang-nama">Nama Barang</label>
                        <input type="text" class="form-control" id="detail-barang-nama" wire:model="detail_barang_nama">
                    </div>
                    {{-- Merk barang --}}
                    <div class="form-group">
                        <label for="detail-barang-merk">Merk / Pembuat</label>
                        <input type="text" class="form-control" id="detail-barang-merk" wire:model="detail_barang_merk" wire:change='CardDetailBarangGenerateId'>
                    </div>
                    {{-- Jenis barang --}}
                    <div class="form-group">
                        <label for="detail-barang-jenis">Jenis / Kategori Barang</label>
                        <select class="form-control" id="detail-barang-jenis" wire:model="detail_barang_jenis" wire:change='CardDetailBarangGenerateId'>
                            <option value="" disabled>Pilih Jenis / Kategori</option>
                            @forelse ($detail_barang_opsi_jenis as $item)
                                <option value="{{$item['value']}}">{{$item['text']}}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                    {{-- Ukuran barang --}}
                    <div class="form-group">
                        <label for="detail-barang-ukuran">Tipe Opsi Ukuran Barang</label>
                        <select class="form-control" id="detail-barang-ukuran" wire:model="detail_barang_ukuran">
                            <option value="" disabled>Pilih Tipe Ukuran</option>
                            @forelse ($detail_barang_opsi_ukuran as $item)
                                <option value="{{$item['value']}}">{{$item['text']}}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                    {{-- Kerusakan barang --}}
                    <div class="form-group">
                        <label for="detail-barang-kerusakan">Tipe Opsi Kerusakan Barang</label>
                        <select class="form-control" id="detail-barang-kerusakan" wire:model="detail_barang_kerusakan">
                            <option value="" disabled>Pilih Tipe Kerusakan</option>
                            @forelse ($detail_barang_opsi_kerusakan as $item)
                                <option value="{{$item['value']}}">{{$item['text']}}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                    {{-- Gambar Barang --}}
                    <div class="form-group">
                        <label for="detail-barang-gambar">Gambar (maks. 3)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="detail-barang-gambar" multiple wire:model="detail_barang_gambar_upload">
                                <label class="custom-file-label" for="detail-barang-gambar">Pilih Gambar</label>
                            </div>
                            <div class="input-group-append">
                                {{-- <span class="input-group-text">Preview</span> --}}
                                <button class="btn btn-info" data-toggle="modal" data-target="#modal-preview-gambar-detail-barang">Preview</button>
                            </div>
                        </div>
                    </div>
                    {{-- keterangan --}}
                    <div class="form-group">
                        <label for="detail-barang-keterangan">Keterangan / Catatan Tambahan</label>
                        <textarea class="form-control" id="detail-barang-keterangan" cols="10" rows="5"></textarea>
                    </div>
                {{-- end form tambah/edit barang apd --}}
                </div>
                <div class="card-footer">
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-primary float-right mx-1" wire:click="CardDetailBarangSimpan">Simpan</button>
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-secondary float-right mx-1" wire:click="CardDetailBarangReset">Reset</button>
                </div>
            </div>
        </div>
        {{-- end card detail barang --}}

        {{-- start card detail ukuran --}}
        <div class="col-lg-12 collapse fade" id="collapse-card-detail-ukuran">
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
                @if (session()->has('detail_ukuran_danger'))
                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                        {{session('detail_ukuran_danger')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('detail_ukuran_success'))
                    <div class="alert alert-success alert-dismissable fade show" role="alert">
                        {{session('detail_ukuran_success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- start form tambah/edit ukuran apd --}}
                @if (!$detail_ukuran_edit_mode)
                    {{-- ID ukuran --}}
                    <div class="form-group">
                        <label for="detail-ukuran-id">ID Opsi Ukuran</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="detail-ukuran-id" placeholder="Jika kosong, ID akan dibuat secara otomatis oleh sistem" wire:model="detail_ukuran_id">
                        </div>
                    </div>
                @endif
                    {{-- Nama ukuran --}}
                    <div class="form-group">
                        <label for="detail-ukuran-nama">Nama Opsi Ukuran</label>
                        <input type="text" class="form-control" id="detail-ukuran-nama" wire:model="detail_ukuran_nama">
                    </div>
                    {{-- Opsi Ukuran --}}
                    <div class="form-group">
                        <label>Atur Opsi Ukuran</label>
                        <small class="form-text text-muted">Klik pada ukuran dibawah untuk menghapus.</small>
                        <div class="card-body">
                            <table class="table table-striped table-bordered" id="tabel-item-opsi-ukuran">
                                <thead>
                                    <th>Ukuran</th>
                                </thead>
                                <tbody>
                                    @forelse ($detail_ukuran_opsi as $index => $item)
                                        <tr>
                                            <td><a href="#tabel-item-opsi-ukuran" wire:click="CardDetailUkuranHapusOpsiUkuran({{$index}})">{{$item}}</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="jumbotron text-center">Tidak ada yang dapat ditampilkan, silahkan tambah opsi baru.</td>
                                        </tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="px-4">
                            <h6>Tambah Opsi Baru</h6>
                            <div class="row">
                                <input type="text" class="form-control" placeholder="Opsi Ukuran Baru" wire:model="detail_ukuran_new_value">
                            </div>
                            <div class="row">
                                <button class="btn btn-primary float-right" type="button" wire:click="CardDetailUkuranTambahOpsiUkuran">Simpan Opsi Baru</button>
                            </div>                                                                          
                        </div>
                        
                    </div>
                    {{-- keterangan --}}
                    <div class="form-group">
                        <label for="detail-ukuran-keterangan">Keterangan / Catatan Tambahan</label>
                        <textarea class="form-control" id="detail-ukuran-keterangan" cols="10" rows="5" wire:model="detail_ukuran_keterangan"></textarea>
                    </div>
                {{-- end form tambah/edit ukuran apd --}}
                </div>
                <div class="card-footer">
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-primary float-right mx-1" wire:click="CardDetailUkuranSimpan">Simpan</button>
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-secondary float-right mx-1" wire:click="CardDetailUkuranReset">Reset</button>
                </div>
            </div>
        </div>
        {{-- end card detail ukuran --}}

        {{-- start card detail kerusakan --}}
        <div class="col-lg-12 collapse fade" id="collapse-card-detail-kerusakan">
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
                @if (session()->has('detail_kerusakan_danger'))
                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                        {{session('detail_kerusakan_danger')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('detail_kerusakan_success'))
                    <div class="alert alert-success alert-dismissable fade show" role="alert">
                        {{session('detail_kerusakan_success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- start form tambah/edit kerusakan apd --}}
                @if (!$detail_kerusakan_edit_mode)
                    {{-- ID kerusakan --}}
                    <div class="form-group">
                        <label for="detail-kerusakan-id">ID Opsi Kerusakan</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="detail-kerusakan-id" placeholder="Jika kosong, ID akan dibuat secara otomatis oleh sistem" wire:model="detail_kerusakan_id">
                        </div>
                    </div>
                @endif
                    {{-- Nama kerusakan --}}
                    <div class="form-group">
                        <label for="detail-kerusakan-nama">Nama Opsi Kerusakan</label>
                        <input type="text" class="form-control" id="detail-kerusakan-nama" wire:model="detail_kerusakan_nama">
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
                                        <input type="text" class="form-control" id="detail-kerusakan-opsi-baik" placeholder="Baik" wire:model='detail_kerusakan_text_baik'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="detail-kerusakan-opsi-rusak-ringan" class="col-sm-2 col-form-label">rusak ringan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="detail-kerusakan-opsi-rusak-ringan" placeholder="Rusak Ringan" wire:model='detail_kerusakan_text_rusak_ringan'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="detail-kerusakan-opsi-rusak-sedang" class="col-sm-2 col-form-label">rusak sedang</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="detail-kerusakan-opsi-rusak-sedang" placeholder="Rusak Sedang" wire:model='detail_kerusakan_text_rusak_sedang'>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="detail-kerusakan-opsi-rusak-berat" class="col-sm-2 col-form-label">rusak berat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="detail-kerusakan-opsi-rusak-berat" placeholder="Rusak Berat" wire:model='detail_kerusakan_text_rusak_berat'>
                                    </div>
                                </div>
                            </div>
                    </div>
                    {{-- keterangan --}}
                    <div class="form-group">
                        <label for="detail-kerusakan-keterangan">Keterangan / Catatan Tambahan</label>
                        <textarea class="form-control" id="detail-kerusakan-keterangan" cols="10" rows="5" wire:model='detail_kerusakan_keterangan'></textarea>
                    </div>
                {{-- end form tambah/edit kerusakan apd --}}
                </div>
                <div class="card-footer">
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-primary float-right mx-1" wire:click='CardDetailKerusakanSimpan'>Simpan</button>
                    <button type="button" aria-controls="card-detail-kerusakan" class="btn bg-gradient-secondary float-right mx-1" wire:click='CardDetailKerusakanReset'>Reset</button>
                </div>
            </div>
        </div>
        {{-- end card detail kerusakan --}}

        {{-- start modal tampil gambar apd --}}
        <div class="modal fade" id="modal-tampil-gambar-apd" tabindex="-1" role="document" wire:ignore.self>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Gambar APD Terpilih</h4>
                        <button type="button" class="close" data-toggle="modal"
                            data-target="#modal-tampil-gambar-apd" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($modal_tampil_gambar_apd_gambar_preview)
                            <img src="{{$modal_tampil_gambar_apd_gambar_preview}}" class="img-fluid" alt="Gambar APD Terpilih">
                        @else
                            <div class="jumbotron text-center">
                                Tidak ada yang dapat ditampilkan.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal tampil gambar apd --}}

        {{-- start modal preview gambar detail barang --}}
        <div class="modal fade" id="modal-preview-gambar-detail-barang" tabindex="-1" role="document" wire:ignore:self>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Preview Gambar APD</h4>
                        <button type="button" class="close" data-toggle="modal"
                            data-target="#modal-preview-gambar-detail-barang" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-pills" id="modal-gambar-tablist" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="preview-gambar-tab" data-toggle="tab" data-target="#preview-gambar-tabpanel" type="button" role="tab" aria-controls="preview-gambar-tabpanel" aria-selected="true" wire:ignore.self>Preview Gambar</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="gambar-sebelumnya-tab" data-toggle="tab" data-target="#gambar-sebelumnya-tabpanel" type="button" role="tab" aria-controls="gambar-sebelumnya-tabpanel" aria-selected="true" wire:ignore.self>Gambar Sebelumnya</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="preview-gambar-tablistContent">
                            <div class="tab-pane fade show active" id="preview-gambar-tabpanel" role="tabpanel" aria-labelledby="#preview-gambar-tab" wire:ignore.self>
                                @if ($detail_barang_gambar_upload && !($errors->has('detail_barang_gambar_upload.*')))
                                    <div class="text-center mb-3">
                                        Berikut merupakan preview gambar yang akan diupload. Pastikan klik simpan untuk menyimpan perubahan.
                                    </div>
                                    @if (count($detail_barang_gambar_upload)>1)
                                        <img class="upload-preview product-image" src="{{ $detail_barang_gambar_upload[0]->temporaryUrl() }}"
                                        alt="APD">
                                        <div class="col-12 upload-preview product-image-thumbs">
                                            @foreach ($detail_barang_gambar_upload as $index => $gbr)
                                                @if ($index === array_key_first($detail_barang_gambar_upload))
                                                    <div class="upload-preview product-image-thumb active">
                                                        <img src="{{ $gbr->temporaryUrl() }}">
                                                    </div>
                                                @else
                                                    <div class="upload-preview product-image-thumb">
                                                        <img src="{{ $gbr->temporaryUrl() }}">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <img class="upload-preview product-image" src="{{ $detail_barang_gambar_upload[0]->temporaryUrl() }}"
                                        alt="APD">
                                    @endif
                                    <script>
                                        $(document).ready(function() {
                                                $('.upload-preview.product-image-thumb').on('click', function () {
                                                    var $image_element = $(this).find('img')
                                                    $('.upload-preview.product-image').prop('src', $image_element.attr('src'))
                                                    $('.upload-preview.product-image-thumb.active').removeClass('active')
                                                    $(this).addClass('active')
                                                    })
                                                })
                                    </script>
                                @else
                                    <div class="jumbotron text-center">
                                        Tidak ada yang dapat ditampilkan, silahkan upload gambar untuk APD.
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="gambar-sebelumnya-tabpanel" role="tabpanel" aria-labelledby="#gambar-sebelumnya-tab" wire:ignore.self>
                                @if ($detail_barang_gambar)
                                    <div class="text-center mb-3">
                                        Berikut merupakan gambar yang saat ini ada di database.
                                    </div>
                                    @if (count($detail_barang_gambar)>1)
                                        <img class="gambar-sebelumnya product-image" src="{{ asset($detail_barang_gambar[0]) }}"
                                        alt="APD">
                                        <div class="col-12 gambar-sebelumnya product-image-thumbs">
                                            @foreach ($detail_barang_gambar as $index => $gbr)
                                                @if ($index === array_key_first($detail_barang_gambar))
                                                    <div class="gambar-sebelumnya product-image-thumb active">
                                                        <img src="{{ asset($gbr)}}">
                                                    </div>
                                                @else
                                                    <div class="gambar-sebelumnya product-image-thumb">
                                                        <img src="{{ asset($gbr)}}">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    <script>
                                        $(document).ready(function() {
                                                $('.gambar-sebelumnya.product-image-thumb').on('click', function () {
                                                    var $image_element = $(this).find('img')
                                                    $('.gambar-sebelumnya.product-image').prop('src', $image_element.attr('src'))
                                                    $('.gambar-sebelumnya.product-image-thumb.active').removeClass('active')
                                                    $(this).addClass('active')
                                                    })
                                                })
                                    </script>
                                    @else
                                        <img class="upload-preview product-image" src="{{ asset($detail_barang_gambar[0]) }}"
                                        alt="APD">
                                    @endif
                                        
                                @else
                                    <div class="jumbotron text-center">
                                        Tidak ada yang dapat ditampilkan.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal preview gambar detail barang --}}

    </section>

    {{-- start javascript --}}
    @push('stack-body')
        <script>
            window.addEventListener('showModalTampilGambarApd',event=>{
                $('#modal-tampil-gambar-apd').modal('show');
            })

            window.addEventListener('card_detail_jenis_tampil',event=>{
                $("#collapse-card-detail-jenis").collapse("show");
            })

            window.addEventListener('card_detail_barang_tampil',event=>{
                $("#collapse-card-detail-barang").collapse("show");
            })

            window.addEventListener('card_detail_ukuran_tampil',event=>{
                $("#collapse-card-detail-ukuran").collapse("show");
            })

            window.addEventListener('card_detail_kerusakan_tampil',event=>{
                $("#collapse-card-detail-kerusakan").collapse("show");
            })

        </script>        
    @endpush
    {{-- end javascript --}}

</div>

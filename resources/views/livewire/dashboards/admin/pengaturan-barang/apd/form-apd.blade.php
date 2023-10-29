
<div class="col-md-6 col-lg-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Form Barang APD
            </div>
            <div class="card-tools">
                <button class="btn-primary btn-sm" onclick="formApdKeKendali()">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </div>
        </div>
        <div class="card-body col-8">
            {{-- alert --}}
            @if (session()->has('alert-success-form-apd'))
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('alert-success-form-apd')}}
                    </div>
                </div>
            @endif
            @if (session()->has('alert-danger-form-apd'))
                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('alert-danger-form-apd')}}
                    </div>
                </div>
            @endif
            {{-- form --}}
            <div class="form-group">
                <label>Nama Model APD</label>
                <input type="text" class="form-control" placeholder="Masukan Nama APD" wire:model='model_nama_apd'>
                @error('model_nama_apd')
                    <span><small class="text-danger">{{$message}}</small></span>
                @enderror
            </div>
            <div class="form-group">
                <label>Jenis APD</label>
                <select class="form-control" wire:model='model_id_jenis'>
                    <option value="" disabled>Pilih Jenis APD</option>
                    @foreach ($opsi_dropdown_jenis as $item)
                        <option value="{{$item['value']}}">{{$item['text']}}</option>
                    @endforeach
                </select>
                @error('model_id_jenis')
                    <span><small class="text-danger">{{$message}}</small></span>
                @enderror
            </div>
            <div class="form-group">
                <label>Merk APD</label>
                <input type="text" class="form-control" placeholder="Masukan Merk APD" wire:model='model_merk_apd'>
            </div>
            <div class="form-group">
                <label>Tipe Opsi Ukuran APD</label>
                <select class="form-control" wire:model='model_size_apd'>
                    <option value="">Tanpa Ukuran</option>
                    @foreach ($opsi_dropdown_size as $item)
                        <option value="{{$item['value']}}">{{$item['text']}}</option>
                    @endforeach
                </select>
                @error('model_size_apd')
                    <span><small class="text-danger">{{$message}}</small></span>
                @enderror
            </div>
            <div class="form-group">
                <label>Tipe Opsi Kondisi APD</label>
                <select class="form-control" wire:model='model_kondisi_apd'>
                    <option value="" disabled>Pilih Kondisi</option>
                    @foreach ($opsi_dropdown_kondisi as $item)
                        <option value="{{$item['value']}}">{{$item['text']}}</option>
                    @endforeach
                </select>
                @error('model_kondisi_apd')
                    <span><small class="text-danger">{{$message}}</small></span>
                @enderror
            </div>
            <div class="form-group">
                
                <label>
                    Gambar APD
                    <div wire:loading wire:model='model_image_apd'>
                        <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                        <small> Mengupload gambar . . .</small>
                    </div>
                </label>
                <input type="file" class="form-control" placeholder="Masukan Gambar untuk dijadikan Template APD" multiple wire:model='model_image_apd'>
                {{-- preview image sebelumnya --}}
                @if (!is_null($model_image_apd_old))
                    @if (is_array($model_image_apd_old))
                        @foreach ($model_image_apd_old as $i => $item)
                            @if ($i == 0)
                                <a class="btn btn-sm my-2 mx-2 btn-secondary" href="{{asset($item)}}" data-toggle="lightbox" data-title="Gambar APD" data-gallery="template-old"><i class="fas fa-image mx-1"></i>Lihat Gambar Sebelumnya</a>
                            @endif
                            <a class="d-none" href="{{asset($item)}}" data-toggle="lightbox" data-title="Gambar APD Sebelumnya" data-gallery="template-old"></a>
                        @endforeach
                    @elseif(is_string($model_image_apd_old))
                        <a class="d-none" href="{{asset($model_image_apd_old)}}" data-toggle="lightbox" data-title="Gambar APD Sebelumnya" data-gallery="template-old"></a>
                        <a class="btn btn-sm my-2 mx-1 btn-secondary" href="{{asset($model_image_apd_old)}}" data-toggle="lightbox" data-title="Gambar APD" data-gallery="template-old"><i class="fas fa-image mx-1"></i>Lihat Gambar Sebelumnya</a>
                    @endif
                @endif
                {{-- preview image baru upload --}}
                @if (!is_null($model_image_apd))
                    @foreach ($model_image_apd as $i => $item)
                    @if ($i == 0)
                        <a class="btn btn-sm my-2 mx-1 btn-info" href="{{asset($item->temporaryUrl())}}" data-toggle="lightbox" data-title="Gambar APD Baru" data-gallery="template-new"><i class="fas fa-image mx-1"></i>Preview Gambar</a>
                    @endif
                    <a class="d-none" href="{{asset($item->temporaryUrl())}}" data-toggle="lightbox" data-title="Gambar APD Baru" data-gallery="template-new"></a>
                    @endforeach
                @endif
                {{-- error message untuk upload image --}}
                @error('model_image_apd.*')
                    <span><small class="text-danger">{{$message}}</small></span>
                @enderror
                @error('model_image_apd')
                    <span><small class="text-danger">{{$message}}</small></span>
                @enderror
            </div>
            <div class="form-check my-4">
                <input class="form-check-input" type="checkbox" wire:model='model_no_seri_apd' wire:change='changedNoSeriCheckbox'>
                <label class="form-check-label">Perlu input No. Seri?</label>
                <small class="text-muted">Pegawai perlu menginput No Seri yang tertera pada APD.</small>
            </div>
            @if (false)
                <div class="form-check my-4">
                    <input class="form-check-input" type="checkbox" wire:model='model_no_seri_strict_apd'>
                    <label class="form-check-label">No. Seri bersifat mengikat?</label>
                    <small class="text-muted">Pegawai hanya bisa memasukan No Seri dari list yang telah disediakan oleh admin.</small>
                </div>
                @if ($model_no_seri_strict_apd)
                    <div class="form-group">
                        <label>List No. Seri APD</label>
                        <textarea class="form-control" rows="10" placeholder="Masukan No. Seri"></textarea>
                        <small class="text-muted">Masukan semua No. Seri sebagai referensi saat pegawai menginput No. Seri di apdku. Gunakan garis baru (enter) untuk memisahkan no. seri satu dengan yang lain.</small>
                    </div>
                @endif
            @endif
            <div class="form-group">
                <label>No Referensi Dari Penyedia</label>
                <input type="text" class="form-control" placeholder="Masukan No Referensi">
                <small class="text-muted">No. Referensi yang dimaksud adalah nomer DPA atau nomer lain yang disediakan pihak penyedia saat pengadaan. Jika tidak ada, kosongkan bagian ini.</small>
            </div>
            <div class="form-group">
                <label>Penyedia No Referensi</label>
                <input type="text" class="form-control" placeholder="Masukan Nama Pihak">
                <small class="text-muted">Organisasi / vendor / pihak yang memberikan No Referensi. Jika tidak ada No. Referensi yang diberikan, kosongkan bagian ini.</small>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" wire:click='simpan'>Simpan Data APD</button>
        </div>
    </div>
</div>
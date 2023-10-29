<div class="card">
    <div class="card-header">
        <div class="card-title">
            Form Jenis Barang APD
        </div>
        <div class="card-tools">
            <button class="btn-primary btn-sm" onclick="formKeTabel()">
                <i class="fas fa-arrow-left"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="overlay-wrapper">
            @if (session()->has('overlay-error'))
                <div class="overlay">
                    <strong>{{session('overlay-error')}}</strong>
                </div>
            @endif
            @if (session()->has('alert-success'))
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div>
                    {{session('alert-success')}}
                </div>
                </div>
            @endif
            @if (session()->has('alert-danger'))
                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div>
                    {{session('alert-danger')}}
                </div>
                </div>
            @endif
            @if ($editing)
                <div class="row justify-content-center">
                    <div class="card col-lg-6 mb-4">
                        <div class="card-body text-center">
                            Jumlah APD Pada Jenis Ini : <strong>{{$jumlah_apd}}</strong> barang.
                        </div>
                    </div>
                </div>
            @else
                <div class="row justify-content-center">
                    <div class="card col-lg-4 mb-4">
                        <div class="card-body">
                            H - Helmet <br>
                            T - Tubuh/Trouser <br>
                            G - Gloves <br>
                            B - Boots <br>
                            A - Additionals/APD Tipe Lainnya
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="id">ID Jenis APD</label>
                        <input type="text" class="form-control" id="id" wire:model='model_id_jenis' placeholder="Masukan ID Jenis untuk referensi di database." @if($editing) disabled @endif>
                        @error('model_id_jenis')
                            <small><strong class="text-danger">{{$message}}</strong></small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="nama">Nama Jenis APD</label>
                        <input type="text" class="form-control" id="nama" wire:model='model_nama_jenis' placeholder="Nama Jenis Barang APD">
                        @error('model_nama_jenis')
                            <small><strong class="text-danger">{{$message}}</strong></small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" wire:click='simpan'>Simpan</button>
    </div>
</div>

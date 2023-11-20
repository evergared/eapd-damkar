<div class="card" id="card-single-template-inputan-apd">
    <div class="card-header">
        <div class="card-title">
            @if ($formEditMode)
                <h5>Edit Template Inputan APD</h5>
            @else
                <h5>Tambah Template Inputan APD</h5>
            @endif
        </div>
        <div class="card-tools text-right" style="cursor:pointer;" onclick="kembaliKeTabelInputanApdDariSingle()">
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
                <input type="text" class="form-control" id="input-single-template-jabatan" value="{{$formJabatan}}" disabled>
                <div class="input-group-append">
                    <button class="btn btn-outline-info" data-toggle="modal" wire:click="ubah('jabatan')"><u>Ubah</u></button>
                </div>
            </div>
            @if ($formJabatan_id != "")
                <div class="form-text text-muted">ID Jabatan : <strong>{{$formJabatan_id}}</strong></div>
            @endif
        </div>
        {{-- Jenis APD --}}
        <div class="form-group form-inline row">
            <label for="input-single-template-jenis-apd" class="col-sm-2 col-form-label col-form-label-lg">Jenis APD</label>
            <div class="col-sm-4 input-group">
                <input type="text" class="form-control" id="input-single-template-jenis-apd" value="{{$formJenisApd}}" disabled>
                <div class="input-group-append">
                    <button class="btn btn-outline-info" data-toggle="modal" wire:click="ubah('jenis_apd')"><u>Ubah</u></button>
                </div>
            </div>
            @if ($formJenisApd_id != "")
                <div class="form-text text-muted">ID Jenis APD : <strong>{{$formJenisApd_id}}</strong></div>
            @endif
        </div>
        {{-- APD --}}
        <div class="form-group form-inline row">
            <label for="input-single-template-apd" class="col-sm-2 col-form-label col-form-label-lg">APD</label>
            <div class="col-sm-4 input-group">
                <input type="text" class="form-control" id="input-single-template-apd" value="{{$formApd}}" disabled>
                <div class="input-group-append">
                    <button class="btn btn-outline-info" data-toggle="modal" wire:click="ubah('opsi_apd')" @if($formJenisApd_id == "") disabled @endif><u>Ubah</u></button>
                </div>
            </div>
            @if ($formApd_id != "")
                <div class="form-text text-muted">ID APD : <strong>{{$formApd_id}}</strong></div>
            @endif
        </div>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-primary" wire:click="simpan">Simpan</button>
    </div>
</div>
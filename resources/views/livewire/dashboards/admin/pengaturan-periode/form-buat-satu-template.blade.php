<div class="card" id="card-single-template-inputan-apd">
    <div class="card-header">
        <div class="card-title">
            @if ($card_single_template_inputan_apd_formEditMode)
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

        {{-- start alert status --}}
            @if (session()->has('card_template_single_success'))
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    {{session('card_template_single_success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session()->has('card_template_single_danger'))
                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                    {{session('card_template_single_danger')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- end alert status --}}

        {{-- Jabatan --}}
        <div class="form-group form-inline row">
            <label for="input-single-template-jabatan" class="col-sm-2 col-form-label col-form-label-lg">Jabatan</label>
            <div class="col-sm-4 input-group">
                <input type="text" class="form-control" id="input-single-template-jabatan" value="{{$card_single_template_inputan_apd_formJabatan}}" disabled>
                <div class="input-group-append">
                    <button class="btn btn-outline-info" data-toggle="modal" wire:click="$set('modal_ubah_single_inputan_apd_mode','jabatan')" data-target="#modal-ubah-single-template-inputan-apd"><u>Ubah</u></button>
                </div>
            </div>
            @if ($card_single_template_inputan_apd_formJabatan_id != "")
                <div class="form-text text-muted">ID Jabatan : <strong>{{$card_single_template_inputan_apd_formJabatan_id}}</strong></div>
            @endif
        </div>
        {{-- Jenis APD --}}
        <div class="form-group form-inline row">
            <label for="input-single-template-jenis-apd" class="col-sm-2 col-form-label col-form-label-lg">Jenis APD</label>
            <div class="col-sm-4 input-group">
                <input type="text" class="form-control" id="input-single-template-jenis-apd" value="{{$card_single_template_inputan_apd_formJenisApd}}" disabled>
                <div class="input-group-append">
                    <button class="btn btn-outline-info" data-toggle="modal" wire:click="$set('modal_ubah_single_inputan_apd_mode','jenis_apd')" data-target="#modal-ubah-single-template-inputan-apd"><u>Ubah</u></button>
                </div>
            </div>
            @if ($card_single_template_inputan_apd_formJenisApd_id != "")
                <div class="form-text text-muted">ID Jenis APD : <strong>{{$card_single_template_inputan_apd_formJenisApd_id}}</strong></div>
            @endif
        </div>
        {{-- APD --}}
        <div class="form-group form-inline row">
            <label for="input-single-template-apd" class="col-sm-2 col-form-label col-form-label-lg">APD</label>
            <div class="col-sm-4 input-group">
                <input type="text" class="form-control" id="input-single-template-apd" value="{{$card_single_template_inputan_apd_formApd}}" disabled>
                <div class="input-group-append">
                    <button class="btn btn-outline-info" data-toggle="modal" wire:click="CardSingleTemplateInputanApdOpsiApdUbah" data-target="#modal-ubah-single-template-inputan-apd" @if($card_single_template_inputan_apd_formJenisApd_id == "") disabled @endif><u>Ubah</u></button>
                </div>
            </div>
            @if ($card_single_template_inputan_apd_formApd_id != "")
                <div class="form-text text-muted">ID APD : <strong>{{$card_single_template_inputan_apd_formApd_id}}</strong></div>
            @endif
        </div>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-primary" wire:click="CardSingleTemplateInputanApdSimpan">Simpan</button>
    </div>
</div>
<div class="card col-sm-12" id="card-form-periode">
    <div class="card-header">
        @if ($formEditMode)
            <h5>Detil Periode (ID Periode : {{$formIdPeriode_cache}})</h5>
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

        {{-- start alert status --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissable fade show" role="alert">
                {{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('danger'))
            <div class="alert alert-danger alert-dismissable fade show" role="alert">
                {{session('danger')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- end alert status --}}

        {{-- ID Periode --}}
        <div class="form-group">
            <label for="input-id-periode">ID Periode</label>
            <div class="input-group">
                <input type="text" class="form-control" id="input-id-periode" wire:model="formIdPeriode" @if(!$formEditId) disabled @endif >
                <div class="input-group-append">
                    <button class="btn btn-info" wire:click="$set('formEditId',1)">Ubah</button>
                </div>
            </div>
            <small class="form-text text-muted">Id periode akan di generate secara otomatis oleh sistem ketika disimpan. Namun jika anda ingin mengganti / membuat id baru untuk periode ini, silahkan klik ubah.</small>
        </div>
        {{-- Nama Periode --}}
        <div class="form-group">
            <label for="input-nama-periode">Nama Periode</label>
            <input type="text" class="form-control" id="input-nama-periode" wire:model="formNamaPeriode" wire:ignore.self>
        </div>
        {{-- Tanggal Awal --}}
        <div class="form-group">
            <label for="input-tanggal-awal">Tanggal Awal</label>
            <div class="input-group date" id="input-group-tanggal-awal" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#input-group-tanggal-awal" wire:model="formTglAwal" wire:ignore.self>
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
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" wire:model="formTglAkhir" wire:ignore.self>
                    <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        {{-- Pesan Berjalan --}}
        <div class="form-group">
            <label for="input-pesan-berjalan">Pesan Berjalan</label>
            <textarea type="textarea" class="form-control" id="input-pesan-berjalan" wire:model="formPesanBerjalan" wire:ignore.self></textarea>
        </div>
        {{-- switch Aktif --}}
        <div class="form-group">
            <label>Aktif ? </label>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="switch-periode-aktif" wire:model="formAktif" wire:ignore.self>
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
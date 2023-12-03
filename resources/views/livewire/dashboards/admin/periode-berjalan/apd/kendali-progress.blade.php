<div>
    <h4>Periode Berjalan : {{$nama_periode_berjalan}}</h4>  
    <div class="row">
        @if ($error_time_page)
        <div>
            <strong class="text-danger">Terjadi kesalahan saat inisiasi halaman. Silahkan refresh atau hubungin admin. ref : {{$error_time_page}}</strong>
        </div>
        @endif
        @if ($tampil_dropdown_wilayah)
            <div class="col">
                <div class="form-group">
                    <label>Wilayah</label>
                    <select class="form-control" id="wilayah" wire:model='model_dropdown_wilayah' wire:change='changeDropdownWilayah' >
                    <option value="" disabled>Silahkan Pilih</option>
                    @if ($opsi_dropdown_wilayah)
                        @foreach ($opsi_dropdown_wilayah as $item)
                            <option value="{{$item['value']}}">{{$item['text']}}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
            </div>
        @endif
        
            <div class="col" @if (!$tampil_dropdown_penempatan) style="visibility: hidden" @endif>
                <div class="form-group">
                    <label>Penempatan</label>
                    <select class="form-control" id="wilayah" wire:model='model_dropdown_penempatan' wire:change='changeDropdownPenempatan'>
                        <option value="" disabled>Silahkan Pilih</option>
                        @if ($opsi_dropdown_penempatan)
                            @foreach ($opsi_dropdown_penempatan as $item)
                                <option value="{{$item['value']}}">{{$item['text']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        
        
    </div>
    {{-- loading dropdown start --}}
    <div class="row" wire:loading wire:target='changeDropdownWilayah,changeDropdownPenempatan'>
        <div class="spinner-grow text-info" role="status" >
            <span class="sr-only">Memuat...</span>
        </div><span class="mx-2 text-info">Memuat Data ......</span>
    </div>
    <div class="row" wire:loading wire:target='kueriPegawai'>
        <div class="spinner-grow text-info" role="status" >
            <span class="sr-only">Memuat...</span>
        </div><span class="mx-2 text-info">Melakukan kueri pegawai ......</span>
    </div>
    <div class="row" wire:loading wire:target='hitungCapaian'>
        <div class="spinner-grow text-info" role="status" >
            <span class="sr-only">Memuat...</span>
        </div><span class="mx-2 text-info">Menghitung Capaian.....</span>
    </div>
    <div class="row" wire:loading wire:target='hitungRangkumanKeberadaan'>
        <div class="spinner-grow text-info" role="status" >
            <span class="sr-only">Memuat...</span>
        </div><span class="mx-2 text-info">Merangkum Keberadaan APD.....</span>
    </div>
    <div class="row" wire:loading wire:target='hitungRangkumanKerusakan'>
        <div class="spinner-grow text-info" role="status" >
            <span class="sr-only">Memuat...</span>
        </div><span class="mx-2 text-info">Merangkum Kerusakan APD.....</span>
    </div>
    {{-- loading dropdown end --}}
    @if ($model_dropdown_penempatan || $model_dropdown_wilayah == "semua")
        <div class="row">
            <h4>Rangkuman Inputan</h4>
        </div>
        @if (!is_null($error_time_capaian))
        <div class="row text-danger">
            <strong>Terjadi kesalahan saat menghitung capaian.</strong>
        </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Inputan </label>
                    <a href="#"><div class="progress progress-sm">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="{{$value_terinput_capaian}}" aria-valuemin="0" aria-valuemax="{{$value_max_capaian}}" style="width: {{($value_terinput_capaian > 0 && $value_max_capaian > 0)? round(($value_terinput_capaian/$value_max_capaian)*100,2) : 0}}%">
                    </div>
                    </div></a>
                    <small>
                        {{($value_terinput_capaian > 0 && $value_max_capaian > 0)? round(($value_terinput_capaian/$value_max_capaian)*100,2) : 0}}% Tercapai
                    </small>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Validasi</label>
                    <a href="#"><div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="{{$value_terverif_capaian}}" aria-valuemin="0" aria-valuemax="{{$value_max_capaian}}" style="width: {{($value_terverif_capaian > 0 && $value_max_capaian > 0)? round(($value_terverif_capaian/$value_max_capaian)*100,2) : 0}}%">
                        </div>
                    </div></a>
                    <small>
                        {{($value_terverif_capaian > 0 && $value_max_capaian > 0)? round(($value_terverif_capaian/$value_max_capaian)*100,2) : 0}}% Tercapai
                    </small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="card-title">
                            Rangkuman Keberadaan APD
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($error_time_keberadaan)
                            <div class="row text-danger">
                                <strong>Terjadi kesalahan saat menghitung rangkuman.</strong>
                            </div>
                        @endif
                        
                        <div class="row">
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="fas fa-check-double"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Ada</span>
                                        <span class="info-box-number">{{$value_keberadaan_ada}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning"><i class="fas fa-box-open"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Belum Dapat</span>
                                        <span class="info-box-number">{{$value_keberadaan_belum}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-danger"><i class="fas fa-question-circle"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Hilang</span>
                                        <span class="info-box-number">{{$value_keberadaan_hilang}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="card-title">
                            Rangkuman Kondisi APD
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($error_time_kerusakan)
                            <div class="row text-danger">
                                <strong>Terjadi kesalahan saat menghitung rangkuman.</strong>
                            </div>
                        @endif
                        
                        <div class="row">
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="fas fa-thumbs-up"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Baik</span>
                                        <span class="info-box-number">{{$value_kerusakan_baik}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-yellow"><i class="fas fa-feather-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Rusak Ringan</span>
                                        <span class="info-box-number">{{$value_kerusakan_ringan}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-orange"><i class="fas fa-battery-half"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Rusak Sedang</span>
                                        <span class="info-box-number">{{$value_kerusakan_sedang}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-danger"><i class="fas fa-window-close"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Rusak Berat</span>
                                        <span class="info-box-number">{{$value_kerusakan_berat}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#by-anggota" data-toggle="tab">Sortir by Personil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#by-inputan" data-toggle="tab">Sortir by Inputan</a></li>
                    </ul>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($model_dropdown_penempatan || $model_dropdown_wilayah == "semua")
                        <div class="tab-content">
                            <div class="tab-pane active" id="by-anggota">
                                @if ($pegawai_terakhir)
                                    <i><small class="text-muted">Pegawai terakhir yang dilihat : <strong>{{$pegawai_terakhir}}</strong></small></i>
                                @endif
                                <div class="col-lg-12">
                                    <livewire:dashboards.admin.periode-berjalan.apd.tabel-terinput-by-personil>
                                </div>
                            </div>
                            <div class="tab-pane" id="by-inputan">
                                <livewire:dashboards.admin.periode-berjalan.apd.tabel-terinput-by-inputan>
                            </div>
                        </div>
                    @else
                        <div class="jumbotron text-center">
                            <h4>Harap pilih penempatan terlebih dahulu.</h4>
                        </div>
                    @endif
                    
                </div>
                <!-- /.card-body -->
          </div>
        </div>
    </div>
</div>

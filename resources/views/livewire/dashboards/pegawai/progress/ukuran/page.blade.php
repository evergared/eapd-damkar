<div>
    @include('komponen.breadcrumbs',[ 'halamanJudul'=>'Progress Inputan Ukuran Anggota','halaman'=>'progress-ukuran'])
    <livewire:komponen.marquee>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Capaian Input Data Ukuran Anggota Anda</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if ($periode)
                    @if ($error_time)
                        <div class="jumbotron text-center">
                            <strong class="text-danger">Kesalahan saat menghitung capaian. ref : ({{$error_time}})</strong>
                        </div>
                    @else
                            <h4>Capaian Inputan {{ (auth()->user()->data->isPengendali())? 'Anggota Regu Anda' : auth()->user()->data->penempatan->nama_penempatan }}</h4>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="{{$max_inputan_semua_anggota}}" style="width: {{ ($value_inputan_semua_anggota > 0 && $max_inputan_semua_anggota >0)? round(($value_inputan_semua_anggota/$max_inputan_semua_anggota)*100,2) : 0}}%">
                                    </div>
                                </div>
                                <small>
                                    {{ ($value_inputan_semua_anggota > 0 && $max_inputan_semua_anggota >0)? 'Terinput '.round(($value_inputan_semua_anggota/$max_inputan_semua_anggota)*100,2).'%' : 'Belum ada data yang terinput'}}
                                </small><br><br><br>
                            <h4>Capaian Validasi {{ (auth()->user()->data->isPengendali())? 'Anggota Regu Anda' : auth()->user()->data->penempatan->nama_penempatan }}</h4>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-info progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="{{$max_inputan_semua_anggota}}" style="width: {{ ($value_tervalidasi_semua_anggota > 0 && $max_inputan_semua_anggota >0)? round(($value_tervalidasi_semua_anggota/$max_inputan_semua_anggota)*100,2) : 0}}%">
                                    </div>
                                </div>
                                <small>
                                    {{ ($value_tervalidasi_semua_anggota > 0 && $max_inputan_semua_anggota >0)? 'Terinput '.round(($value_tervalidasi_semua_anggota/$max_inputan_semua_anggota)*100,2).'%' : 'Belum ada data yang tervalidasi'}}
                                </small>
                    @endif
                    
                @else
                        <div class="jumbotron text-center">
                            <strong>Periode pengumpulan ukuran belum dibuka.</strong>
                        </div>
                @endif
                
            </div>
        </div>
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Progress Input Data Ukuran Anggota Anda</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if($periode)
                    <livewire:dashboards.pegawai.progress.apd.tabel-progress-ukuran-anggota>
                @else
                        <div class="jumbotron text-center">
                            <strong>Tidak ada yang dapat ditampilkan.</strong>
                        </div>
                @endif
            </div>
        </div>
    </section>

    <livewire:dashboards.pegawai.progress.apd.modal-kolom-profil-tabel-anggota>
    <livewire:dashboards.pegawai.progress.apd.modal-detail-progress-apd>
    


</div>

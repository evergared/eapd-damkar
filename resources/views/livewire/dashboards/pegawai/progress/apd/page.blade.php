<div>
    @include('komponen.breadcrumbs',[ 'halamanJudul'=>'Progress Inputan APD Anggota','halaman'=>'progress-apd'])
    <livewire:komponen.marquee>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Capaian Input Data APD Anggota Anda</h3>
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
                <div class="container">
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
                </div>
            </div>
        </div>
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Progress Input Data APD Anggota Anda</h3>
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
                <livewire:dashboards.pegawai.progress.apd.tabel-progress-apd-anggota>
            </div>
        </div>
    </section>

    

</div>

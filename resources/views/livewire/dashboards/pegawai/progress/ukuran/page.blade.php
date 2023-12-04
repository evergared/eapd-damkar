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
                    @if ($error_time_capaian)
                        <div class="jumbotron text-center">
                            <strong class="text-danger">Kesalahan saat menghitung capaian. ref : ({{$error_time_capaian}})</strong>
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

                <div wire:loading>
                    <div class="spinner-border text-info" role="status">
                        <span class="sr-only">Memuat...</span>
                    </div><span class="mx-2 text-info">Memuat...</span>
                </div>

                <div class="collapse show active" id="tabel-ukuran">
                    @if (session()->has('alert-warning'))
                        <div class="alert alert-warning alert-dismissable fade show" role="alert">
                            {{session('alert-warning')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if($periode)
                        <h5 class="mb-5">Dibawah ini daftar pegawai yang harus mengisi data ukuran.</h5>
                        <livewire:dashboards.pegawai.progress.ukuran.tabel-progress-ukuran-anggota>
                    @else
                            <div class="jumbotron text-center">
                                <strong>Tidak ada yang dapat ditampilkan.</strong>
                            </div>
                    @endif
                </div>
                <div class="collapse" id="detail-ukuran">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4 class="d-none d-sm-block">Detail Progress Pengisian Ukuran {{$nama_pegawai}}</h4>
                            </div>
                            <div class="card-tools">
                                <a href="javascript:" onclick="detailKeTabel()">
                                    <i class="fas fa-arrow-circle-left"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="content">
                                <h5>Terisi <strong>{{$detail_jumlah_ukuran_terisi}}</strong> dari <strong>{{$detail_butuh_isi_ukuran}}</strong> ukuran yang diminta.</h5>
                                @if ($detail_progress_ukuran)
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Ukuran</th>
                                                    <th>Ukuran Terinput</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($detail_progress_ukuran as $i => $item)
                                                    <tr>
                                                        <td>{{$i + 1}}</td>
                                                        <td>{{$item['jenis']}}</td>
                                                        <td>{{$item['value']}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <h5>Terisi <strong>{{$detail_jumlah_ukuran_terisi}}</strong> dari <strong>{{$detail_butuh_isi_ukuran}}</strong> ukuran yang diminta.</h5>
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
    </section>

    <livewire:dashboards.pegawai.progress.apd.modal-kolom-profil-tabel-anggota>
    <livewire:dashboards.pegawai.progress.apd.modal-detail-progress-apd>

    
    
    @push('stack-body')
        <script type="module">
            window.addEventListener('tabel-ke-detail', event=>{
            $('#tabel-ukuran').hide(500)
            $('#detail-ukuran').show(500)
        })

        function detailKeTabel()
        {
            $('#detail-ukuran').hide(500)
            $('#tabel-ukuran').show(500)
        }
        </script>
    @endpush

</div>

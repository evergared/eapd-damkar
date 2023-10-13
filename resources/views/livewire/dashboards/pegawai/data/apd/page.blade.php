<div>
    @include('komponen.breadcrumbs',[ 'halamanJudul'=>'Data APD Terinput','halaman'=>'data-apd'])
    <livewire:komponen.marquee>
    <div class="content">
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-title">
                    <h4>Pilih Periode Input Data APD</h4>
                </div>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control">
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Periode</label>
                            <select class="form-control">
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-secondary">
            <div class="card-header">
                <div class="card-title">
                    <h5>Tabel Input Data APD</h5>
                </div>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div wire:loading>
                    <div class="spinner-border text-info" role="status">
                        <span class="sr-only">Memuat...</span>
                    </div><span class="mx-2 text-info">Memuat...</span>
                </div>

                <div class="collapse show active" id="tabel-anggota">
                    <livewire:dashboards.pegawai.data.apd.tabel-list-anggota>
                </div>
                <div class="collapse" id="detail-input">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>Data APD </h4>
                            </div>
                            <div class="card-tools">
                                <a href="javascript:" onclick="detailKeTabel()">
                                    <i class="fas fa-arrow-circle-left"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center jumbotron">
                                Tidak ada yang dapat ditampilkan.
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>

    <livewire:dashboards.pegawai.data.apd.modal-kolom-profil-tabel-anggota>

    @push('stack-body')
    <script>
        window.addEventListener('tabel-ke-detail', event=>{
        $('#tabel-anggota').hide(500)
        $('#detail-input').show(500)
    })

    function detailKeTabel()
    {
        $('#detail-input').hide(500)
        $('#tabel-anggota').show(500)
    }
    </script>
@endpush

</div>

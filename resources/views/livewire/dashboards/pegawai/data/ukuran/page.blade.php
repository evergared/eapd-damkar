<div>
    @include('komponen.breadcrumbs',[ 'halamanJudul'=>'Data Ukuran Terinput','halaman'=>'data-ukuran'])
    <livewire:komponen.marquee>
    
    <div class="content">
        <div class="collapse show active" id="tabel-ukuran">
            <livewire:dashboards.pegawai.data.ukuran.tabel-list-anggota>
        </div>
        <div class="collapse" id="detail-ukuran">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>Data Ukuran {{$nama_pegawai}}</h4>
                    </div>
                    <div class="card-tools">
                        <a href="javascript:" onclick="detailKeTabel()">
                            <i class="fas fa-arrow-circle-left"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($data_detail_inputan)
                        <div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Jenis APD</th>
                                <th>Ukuran Terinput</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_detail_inputan as $item)
                                    <tr>
                                    <td>{{$item["index"]}}</td>
                                    <td>{{$item["nama"]}}</td>
                                    <td>{{$item["ukuran"]}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    @else
                        <div class="jumbotron text-center">
                            <h5>Tidak ada yang dapat ditampilkan</h5>
                        </div>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    <livewire:dashboards.pegawai.data.ukuran.modal-kolom-profil-tabel-anggota>

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

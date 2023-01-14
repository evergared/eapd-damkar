<div>
                    <div class="card my-n3 mx-n3" id="rekap-tabel">
                        <div class="card-header">
                            <h3 class="card-title">{{$nama_periode}}</h3>
                        </div>
                        <!-- /.card-header -->
                        @isset($data_rekap_apd)
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                                <table class="table text-nowrap">
                                    <thead class="text-center table-bordered" style="background-color: gray ;">
                                        <tr >
                                            <th rowspan="2" style="vertical-align:middle; background-color: gray ;">#</th>
                                            <th style="width:20%; vertical-align:middle; background-color: gray ;" rowspan="2" >Jenis APD</th>
                                            <th style="width:50%; background-color: gray ;" class="text-center" colspan="4">Kondisi</th>
                                            <th style="width:20%; background-color: gray ;" colspan="2">Keberadaan</th>
                                            <th style="width:10%; vertical-align:middle; background-color: gray ;" rowspan="2">SubTotal</th>
                                        </tr>
                                        <tr class="table-head-fixed">
                                            <th>Baik</th>
                                            <th>Rusak Ringan</th>
                                            <th>Rusak Sedang</th>
                                            <th>Rusak Berat</th>
                                            <th>Belum Terima</th>
                                            <th>Hilang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                        @foreach ($data_rekap_apd as $key => $item)
                                            <tr>
                                            <td class="text-center text-wrap my-auto align-middle">{{$key+1}}</td>
                                            <td class="text-center text-wrap my-auto align-middle">{{$item['jenis_apd']}}
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="rekapDetail('{{$item['id_jenis']}}','baik')" href="#rekap-tabel">{{$item['baik']}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="rekapDetail('{{$item['id_jenis']}}','rusak_ringan')" href="#rekap-tabel">{{$item['rusak_ringan']}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="rekapDetail('{{$item['id_jenis']}}','rusak_sedang')" href="#rekap-tabel">{{$item['rusak_sedang']}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="rekapDetail('{{$item['id_jenis']}}','rusak_berat')" href="#rekap-tabel">{{$item['rusak_berat']}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="rekapDetail('{{$item['id_jenis']}}','belum_terima')" href="#rekap-tabel">{{$item['belum_terima']}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="rekapDetail('{{$item['id_jenis']}}','hilang')" href="#rekap-tabel">{{$item['hilang']}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="rekapDetail('{{$item['id_jenis']}}','total')" href="#rekap-tabel">{{$item['total']}}</a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @endisset

                        @empty($data_rekap_apd)
                            <div class="card-body">
                                <div class="jumbotron text-center">
                                    Belum ada data yang tersedia untuk ditampilkan.
                                </div>
                            </div>
                        @endempty
                        
                        <!-- /.card-body -->
                    </div>

                    <!-- {{-- Card untuk preview saat user klik satu gambar start --}} -->
                    
                    <!-- {{-- Cart untuk preview saat user klik satu gambar end --}} -->

                    <!-- /.card -->



    <div class="collapse" id="rekapdetail" wire:ignore.self>
            <div class="card my-n3 mx-n3">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="card-title">Progress Rekap</h4>
                    </div>
                    <div class="card-tools">
                        <a href="javascript:" onclick="backToRekap()">&larr; <u>kembali</u></a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th style="width:20%;">Item</th>
                                <th style="width:20%;">Nama</th>
                                <th style="width:20%;">Penempatan</th>
                                <th style="width:50%; height: 60%;" class="text-center">Foto yang diupload
                                </th>
                                <th></th>
                                <th style="width:20%;">Kondisi</th>
                                <th style="width:20%;">Pesan</th>
                                <th style="width:20%;">Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="fire-jacket rusak-berat">
                                <td class="text-center text-wrap my-auto align-middle">1</td>
                                <td class="text-center text-wrap my-auto align-middle">Fire Jacket
                                </td>
                                <td class="text-center text-wrap my-auto align-middle">Agus Suripto</td>
                                <td class="text-center text-wrap my-auto align-middle">Kantor Sektor I</td>
                                <td>
                                    <div class=" d-none d-sm-block">
                                        <ul class="list-inline w-50">
                                            <li class="list-inline-item w-75 ">
                                                <a class="apd-foto" data-toggle="collapse"
                                                    data-target="#preview-foto-apd-anggota"
                                                    style="cursor: pointer;">
                                                    <img alt="Avatar" class="table-avatar w-75 h-75"
                                                        src="firejacket.jpg">
                                                </a>
                                            </li>
                                            <li class="list-inline-item w-75">
                                                <a class="apd-foto" data-toggle="collapse"
                                                    data-target="#preview-foto-apd-anggota"
                                                    style="cursor: pointer;">
                                                    <img alt="Avatar" class="table-avatar w-75 h-75"
                                                        src="firejacket.jpg">
                                                </a>
                                            </li>
                                            <li class="list-inline-item w-75">
                                                <a class="apd-foto" data-toggle="collapse"
                                                    data-target="#preview-foto-apd-anggota"
                                                    style="cursor: pointer;">
                                                    <img alt="Avatar" class="table-avatar w-75 h-75"
                                                        src="firejacket.jpg">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="text-center align-middle d-block d-sm-none">

                                        <button type="button" class="btn btn-primary btn-sm"
                                            data-toggle="collapse"
                                            data-target="#preview-semua-foto-apd-anggota">Lihat
                                            Foto</button>
                                    </div>

                                </td>
                                <td></td>
                                <td class="text-center align-middle">Rusak Berat</td>
                                <td class="text-center align-middle">
                                <input type="text" placeholder="Pesan">
                                </td>
                                <td class="text-center align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Validasi<span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                    <li><a >Terivalidasi</a></li>
                                    <li><a >Tolak</a></li>
                                    <li><a >Update</a></li>
                                    </ul>
                                </div>
                                </td>
                                <td class="text-center align-middle">
                                <a class="btn btn-app">
                                    <i class="fas fa-save"></i> Save
                                </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                                <!-- /.card-body -->

                            <!-- {{-- Card untuk preview saat user klik satu gambar start --}} -->
                            <div class="collapse" id="preview-foto-apd-anggota">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h5>Preview Gambar APD</h5>
                                        </div>
                                        <div class="card-tools">
                                            <button type="button" class="close" data-toggle="collapse"
                                                data-target="#preview-foto-apd-anggota" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        isinya satu gambar yang diklik
                                    </div>
                                </div>
                            </div>
                            <!-- {{-- Cart untuk preview saat user klik satu gambar end --}} -->

                            <!-- {{-- Card untuk preview saat viewport hp start --}} -->
                            <div class="collapse" id="preview-semua-foto-apd-anggota">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h5>Nama APD</h5>
                                        </div>
                                        <div class="card-tools">
                                            <button type="button" class="close" data-toggle="collapse"
                                                data-target="#preview-semua-foto-apd-anggota" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        isinya semua gambar yang diupload
                                    </div>
                                </div>
                            </div>
                            <!-- {{-- Card untuk preview saat viewport hp end --}} -->

                            <!-- /.card -->
                </div>
            </div>
            <!-- /.modal-content -->
        </div>

</div>
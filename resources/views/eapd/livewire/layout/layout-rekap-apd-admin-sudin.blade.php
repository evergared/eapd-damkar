<div>
    <div class="card my-n3 mx-n3" id="card-rekap" wire:ignore.self>
        <div class="card-header">
            <h3 class="card-title">{{$nama_periode}}</h3>
        </div>
        <!-- /.card-header -->
        @if(!empty($data_rekap_apd))
            <div class="card-body table-responsive p-0" style="height: 1000px;">
                <table class="table text-nowrap">
                    <thead class="text-center table-bordered" style="background-color: gray ;">
                        <tr >
                            <th rowspan="2" style="vertical-align:middle; background-color: gray ;">#</th>
                            <th style="width:20%; vertical-align:middle; background-color: gray ;" rowspan="2" >Jenis APD</th>
                            <th style="width:50%; background-color: gray ;" class="text-center" colspan="4">Kondisi</th>
                            <th style="width:20%; background-color: gray ;" colspan="3">Keberadaan</th>
                            <th style="width:10%; vertical-align:middle; background-color: gray ;" rowspan="2">SubTotal</th>
                            <th style="width:10%; vertical-align:middle; background-color: gray ;" rowspan="2">Distribusi</th>
                        </tr>
                        <tr class="table-head-fixed">
                            <th>Baik</th>
                            <th>Rusak Ringan</th>
                            <th>Rusak Sedang</th>
                            <th>Rusak Berat</th>
                            <th>Belum Terima</th>
                            <th>Hilang</th>
                            <th>Diterima</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                        @foreach ($data_rekap_apd as $key => $item)
                            <tr>
                            <td class="text-center text-wrap my-auto align-middle">{{$key+1}}</td>
                            <td class="text-center text-wrap my-auto align-middle">{{$item['jenis_apd']}}
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap(['{{$item['id_jenis']}}','kondisi','baik'])" href="#card-rekap">{{$item['baik']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap(['{{$item['id_jenis']}}','kondisi','rusak ringan'])" href="#card-rekap">{{$item['rusak_ringan']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap(['{{$item['id_jenis']}}','kondisi','rusak sedang'])" href="#card-rekap">{{$item['rusak_sedang']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap(['{{$item['id_jenis']}}','kondisi','rusak berat'])" href="#card-rekap">{{$item['rusak_berat']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap(['{{$item['id_jenis']}}','keberadaan','Belum Terima'])" href="#card-rekap">{{$item['belum_terima']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap(['{{$item['id_jenis']}}','keberadaan','Hilang'])" href="#card-rekap">{{$item['hilang']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap(['{{$item['id_jenis']}}','keberadaan','Ada'])" href="#card-rekap">{{$item['ada']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap(['{{$item['id_jenis']}}','total','total'])" href="#card-rekap">{{$item['total']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap(['{{$item['id_jenis']}}','distribusi','distribusi'])" href="#card-rekap">{{$item['distribusi']}}</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif

        @empty($data_rekap_apd)
            <div class="card-body">
                <div class="jumbotron text-center">
                    Belum ada data yang tersedia untuk ditampilkan.
                </div>
            </div>
        @endempty
        <!-- /.card-body -->
    </div>

    <div class="collapse" id="collapse-detail-rekap">
            <div class="card my-n3 mx-n3">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="card-title">Progress Rekap</h4>
                    </div>
                    <div class="card-tools">
                        <a href="javascript:" onclick="hideDetailRekapApdAdminSudin()">&larr; <u>kembali</u></a>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('eapd.datatable.tabel-detil-rekap-apd-admin-sudin')
                </div>
                {{-- <div class="card-body table-responsive p-0" style="height: 300px;">
                    @if (!empty($detail_data_rekap))
                        <table class="table table-head-fixed text-nowrap">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th style="width:20%;">Item</th>
                                    <th style="width:20%;">Nama</th>
                                    <th style="width:20%;">Penempatan</th>
                                    <th style="width:50%; height: 60%;" class="text-center">Foto yang diupload
                                    </th>
                                    <th style="width:20%;">Kondisi</th>
                                    <th style="width:20%;">Verifikasi</th>
                                    <th style="width:20%;">Komentar Pengupload</th>
                                    <th>Komentar Verifikator</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail_data_rekap as $key => $item)
                                    <tr class="fire-jacket rusak-berat">
                                        <td class="text-center text-wrap my-auto align-middle">{{$key+1}}</td>
                                        <td class="text-center text-wrap my-auto align-middle">{{$item['nama_jenis']}}
                                        </td>
                                        <td class="text-center text-wrap my-auto align-middle"><strong>{{$item['nama_pegawai']}}</strong></td>
                                        <td class="text-center text-wrap my-auto align-middle">{{$item['penempatan']}}</td>
                                        <td>
                                            <div class=" d-none d-sm-block">

                                                @if (!empty($item['gambar']))
                                                        @if (is_array($item['gambar']))
                                                            <ul class="list-inline w-50">

                                                                @foreach ($item['gambar'] as $gbr)
                                                                    <li class="list-inline-item w-75 ">
                                                                            <a class="apd-foto" data-toggle="collapse"
                                                                                data-target="#preview-foto-apd-anggota"
                                                                                style="cursor: pointer;">
                                                                                <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                                    src="{{asset($gbr)}}">
                                                                            </a>
                                                                        </li> 
                                                                    @endforeach
                                                            </ul>
                                                        @else
                                                            <a class="apd-foto" data-toggle="collapse"
                                                                data-target="#preview-foto-apd-anggota"
                                                                style="cursor: pointer;">
                                                                <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                    src="{{asset($item['gambar'])}}">
                                                            </a>
                                                        @endif
                                                @endif

                                                @empty($item['gambar'])
                                                    <div class="text-center">
                                                        Tidak ada gambar yang diupload.
                                                    </div>
                                                @endempty
                                                
                                            </div>
                                            <div class="text-center align-middle d-block d-sm-none">
                                                @if (!empty($item['gambar']))
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="collapse"
                                                        data-target="#preview-semua-foto-apd-anggota">Lihat
                                                        Foto</button>
                                                @endif

                                                @empty($item['gambar'])
                                                    <div>
                                                        Tidak ada gambar yang diupload.
                                                    </div>
                                                @endempty
                                                
                                            </div>

                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge badge-sm bg-{{$item['kondisi_warna']}}">{{$item['kondisi_status']}}</span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge badge-sm bg-{{$item['verifikasi_warna']}}">{{$item['verifikasi_status']}}</span>
                                        </td>
                                        <td class="text-center align-middle">
                                            {{$item['komentar_pengupload']}}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{$item['komentar_verifikator']}}
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    @endif

                    @empty($detail_data_rekap)
                        <div class="jumbotron text-center">
                            Belum ada data yang dapat ditampilkan.
                        </div>
                    @endempty
                    
                                <!-- /.card-body -->

                            

                            <!-- /.card -->
                </div> --}}
            </div>
            <!-- /.modal-content -->

            <!-- {{-- Card untuk preview saat user klik satu gambar start --}} -->
                <div class="collapse" id="preview-foto-apd-anggota">
                    <div class="card mt-5">
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
                    <div class="card mt-5">
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

        </div>



        {{-- Javascript --}}
        @once
            <script>
                window.addEventListener('showDetailRekapApdAdminSudin',event=>{
                    $('#card-rekap').hide(500)
                    $('#collapse-detail-rekap').collapse('show')
                })

                window.addEventListener('hideDetailRekapApdAdminSudin',event=>{
                    $('#card-rekap').show(500)
                    $('#collapse-detail-rekap').collapse('hide')
                })

                function hideDetailRekapApdAdminSudin()
                {
                    $('#card-rekap').show(500)
                    $('#collapse-detail-rekap').collapse('hide')
                }
            </script>
        @endonce
</div>

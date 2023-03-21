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
                                <a wire:click="detailRekap('{{$item['id_jenis']}}','baik')" href="#card-rekap">{{$item['baik']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap('{{$item['id_jenis']}}','rusak_ringan')" href="#card-rekap">{{$item['rusak_ringan']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap('{{$item['id_jenis']}}','rusak_sedang')" href="#card-rekap">{{$item['rusak_sedang']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap('{{$item['id_jenis']}}','rusak_berat')" href="#card-rekap">{{$item['rusak_berat']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap('{{$item['id_jenis']}}','belum_terima')" href="#card-rekap">{{$item['belum_terima']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap('{{$item['id_jenis']}}','hilang')" href="#card-rekap">{{$item['hilang']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap('{{$item['id_jenis']}}','ada')" href="#card-rekap">{{$item['ada']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap('{{$item['id_jenis']}}','total')" href="#card-rekap">{{$item['total']}}</a>
                            </td>
                            <td class="text-center align-middle">
                                <a wire:click="detailRekap('{{$item['id_jenis']}}','distribusi')" href="#card-rekap">{{$item['distribusi']}}</a>
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
            </script>
        @endonce
</div>

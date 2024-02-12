<div>
    <div class="content">
        <h4>Periode Berjalan : {{$nama_periode_berjalan}}</h4>
        <div class="row overlay-wrapper">
            @if ($error_time_page)
            <div class="overlay">
                <strong>Terjadi kesalahan saat inisiasi halaman. ref : {{$error_time_page}}</strong>
            </div>
            @endif
            @if ($tampil_dropdown_wilayah)
                <div class="col">
                    <div class="form-group">
                        <label>Wilayah</label>
                        <select class="form-control" id="wilayah" wire:model='model_dropdown_wilayah' wire:change='changeDropdownWilayah'>
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
                    <select class="form-control" id="wilayah" wire:model='model_dropdown_penempatan' wire:change='changeDropdownPenempatan' >
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
        <div class="row" wire:loading wire:target='changeDropdownWilayah, changeDropdownPenempatan'>
            <div class="spinner-grow text-info" role="status">
                <span class="sr-only">Memuat...</span>
            </div><span class="mx-2 text-info">Memuat data......</span>
        </div>
        {{-- loading dropdown end --}}
        @if ($model_dropdown_penempatan != '' || $model_dropdown_wilayah == "semua")
            @if (!is_null($data_rekap) && is_array($data_rekap))
                {{-- tombol export --}}
                <div class="row my-2">
                    <button class="btn btn-sm btn-default mx-1" wire:click="printPdf">Export ke PDF</button>
                    {{-- <button class="btn btn-sm btn-default mx-1">Export ke XLS</button> --}}
                </div>
                {{-- tabel rekap --}}
                <div class="row">
                    <div class="table-responsive p-0" style="height: 1000px;">
                        <table class="table text-nowrap">
                            <thead class="text-center table-bordered" style="background-color: gray ;">
                                <tr >
                                    <th rowspan="2" style="vertical-align:middle; background-color: gray ;">#</th>
                                    <th style="width:20%; vertical-align:middle; background-color: gray ;" rowspan="2" >Jenis APD</th>
                                    <th style="width:50%; background-color: gray ;" class="text-center" colspan="4">Kondisi</th>
                                    <th style="width:20%; background-color: gray ;" colspan="3">Keberadaan</th>
                                    <th style="width:10%; vertical-align:middle; background-color: gray ;" rowspan="2">SubTotal</th>
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
                                    @foreach ($data_rekap as $index => $item)
                                        <tr>
                                            <td class="text-center text-wrap my-auto align-middle">{{$index + 1}}</td>
                                            <td class="text-center text-wrap my-auto align-middle">{{$item['jenis_apd']}}</td>
                                            <td class="text-center align-middle">
                                                <a onclick="detailRekapitulasi()" href="javascript:" wire:click="detailJumlah(['{{$item['id_jenis']}}','baik'])">{{$item['baik']}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="#" href="javascript:" wire:click="detailJumlah(['{{$item['id_jenis']}}','rusak ringan'])">{{$item['rusak_ringan']}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="#" href="javascript:" wire:click="detailJumlah(['{{$item['id_jenis']}}','rusak sedang'])">{{$item['rusak_sedang']}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="#" href="javascript:" wire:click="detailJumlah(['{{$item['id_jenis']}}','rusak berat'])">{{$item['rusak_berat']}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="#" href="javascript:" wire:click="detailJumlah(['{{$item['id_jenis']}}','Belum Terima'])">{{$item['belum_terima']}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="#" href="javascript:" wire:click="detailJumlah(['{{$item['id_jenis']}}','Hilang'])">{{$item['hilang']}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="#" href="javascript:" wire:click="detailJumlah(['{{$item['id_jenis']}}','ada'])">{{$item['ada']}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a onclick="#" href="javascript:" wire:click="detailJumlah(['{{$item['id_jenis']}}','total'])">{{$item['total']}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                
                                
                
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="jumbotron text-center">
                    Belum ada data masuk
                </div>
            @endif
            
        @else
            <div class="jumbotron text-center">
                Harap pilih penempatan terlebih dahulu.
            </div>
        @endif
    </div>
    
</div>

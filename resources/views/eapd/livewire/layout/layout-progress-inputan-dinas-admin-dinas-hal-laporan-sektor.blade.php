 <div  wire:ignore.self>
    <div class="card my-n3 mx-n3" id="input-sudin"  wire:ignore.self>

        <div class="form-group my-3 mx-3">
            <label for="select-sudin">Data Inputan Sudin</label>
            <select id="select-sudin" class="custom-select" wire:model="wilayah_yang_ditampilkan" wire:change="muatDataInputanSudin">
                <option value="" disabled>Pilih Sudin</option>
                @foreach ($list_sudin as $sudin)
                    <option value="{{$sudin["value"]}}">{{$sudin["text"]}}</option>
                @endforeach
            </select>

            {{-- Status Start --}}
            <div wire:loading='muatDataInputanSudin'>
                <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                <small class="text-info"> Memuat data sudin dan sektor..</small>
            </div>
            {{-- Status End --}}

        </div>

        
        

        @if ($wilayah_yang_ditampilkan)
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
                @if (!empty($data_semua_sektor))
                    @foreach ($data_semua_sektor as $data_sektor)
                        <div class="card bg-light d-flex flex-fill">
                            @if ($data_sektor['nomor_sektor'] != "")
                                <div class="card-header text-muted border-bottom-0">
                                    {{$data_sektor['nomor_sektor']}}
                                </div>
                            @endif
                            
                            <div class="card-body table-responsive ">
                                <h2 class="lead"><b>{{$data_sektor['nama_sektor']}}</b></h2>
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">
                                                Pos
                                            </th>
                                            <th style="width: 5%">
                                                Jumlah PNS
                                            </th>
                                            <th style="width: 5%">
                                                Jumlah PJLP
                                            </th>
                                            <th style="width: 10%">
                                                Terinput(%)
                                            </th>
                                            <th style="width: 10%">
                                                Tervalidasi(%)
                                            </th>
                                            <th style="width: 10%">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_sektor['data_pos'] as $pos)
                                            <tr>
                                                <td>
                                                    {{$pos['nama_pos']}}
                                                </td>
                                                <td>
                                                    {{$pos['pegawai_asn']}}
                                                </td>
                                                <td>
                                                    {{$pos['pegawai_pjlp']}}
                                                </td>
                                                
                                                <td class="project-state">
                                                        <span class="badge badge-success">
                                                            @if ($pos['perlu_diinput'] > 0)
                                                                {{round(($pos['telah_diinput']/$pos['perlu_diinput']) * 100, 2 )}} %
                                                            @else
                                                                0 %
                                                            @endif
                                                        </span>
                                                </td>
                                                
                                                <td class="project-state">
                                                    <span class="badge badge-info">
                                                        @if ($pos['perlu_diinput'] > 0)
                                                            {{round(($pos['telah_diverif']/$pos['perlu_diinput']) * 100, 2 )}} %
                                                        @else
                                                            0 %
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <a wire:click="aksiSudin('{{$pos['id_pos']}}')" class="btn btn-sm bg-teal">
                                                        <i class="fas fa-wrench"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>    
                        </div>
                    @endforeach
                @else
                    <div class="jumbotron text-center">
                        Tidak ada data yang ditampilkan.
                    </div>
                @endif
                
                </div>
            </div>
        @else
            <div class="jumbotron text-center">
                Silahkan pilih sudin yang akan ditampilkan.
            </div>
        @endif
            </div>                



        <div class="collapse" id="aksisudin" wire:ignore.self>
            <div class="card my-n3 mx-n3">
                {{-- Status Start --}}
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                <small class="text-info"> Memuat data..</small>
            </div>
            {{-- Status End --}}
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="card-title">Progress Rekap</h4>
                    </div>
                    <div class="card-tools">
                        <a href="javascript:" onclick="backToSudin()">&larr; <u>kembali</u></a>
                    </div>
                </div>
                @if (!empty($data_detail_pos))
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th style="width:20%;">Nama</th>
                                        <th style="width:20%;">Jabatan</th>
                                        <th style="width:20%;">Input(%)</th>
                                        <th style="width:20%;">Validasi(%)</th>
                                        <th style="width:20%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- todo : multisort array
                                        ref :   https://stackoverflow.com/questions/2699086/how-to-sort-a-multi-dimensional-array-by-value
                                                https://www.php.net/manual/en/array.sorting.php
                                     --}}
                                    @foreach ($data_detail_pos as $key => $item)
                                        <tr class="fire-jacket rusak-berat">
                                            <td class="text-center text-wrap my-auto align-middle">{{$key + 1}}</td>
                                            <td class="text-center text-wrap my-auto align-middle">{{$item['nama_pegawai']}}</td>
                                            <td class="text-center text-wrap my-auto align-middle">{{$item['jabatan_pegawai']}}</td>
                                            
                                            <td class="project-state text-center text-wrap my-auto align-middle">
                                                <span class="badge badge-secondary">{{$item['terinput']}} %</span>
                                            </td>
                                            <td class="project-state text-center text-wrap my-auto align-middle">
                                                <span class="badge badge-secondary">{{$item['terverif']}}%</span>
                                            </td>
                                            <td class="text-center text-wrap my-auto align-middle">
                                                <a class="btn btn-sm bg-teal" onClick=modal("modal-progres-sudin","{{$item['id_pegawai']}}","ModalProgressSudin")>
                                                    <i class="fas fa-pencil-square-o">Edit</i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>                
                @else
                       
                    <div class="jumbotron text-center">
                        Tidak ada data yang dapat ditampilkan.
                    </div>
                                     
                @endif

                
            </div>
        </div>
</div>


<div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>Detail Input {{$detail_by_personil_nama_pegawai}}</h4>
            </div>
            <div class="card-tools">
                <button class="btn-primary btn-sm" onclick="detailProgressKeKendali()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="modal-body">
                    {{-- Start bagian untuk alert --}}
                    <div>
                        {{-- Alert untuk gagal --}}
                        @if (session()->has('alert-danger'))
                            <div class="alert alert-danger alert-dismissable fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('alert-danger')}}
                            </div>
                            </div>
                        @endif
                    </div>
                    {{-- End bagian untuk alert --}}

                    {{-- Start bagian untuk tabel --}}
                    <div class="card mx-n3 mt-n3">
                        <div class="collapse active show" id="list-inputan" wire:ignore.self>
                            @if (!empty($detail_by_personil_data_inputan))
                                <div class="table-responsive p-0">
                                <table class="table text-nowrap">
                                    <thead class="text-center align-middle">
                                        <tr>
                                            <th>#</th>
                                            <th style="width: 20%;">Item</th>
                                            <th class="text-center">Foto yang diupload</th>
                                            <th style="width: 18%;">No Seri</th>
                                            <th style="width: 18%;">Keterangan APD</th>
                                            <th class="text-center" style="width:20%;">Verifikasi APD</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{-- Start generate isian table --}}
                                    @foreach ($detail_by_personil_data_inputan as $index => $item)
                                        
                                        <tr>
                                        
                                        <td class="text-center text-wrap my-auto align-middle">{{$index + 1}}</td>
                                        <td class="text-center text-wrap my-auto align-middle">
                                            <strong>
                                                @if (is_null($item['index_duplikat']))
                                                    {{$item['nama_jenis']}}
                                                @else
                                                    @if (is_null($item['keterangan_jenis_apd_template']))
                                                        {{$item['nama_jenis']}}
                                                    @else
                                                        {{$item['keterangan_jenis_apd_template']}}
                                                    @endif
                                                    
                                                @endif
                                            </strong>
                                        </td>
                                        <td class="text-center my-auto align-middle">
                                            {{-- Start tampilan gambar inputan pegawai --}}
                                            @if(is_array($item['gambar_apd']) && count($item['gambar_apd']))
                                            {{-- Saat ada gambar dan berisi lebih dari satu --}}
                                            <div class="align-middle">
                                                <ul class="list-inline w-50 d-none d-sm-block text-center">
                                                @foreach ($item['gambar_apd'] as $index_gbr => $gbr)
                                                    <a class="apd-foto" href="{{asset($path_gambar . $gbr)}}" data-toggle="lightbox" data-title="Gambar APD {{$item['nama_jenis']}}" data-gallery="apd-{{$index}}" style="cursor: pointer;">
                                                        <img alt="APD" class="table-avatar w-25 h-25" src="{{asset($path_gambar . $gbr)}}">
                                                    </a>
                                                @endforeach
                                                </ul>
                                            </div>
                                            <a class="btn btn-primary d-block d-sm-none" href="{{asset($path_gambar . $gbr)}}" data-toggle="lightbox" data-title="Gambar APD {{$item['nama_jenis']}}" data-gallery="apd-{{$index}}"><i class="fas fa-image"></i></a>
                                            @elseif(is_string($item['gambar_apd']) && $item['gambar_apd'] != "")
                                            {{-- Saat ada gambar dan berisi hanya satu --}}
                                            <a class="apd-foto d-none d-sm-block" href="{{asset($path_gambar . $item['gambar_apd'])}}" data-toggle="lightbox" data-title="Gambar APD {{$item['nama_jenis']}}" data-gallery="apd-{{$index}}" style="cursor: pointer;">
                                                <img alt="APD" class="table-avatar w-25 h-25 d-none d-sm-block" src="{{asset($path_gambar . $item['gambar_apd'])}}">
                                            </a>
                                            <a class="btn btn-primary d-block d-sm-none" href="{{asset($path_gambar . $item['gambar_apd'])}}" data-toggle="lightbox" data-title="Gambar APD {{$item['nama_jenis']}}" data-gallery="apd-{{$index}}" style="cursor: pointer;"><i class="fas fa-image"></i></a>
                                            @elseif(!$item['gambar_apd'])
                                            {{-- Saat tidak ada gambar --}}
                                            Tidak ada gambar yang diupload.
                                            @endif
                                            {{-- End tampilan gambar inputan pegawai --}}
                                        </td>
                                        <td class="text-center text-wrap my-auto align-middle">
                                            {{(is_null($item['no_seri']))?'-' : $item['no_seri']}}
                                        </td>
                                        <td class="text-center text-wrap my-auto align-middle">
                                            <div class="row my-n2">
                                                <small class="d-none d-sm-block"><strong>Waktu Isi : </strong></small>
                                            </div>
                                            <div class="row my-n2">
                                            {{$item['data_terakhir_update']}}
                                            </div>
                                            <div class="row my-n2">
                                                <small class="d-none d-sm-block"><strong>Kondisi : </strong></small><span class="mx-1 badge badge-{{$item['warna_kerusakan']}} text-center text-wrap my-auto align-middle">{{$item['status_kerusakan']}}</span>
                                            </div>
                                            <div class="row my-n2">
                                                <small class="d-none d-sm-block"><strong>Komentar Pengupload : </strong></small>
                                                <small class="d-block d-sm-none"><strong>Komentar : </strong></small>
                                            </div>
                                            <div class="row my-n2">
                                                <p class="mx-1 my-auto align-middle"><small>{{($item['komentar_pengupload'])? $item['komentar_pengupload'] : " - "}}</small></p>
                                            </div>
                                        </td>
                                        <td class="text-center text-wrap my-auto align-middle">
                                            <div class="row my-n2">
                                                <small class="d-none d-sm-block"><strong>Waktu Verif : </strong></small>
                                            </div>
                                            <div class="row my-n2">
                                            {{$item['verifikasi_terakhir_update']}}
                                            </div>
                                            <div class="row my-n2">
                                                <small class="d-none d-sm-block"><strong>Status : </strong></small><span class="mx-1 badge badge-{{$item['warna_verifikasi']}} text-center text-wrap my-auto align-middle">{{$item['status_verifikasi']}}</span>
                                            </div>
                                            <div class="row my-n2">
                                                <small class="d-none d-sm-block"><strong>Komentar Verifikator : </strong></small>
                                                <small class="d-block d-sm-none"><strong>Komentar :</strong></small>
                                            </div>
                                            <div class="row my-n2">
                                                <p class="mx-1 my-auto align-middle"><small>{{($item['komentar_verifikator'])?$item['komentar_verifikator'] : " - "}}</small></p>
                                            </div>
                                        </td>
                                        <td class="text-center text-wrap my-auto align-middle">
                                            <button type="button" class="btn btn-secondary" wire:click='detailByPersonilLihatDetail("{{$index}}")' onclick="listInputanKeDetailInputan()">Detail</button>
                                        </td>
                                        </tr>
                                    @endforeach
                                    {{-- End generate isian table --}}
                                    </tbody>
                                </table>
                                </div>
                            @else
                                <div class="jumbotron text-center">
                                    <h4>Tidak ada yang di input.</h4>
                                </div>
                            @endif
                        </div>
                        <div class="collapse" id="detail-inputan" wire:ignore.self>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h4 class="d-none d-sm-block">Detail Inputan {{$detail_by_personil_entry_nama_apd}}</h4>
                                        <h5 class="d-block d-sm-none">Detail Inputan {{$detail_by_personil_entry_nama_apd}}</h5>
                                    </div>
                                    <div class="card-tools">
                                        <a href="javascript:" onclick="detailInputanKeListInputan()">
                                            <i class="fas fa-arrow-circle-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                
                                    {{-- Status Start --}}
                                    <div wire:loading='detailByPersonilLihatDetail'>
                                        <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                                        <small class="text-info"> Memuat data..</small>
                                    </div>
                                    {{-- Status End --}}

                                    
                
                                {{-- Start jika detail dapat diambil --}}
                                @if (!is_null($detail_by_personil_entry_detail))
                                    <div class="row">
                                    {{-- Start tampilan gambar --}}
                                    <div class="col-12 col-sm-6">
                                        <div class="card">
                
                                        {{-- nav tabs --}}
                                        <div class="card-header">
                                            <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="gambar-user-tab" role="tab" aria-selected="true" data-toggle="pill" 
                                                aria-controls="gambar-user-tab-content" href="#gambar-user-tab-content">Gambar yang diupload</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="gambar-apd-tab" role="tab" aria-selected="false" data-toggle="pill"
                                                aria-controls="gambar-apd-tab-content" href="#gambar-apd-tab-content">Gambar APD</a>
                                            </li>
                                            </ul>
                                        </div>
                
                                        {{-- tab content --}}
                                        <div class="card-body">
                                            <div class="tab-content">
                                            {{-- Start gambar apd user --}}
                                            <div class="tab-pane fade active show" id="gambar-user-tab-content" role="tabpanel" aria-labelledby="gambar-user-tab" wire:ignore.self>
                                                {{-- Start jika gambar user ada --}}
                                                @if (!is_null($detail_by_personil_entry_detail['gambar_apd']))
                                                    {{-- Start jika ada lebih dari satu --}}
                                                    @if (is_array($detail_by_personil_entry_detail['gambar_apd']) && count($detail_by_personil_entry_detail['gambar_apd']) > 1)
                                                        
                                                        {{-- Script untuk preview gambar apd Start--}}
                                                        <script>
                                                            $(document).ready(function() {
                                                        $('.apd-user.product-image-thumb').on('click', function () {
                                                            var $image_element = $(this).find('img')
                                                            $('.apd-user-preview.product-image').prop('src', $image_element.attr('src'))
                                                            $('.apd-user.product-image-thumb.active').removeClass('active')
                                                            $(this).addClass('active')
                                                            })
                                                        })
                                                        </script>
                                                        {{-- Script untuk preview gambar apd End--}}
                
                                                        <img class="apd-user-preview product-image"
                                                        src="{{asset($path_gambar . $detail_by_personil_entry_detail['gambar_apd'][0])}}" alt="Gambar Apd Anda">
                                                        <div class="col-12 apd-user product-image-thumbs">
                                                            @foreach ($detail_by_personil_entry_detail['gambar_apd'] as $key => $gbr)
                                                                @if($key === array_key_first($detail_by_personil_entry_detail['gambar_apd']))
                                                                <div class="apd-user product-image-thumb active"><img
                                                                        src="{{asset($path_gambar . $gbr)}}" alt="APD">
                                                                </div>
                                                                @else
                                                                <div class="apd-user product-image-thumb"><img
                                                                        src="{{asset($path_gambar . $gbr)}}" alt="APD">
                                                                </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    {{-- End jika ada lebih dari satu --}}
                                                    
                                                    {{-- Start jika hanya ada satu gambar --}}
                                                    @elseif(is_string($detail_by_personil_entry_detail['gambar_apd']) && $detail_by_personil_entry_detail['gambar_apd'] != "")
                                                        <img src="{{asset($path_gambar . $detail_by_personil_entry_detail['gambar_apd'])}}" class="img-thumbnail" alt="APD">
                                                    {{-- End jika hanya ada satu gambar --}}
                
                                                    {{-- Start antisipasi gambar tidak null tetapi tidak ada gambar --}}
                                                    @else
                                                    <div class="jumbotron text-center">
                                                        Tidak ada gambar yang diunggah.
                                                    </div>
                                                    {{-- End antisipasi gambar tidak null tetapi tidak ada gambar --}}
                
                                                    @endif
                                                {{-- End jika gambar user ada --}}
                
                                                {{-- Start jika tidak ada gambar user --}}
                                                @elseif(is_null($detail_by_personil_entry_detail['gambar_apd']) || $detail_by_personil_entry_detail['gambar_apd'] === "")
                                                <div class="jumbotron text-center">
                                                    Tidak ada gambar yang diunggah.
                                                </div>
                                                @else
                                                <div class="jumbotron text-center">
                                                    Tidak ada gambar yang diunggah.
                                                </div>
                                                {{-- End jika tidak ada gambar user --}}
                                                @endif
                                            </div>
                                            {{-- End gambar apd user --}}
                
                                            {{-- Start gambar apd template --}}
                                            <div class="tab-pane fade" id="gambar-apd-tab-content" role="tabpanel" aria-labelledby="gambar-apd-tab" wire:ignore.self>
                                                {{-- Start jika gambar template ada --}}
                                                @if (!is_null($gambar_apd_template))
                                                    {{-- Start jika ada lebih dari satu --}}
                                                    @if (is_array($gambar_apd_template) && count($gambar_apd_template) > 1)
                                                        
                                                        {{-- Script untuk preview gambar apd Start--}}
                                                        <script>
                                                            $(document).ready(function() {
                                                        $('.apd-template.product-image-thumb').on('click', function () {
                                                            var $image_element = $(this).find('img')
                                                            $('.apd-template-preview.product-image').prop('src', $image_element.attr('src'))
                                                            $('.apd-template.product-image-thumb.active').removeClass('active')
                                                            $(this).addClass('active')
                                                            })
                                                        })
                                                        </script>
                                                        {{-- Script untuk preview gambar apd End--}}
                
                                                        <img class="apd-template-preview product-image"
                                                        src="{{asset($gambar_apd_template[0])}}" alt="Gambar Apd Anda">
                                                        <div class="col-12 apd-template product-image-thumbs">
                                                            @foreach ($gambar_apd_template as $key => $gbr)
                                                                @if($key === array_key_first($gambar_apd_template))
                                                                <div class="apd-template product-image-thumb active"><img
                                                                        src="{{asset($path_gambar . $gbr)}}" alt="APD">
                                                                </div>
                                                                @else
                                                                <div class="apd-template product-image-thumb"><img
                                                                        src="{{asset($path_gambar . $gbr)}}" alt="APD">
                                                                </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    {{-- End jika ada lebih dari satu --}}
                                                    
                                                    {{-- Start jika hanya ada satu gambar --}}
                                                    @elseif(is_string($gambar_apd_template) && $gambar_apd_template != "")
                                                        <img src="{{asset($path_gambar . $gambar_apd_template)}}" class="img-thumbnail" alt="APD">
                                                    {{-- End jika hanya ada satu gambar --}}
                
                                                    {{-- Start antisipasi gambar tidak null tetapi tidak ada gambar --}}
                                                    @else
                                                    <div class="jumbotron text-center">
                                                        Tidak ada gambar yang disediakan.
                                                    </div>
                                                    {{-- End antisipasi gambar tidak null tetapi tidak ada gambar --}}
                                                    @endif
                                                {{-- End jika gambar template ada --}}
                
                                                {{-- Start jika tidak ada gambar template --}}
                                                @elseif(is_null($gambar_apd_template) || $gambar_apd_tempate === "")
                                                <div class="jumbotron text-center">
                                                    Tidak ada gambar yang disediakan.
                                                </div>
                                                @else
                                                <div class="jumbotron text-center">
                                                    Tidak ada gambar yang disediakan.
                                                </div>
                                                {{-- End jika tidak ada gambar template --}}
                                                @endif
                                            </div>
                                            {{-- End gambar apd template --}}
                
                                            </div>
                                        </div>
                
                                        </div>
                                    </div>
                                    {{-- End tampilan gambar --}}
                
                                    {{-- Start tampilan data --}}
                                    <div class="col-12 col-sm-6">
                                        {{-- data inputan dari user --}}
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="mt-5 d-block d-sm-none">Nomer Seri APD</h4>
                                                <h4 class="d-none d-sm-block">Nomer Seri APD</h4>
                                            </div>
                                            <div class="card-body">
                                                {{(is_null($detail_by_personil_entry_detail['no_seri']))? '-' : $detail_by_personil_entry_detail['no_seri']}}
                                            </div>
                                        </div>
                                        <div class="card">
                                        <div class="card-header">
                                            <h4 class="mt-5 d-block d-sm-none">Data Inputan</h4>
                                            <h4 class="d-none d-sm-block">Data Inputan</h4>
                                        </div>
                                        <div class="card-body">
                                            
                                            <div class="row mb-2">
                                            <div class="col-sm">
                                                <div>
                                                <div>
                                                    <strong>Keberadaan :</strong>
                                                </div>
                                                <div class="text-center align-middle">
                                                    <span class="badge badge-{{$detail_by_personil_entry_detail['warna_keberadaan']}} text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['status_keberadaan']}}</span>
                                                </div>
                                                </div>
                                                <div>
                                                <div>
                                                    <strong>Kondisi :</strong>
                                                </div>
                                                <div class="text-center align-middle">
                                                    <span class="badge badge-{{$detail_by_personil_entry_detail['warna_kerusakan']}} text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['status_kerusakan']}}</span>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div>
                                                <div>
                                                    <strong>Ukuran :</strong>
                                                </div>
                                                <div class="text-center align-middle">
                                                    <span class="badge badge-secondary text-center text-wrap my-auto align-middle"><h3>{{$detail_by_personil_entry_detail['size_apd']}}</h3></span>
                                                </div>
                                                </div>
                                                <div>
                                                <div>
                                                    <strong>Terakhir Diubah :</strong>
                                                </div>
                                                <div class="text-center align-middle">
                                                    <span class="badge badge-secondary text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['data_terakhir_update']}}</span>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            
                                            
                                            
                                        </div>
                                        </div>
                                        
                                        
                                        {{-- data validasi dari admin --}}
                                        <div class="card">
                                        <div class="card-header">
                                            <h4 class="mt-5 d-block d-sm-none">Data Verifikasi</h4>
                                            <h4 class="d-none d-sm-block">Data Verifikasi</h4>
                                        </div>
                                        <div class="card-body">
                                            
                                            <div class="row mb-2">
                                                <div class="col-sm">
                                                <div>
                                                    <div>
                                                    <strong>Status Verifikasi :</strong>
                                                    </div>
                                                    <div class="text-center align-middle">
                                                        <span class="badge badge-{{$detail_by_personil_entry_detail['warna_verifikasi']}} text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['status_verifikasi']}}</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div>
                                                    <strong>Terakhir Diubah :</strong>
                                                    </div>
                                                    <div class="text-center align-middle">
                                                        <span class="badge badge-info text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['verifikasi_terakhir_update']}}</span>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-sm">
                                                <div>
                                                    <div>
                                                    <strong>Verifikator :</strong>
                                                    </div>
                                                    <div class="text-center align-middle">
                                                        <span class="badge badge-light text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['nama_verifikator']}}</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div>
                                                    <strong>Jabatan Verifikator :</strong>
                                                    </div>
                                                    <div class="text-center align-middle">
                                                        <span class="badge badge-light text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['jabatan_verifikator']}}</span>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        </div>
                
                                    </div>
                                    {{-- End tampilan data --}}
                
                                    </div>
                                    <div class="row">
                                        <div class="card col-lg-12">
                                            <div class="card-body">
                                                @if (session()->has('alert-success-detailByPersonil'))
                                                    <div class="alert alert-success alert-dismissable fade show" role="alert">
                                                        {{session('alert-success-detailByPersonil')}}
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @endif
                                                {{-- @if (session()->has('alert-danger-detailByPersonil'))
                                                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                                        {{session('alert-danger-detailByPersonil')}}
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @endif --}}
                                                <div class="row">
                                                    <h5>Komentar Pengupload : </h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 text-center blockquote">
                                                        {{($detail_by_personil_entry_detail['komentar_pengupload'])? $detail_by_personil_entry_detail['komentar_pengupload']: "-"}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <h5>Komentar Admin Verifikator : </h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 text-center blockquote">
                                                        {{($detail_by_personil_entry_detail['komentar_verifikator'])? $detail_by_personil_entry_detail['komentar_verifikator'] : "-"}}   
                                                    </div>                                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card col-lg-12">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    Ubah Verifikasi
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Tindakan Anda</label>
                                                    <select class="form-control" wire:model='admin_action_verifikasi'>
                                                        <option value="" disabled>Pilih Tipe Verifikasi</option>
                                                        @if ($opsi_dropdown_verifikasi)
                                                            @foreach ($opsi_dropdown_verifikasi as $item)
                                                                <option value="{{$item['value']}}">{{$item['text']}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('admin_action_verifikasi')
                                                        <small class="error text-danger"><strong>{{$message}}</strong></small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Komentar</label>
                                                    <textarea class="form-control" rows="3" wire:model='admin_action_komentar'
                                                        placeholder="(opsional) Tulis komentar/catatan tentang inputan ini"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                {{-- End jika detail dapat diambil --}}
                
                                {{-- Start jika detail tidak dapat diambil --}}
                                @else
                                    <div class="jumbotron text-center">
                                    Tidak ada yang dapat ditampilkan.
                                    </div>
                                {{-- End jika detail tidak dapat diambil --}}
                                @endif
                
                
                                </div>
                                <div class="card-footer">
                                    @if ($detail_by_personil_entry_detail)
                                        <a class="btn btn-primary rounded-pill float-right" style="cursor: pointer;" wire:click='detailByPersonilModalSimpan'>
                                            <i class="fas fa-save fa-lg mr-2"></i>
                                            Simpan Perubahan
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="detail-gambar">
                        <div class="card">
                            <div class="card-header">
                            <div class="card-title">
                                <h4 class="d-none d-sm-block">Preview Gambar</h4>
                            </div>
                            <div class="card-tools">
                                <a href="javascript:" onclick="previewKeList()">
                                    <i class="fas fa-arrow-circle-left"></i>
                                </a>
                            </div>
                            </div>
                            <div class="card-body">
                            @if ($gambar_terpilih)
                                    @if(is_string($gambar_terpilih))
                                    <img class="product-image" src="{{asset($path_gambar . $gambar_terpilih)}}" alt="Gambar APD">
                                    @elseif(is_array($gambar_terpilih))
                                    {{-- Script untuk preview gambar terpilih Start--}}
                                        <script>
                                        $(document).ready(function() {
                                    $('.gambar-multi.product-image-thumb').on('click', function () {
                                        var $image_element = $(this).find('img')
                                        $('.gambar-multi-preview.product-image').prop('src', $image_element.attr('src'))
                                        $('.gambar-multi.product-image-thumb.active').removeClass('active')
                                        $(this).addClass('active')
                                        })
                                    })
                                    </script>
                                    {{-- Script untuk preview gambar terpilih End--}}

                                    <img class="gambar-multi-preview product-image"
                                    src="{{asset($path_gambar . $gambar_terpilih[0])}}" alt="Gambar Apd">
                                    <div class="col-12 gambar-multi product-image-thumbs">
                                        @foreach ($gambar_terpilih as $key => $gbr)
                                            @if($key === array_key_first($gambar_terpilih))
                                            <div class="gambar-multi product-image-thumb active"><img
                                                    src="{{asset($path_gambar . $gbr)}}" alt="APD">
                                            </div>
                                            @else
                                            <div class="gambar-multi product-image-thumb"><img
                                                    src="{{asset($path_gambar . $gbr)}}" alt="APD">
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    @endif
                            @else
                                <div class="jumbotron text-center">
                                Tidak ada yang dapat ditampilkan.
                                </div>
                            @endif
                            </div>
                        </div>
                        
                        </div>
                    </div>
                {{-- End bagian untuk tabel --}}

               
                
                {{-- End Card Profil --}}

                {{-- Start Card Lihat Foto --}}
                <div class="collapse" id="collapse-card-lihat-foto">
                    <div class="col-sm-10 mx-auto">
                    <div class="card">
                        <div class="card-header">
                        <div class="card-title">
                            <h4>Preview Gambar</h4>
                        </div>
                        <div class="card-tools">
                            <button type="button" class="close" data-toggle="collapse"
                                data-target="#collapse-card-lihat-foto" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        </div>
                        <div class="card-body text-center">
                        {{-- Start ketika ada gambar yang terpilih --}}
                        @if (!is_null($gambar_terpilih))
                            {{-- Start ketika gambar yang terpilih ada banyak --}}
                            @if(is_array($gambar_terpilih) && count($gambar_terpilih) > 1)
                                {{-- Script untuk preview gambar terpilih Start--}}
                                <script>
                                    $(document).ready(function() {
                                $('.gambar-multi.product-image-thumb').on('click', function () {
                                    var $image_element = $(this).find('img')
                                    $('.gambar-multi-preview.product-image').prop('src', $image_element.attr('src'))
                                    $('.gambar-multi.product-image-thumb.active').removeClass('active')
                                    $(this).addClass('active')
                                    })
                                })
                                </script>
                                {{-- Script untuk preview gambar terpilih End--}}

                                <img class="gambar-multi-preview product-image"
                                src="{{asset($gambar_terpilih[0])}}" alt="Gambar Apd">
                                <div class="col-12 gambar-multi product-image-thumbs">
                                    @foreach ($gambar_terpilih as $key => $gbr)
                                        @if($key === array_key_first($gambar_terpilih))
                                        <div class="gambar-multi product-image-thumb active"><img
                                                src="{{asset($gbr)}}" alt="APD">
                                        </div>
                                        @else
                                        <div class="gambar-multi product-image-thumb"><img
                                                src="{{asset($gbr)}}" alt="APD">
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            {{-- End ketika gambar yang terpilih ada banyak --}}
                            
                            {{-- Start ketika gambar yang terpilih hanya satu --}}
                            @elseif(is_string($gambar_terpilih) && $gambar_terpilih != "")
                            <img src="{{asset($gambar_terpilih)}}" class="img-thumbnail" alt="gambar terpilih">
                            {{-- End ketika gambar yang terpilih hanya satu --}}

                            {{-- Start antisipasi gambar tidak null tetapi tidak ada gambar --}}
                            @else
                            <div class="jumbotron text-center">
                                Tidak ada gambar yang dipilih.
                            </div>
                            @endif
                            {{-- End antisipasi gambar tidak null tetapi tidak ada gambar --}}

                        {{-- End ketika ada gambar yang terpilih --}}

                        {{-- Start ketika tidak ada gambar yang terpilih --}}
                        @else
                            <div class="jumbotron text-center">
                            Tidak ada gambar yang dipilih.
                            </div>
                        {{-- End ketika tidak ada gambar yang terpilih --}}

                        @endif
                        </div>
                    </div>
                    </div>
                </div>
                {{-- End Card Lihat Foto --}}

                {{-- Start Card lihat detail --}}
                <div class="collapse" id="collapse-card-lihat-detail">
                    <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4 class="d-none d-sm-block">Detail Inputan {{$detail_by_personil_entry_nama_apd}}</h4>
                            <h5 class="d-block d-sm-none">Detail Inputan {{$detail_by_personil_entry_nama_apd}}</h5>
                        </div>
                        <div class="card-tools">
                            <button type="button" class="close" data-toggle="collapse"
                                data-target="#collapse-card-lihat-detail" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        {{-- Status Start --}}
                        <div wire:loading='detailByPersonilLihatDetail'>
                            <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                            <small class="text-info"> Memuat data..</small>
                        </div>
                        {{-- Status End --}}

                        {{-- Start jika detail dapat diambil --}}
                        @if (!is_null($detail_by_personil_entry_detail))
                        <div class="row">
                            {{-- Start tampilan gambar --}}
                            <div class="col-12 col-sm-6">
                            <div class="card">

                                {{-- nav tabs --}}
                                <div class="card-header">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                    <a class="nav-link active" id="gambar-user-tab" role="tab" aria-selected="true" data-toggle="pill" 
                                        aria-controls="gambar-user-tab-content" href="#gambar-user-tab-content">Gambar yang diupload</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" id="gambar-apd-tab" role="tab" aria-selected="false" data-toggle="pill"
                                        aria-controls="gambar-apd-tab-content" href="#gambar-apd-tab-content">Gambar APD</a>
                                    </li>
                                </ul>
                                </div>

                                {{-- tab content --}}
                                <div class="card-body">
                                <div class="tab-content">
                                    {{-- Start gambar apd user --}}
                                    <div class="tab-pane fade active show" id="gambar-user-tab-content" role="tabpanel" aria-labelledby="gambar-user-tab" wire:ignore.self>
                                    {{-- Start jika gambar user ada --}}
                                    @if (!is_null($detail_by_personil_entry_detail['gambar_apd']))
                                        {{-- Start jika ada lebih dari satu --}}
                                        @if (is_array($detail_by_personil_entry_detail['gambar_apd']) && count($detail_by_personil_entry_detail['gambar_apd']) > 1)
                                            
                                            {{-- Script untuk preview gambar apd Start--}}
                                            <script>
                                                $(document).ready(function() {
                                            $('.apd-user.product-image-thumb').on('click', function () {
                                                var $image_element = $(this).find('img')
                                                $('.apd-user-preview.product-image').prop('src', $image_element.attr('src'))
                                                $('.apd-user.product-image-thumb.active').removeClass('active')
                                                $(this).addClass('active')
                                                })
                                            })
                                            </script>
                                            {{-- Script untuk preview gambar apd End--}}

                                            <img class="apd-user-preview product-image"
                                            src="{{asset($detail_by_personil_entry_detail['gambar_apd'][0])}}" alt="Gambar Apd Anda">
                                            <div class="col-12 apd-user product-image-thumbs">
                                                @foreach ($detail_by_personil_entry_detail['gambar_apd'] as $key => $gbr)
                                                    @if($key === array_key_first($detail_by_personil_entry_detail['gambar_apd']))
                                                    <div class="apd-user product-image-thumb active"><img
                                                            src="{{asset($gbr)}}" alt="APD">
                                                    </div>
                                                    @else
                                                    <div class="apd-user product-image-thumb"><img
                                                            src="{{asset($gbr)}}" alt="APD">
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        {{-- End jika ada lebih dari satu --}}
                                        
                                        {{-- Start jika hanya ada satu gambar --}}
                                        @elseif(is_string($detail_by_personil_entry_detail['gambar_apd']) && $detail_by_personil_entry_detail['gambar_apd'] != "")
                                            <img src="{{asset($detail_by_personil_entry_detail['gambar_apd'])}}" class="img-thumbnail" alt="APD">
                                        {{-- End jika hanya ada satu gambar --}}

                                        {{-- Start antisipasi gambar tidak null tetapi tidak ada gambar --}}
                                            @else
                                            <div class="jumbotron text-center">
                                            Tidak ada gambar yang diunggah.
                                            </div>
                                        {{-- End antisipasi gambar tidak null tetapi tidak ada gambar --}}

                                        @endif
                                    {{-- End jika gambar user ada --}}

                                    {{-- Start jika tidak ada gambar user --}}
                                    @elseif(is_null($detail_by_personil_entry_detail['gambar_apd']) || $detail_by_personil_entry_detail['gambar_apd'] === "")
                                        <div class="jumbotron text-center">
                                        Tidak ada gambar yang diunggah.
                                        </div>
                                    @else
                                        <div class="jumbotron text-center">
                                        Tidak ada gambar yang diunggah.
                                        </div>
                                    {{-- End jika tidak ada gambar user --}}
                                    @endif
                                    </div>
                                    {{-- End gambar apd user --}}

                                    {{-- Start gambar apd template --}}
                                    <div class="tab-pane fade" id="gambar-apd-tab-content" role="tabpanel" aria-labelledby="gambar-apd-tab" wire:ignore.self>
                                    {{-- Start jika gambar template ada --}}
                                    @if (!is_null($gambar_apd_template))
                                        {{-- Start jika ada lebih dari satu --}}
                                        @if (is_array($gambar_apd_template) && count($gambar_apd_template) > 1)
                                            
                                            {{-- Script untuk preview gambar apd Start--}}
                                            <script>
                                                $(document).ready(function() {
                                            $('.apd-template.product-image-thumb').on('click', function () {
                                                var $image_element = $(this).find('img')
                                                $('.apd-template-preview.product-image').prop('src', $image_element.attr('src'))
                                                $('.apd-template.product-image-thumb.active').removeClass('active')
                                                $(this).addClass('active')
                                                })
                                            })
                                            </script>
                                            {{-- Script untuk preview gambar apd End--}}

                                            <img class="apd-template-preview product-image"
                                            src="{{asset($gambar_apd_template[0])}}" alt="Gambar Apd Anda">
                                            <div class="col-12 apd-template product-image-thumbs">
                                                @foreach ($gambar_apd_template as $key => $gbr)
                                                    @if($key === array_key_first($gambar_apd_template))
                                                    <div class="apd-template product-image-thumb active"><img
                                                            src="{{asset($gbr)}}" alt="APD">
                                                    </div>
                                                    @else
                                                    <div class="apd-template product-image-thumb"><img
                                                            src="{{asset($gbr)}}" alt="APD">
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        {{-- End jika ada lebih dari satu --}}
                                        
                                        {{-- Start jika hanya ada satu gambar --}}
                                        @elseif(is_string($gambar_apd_template) && $gambar_apd_template != "")
                                            <img src="{{asset($gambar_apd_template)}}" class="img-thumbnail" alt="APD">
                                        {{-- End jika hanya ada satu gambar --}}

                                        {{-- Start antisipasi gambar tidak null tetapi tidak ada gambar --}}
                                            @else
                                            <div class="jumbotron text-center">
                                            Tidak ada gambar yang disediakan.
                                            </div>
                                        {{-- End antisipasi gambar tidak null tetapi tidak ada gambar --}}
                                        @endif
                                    {{-- End jika gambar template ada --}}

                                    {{-- Start jika tidak ada gambar template --}}
                                    @elseif(is_null($gambar_apd_template) || $gambar_apd_tempate === "")
                                        <div class="jumbotron text-center">
                                        Tidak ada gambar yang disediakan.
                                        </div>
                                    @else
                                        <div class="jumbotron text-center">
                                        Tidak ada gambar yang disediakan.
                                        </div>
                                    {{-- End jika tidak ada gambar template --}}
                                    @endif
                                    </div>
                                    {{-- End gambar apd template --}}

                                </div>
                                </div>

                            </div>
                            </div>
                            {{-- End tampilan gambar --}}

                            {{-- Start tampilan data --}}
                            <div class="col-12 col-sm-6">
                            {{-- data inputan dari user --}}
                            <div class="card">
                                <div class="card-header">
                                <h4 class="mt-5 d-block d-sm-none">Data Inputan</h4>
                                <h4 class="d-none d-sm-block">Data Inputan</h4>
                                </div>
                                <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm">
                                    <div>
                                        <div>
                                        <strong>Keberadaan :</strong>
                                        </div>
                                        <div class="text-center align-middle">
                                            <span class="badge badge-{{$detail_by_personil_entry_detail['warna_keberadaan']}} text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['status_keberadaan']}}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                        <strong>Kondisi :</strong>
                                        </div>
                                        <div class="text-center align-middle">
                                            <span class="badge badge-{{$detail_by_personil_entry_detail['warna_kerusakan']}} text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['status_kerusakan']}}</span>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm">
                                    <div>
                                        <div>
                                        <strong>Ukuran :</strong>
                                        </div>
                                        <div class="text-center align-middle">
                                            <span class="badge badge-secondary text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['size_apd']}}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                        <strong>Terakhir Diubah :</strong>
                                        </div>
                                        <div class="text-center align-middle">
                                            <span class="badge badge-secondary text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['verifikasi_terakhir_update']}}</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @if ($detail_by_personil_entry_detail['komentar_pengupload'])
                                    <div class="row-sm">
                                        <div class="text-bold mb-1">
                                        Catatan dari Peng-unggah : 
                                        </div>
                                        <div class="blockquote">
                                            {{$detail_by_personil_entry_detail['komentar_pengupload']}}
                                        </div>
                                    </div> 
                                @endif
                                
                                    
                                </div>
                            </div>
                            
                            
                            {{-- data validasi dari admin --}}
                            <div class="card">
                                <div class="card-header">
                                <h4 class="mt-5 d-block d-sm-none">Data Validasi</h4>
                                <h4 class="d-none d-sm-block">Data Validasi</h4>
                                </div>
                                <div class="card-body">
                                
                                    <div class="row mb-2">
                                    <div class="col-sm">
                                        <div>
                                        <div>
                                            <strong>Status Validasi :</strong>
                                        </div>
                                        <div class="text-center align-middle">
                                            <span class="badge badge-{{$detail_by_personil_entry_detail['warna_verifikasi']}} text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['status_verifikasi']}}</span>
                                        </div>
                                        </div>
                                        <div>
                                        <div>
                                            <strong>Terakhir Diubah :</strong>
                                        </div>
                                        <div class="text-center align-middle">
                                            <span class="badge badge-info text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['data_terakhir_update']}}</span>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div>
                                        <div>
                                            <strong>Verifikator :</strong>
                                        </div>
                                        <div class="text-center align-middle">
                                            <span class="badge badge-light text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['nama_verifikator']}}</span>
                                        </div>
                                        </div>
                                        <div>
                                        <div>
                                            <strong>Jabatan Verifikator :</strong>
                                        </div>
                                        <div class="text-center align-middle">
                                            <span class="badge badge-light text-center text-wrap my-auto align-middle">{{$detail_by_personil_entry_detail['jabatan_verifikator']}}</span>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    @if ($detail_by_personil_entry_detail['komentar_verifikator'])
                                        <div class="row-sm">
                                        <div class="text-bold mb-1">
                                            Catatan dari Verifikator : 
                                        </div>
                                        <div class="blockquote">
                                            {{$detail_by_personil_entry_detail['komentar_verifikator']}}
                                        </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            </div>
                            {{-- End tampilan data --}}

                        </div> 
                        {{-- End jika detail dapat diambil --}}

                        {{-- Start jika detail tidak dapat diambil --}}
                        @else
                        <div class="jumbotron text-center">
                            Tidak ada yang dapat ditampilkan.
                        </div>
                        {{-- End jika detail tidak dapat diambil --}}
                        @endif


                    </div>
                    </div>
                </div>
                {{-- End Card lihat detail --}}

                    {{-- <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click='simpan'>Simpan</button>
                    </div> --}}
                </div>
        </div>

</div>

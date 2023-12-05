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
                            <select class="form-control" wire:model='tahun_terpilih' wire:change='changeDropdownTahun'>
                            <option value="" disabled >Pilih tahun periode</option>
                            @if ($opsi_dropdown_tahun)
                                @foreach ($opsi_dropdown_tahun as $item)
                                    <option value="{{$item['value']}}">{{$item['text']}}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Periode</label>
                            @if ($tahun_terpilih)
                                <select class="form-control" wire:model='periode_terpilih' wire:change='changeDropdownPeriode'>
                                    <option value="" disabled >Pilih periode</option>
                                    @if ($opsi_dropdown_periode)
                                            @foreach ($opsi_dropdown_periode as $item)
                                                <option value="{{$item['value']}}">{{$item['text']}}</option>
                                            @endforeach
                                        @endif
                                </select>
                            @else
                                <input class="form-control" type="text" placeholder="Silahkan pilih tahun terlebih dahulu." disabled>
                            @endif
                            
                        </div>
                    </div>
                </div>
                @if ($periode_jumlah > 0)
                    <i>Terdapat <strong>{{$periode_jumlah}}</strong> periode yang dapat ditampilkan.</i>
                @endif
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

                @if ($periode_terpilih)
                    <div class="collapse show active" id="tabel-anggota" wire:ignore.self>
                        <livewire:dashboards.pegawai.data.apd.tabel-list-anggota>
                    </div>
                    <div class="collapse" id="list-input" wire:ignore.self>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4>Data APD {{$nama_pegawai}}</h4>
                                </div>
                                <div class="card-tools">
                                    <a href="javascript:" onclick="listKeTabel()">
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (!empty($list_inputan_pegawai))
                                    <div class="table-responsive p-0">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead class="text-center">
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 20%;">Item</th>
                                                <th class="text-center">Foto yang diupload</th>
                                                <th style="width: 18%;">Keterangan APD</th>
                                                <th class="text-center" style="width:20%;">Verifikasi APD</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        {{-- Start generate isian table --}}
                                        @foreach ($list_inputan_pegawai as $index => $item)
                                            
                                            <tr>
                                            
                                            <td class="text-center text-wrap my-auto align-middle">{{$index + 1}}</td>
                                            <td class="text-center text-wrap my-auto align-middle"><strong>{{$item['nama_jenis']}}</strong></td>
                                            <td class="text-center my-auto align-middle">
                                                {{-- Start tampilan gambar inputan pegawai --}}
                                                @if(is_array($item['gambar_apd']) && count($item['gambar_apd']))
                                                {{-- Saat ada gambar dan berisi lebih dari satu --}}
                                                <div class="align-middle">
                                                    <ul class="list-inline w-50 d-none d-sm-block text-center">
                                                    @foreach ($item['gambar_apd'] as $index_gbr => $gbr)
                                                        <a class="apd-foto" wire:click="lihatGambar([{{$index}},{{$index_gbr}}])" style="cursor: pointer;">
                                                            <img alt="APD" class="table-avatar w-25 h-25" src="{{asset($path_gambar . $gbr)}}">
                                                        </a>
                                                    @endforeach
                                                    </ul>
                                                </div>
                                                <a class="btn btn-primary d-block d-sm-none" wire:click="lihatGambar('{{$index}}')"><i class="fas fa-image"></i></a>
                                                @elseif(is_string($item['gambar_apd']) && $item['gambar_apd'] != "")
                                                {{-- Saat ada gambar dan berisi hanya satu --}}
                                                <a class="apd-foto d-none d-sm-block" wire:click="lihatGambar('{{$index}}')" style="cursor: pointer;">
                                                    <img alt="APD" class="table-avatar w-25 h-25 d-none d-sm-block" src="{{asset($path_gambar . $item['gambar_apd'])}}">
                                                </a>
                                                <a class="btn btn-primary d-block d-sm-none" wire:click="lihatGambar('{{$index}}')" style="cursor: pointer;"><i class="fas fa-image"></i></a>
                                                @elseif(!$item['gambar_apd'])
                                                {{-- Saat tidak ada gambar --}}
                                                Tidak ada gambar yang diupload.
                                                @endif
                                                {{-- End tampilan gambar inputan pegawai --}}
                                            </td>
                                            <td class="text-center text-wrap my-auto align-middle">
                                                <div class="row my-n2">
                                                    <strong class="d-none d-sm-block">Waktu Isi : </strong>
                                                </div>
                                                <div class="row my-n2">
                                                {{$item['data_terakhir_update']}}
                                                </div>
                                                <div class="row my-n2">
                                                    <strong class="d-none d-sm-block">Kondisi : </strong><span class="mx-1 badge badge-{{$item['warna_kerusakan']}} text-center text-wrap my-auto align-middle">{{$item['status_kerusakan']}}</span>
                                                </div>
                                                <div class="row my-n2">
                                                    <strong class="d-none d-sm-block">Komentar Pengupload : </strong>
                                                    <strong class="d-block d-sm-none">Komentar : </strong>
                                                </div>
                                                <div class="row my-n2">
                                                    <p class="mx-1 my-auto align-middle">{{($item['komentar_pengupload'])? $item['komentar_pengupload'] : " - "}}</p>
                                                </div>
                                            </td>
                                            <td class="text-center text-wrap my-auto align-middle">
                                                <div class="row my-n2">
                                                    <strong class="d-none d-sm-block">Waktu Verif : </strong>
                                                </div>
                                                <div class="row my-n2">
                                                {{$item['verifikasi_terakhir_update']}}
                                                </div>
                                                <div class="row my-n2">
                                                    <strong class="d-none d-sm-block">Status : </strong><span class="mx-1 badge badge-{{$item['warna_verifikasi']}} text-center text-wrap my-auto align-middle">{{$item['status_verifikasi']}}</span>
                                                </div>
                                                <div class="row my-n2">
                                                    <strong class="d-none d-sm-block">Komentar Verifikator : </strong>
                                                    <strong class="d-block d-sm-none">Komentar :</strong>
                                                </div>
                                                <div class="row my-n2">
                                                    <p class="mx-1 my-auto align-middle">{{($item['komentar_verifikator'])?$item['komentar_verifikator'] : " - "}}</p>
                                                </div>
                                            </td>
                                            <td class="text-center text-wrap my-auto align-middle">
                                                <button type="button" class="btn btn-secondary" wire:click='lihatDetail("{{$index}}")'>Detail</button>
                                            </td>
                                            </tr>
                                        @endforeach
                                        {{-- End generate isian table --}}
                                        </tbody>
                                    </table>
                                    </div>
                                @else
                                    <div class="text-center jumbotron">
                                        Tidak ada yang dapat ditampilkan.
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="detail-input" wire:ignore.self>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4>Detail {{$nama_apd_detail}} diinput oleh {{$nama_pegawai}}</h4>
                                </div>
                                <div class="card-tools">
                                    <a href="javascript:" onclick="detailKeList()">
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="content">
                                    {{-- Start jika detail dapat diambil --}}
                                    @if (!is_null($data_detail_inputan))
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
                                            <div class="tab-pane fade active show" id="gambar-user-tab-content" role="tabpanel" aria-labelledby="gambar-user-tab">
                                                {{-- Start jika gambar user ada --}}
                                                @if (!is_null($data_detail_inputan['gambar_apd']))
                                                    {{-- Start jika ada lebih dari satu --}}
                                                    @if (is_array($data_detail_inputan['gambar_apd']) && count($data_detail_inputan['gambar_apd']) > 1)
                                                        
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
                                                        src="{{asset($path_gambar . $data_detail_inputan['gambar_apd'][0])}}" alt="Gambar Apd Anda">
                                                        <div class="col-12 apd-user product-image-thumbs">
                                                            @foreach ($data_detail_inputan['gambar_apd'] as $key => $gbr)
                                                                @if($key === array_key_first($data_detail_inputan['gambar_apd']))
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
                                                    @elseif(is_string($data_detail_inputan['gambar_apd']) && $data_detail_inputan['gambar_apd'] != "")
                                                        <img src="{{asset($path_gambar . $data_detail_inputan['gambar_apd'])}}" class="img-thumbnail" alt="APD">
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
                                                @elseif(is_null($data_detail_inputan['gambar_apd']) || $data_detail_inputan['gambar_apd'] === "")
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
                                            <div class="tab-pane fade" id="gambar-apd-tab-content" role="tabpanel" aria-labelledby="gambar-apd-tab">
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
                                                    <span class="badge badge-{{$data_detail_inputan['warna_keberadaan']}} text-center text-wrap my-auto align-middle">{{$data_detail_inputan['status_keberadaan']}}</span>
                                                </div>
                                                </div>
                                                <div>
                                                <div>
                                                    <strong>Kondisi :</strong>
                                                </div>
                                                <div class="text-center align-middle">
                                                    <span class="badge badge-{{$data_detail_inputan['warna_kerusakan']}} text-center text-wrap my-auto align-middle">{{$data_detail_inputan['status_kerusakan']}}</span>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div>
                                                <div>
                                                    <strong>Ukuran :</strong>
                                                </div>
                                                <div class="text-center align-middle">
                                                    <span class="badge badge-secondary text-center text-wrap my-auto align-middle">{{$data_detail_inputan['size_apd']}}</span>
                                                </div>
                                                </div>
                                                <div>
                                                <div>
                                                    <strong>Terakhir Diubah :</strong>
                                                </div>
                                                <div class="text-center align-middle">
                                                    <span class="badge badge-secondary text-center text-wrap my-auto align-middle">{{$data_detail_inputan['data_terakhir_update']}}</span>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            @if ($data_detail_inputan['komentar_pengupload'])
                                            <div class="row-sm">
                                                <div class="text-bold mb-1">
                                                    Catatan dari Peng-unggah : 
                                                </div>
                                                <div class="blockquote">
                                                    {{$data_detail_inputan['komentar_pengupload']}}
                                                </div>
                                                </div> 
                                            @endif
                                            
                                            
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
                                                        <span class="badge badge-{{$data_detail_inputan['warna_verifikasi']}} text-center text-wrap my-auto align-middle">{{$data_detail_inputan['status_verifikasi']}}</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div>
                                                    <strong>Terakhir Diubah :</strong>
                                                    </div>
                                                    <div class="text-center align-middle">
                                                        <span class="badge badge-info text-center text-wrap my-auto align-middle">{{$data_detail_inputan['verifikasi_terakhir_update']}}</span>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-sm">
                                                <div>
                                                    <div>
                                                    <strong>Verifikator :</strong>
                                                    </div>
                                                    <div class="text-center align-middle">
                                                        <span class="badge badge-light text-center text-wrap my-auto align-middle">{{$data_detail_inputan['nama_verifikator']}}</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div>
                                                    <strong>Jabatan Verifikator :</strong>
                                                    </div>
                                                    <div class="text-center align-middle">
                                                        <span class="badge badge-light text-center text-wrap my-auto align-middle">{{$data_detail_inputan['jabatan_verifikator']}}</span>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            @if ($data_detail_inputan['komentar_verifikator'])
                                                <div class="row-sm">
                                                    <div class="text-bold mb-1">
                                                    Catatan dari Verifikator : 
                                                    </div>
                                                    <div class="blockquote">
                                                        {{$data_detail_inputan['komentar_verifikator']}}
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
                        
                    </div>
                @else
                    <div class="jumbotron text-center">
                        <h4>Tidak ada yang dapat ditampilkan.</h4>
                    </div>
                @endif

                
            </div>
        </div>
    </div>

    <livewire:dashboards.pegawai.data.apd.modal-kolom-profil-tabel-anggota>
    
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="modal-gambar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="header-title">Lihat Gambar</div>
                    <div class="header-tools">
                        <div class="d-flex justify-content-end mb-2">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    @if ($gambar_detail)
                            @if(is_string($gambar_detail))
                              <img class="product-image" src="{{asset($path_gambar . $gambar_detail)}}" alt="Gambar APD">
                            @elseif(is_array($gambar_detail))
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
                              src="{{asset($path_gambar . $gambar_detail[0])}}" alt="Gambar Apd">
                              <div class="col-12 gambar-multi product-image-thumbs">
                                  @foreach ($gambar_detail as $key => $gbr)
                                      @if($key === array_key_first($gambar_detail))
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
                    <div class="modal-footer">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('stack-body')
    <script>

        window.addEventListener('jsAlert', event=>{
                alert(event.detail.pesan);
            })

        window.addEventListener('tabel-ke-list', event=>{
            $('#tabel-anggota').hide(500)
            $('#list-input').show(500)
        })

        window.addEventListener('list-ke-detail', event=>{
            $('#list-input').hide(500)
            $('#detail-input').show(500)
        })

        function listKeTabel()
        {
            $('#list-input').hide(500)
            $('#tabel-anggota').show(500)
        }

        function detailKeList()
        {
            $('#detail-input').hide(500)
            $('#list-input').show(500)
        }
    </script>
@endpush

</div>

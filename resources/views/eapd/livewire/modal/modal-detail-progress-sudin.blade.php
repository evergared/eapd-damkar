
{{-- Javascript untuk halaman ini ada di bagian bawah --}}

<div>
    <div class="modal fade" id="modal-progres-sudin" wire:ignore.self>
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Progres Input <a wire:click='profil' style="cursor: pointer;"><u>{{$nama_pegawai}}</u></a></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            {{-- Start bagian untuk alert --}}
              <div>
                {{-- Alert untuk mixed --}}
                @if (session()->has('mixed_simpan_data'))
                    <div class="alert alert-light alert-dismissable fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      <div>
                        Berhasil merubah status validasi dari <strong><a class="text-success alert-link" href="#list-success-b" data-toggle="collapse">{{session('mixed_simpan_data')}} item</a></strong> <br>
                        Dan gagal merubah status validasi dari <strong><a class="text-danger alert-link" href="#list-fail-b" data-toggle="collapse">{{session('mixed_simpan_data')}} item</a></strong>.
                      </div>
                      <div class="collapse" id="list-success-b">
                        <div class="card card-body bg-light mt-2">
                          <div class="card-tools">
                            <button type="button" class="close" data-toggle="collapse" aria-controls="#list-success-a" data-target="#list-success-b" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <h5 class="text-success">Berhasil : </h5>
                            <ul>
                              @foreach ($verifikasi_yang_berhasil_diubah as $item)
                                  <li>{{$item}}</li>
                              @endforeach
                            </ul>
                        </div>
                      </div>
                      <div class="collapse" id="list-fail-b">
                        <div class="card card-body bg-light mt-2">
                          <div class="card-tools">
                            <button type="button" class="close" data-toggle="collapse" aria-controls="#list-fail-b" data-target="#list-fail-b" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <h5 class="text-danger">Gagal : </h5>
                            <ul>
                              @foreach ($verifikasi_yang_gagal_diubah as $item)
                                  <li>{{$item}}</li>
                              @endforeach
                            </ul>
                        </div>
                      </div>
                    </div>
                @endif
                
                {{-- Alert untuk sukses --}}
                @if (session()->has('success_simpan_data'))
                    <div class="alert alert-success alert-dismissable fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      <div>
                        Berhasil merubah status validasi dari <a href="#list-success-a" data-toggle="collapse">{{session('success_simpan_data')}} item</a>.
                      </div>
                      <div class="collapse" id="list-success-a">
                        <div class="card card-body bg-success mt-2">
                          <div class="card-tools">
                            <button type="button" class="close" data-toggle="collapse" aria-controls="#list-success-a" data-target="#list-success-a" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <ul>
                              @foreach ($verifikasi_yang_berhasil_diubah as $item)
                                  <li>{{$item}}</li>
                              @endforeach
                            </ul>
                        </div>
                      </div>
                    </div>
                @endif


                  {{-- Alert untuk gagal --}}
                  @if (session()->has('fail_simpan_data'))
                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      <div>
                        Gagal merubah status validasi dari <a href="#list-danger-a" data-toggle="collapse">{{session('fail_simpan_data')}} item</a>.
                      </div>
                      <div class="collapse" id="list-danger-a">
                        <div class="card card-body bg-danger mt-2">
                          <div class="card-tools">
                            <button type="button" class="close" data-toggle="collapse" aria-controls="#list-danger-a" data-target="#list-danger-a" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <ul>
                              @foreach ($verifikasi_yang_gagal_diubah as $item)
                                  <li>{{$item}}</li>
                              @endforeach
                            </ul>
                        </div>
                      </div>
                    </div>
                  @endif


                  {{-- Alert untuk none --}}
                  @if (session()->has('none_simpan_data'))
                    <div class="alert alert-secondary alert-dismissable fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      <div>
                        {{session('none_simpan_data')}}
                      </div>
                    </div>
                  @endif
              </div>
            {{-- End bagian untuk alert --}}

            {{-- Start bagian untuk tabel --}}
            <div class="card mx-n3 mt-n3">
              @if (!empty($list_inputan_pegawai))
                <div class="table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th style="width: 20%;">Item</th>
                            <th class="text-center">Foto yang diupload</th>
                            <th style="width: 18%;">Status</th>
                            <th class="text-center" style="width:20%;">Ubah Validasi</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                      {{-- Start generate isian table --}}
                      @foreach ($list_inputan_pegawai as $index => $item)
                        
                        <tr>
                          
                          <td class="text-center text-wrap my-auto align-middle">{{$index + 1}}</td>
                          <td class="text-center text-wrap my-auto align-middle">{{$item['nama_jenis']}}</td>
                          <td class="text-center my-auto align-middle">
                            {{-- Start tampilan gambar inputan pegawai --}}
                            @if(is_array($item['gambar_apd']) && count($item['gambar_apd']))
                              {{-- Saat ada gambar dan berisi lebih dari satu --}}
                              <div class="align-middle">
                                <ul class="list-inline w-50 d-none d-sm-block text-center">
                                  @foreach ($item['gambar_apd'] as $index_gbr => $gbr)
                                      <a class="apd-foto" wire:click="satuFoto({{$index}},{{$index_gbr}})" style="cursor: pointer;">
                                        <img alt="APD" class="table-avatar w-25 h-25" src="{{asset($gbr)}}">
                                      </a>
                                  @endforeach
                                </ul>
                              </div>
                              <a class="btn btn-primary d-block d-sm-none" wire:click="semuaFoto({{$index}})"><i class="fas fa-image"></i></a>
                            @elseif(is_string($item['gambar_apd']) && $item['gambar_apd'] != "")
                              {{-- Saat ada gambar dan berisi hanya satu --}}
                              <a class="apd-foto d-none d-sm-block" wire:click="satuFoto({{$index}},-1)" style="cursor: pointer;">
                                <img alt="APD" class="table-avatar w-25 h-25 d-none d-sm-block" src="{{asset($gbr)}}">
                              </a>
                              <a class="btn btn-primary d-block d-sm-none" wire:click="semuaFoto({{$index}})" style="cursor: pointer;"><i class="fas fa-image"></i></a>
                            @elseif(!$item['gambar_apd'])
                              {{-- Saat tidak ada gambar --}}
                              Tidak ada gambar yang diupload.
                            @endif
                            {{-- End tampilan gambar inputan pegawai --}}
                          </td>
                          <td class="text-center text-wrap my-auto align-middle">
                            <div class="row my-n2">
                                <strong class="d-none d-sm-block">Keberadaan : </strong><span class="mx-1 badge badge-{{$item['warna_keberadaan']}} text-center text-wrap my-auto align-middle">{{$item['status_keberadaan']}}</span>
                            </div>
                            <div class="row my-n2">
                                <strong class="d-none d-sm-block">Kondisi : </strong><span class="mx-1 badge badge-{{$item['warna_kerusakan']}} text-center text-wrap my-auto align-middle">{{$item['status_kerusakan']}}</span>
                            </div>
                            <div class="row my-n2">
                                <strong class="d-none d-sm-block">Verifikasi : </strong><span class="mx-1 badge badge-{{$item['warna_verifikasi']}} text-center text-wrap my-auto align-middle">{{$item['status_verifikasi']}}</span>
                            </div>
                          </td>
                          <td class="text-center text-wrap my-auto align-middle">
                            
                            <div class="row">
                              <select class="form-control" wire:model='temp_verifikasi_inputan.{{$index}}.verifikasi'>
                                <option value="">Ubah verifikasi</option>
                                <option value="3">Validasi</option>
                                <option value="4">Tolak</option>
                              </select>
                            </div>
                            <div class="row">
                              <textarea class="form-control" wire:model="temp_verifikasi_inputan.{{$index}}.komentar"  placeholder="(opsional) Tambah Catatan/Komentar"></textarea>
                            </div>
                            
                          </td>
                          <td class="text-center text-wrap my-auto align-middle">
                            <button type="button" class="btn btn-secondary" wire:click="lihatDetail('{{$item['id_jenis']}}')">Detail</button>
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
          {{-- End bagian untuk tabel --}}

          {{-- Start Card Profil --}}
          <div class="collapse" id="collapse-card-profil">
              <div class="col-sm-8 mx-auto">
              <div class="card">
                <div class="card-header">
                  <div class="card-tools">
                    <button type="button" class="close" data-toggle="collapse"
                        data-target="#collapse-card-profil" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <h4 class="d-none d-sm-block">Profil {{$nama_pegawai}}</h4>
                  <h5 class="d-block d-sm-none">Profil {{$nama_pegawai}}</h5>
                </div>
                <div class="card-body align-items-center">
                  @if ($profil_tampil)
                      <div class="row">
                        <div class="col-sm-3 m-2">
                          <img class="img-thumbnail" style="max-width:160px; max-height:160px;"
                            src="{{asset('storage/img/avatar/placeholder/avatar.jpg')}}">
                        </div>
                        <div class="col-sm-6 pl-sm-8">
                          <div class="row">
                            NIP/NIK : {{$profil_nip}}
                          </div>
                          <div class="row">
                            NRK/No PJLP : {{$profil_nrk}}
                          </div>
                          <div class="row">
                            Nama : {{$nama_pegawai}}
                          </div>
                          <div class="row">
                            Penempatan : {{$profil_penempatan}}
                          </div>
                          <div class="row">
                            Grup Jaga : {{$profil_grup}} 
                          </div>
                        </div>
                      </div>
                  @else
                      <div class="jumbotron text-center">
                          Tidak ada yang dapat ditampilkan.
                      </div>                  
                  @endif
                  
                </div>
              </div>
            </div>
          </div>
          
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
                      @endif
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
                      <h4 class="d-none d-sm-block">Detail Inputan {{$nama_apd_detail}}</h4>
                      <h5 class="d-block d-sm-none">Detail Inputan {{$nama_apd_detail}}</h5>
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
                  <div wire:loading='lihatDetail'>
                      <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                      <small class="text-info"> Memuat data..</small>
                  </div>
                  {{-- Status End --}}

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
                                      src="{{asset($data_detail_inputan['gambar_apd'][0])}}" alt="Gambar Apd Anda">
                                      <div class="col-12 apd-user product-image-thumbs">
                                          @foreach ($data_detail_inputan['gambar_apd'] as $key => $gbr)
                                              @if($key === array_key_first($data_detail_inputan['gambar_apd']))
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
                                  @elseif(is_string($data_detail_inputan['gambar_apd']) && $data_detail_inputan['gambar_apd'] != "")
                                      <img src="{{asset($data_detail_inputan['gambar_apd'])}}" class="img-thumbnail" alt="APD">
                                  {{-- End jika hanya ada satu gambar --}}
                                  @endif
                              {{-- End jika gambar user ada --}}

                              {{-- Start jika tidak ada gambar user --}}
                              @elseif(is_null($data_detail_inputan['gambar_apd']) || $data_detail_inputan['gambar_apd'] === "")
                                <div class="jumbotron text-center">
                                  Tidak ada gambar yang ditampilkan.
                                </div>
                              @else
                                <div class="jumbotron text-center">
                                  Tidak ada gambar yang ditampilkan.
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
                                  @endif
                              {{-- End jika gambar template ada --}}

                              {{-- Start jika tidak ada gambar template --}}
                              @elseif(is_null($gambar_apd_template) || $gambar_apd_tempate === "")
                                <div class="jumbotron text-center">
                                  Tidak ada gambar yang ditampilkan.
                                </div>
                              @else
                                <div class="jumbotron text-center">
                                  Tidak ada gambar yang ditampilkan.
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
                                    <span class="badge badge-secondary text-center text-wrap my-auto align-middle">{{$data_detail_inputan['verifikasi_terakhir_update']}}</span>
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
                                      <span class="badge badge-{{$data_detail_inputan['warna_verifikasi']}} text-center text-wrap my-auto align-middle">{{$data_detail_inputan['status_verifikasi']}}</span>
                                  </div>
                                </div>
                                <div>
                                  <div>
                                    <strong>Terakhir Diubah :</strong>
                                  </div>
                                  <div class="text-center align-middle">
                                      <span class="badge badge-info text-center text-wrap my-auto align-middle">{{$data_detail_inputan['data_terakhir_update']}}</span>
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
          {{-- End Card lihat detail --}}

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" wire:click='simpan'>Simpan</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

  @once
      <script>

        window.addEventListener('cardProfil',event=>{
          $('#collapse-card-profil').collapse('show')
        })

        window.addEventListener('cardLihatFoto',event=>{
          $('#collapse-card-lihat-foto').collapse('show')
        })

        window.addEventListener('cardLihatDetail',event=>{
          $('#collapse-card-lihat-detail').collapse('show')
        })

      </script>
  @endonce

</div>

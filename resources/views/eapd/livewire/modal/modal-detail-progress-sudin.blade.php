<div>
    <div class="modal fade" id="modal-progres-sudin" wire:ignore.self>
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Progres Input {{$nama_pegawai}}</h4>
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
                                      <a class="apd-foto" wire:click="satuFoto('preview-foto-apd-anggota',{{$index}},{{$index_gbr}})" style="cursor: pointer;">
                                        <img alt="APD" class="table-avatar w-25 h-25" src="{{asset($gbr)}}">
                                      </a>
                                  @endforeach
                                </ul>
                              </div>
                              <a class="btn btn-primary d-block d-sm-none" wire:click="semuaFoto('preview-foto-apd-anggota',{{$index}})"><i class="fas fa-image"></i></a>
                            @elseif(is_string($item['gambar_apd']) && $item['gambar_apd'] != "")
                              {{-- Saat ada gambar dan berisi hanya satu --}}
                              <img alt="APD" class="table-avatar w-25 h-25 d-none d-sm-block" src="{{asset($gbr)}}">
                              <a class="btn btn-primary d-block d-sm-none" wire:click="semuaFoto('preview-foto-apd-anggota',{{$index}})" style="cursor: pointer;"><i class="fas fa-image"></i></a>
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
                              <textarea class="form-control" wire:model="temp_verifikasi_inputan.{{$index}}.komentar"  placeholder="(opsional) Tambah Komentar"></textarea>
                            </div>
                            
                          </td>
                          <td class="text-center text-wrap my-auto align-middle">
                            <button type="button" class="btn btn-secondary">Detail</button>
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
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" wire:click='simpan'>Simpan</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

{{-- <script>
    window.addEventListener('ModalProgresSudin', event=> {
            modal('modal-progres-sudin')
        })
</script> --}}
</div>

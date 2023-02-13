<div>
    <div class="card my-n3 mx-n3" id="rekap-tabel">
                        <div class="card-header">
                            <h3 class="card-title">{{$nama_periode}}</h3>
                        </div>
                        <!-- /.card-header -->
                        @if(!empty($data_rekap_apd))
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                                <table class="table text-nowrap">
                                    <thead class="text-center table-bordered" style="background-color: gray ;">
                                        <tr >
                                            <th rowspan="2" style="vertical-align:middle; background-color: gray ;">#</th>
                                            <th style="width:20%; vertical-align:middle; background-color: gray ;" rowspan="2" >Jenis APD</th>
                                            <th style="width:50%; background-color: gray ;" class="text-center" rowspan="2">Jumlah Input</th>
                                            <th style="width:10%; vertical-align:middle; background-color: gray ;" rowspan="2">Jumlah Pegawai</th>
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
                    @if (!empty($detail_data_rekap))
                        <table class="table table-head-fixed text-nowrap">
                            <thead class="text-center">
                                <tr>
                                    <th style="width:10%;">#</th>
                                    <th style="width:20%;">Item</th>
                                    <th style="width:20%;">Ukuran</th>
                                    <th style="width:20%;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail_data_rekap as $key => $item)
                                    <tr class="fire-jacket rusak-berat">
                                        <td class="text-center text-wrap my-auto align-middle">{{$key+1}}</td>
                                        <td class="text-center text-wrap my-auto align-middle">{{$item['nama_jenis']}}
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge badge-sm bg-{{$item['kondisi_warna']}}">S</span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="btn badge badge-sm bg-{{$item['verifikasi_warna']}}" data-toggle="modal" data-target="#modal-sm">40</span>
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
                </div>
            </div>
            <!-- /.modal-content -->
            <div class="modal fade" id="modal-sm">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Daftar Ukuran APD Pegawai</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                              <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">Tabel Ukuran</h3>
                  
                                  <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  
                                      <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                          <i class="fas fa-search"></i>
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" style="height: 300px;">
                                  <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Penempatan</th>
                                        <th>Item</th>
                                        <th>Ukuran</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>1</td>
                                        <td>John Doe</td>
                                        <td>Pos Cilingcing</td>
                                        <td><span class="tag tag-success">Fire Jacket</span></td>
                                        <td>L</td>
                                      </tr>
                                      <tr>
                                        <td>1</td>
                                        <td>Irawan Maulana</td>
                                        <td>Pos Cilingcing</td>
                                        <td><span class="tag tag-success">Fire Jacket</span></td>
                                        <td>S</td>
                                      </tr>
                                      <tr>
                                        <td>1</td>
                                        <td>Fariz Reza</td>
                                        <td>Pos Cilingcing</td>
                                        <td><span class="tag tag-success">Fire Jacket</span></td>
                                        <td>XL</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Print</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            {{-- modal end --}}
            <!-- {{-- Card untuk preview saat user klik satu gambar start --}} -->
                <div class="collapse" id="preview-foto-apd-anggota">
                        <div class="mt-5 mx-n3  card">
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
                                @if ($gambar == "")
                                    Tidak ada gambar.
                                @else
                                    <img src="{{asset($gambar)}}" class="img-thumbnail" alt="APD">
                                @endif
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
</div>

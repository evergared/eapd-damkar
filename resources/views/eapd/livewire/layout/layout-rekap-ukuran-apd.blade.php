<div>
    <div class="card my-n3 mx-n3" id="tabel-list-ukuran-apd" wire:ignore.self>
                        <div class="card-header">
                            <h3 class="card-title">{{$nama_periode}}</h3>

                        </div>
                        <!-- /.card-header -->
                        @if(!empty($data_ukuran))
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
                                        
                                        
                                        @foreach($data_ukuran['list_apd'] as $namaApd => $data )
                                        <tr>
                                            <td class="text-center text-wrap my-auto align-middle">{{array_search($namaApd,array_keys($data_ukuran['list_apd'])) + 1}}</td>
                                            <td class="text-center text-wrap my-auto align-middle">{{ str_replace("_", " ",$namaApd)}}
                                            </td>
                                            <td class="text-center align-middle">
                                                <a wire:click="lihatJumlahUkuran('{{$namaApd}}')" href="#rekap-tabel">{{ count($data['pegawai_yang_mengisi'])}}</a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a>{{$data_ukuran['keseluruhan_pegawai']}}</a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info float-left">Print Rekap Data Ukuran</button>
                                
                            </div>
                        @endif

                        @empty($data_ukuran)
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



    <div class="collapse" id="tabel-jumlah-ukuran-apd" wire:ignore.self>
            <div class="card my-n3 mx-n3">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="card-title">Tabel Ukuran</h4>
                    </div>
                    <div class="card-tools">
                        <a href="javascript:" onclick="kembaliKeListUkuranApd()">&larr; <u>kembali</u></a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    
                        <table class="table table-head-fixed text-nowrap" id="tabel-pegawai-yang-mengisi">
                            <thead class="text-center">
                                <tr>
                                    <th style="width:10%;">#</th>
                                    <th style="width:20%;">Item</th>
                                    <th style="width:20%;">Ukuran</th>
                                    <th style="width:20%;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if (!empty($detail_jumlah_ukuran))
                                  @foreach ($detail_jumlah_ukuran['ukuran'] as $nama_ukuran => $ukuran)
                                    <tr class="fire-jacket rusak-berat">
                                        <td class="text-center text-wrap my-auto align-middle">{{array_search($nama_ukuran,array_keys($detail_jumlah_ukuran['ukuran'])) + 1}}</td>
                                        <td class="text-center text-wrap my-auto align-middle">{{str_replace("_"," ",$detail_nama_apd)}}
                                        </td>
                                        <td class="text-center text-wrap my-auto align-middle">{{$nama_ukuran}}
                                        </td>
                                        <td class="text-center text-wrap my-auto align-middle"><a href="#modal-daftar-pegawai" wire:click="lihatDaftarPegawai(['{{$nama_ukuran}}'])">{{$ukuran['jumlah']}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                              @endif
                                
                                
                                
                            </tbody>
                        </table>
                    

                                <!-- /.card-body -->

                            

                            <!-- /.card -->
                </div>
            </div>
            <!-- /.modal-content -->
            <div class="modal fade" id="modal-daftar-pegawai">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Daftar Pegawai</h4>
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
                                </div>
                                <!-- /.card-header -->
                                  @livewire('eapd.datatable.tabel-daftar-pegawai-modal-data-ukuran')
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
            

    </div>


      {{-- Javascript --}}
      <script type="module">
         //function untuk ukuran apd
  window.addEventListener('tampilJumlahUkuranApd',event=>{
    $("#tabel-list-ukuran-apd").hide(500)
    $("#tabel-jumlah-ukuran-apd").collapse('show')
  })

  window.addEventListener('tampilModalDaftarPegawai',event=>{
     $('#modal-daftar-pegawai').modal('show')
  })

  function kembaliKeListUkuranApd(){
    $("#tabel-list-ukuran-apd").show(500)
    $("#tabel-jumlah-ukuran-apd").collapse('hide')
  }


      </script>

</div>

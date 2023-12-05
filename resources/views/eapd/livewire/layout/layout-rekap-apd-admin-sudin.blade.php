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

    <div class="collapse" id="collapse-detail-rekap" wire:ignore.self>
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
            </div>
            <!-- /.modal-content -->

<div class="collapse" id="detail-profil-rekap-apd-sudin">
              <div class="mt-5 col-sm-8 mx-auto">
              <div class="card">
                <div class="card-header">
                  <div class="card-tools">
                    <button type="button" class="close" data-toggle="collapse"
                        data-target="#detail-profil-rekap-apd-sudin" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <h4 class="d-none d-sm-block">Profil {{$profil_nama}}</h4>
                  <h5 class="d-block d-sm-none">Profil {{$profil_nama}}</h5>
                </div>
                <div class="card-body align-items-center">
                  @if ($id_detail_pegawai)
                      <div class="row">
                        <div class="col-sm-3 mx-2">
                          <img class="img-thumbnail" style="max-width:160px; max-height:160px;"
                            src="{{asset($profil_foto)}}">
                        </div>
                        <div class="col-sm-6 pl-sm-8">
                          <div class="row">
                            NIP/NIK : {{$profil_nip}}
                          </div>
                          <div class="row">
                            NRK/No PJLP : {{$profil_nrk}}
                          </div>
                          <div class="row">
                            Nama : {{$profil_nama}}
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

            <!-- {{-- Card untuk preview saat user klik satu gambar start --}} -->
        <div class="collapse" id="lihat-gambar-rekap-apd" wire:ignore.self>
            <div class="card mt-5 col-sm-6 mx-auto">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Preview Gambar APD</h5>
                    </div>
                    <div class="card-tools">
                        <button type="button" class="close" data-toggle="collapse"
                            data-target="#lihat-gambar-rekap-apd" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <div class="card-body text-center">
                    @if ($detail_gambar)
                        <img class="col-sm-10" alt="APD" src="{{asset($detail_gambar)}}">
                    @else
                        <div class="jumbotron text-center">
                            <strong>Tidak ada yang dapat ditampilkan.</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    <!-- {{-- Cart untuk preview saat user klik satu gambar end --}} -->


        </div>

        



        {{-- Javascript --}}
            <script>
                

                window.addEventListener('showDetailProfil',event=>{
                    $('#detail-profil-rekap-apd-sudin').collapse('show')
                })

                window.addEventListener('showLihatGambar',event=>{
                    console.log('show lihat gambar triggered')
                    $('#lihat-gambar-rekap-apd').collapse('show')
                })

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
                    $('#lihat-gambar-rekap-apd').collapse('hide')
                    $('#collapse-detail-rekap').collapse('hide')
                }
            </script>
</div>

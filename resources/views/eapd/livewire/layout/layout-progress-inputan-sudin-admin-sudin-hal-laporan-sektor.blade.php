<div  wire:ignore.self>
        <div class="card my-n3 mx-n3" id="input-sudin"  wire:ignore.self>
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
                                                        {{-- {{round(($pos['telah_diinput']/$pos['perlu_diinput']) * 100, 2 )}} --}}
                                                    </span>
                                            </td>
                                            
                                            <td class="project-state">
                                                <span class="badge badge-info">
                                                    {{-- {{round(($pos['telah_diverif']/$pos['perlu_diinput']) * 100, 2 )}} --}}
                                                </span>
                                            </td>
                                            <td>
                                                <a onclick="inputSudin()" class="btn btn-sm bg-teal">
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
                
            @endif
              
            </div>
            <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                  <div class="card-header text-muted border-bottom-0">
                    Sektor II
                  </div>
                  <div class="card-body table-responsive ">
                      <h2 class="lead"><b>Kebayoran Baru</b></h2>
                      <table class="table table-head-fixed text-nowrap">
                          <thead>
                              <tr>
                                  <th style="width: 1%">
                                      Pos
                                  </th>
                                  <th style="width: 5%">
                                      PNS
                                  </th>
                                  <th style="width: 5%">
                                      PJLP
                                  </th>
                                  <th style="width: 10%">
                                      Input(%)
                                  </th>
                                  <th style="width: 10%">
                                      Validasi(%)
                                  </th>
                                  <th style="width: 10%">
                                      Aksi
                                  </th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>
                                      Pos Kebayoran Baru
                                  </td>
                                  <td>
                                      8
                                  </td>
                                  <td>
                                      9
                                  </td>
                                  
                                  <td class="project-state">
                                          <span class="badge badge-success">100%</span>
                                  </td>
                                  
                                  <td class="project-state">
                                      <span class="badge badge-info">90%</span>
                                  </td>
                                  <td>
                                      <a href="#" class="btn btn-sm bg-teal">
                                          <i class="fas fa-wrench"></i>
                                        </a>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      Pos Kebayoran Baru Utara
                                  </td>
                                  <td>
                                      8
                                  </td>
                                  <td>
                                      8
                                  </td>
                                  
                                  <td class="project-state">
                                          <span class="badge badge-info">80%</span>
                                  </td>
                                  
                                  <td class="project-state">
                                      <span class="badge badge-info">80%</span>
                                  </td>
                                  <td>
                                      <a  class="btn btn-sm bg-teal" wire:click="panggilModal()" onclick="inputSudin()">
                                          <i class="fas fa-wrench"></i>
                                      </a>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      Pos Gandaria Utara
                                  </td>
                                  <td>
                                      8
                                  </td>
                                  <td>
                                      9
                                  </td>
                                  
                                  <td class="project-state">
                                          <span class="badge badge-secondary">0%</span>
                                  </td>
                                  
                                  <td class="project-state">
                                      <span class="badge badge-secondary">0%</span>
                                  </td>
                                  <td>
                                      <a href="#" class="btn btn-sm bg-teal">
                                          <i class="fas fa-wrench"></i>
                                      </a>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>    
                </div>
            </div>
          </div>
        </div>

        <div class="collapse" id="aksisudin" wire:ignore.self>
            <div class="card my-n3 mx-n3">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="card-title">Progress Rekap</h4>
                    </div>
                    <div class="card-tools">
                        <a href="javascript:" onclick="backToSudin()">&larr; <u>kembali</u></a>
                    </div>
                </div>
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
                                    <tr class="fire-jacket rusak-berat">
                                        <td class="text-center text-wrap my-auto align-middle">1</td>
                                        <td class="text-center text-wrap my-auto align-middle">Tardi</td>
                                        <td class="text-center text-wrap my-auto align-middle">Pengendali</td>
                                        
                                        <td class="project-state text-center text-wrap my-auto align-middle">
                                            <span class="badge badge-secondary">0%</span>
                                        </td>
                                        <td class="project-state text-center text-wrap my-auto align-middle">
                                            <span class="badge badge-secondary">0%</span>
                                        </td>
                                        <td class="text-center text-wrap my-auto align-middle">
                                            <a class="btn btn-sm bg-teal" wire:click="ModalProgresSudin()"  wire:ignore.self>
                                                <i class="fas fa-pencil-square-o">Edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="fire-jacket rusak-berat">
                                        <td class="text-center text-wrap my-auto align-middle">1</td>
                                        <td class="text-center text-wrap my-auto align-middle">Agus Suripto</td>
                                        <td class="text-center text-wrap my-auto align-middle">Pengendali</td>
                                        
                                        <td class="project-state text-center text-wrap my-auto align-middle">
                                            <span class="badge badge-secondary">0%</span>
                                        </td>
                                        <td class="project-state text-center text-wrap my-auto align-middle">
                                            <span class="badge badge-secondary">0%</span>
                                        </td>
                                        <td class="text-center text-wrap my-auto align-middle">
                                            <a href="#" class="btn btn-sm bg-teal">
                                                <i class="fas fa-pencil-square-o">Edit</i>
                                            </a>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>

        {{-- modal --}}
        <div>

        </div>
</div>
<script>
    window.addEventListener('ModalProgresSudin', event=> {
            modal('modal-progres-sudin')
        })
</script>

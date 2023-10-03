<div>
@include('eapd.dashboard.komponen.breadcrumbs',['halamanJudul'=>'Daftar Ukuran APD','halaman'=>'ukuran'])

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="card-body">
                      <div class="card card-primary card-tabs">
                          <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="navtab-ukuranku" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="tab-ukuran-tampil" data-toggle="pill" href="#tab-pane-ukuran-tampil" role="tab" aria-controls="tab-pane-ukuran-tampil" aria-selected="true">List Ukuran</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="tab-ukuran-form" data-toggle="pill" href="#tab-pane-ukuran-form" role="tab" aria-controls="tab-pane-ukuran-form" aria-selected="false">Ubah Ukuran</a>
                              </li>
                            </ul>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <div class="tab-content" id="tab-content-ukuranku">
                              <div class="tab-pane fade active show" id="tab-pane-ukuran-tampil" role="tabpanel" aria-labelledby="tab-ukuran-tampil">
                                <h2 class="mt-1 mb-4">List Ukuran</h2>
                                @if ($listUkuran)
                                  <div class="table-responsive">
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th>No</th>
                                          <th>Jenis APD</th>
                                          <th>Ukuran Terinput</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($listUkuran as $item)
                                            <tr>
                                              <td>{{$item["index"]}}</td>
                                              <td>{{$item["nama"]}}</td>
                                              <td>{{$item["ukuran"]}}</td>
                                            </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                @else
                                  <div class="jumbotron text-center">
                                    Tidak Ada Data Yang Dapat Ditampilkan.
                                  </div>  
                                @endif
                                
                              </div>
                              <div class="tab-pane fade" id="tab-pane-ukuran-form" role="tabpanel" aria-labelledby="tab-ukuran-form">
                                <h3>Ubah Data Ukuran</h3>
                                @if ($listKebutuhanUkuran)
                                  <div  class="card bg-secondary collapse fade show active" id="info-form-ukuran" wire:ignore.self>
                                    <div class="card-body">
                                      <div class="card-tools">
                                          <button type="button" class="close" data-toggle="collapse"
                                              data-target="#info-form-ukuran" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                          </button>
                                      </div>
                                      <div>
                                        Dibawah ini merupakan form untuk mengganti data ukuran anda.<br>
                                        Data yang dimasukan akan digunakan untuk dasar pengadaan APD berikutnya. <br>
                                        Pastikan bahwa data yang dimasukan sesuai dengan ukuran anda.<br>
                                      </div>
                                    </div>
                                  </div>
                        
                                  @if (session()->has('form-fail'))
                                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{session('form-fail')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                  @endif
                                  
                                  @if (session()->has('form-success'))
                                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{session('form-success')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                  @endif
                        
                                  <div>
                                    <div>
                                      <small><strong>Terakhir Diisi : <i>{{$tanggal}}</i></strong></small>
                                    </div>

                                    @foreach ($listKebutuhanUkuran as $i => $item)
                                    
                                        @if (($i % 2 == 0))
                                            <div class="row">
                                        @endif

                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <label>{{$item['nama_jenis']}}</label>
                                            <select class="form-control" wire:model="ukuranTerisi.{{$i}}">
                                              <option value="">Pilih Ukuran</option>
                                              @foreach ($item['opsi'] as $opsi)
                                                  <option>{{$opsi}}</option>   
                                              @endforeach
                                            </select>
                                          </div>
                                        </div>

                                        @if (($i % 2 != 0) || ($i == count($listKebutuhanUkuran)-1))
                                            </div>
                                        @endif
                                    
                                    @endforeach
                                  </div>
                                  <div class="form-group mt-4">
                                      <button class="btn btn-primary btn-md" wire:click="simpan">Simpan Perubahan</button>
                                      <button class="btn btn-secondary btn-md" type="button" wire:click="resetForm">Reset Input</button>
                                  </div>
                                @else
                                  <div class="jumbotron text-center">
                                    Periode Input Ukuran APD Belum Dibuka.
                                  </div>
                                @endif
                                
                                
                              </div>
                              <!-- /.card-body -->
                              </div>
                            </div>
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
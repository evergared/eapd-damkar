<div>
   <!-- Main row -->
   <div class="container-fluid" id="">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#apd" data-toggle="tab">APD</a></li>
          <li class="nav-item"><a class="nav-link" href="#ukuran" data-toggle="tab">Ukuran</a></li>
          <li class="nav-item"><a class="nav-link" href="#kondisi" data-toggle="tab">Kondisi</a></li>
        </ul>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
          <div class="active tab-pane" id="apd">
            <div class="col-lg-12 card card-info">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan Jenis APD</h3>
                </div>
                <form class="form-horizontal">
                    <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="info-kepegawaian-1">
                      <div class="card-body">
                        <div class="card-tools">
                            <button type="button" class="close" data-toggle="collapse"
                                data-target="#info-kepegawaian-1" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div>
                          Dibawah ini merupakan kendali untuk mengatur jenis APD.<br>
                          Gunakan kendali ini untuk menambah, mengedit, dan menghapus Jenis APD<br>
                          Gunakan tombol “List Barang” untuk menambahkan, menghapus, atau memindahkan barang APD pada Jenis tersebut. <br>
                          Perlu diingat, kendali ini hanya mengatur Barang APD yang bersifat non-suplai. <br>
                          Untuk Barang yang bersifat suplai, silahkan lanjut ke Pengaturan Barang Suplai APD.<br>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
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
                          <div class="card-body table-responsive p-0" >
                            <table class="table table-head-fixed text-nowrap">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Id</th>
                                  <th>Nama Jenis APD</th>
                                  <th>Jumlah Item</th>
                                  <th>Tindakan</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td class="align-middle">1</td>
                                  <td class="align-middle">D001</td>
                                  <td class="align-middle">Fire Helmet</td>
                                  <td class="align-middle">2</td>
                                  <td>
                                    <div class="row align-items-center align-middle">
                                      <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">List Barang</button></div>
                                      <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Edit</button></div>
                                      <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-danger btn-xs">Hapus</button></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">2</td>
                                    <td class="align-middle">D002</td>
                                    <td class="align-middle">Fire Jacket</td>
                                    <td class="align-middle">2</td>
                                    <td>
                                      <div class="row align-items-center align-middle">
                                        <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">List Barang</button></div>
                                        <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Edit</button></div>
                                        <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-danger btn-xs">Hapus</button></div>
                                      </div>
                                    </td>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
                          
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <div class="card-footer">
                          <button type="button" aria-controls="card-detail-periode" class="btn bg-gradient-primary float-right">Tambah Jenis APD</button>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    
                    {{-- onclick="periodeBaru()" href="#card-detail-periode" --}}
                    
                    <!-- /.card-footer -->
                </form>
            </div>
          </div>
          <!-- /.tab-pane -->

          <div class=" tab-pane" id="ukuran">
            <div class="col-lg-12 card card-info">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan Opsi Ukuran</h3>
                </div>
                <form class="form-horizontal">
                    <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="info-kepegawaian-1">
                      <div class="card-body">
                        <div class="card-tools">
                            <button type="button" class="close" data-toggle="collapse"
                                data-target="#info-kepegawaian-1" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div>
                          Dibawah ini merupakan kendali untuk mengatur Opsi Ukuran APD.<br>
                          Opsi ini akan muncul ketika user/pegawai melakukan input apd.<br>
                          Value dari opsi yang dipilih oleh user/pegawai akan masuk ke database,<br>
                          Jadi pastikan bahwa opsi ukuran yang dibuat sesuai dengan apd.<br>
                          Opsi yang dibuat dapat dikaitkan dengan banyak apd.<br>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
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
                          <div class="card-body table-responsive p-0" >
                            <table class="table table-head-fixed text-nowrap">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Id</th>
                                  <th>Nama</th>
                                  <th>Opsi</th>
                                  <th>Tindakan</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td class="align-middle">1</td>
                                  <td class="align-middle">D001</td>
                                  <td class="align-middle">Ukuran1</td>
                                  <td class="align-middle">Opsi1</td>
                                  <td>
                                    <div class="row align-items-center align-middle">
                                      <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Edit</button></div>
                                      <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-danger btn-xs">Hapus</button></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">2</td>
                                    <td class="align-middle">D002</td>
                                    <td class="align-middle">Ukuran2</td>
                                    <td class="align-middle">Opsi2</td>
                                    <td>
                                      <div class="row align-items-center align-middle">
                                        <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Edit</button></div>
                                        <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-danger btn-xs">Hapus</button></div>
                                      </div>
                                    </td>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
                          
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <div class="card-footer">
                          <button type="button" aria-controls="card-detail-periode" class="btn bg-gradient-primary float-right">Tambah Opsi Ukuran</button>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    
                    {{-- onclick="periodeBaru()" href="#card-detail-periode" --}}
                    
                    <!-- /.card-footer -->
                </form>
            </div>
          </div>
          <!-- /.tab-pane -->

          <div class=" tab-pane" id="kondisi">
            <div class="col-lg-12 card card-info">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan Opsi Kondisi APD</h3>
                </div>
                <form class="form-horizontal">
                    <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="info-kepegawaian-1">
                      <div class="card-body">
                        <div class="card-tools">
                            <button type="button" class="close" data-toggle="collapse"
                                data-target="#info-kepegawaian-1" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div>
                            Dibawah ini adalah kendali untuk mengatur label/text pada opsi kondisi apd.<br>
                            Opsi ini akan muncul ketika user/pegawai melakukan input apd.<br>
                            Value dari opsi ini melambangkan kondisi apd dari user/pegawai,<br>
                            Dan value tersebut akan disimpan di database sebagai : <br>
                            <ul>
                                <li>Baik</li>
                                <li>Rusak Ringan</li>
                                <li>Rusak Sedang</li>
                                <li>Rusak Berat</li>
                            </ul>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
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
                          <div class="card-body table-responsive p-0" >
                            <table class="table table-head-fixed text-nowrap">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Id</th>
                                  <th>Nama</th>
                                  <th>Opsi</th>
                                  <th>Tindakan</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td class="align-middle">1</td>
                                  <td class="align-middle">D001</td>
                                  <td class="align-middle">Fire Helmet</td>
                                  <td class="align-middle">Opsi1</td>
                                  <td>
                                    <div class="row align-items-center align-middle">
                                      <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Edit</button></div>
                                      <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-danger btn-xs">Hapus</button></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">2</td>
                                    <td class="align-middle">D002</td>
                                    <td class="align-middle">Fire Jacket</td>
                                    <td class="align-middle">Opsi2</td>
                                    <td>
                                      <div class="row align-items-center align-middle">
                                        <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Edit</button></div>
                                        <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-danger btn-xs">Hapus</button></div>
                                      </div>
                                    </td>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
                          
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <div class="card-footer">
                          <button type="button" aria-controls="card-detail-periode" class="btn bg-gradient-primary float-right">Tambah Opsi Kondisi</button>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    
                    {{-- onclick="periodeBaru()" href="#card-detail-periode" --}}
                    
                    <!-- /.card-footer -->
                </form>
            </div>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>


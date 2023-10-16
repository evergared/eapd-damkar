<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Ukuran</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">APD</a></li>
            <li class="breadcrumb-item active">Admin Dinas</li>
          </ol>
        </div>
      </div>
    </div>
</section>
<div>
    <div class="tab-pane" id="rekapitulasi" wire:ignore.self>
        <div class="card">  
            <div class="card-header">
                <div class="row flex">
                    <div class="col-sm-2">
                        <div class="form-group">
                          <label>Jenis APD</label>
                          <select class="form-control" id="wilayah" >
                            <option>Silahkan Pilih</option>
                            <option>Fire Jacket</option>
                            <option>Fire Shoes</option>
                            <option>Fire Helmet</option>
                            <option>Fire Suit</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Wilayah</label>
                            <select class="form-control" id="wilayah" >
                              <option>Silahkan Pilih</option>
                              <option>Kantor Dinas</option>
                              <option>UPT Diklat</option>
                              <option>Laboraturium</option>
                              <option>Sudin Pusat</option>
                              <option>Sudin Barat</option>
                              <option>Sudin Utara</option>
                              <option>Sudin Selatan</option>
                              <option>Sudin Timur</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Penempatan</label>
                        <select class="form-control" id="wilayah" >
                          <option>Silahkan Pilih</option>
                          <option>Bidang Pencegahan</option>
                          <option>Bidang Jasinfo</option>
                          <option>Bidang Sarana</option>
                          <option>Bidang Operasi</option>
                          <option>Bidang Sekretariat</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                          <label>Sub</label>
                          <select class="form-control" id="wilayah" >
                            <option>Silahkan Pilih</option>
                            <option>Kerjasama</option>
                            <option>Informasi</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="col-12 col-sm-6 col-md-3">
                        <div class="box p-2">
                          <a class="btn btn-app">
                            <i class="fas fa-edit"></i> Cetak
                          </a>
                        </div>
                      </div>
                    </div>
                </div>
                <h3 class="card-title">Periode TW3</h3>
            </div>
            <!-- /.card-header -->
            
            <div class="card-body table-responsive p-0" style="height: 1000px;">
                <table class="table text-nowrap">
                        <thead class="text-center table-bordered" style="background-color: gray ;">
                            <tr >
                                <th rowspan="2" style="vertical-align:middle; width:10%; background-color: gray ;">#</th>
                                <th style="width:50%; background-color: gray ;" class="text-center" colspan="7">Ukuran</th>
                                <th style="width:10%; vertical-align:middle; background-color: gray ;" rowspan="2">SubTotal</th>
                            </tr>
                            <tr class="table-head-fixed">
                                <th>XS</th>
                                <th>S</th>
                                <th>M</th>
                                <th>L</th>
                                <th>XL</th>
                                <th>XXL</th>
                                <th>XXXL</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                <td class="text-center text-wrap my-auto align-middle">1</td>
                                <td class="text-center align-middle">
                                    <a data-toggle="modal" data-target="#modal-ukuran" href="#">8</a>
                                </td>
                                <td class="text-center align-middle">
                                    <a onclick="#" href="#rekap-tabel">8</a>
                                </td>
                                <td class="text-center align-middle">
                                    <a onclick="#" href="#rekap-tabel">5</a>
                                </td>
                                <td class="text-center align-middle">
                                    <a onclick="#" href="#rekap-tabel">6</a>
                                </td>
                                <td class="text-center align-middle">
                                    <a onclick="#" href="#rekap-tabel">4</a>
                                </td>
                                <td class="text-center align-middle">
                                    <a onclick="#" href="#rekap-tabel">2</a>
                                </td>
                                <td class="text-center align-middle">
                                    <a onclick="#" href="#rekap-tabel">5</a>
                                </td>
                                <td class="text-center align-middle">
                                    <a onclick="#" href="#rekap-tabel">36</a>
                                </td>
                                
                            </tr>
                            
        
                        </tbody>
                </table>
            </div>
        
        
        <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal-ukuran">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Data Ukuran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="col-12">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Fire Jacket</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Nrk</th>
                          <th>Wilayah</th>
                          <th>Penempatan</th>
                          <th>Sub</th>
                          <th>Ukuran</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Indra Purwoko</td>
                          <td>123909</td>
                          <td>Sudin Selatan</td>
                          <td>Kantor Sudin</td>
                          <td>Tata Usaha</td>
                          <td>L</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Irawan Maulana</td>
                          <td>3234234</td>
                          <td>Sudin Selatan</td>
                          <td>Kantor Sudin</td>
                          <td>Tata Usaha</td>
                          <td>L</td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
        </div>
        <div class="modal-footer justify-content-end ">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
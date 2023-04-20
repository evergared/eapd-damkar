<div>
   <div class="container-fluid">
            <div class="row">
                <section class="d-flex justify-content-center col-lg-12 connectedSortable">
                    <div class="col-lg-12 card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Periode Setting</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="form-periode-setting">
                          <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="info-kepegawaian-1">
                            <div class="card-body">
                              <div class="card-tools">
                                  <button type="button" class="close" data-toggle="collapse"
                                      data-target="#info-kepegawaian-1" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                  </button>
                              </div>
                              <div>
                                Dibawah ini merupakan kendali untuk mengatur periode input.<br>
                                Pada kendali ini, dapat diatur : <br>
                                <ul class="mt-2">
                                  <li>
                                    Tanggal awal dan akhir periode input 
                                  </li>
                                  <li>
                                    Pesan Berjalan pada Dasboard
                                  </li>
                                  <li>
                                    Template inputan / Apa saja yang akan di input oleh tiap-tiap tipe pegawai
                                  </li>
                                </ul>
                                Periode inputan akan berjalan secara otomatis ketika sudah masuk tanggal awal jika periode di aktifkan.<br>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-12">
                              <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">Table List Periode Setting</h3>
                  
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
                                        <th>Nama Periode</th>
                                        <th>Tanggal Awal</th>
                                        <th>Tanggal Akhir</th>
                                        <th>Aktif</th>
                                        <th>Tindakan</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td class="align-middle">1</td>
                                        <td class="align-middle">P001</td>
                                        <td class="align-middle">TW-01</td>
                                        <td class="align-middle">1-Januari-2023</td>
                                        <td class="align-middle">1-Maret-2023</td>
                                        <td class="align-middle"><span>Aktiv</span></td>
                                        <td>
                                          <div class="row align-items-center align-middle">
                                            <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Clone</button></div>
                                            <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Active</button></div>
                                            <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Detail</button></div>
                                            <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-danger btn-xs">Hapus</button></div>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="align-middle">1</td>
                                        <td class="align-middle">P002</td>
                                        <td class="align-middle">TW-02</td>
                                        <td class="align-middle">1-April-2023</td>
                                        <td class="align-middle">1-Juli-2023</td>
                                        <td class="align-middle"><span>Nonaktiv</span></td>
                                        <td>
                                          <div class="row align-items-center align-middle">
                                            <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Clone</button></div>
                                            <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Active</button></div>
                                            <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Detail</button></div>
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
                                <button type="button" aria-controls="card-detail-periode" onclick="periodeBaru()" href="#card-detail-periode" class="btn bg-gradient-primary float-right">Buat Periode Baru</button>
                            </div>
                          </div>
                          <!-- /.card-body -->
                          
                          
                          <!-- /.card-footer -->
                        </form>
                        
                        <div class="collapse" id="card-detail-periode" wire:ignore.self>
                            <div class="card" >
                                  <div class="card card-primary" id="detail-periode">
                                    <div class="card-header">
                                      <div class="">
                                        <div class="card-tools float-right">
                                            <a href="javascript:" onclick="backToPeriodeBaru()">&larr; <u>kembali</u></a>
                                        </div>
                                      </div>
                                      <h3 class="card-title">Detail Periode</h3>
                                    </div>
                                    <div class="card-body">
                                      <!-- Date -->
                                      <div class="form-group">
                                        <label>Nama Periode:</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                              
                                          </div>
                                      </div>
                                      <!-- Date and time -->
                                      <div class="form-group">
                                        <label>Tanggal Awal :</label>
                                          <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                                              <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label>Tanggal Akhir :</label>
                                          <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                                              <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label>Pesan Berjalan :</label>
                                          <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                                              
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label>Aktiv :</label>
                                        <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                          <label class="custom-control-label" for="customSwitch1"></label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card-footer">
                                      <button type="button"  class="btn bg-gradient-primary float-left" onclick="templateInputan()" href="#card-template-inputan-apd">Atur Template Imputan Apd</button>
                                      <button type="button"  class=" d-none d-sm-block btn bg-gradient-primary float-right">Simpan</button>
                                      <button type="button"  class=" d-block d-sm-none btn bg-gradient-primary float-left">Simpan</button>
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                            </div>
                            
                        </div>

                        <div class="collapse" id="atur-template-imputan-apd" wire:ignore.self>
                            <div class="card card-primary">
                              <div class="card-header">
                                <div>
                                  <div class="card-tools float-right">
                                    <a href="javascript:" onclick="backToTemplateInputan()" href="#card-detail-periode">&larr; <u>kembali</u></a>
                                  </div>
                                </div>
                                <h3 class="card-title">Atur Template Inputan APD</h3>
                              </div>
                              <div class="card-body">
                                <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="info-kepegawaian-2">
                                    <div class="card-body">
                                      <div class="card-tools">
                                          <button type="button" class="close" data-toggle="collapse"
                                              data-target="#info-kepegawaian-2" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                          </button>
                                      </div>
                                      <div>
                                        Dibawah ini merupakan kendali untuk mengatur Template Inputan APD per Jabatan.<br>
                                        Kendali ini mengatur tipe apd apa saja yang perlu diinput oleh pegawai pada periode yang telah dipilih  <br>
                                        Berikut APD apa saja yang perlu diinput <br>
                                        Klik tombol "Tambah Dalam Jumlah Besar" untuk penambahan secara seragam
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-12">
                                    <div class="card">
                                      <div class="card-header">
                                        <h3 class="card-title">Table Setting Per-Jabatan</h3>
                        
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
                                              <th>Jabatan</th>
                                              <th>Jenis Apd</th>
                                              <th>Apd</th>
                                              <th>Tindakan</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                                <td class="align-middle">1</td>
                                                <td class="align-middle">PJLP Pemadam Kebakaran</td>
                                                <td class="align-middle">Fire Jakcet</td>
                                                <td class="align-middle">Spider Gear</td>
                                                <td>
                                                    <div class="row align-items-center align-middle">
                                                    <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-primary btn-xs" onclick="editTemplateInputanApd()" href="#atur-template-imputan-apd">Edit</button></div>
                                                    <div class="col p-1"><button type="button" class="btn btn-block bg-gradient-danger btn-xs">Hapus</button></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle">1</td>
                                                <td class="align-middle">PJLP Pemadam Kebakaran</td>
                                                <td class="align-middle">Fire Helemet</td>
                                                <td class="align-middle">Fulgard Helm</td>
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
                                    <div class="card-footer float-right">
                                        <button type="button" aria-controls="card-detail-periode" class="btn bg-gradient-primary" onclick="tambahTemplateJumlahBesar()" href="#atur-template-imputan-apd">Tambah Dalam Jumlah Besar</button>
                                        <button type="button" aria-controls="card-detail-periode" class="btn bg-gradient-primary" onclick="tambahTemplateInputanApd()" href="#atur-template-imputan-apd">Tambah</button>
                                        <button type="button" aria-controls="card-detail-periode" class="btn bg-gradient-primary d-none d-sm-inline-block">Simpan</button>
                                        <button type="button" aria-controls="card-detail-periode" class="btn bg-gradient-primary d-block d-sm-none float-right">Simpan</button>
                                    </div>
                                    <!-- /.card -->
                                  </div>
                                  
                              </div>
                            </div>
                        </div>

                        <div class="collapse" id="edit-template-inputan-apd" wire:ignore.self>
                            <div class="card" >
                                  <div class="card card-primary">
                                    <div class="card-header">
                                      <div class="">
                                        <div class="card-tools float-right">
                                            <a href="javascript:" onclick="backToEditTemplateInputanApd()">&larr; <u>kembali</u></a>
                                        </div>
                                      </div>
                                      <h3 class="card-title">Edit Template Inputan</h3>
                                    </div>
                                    <div class="card-body">
                                      <!-- Date -->
                                      <div class="form-group">
                                        <label>Jabatan:</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-edit-template">Ubah</button>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label>Jenis APD:</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-edit-template">Ubah</button>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label>APD:</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-edit-template">Ubah</button>
                                          </div>
                                      </div>
                                      
                                    </div>
                                    <div class="card-footer">
                                      <button type="button"  class="btn bg-gradient-primary float-left" onclick="backToEditTemplateInputanApd()">Kembali</button>
                                      <button type="button"  class=" d-none d-sm-block btn bg-gradient-primary float-right">Simpan</button>
                                      <button type="button"  class=" d-block d-sm-none btn bg-gradient-primary float-left">Simpan</button>
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                            </div>
                            
                        </div>

                        <div class="collapse" id="tambah-template-inputan-apd" wire:ignore.self>
                            <div class="card" >
                                  <div class="card card-primary">
                                    <div class="card-header">
                                      <div class="">
                                        <div class="card-tools float-right">
                                            <a href="javascript:" onclick="backToTambahTemplateInputanApd()">&larr; <u>kembali</u></a>
                                        </div>
                                      </div>
                                      <h3 class="card-title">Tambah Template Inputan</h3>
                                    </div>
                                    <div class="card-body">
                                      <!-- Date -->
                                      <div class="form-group">
                                        <label>Jabatan:</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                              <button>Ubah</button>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label>Jenis APD:</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                              <button>Ubah</button>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label>APD:</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                              <button>Ubah</button>
                                          </div>
                                      </div>
                                      
                                    </div>
                                    <div class="card-footer">
                                      <button type="button"  class="btn bg-gradient-primary float-left" onclick="backToTambahTemplateInputanApd()">Kembali</button>
                                      <button type="button"  class=" d-none d-sm-block btn bg-gradient-primary float-right">Simpan</button>
                                      <button type="button"  class=" d-block d-sm-none btn bg-gradient-primary float-left">Simpan</button>
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                            </div>
                            
                        </div>

                        <div class="collapse" id="tambah-template-jumlah-besar" wire:ignore.self>
                            <div class="card" >
                                  <div class="card card-primary">
                                    <div class="card-header">
                                      <div class="">
                                        <div class="card-tools float-right">
                                            <a href="javascript:" onclick="backToTambahTemplateJumlahBesar()">&larr; <u>kembali</u></a>
                                        </div>
                                      </div>
                                      <h3 class="card-title">Tambah Template Jumlah Besar</h3>
                                    </div>
                                    <div class="card-body">
                                      <!-- Date -->
                                      <div class="form-group">
                                        <label>Jabatan:</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-tambah-template-besar">Tambah</button>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label>Jenis APD:</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-tambah-template-besar">Tambah</button>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label>APD:</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-tambah-template-besar">Tambah</button>
                                          </div>
                                      </div>
                                      
                                    </div>
                                    <div class="card-footer">
                                      <button type="button"  class="btn bg-gradient-primary float-left" onclick="backToTambahTemplateJumlahBesar()">Kembali</button>
                                      <button type="button"  class=" d-none d-sm-block btn bg-gradient-primary float-right">Simpan</button>
                                      <button type="button"  class=" d-block d-sm-none btn bg-gradient-primary float-left">Simpan</button>
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                            </div>
                            
                        </div>
                      </div>
                    <!-- /.card -->
                </section>
            </div>
    </div>
    <livewire:eapd.modal.modal-periode-setting>
    
</div>

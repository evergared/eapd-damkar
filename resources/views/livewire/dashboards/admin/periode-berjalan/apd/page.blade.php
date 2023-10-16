<div>
    @include('komponen.breadcrumbs',[ 'halamanJudul'=>'Inputan Saat Ini','halaman'=>'admin-progress-apd'])
    <livewire:komponen.marquee>

    <section class="content">
        <div class="container-fluid">
            <div class="collapse active show" id="kendali">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#progres" data-toggle="tab">Progress</a></li>
                            <li class="nav-item"><a class="nav-link" href="#rekapitulasi" data-toggle="tab">Rekapitulasi</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="progres">
                                <div class="row">
                                    <div class="col">
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
                                    <div class="col">
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
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Inputan </label>
                                            <a href="#"><div class="progress progress-sm">
                                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                              </div>
                                            </div></a>
                                            <small>
                                                57% Complete
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Validasi</label>
                                            <a href="#"><div class="progress progress-sm">
                                              <div class="progress-bar bg-info" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                              </div>
                                            </div></a>
                                            <small>
                                                57% Complete
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Data Tabel</h3>
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
                                                        <th>Inputan</th>
                                                        <th>Validasi</th>
                                                        <th></th>
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
                                                        <td class="project_progress">
                                                        <a href="#" onclick="detailProgress()"><div class="progress progress-sm">
                                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                                            </div>
                                                        </div></a>
                                                        <small>
                                                            57% Complete
                                                        </small>
                                                        </td>
                                                        <td class="project_progress">
                                                        <a href="#"><div class="progress progress-sm">
                                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                                            </div>
                                                        </div></a>
                                                        <small>
                                                            57% Complete
                                                        </small>
                                                        </td>
                                                        <td class="project-actions text-right text-center">
                                                        <a class="btn btn-info btn-sm" href="#" onclick="detailProgress()">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                            Detail
                                                        </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Irawan Maulana</td>
                                                        <td>3234234</td>
                                                        <td>Sudin Selatan</td>
                                                        <td>Kantor Sudin</td>
                                                        <td>Tata Usaha</td>
                                                        <td class="project_progress">
                                                        <a href="#"><div class="progress progress-sm">
                                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                            </div>
                                                        </div></a>
                                                        <small>
                                                            40% Complete
                                                        </small>
                                                        </td>
                                                        <td class="project_progress">
                                                        <a href="#"><div class="progress progress-sm">
                                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                                            </div>
                                                        </div></a>
                                                        <small>
                                                            57% Complete
                                                        </small>
                                                        </td>
                                                        <td class="project-actions text-right text-center">
                                                        <a class="btn btn-info btn-sm" href="#" onclick="detailProgress()">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                            Detail
                                                        </a>
                                                        </td>
                                                    </tr>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="rekapitulasi">
                                <h3>Periode TW</h3>
                                <div class="table-responsive p-0" style="height: 1000px;">
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
                                                <tr>
                                                <td class="text-center text-wrap my-auto align-middle">1</td>
                                                <td class="text-center text-wrap my-auto align-middle">Fire Jacket
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a onclick="detailRekapitulasi()" href="#rekap-tabel">8</a>
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
                                                    <a onclick="#" href="#rekap-tabel">6</a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a onclick="#" href="#rekap-tabel">2</a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a onclick="#" href="#rekap-tabel">2</a>
                                                </td>
                                            </tr>
                                            
                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

                 {{-- detail progress --}}
            <div class="collapse" id="detail-progress">
                <div class="card">
                <div class="card-header">
                    <div class="row flex">
                    <div class="col-sm-3">
                        <h5>Nama :</h5>
                        <h5>Indra Purwoko</h5>
                    </div>
                    <div class="col-sm-3">
                        <h5>Penempatan :</h5>
                        <h5>Sudin Jakarta Selatan</h5>
                    </div>
                    <div class="col-sm-3">
                        <h5>Sub :</h5>
                        <h5>Tata Usaha</h5>
                    </div>
                    <div class="col-sm-3 text-right">
                        <button class="btn-primary btn-sm" onclick="backToDataApd()">
                        <i class="fas fa-arrow-left"></i>
                        </button>
                        
                    </div>
                    </div>
                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th>
                                Jenis APD
                            </th>
                            <th style="width: 30%" class=" text-center">
                                Foto
                            </th>
                            
                            <th class="text-center">
                                Status
                            </th>
                            
                            <th class="text-center">
                                Validasi
                            </th>
                            <th >
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    <a>
                                        Fire Boots
                                    </a>
                                    <br/>
                                    <small>
                                        Magnum
                                    </small>
                                    <small>
                                    L
                                    </small>
                                </td>
                                <td>
                                    <ul class="list-inline">
                                        <li class="list-inline-item w-25">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                            <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2" alt="white sample"/>
                                        </a>
                                        </li>
                                        <li class="list-inline-item w-25">
                                        <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                                            <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample"/>
                                        </a>
                                        </li>
                                        <li class="list-inline-item w-25">
                                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3" data-toggle="lightbox" data-title="sample 3 - red" data-gallery="gallery">
                                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3" class="img-fluid mb-2" alt="red sample"/>
                                        </a>
                                        </li>
                                    </ul>
                                </td>
                                <td class="project-state text-center">
                                <span class="badge badge-secondary">Belum Terima</span><br>
                                
                                </td>
                                <td class="project-state text-center">
                                    <span class="badge badge-secondary">Menunggu Validasi</span><br>
                                    
                                </td>
                                <td class="project-actions text-right text-center">
                                    <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#modal-edit">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    <a>
                                        Fire Jacket
                                    </a>
                                    <br/>
                                    <small>
                                        Spider Gear
                                    </small>
                                    <small>
                                    L
                                    </small>
                                </td>
                                <td>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                                        </li>
                                        <li class="list-inline-item">
                                            <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar2.png">
                                        </li>
                                    </ul>
                                </td>
                                <td class="project-state text-center">
                                <span class="badge badge-success">Ada</span><br>
                                <span class="badge badge-warning">Rusak Sedang</span>
                                </td>
                                <td class="project-state text-center">
                                    <span class="badge badge-success">Validasi Oleh</span><br>
                                    <span class="badge badge-success">Sukur Sarwono</span>
                                </td>
                                <td class="project-actions text-right text-center">
                                    
                                    <a class="btn btn-info btn-sm" href="#">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            
            {{-- detail rekapitulasi --}}
            <div class="collapse" id="detail-rekapitulasi">
            <div class="card">           
                <div class="card-header">
                <div class="row flex">
                    <div class="col-sm-6">
                    <h5>Jenis :</h5>
                    <h5>Fire Jacket</h5>
                    </div>
                    <div class="col-sm-6 text-right">
                    <button class="btn-primary btn-sm" onclick="backToRekapitulasi()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    
                    </div>
                </div>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                </div>
                </div>
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th>
                            APD
                            </th>
                            <th>
                                Nama
                            </th>
                            <th>
                                Nrk
                            </th>
                            <th>
                            Wilayah
                            </th>
                            <th>
                            Penempatan
                            </th>
                            <th>
                            Sub
                            </th>
                            <th style="width: 30%" class=" text-center">
                                Foto
                            </th>
                            
                            <th class="text-center">
                                Status
                            </th>
                            
                            <th class="text-center">
                                Validasi
                            </th>
                            <th >
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                1
                            </td>
                            <td>
                                <a>
                                    Spider Gear
                                </a>
                                <br/>
                                <small>
                                    L
                                </small>
                            </td>
                            <td>
                                Indra Purwoko
                            </td>
                            <td>
                                1235235
                            </td>
                            <td>
                                Sudin Selatan
                            </td>
                            <td>
                                Kantor Sudin
                            </td>
                            <td>
                                Tata Usaha
                            </td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item w-25">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2" alt="white sample"/>
                                        </a>
                                    </li>
                                    <li class="list-inline-item w-25">
                                        <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample"/>
                                        </a>
                                    </li>
                                    <li class="list-inline-item w-25">
                                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3" data-toggle="lightbox" data-title="sample 3 - red" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3" class="img-fluid mb-2" alt="red sample"/>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                            <td class="project-state text-center">
                                <span class="badge badge-success">Terima</span><br>
                                <span class="badge badge-success">Baik</span>
                            </td>
                            <td class="project-state text-center">
                                <span class="badge badge-success">Validasi</span><br>
                                <span class="badge badge-success">Sukur Sarwono</span>
                            </td>
                            <td class="project-actions text-right text-center">
                                <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#modal-edit">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            </div>

        </div>


       


    </section>

    

    
    {{-- modals --}}
    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Validasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row flex">  
              <div class="col-lg">
                <div class="form-group">
                    <label>Validasi</label>
                    <select class="form-control" id="validasi">
                      <option>Validasi</option>
                      <option>Ditolak</option>
                    </select>
                </div>
              </div>
              <div class="col-lg">
                <div class="form-group">
                  <label>Catatan</label>
                  <textarea class="form-control" rows="1" placeholder="Enter ..."></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    
    {{-- rekapitulasi --}}
    
    
    
    
    @push('stack-body')
    <script>
    
        function detailProgress(Id,Filter){
          
          console.log("Id",Id)
          $("#kendali").hide(500)
          $("#detail-progress").collapse('show')
        }
      
        function backToDataApd(){
          $("#kendali").show(500)
          $("#detail-progress").collapse('hide')
        }
      
        function detailRekapitulasi(Id,Filter){
          console.log("Id",Id)
          $("#kendali").hide(500)
          $("#detail-rekapitulasi").collapse('show')
        }
      
        function backToRekapitulasi(){
          $("#kendali").show(500)
          $("#detail-rekapitulasi").collapse('hide')
        }
      
        $(function () {
          $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
              alwaysShowClose: true
            });
          });
      
          $('.filter-container').filterizr({gutterPixels: 3});
          $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
          });
        })
      </script>
      <script src="{{ asset('admin-lte/ekko-lightbox.min.js')}}"></script>
    @endpush
    
    
    
</div>

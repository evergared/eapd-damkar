<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>2</h3>

                <p>Jumlah APD Tertolak</p>
            </div>
            <div class="icon">
                <i class="ion ion-filing"></i>
            </div>
            <a href="#modal-jumlah" data-toggle="modal" data-target="#modal-jumlah" class="small-box-footer">informasi <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>2</h3>

                <p>Jumlah APD Rusak</p>
            </div>
            <div class="icon">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <a href="#modal-rusak" data-toggle="modal" data-target="#modal-rusak" class="small-box-footer">Informasi <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>100<sup style="font-size: 20px">%</sup></h3>

                <p>Capaian Input APD</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#modal-capaian" data-toggle="modal" data-target="#modal-capaian" class="small-box-footer">Informasi <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>100<sup style="font-size: 20px">%</sup></h3>

                <p>Tervalidasi</p>
            </div>
            <div class="icon">
                <i class="fa fa-thumbs-up"></i>
            </div>
            <a href="#modal-validasi" data-toggle="modal" data-target="#modal-validasi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

{{-- modal jumlah apd--}}
<div class="modal fade" id="modal-jumlah">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Jumlah Tertolak</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="card bg-danger">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap">
                    <thead >
                      <tr>
                        <th class="bg-danger">Jenis APD</th>
                        <th class="bg-danger">Keterangan</th>
                        <th class="bg-danger">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Fire Googgles</td>
                        <td>Rusak</td>
                        <td>Tertolak</td>
                        
                      </tr>
                      <tr>
                        <td>Kampak</td>
                        <td>Rusak</td>
                        <td>Tertolak</td>
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
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
{{-- modal apd rusak--}}
<div class="modal fade" id="modal-rusak">
    <div class="modal-dialog">
      <div class="modal-content bg-warning">
        <div class="modal-header">
          <h4 class="modal-title">APD Rusak</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="card bg-warning">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap">
                    <thead >
                      <tr>
                        <th class="bg-warning">Jenis APD</th>
                        <th class="bg-warning">Keterangan</th>
                        <th class="bg-warning">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Fire Helemet</td>
                        <td>Rusak</td>
                        <td>Menunggu Verifikasi</td>
                      </tr>
                      <tr>
                        <td>Fire Boots</td>
                        <td>Rusak</td>
                        <td>Tervalidasi</td>
                      </tr>
                      <tr>
                        <td>Fire Gloves</td>
                        <td>Rusak</td>
                        <td>Tervalidasi</td>
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
          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
{{-- modal capaian--}}
<div class="modal fade" id="modal-capaian">
    <div class="modal-dialog">
      <div class="modal-content bg-success">
        <div class="modal-header">
          <h4 class="modal-title">Capaian Input APD</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="card bg-success">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap">
                    <thead >
                      <tr>
                        <th class="bg-success">Jenis APD</th>
                        <th class="bg-success">Keterangan</th>
                        <th class="bg-success">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Fire Helemet</td>
                        <td>Rusak</td>
                        <td>Menunggu Verifikasi</td>
                      </tr>
                      <tr>
                        <td>Fire Boots</td>
                        <td>Rusak</td>
                        <td>Tervalidasi</td>
                      </tr>
                      <tr>
                        <td>Fire Gloves</td>
                        <td>Rusak</td>
                        <td>Menunggu Verifikasi</td>
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
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
{{-- modal validasi--}}
<div class="modal fade" id="modal-validasi">
    <div class="modal-dialog">
      <div class="modal-content bg-info">
        <div class="modal-header">
          <h4 class="modal-title">Validasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="card bg-info">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap">
                    <thead >
                      <tr>
                        <th class="bg-info">Jenis APD</th>
                        <th class="bg-info">Keterangan</th>
                        <th class="bg-info">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Fire Helemet</td>
                        <td>Rusak</td>
                        <td>Menunggu Verifikasi</td>
                      </tr>
                      <tr>
                        <td>Fire Boots</td>
                        <td>Rusak</td>
                        <td>Tervalidasi</td>
                      </tr>
                      <tr>
                        <td>Fire Gloves</td>
                        <td>Rusak</td>
                        <td>Menunggu Verifikasi</td>
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
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
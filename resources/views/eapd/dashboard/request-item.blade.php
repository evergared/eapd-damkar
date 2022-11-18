@extends('eapd.layouts.adminlte-dashboard',['title'=>'Request Item'])



@section('content')

@include('eapd.dashboard.komponen.breadcrumbs')
@include('eapd.dashboard.komponen.marquee-informasi')

<section class="content">
    <div class="container-fluid">
        @include('eapd.dashboard.komponen.statbox')
        @include('eapd.dashboard.komponen.progress-inputan')

        <!-- Main row -->
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Fire Boots</h4>

                </div>
                <div class="card card-solid">
                    <div class="card-body">
                        <div class="row">
                            <div class="">
                                <h3 class="d-inline-block d-sm-none">Request Item</h3>
                            </div>
                            <div class="col-12 col-sm-6">
                                <p>
                                <div class="form-group">
                                    <label>Model Item</label>
                                    <select class="form-control">
                                        <option>Filter Respirator</option>
                                        <option>Fire Helemet</option>
                                        <option>Fire Boots</option>
                                    </select>
                                </div>
                                </p>
                                <p>
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <select class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                    </select>
                                </div>
                                </p>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>

                                <div class="mt-4">
                                    <div class="btn btn-primary btn-m btn-flat rounded-pill">
                                        <i class="fas fa-save fa-lg mr-2"></i>
                                        Simpan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div> -->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tabel Request Item</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>183</td>
                                    <td>Indra Purwoko</td>
                                    <td>11-7-2014</td>
                                    <td>Filter Respirator</td>
                                    <td>4</td>
                                    <td><span class="tag tag-success">Diterima</span></td>
                                </tr>
                                <tr>
                                    <td>183</td>
                                    <td>Indra Purwoko</td>
                                    <td>11-7-2014</td>
                                    <td>Filter Respirator</td>
                                    <td>4</td>
                                    <td><span class="tag tag-danger">Ditolak</span></td>
                                </tr>
                                <tr>
                                    <td>183</td>
                                    <td>Indra Purwoko</td>
                                    <td>11-7-2014</td>
                                    <td>Filter Respirator</td>
                                    <td>4</td>
                                    <td><span class="tag tag-success">Diterima</span></td>
                                </tr>
                                <tr>
                                    <td>183</td>
                                    <td>Indra Purwoko</td>
                                    <td>11-7-2014</td>
                                    <td>Filter Respirator</td>
                                    <td>4</td>
                                    <td><span class="tag tag-warning">Ditunda</span></td>
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
</section>



@endsection
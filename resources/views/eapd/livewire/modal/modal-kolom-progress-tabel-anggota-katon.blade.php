@todo #2
<div wire:ignore.self class="modal fade" id="modal-kolom-progress-tabel-anggota-katon">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Large Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Fixed Header Table</h3>

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
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width:20%;">Item</th>
                                            <th style="width:60%; height: 60%;" class="text-center">Foto
                                            </th>
                                            <th style="width:20%;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Fire Jacket</td>
                                            <td>
                                                <ul class="list-inline w-50">
                                                    <li class="list-inline-item w-75">
                                                        <img alt="Avatar" class="table-avatar w-25 h-25"
                                                            src="{{asset('storage/img/apd/placeholder/firejacket_2.jpg')}}">
                                                    </li>
                                                    <li class="list-inline-item w-75">
                                                        <img alt="Avatar" class="table-avatar w-25 h-25"
                                                            src="{{asset('storage/img/apd/placeholder/firejacket_2.jpg')}}">
                                                    </li>
                                                    <li class="list-inline-item w-75">
                                                        <img alt="Avatar" class="table-avatar w-25 h-25"
                                                            src="{{asset('storage/img/apd/placeholder/firejacket_2.jpg')}}">
                                                    </li>
                                                </ul>
                                            </td>
                                            <td><span class="badge badge-secondary">Proses Input</span>
                                            </td>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
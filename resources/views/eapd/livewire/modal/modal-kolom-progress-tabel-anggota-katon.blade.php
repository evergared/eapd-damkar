<div wire:ignore.self class="modal fade" id="modal-kolom-progress-tabel-anggota-katon">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Progress Input {{$nama_pegawai}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{$nama_periode}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th style="width:20%;">Item</th>
                                            <th style="width:50%; height: 60%;" class="text-center">Foto yang diupload
                                            </th>
                                            <th style="width:20%;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center text-wrap my-auto align-middle">1</td>
                                            <td class="text-center text-wrap my-auto align-middle">Fire Jacket
                                            </td>
                                            <td>
                                                <div class=" d-none d-sm-block">
                                                    <ul class="list-inline w-50">
                                                        <li class="list-inline-item w-75 ">
                                                            <a class="apd-foto" data-toggle="collapse"
                                                                data-target="#preview-foto-apd-anggota"
                                                                style="cursor: pointer;">
                                                                <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                    src="{{asset('storage/img/apd/placeholder/firejacket_2.jpg')}}">
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item w-75">
                                                            <a class="apd-foto" data-toggle="collapse"
                                                                data-target="#preview-foto-apd-anggota"
                                                                style="cursor: pointer;">
                                                                <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                    src="{{asset('storage/img/apd/placeholder/firejacket_2.jpg')}}">
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item w-75">
                                                            <a class="apd-foto" data-toggle="collapse"
                                                                data-target="#preview-foto-apd-anggota"
                                                                style="cursor: pointer;">
                                                                <img alt="Avatar" class="table-avatar w-75 h-75"
                                                                    src="{{asset('storage/img/apd/placeholder/firejacket_2.jpg')}}">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="text-center align-middle d-block d-sm-none">

                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="collapse"
                                                        data-target="#preview-semua-foto-apd-anggota">Lihat
                                                        Foto</button>
                                                </div>

                                            </td>
                                            <td class="text-center align-middle"><span
                                                    class="badge badge-secondary">Proses
                                                    Input</span>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- Card untuk preview saat user klik satu gambar start --}}
                        <div class="collapse" id="preview-foto-apd-anggota">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h5>Preview Gambar APD</h5>
                                    </div>
                                    <div class="card-tools">
                                        <button type="button" class="close" data-toggle="collapse"
                                            data-target="#preview-foto-apd-anggota" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    isinya satu gambar yang diklik
                                </div>
                            </div>
                        </div>
                        {{-- Cart untuk preview saat user klik satu gambar end --}}

                        {{-- Card untuk preview saat viewport hp start--}}
                        <div class="collapse" id="preview-semua-foto-apd-anggota">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h5>Nama APD</h5>
                                    </div>
                                    <div class="card-tools">
                                        <button type="button" class="close" data-toggle="collapse"
                                            data-target="#preview-semua-foto-apd-anggota" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    isinya semua gambar yang diupload
                                </div>
                            </div>
                        </div>
                        {{-- Card untuk preview saat viewport hp end --}}

                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <script>
        document.eventListener
    </script>

</div>
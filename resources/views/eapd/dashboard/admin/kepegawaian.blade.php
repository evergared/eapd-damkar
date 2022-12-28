@extends('eapd.layouts.adminlte-dashboard',['title'=>'Dashboard Pegawai'])

@section('content')


@include('eapd.dashboard.komponen.breadcrumbs',[ 'halamanJudul'=>'Dashboard','halaman'=>'dashboard'])
@include('eapd.dashboard.komponen.marquee-informasi')

<section class="content">
    <div class="container-fluid">
        <livewire:eapd.layout.layout-statbox>
            {{-- @include('eapd.dashboard.komponen.statbox') --}}
            <div class="row">


                {{-- @include('eapd.dashboard.komponen.progress-inputan') --}}

                <section class="d-flex justify-content-center col-lg-12 connectedSortable">
                    <div class="col-lg-12 card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Form Kepegawaian</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal">
                          <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Sektor I Kebayoran Lama</h3>
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body table-responsive p-0" style="height: 400px;">
                              <table class="table table-head-fixed text-nowrap">
                                  <thead>
                                      <tr>
                                          <th style="width: 1%">
                                              No
                                          </th>
                                          <th style="width: 20%">
                                              Nama
                                          </th>
                                          <th style="width: 15%">
                                              Pos
                                          </th>
                                          <th style="width: 10%">
                                             Foto
                                          </th>
                                          <th style="width: 10%">
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
                                                  Agus Suripto
                                              </a>
                                          </td>
                                          <td>
                                            <a>
                                              Kantor Sektor I
                                            </a>
                                          </td>
                                          <td>
                                              <ul class="list-inline">
                                                  <li class="list-inline-item">
                                                      <img alt="Avatar" class="table-avatar h-100 w-100" src="../../dist/img/avatar.png">
                                                  </li>
                                              </ul>
                                          </td>
                                          <td class="project-actions text-right">
                                            <a class="btn btn-primary" data-toggle="modal" data-target="#modal-kepegawaian">Edit</a>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                              1
                                          </td>
                                          <td>
                                              <a>
                                                  Reza
                                              </a>
                                          </td>
                                          <td>
                                            <a>
                                              Pos Gandaria
                                            </a>
                                          </td>
                                          <td>
                                              <ul class="list-inline">
                                                  <li class="list-inline-item">
                                                      <img alt="Avatar" class="table-avatar h-100 w-100" src="../../dist/img/avatar.png">
                                                  </li>
                                              </ul>
                                          </td>
                                          <td class="project-actions text-right">
                                            <a class="btn btn-primary" data-toggle="modal" data-target="#modal-kepegawaian">Edit</a>
                                          </td>
                                      </tr>  
                                  </tbody>
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card-footer -->
                        </form>
                      </div>
                    <!-- /.card -->
                </section>

                {{-- modals --}}
                <div class="modal fade" id="modal-kepegawaian">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Default Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>One fine body&hellip;</p>
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
                {{-- modals end --}}

            </div>
    </div>
</section>
@endsection
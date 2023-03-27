@extends('eapd.layouts.adminlte-dashboard',['title'=>'Laporan APD Admin Sektor'])

@section('content')


@include('eapd.dashboard.komponen.breadcrumbs',[ 'halamanJudul'=>'Print Laporan','halaman'=>'print-laporan'])
@include('eapd.dashboard.komponen.marquee-informasi')

<section class="content">
    <div class="container-fluid">
        {{-- <livewire:eapd.layout.layout-statbox> --}}
            {{-- @include('eapd.dashboard.komponen.statbox') --}}
            <div class="row">


                {{-- @include('eapd.dashboard.komponen.progress-inputan') --}}

                <section class="d-flex justify-content-center col-lg-12 connectedSortable">
                    <div class="col-lg-12 card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Form Laporan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal">
                          <div class="card-body">
                            <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10">
                                <div class="form-check">
                                    <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                          <label>Pilih TW</label>
                                          <select class="form-control">
                                            <option>TW 1 2022</option>
                                            <option>TW 2 2022</option>
                                            <option>TW 3 2022</option>
                                            <option>TW 4 2022</option>
                                            <option>TW 5 2023</option>
                                          </select>
                                        </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                            <button type="submit" class="btn btn-info">Print Rekap APD</button>
                            <button type="submit" class="btn btn-info float-right">Print KIB APD</button>
                          </div>
                          <!-- /.card-footer -->
                        </form>
                      </div>
                    <!-- /.card -->
                </section>


            </div>
    </div>
</section>
@endsection
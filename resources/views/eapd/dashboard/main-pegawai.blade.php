@extends('eapd.layouts.adminlte-dashboard',['title'=>'Dashboard Pegawai'])

@section('content')


@include('eapd.dashboard.komponen.breadcrumbs',[ 'halamanJudul'=>'Dashboard','halaman'=>'dashboard'])
@include('eapd.dashboard.komponen.marquee-informasi')

<section class="content">
    <div class="container-fluid">
        @include('eapd.dashboard.komponen.statbox')
        <div class="row">


            @include('eapd.dashboard.komponen.progress-inputan')

            <section class="d-flex justify-content-center col-lg-12 connectedSortable">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Kedinasan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                            <div id="accordion">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                1. Peluncuran aplikasi e-APD
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                            terry
                                            richardson ad squid.
                                            3
                                            wolf moon officia aute, non cupidatat skateboard dolor brunch. Food
                                            truck
                                            quinoa
                                            nesciunt
                                            laborum
                                            eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                            single-origin coffee
                                            nulla
                                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                            labore
                                            wes
                                            anderson cred
                                            nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                            Leggings
                                            occaecat craft
                                            beer
                                            farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                                            heard
                                            of
                                            them accusamus
                                            labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                                2. Masa Percobaan Input e-APD
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                            terry
                                            richardson ad squid.
                                            3
                                            wolf moon officia aute, non cupidatat skateboard dolor brunch. Food
                                            truck
                                            quinoa
                                            nesciunt
                                            laborum
                                            eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                            single-origin coffee
                                            nulla
                                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                            labore
                                            wes
                                            anderson cred
                                            nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                            Leggings
                                            occaecat craft
                                            beer
                                            farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                                            heard
                                            of
                                            them accusamus
                                            labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                                3. Update Aplikasi e-APD
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                            terry
                                            richardson ad squid.
                                            3
                                            wolf moon officia aute, non cupidatat skateboard dolor brunch. Food
                                            truck
                                            quinoa
                                            nesciunt
                                            laborum
                                            eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                            single-origin coffee
                                            nulla
                                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                            labore
                                            wes
                                            anderson cred
                                            nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                            Leggings
                                            occaecat craft
                                            beer
                                            farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                                            heard
                                            of
                                            them accusamus
                                            labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.card -->
            </section>

            @if (auth()->user()->data->jabatan->level_user == 'danton')


            <div class=" col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Progres Anggota</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <div>

                            @push('stack-head')
                            @livewireStyles
                            @endpush

                            @push('stack-body')
                            @livewireScripts
                            @endpush

                            <livewire:tabel-anggota-katon />

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>




            <div class="modal fade" id="modal-lg">
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
                                                    <input type="text" name="table_search"
                                                        class="form-control float-right" placeholder="Search">

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

            @endif


        </div>
    </div>
</section>
@endsection
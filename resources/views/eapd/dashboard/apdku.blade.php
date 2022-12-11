@extends('eapd.layouts.adminlte-dashboard',['title'=>'Dashboard Pegawai'])

@section('content')


@include('eapd.dashboard.komponen.breadcrumbs',[ 'halamanJudul'=>'APDku','halaman'=>'apdku'])
@include('eapd.dashboard.komponen.marquee-informasi')

<section class="content">
    <div class="container-fluid">
        @include('eapd.dashboard.komponen.statbox')
        <div class="row">
            <!-- Left col -->
            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header position-relative">
                                    <h4 class="card-title">List APD</h4>
                                    <div>
                                        <div class="btn-group w-100 mb-2">
                                            <a class="btn btn-info active" href="javascript:void(0)" data-filter="all">
                                                All items </a>
                                            <a class="btn btn-info" href="javascript:void(0)" data-filter="baik"> Baik
                                            </a>
                                            <a class="btn btn-info" href="javascript:void(0)" data-filter="rusak"> Rusak
                                            </a>
                                            <a class="btn btn-info" href="javascript:void(0)" data-filter="ringan">
                                                Rusak Ringan </a>
                                            <a class="btn btn-info" href="javascript:void(0)" data-filter="proses">
                                                Proses Input APD </a>
                                        </div>
                                        <div class="mb-2">
                                            <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle> Shuffle
                                                items </a>
                                            <div class="float-right">
                                                <select class="custom-select" style="width: auto;" data-sortOrder>
                                                    <option value="index"> Sort by Position </option>
                                                    <option value="sortData"> Sort by Custom Data </option>
                                                </select>
                                                <div class="btn-group">
                                                    <a class="btn btn-default" href="javascript:void(0)" data-sortAsc>
                                                        Ascending </a>
                                                    <a class="btn btn-default" href="javascript:void(0)" data-sortDesc>
                                                        Descending </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="filter-container p-0 row">
                                            <div class="filter-item col-sm-2" data-category="rusak"
                                                data-sort="white sample">
                                                <a
                                                    onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                    <div class="ribbon-wrapper">
                                                        <!-- KONDISI RIBON
                                          -Baik
                                          -Ringan
                                          -Rusak -->
                                                        <div class="ribbon bg-danger">
                                                            Rusak
                                                        </div>
                                                    </div>
                                                    <!--  KONDISI PROSES
                                        -Proses Input
                                        -Validasi
                                        -tervalidasi
                                        -tertolak
                                        -update -->
                                                    <img src="{{asset('storage/img/apd/placeholder/firehelmet_1.jpg')}}"
                                                        class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                    <span>Fire Helmet</span><br><span
                                                        class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filter-item col-sm-2" data-category="baik"
                                                data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-gradient-green">
                                                            Baik
                                                        </div>
                                                    </div>
                                                    <img src="{{asset('storage/img/apd/placeholder/rescuehelmet_1.jpg')}}"
                                                        class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                    <span>Rescue Helmet</span><br>
                                                    <span class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filter-item col-sm-2" data-category="baik"
                                                data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-gradient-green">
                                                            Baik
                                                        </div>
                                                    </div>
                                                    <img src="{{asset('storage/img/apd/placeholder/firegoggles_1.jpg')}}"
                                                        class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                    <span>Fire Googgles</span><br>
                                                    <span class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filter-item col-sm-2" data-category="ringan"
                                                data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-warning">
                                                            Ringan
                                                        </div>
                                                    </div>
                                                    <img src="{{asset('storage/img/apd/placeholder/firejacket_2.jpg')}}"
                                                        class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                    <span>Fire Jacket</span><br>
                                                    <span class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filter-item col-sm-2" data-category="ringan"
                                                data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-warning">
                                                            Ringan
                                                        </div>
                                                    </div>
                                                    <img src="{{asset('storage/img/apd/placeholder/jumpsuit_1.jpg')}}"
                                                        class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                    <span>Jumpsuit</span><br>
                                                    <span class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filter-item col-sm-2" data-category="ringan"
                                                data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-warning">
                                                            Ringan
                                                        </div>
                                                    </div>
                                                    <img src="{{asset('storage/img/apd/placeholder/rescueboots_1.jpg')}}"
                                                        class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                    <span>Rescue Boots</span><br>
                                                    <span class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filter-item col-sm-2" data-category="ringan"
                                                data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-warning">
                                                            Ringan
                                                        </div>
                                                    </div>
                                                    <img src="{{asset('storage/img/apd/placeholder/fireboots_1.jpg')}}"
                                                        class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                    <span>Fire Boots</span><br>
                                                    <span class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filter-item col-sm-2" data-category="ringan"
                                                data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-warning">
                                                            Ringan
                                                        </div>
                                                    </div>
                                                    <img src="{{asset('storage/img/apd/placeholder/firegloves_2.jpg')}}"
                                                        class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                    <span>Fire Gloves</span><br>
                                                    <span class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filter-item col-sm-2" data-category="ringan"
                                                data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-warning">
                                                            Ringan
                                                        </div>
                                                    </div>
                                                    <img src="{{asset('storage/img/apd/placeholder/rescuegloves_1.jpg')}}"
                                                        class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                    <span>Rescue Gloves</span><br>
                                                    <span class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filter-item col-sm-2" data-category="ringan"
                                                data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-warning">
                                                            Ringan
                                                        </div>
                                                    </div>
                                                    <img src="{{asset('storage/img/apd/placeholder/respirator_2.jpg')}}"
                                                        class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                    <span>Respirator</span><br>
                                                    <span class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filter-item col-sm-2" data-category="proses"
                                                data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-secondary">
                                                            Proses
                                                        </div>
                                                    </div>
                                                    <img src="{{asset('storage/img/apd/placeholder/kapak_1.jpg')}}"
                                                        class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                    <span>Kapak</span><br>
                                                    <span class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filter-item col-sm-2" data-category="proses"
                                                data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-secondary">
                                                            Proses
                                                        </div>
                                                    </div>
                                                    <img src="{{asset('storage/img/apd/placeholder/senter_1.jpg')}}"
                                                        class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                    <span>Senter</span><br>
                                                    <span class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->

                @push('stack-head')
                @livewireStyles
                @endpush
                @push('stack-body')
                @livewireScripts
                @endpush
                <livewire:eapd.modal.modal-input-apd-pegawai-hal-apdku>




            </section>
            <!-- right col -->
        </div>
    </div>
</section>


{{-- @foreach ($list_apd as $i)
{{$i['nama_apd']}}<br>
size :
<ul>
    @foreach ($i['size_apd'] as $size)
    <li>{{$size}}</li>
    @endforeach
</ul>
@endforeach --}}

{{-- {{dd($list_apd)}} --}}

<script>
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
@endsection
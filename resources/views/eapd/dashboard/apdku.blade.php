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
                                    <div class="main">

                                        <h1></h1>
                                        <hr>

                                        <h2></h2>

                                        <div id="myBtnContainer">
                                            <button class="btn active" onclick="filterSelection('all')"> Show
                                                all</button>
                                            <button class="btn" onclick="filterSelection('nature')"> Proses
                                                Input</button>
                                            <button class="btn" onclick="filterSelection('cars')"> Proses
                                                Validasi</button>
                                            <button class="btn" onclick="filterSelection('people')">
                                                Tervalidasi</button>
                                        </div>

                                        <!-- Portfolio Gallery Grid -->
                                        <div class="row">
                                            <div class="column cars">
                                                <div class="content">
                                                    <a
                                                        onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                        <div class="ribbon-wrapper">
                                                            {{-- <div class="ribbon bg-danger">
                                                                Rusak
                                                            </div> --}}
                                                        </div>
                                                        <img src="{{asset('storage/img/apd/placeholder/firehelmet_1.jpg')}}"
                                                            class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                        <span>Fire Helmet</span><br><span
                                                            class="bg-primary color-palette h6">Proses Vaildasi</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="column nature">
                                                <div class="content">
                                                    <a
                                                        onclick="modal('modal-input-apd-pegawai-hal-apdku','H002','modalInputApdPegawai')">
                                                        <div class="ribbon-wrapper">
                                                            {{-- <div class="ribbon bg-danger">
                                                                Rusak
                                                            </div> --}}
                                                        </div>
                                                        <img src="{{asset('storage/img/apd/placeholder/rescuehelmet_1.jpg')}}"
                                                            class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                        <span>Rescue Helmet</span><br><span
                                                            class="bg-secondary color-palette h6">Proses Input</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="column nature">
                                                <div class="content">
                                                    <a
                                                        onclick="modal('modal-input-apd-pegawai-hal-apdku','A001','modalInputApdPegawai')">
                                                        <div class="ribbon-wrapper">
                                                            {{-- <div class="ribbon bg-danger">
                                                                Rusak
                                                            </div> --}}
                                                        </div>
                                                        <img src="{{asset('storage/img/apd/placeholder/firegoggles_1.jpg')}}"
                                                            class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                        <span>Fire Googgles</span><br><span
                                                            class="bg-secondary color-palette h6">Proses Input</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="column nature">
                                                <div class="content">
                                                    <a
                                                        onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                        <div class="ribbon-wrapper">
                                                            {{-- <div class="ribbon bg-danger">
                                                                Rusak
                                                            </div> --}}
                                                        </div>
                                                        <img src="{{asset('storage/img/apd/placeholder/firejacket_2.jpg')}}"
                                                            class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                        <span>Fire Jacket</span><br><span
                                                            class="bg-secondary color-palette h6">Proses Input</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="column nature">
                                                <div class="content">
                                                    <a
                                                        onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                        <div class="ribbon-wrapper">
                                                            {{-- <div class="ribbon bg-danger">
                                                                Rusak
                                                            </div> --}}
                                                        </div>
                                                        <img src="{{asset('storage/img/apd/placeholder/jumpsuit_1.jpg')}}"
                                                            class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                        <span>Jumsuit</span><br><span
                                                            class="bg-secondary color-palette h6">Proses Input</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="column nature">
                                                <div class="content">
                                                    <a
                                                        onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                        <div class="ribbon-wrapper">
                                                            {{-- <div class="ribbon bg-danger">
                                                                Rusak
                                                            </div> --}}
                                                        </div>
                                                        <img src="{{asset('storage/img/apd/placeholder/rescueboots_1.jpg')}}"
                                                            class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                        <span>Rescue Boots</span><br><span
                                                            class="bg-secondary color-palette h6">Proses Input</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="column nature">
                                                <div class="content">
                                                    <a
                                                        onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                        <div class="ribbon-wrapper">
                                                            {{-- <div class="ribbon bg-danger">
                                                                Rusak
                                                            </div> --}}
                                                        </div>
                                                        <img src="{{asset('storage/img/apd/placeholder/fireboots_1.jpg')}}"
                                                            class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                        <span>Fire Boots</span><br><span
                                                            class="bg-secondary color-palette h6">Proses Input</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="column nature">
                                                <div class="content">
                                                    <a
                                                        onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                        <div class="ribbon-wrapper">
                                                            {{-- <div class="ribbon bg-danger">
                                                                Rusak
                                                            </div> --}}
                                                        </div>
                                                        <img src="{{asset('storage/img/apd/placeholder/firegloves_2.jpg')}}"
                                                            class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                        <span>Fire Gloves</span><br><span
                                                            class="bg-secondary color-palette h6">Proses Input</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="column nature">
                                                <div class="content">
                                                    <a
                                                        onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                        <div class="ribbon-wrapper">
                                                            {{-- <div class="ribbon bg-danger">
                                                                Rusak
                                                            </div> --}}
                                                        </div>
                                                        <img src="{{asset('storage/img/apd/placeholder/rescuegloves_1.jpg')}}"
                                                            class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                        <span>Rescue Gloves</span><br><span
                                                            class="bg-secondary color-palette h6">Proses Input</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="column nature">
                                                <div class="content">
                                                    <a
                                                        onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                        <div class="ribbon-wrapper">
                                                            {{-- <div class="ribbon bg-danger">
                                                                Rusak
                                                            </div> --}}
                                                        </div>
                                                        <img src="{{asset('storage/img/apd/placeholder/respirator_2.jpg')}}"
                                                            class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                        <span>Respirator</span><br><span
                                                            class="bg-secondary color-palette h6">Proses Input</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="column nature">
                                                <div class="content">
                                                    <a
                                                        onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                        <div class="ribbon-wrapper">
                                                            {{-- <div class="ribbon bg-danger">
                                                                Rusak
                                                            </div> --}}
                                                        </div>
                                                        <img src="{{asset('storage/img/apd/placeholder/kapak_1.jpg')}}"
                                                            class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                        <span>Kapak</span><br><span
                                                            class="bg-secondary color-palette h6">Proses Input</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="column nature">
                                                <div class="content">
                                                    <a
                                                        onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                        <div class="ribbon-wrapper">
                                                            {{-- <div class="ribbon bg-danger">
                                                                Rusak
                                                            </div> --}}
                                                        </div>
                                                        <img src="{{asset('storage/img/apd/placeholder/senter_1.jpg')}}"
                                                            class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                        <span>Senter</span><br><span
                                                            class="bg-secondary color-palette h6">Proses Input</span>
                                                    </a>
                                                </div>
                                            </div>

                                            <!-- END GRID -->
                                        </div>

                                        <!-- END MAIN -->
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
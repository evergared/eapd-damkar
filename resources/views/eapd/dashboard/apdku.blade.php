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

                {{-- <div class="container-fluid">
                    <div class="row-filter">
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

                                        
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="row">
                                                    <div class="column cars">
                                                      <div class="content">
                                                          <div class="ribbon-wrapper ribbon-lg">
                                                              <a onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                                  
                                                                      
                                                                  
                                                                  <img src="{{asset('storage/img/apd/placeholder/firehelmet_1.jpg')}}"
                                                                      class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                                  <span class="text-body">Fire Helmet</span><br><span class="bg-primary color-palette h6">Proses Vaildasi</span>
                                                              </a>
                                                              
                                                          </div>
                                                      </div>
                                                    </div>
                                                    <div class="column nature">
                                                      <div class="content">
                                                              <a onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                                  <div class="ribbon-wrapper">
                                                                      
                                                                  </div>
                                                                  <img src="{{asset('storage/img/apd/placeholder/rescuehelmet_1.jpg')}}"
                                                                      class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                                  <span>Rescue Helmet</span><br><span class="bg-secondary color-palette h6">Proses Input</span>
                                                              </a>
                                                      </div>
                                                    </div>
                                                    <div class="column nature">
                                                      <div class="content">
                                                              <a onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                                  <div class="ribbon-wrapper">
                                                                      
                                                                  </div>
                                                                  <img src="{{asset('storage/img/apd/placeholder/firegoggles_1.jpg')}}"
                                                                      class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                                  <span>Fire Googgles</span><br><span class="bg-secondary color-palette h6">Proses Input</span>
                                                              </a>
                                                      </div>
                                                    </div>
                                                    <div class="column nature">
                                                      <div class="content">
                                                              <a onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                                  <div class="ribbon-wrapper">
                                                                      
                                                                  </div>
                                                                  <img src="{{asset('storage/img/apd/placeholder/firejacket_2.jpg')}}"
                                                                      class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                                  <span>Fire Jacket</span><br><span class="bg-secondary color-palette h6">Proses Input</span>
                                                              </a>
                                                      </div>
                                                    </div>
                                                    <div class="column nature">
                                                      <div class="content">
                                                              <a onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                                  <div class="ribbon-wrapper">
                                                                      
                                                                  </div>
                                                                  <img src="{{asset('storage/img/apd/placeholder/jumpsuit_1.jpg')}}"
                                                                      class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                                  <span>Jumsuit</span><br><span class="bg-secondary color-palette h6">Proses Input</span>
                                                              </a>
                                                      </div>
                                                    </div>
                                                    <div class="column nature">
                                                      <div class="content">
                                                              <a onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                                  <div class="ribbon-wrapper">
                                                                      
                                                                  </div>
                                                                  <img src="{{asset('storage/img/apd/placeholder/rescueboots_1.jpg')}}"
                                                                      class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                                  <span>Rescue Boots</span><br><span class="bg-secondary color-palette h6">Proses Input</span>
                                                              </a>
                                                      </div>
                                                    </div>
                                                    <div class="column nature">
                                                      <div class="content">
                                                              <a onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                                  <div class="ribbon-wrapper">
                                                                      
                                                                  </div>
                                                                  <img src="{{asset('storage/img/apd/placeholder/fireboots_1.jpg')}}"
                                                                      class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                                  <span>Fire Boots</span><br><span class="bg-secondary color-palette h6">Proses Input</span>
                                                              </a>
                                                      </div>
                                                    </div>
                                                    <div class="column nature">
                                                      <div class="content">
                                                              <a onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                                  <div class="ribbon-wrapper">
                                                                      
                                                                  </div>
                                                                  <img src="{{asset('storage/img/apd/placeholder/firegloves_2.jpg')}}"
                                                                      class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                                  <span>Fire Gloves</span><br><span class="bg-secondary color-palette h6">Proses Input</span>
                                                              </a>
                                                      </div>
                                                    </div>
                                                    <div class="column nature">
                                                      <div class="content">
                                                              <a onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                                  <div class="ribbon-wrapper">
                                                                      
                                                                  </div>
                                                                  <img src="{{asset('storage/img/apd/placeholder/rescuegloves_1.jpg')}}"
                                                                      class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                                  <span>Rescue Gloves</span><br><span class="bg-secondary color-palette h6">Proses Input</span>
                                                              </a>
                                                      </div>
                                                    </div>
                                                    <div class="column nature">
                                                      <div class="content">
                                                              <a onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                                  <div class="ribbon-wrapper">
                                                                      
                                                                  </div>
                                                                  <img src="{{asset('storage/img/apd/placeholder/respirator_2.jpg')}}"
                                                                      class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                                  <span>Respirator</span><br><span class="bg-secondary color-palette h6">Proses Input</span>
                                                              </a>
                                                      </div>
                                                    </div>
                                                    <div class="column nature">
                                                      <div class="content">
                                                              <a onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                                  <div class="ribbon-wrapper">
                                                                      
                                                                  </div>
                                                                  <img src="{{asset('storage/img/apd/placeholder/kapak_1.jpg')}}"
                                                                      class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                                  <span>Kapak</span><br><span class="bg-secondary color-palette h6">Proses Input</span>
                                                              </a>
                                                      </div>
                                                    </div>
                                                    <div class="column nature">
                                                      <div class="content">
                                                              <a onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                                                  <div class="ribbon-wrapper">
                                                                      
                                                                  </div>
                                                                  <img src="{{asset('storage/img/apd/placeholder/senter_1.jpg')}}"
                                                                      class="img-fluid mb-0 h-75 w-100" alt="white sample">
                                                                  <span>Senter</span><br><span class="bg-secondary color-palette h6">Proses Input</span>
                                                              </a>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> --}}
                <!-- /.container-fluid -->

                @push('stack-head')
                @livewireStyles
                @endpush
                @push('stack-body')
                @livewireScripts
                @endpush
                <livewire:eapd.modal.modal-input-apd-pegawai-hal-apdku>
            </section>

            <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Ribbons</h3> <br>
                          <div id="myBtnContainer">
                            <button class="btn active" onclick="filterSelection('all')"> Show all</button>
                            <button class="btn" onclick="filterSelection('proses-input')"> Proses Input</button>
                            <button class="btn" onclick="filterSelection('proses-verifikasi')"> Proses Validasi</button>
                            <button class="btn" onclick="filterSelection('Tervalidasi')"> Tervalidasi</button>
                            <button class="btn" onclick="filterSelection('rusak')"> Rusak</button>
                            <button class="btn" onclick="filterSelection('rusak-sedang')"> Rusak Sedang</button>
                            <button class="btn" onclick="filterSelection('baik')"> Baik</button>
                          </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <div class="row">
                            {{--            Status validasi (proses-input,proses-validasi,validasi,update,tertolak) dan keterangan APD(baik,rusak,rusak-sedang)  start       --}}
                            <div class="column proses-verifikasi rusak small-box col-lg-2 bg-teal" 
                            onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                             {{--            Status validasi (proses-input,proses-validasi,validasi,update,tertolak) dan keterangan APD(baik,rusak,rusak-sedang)  end       --}}
                              <div class="position-relative p-3" style="height: 180px">
                                <div class="ribbon-wrapper">
                                  <div class="ribbon bg-danger">
                                    {{-- Keterangan Ribon start --}}
                                    Rusak
                                    {{-- Keterangan Ribon end --}}
                                  </div>
                                </div>
                                Fire Helmet <br />
                                <img src="{{asset('storage/img/apd/placeholder/firehelmet_1.jpg')}}"
                                                class="img-fluid mb-0 h-75 w-75" alt="white sample"> <br>
                                {{-- Keterangan Validasi start --}}
                                <small class="bg-primary">Proses Verifikasi</small>
                                {{-- Keterangan Validasi start --}}
                              </div>
                            </div>
                            <div class="column proses-verifikasi baik small-box col-lg-2 bg-teal" onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                <div class="position-relative p-3 " style="height: 180px">
                                  <div class="ribbon-wrapper">
                                    <div class="ribbon bg-success">
                                      Baik
                                    </div>
                                  </div>
                                  Rescue Helmet <br />
                                  <img src="{{asset('storage/img/apd/placeholder/rescuehelmet_1.jpg')}}"
                                                  class="img-fluid mb-0 h-75 w-75" alt="white sample"> <br>
                                  <small class="bg-primary">Proses Verifikasi</small>
                                </div>
                            </div>
                            <div class="column proses-input proses small-box col-lg-2 bg-teal" onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                <div class="position-relative p-3 " style="height: 180px">
                                  <div class="ribbon-wrapper">
                                    <div class="ribbon bg-secondary">
                                      Proses
                                    </div>
                                  </div>
                                  Fire Googgles <br />
                                  <img src="{{asset('storage/img/apd/placeholder/firegoggles_1.jpg')}}"
                                                  class="img-fluid mb-0 h-75 w-75" alt="white sample"> <br>
                                  <small class="bg-secondary">Proses Input</small>
                                </div>
                            </div>
                            <div class="column proses-input proses small-box col-lg-2 " onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                <div class="position-relative p-3 bg-teal" style="height: 180px">
                                  <div class="ribbon-wrapper">
                                    <div class="ribbon bg-secondary">
                                      proses
                                    </div>
                                  </div>
                                  Fire Jacket <br />
                                  <img src="{{asset('storage/img/apd/placeholder/firejacket_2.jpg')}}"
                                                  class="img-fluid mb-0 h-75 w-75" alt="white sample"> <br>
                                  <small class="bg-secondary">Proses Input</small>
                                </div>
                            </div>
                            <div class="column proses-input proses small-box col-lg-2" onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                <div class="position-relative p-3 bg-gray" style="height: 180px">
                                  <div class="ribbon-wrapper">
                                    <div class="ribbon bg-secondary">
                                      proses
                                    </div>
                                  </div>
                                  Jumsuit <br />
                                  <img src="{{asset('storage/img/apd/placeholder/jumpsuit_1.jpg')}}"
                                                  class="img-fluid mb-0 h-75 w-75" alt="white sample"> <br>
                                  <small class="bg-secondary">Proses Input</small>
                                </div>
                            </div>
                            <div class="column proses-input proses small-box col-lg-2" onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                <div class="position-relative p-3 bg-gray" style="height: 180px">
                                  <div class="ribbon-wrapper">
                                    <div class="ribbon bg-secondary">
                                      proses
                                    </div>
                                  </div>
                                  Rescue Boots <br />
                                  <img src="{{asset('storage/img/apd/placeholder/rescueboots_1.jpg')}}"
                                                  class="img-fluid mb-0 h-75 w-75" alt="white sample"> <br>
                                  <small class="bg-secondary">Proses Input</small>
                                </div>
                            </div>
                            <div class="column proses-input proses small-box col-lg-2" onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                <div class="position-relative p-3 bg-gray" style="height: 180px">
                                  <div class="ribbon-wrapper">
                                    <div class="ribbon bg-secondary">
                                      proses
                                    </div>
                                  </div>
                                  Fire Boots <br />
                                  <img src="{{asset('storage/img/apd/placeholder/fireboots_1.jpg')}}"
                                                  class="img-fluid mb-0 h-75 w-75" alt="white sample"> <br>
                                  <small class="bg-secondary">Proses Input</small>
                                </div>
                            </div>
                            <div class="column proses-input proses small-box col-lg-2" onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                <div class="position-relative p-3 bg-gray" style="height: 180px">
                                  <div class="ribbon-wrapper">
                                    <div class="ribbon bg-secondary">
                                      proses
                                    </div>
                                  </div>
                                  Fire Gloves <br />
                                  <img src="{{asset('storage/img/apd/placeholder/firegloves_2.jpg')}}"
                                                  class="img-fluid mb-0 h-75 w-75" alt="white sample"> <br>
                                  <small class="bg-secondary">Proses Input</small>
                                </div>
                            </div>
                            <div class="column proses-input proses small-box col-lg-2" onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                <div class="position-relative p-3 bg-gray" style="height: 180px">
                                  <div class="ribbon-wrapper">
                                    <div class="ribbon bg-secondary">
                                      proses
                                    </div>
                                  </div>
                                  Rescue Gloves <br />
                                  <img src="{{asset('storage/img/apd/placeholder/rescuegloves_1.jpg')}}"
                                                  class="img-fluid mb-0 h-75 w-75" alt="white sample"> <br>
                                  <small class="bg-secondary">Proses Input</small>
                                </div>
                            </div>
                            <div class="column proses-input proses small-box col-lg-2" onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                <div class="position-relative p-3 bg-gray" style="height: 180px">
                                  <div class="ribbon-wrapper">
                                    <div class="ribbon bg-secondary">
                                      proses
                                    </div>
                                  </div>
                                  Respirator <br />
                                  <img src="{{asset('storage/img/apd/placeholder/respirator_2.jpg')}}"
                                                  class="img-fluid mb-0 h-75 w-75" alt="white sample"> <br>
                                  <small class="bg-secondary">Proses Input</small>
                                </div>
                            </div>
                            <div class="column proses-input proses small-box col-lg-2" onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                <div class="position-relative p-3 bg-gray" style="height: 180px">
                                  <div class="ribbon-wrapper">
                                    <div class="ribbon bg-secondary">
                                      proses
                                    </div>
                                  </div>
                                  Kapak <br />
                                  <img src="{{asset('storage/img/apd/placeholder/kapak_1.jpg')}}"
                                                  class="img-fluid mb-0 h-75 w-75" alt="white sample"> <br>
                                  <small class="bg-secondary">Proses Input</small>
                                </div>
                            </div>
                            <div class="column proses-input proses small-box col-lg-2" onclick="modal('modal-input-apd-pegawai-hal-apdku','H001','modalInputApdPegawai')">
                                <div class="position-relative p-3 bg-gray" style="height: 180px">
                                  <div class="ribbon-wrapper">
                                    <div class="ribbon bg-secondary">
                                      proses
                                    </div>
                                  </div>
                                  Senter <br />
                                  <img src="{{asset('storage/img/apd/placeholder/senter_1.jpg')}}"
                                                  class="img-fluid mb-0 h-75 w-75" alt="white sample"> <br>
                                  <small class="bg-secondary">Proses Input</small>
                                </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
                {{-- @push('stack-head')
                @livewireStyles
                @endpush
                @push('stack-body')
                @livewireScripts
                @endpush
                <livewire:eapd.modal.modal-input-apd-pegawai-hal-apdku> --}}
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
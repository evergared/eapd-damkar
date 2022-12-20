<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">

                        {{-- Status loading Start --}}
                        <div wire:loading wire:target='bangunDaftarInputApd'>
                            <div class="spinner-border spinner-border-sm" role="status"></div>
                            <small> Memuat daftar apd...</small>
                        </div>
                        {{-- Status loading End --}}

                        <h3 class="card-title">Filter APD</h3> <br>
                        <div id="myBtnContainer">
                            <button class="btn active" onclick="filterSelection('all')"> Semua</button>
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



                            {{-- generate thumbnail Start --}}

                            {{-- Saat list memiliki isi--}}
                            @if($daftarApd[0]['id_jenis'] != "")

                            {{--
                            onclick="modal('modal-input-apd-pegawai-hal-apdku',{{$item['id_jenis']}},'modalInputApdPegawai')"
                            --}}

                            @foreach ($daftarApd as $item)
                            <div class="column {{Str::slug($item['status_verifikasi'],'-')}} {{Str::slug($item['status_kerusakan'],'-')}} small-box col-lg-2"
                                wire:click="panggilModal('{{$item['id_jenis']}}')">
                                <div class="position-relative p-3 bg-{{$item['warna_verifikasi']}}"
                                    style="height: 180px">
                                    <div class="ribbon-wrapper">
                                        <div class="ribbon bg-{{$item['warna_kerusakan']}}">
                                            {{$item['status_kerusakan']}}
                                        </div>
                                    </div>
                                    {{$item['nama_jenis']}} <br />
                                    <img src="{{asset($item['gambar_thumbnail'])}}" class="img-fluid mb-0 h-75 w-75"
                                        alt="white sample"> <br>
                                    <small
                                        class="bg-{{$item['warna_verifikasi']}}">{{$item['status_verifikasi']}}</small>
                                </div>
                            </div>
                            @endforeach

                            {{-- Saat list kosong --}}
                            @else

                            @endif


                            {{-- generate thumbnail End --}}

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

    <script>
        window.addEventListener('testModal', event=> {
            modal('modal-input-apd-pegawai-hal-apdku',event.detail.id_jenis,'modalInputApdPegawai')
        })

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

</section>
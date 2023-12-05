<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- generate thumbnail Start --}}

                    {{-- Saat list memiliki isi--}}
                    @if(!empty($daftarApd))

                    <div class="card-header bg-gradient-teal">

                        {{-- Status loading Start --}}
                        <div wire:loading wire:target='bangunDaftarInputApd'>
                            <div class="spinner-border spinner-border-sm" role="status"></div>
                            <small> Memuat daftar apd...</small>
                        </div>
                        {{-- Status loading End --}}

                        <h3 class="card-title">Filter APD</h3> <br>
                        <div id="myBtnContainer">
                            <button class="btn btn-primary" onclick="filterSelection('all')" type="submit">All</button>
                            <button class="btn btn-primary" onclick="filterSelection('proses-input')" type="submit">Input</button>
                            <button class="btn btn-primary" onclick="filterSelection('proses-validasi')" type="submit">Validasi</button>
                            <button class="btn btn-primary" onclick="filterSelection('telah-di-verif')" type="submit">Tervalidasi</button>
                            <button class="btn btn-primary" onclick="filterSelection('baik')" type="submit">Baik</button>
                            <button class="btn btn-primary" onclick="filterSelection('rusak')" type="submit">Rusak</button>
                            <button class="btn btn-primary" onclick="filterSelection('rusak-ringan')" type="submit">Ringan</button>
                            <button class="btn btn-primary" onclick="filterSelection('rusak-sedang')" type="submit">Sedang</button>
                            <button class="btn btn-primary" onclick="filterSelection('rusak-berat')" type="submit">Berat</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            @foreach ($daftarApd as $item)
                            <div class="column {{Str::slug($item['status_verifikasi'],'-')}} {{Str::slug($item['status_kerusakan'],'-')}} small-box col-sm-3"
                                wire:click="panggilModal('{{$item['id_jenis']}}')" wire:ignore.self>
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
                        </div>
                    </div>
                    <!-- /.card-body -->

                    {{-- Saat list kosong --}}
                    @else

                    <div class="card-body">
                        <div class="jumbotron text-center">
                            Tidak ada yang perlu diinput.
                        </div>
                    </div>

                    @endif


                    {{-- generate thumbnail End --}}

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

        window.addEventListener('pilihFilterSemua', ()=> {
                    console.log('pilih filter semua nya')
                    $(this).filterSelection('all')
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
<div>

    @include('komponen.breadcrumbs',[ 'halamanJudul'=>'APDku','halaman'=>'apdku'])
    <livewire:komponen.marquee>

    <section class="content">
    <div class="container-fluid">
        {{-- @include('eapd.dashboard.komponen.statbox') --}}
        <livewire:komponen.statbox>
        <div class="row">
            <!-- Left col -->
            <section class="content">


            <livewire:dashboards.pegawai.apdku.modal-input-apd>


            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                
                                @if ($daftarApd)
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

                                    <div class="card-body" wire:ignore.self>
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
                                @else

                                    <div class="jumbotron text-center">
                                        Tidak ada yang dapat ditampilkan.
                                    </div>
                                    
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            

        </div>
    </div>
    </section>

    <script>

        window.addEventListener('pangilModalInput', event=> {
            $('#modal-input-apd').modal('show')
            // modal('modal-input-apd',event.detail.id_jenis,'inisiasiModalInput')
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

</div>

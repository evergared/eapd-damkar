<div>

    @include('komponen.breadcrumbs',[ 'halamanJudul'=>'APDku','halaman'=>'apdku'])
    <livewire:komponen.marquee>

    <section class="content">
    <div class="container-fluid">
        {{-- @include('eapd.dashboard.komponen.statbox') --}}
        <livewire:komponen.statbox>
            
        <div class="collapse show active" id="butuh-input-apdku" wire:ignore.self>
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs mb-2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab-periode-berjalan" data-toggle='pill' role="tab" aria-controls="tab-periode-berjalan" wire:ignore.self>
                                Periode Berjalan
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#tab-form-apd" data-toggle='pill' role="tab" aria-controls="tab-form-apd" wire:ignore.self>
                                Ubah Data
                            </a>
                        </li> --}}
                    </ul>
                </div>
                <div class="card-body p-0">
                    <div class="tab-pane active show" >
                            @if($daftarApd)
                                <div class="card">
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
                                </div>
                        @else
                        <section class="content">
                            <div class="jumbotron text-center">
                                Tidak ada data APD yang perlu diinput saat ini.
                            </div>
                        </section>
                        @endif
                    </div>
                    
                </div>
            </div>
            <!-- Left col -->
            {{-- <section class="content">




            </section> --}}

            
            

        </div>
        <div class="collapse" id="kendali-input" wire:ignore.self>
            <livewire:dashboards.pegawai.apdku.kendali-input-apd>
        </div>
    </div>
    </section>

    <script type="module">

        window.addEventListener('butuh-input-ke-kendali-input', event=> {
            $('#butuh-input-apdku').hide(500)
            $('#kendali-input').collapse('show')
        })

        function kendaliKeButuhInput()
        {
            $('#butuh-input-apdku').show(500)
            $('#kendali-input').collapse('hide')
        }

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

<div>
    <section class="content">
        <div class="content-fluid">
            <div class="col-lg-12">
                {{-- tabel --}}
                <div class="collapse active show" id="kendali">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a href="#tab-barang" class="nav-link active" data-toggle='pill' role="tab" aria-controls="tab-barang" wire:ignore.self>Barang APD</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab-kondisi" class="nav-link" data-toggle='pill' role="tab" aria-controls="tab-kondisi" wire:ignore.self>Opsi Kondisi APD</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab-size" class="nav-link" data-toggle='pill' role="tab" aria-controls="tab-size" wire:ignore.self>Opsi Size APD</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="tab-barang" role="tab" wire:ignore.self>
                                    @if (session()->has('alert-success-apd'))
                                        <div class="alert alert-success alert-dismissable fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div>
                                                {{session('alert-success-apd')}}
                                            </div>
                                        </div>
                                    @endif
                                    @if (session()->has('alert-danger-apd'))
                                        <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div>
                                                {{session('alert-danger-apd')}}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row my-2">
                                        <button class="btn btn-md btn-default" wire:click='$emit("buatApd")'>Tambah APD Baru</button>
                                    </div>
                                    <div class="row">
                                        <livewire:dashboards.admin.pengaturan-barang.apd.tabel-list-apd>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-kondisi" role="tab" wire:ignore.self>
                                    @if (session()->has('alert-success-kondisi'))
                                        <div class="alert alert-success alert-dismissable fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div>
                                                {{session('alert-success-kondisi')}}
                                            </div>
                                        </div>
                                    @endif
                                    @if (session()->has('alert-danger-kondisi'))
                                        <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div>
                                                {{session('alert-danger-kondisi')}}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row my-2">
                                        <button class="btn btn-md btn-default" wire:click='$emit("buatKondisi")'>Buat Opsi Kondisi Baru</button>
                                    </div>
                                    <div class="row">
                                        <livewire:dashboards.admin.pengaturan-barang.apd.tabel-list-kondisi>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-size" role="tab" wire:ignore.self>
                                    @if (session()->has('alert-success-size'))
                                        <div class="alert alert-success alert-dismissable fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div>
                                                {{session('alert-success-size')}}
                                            </div>
                                        </div>
                                    @endif
                                    @if (session()->has('alert-danger-size'))
                                        <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div>
                                                {{session('alert-danger-size')}}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row my-2">
                                        <button class="btn btn-md btn-default" wire:click='$emit("buatSize")'>Buat Opsi Size Baru</button>
                                    </div>
                                    <div class="row">
                                        <livewire:dashboards.admin.pengaturan-barang.apd.tabel-list-size>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- form apd --}}
                <div class="collapse" id="form-apd">
                    <livewire:dashboards.admin.pengaturan-barang.apd.form-apd>
                </div>
                {{-- form kondisi --}}
                <div class="collapse" id="form-kondisi">
                    <livewire:dashboards.admin.pengaturan-barang.apd.form-kondisi>
                </div>
                {{-- form size --}}
                <div class="collapse" id="form-size">
                    <livewire:dashboards.admin.pengaturan-barang.apd.form-size>
                </div>
            </div>
        </div>
    </section>

    @push('stack-body')
        <script>
            window.addEventListener('kendali-ke-form-apd', event=> {
                $('#kendali').hide(500)
                $('#form-apd').collapse('show')
            })
            window.addEventListener('kendali-ke-form-kondisi', event=> {
                $('#kendali').hide(500)
                $('#form-kondisi').collapse('show')
            })
            window.addEventListener('kendali-ke-form-size', event=> {
                $('#kendali').hide(500)
                $('#form-size').collapse('show')
            })

            function formApdKeKendali()
            {
                $('#form-apd').collapse('hide')
                $('#kendali').show(500)
            }
            function formKondisiKeKendali()
            {
                $('#form-kondisi').collapse('hide')
                $('#kendali').show(500)
            }
            function formSizeKeKendali()
            {
                $('#form-size').collapse('hide')
                $('#kendali').show(500)
            }

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
      <script src="{{ asset('admin-lte/ekko-lightbox.min.js')}}"></script>
    @endpush

</div>

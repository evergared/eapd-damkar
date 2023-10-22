<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h4>Detail Permintaan Ubah Data</h4>
        </div>
        <div class="card-tools">
            <button class="btn-primary btn-sm" wire:click="kembali">
                <i class="fas fa-arrow-left"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
                
                
                {{-- Start jika detail dapat diambil --}}
                @if (!is_null($entry_detail))
                <div class="row">
                    {{-- Start tampilan gambar --}}
                    <div class="col-12 col-sm-6">
                        <div class="card">

                        {{-- nav tabs --}}
                        <div class="card-header">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="gambar-user-tab" role="tab" aria-selected="true" data-toggle="pill" 
                                    aria-controls="gambar-user-tab-content" href="#gambar-user-tab-content" wire:ignore.self>Gambar yang diupload</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="gambar-terverif-tab" role="tab" aria-selected="false" data-toggle="pill"
                                    aria-controls="gambar-terverif-tab-content" href="#gambar-terverif-tab-content" wire:ignore.self>Gambar Sebelumnya</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="gambar-apd-tab" role="tab" aria-selected="false" data-toggle="pill"
                                    aria-controls="gambar-apd-tab-content" href="#gambar-apd-tab-content" wire:ignore.self>Gambar APD</a>
                                </li>
                            </ul>
                        </div>

                        {{-- tab content --}}
                        <div class="card-body">
                            <div class="tab-content">
                            {{-- Start gambar apd user --}}
                            <div class="tab-pane fade active show" id="gambar-user-tab-content" role="tabpanel" aria-labelledby="gambar-user-tab" wire:ignore.self>
                                {{-- Start jika gambar user ada --}}
                                @if (!is_null($entry_detail['image']))
                                    {{-- Start jika ada lebih dari satu --}}
                                    @if (is_array($entry_detail['image']) && count($entry_detail['image']) > 1)
                                        
                                        {{-- Script untuk preview gambar apd Start--}}
                                        <script>
                                            $(document).ready(function() {
                                        $('.apd-user.product-image-thumb').on('click', function () {
                                            var $image_element = $(this).find('img')
                                            $('.apd-user-preview.product-image').prop('src', $image_element.attr('src'))
                                            $('.apd-user.product-image-thumb.active').removeClass('active')
                                            $(this).addClass('active')
                                            })
                                        })
                                        </script>
                                        {{-- Script untuk preview gambar apd End--}}

                                        <img class="apd-user-preview product-image"
                                        src="{{asset($path_gambar . $entry_detail['image'][0])}}" alt="Gambar Apd Anda">
                                        <div class="col-12 apd-user product-image-thumbs">
                                            @foreach ($entry_detail['image'] as $key => $gbr)
                                                @if($key === array_key_first($entry_detail['image']))
                                                <div class="apd-user product-image-thumb active"><img
                                                        src="{{asset($path_gambar . $gbr)}}" alt="APD">
                                                </div>
                                                @else
                                                <div class="apd-user product-image-thumb"><img
                                                        src="{{asset($path_gambar . $gbr)}}" alt="APD">
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    {{-- End jika ada lebih dari satu --}}
                                    
                                    {{-- Start jika hanya ada satu gambar --}}
                                    @elseif(is_string($entry_detail['image']) && $entry_detail['image'] != "")
                                        <img src="{{asset($path_gambar . $entry_detail['image'])}}" class="img-thumbnail" alt="APD">
                                    {{-- End jika hanya ada satu gambar --}}

                                    {{-- Start antisipasi gambar tidak null tetapi tidak ada gambar --}}
                                    @else
                                    <div class="jumbotron text-center">
                                        Tidak ada gambar yang diunggah.
                                    </div>
                                    {{-- End antisipasi gambar tidak null tetapi tidak ada gambar --}}

                                    @endif
                                {{-- End jika gambar user ada --}}

                                {{-- Start jika tidak ada gambar user --}}
                                @elseif(is_null($entry_detail['image']) || $entry_detail['image'] === "")
                                <div class="jumbotron text-center">
                                    Tidak ada gambar yang diunggah.
                                </div>
                                @else
                                <div class="jumbotron text-center">
                                    Tidak ada gambar yang diunggah.
                                </div>
                                {{-- End jika tidak ada gambar user --}}
                                @endif
                            </div>
                            {{-- End gambar apd user --}}

                            {{-- Start gambar apd sebelumnya --}}
                            <div class="tab-pane fade" id="gambar-terverif-tab-content" role="tabpanel" aria-labelledby="gambar-apd-tab" wire:ignore.self>
                                {{-- Start jika gambar sebelumnya ada --}}
                                @if (!is_null($entry_sebelumnya['gambar_apd']))
                                    {{-- Start jika ada lebih dari satu --}}
                                    @if (is_array($entry_sebelumnya['gambar_apd']) && count($entry_sebelumnya['gambar_apd']) > 1)
                                        
                                        {{-- Script untuk preview gambar apd Start--}}
                                        <script>
                                            $(document).ready(function() {
                                        $('.apd-sebelumnya.product-image-thumb').on('click', function () {
                                            var $image_element = $(this).find('img')
                                            $('.apd-sebelumnya-preview.product-image').prop('src', $image_element.attr('src'))
                                            $('.apd-sebelumnya.product-image-thumb.active').removeClass('active')
                                            $(this).addClass('active')
                                            })
                                        })
                                        </script>
                                        {{-- Script untuk preview gambar apd End--}}

                                        <img class="apd-sebelumnya-preview product-image"
                                        src="{{asset($entry_sebelumnya['gambar_apd'][0])}}" alt="Gambar Apd Anda">
                                        <div class="col-12 apd-sebelumnya product-image-thumbs">
                                            @foreach ($entry_sebelumnya['gambar_apd'] as $key => $gbr)
                                                @if($key === array_key_first($entry_sebelumnya['gambar_apd']))
                                                <div class="apd-sebelumnya product-image-thumb active"><img
                                                        src="{{asset($gbr)}}" alt="APD">
                                                </div>
                                                @else
                                                <div class="apd-sebelumnya product-image-thumb"><img
                                                        src="{{asset($gbr)}}" alt="APD">
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    {{-- End jika ada lebih dari satu --}}
                                    
                                    {{-- Start jika hanya ada satu gambar --}}
                                    @elseif(is_string($entry_sebelumnya['gambar_apd']) && $entry_sebelumnya['gambar_apd'] != "")
                                        <img src="{{asset($entry_sebelumnya['gambar_apd'])}}" class="img-thumbnail" alt="APD">
                                    {{-- End jika hanya ada satu gambar --}}

                                    {{-- Start antisipasi gambar tidak null tetapi tidak ada gambar --}}
                                    @else
                                    <div class="jumbotron text-center">
                                        Tidak ada gambar yang diunggah sebelumnya.
                                    </div>
                                    {{-- End antisipasi gambar tidak null tetapi tidak ada gambar --}}
                                    @endif
                                {{-- End jika gambar sebelumnya ada --}}

                                {{-- Start jika tidak ada gambar sebelumnya --}}
                                @elseif(is_null($entry_sebelumnya['gambar_apd']) || $entry_sebelumnya['gambar_apd'] === "")
                                <div class="jumbotron text-center">
                                    Tidak ada gambar yang diunggah sebelumnya.
                                </div>
                                @else
                                <div class="jumbotron text-center">
                                    Tidak ada gambar yang diunggah sebelumnya.
                                </div>
                                {{-- End jika tidak ada gambar sebelumnya --}}
                                @endif
                            </div>
                            {{-- End gambar apd sebelumnya --}}

                            {{-- Start gambar apd template --}}
                            <div class="tab-pane fade" id="gambar-apd-tab-content" role="tabpanel" aria-labelledby="gambar-apd-tab" wire:ignore.self>
                                {{-- Start jika gambar template ada --}}
                                @if (!is_null($gambar_apd_template))
                                    {{-- Start jika ada lebih dari satu --}}
                                    @if (is_array($gambar_apd_template) && count($gambar_apd_template) > 1)
                                        
                                        {{-- Script untuk preview gambar apd Start--}}
                                        <script>
                                            $(document).ready(function() {
                                        $('.apd-template.product-image-thumb').on('click', function () {
                                            var $image_element = $(this).find('img')
                                            $('.apd-template-preview.product-image').prop('src', $image_element.attr('src'))
                                            $('.apd-template.product-image-thumb.active').removeClass('active')
                                            $(this).addClass('active')
                                            })
                                        })
                                        </script>
                                        {{-- Script untuk preview gambar apd End--}}

                                        <img class="apd-template-preview product-image"
                                        src="{{asset($gambar_apd_template[0])}}" alt="Gambar Apd Anda">
                                        <div class="col-12 apd-template product-image-thumbs">
                                            @foreach ($gambar_apd_template as $key => $gbr)
                                                @if($key === array_key_first($gambar_apd_template))
                                                <div class="apd-template product-image-thumb active"><img
                                                        src="{{asset($gbr)}}" alt="APD">
                                                </div>
                                                @else
                                                <div class="apd-template product-image-thumb"><img
                                                        src="{{asset($gbr)}}" alt="APD">
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    {{-- End jika ada lebih dari satu --}}
                                    
                                    {{-- Start jika hanya ada satu gambar --}}
                                    @elseif(is_string($gambar_apd_template) && $gambar_apd_template != "")
                                        <img src="{{asset($gambar_apd_template)}}" class="img-thumbnail" alt="APD">
                                    {{-- End jika hanya ada satu gambar --}}

                                    {{-- Start antisipasi gambar tidak null tetapi tidak ada gambar --}}
                                    @else
                                    <div class="jumbotron text-center">
                                        Tidak ada gambar yang disediakan.
                                    </div>
                                    {{-- End antisipasi gambar tidak null tetapi tidak ada gambar --}}
                                    @endif
                                {{-- End jika gambar template ada --}}

                                {{-- Start jika tidak ada gambar template --}}
                                @elseif(is_null($gambar_apd_template) || $gambar_apd_tempate === "")
                                <div class="jumbotron text-center">
                                    Tidak ada gambar yang disediakan.
                                </div>
                                @else
                                <div class="jumbotron text-center">
                                    Tidak ada gambar yang disediakan.
                                </div>
                                {{-- End jika tidak ada gambar template --}}
                                @endif
                            </div>
                            {{-- End gambar apd template --}}

                            </div>
                        </div>

                        </div>
                    </div>
                    {{-- End tampilan gambar --}}

                    {{-- Start tampilan data --}}
                    <div class="col-12 col-sm-6">
                    
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="baru-tab" role="tab" aria-selected="true" data-toggle="pill" 
                                        aria-controls="baru-tab-content" href="#baru-tab-content" wire:ignore.self>Data Baru</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="sebelumnya-tab" role="tab" aria-selected="false" data-toggle="pill"
                                        aria-controls="sebelumnya-tab-content" href="#sebelumnya-tab-content" wire:ignore.self>Data Sebelumnya</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    {{-- start data baru --}}
                                    <div class="tab-pane fade show active" id="baru-tab-content" wire:ignore.self>
                                        @if (!is_null($entry_detail))
                                            <div class="row">
                                                <strong>Status APD</strong>
                                            </div>
                                            <div class="row">
                                                <span class="badge badge-{{$entry_detail['kondisi_warna']}}">{{$entry_detail['kondisi_label']}}</span>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <strong>Tanggal Input : </strong>
                                                </div>
                                                <div class="col">
                                                    <span class="badge badge-success">{{$entry_detail['data_diupdate']}}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <strong>Komentar Pengunggah : </strong>
                                            </div>  
                                            <div class="row">
                                                <div class="blockquote">
                                                    {{($entry_detail['komentar_pengupload']) ? $entry_detail['komentar_pengupload'] : '-'}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5><strong>Detail APD </strong></h5>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <strong>Model : </strong>
                                                </div>
                                                <div class="col">
                                                    {{$entry_detail['nama_apd']}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <strong>No Seri : </strong>
                                                </div>
                                                <div class="col">
                                                    {{($entry_detail['no_seri'])? $entry_detail['no_seri'] : '-'}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <strong>Ukuran : </strong>
                                                </div>
                                                <div class="col">
                                                    {{($entry_detail['size'])? $entry_detail['size'] : '-'}}
                                                </div>
                                            </div>
                                        @else
                                            <div class="jumbotron text-center">
                                                Tidak ada yang dapat ditampilkan.
                                            </div>
                                        @endif
                                    </div>
                                    {{-- end data baru --}}

                                    {{-- start data sebelumnya --}}
                                    <div class="tab-pane fade" id="sebelumnya-tab-content" wire:ignore.self>
                                        @if (!is_null($entry_sebelumnya))
                                            <div class="row">
                                                <strong>Status APD</strong>
                                            </div>
                                            <div class="row">
                                                <span class="badge badge-{{$entry_sebelumnya['warna_kerusakan']}}">{{$entry_sebelumnya['status_kerusakan']}}</span>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <strong>Tanggal Input : </strong>
                                                </div>
                                                <div class="col">
                                                    <span class="badge badge-success">{{$entry_sebelumnya['data_terakhir_update']}}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <strong>Tanggal Terverif : </strong>
                                                </div>
                                                <div class="col">
                                                    <span class="badge badge-info">{{$entry_sebelumnya['verifikasi_terakhir_update']}}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <strong>Komentar Pengunggah : </strong>
                                            </div>  
                                            <div class="row">
                                                <div class="blockquote">
                                                    {{($entry_sebelumnya['komentar_pengupload']) ? $entry_sebelumnya['komentar_pengupload'] : '-'}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <strong>Komentar Verifikator : </strong>
                                            </div>  
                                            <div class="row">
                                                <div class="blockquote">
                                                    {{($entry_sebelumnya['komentar_verifikator']) ? $entry_sebelumnya['komentar_verifikator'] : '-'}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5><strong>Detail APD </strong></h5>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <strong>Model : </strong>
                                                </div>
                                                <div class="col">
                                                    {{$entry_sebelumnya['nama_apd']}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <strong>No Seri : </strong>
                                                </div>
                                                <div class="col">
                                                    {{($entry_sebelumnya['no_seri'])? $entry_sebelumnya['no_seri'] : '-'}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <strong>Ukuran : </strong>
                                                </div>
                                                <div class="col">
                                                    {{($entry_sebelumnya['size_apd'])? $entry_sebelumnya['size_apd'] : '-'}}
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <h5><strong>Data Verifikator</strong></h5>
                                            </div>
                                            <div class="row">
                                                <strong>Verifikator : </strong>
                                            </div>  
                                            <div class="row">
                                                    {{($entry_sebelumnya['nama_verifikator']) ? $entry_sebelumnya['nama_verifikator'] : '-'}}
                                            </div>
                                            <div class="row">
                                                <strong>Jabatan Verifikator : </strong>
                                            </div>  
                                            <div class="row">
                                                    {{($entry_sebelumnya['jabatan_verifikator']) ? $entry_sebelumnya['jabatan_verifikator'] : '-'}}
                                            </div>
                                        @else
                                            <div class="jumbotron text-center">
                                                Tidak ada yang dapat ditampilkan.
                                            </div>
                                        @endif
                                    </div>
                                    {{-- end data sebelumnya --}}
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- End tampilan data --}}

                </div>
                
                <div class="row">
                    <div class="card col-lg-12">
                        <div class="card-header">
                            <div class="card-title">
                                Tindakan
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- Start bagian untuk alert --}}
                                {{-- Alert untuk berhasil --}}
                                @if (session()->has('alert-success'))
                                    <div class="alert alert-success alert-dismissable fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div>
                                        {{session('alert-success')}}
                                    </div>
                                    </div>
                                @endif
                                {{-- Alert untuk gagal --}}
                                @if (session()->has('alert-danger'))
                                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div>
                                        {{session('alert-danger')}}
                                    </div>
                                    </div>
                                @endif
                            {{-- End bagian untuk alert --}}
                            <div class="form-group">
                                <label>Terima perubahan?</label>
                                <select class="form-control" wire:model='model_terima'>
                                    <option value="" disabled>Pilih Tindakan</option>
                                    @if ($opsi_dropdown_terima)
                                        @foreach ($opsi_dropdown_terima as $item)
                                            <option value="{{$item['value']}}">{{$item['text']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('model_terima')
                                    <small class="error text-danger"><strong>{{$message}}</strong></small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Komentar</label>
                                <textarea class="form-control" rows="3" wire:model='model_komentar'
                                    placeholder="(opsional) Tulis komentar/catatan tentang perubahan ini"></textarea>
                            </div>
                        </div>
                    </div>
                </div> 
            {{-- End jika detail dapat diambil --}}

            {{-- Start jika detail tidak dapat diambil --}}
            @else
                <div class="jumbotron text-center">
                Tidak ada yang dapat ditampilkan.
                </div>
            {{-- End jika detail tidak dapat diambil --}}
            @endif

    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-sm btn-primary" wire:click='simpan'>Simpan</button>
        </div>  
    </div>
</div>
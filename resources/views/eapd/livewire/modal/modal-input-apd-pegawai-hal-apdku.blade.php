<div>
    <div wire:ignore.self class="modal fade" id="modal-input-apd-pegawai-hal-apdku" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Data APD</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                @if($telahDiverifAdmin)
                    <span class="text-info"><strong>Data anda telah diverifikasi oleh admin.<br>Jika ada perubahan data, ubah data anda lalu klik "Ajukan Perubahan".</strong></span>
                @endif                    
                    <div class="row">
                        <div class="col-12 col-sm-6" wire:key='tampil-gambar'>
                            <h3 class="d-inline-block d-sm-none">{{$nama_jenis}}</h3>
                            <ul class="nav nav-tabs" role="tablist" id="gambar-apd-nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="gambar-apd-template-tab" data-toggle="pill"
                                        role="tab" aria-controls="gambar-apd-template-content" aria-selected="true"
                                        href="#gambar-apd-template-content" wire:ignore.self>Gambar APD</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="gambar-apd-user-tab" data-toggle="pill" role="tab"
                                        aria-controls="gambar-apd-user-content" aria-selected="false"
                                        href="#gambar-apd-user-content" wire:ignore.self>Gambar APD Anda</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="gambar-apd-nav-tabsContent">
                                <div class="tab-pane fade active show" id="gambar-apd-template-content" role="tabpanel"
                                    aria-labelledby="gambar-apd-template-tab" wire:key='apd-template' wire:ignore.self>

                                    {{-- Jika gambar template gagal dimuat --}}
                                    @if (session()->has('gambar_apd_template_error'))
                                    <div class="text-danger">
                                        <small>{{session('gambar_apd_template_error')}}</small>
                                    </div>
                                    @endif

                                    {{-- Kondisi Gambar Template Start --}}

                                    @if ($gambar_apd_template)

                                    <div wire:loading wire:target='selectModelApdDirubah'>
                                        <div class="spinner-border text-info" role="status">
                                            <span class="sr-only">Memuat...</span>
                                        </div><span class="mx-2 text-info">Memuat...</span>
                                    </div>

                                    <div class="col-12">





                                        {{-- Saat Gambar Template Lebih Dari 1 --}}
                                        @if(count($gambar_apd_template)>1 && $userTelahMemilih)

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

                                        <img class="apd-template-preview product-image" id="apd_template"
                                            src="{{asset($mock.'/'.$gambar_apd_template[0])}}" alt="Gambar Apd Anda">
                                        <div class="col-12 product-image-thumbs">

                                            @foreach ($gambar_apd_template as $key => $gbr)
                                            @if($key === array_key_first($gambar_apd_template))
                                            <div class="apd-template product-image-thumb active"><img
                                                    src="{{asset($mock.'/'.$gbr)}}" alt="Product Image">
                                            </div>
                                            @else
                                            <div class="apd-template  product-image-thumb"><img
                                                    src="{{asset($mock.'/'.$gbr)}}" alt="Product Image">
                                            </div>
                                            @endif
                                            @endforeach



                                        </div>

                                        {{-- Saat Gambar Template Ada 1 --}}
                                        @elseif($adaGambarTemplate && (!is_null($list_apd) && $id_apd_user
                                        != '') && $userTelahMemilih)
                                        <img class="product-image" src="{{$mock.'/'.$gambar_apd_template[0]}}"
                                            alt="Gambar APD">

                                        {{-- Saat Tidak Diberikan Gambar Template --}}
                                        @elseif(!($adaGambarTemplate) && (!is_null($list_apd) && $id_apd_user !=
                                        '') && $userTelahMemilih)
                                        <div class="jumbotron jumbotron-fluid text-center">
                                            Tidak disediakan gambar untuk APD ini.
                                        </div>

                                        @elseif(!is_null($list_apd) && $id_apd_user ==
                                        '' && !($userTelahMemilih))
                                        <div class="jumbotron jumbotron-fluid text-center">
                                            Silahkan pilih apd di dropdown model.
                                        </div>

                                        @endif
                                    </div>

                                    @endif
                                    {{-- Kondisi Gambar Template End --}}
                                </div>

                                <div class="tab-pane fade" id="gambar-apd-user-content" role="tabpanel"
                                    aria-labelledby="gambar-apd-user-tab" wire:key='apd-user' wire:ignore.self>

                                    {{-- Jika gambar user gagal dimuat --}}
                                    @if (session()->has('gambar_apd_user_error'))
                                    <div class="text-danger">
                                        <small>{{session('gambar_apd_user_error')}}</small>
                                    </div>
                                    @endif



                                    {{-- Kondisi Gambar APD Anda Start --}}
                                    {{-- Saat User Sudah Pernah Upload Gambar --}}
                                    @if($gambar_apd && $gambar_apd[0] != "")



                                    <div class="col-12">
                                        <div class="text-info my-2">
                                            <small>Berikut merupakan gambar APD anda untuk model
                                                <strong><u>{{$nama_apd_user}}</u></strong> yang
                                                telah anda
                                                upload.</small>
                                        </div>
                                        {{-- Pernah Upload Lebih Dari 1 --}}
                                        @if (count($gambar_apd)>1)

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
                                            src="{{asset($pathGbr.'/'.$gambar_apd[0])}}" alt="Gambar Apd Anda">
                                        <div class="col-12 apd-user product-image-thumbs">

                                            @foreach ($gambar_apd as $key => $gbr)
                                                @if($key === array_key_first($gambar_apd))
                                                <div class="apd-user product-image-thumb active"><img
                                                        src="{{asset($pathGbr.'/'.$gbr)}}" alt="Product Image">
                                                </div>
                                                @else
                                                <div class="apd-user product-image-thumb"><img
                                                        src="{{asset($pathGbr.'/'.$gbr)}}" alt="Product Image">
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        {{-- Pernah Upload Gambar 1 --}}
                                        @elseif (count($gambar_apd) == 1)
                                        <img class="apd-user product-image" id="apd_user"
                                            src="{{$pathGbr.'/'.$gambar_apd[0]}}" alt="Gambar Apd Anda">

                                        @endif

                                        {{-- Saat user mengupload Gambar APD Baru --}}
                                        @if ($gambar_apd_user)
                                        <div class="mt-2">
                                            <div>
                                                <small>Perubahan gambar akan tampil setelah data APD
                                                    disimpan.</small>
                                            </div>
                                            <div>
                                                <a class="btn btn-secondary btn-sm btn-flat rounded-pill"
                                                    style="cursor: pointer;"
                                                    onclick="$('#modal-upload-gambar').modal('show')">
                                                    <i class="fas fa-image fa-lg mr-2"></i>
                                                    Preview Gambar
                                                </a>
                                            </div>
                                        </div>
                                        @endif

                                    </div>

                                    {{-- Saat User belum Pernah Upload Gambar --}}
                                    @else

                                    @if ($gambar_apd_user)
                                    <div class="jumbotron jumbotron-fluid text-center">
                                        Perubahan akan terlihat setelah Data APD diinput, pastikan data sudah benar
                                        sebelum
                                        klik Simpan.
                                    </div>
                                    <div>
                                        <a class="btn btn-secondary btn-sm btn-flat rounded-pill"
                                            style="cursor: pointer;" onclick="$('#modal-upload-gambar').modal('show')">
                                            <i class="fas fa-image fa-lg mr-2"></i>
                                            Preview Gambar
                                        </a>
                                    </div>
                                    @else
                                    <div class="jumbotron jumbotron-fluid text-center">
                                        Anda belum melakukan upload gambar apd.
                                    </div>
                                    @endif
                                    @endif
                                    {{-- Kondisi Gambar APD Anda End --}}
                                </div>

                                {{-- Status Start --}}
                                <div wire:loading wire:target='gambar_apd_user'>
                                    <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                                    <small class="text-info"> apd sedang di unggah...</small>
                                </div>
                                {{-- Status End --}}
                            </div>

                        </div>
                        <div class="col-12 col-sm-6" wire:key='tampil-form'>
                            <h3 class="my-1">{{$nama_jenis}}</h3>

                            <div class="mb-2">
                                <div>
                                    Status Verifikasi : <span
                                        class="badge badge-{{$this->ubahKeWarnaBootstrap($this->status_verif_user)}}">{{$this->label_verif_user}}</span>
                                </div>

                                @if ($komentar_verif_user)
                                <div>
                                    Keterangan Admin : <br>
                                    <span
                                        class="bg-gradient-{{$this->ubahKeWarnaBootstrap($this->status_verif_user)}} color-palette h6">{{$komentar_verif_user}}</span>
                                </div>
                                @endif

                            </div>

                            <div class="form-group">

                                
                                {{-- Pesan Setelah Input start --}}

                                @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissable fade show" role="alert">
                                    {{session('success')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                                @if (session()->has('fail'))
                                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                    {{session('fail')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                            </div>



                                {{-- Pesan Setelah Input End --}}

                                {{-- @todo #5 --}}

                                <div class="form-group">
                                    <label>Status Keberadaan APD : </label>
                                    <select class="form-control" wire:model="status_keberadaan_apd_user">
                                        <option value="" disabled>APD Ada/Hilang/Belum Terima ?</option>
                                        @foreach ($opsi_keberadaan as $item)
                                            <option value="{{$item['value']}}">{{$item['text']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- <div class="form-group" wire:init='hidrasiListApd'>
                                    <label>Model</label>
                                    <select class="form-control" wire:model='id_apd_user'
                                        wire:change='selectModelApdDirubah'>
                                        <option value="" disabled>Pilih model APD</option>
                                        @if (!is_null($list_apd))
                                        @foreach ($list_apd as $apd)
                                        <option wire:key="opsi-apd-{{$apd['nama_apd']}}" value="{{$apd['id_apd']}}">
                                            {{$apd['nama_apd']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                @error('id_apd_user')
                                <small class="error text-danger">{{$message}}</small>
                                @enderror --}}
                            @if ($status_keberadaan_apd_user == "ada")
                                
                            <p></p>
                            <p></p>
                            <div class="form-group">
                                <label>Ukuran</label>
                                <select class="form-control" wire:model.defer='size_apd_user'>
                                    <option value="" disabled>Pilih ukuran APD</option>
                                    @if (!is_null($size_apd))
                                        @foreach ($size_apd as $size)
                                            <option>{{$size}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('size_apd_user')
                                <small class="error text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <p></p>

                            <p></p>
                            <div class="form-group">
                                <label>Kondisi</label>
                                <select class="form-control" wire:model.defer='kondisi_apd_user'>
                                    <option value="" disabled>Pilih jenis kondisi APD</option>
                                    @if (!is_null($kondisi_apd))
                                    @foreach ($kondisi_apd as $kondisi)
                                    <option value="{{$kondisi['value']}}">{{$kondisi['text']}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('kondisi_apd_user')
                                <small class="error text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <p></p>

                            <div class="form-group">
                                <label>Upload Foto</label>
                                <input type="file" class="form-control" multiple wire:model='gambar_apd_user' required>
                                @error('gambar_apd_user.*')
                                <span><small class="text-danger">{{$message}}</small></span>
                                @enderror
                                @error('gambar_apd_user')
                                <span><small class="text-danger">{{$message}}</small></span>
                                @enderror
                            </div>
                                
                            @elseif($status_keberadaan_apd_user == "hilang")

                            <div class="text-danger">
                                <h4>Status APD anda <strong><u>Hilang</u></strong>, pastikan anda menghubungi admin yang bertanggung jawab di tempat anda dan ikuti instruksi selanjutnya.</h4>
                            </div>

                            @elseif($status_keberadaan_apd_user == "belum")
                                
                            @endif

                            @if ($status_keberadaan_apd_user != "")
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" rows="3"
                                    placeholder="(opsional) Tulis keterangan kondisi APD"
                                    wire:model='komentar_apd_user'></textarea>
                            </div>
                            @endif
                            


                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer">

                    @if($telahDiverifAdmin)
                        <a class="btn btn-primary btn-m btn-flat rounded-pill" wire:click='updateSetelahTerverifikasi' style="cursor: pointer;">
                            <i class="fas fa-save fa-lg mr-2"></i>
                            Ajukan Perubahan
                        </a>                        
                    @else
                        <a class="btn btn-primary btn-m btn-flat rounded-pill" wire:click='simpan' style="cursor: pointer;">
                            <i class="fas fa-save fa-lg mr-2"></i>
                            Simpan Data APD
                        </a>
                    @endif
                </div>

            </div>
            <!-- /.modal-content -->



        </div>
        <!-- /.modal-dialog -->




        {{-- Modal Preview Gambar Start --}}
        <div class="modal fade" id="modal-upload-gambar" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Preview Gambar Upload</h5>
                        <button type="button" class="close" aria-label="Close"
                            onclick="$('#modal-upload-gambar').modal('hide')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        {{-- Saat User Upload gambar --}}
                        @if ($gambar_apd_user && !($errors->has('gambar_apd_user.*')))
                        <div class="col-12">
                            <span class="text-warning">Gambar berikut merupakan preview gambar yang anda upload,
                                pastikan anda menyimpan perubahan.</span>

                            {{-- Script untuk preview gambar apd Start--}}
                            <script>
                                $(document).ready(function() {
                                        $('.upload-preview.product-image-thumb').on('click', function () {
                                            var $image_element = $(this).find('img')
                                            $('.upload-preview.product-image').prop('src', $image_element.attr('src'))
                                            $('.upload-preview.product-image-thumb.active').removeClass('active')
                                            $(this).addClass('active')
                                            })
                                        })
                            </script>
                            {{-- Script untuk preview gambar apd End--}}


                            {{-- Upload Gambar lebih dari 1 --}}
                            @if (count($gambar_apd_user)>1)
                            <img class="upload-preview product-image" src="{{ $gambar_apd_user[0]->temporaryUrl() }}"
                                alt="Gambar Apd Anda">
                            <div class="col-12 upload-preview product-image-thumbs">

                                @foreach ($gambar_apd_user as $key => $gbr)
                                @if($key === array_key_first($gambar_apd_user))
                                <div class="upload-preview product-image-thumb active">
                                    <img src="{{$gbr->temporaryUrl()}}" alt="List Gambar Apd">
                                </div>
                                @else
                                <div class="upload-preview product-image-thumb">
                                    <img src="{{$gbr->temporaryUrl()}}" alt="List Gambar Apd">
                                </div>

                                @endif
                                @endforeach
                            </div>

                            {{-- Upload Gambar 1 --}}
                            @elseif (count($gambar_apd_user) == 1)
                            <img class="upload-preview product-image" src="{{$gambar_apd_user[0]->temporaryUrl()}}"
                                alt="Gambar Apd Anda">

                            @endif
                            @else
                            <div class="jumbotron jumbotron-fluid text-center">
                                Anda belum upload gambar, preview gambar anda akan muncul disini.
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Preview Gambar End --}}

    </div>
</div>
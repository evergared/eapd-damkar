
<div>
        <div wire:ignore.self class="modal fade" id="modal-input-apd" style="display: none;"
            aria-hidden="true" >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Input Data APD</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body overlay-wrapper">

                        <div  wire:loading wire.target='inisiasiModalInput'>
                            <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-2">Memperbarui Data...</div></div>
                        </div>

                        @if ($error_time_inisiasi_modal != '')
                            <div class="overlay text-danger"><i class="fas fa-exclamation-circle mr-2"></i><div class="text-bold pt-2">Kesalahan saat mengambil data sebelumnya. ref : {{$error_time_inisiasi_modal}}</div></div>
                        @endif

                        @if ($gambar_apd_user)
                                    
                        <div class="row mb-2" wire:ignore.self>
                            <div class="collapse" id="previw-gambar">
                                <a class="btn btn-primary btn-m btn-flat rounded-pill" onclick="$('#previw-gambar').collapse('hide')" style="cursor: pointer;">
                                    <i class="fa fa-window-close mr-1"></i>
                                    Tutup Preview
                                </a>
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
                        
                        @endif
                        <div class="row" wire:ignore.self>
                            <div class="col-12 col-sm-6" wire:key='tampil-gambar'>
                                <h3 class="d-inline-block d-sm-none">{{$template_nama_jenis_apd}}</h3>
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
                                            @if ($error_time_gambar_template != '')
                                                <div class="text-danger">
                                                    <small> Error saat memuat gambar model apd : <strong>{{$error_time_gambar_template}}</strong></small>
                                                </div>
                                            @endif

                                            {{-- Kondisi Gambar Template Start --}}


                                                <div wire:loading>
                                                    <div class="spinner-border text-info" role="status">
                                                        <span class="sr-only">Memuat...</span>
                                                    </div><span class="mx-2 text-info">Memuat...</span>
                                                </div>

                                                <div class="col-12">
                                                @if($status_keberadaan_apd_user == "ada")
                                                    @if ($id_apd_user != "")
                                                        @if(is_array($template_gambar_apd))
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
                                                                src="{{asset($placeholder_path.'/'.$template_gambar_apd[0])}}" alt="Gambar Apd Anda">
                                                            <div class="col-12 product-image-thumbs">
                                                                @foreach ($template_gambar_apd as $key => $gbr)
                                                                    @if($key === array_key_first($template_gambar_apd))
                                                                        <div class="apd-template product-image-thumb active"><img
                                                                                src="{{asset($placeholder_path.'/'.$gbr)}}" alt="Product Image">
                                                                        </div>
                                                                    @else
                                                                        <div class="apd-template  product-image-thumb"><img
                                                                                src="{{asset($placeholder_path.'/'.$gbr)}}" alt="Product Image">
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        @elseif(is_string($template_gambar_apd))
                                                            <img class="product-image" src="{{$placeholder_path.'/'.$template_gambar_apd}}"
                                                            alt="Gambar APD">
                                                        @elseif(is_null($template_gambar_apd))
                                                            <div class="jumbotron jumbotron-fluid text-center">
                                                                Tidak disediakan gambar untuk APD ini.
                                                            </div>
                                                        @else
                                                            <div class="jumbotron jumbotron-fluid text-center">
                                                                Terjadi kesalahan saat mengambil gambar model apd dari database.
                                                            </div>
                                                        @endif
                                                    @else
                                                            <div class="jumbotron jumbotron-fluid text-center">
                                                                Silahkan pilih apd di dropdown model.
                                                            </div>
                                                    @endif
                                                @else
                                                    <div class="jumbotron jumbotron-fluid text-center">
                                                        
                                                    </div>
                                                @endif

                                                
                                                    
                                                </div>

                                            {{-- Kondisi Gambar Template End --}}
                                        </div>

                                        <div class="tab-pane fade" id="gambar-apd-user-content" role="tabpanel"
                                            aria-labelledby="gambar-apd-user-tab" wire:key='apd-user' wire:ignore.self>


                                            {{-- Kondisi Gambar APD Anda Start --}}
                                                {{-- Saat User Belum Pernah Upload Gambar --}}
                                                @if(is_null($gambar_apd_user_sebelum))
                                                    

                                                    @if ($gambar_apd_user)
                                                    <div class="jumbotron jumbotron-fluid text-center">
                                                        Perubahan akan terlihat setelah Data APD diinput, pastikan data sudah benar
                                                        sebelum
                                                        klik Simpan.
                                                    </div>
                                                    <div>
                                                        <a class="btn btn-secondary btn-sm btn-flat rounded-pill"
                                                            style="cursor: pointer;" data-toggle="collapse" href="#previw-gambar" role="button" aria-expanded="false" aria-controls="previw-gambar">
                                                            <i class="fas fa-image fa-lg mr-2"></i>
                                                            Preview Gambar
                                                        </a>
                                                    </div>
                                                    @else
                                                        <div class="jumbotron jumbotron-fluid text-center">
                                                            Anda belum melakukan upload gambar apd.
                                                        </div>
                                                    @endif
                                                {{-- Saat terjadi kesalahan saat memuat gambar upload user --}}
                                                @elseif(is_bool($gambar_apd_user_sebelum))
                                                    

                                                    @if ($gambar_apd_user)
                                                    <div class="jumbotron jumbotron-fluid text-center">
                                                        Perubahan akan terlihat setelah Data APD diinput, pastikan data sudah benar
                                                        sebelum
                                                        klik Simpan.
                                                    </div>
                                                    <div>
                                                        <a class="btn btn-secondary btn-sm btn-flat rounded-pill"
                                                            style="cursor: pointer;" data-toggle="collapse" href="#previw-gambar" role="button" aria-expanded="false" aria-controls="previw-gambar">
                                                            <i class="fas fa-image fa-lg mr-2"></i>
                                                            Preview Gambar
                                                        </a>
                                                    </div>
                                                    @else
                                                        <div class="jumbotron jumbotron-fluid text-center">
                                                            <div class="text-danger">
                                                                <small>Terjadi kesalahan saat memuat gambar input sebelumnya.</small>
                                                            </div>
                                                        </div>
                                                    @endif
                                                
                                                {{-- Jika user telah upload sebelumnya --}}
                                                @else
                                                    <div class="col">
                                                        <div class="text-info my-2">
                                                            <small>Berikut merupakan gambar APD anda untuk model
                                                                <strong><u>{{$nama_apd_user_sebelum}}</u></strong> yang
                                                                telah anda
                                                                upload.</small>
                                                        </div>

                                                        @if(is_array($gambar_apd_user_sebelum))
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
                                                                src="{{asset($upload_path . $gambar_apd_user_sebelum[0])}}" alt="Gambar Apd Anda">
                                                            <div class="col apd-user product-image-thumbs">

                                                                @foreach ($gambar_apd_user_sebelum as $key => $gbr)
                                                                    @if($key === array_key_first($gambar_apd_user_sebelum))
                                                                    <div class="apd-user product-image-thumb active"><img
                                                                            src="{{asset($upload_path . $gbr)}}" alt="Product Image">
                                                                    </div>
                                                                    @else
                                                                    <div class="apd-user product-image-thumb"><img
                                                                            src="{{asset($upload_path . $gbr)}}" alt="Product Image">
                                                                    </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        @elseif(is_string($gambar_apd_user_sebelum))
                                                            <img class="apd-user product-image" id="apd_user"
                                                            src="{{asset($upload_path . $gambar_apd_user_sebelum)}}" alt="Gambar Apd Anda">
                                                        @endif

                                                        @if ($gambar_apd_user)
                                                        <div class="mt-2">
                                                            <div>
                                                                <small>Perubahan gambar akan tampil setelah data APD
                                                                    disimpan.</small>
                                                            </div>
                                                            <div>
                                                                <a class="btn btn-secondary btn-sm btn-flat rounded-pill"
                                                                    style="cursor: pointer;"
                                                                    data-toggle="collapse" href="#previw-gambar" role="button" aria-expanded="false" aria-controls="previw-gambar">
                                                                    <i class="fas fa-image fa-lg mr-2"></i>
                                                                    Preview Gambar
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endif

                                                    </div>
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
                                <h3 class="my-1">{{$template_nama_jenis_apd}}</h3>
    
                                <div class="mb-2">
                                    <div>
                                        Status Verifikasi : <span
                                            class="badge badge-{{$warna_verifikasi}}">{{$label_verifikasi}}</span>
                                    </div>
    
                                    @if ($komentar_verifikator != "")
                                    <div>
                                        Keterangan Admin : <br>
                                        <span
                                            class="bg-gradient-{{$warna_verifikasi}} color-palette h6">{{$komentar_verifikator}}</span>
                                    </div>
                                    @endif
    
                                </div>
    
                                <div class="form-group">
    
                                    {{-- Pesan Setelah Input start --}}
                                        @if (session()->has('alert-success'))
                                            <div class="alert alert-success alert-dismissable fade show" role="alert">
                                                {{session('alert-success')}}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
        
                                        @if (session()->has('alert-danger'))
                                            <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                                {{session('alert-danger')}}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                    {{-- Pesan Setelah Input End --}}
                                </div>
    
                                    <div class="form-group">
                                        <label>Status Keberadaan APD : </label>
                                        <select class="form-control" wire:model="status_keberadaan_apd_user" wire:change='changeDropdownKeberadaan'>
                                            <option value="" disabled>APD Ada/Hilang/Belum Terima ?</option>
                                            @foreach ($opsi_dropdown_keberadaan as $item)
                                                <option value="{{$item['value']}}">{{$item['text']}}</option>
                                            @endforeach
                                        </select>
                                        @error('status_keberadaan_apd_user')
                                            <small class="error text-danger"><strong>{{$message}}</strong></small>
                                        @enderror
                                    </div>
    
                                    
                                @if ($status_keberadaan_apd_user == "ada")
                                    <div class="form-group">
                                        <label>Model</label>
                                        <select class="form-control" wire:model='id_apd_user'
                                            wire:change='changeDropdownListApd'>
                                            <option value="" disabled>Pilih model APD</option>
                                            @if (!is_null($opsi_dropdown_list_apd))
                                                @foreach ($opsi_dropdown_list_apd as $apd)
                                                    <option wire:key="opsi-apd-{{$apd['nama_apd']}}" value="{{$apd['id_apd']}}">
                                                        {{$apd['nama_apd']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    @error('id_apd_user')
                                        <small class="error text-danger">{{$message}}</small>
                                    @enderror

                                    <p></p>
                                    <p></p>
                                    @if($id_apd_user != '')
                                        <div class="form-group">
                                            <label>Ukuran</label>
                                            @if (!is_null($opsi_dropdown_size_apd))
                                                <select class="form-control" wire:model.defer='size_apd_user'>
                                                    <option value="" disabled>Pilih ukuran APD</option>
                                                        @foreach ($opsi_dropdown_size_apd as $size)
                                                            <option>{{$size}}</option>
                                                        @endforeach
                                                </select>
                                            @else
                                                <input class="form-control" type="text" wire:model.defer='size_apd_user' placeholder="Model ini tidak memiliki pilihan ukuran." disabled>
                                            @endif

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
                                                @if (!is_null($opsi_dropdown_kondisi_apd))
                                                    @foreach ($opsi_dropdown_kondisi_apd as $kondisi)
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
                                    @endif
                                        
                                @elseif($status_keberadaan_apd_user == "hilang")
        
                                        <div class="text-danger">
                                            <h4>Status APD anda <strong><u>Hilang</u></strong>, pastikan anda menghubungi admin yang bertanggung jawab di tempat anda dan ikuti instruksi selanjutnya.</h4>
                                        </div>
        
                                @elseif($status_keberadaan_apd_user == "belum terima")
                                    <div>
                                        <h4>(opsional) Tambahkan keterangan dibawah.</h4>
                                    </div>
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

                    <div class="modal-footer">
                        @if($status_verifikasi == $enum_verifikasi_apd_terverifikasi)
                            <a class="btn btn-primary btn-m btn-flat rounded-pill" wire:click='updateSetelahTerverifikasi' style="cursor: pointer;">
                                <i class="fas fa-save fa-lg mr-2"></i>
                                Ajukan Perubahan
                            </a>
                        @elseif($status_verifikasi == $enum_verifikasi_apd_verifikasi)
                            <a class="btn btn-primary btn-m btn-flat rounded-pill" wire:click='updateSetelahTerverifikasi' style="cursor: pointer;">
                                <i class="fas fa-save fa-lg mr-2"></i>
                                Update Data APD
                            </a>
                        @else
                            <a class="btn btn-primary btn-m btn-flat rounded-pill" wire:click='simpan' style="cursor: pointer;">
                                <i class="fas fa-save fa-lg mr-2"></i>
                                Simpan Data APD
                            </a>
                        @endif
                    </div>

                    

                </div>
            </div>
        </div>

</div>
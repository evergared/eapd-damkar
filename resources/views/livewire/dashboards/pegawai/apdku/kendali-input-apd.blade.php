
<div class="card">
            <div class="card-header">
                <div class="card-title"><h4>Input Data APD</h4></div>
                <div class="card-tools">
                    <button class="btn-primary btn-sm" onclick="kendaliKeButuhInput()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </div>
            </div>
            <div class="card-body overlay-wrapper">

                <div  wire:loading wire:target='inisiasiModalInput'>
                    <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-2">Memperbarui Data...</div></div>
                </div>

                @if ($error_time_inisiasi_modal != '')
                    <div class="overlay text-danger"><i class="fas fa-exclamation-circle mr-2"></i><div class="text-bold pt-2">Kesalahan saat mengambil data sebelumnya. ref : {{$error_time_inisiasi_modal}}</div></div>
                @endif

                @if ($status_verifikasi == $enum_verifikasi_apd_terverifikasi)
                    <strong class="text-muted">Data anda telah diverifikasi oleh admin. Jika ada perubahan data, ubah data terlebih dahulu dan klik tombol Ajukan Perubahan di bawah.</strong>
                @elseif($status_verifikasi == $enum_verifikasi_apd_verifikasi)
                    <strong class="text-muted">Data anda telah masuk dan menunggu verifikasi dari admin. Anda masih dapat mengubah data sebelum inputan anda di verifikasi admin.</strong>
                @endif

                
                <div class="row" wire:ignore.self>
                    <div class="col-12 col-sm-6 mb-4" wire:key='tampil-gambar'>
                        <h3 class="d-inline-block d-sm-none">{{$template_nama_jenis_apd}}</h3>
                        <ul class="nav nav-tabs mb-2" role="tablist" id="gambar-apd-nav-tabs">
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
                                        @if($status_keberadaan_apd_user == "Ada")
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
                                                Pilih status keberadaan APD anda.
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
                                                onclick="$('#modal-upload-gambar').modal('show')" href='javascript:'  wire:click='$set("show_gambar_reupload", false)'>
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
                                                    onclick="$('#modal-upload-gambar').modal('show')" href='javascript:' wire:click='$set("show_gambar_reupload", false)'>
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
                                                            onclick="$('#modal-upload-gambar').modal('show')" href='javascript:' wire:click='$set("show_gambar_reupload", false)'>
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
                    {{-- Form Input Start --}}
                    <div class="col-12 col-sm-6" wire:key='tampil-form'>
                        @if ($status_verifikasi == $enum_verifikasi_apd_terverifikasi)
                            {{-- nav tabs Form Input start --}}
                            <ul class="nav nav-tabs mb-2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab-data-verif" data-toggle='pill' role="tab" aria-controls="tab-data-verif" wire:click='$set("show_ajukan_perubahan", false)' wire:ignore.self>
                                        Data Terverifikasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab-form-apd" data-toggle='pill' role="tab" aria-controls="tab-form-apd" wire:click='$set("show_ajukan_perubahan", true)' wire:ignore.self>
                                        Ubah Data
                                    </a>
                                </li>
                                @if ($show_data_perubahan_pending)
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-perubahan-pending" data-toggle='pill' role="tab" aria-controls="tab-perubahan-pending" wire:ignore.self>
                                            Perubahan Pending
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            {{-- nav tabs Form Input end --}}
                        <div class="tab-content">
                            {{-- data terverifikasi Form Input start --}}
                            <div class="tab-pane fade show active" id="tab-data-verif" role="tabpanel" wire:ignore.self>
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <strong>Verifikasi Admin</strong>
                                        </div>
                                        <div class="row">
                                            <span class="badge badge-{{$warna_verifikasi}}">{{$label_verifikasi}}</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <strong>Status APD</strong>
                                        </div>
                                        <div class="row">
                                            <span class="badge badge-{{$warna_kerusakan}}">{{$label_kerusakan}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <strong>Tanggal Input : </strong>
                                    </div>
                                    <div class="col">
                                        <span class="badge badge-success">{{$terakhir_diisi}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <strong>Tanggal Terverif : </strong>
                                    </div>
                                    <div class="col">
                                        <span class="badge badge-info">{{$terakhir_diverif}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <strong>Komentar Anda : </strong>
                                </div>  
                                <div class="row">
                                    <div class="blockquote">
                                        {{($komentar_apd_user_sebelum) ? $komentar_apd_user_sebelum : '-'}}
                                    </div>
                                </div>
                                <div class="row">
                                    <strong>Komentar Verifikator : </strong>
                                </div>  
                                <div class="row">
                                    <div class="blockquote">
                                        {{($komentar_verifikator) ? $komentar_verifikator : '-'}}
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
                                        {{$nama_apd_user_sebelum}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <strong>No Seri : </strong>
                                    </div>
                                    <div class="col">
                                        {{($no_seri_apd_user_sebelum)? $no_seri_apd_user_sebelum : '-'}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <strong>Ukuran : </strong>
                                    </div>
                                    <div class="col">
                                        {{($size_apd_user_sebelum)? $size_apd_user_sebelum : '-'}}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <h5><strong>Data Verifikator</strong></h5>
                                </div>
                                <div class="row">
                                    <strong>Verifikator : </strong>
                                </div>  
                                <div class="row">
                                        {{($nama_verifikator) ? $nama_verifikator : '-'}}
                                </div>
                                <div class="row">
                                    <strong>Jabatan Verifikator : </strong>
                                </div>  
                                <div class="row">
                                        {{($jabatan_verifikator) ? $jabatan_verifikator : '-'}}
                                </div>
                            </div>
                            {{-- data terverifikasi Form Input end --}}

                            <div class="tab-pane fade " id="tab-form-apd" role="tabpanel" wire:ignore.self>
                        @endif
                                {{-- bagian input Form Input start --}}
                                <h3 class="my-1">{{$template_nama_jenis_apd}}</h3>

                                <div class="mb-2">
                                    <div>
                                        Status Verifikasi : <span
                                            class="badge badge-{{$warna_verifikasi}}">{{$label_verifikasi}}</span>
                                    </div>
    
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
                                        <select class="form-control" wire:model.defer="status_keberadaan_apd_user" wire:change='changeDropdownKeberadaan'>
                                            <option value="" disabled>APD Ada/Hilang/Belum Terima ?</option>
                                            @foreach ($opsi_dropdown_keberadaan as $item)
                                                <option value="{{$item['value']}}">{{$item['text']}}</option>
                                            @endforeach
                                        </select>
                                        @error('status_keberadaan_apd_user')
                                            <small class="error text-danger"><strong>{{$message}}</strong></small>
                                        @enderror
                                    </div>
    
                                    
                                @if ($status_keberadaan_apd_user == "Ada")
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
                                        @error('id_apd_user')
                                            <small class="error text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    @if ($show_input_no_seri)
                                        <div class="form-group">
                                            <label>No Seri</label>
                                            <input type="text" class="form-control" placeholder="Masukan no seri apd." wire:model='no_seri_apd_user'>
                                            @error('no_seri_apd_user')
                                                <small class="error text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    @endif

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
                                        
                                @elseif($status_keberadaan_apd_user == "Hilang")
        
                                        <div class="text-danger">
                                            <h4>Status APD anda <strong><u>Hilang</u></strong>, pastikan anda menghubungi admin yang bertanggung jawab di tempat anda dan ikuti instruksi selanjutnya.</h4>
                                        </div>
        
                                @elseif($status_keberadaan_apd_user == "Belum Terima")
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
                                
                                
                                {{-- bagian input Form Input end --}}
                        @if ($status_verifikasi == $enum_verifikasi_apd_terverifikasi)
                            </div>
                            @if ($show_data_perubahan_pending)
                                <div class="tab-pane fade" id="tab-perubahan-pending" role="tabpanel" wire:ignore.self>
                                    <strong class="text-info">Dibawah ini adalah ajuan perubahan data APD yang menunggu persetujuan admin. Anda masih dapat merubah data dibawah melalui Ubah Data.</strong>
                                    <div class="row">
                                        <h5><strong>Status APD</strong></h5>
                                    </div>
                                    <div class="row">
                                        <h1><span class="badge badge-large badge-{{$warna_kondisi_apd_user_reupload}}">{{$label_kondisi_apd_user_reupload}}</span></h1>
                                    </div>
                                    <div class="row">
                                        <strong>Tanggal Diajukan : </strong>
                                    </div>
                                    <div class="row">
                                        {{$data_diupdate_reupload}}
                                    </div>
                                    <div class="row">
                                        <h5><strong>Detail APD </strong></h5>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <strong>Model : </strong>
                                        </div>
                                        <div class="col">
                                            {{$nama_apd_user_reupload}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <strong>No Seri : </strong>
                                        </div>
                                        <div class="col">
                                            {{($no_seri_apd_user_reupload)? $no_seri_apd_user_reupload : '-'}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <strong>Ukuran : </strong>
                                        </div>
                                        <div class="col">
                                            {{($size_apd_user_reupload)? $size_apd_user_reupload : '-'}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if (!is_null($image_apd_user_reupload))
                                            <a class="btn btn-secondary btn-sm btn-flat rounded-pill" href="javascript:" wire:click='$set("show_gambar_reupload", true)' onclick="$('#modal-upload-gambar').modal('show')">Preview Gambar Ajuan Perubahan</a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        @endif
                            

                    </div>
                    {{-- Form Input End --}}
                </div>
            </div>

            <div class="card-footer">
                @if($status_verifikasi == $enum_verifikasi_apd_terverifikasi)
                    @if ($show_ajukan_perubahan)
                        <a class="btn btn-primary btn-m btn-flat rounded-pill" wire:click='updateTerverifikasi' style="cursor: pointer;">
                            <i class="fas fa-save fa-lg mr-2"></i>
                            Ajukan Perubahan
                        </a> 
                    @endif
                @elseif($status_verifikasi == $enum_verifikasi_apd_verifikasi)
                    <a class="btn btn-primary btn-m btn-flat rounded-pill" wire:click='update' style="cursor: pointer;">
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


            {{-- Modal Preview Gambar Start --}}
        <div class="modal fade" id="modal-upload-gambar" wire:ignore.self>
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Preview Gambar Upload</h5>
                        <button type="button" class="close" aria-label="Close"
                            onclick="$('#modal-upload-gambar').modal('hide')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @if ($show_gambar_reupload)
                            @if (!is_null($image_apd_user_reupload))
                            <div class="col-12">
                                <span class="text-warning">Gambar berikut merupakan preview gambar yang anda upload.</span>

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
                                @if (is_array($image_apd_user_reupload))
                                <img class="upload-preview product-image" src="{{ $upload_path . $image_apd_user_reupload[0] }}"
                                    alt="Gambar Apd Anda">
                                <div class="col-12 upload-preview product-image-thumbs">

                                    @foreach ($image_apd_user_reupload as $key => $gbr)
                                    @if($key === array_key_first($image_apd_user_reupload))
                                    <div class="upload-preview product-image-thumb active">
                                        <img src="{{$upload_path.$gbr}}" alt="List Gambar Apd">
                                    </div>
                                    @else
                                    <div class="upload-preview product-image-thumb">
                                        <img src="{{$upload_path.$gbr}}" alt="List Gambar Apd">
                                    </div>

                                    @endif
                                    @endforeach
                                </div>

                                {{-- Upload Gambar 1 --}}
                                @elseif (is_string($image_apd_user_reupload))
                                <img class="upload-preview product-image" src="{{$upload_path . $image_apd_user_reupload}}"
                                    alt="Gambar Apd Anda">

                                @endif
                                @else
                                <div class="jumbotron jumbotron-fluid text-center">
                                    Anda belum upload gambar, preview gambar anda akan muncul disini.
                                </div>
                            </div>
                            @endif
                        @else
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
                        @endif

                       
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Preview Gambar End --}}

       

        @push('stack-body')

        <script>
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
              alwaysShowClose: true
            });
          });
        </script>
        
        <script src="{{ asset('admin-lte/ekko-lightbox.min.js')}}">
            
        </script>
        @endpush

</div>

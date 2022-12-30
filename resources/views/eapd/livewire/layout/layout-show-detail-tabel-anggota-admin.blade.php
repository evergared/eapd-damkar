<div wire:ignore.self id="userdetail" style="display:none;">
    <div class="card my-n3 mx-n3">
        <div class="card-header">
                        <div class="card-tools">
                <a href="javascript:" onclick="backToList()"> &larr; <u>kembali</u></a>
            </div>
            <div class="card-title">
                <h4>Progress input</h4>
            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 500px;">


        @if($list_inputan_terisi)
            <table class="table table-head-fixed text-nowrap">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th style="width:20%;">Item</th>
                        <th style="width:50%; height: 60%;" class="d-none d-sm-block">Foto yang diupload
                        </th>
                        <th></th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list_inputan as $urut => $item)
                    <tr>
                        <td class="text-center text-wrap my-auto align-middle">{{$urut+1}}</td>
                        <td class="text-center text-wrap my-auto align-middle">{{$item['nama_jenis']}}
                        </td>
                        <td class="d-none d-sm-block">
                            {{-- Generate list gambar start --}}

                                {{-- Saat tidak ada gambar --}}
                                @if (!is_array($item['gambar_apd']) && $item['gambar_apd'] == "")

                                Tidak ada gambar yang diupload.

                                {{-- Saat ada gambar --}}
                                @elseif(is_array($item['gambar_apd']))

                                <ul class="list-inline w-50">
                                    @foreach ($item['gambar_apd'] as $index=>$i)
                                        <a class="apd-foto" wire:click="satuFoto('preview-foto-apd-anggota',{{$urut}},{{$index}})"
                                            style="cursor: pointer;">
                                            <img alt="APD" class="table-avatar w-75 h-75"
                                                src="{{asset($i)}}">
                                        </a>
                                    @endforeach
                                </ul>

                                {{-- Saat gambar ada satu --}}
                                @elseif(!is_array($item['gambar_apd']) && $item['gambar_apd'] != "")

                                    <a class="apd-foto" wire:click="satuFoto('preview-foto-apd-anggota',{{$urut}},{{-1}})"
                                        style="cursor: pointer;">
                                        <img alt="APD" class="table-avatar w-50 h-50"
                                            src="{{asset($item['gambar_apd'])}}">
                                    </a>
                                    
                                @endif

                                {{-- Generate list gambar end --}}
                        </td>
                        <td></td>
                        <td class="text-center align-middle">
                            <span class="badge badge-sm bg-{{$item['warna_kerusakan']}}">{{$item['status_kerusakan']}}</span>
                        </td>
                        <td class="text-center align-middle">
                            <span class="badge badge-sm bg-{{$item['warna_verifikasi']}}">{{$item['status_verifikasi']}}</span>
                        </td>
                        <td class="text-center align-middle">
                            <a class="btn btn-primary btn-sm" wire:click="lihatDetail({{$urut}})">
                                Lihat detail
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            @else
                <div class="jumbotron text-center">
                    <h4>Tidak ada yang di input.</h4>
                </div>
            @endif

        </div>
        <!-- /.card-body -->
    </div>

                    <!-- {{-- Card untuk preview saat user klik satu gambar start --}} -->
                    <div class="collapse" id="preview-foto-apd-anggota">
                        <div class="mt-5 mx-n3  card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5>Preview Gambar APD</h5>
                                </div>
                                <div class="card-tools">
                                    <button type="button" class="close" data-toggle="collapse"
                                        data-target="#preview-foto-apd-anggota" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($gambar == "")
                                    Tidak ada gambar.
                                @else
                                    <img src="{{asset($gambar)}}" class="img-thumbnail" alt="APD">
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- {{-- Cart untuk preview saat user klik satu gambar end --}} -->

                    <!-- {{-- Card untuk melihat detail inputan start --}} -->
                    <div wire:ignore.self class="mt-5 mx-n3 collapse" id="detail-inputan">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4 class="d-none d-sm-block">Detail Inputan {{$nama_pegawai}}</h4>
                                    <h5 class="d-block d-sm-none">Detail Inputan {{$nama_pegawai}}</h5>
                                </div>
                                <div class="card-tools">
                                    <button type="button" class="close" data-toggle="collapse"
                                        data-target="#detail-inputan" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                                {{-- Tampilan untuk admin melakukan verifikasi start --}}
                                <h5>Data yang diinput pegawai {{'('.$detail_nama_jenis_apd.')'}}</h5>
                                <div class="row">
                                    {{-- inputan dari user start --}}
                                    <div class="col-12 col-sm-6" wire:key='tampil-gambar'>
                                        {{-- nav tabs --}}
                                        <ul class="nav nav-tabs" role="tablist" id="gambar-apd-nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="gambar-upload-user-tab" data-toggle="pill"
                                                    role="tab" aria-controls="gambar-upload-user-content" aria-selected="true" 
                                                    href="#gambar-upload-user-content">Gambar yang diupload</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="gambar-template-tab" data-toggle="pill"
                                                    role="tab" aria-controls="gambar-template-content" aria-selected="false" 
                                                    href="#gambar-template-content">Gambar APD</a>
                                            </li>
                                        </ul>

                                        {{-- tabbed pane gambar apd start--}}
                                        <div class="tab-content" id="gambar-apd-nav-tabsContent">
                                            <div class="tab-pane fade active show" id="gambar-upload-user-content" role="tabpanel" aria-labelledby="gambar-upload-user-tab">
                                                
                                                @if (!is_null($gambar_template_apd))
                                                    <span class="text-info">Dibawah ini merupakan gambar yang diupload oleh pegawai.</span>
                                                @endif

                                                {{-- generate gambar pegawai start --}}
                                                @if (is_array($detail_gambar_user) && count($detail_gambar_user)>1)

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
                                                        src="{{asset($detail_gambar_user[0])}}" alt="Gambar Apd Anda">
                                                    <div class="col-12 apd-user product-image-thumbs">
                                                        @foreach ($detail_gambar_user as $key => $gbr)
                                                            @if($key === array_key_first($detail_gambar_user))
                                                            <div class="apd-user product-image-thumb active"><img
                                                                    src="{{asset($gbr)}}" alt="APD">
                                                            </div>
                                                            @else
                                                            <div class="apd-user product-image-thumb"><img
                                                                    src="{{asset($gbr)}}" alt="APD">
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @elseif(is_string($detail_gambar_user) && $detail_gambar_user != "")

                                                    <img src="{{asset($detail_gambar_user)}}" class="img-thumbnail" alt="APD">

                                                @elseif(!$detail_gambar_user)
                                                    <div class="jumbotron text-center">
                                                    Tidak ada gambar yang diupload oleh pegawai.
                                                    </div>
                                                @endif
                                                {{-- generate gambar pegawai end --}}
                                            </div>
                                            <div class="tab-pane fade" id="gambar-template-content" role="tabpanel" aria-labelledby="gambar-upload-user-tab">
                                                
                                                @if (!is_null($gambar_template_apd))
                                                    <span class="text-info">Dibawah ini merupakan gambar {{$detail_nama_jenis_apd}} untuk model {{$detail_nama_apd}}</span>
                                                @endif

                                                @if (is_array($gambar_template_apd) && count($gambar_template_apd)>1)

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
                                                        src="{{asset($gambar_template_apd[0])}}" alt="Gambar Apd Anda">
                                                    <div class="col-12 apd-template product-image-thumbs">
                                                        @foreach ($gambar_template_apd as $key => $gbr)
                                                            @if($key === array_key_first($gambar_template_apd))
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
                                                @elseif(is_string($gambar_template_apd) && $gambar_template_apd != "")

                                                    <img src="{{asset($gambar_template_apd)}}" class="img-thumbnail" alt="APD">

                                                @elseif(!$gambar_template_apd)
                                                    <div class="jumbotron text-center">
                                                        Tidak ada gambar {{$detail_nama_apd}} yang disediakan.
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                        {{-- tabbed pane gambar apd end --}}
                                        <div>
                                            <div class="row">
                                                <div class="col"><strong>Jenis APD</strong></div>
                                                <div class="col">:</div>
                                                <div class="col">{{$detail_nama_jenis_apd}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><strong>Model APD</strong></div>
                                                <div class="col">:</div>
                                                <div class="col">{{$detail_nama_apd}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><strong>Status Kondisi</strong></div>
                                                <div class="col">:</div>
                                                <div class="col"><span class="badge bg-{{$detail_warna_kerusakan}}">{{$detail_status_kerusakan}}</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><strong>Komentar Pengupload</strong></div>
                                            </div>
                                            <div class="row">
                                                <div class="col colspan-3"><em>{{$detail_komentar_pengupload}}</em></div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- inputan dari user end --}}

                                    {{-- untuk admin start --}}
                                    <div class="col-12 col-sm-6" wire:key='tampil-form'>    
                                        <h5 class="mt-5 d-block d-sm-none">Data Validasi</h5>
                                        <h5 class="d-none d-sm-block">Data Validasi</h5>

                                        <div>
                                            <div class="row">
                                                <div class="col"><strong>Status Validasi</strong></div>
                                                <div class="col">:</div>
                                                <div class="col"><span class="badge bg-{{$detail_warna_verifikasi}}">{{$detail_status_verifikasi}}</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><strong>Verifikator</strong></div>
                                                <div class="col">:</div>
                                                <div class="col">{{$detail_nama_verifikator}} {{$detail_jabatan_verifikator}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col"><strong>Komentar Verifikator</strong></div>
                                            </div>
                                            <div class="row">
                                                <div class="col colspan-3"><em>{{$detail_komentar_verifikator}}</em></div>
                                            </div>
                                        </div>

                                        <h5 class="mt-5">Ubah Data Validasi</h5>
                                        
                                        @if (session()->has('success_simpan_data'))
                                        <div class="alert alert-success alert-dismissable fade show" role="alert">
                                            {{session('success_simpan_data')}}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif

                                        @if (session()->has('fail_simpan_data'))
                                        <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                            {{session('fail_simpan_data')}}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif

                                        <div>
                                            <div class="form-group">
                                                <label for="select-validasi">Pilih Validasi</label>
                                                <select class="form-control" id="select-validasi" wire:model.defer='admin_verifikasi'>
                                                    <option value="" disabled>Ubah Validasi Inputan Disini</option>
                                                    @foreach ($opsi_verifikasi as $v)
                                                        <option value={{$v['value']}}>{{$v['label']}}</option>
                                                    @endforeach
                                                </select>
                                                @error('admin_verifikasi')
                                                    <span><small class="text-danger">{{$message}}</small></span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="komen-validasi">Keterangan / Komentar Anda</label>
                                                <textarea class="form-control" wire:model.defer='admin_komentar' id="komen-validasi" cols="30" rows="10" placeholder="(Opsional) keterangan / komentar mengenai inputan apd pegawai."></textarea>
                                            </div>
                                            <div class="text-center">
                                                <button class="btn btn-primary" wire:ignore.self wire:click='simpanDataValidasi'>Terapkan</button>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- untuk admin end --}}
                                </div>

                                {{-- Tampilan untuk admin melakukan verifikasi end --}}
                            </div>
                        </div>
                    </div>
                    <!-- {{-- Card untuk melihat detail inputan end --}} -->

                    <!-- /.card -->

<script>
window.addEventListener('kolapseShow',event => {
    // console.log('Kolapse Show '+event.detail.id)
    $('#'+event.detail.id).collapse('show')
    document.getElementById(event.detail.id).focus()
})

window.addEventListener('kolapseHide',event => {
    $('#'+event.detail.id).collapse('hide')
})

$(document).ready(function() {
$('.apd.product-image-thumb').on('click', function () {
    var $image_element = $(this).find('img')
    $('.apd-preview.product-image').prop('src', $image_element.attr('src'))
    $('.apd.product-image-thumb.active').removeClass('active')
    $(this).addClass('active')
    })
})
</script>

</div>
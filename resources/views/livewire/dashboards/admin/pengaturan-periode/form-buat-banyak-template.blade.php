<div class="card" id="card-multi-template-inputan-apd">
    <div class="card-header">
        <div class="card-title">
            <h5>Tambah Template Inputan APD</h5>
        </div>
        <div class="card-tools text-right" style="cursor:pointer;" onclick="kembaliKeTabelInputanApdDariMulti()">
            <a>&larr; <u>kembali</u></a>
        </div>
    </div>
    <div class="card-body">

        {{-- start collapse-list-periode-loading --}}
        <div wire:loading>
                <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                <small> Memproses . . .</small>
        </div>
        {{-- end collapse-list-periode-loading --}}

        {{-- start alert status --}}
        @if (session()->has('card_template_multi_success'))
            <div class="alert alert-success alert-dismissable fade show" role="alert">
                {{session('card_template_multi_success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('card_template_multi_danger'))
            <div class="alert alert-danger alert-dismissable fade show" role="alert">
                {{session('card_template_multi_danger')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('card_template_multi_hasil_sukses'))
            <div class="alert alert-success alert-dismissable fade show" role="alert">
                Berhasil menambahkan <strong>{{session('card_template_multi_hasil_sukses')["sukses"]}}</strong> dari <strong>{{session('card_template_multi_hasil_sukses')["jumlah"]}}</strong> {{session('card_template_multi_hasil_sukses')["tipe"]}}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('card_template_multi_hasil_gagal'))
            <div class="alert alert-danger alert-dismissable fade show" role="alert">
                Gagal menambahkan <strong>{{session('card_template_multi_hasil_gagal')["gagal"]}}</strong> dari <strong>{{session('card_template_multi_hasil_gagal')["jumlah"]}}</strong> {{session('card_template_multi_hasil_gagal')["tipe"]}}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('card_template_multi_hasil_multi'))
            <div class="alert alert-grey alert-dismissable fade show" role="alert">
                Berhasil menambahkan <strong>{{session('card_template_multi_hasil_multi')["sukses"]}}</strong> dari <strong>{{session('card_template_multi_hasil_multi')["jumlah"]}}</strong> {{session('card_template_multi_hasil_multi')["tipe"]}},
                namun gagal menambahkan <strong>{{session('card_template_multi_hasil_multi')["gagal"]}}</strong> dari <strong>{{session('card_template_multi_hasil_multi')["jumlah"]}}</strong> {{session('card_template_multi_hasil_multi')["tipe"]}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('card_template_multi_hasil_none'))
            <div class="alert alert-caution alert-dismissable fade show" role="alert">
                {{session('card_template_multi_hasil_none')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- end alert status --}}

        <h6><i>Klik pada item untuk menghapus</i></h6>
        <div class="card-group">
            {{-- card untuk jabatan --}}
            <div class="card">
                <div class="card-header">
                    Jabatan @if (count($list_jabatan) > 0) ({{count($list_jabatan)}}) @endif
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y:auto ">
                    @if (count($list_jabatan) > 0)
                        <ol>
                            @foreach ($list_jabatan as $index => $item)
                                <li>
                                   <a href="#card-multi-template-inputan-apd" wire:click="CardMultiTemplateHapusJabatan({{$index}})">{{$item["nama_jabatan"]}}</a> 
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <div class="jumbotron text-center">
                            klik <u>+tambah</u> untuk menambahkan data.
                        </div>
                    @endif
                </div>
                <div class="card-footer text-center">
                    <a style="cursor:pointer;" data-toggle="modal" data-target="#modal-ubah-multi-template-inputan-apd" wire:click="CardMultiTemplateTambahJabatan"><u>+tambah</u></a>
                </div>
            </div>
            {{-- card untuk jenis apd --}}
            <div class="card">
                <div class="card-header">
                    Jenis APD @if (count($list_jenis_apd) > 0) ({{count($list_jenis_apd)}}) @endif
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y:auto ">
                    @if (count($list_jenis_apd) > 0)
                        <ol>
                            @foreach ($list_jenis_apd as $index => $item)
                                <li>
                                   <a href="#card-multi-template-inputan-apd" wire:click="CardMultiTemplateHapusJenisApd({{$index}})">{{$item["nama_jenis"]}}</a> 
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <div class="jumbotron text-center">
                            klik <u>+tambah</u> untuk menambahkan data.
                        </div>
                    @endif
                </div>
                <div class="card-footer text-center">
                    <a style="cursor:pointer;" data-toggle="modal" data-target="#modal-ubah-multi-template-inputan-apd" wire:click="CardMultiTemplateTambahJenisApd"><u>+tambah</u></a>
                </div>
            </div>
            {{-- card untuk Apd --}}
            <div class="card">
                <div class="card-header">
                    APD @if (count($list_apd) > 0) ({{count($list_apd)}}) @endif
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y:auto ">
                    @if (count($list_apd) > 0)
                        <ol>
                            @foreach ($list_apd as $index => $item)
                                <li>
                                   <a href="#card-multi-template-inputan-apd" wire:click="CardMultiTemplateHapusApd({{$index}})">{{$item["nama_apd"]}}</a> 
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <div class="jumbotron text-center">
                            klik <u>+tambah</u> untuk menambahkan data.
                        </div>
                    @endif
                </div>
                <div class="card-footer text-center">
                    <a @if($list_jenis_apd) style="cursor:pointer;" @else style="pointer-events: none;" @endif data-toggle="modal" data-target="#modal-ubah-multi-template-inputan-apd" wire:click="CardMultiTemplateTambahApd"><u>+tambah</u></a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-primary" wire:click="CardMultiTemplateSimpan">Simpan</button>
    </div>
</div>
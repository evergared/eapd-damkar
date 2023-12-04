<div wire:ignore.self class="modal fade" id="modal-kolom-progress-tabel-anggota-katon">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Progress Input {{$nama_pegawai}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{$nama_periode}}</h3>
                                <div class="card-tools">
                                    {{$parameter_inputan}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 300px;">

                                {{-- Generate isi tabel start --}}
                                @if($list_inputan_terisi)
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead class="text-center">
                                            <tr>
                                                <th>#</th>
                                                <th style="width:20%;">Item</th>
                                                <th style="width:50%; height: 60%;" class="text-center">Foto yang diupload
                                                </th>
                                                <th style="width:20%;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                                @foreach ($list_inputan as $urut=>$item)
                                                    <tr>
                                                    <td class="text-center text-wrap my-auto align-middle">{{$urut + 1}}</td>
                                                    <td class="text-center text-wrap my-auto align-middle">{{$item['nama_jenis']}}
                                                    </td>
                                                    <td>
                                                        {{-- Tampil gambar saat viewport desktop start--}}
                                                        <div class=" d-none d-sm-block">

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

                                                        </div>
                                                        {{-- Tampil gambar saat viewport desktop end --}}

                                                        {{-- Tampil gambar saat viewport hp start --}}
                                                        <div class="text-center align-middle d-block d-sm-none">
                                                            {{-- Saat tidak ada gambar --}}
                                                            @if (!is_array($item['gambar_apd']) && $item['gambar_apd'] == "")
                                                                Tidak ada gambar.
                                                            
                                                            {{-- Saat ada gambar --}}
                                                            @elseif(is_array($item['gambar_apd']) || (!is_array($item['gambar_apd']) && $item['gambar_apd'] != ""))
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    wire:click="semuaFoto('preview-semua-foto-apd-anggota',{{$urut}})">
                                                                    Lihat Foto
                                                                    </button>
                                                            @endif
                                                        </div>
                                                        {{-- Tampil gambar saat viewport hp end --}}

                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <span class="badge badge-{{$item['warna_verifikasi']}}">{{$item['status_verifikasi']}}</span>
                                                    </td>
                                                </tr>
                                                @endforeach

                                                {{-- Generate isi tabel end --}}
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

                        {{-- Spinner preview gambar Start --}}
                        <div wire:loading wire:target='satuFoto, semuaFoto'>
                            <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                            <small class="text-info"> memuat...</small>
                        </div>
                        {{-- Spinner preview gambar End --}}

                        {{-- Card untuk preview saat user klik satu gambar start --}}
                        <div class="collapse" id="preview-foto-apd-anggota">
                            <div class="card">
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
                        {{-- Cart untuk preview saat user klik satu gambar end --}}

                        {{-- Card untuk preview saat viewport hp start--}}
                        <div class="collapse" id="preview-semua-foto-apd-anggota">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h5>{{$nama_terpilih}}</h5>
                                    </div>
                                    <div class="card-tools">
                                        <button type="button" class="close" data-toggle="collapse"
                                            data-target="#preview-semua-foto-apd-anggota" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{-- Generate tampilan gambar semua apd berdasarkan index button Lihat Foto Start --}}

                                    {{-- Ketika tidak ada gambar --}}
                                    @if (!$gambar_terpilih_terisi)
                                        <div class="jumbotron text-center">
                                            Tidak ada gambar yang diupload.
                                        </div>
                                    
                                    {{-- Ketika hanya ada satu gambar --}}
                                    @elseif($gambar_terpilih_terisi && !is_array($gambar_terpilih))
                                        <img src="{{asset($gambar_terpilih)}}" class="img-thumbnail" alt="APD">

                                    {{-- ketika ada lebih dari satu gambar --}}
                                    @elseif($gambar_terpilih_terisi && is_array($gambar_terpilih))

                                    <script type="module">
                                        $(document).ready(function() {
                                        $('.apd.product-image-thumb').on('click', function () {
                                            var $image_element = $(this).find('img')
                                            $('.apd-preview.product-image').prop('src', $image_element.attr('src'))
                                            $('.apd.product-image-thumb.active').removeClass('active')
                                            $(this).addClass('active')
                                            })
                                        })
                                    </script>

                                        <img class="apd-preview product-image" id="apd_user"
                                            src="{{asset($gambar_terpilih[0])}}" alt="APD">

                                        <div class="col-12 product-image-thumbs">
                                        @foreach ($gambar_terpilih as $index => $item)

                                            {{-- Jika urutan pertama, maka buat jadi thumbnail aktif --}}
                                            @if($index === array_key_first($gambar_terpilih))
                                            <div class="apd product-image-thumb active">
                                                <img src="{{asset($item)}}" alt="Product Image">
                                            </div>

                                            {{-- Jika tidak, jangan jadikan thumbnail aktif --}}
                                            @else
                                            <div class="apd product-image-thumb">
                                                <img src="{{asset($item)}}" alt="Product Image">
                                            </div>
                                            @endif
                                        @endforeach
                                        </div>
                                    @endif

                                    {{-- Generate tampilan gambar semua apd berdasarkan index button Lihat Foto End --}}
                                </div>
                            </div>
                        </div>
                        {{-- Card untuk preview saat viewport hp end --}}

                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <script type="module">
        window.addEventListener('kolapse',event => {
            $('#'+event.detail.id).collapse('show')
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
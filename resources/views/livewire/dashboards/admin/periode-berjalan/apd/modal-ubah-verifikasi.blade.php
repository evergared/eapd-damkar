<div>
    {{-- modals --}}
    <div class="modal fade" id="modal-ubah-verifikasi" wire:ignore.self>
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Ubah Verifikasi {{$jumlah_data}} Inputan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click='$emit("hitungCapaian")'>
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @if (session()->has('alert-success-modalUbah'))
                    <div class="alert alert-success alert-dismissable fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('alert-success-modalUbah')}}
                    </div>
                    </div>
                @endif
                @if (session()->has('alert-warning-modalUbah'))
                    <div class="alert alert-warning alert-dismissable fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        Berhasil mengubah <strong>{{session('alert-warning-modalUbah')['berhasil']}}</strong> inputan dan gagal mengubah <strong>{{session('alert-warning-modalUbah')['gagal']}}</strong> inputan.
                    </div>
                    </div>
                @endif
                @if (session()->has('alert-danger-modalUbah'))
                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('alert-danger-modalUbah')}}
                    </div>
                    </div>
                @endif
                @if (session()->has('alert-secondary-modalUbah'))
                    <div class="alert alert-secondary alert-dismissable fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('alert-secondary-modalUbah')}}
                    </div>
                    </div>
                @endif
            <div class="row">  
                <div class="form-group">
                    <label>Validasi</label>
                    <select class="form-control" id="validasi" wire:model='model_verifikasi'>
                        <option value="" disabled>Pilih verifikasi</option>
                        @if ($opsi_dropdown_verifikasi)
                            @foreach ($opsi_dropdown_verifikasi as $item)
                                <option value="{{$item['value']}}">{{$item['text']}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('model_verifikasi')
                        <small class="error text-danger"><strong>{{$message}}</strong></small>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label>Catatan / Komentar </label>
                    <textarea class="form-control" rows="3" placeholder="Masukan catatan atau komenter untuk pengupload." wire:model='model_komentar'></textarea>
                </div>
            </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal" wire:click='$emit("hitungCapaian")'>Close</button>
            <button type="button" class="btn btn-primary" wire:click='simpanPerubahanVerifikasi'>Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

        <script>
            window.addEventListener('byInputanPanggilModalUbah', event=>{
                console.log('modal terpanggil')
                $("#modal-ubah-verifikasi").modal('show')
            })
        </script>

</div>

@include('komponen.breadcrumbs',[ 'halamanJudul'=>'Profil Pegawai','halaman'=>'profil'])

<livewire:komponen.marquee>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <form wire:submit.prevent='test'>
                            <h2>Ubah Data Profil</h2>
                            @if (session()->has('sukses'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{session('sukses')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    @if ($uploadFoto && !($errors->has('uploadFoto')))
                                    <img src="{{$uploadFoto->temporaryUrl()}}" class="img-fluid">
                                    @else
                                    <img src="{{ $foto }}" class="img-fluid">
                                    @endif
                                    <div class="mt-2 form-group">
                                        <label for="foto">Upload foto baru</label>
                                        <input class="form-control" id="foto" type="file" wire:model='uploadFoto'>
                                        @error('uploadFoto')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                    
                                </div>
                    
                                <div class="col-lg-8 mt-4">
                                    <div class="form-group">
                                        <label for="email">Alamat Email</label>
                                        <input class="form-control" type="email" id="email" wire:model="email"
                                            placeholder="Masukan alamat email di sini">
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="telp">Nomer Telepon</label>
                                        <input class="form-control" type="text" id="telp" wire:model="noTelp"
                                            placeholder="Masukan nomer telpon disini.">
                                        @error('noTelp')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control" type={{$inputType}} id="password" wire:model="password"
                                            placeholder="Masukan password baru disini">
                                        <small class="text-muted">Biarkan jika anda tidak ingin merubah password</small>
                                        @error('password')
                                        <br>
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="ulangi-password">Ulangi Password</label>
                                        <input class="form-control" type={{$inputType}} id="ulangi-password" wire:model="ulangiPassword"
                                            placeholder="Masukan kembali password baru disini">
                                        <small class="text-muted">Biarkan jika anda tidak ingin merubah password</small>
                                        @error('ulangiPassword')
                                        <br>
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="showPassword" id="showPassword"
                                            wire:model='showPassword'>
                                        <label for="showPassword" class="form-check-label">Tampil Password</label>
                                    </div>
                                    <div class="form-group mt-4">
                                        <button class="btn btn-primary btn-md" wire:click='test'>Simpan Perubahan</button>
                                        <button class="btn btn-secondary btn-md" wire:click='resetData'>Reset Input</button>
                                    </div>
                                </div>
                    
                            </div>
                    
                    
                    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
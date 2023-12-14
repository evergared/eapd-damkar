<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h5>Atur Template Inputan APD</h5>
        </div>
        <div class="card-tools text-right">
            <button type="button" class="close" data-toggle="collapse"
                        data-target="#tabel-template" aria-label="Close">
                        <span aria-hidden="true">×</span>
                </button>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="tabel-template-info">
            <div class="card-body">
                <div class="card-tools">
                    <button type="button" class="close" data-toggle="collapse"
                        data-target="#tabel-template-info" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div>
                    Dibawah ini merupakan kendali untuk mengatur Template Inputan APD per Jabatan.<br>
                    Kendali ini mengatur tipe apd apa saja yang perlu diinput oleh pegawai pada periode yang telah dipilih  <br>
                    berikut APD apa saja yang perlu diinput. <br>
                    <ul>
                        <li>Jabatan melambangkan bahwa template ini efektif untuk pegawai dengan jabatan tersebut.</li>
                        <li>Jenis APD melambangkan kategori apd apa saja yang harus diinput oleh pegawai.</li>
                        <li>Opsi APD melambangkan apd apa saja yang menjadi pilihan saat melakukan inputan.</li>
                    </ul>
                    
                    Klik tombol "Tambah Banyak" untuk penambahan secara seragam.<br>
                    Template yang baru ditambahkan akan muncul di urut paling akhir sebelum di simpan.
                </div>
            </div>
        </div>

        <div wire:loading>
                <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                <small> Memproses . . .</small>
        </div>

        @if (session()->has('tabel_inputan_apd_success'))
            <div class="alert alert-success alert-dismissable fade show" role="alert">
                {{session('tabel_inputan_apd_success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('tabel_inputan_apd_danger'))
            <div class="alert alert-danger alert-dismissable fade show" role="alert">
                {{session('tabel_inputan_apd_danger')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @livewire('dashboards.admin.pengaturan-periode.tabel-template')
        
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col text-left">
                <button class="btn btn-info" wire:click="tambahBanyak">Tambah Banyak</button>
                <button class="btn btn-info" wire:click="tambahSatu">Tambah Satu</button>
            </div>
            <div class="col text-right">
                <button class="btn btn-primary" wire:click="SimpanTemplate">Simpan</button>
            </div>
        </div>
    </div>
</div>
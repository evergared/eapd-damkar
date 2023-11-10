<div class="modal fade" id="modal-ubah-multi-template-inputan-apd" tabindex="-1" role="document" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Tambah Banyak Atribut Inputan
                </h5>
                <button type="button" class="close" data-toggle="modal"
                    data-target="#modal-ubah-multi-template-inputan-apd" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($mode == "jabatan")
                    @livewire('eapd.datatable.tabel-jabatan-template-multi')
                    
                @elseif ($mode == "jenis_apd")
                    @livewire('eapd.datatable.tabel-jenis-apd-template-multi')

                @elseif ($mode == "opsi_apd")
                    @livewire('eapd.datatable.tabel-apd-template-multi')
                @else
                    <div class="jumbotron text-center">
                        Memuat data...
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" wire:click='ModalUbahMultiTemplateInputanApdSimpan' data-toggle="modal" data-target="#modal-ubah-multi-template-inputan-apd">Simpan</button>
            </div>
        </div>
    </div>
</div>
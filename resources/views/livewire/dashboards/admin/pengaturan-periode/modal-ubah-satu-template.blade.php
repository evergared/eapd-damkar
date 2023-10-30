<div class="modal fade" id="modal-ubah-single-template-inputan-apd" tabindex="-1" role="document" wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Tambah Satu Atribut Inputan
                </h5>
                <button type="button" class="close" data-toggle="modal"
                    data-target="#modal-ubah-single-template-inputan-apd" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- start collapse-list-periode-loading --}}
                <div wire:loading>
                    <div class="spinner-border spinner-border-sm text-info" role="status"></div>
                    <small> Memproses . . .</small>
                </div>
                {{-- end collapse-list-periode-loading --}}

                {{-- start bagian untuk tabel --}}
                @if ($modal_ubah_single_inputan_apd_mode == "jabatan")
                    @livewire("eapd.datatable.tabel-jabatan-template-single")
                    
                @elseif($modal_ubah_single_inputan_apd_mode == "jenis_apd")
                    @livewire("eapd.datatable.tabel-jenis-apd-template-single")

                @elseif($modal_ubah_single_inputan_apd_mode == "opsi_apd")
                    @livewire("eapd.datatable.tabel-apd-template-single")

                @else
                    <div class="jumbotron text-center">
                        Memuat data . . .
                    </div>
                @endif
                {{-- end bagian untuk tabel --}}
            </div>
        </div>
    </div>
</div>
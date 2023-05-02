<div class="btn-group" role="group" aria-label="tindakan">
    <button type="button" class="btn btn-primary mx-1" wire:click="$emit('TabelListPeriodeClone','{{$id}}')">Clone</button>
    @if ($aktif)
        <button type="button" class="btn btn-warning mx-1" wire:click="$emit('TabelListPeriodeNonAktifkan','{{$id}}')">Non-Aktifkan</button>
    @else
        <button type="button" class="btn btn-primary mx-1" wire:click="$emit('TabelListPeriodeAktifkan','{{$id}}')">Aktifkan</button>
    @endif
    <button type="button" class="btn btn-primary mx-1" wire:click="$emit('TabelListPeriodeTesPesanBerjalan','{{$id}}')">Tes Pesan Berjalan</button>
    <button type="button" class="btn btn-info mx-1" wire:click="$emit('TabelListPeriodeDetil','{{$id}}')">Detil</button>
    <button type="button" class="btn btn-danger mx-1" wire:click="$emit('TabelListPeriodeHapus','{{$id}}')">Hapus</button>
</div>
<div class="btn-group" role="group" aria-label="tindakan">
    <button type="button" class="btn btn-primary mx-1" onclick="confirm('Gandakan periode ini?') || event.stopImmediatePropagation()" wire:click="Clone('{{$id}}')">Clone</button>
    @if ($aktif)
        <button type="button" class="btn btn-warning mx-1" onclick="confirm('Tutup masa input periode?') || event.stopImmediatePropagation()" wire:click="NonAktifkan('{{$id}}')">Tutup Masa Input</button>
    @else
        <button type="button" class="btn btn-primary mx-1" onclick="confirm('Buka masa input periode ini?') || event.stopImmediatePropagation()" wire:click="Aktifkan('{{$id}}')">Buka Masa Input</button>
    @endif

    @if ($kumpul_ukuran)
        <button type="button" class="btn btn-warning mx-1" onclick="confirm('Tutup masa pengumpulan ukuran untuk periode ini?') || event.stopImmediatePropagation()" wire:click="NonAktifkanKumpulUkuran('{{$id}}')">Tutup Pengumpulan Ukuran</button>
    @else
        <button type="button" class="btn btn-primary mx-1" onclick="confirm('Kumpulkan ukuran untuk periode ini?') || event.stopImmediatePropagation()" wire:click="AktifkanKumpulUkuran('{{$id}}')">Buka Pengumpulan Ukuran</button>
    @endif

    @if ($kumpul_rekap)
        <button type="button" class="btn btn-warning mx-1" onclick="confirm('Tutup rekap periode?') || event.stopImmediatePropagation()" wire:click="NonAktifkanKumpulRekap('{{$id}}')">Tutup Rekap</button>
    @else
        <button type="button" class="btn btn-primary mx-1" onclick="confirm('Buka rekap untuk periode ini?') || event.stopImmediatePropagation()" wire:click="AktifkanKumpulRekap('{{$id}}')">Buka Rekap</button>
    @endif

    <button type="button" class="btn btn-primary mx-1" wire:click="$emit('TabelListPeriodeTesPesanBerjalan','{{$id}}')">Tes Pesan Berjalan</button>
    <button type="button" class="btn btn-info mx-1" wire:click="$emit('TabelListPeriodeDetil','{{$id}}')">Detil</button>
    <button type="button" class="btn btn-danger mx-1" onclick="confirm('Hapus periode ini?') || event.stopImmediatePropagation()" wire:click="Hapus('{{$id}}')">Hapus</button>
</div>
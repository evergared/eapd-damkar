<div class="btn-group" role="group" aria-label="tindakan">
    <button type="button" class="btn btn-primary mx-1" onclick="confirm('Gandakan periode ini?') || event.stopImmediatePropagation()" wire:click="$emit('TabelListPeriodeClone','{{$id}}')">Clone</button>
    @if ($aktif)
        <button type="button" class="btn btn-warning mx-1" onclick="confirm('Non-aktifkan periode?') || event.stopImmediatePropagation()" wire:click="$emit('TabelListPeriodeNonAktifkan','{{$id}}')">Non-Aktifkan</button>
    @else
        <button type="button" class="btn btn-primary mx-1" onclick="confirm('Aktifkan periode ini?') || event.stopImmediatePropagation()" wire:click="$emit('TabelListPeriodeAktifkan','{{$id}}')">Aktifkan</button>
    @endif

    @if ($kumpul_ukuran)
        <button type="button" class="btn btn-warning mx-1" onclick="confirm('Tutup masa pengumpulan ukuran untuk periode ini?') || event.stopImmediatePropagation()" wire:click="$emit('TabelListPeriodeNonAktifkanKumpulUkuran','{{$id}}')">Tutup Pengumpulan Ukuran</button>
    @else
        <button type="button" class="btn btn-primary mx-1" onclick="confirm('Kumpulkan ukuran untuk periode ini?') || event.stopImmediatePropagation()" wire:click="$emit('TabelListPeriodeAktifkanKumpulUkuran','{{$id}}')">Buka Pengumpulan Ukuran</button>
    @endif

    @if ($kumpul_rekap)
        <button type="button" class="btn btn-warning mx-1" onclick="confirm('Tutup rekap periode?') || event.stopImmediatePropagation()" wire:click="$emit('TabelListPeriodeNonAktifkanKumpulRekap','{{$id}}')">Tutup Rekap</button>
    @else
        <button type="button" class="btn btn-primary mx-1" onclick="confirm('Buka rekap untuk periode ini?') || event.stopImmediatePropagation()" wire:click="$emit('TabelListPeriodeAktifkanKumpulRekap','{{$id}}')">Buka Rekap</button>
    @endif

    <button type="button" class="btn btn-primary mx-1" wire:click="$emit('TabelListPeriodeTesPesanBerjalan','{{$id}}')">Tes Pesan Berjalan</button>
    <button type="button" class="btn btn-info mx-1" wire:click="$emit('TabelListPeriodeDetil','{{$id}}')">Detil</button>
    <button type="button" class="btn btn-danger mx-1" onclick="confirm('Hapus periode ini?') || event.stopImmediatePropagation()" wire:click="$emit('TabelListPeriodeHapus','{{$id}}')">Hapus</button>
</div>
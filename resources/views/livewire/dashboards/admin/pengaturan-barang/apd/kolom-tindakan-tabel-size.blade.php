<div class="btn-group" role="group" aria-label="tindakan">
    <button type="button" class="btn btn-info mx-1" wire:click="$emit('editUkuran','{{$id}}')">Edit</button>
    <button type="button" class="btn btn-danger mx-1" @if(!$flag) onclick="confirm('Hapus Ukuran apd ini?') || event.stopImmediatePropagation()" wire:click="hapusUkuran('{{$id}}')" @else onclick="alert('Harap ganti opsi ukuran semua apd yang memiliki opsi ukuran ini ke ukuran lain terlebih dahulu!')" @endif>Hapus</button>
</div>
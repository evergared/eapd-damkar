<div class="btn-group" role="group" aria-label="tindakan">
    <button type="button" class="btn btn-info mx-1" wire:click="$emit('editKondisi','{{$id}}')">Edit</button>
    <button type="button" class="btn btn-danger mx-1" @if(!$flag) onclick="confirm('Hapus Kondisi apd ini?') || event.stopImmediatePropagation()" wire:click="hapusKondisi('{{$id}}')" @else onclick="alert('Harap ganti opsi Kondisi semua apd yang memiliki opsi Kondisi ini ke Kondisi lain terlebih dahulu!')" @endif>Hapus</button>
</div>
<div class="btn-group" role="group" aria-label="tindakan">
    <button type="button" class="btn btn-info mx-1" wire:click="$emit('editPeriode','{{$id}}')">Edit</button>
    <button type="button" class="btn btn-danger mx-1" @if(!$flag) onclick="confirm('Hapus jenis apd ini?') || event.stopImmediatePropagation()" wire:click="hapusJenis('{{$id}}')" @else onclick="alert('Harap hapus atau pindahkan semua apd jenis ini ke jenis lain terlebih dahulu!')" @endif>Hapus</button>
</div>
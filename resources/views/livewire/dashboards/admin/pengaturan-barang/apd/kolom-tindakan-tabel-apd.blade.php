<div class="btn-group" role="group" aria-label="tindakan">
    <button type="button" class="btn btn-info mx-1" wire:click="$emit('editApd','{{$id}}')">Edit</button>
    <button type="button" class="btn btn-danger mx-1"  onclick="confirm('Hapus Apd ini?') || event.stopImmediatePropagation()" wire:click="hapusApd('{{$id}}')" >Hapus</button>
</div>
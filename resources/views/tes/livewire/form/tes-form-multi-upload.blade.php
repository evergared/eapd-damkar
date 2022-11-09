<div>
    <form wire:submit.prevent>
        nama : <input type="text" wire:model='nama'>
        foto : <input type="file" wire:model='foto' multiple>
        <button type="submit">save</button>
    </form>
</div>
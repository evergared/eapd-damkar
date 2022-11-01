<div>
    <h2>Edit Data Pegawai</h2>
    <form wire:submit.prevent='save'>
        <div>
            <label for="nrk">NRK Pegawai</label>
            <input id="nrk" type="text" wire:model='nrk' disabled>
        </div>
        <div>
            <label for="telpon">Telpon</label>
            <input id="telpon" type="text" wire:model='telpon'>
        </div>
        <div>
            <label for="email">E-Mail</label>
            <input id="email" type="text" wire:model='email'>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>

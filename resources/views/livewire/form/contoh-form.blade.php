<div>
    <h2>Edit Data Pegawai</h2>
    <form wire:submit.prevent='save'>
        @if ($foto)
        <div>
            preview foto
            <img src="{{$foto->temporaryUrl()}}">
        </div>
        @endif
        <div>
            <label for="nrk">NRK Pegawai</label>
            <input id="nrk" type="text" wire:model='nrk' disabled>
            @error('nrk')
            NRK Error
            @enderror
        </div>
        @if ($nrk)
        <div>
            <label for="telpon">Telpon</label>
            <input id="telpon" type="text" wire:model='telpon'>
            @error('telpon')
            telpon Error
            @enderror
        </div>
        <div>
            <label for="email">E-Mail</label>
            <input id="email" type="text" wire:model='email'>
            @error('email')
            email Error
            @enderror
        </div>
        <div>
            <label for="foto">Foto Profile</label>
            <input id="foto" type="file" wire:model='foto'>
            @error('foto')
            foto Error
            @enderror
        </div>
        <button type="submit">Submit</button>
        @endif

    </form>
</div>
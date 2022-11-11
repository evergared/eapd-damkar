<div>
    <form wire:submit.prevent>
        @error('foto.*')
        <span class="error">Gambar error : {{ $message }}</span>
        @enderror
        <div>
            nama pegawai : {{ $nama }}
        </div>
        <div>
            foto : <input type="file" wire:model='foto' multiple {{rand()}}>
        </div>
        <button type="submit" wire:click='simpanProfil'>save</button>
    </form>
    <div>
        <h2>
            Preview Gambar :
        </h2>
        @forelse ($foto as $item)
        <div>
            <img src="{{ $item->temporaryUrl() }}">
        </div>
        @empty
        <div>
            Tidak ada gambar yang ditampilkan
        </div>
        @endforelse
    </div>
</div>
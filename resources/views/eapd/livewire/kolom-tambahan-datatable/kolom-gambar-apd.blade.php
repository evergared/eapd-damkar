{{-- Generate list gambar start --}}

{{-- Saat tidak ada gambar --}}
@if (!is_array($gambar_apd) && $gambar_apd == "")

Tidak ada gambar yang diupload.

{{-- Saat ada gambar --}}
@elseif(is_array($gambar_apd))

<ul class="list-inline w-50 text-nowrap">
    @foreach ($gambar_apd as $index=>$i)
        <a class="apd-foto" 
        wire:click="$emit('lihatGambarRekapSudin','{{$i}}')"
            style="cursor: pointer;">
            <img alt="APD" class="table-avatar w-25 h-25"
                src="{{asset($i)}}">
        </a>
    @endforeach
</ul>

{{-- Saat gambar ada satu --}}
@elseif(!is_array($gambar_apd) && $gambar_apd != "")

    <a class="apd-foto" 
    {{-- wire:click="satuFoto('preview-foto-apd-anggota',{{$urut}},{{-1}})" --}}
        style="cursor: pointer;">
        <img alt="APD" class="table-avatar w-50 h-50"
            src="{{asset($gambar_apd)}}">
    </a>
    
@endif

{{-- Generate list gambar end --}}
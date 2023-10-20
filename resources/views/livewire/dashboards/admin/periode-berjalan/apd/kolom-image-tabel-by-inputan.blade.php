{{-- Start tampilan gambar inputan pegawai --}}
@if(is_array($image) && count($image))
{{-- Saat ada gambar dan berisi lebih dari satu --}}
<div class="align-middle">
    <ul class="list-inline w-50 d-none d-sm-block text-center">
    @foreach ($image as $index_gbr => $gbr)
        <a class="apd-foto" href="{{asset($path_gambar . $gbr)}}" data-toggle="lightbox" data-title="Gambar APD" data-gallery="apd-{{$index}}" style="cursor: pointer;">
            <img alt="APD" class="table-avatar w-25 h-25" src="{{asset($path_gambar . $gbr)}}">
        </a>
    @endforeach
    </ul>
</div>
<a class="btn btn-primary d-block d-sm-none" href="{{asset($path_gambar . $gbr)}}" data-toggle="lightbox" data-title="Gambar APD" data-gallery="apd-{{$index}}"><i class="fas fa-image"></i></a>
@elseif(is_string($image) && $image != "")
{{-- Saat ada gambar dan berisi hanya satu --}}
<a class="apd-foto d-none d-sm-block" href="{{asset($path_gambar . $image)}}" data-toggle="lightbox" data-title="Gambar APD" data-gallery="apd-{{$index}}" style="cursor: pointer;">
    <img alt="APD" class="table-avatar w-25 h-25 d-none d-sm-block" src="{{asset($path_gambar . $image)}}">
</a>
<a class="btn btn-primary d-block d-sm-none" href="{{asset($path_gambar . $image)}}" data-toggle="lightbox" data-title="Gambar APD" data-gallery="apd-{{$index}}" style="cursor: pointer;"><i class="fas fa-image"></i></a>
@elseif(!$image)
{{-- Saat tidak ada gambar --}}
Tidak ada gambar yang diupload.
@endif
{{-- End tampilan gambar inputan pegawai --}}
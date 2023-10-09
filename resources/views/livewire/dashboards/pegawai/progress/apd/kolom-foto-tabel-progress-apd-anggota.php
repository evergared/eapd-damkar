<div>
    <a onclick="modal('profil-anggota-katon','{{$id_pegawai}}','tampilProfil')" style="cursor: pointer;">
        @if ($img)
        <img class="img-circle" style="max-width:160px; max-height:160px;"
            src="{{asset('storage/img/avatar/user/'.$img)}}?{{rand()}}">
        @else
        <img class="img-circle" style="max-width:160px; max-height:160px;"
            src="{{asset('storage/img/avatar/placeholder/avatar.jpg')}}">
        @endif
    </a>

</div>
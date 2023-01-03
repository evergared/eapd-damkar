<div>
    <a onclick="modal('profil-anggota-admin-sektor','{{$nrk}}','profilAdminSektor')" style="cursor: pointer;">
        @if ($img)
        <img class="img-circle" style="max-width:75px; max-height:75px;"
            src="{{asset('storage/img/avatar/user/'.$img)}}?{{rand()}}">
        @else
        <img class="img-circle" style="max-width:75px; max-height:75px;"
            src="{{asset('storage/img/avatar/placeholder/avatar.jpg')}}">
        @endif
    </a>

</div>
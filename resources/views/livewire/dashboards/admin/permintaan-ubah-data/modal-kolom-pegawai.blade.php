<div>
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="modal-kolom-pegawai">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div><strong>{{$nama}}</strong></div>
                    <div class="header-tools">
                        <div class="d-flex justify-content-end mb-2">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">

                    

                    <div class="row">
                        <div class="col">
                            @if ($img)
                            <img class="img-thumbnail" style="max-width:160px; max-height:160px;"
                                src="{{asset('storage/img/avatar/user/'.$img)}}?{{rand()}}">
                            @else
                            <img class="img-thumbnail" style="max-width:160px; max-height:160px;"
                                src="{{asset('storage/img/avatar/placeholder/avatar.jpg')}}">
                            @endif
                        </div>
                        <div class="col align-item-center">
                            <div><strong>NIP : </strong>{{$nip}}</div>
                            <div><strong>NRK : </strong>{{$nrk}}</div>
                            <div><strong>Grup : </strong>{{$grup}}</div>
                            <div><strong>Penempatan : </strong>{{$pos}}</div>
                            <div><strong>Telp : </strong>{{$telp}}</div>
                            <div><strong>Email : </strong>{{$email}}</div>
                        </div>
                    </div>


                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
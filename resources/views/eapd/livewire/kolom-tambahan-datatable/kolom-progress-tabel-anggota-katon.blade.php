<a onclick="modal('modal-kolom-progress-tabel-anggota-katon','')" style="cursor: pointer;">
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width:{{($value/$max)*100}}%" aria-valuenow="{{$value}}"
            aria-valuemax="{{$max}}" aria-valuemin="{{$min}}">{{$value}} / {{$max}}</div>
    </div>
</a>
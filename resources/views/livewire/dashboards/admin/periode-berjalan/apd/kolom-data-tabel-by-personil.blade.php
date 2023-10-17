<div>
    <div class="d-none d-sm-block">
        <div class="progress">
            <div class="progress-bar bg-{{$warna}}" role="progressbar"
                style="width:{{ ($maks != 0)? (($value/$maks)*100) : 0}}%" aria-valuenow="{{$value}}"
                aria-valuemax="{{$maks}}" aria-valuemin="0"></div>
        </div>
        <small>{{$tipe}} <strong>{{$value}}</strong> dari <strong>{{$maks}}</strong> item. </small>
    </div>
    <div class="d-block d-sm-none align-middle">
        <small>{{$tipe}} <strong>{{$value}}</strong> dari <strong>{{$maks}}</strong> item. </small>
    </div>
</div>
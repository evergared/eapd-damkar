<div>
    <div class="d-none d-sm-block">
        <div class="progress">
            <div class="progress-bar bg-success" role="progressbar"
                style="width:{{ ($maks != 0)? (($value/$maks)*100) : 0}}%" aria-valuenow="{{$value}}"
                aria-valuemax="{{$maks}}" aria-valuemin="0"></div>
        </div>
        <small>Terinput <strong>{{$value}}</strong> dari <strong>{{$maks}}</strong> item. </small>
    </div>
    <div class="d-block d-sm-none align-middle">
        <small>Terinput <strong>{{$value}}</strong> dari <strong>{{$maks}}</strong> item. </small>
    </div>
</div>
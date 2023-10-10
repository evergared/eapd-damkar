<div>
    <div class="d-none d-sm-block">
        <div class="progress">
            <div class="progress-bar bg-{{$warna}}" role="progressbar"
                style="width:{{ ($maks != 0)? (($value/$maks)*100) : 0}}%" aria-valuenow="{{$value}}"
                aria-valuemax="{{$maks}}" aria-valuemin="0"></div>
        </div>
        <small>Progress {{$caption}} {{ ($maks != 0)? round((($value/$maks)*100),2) : 0}}%</small>
    </div>
    <div class="d-block d-sm-none align-middle">
        <span class="badge badge-sm bg-{{$warna}}">{{ ($maks != 0)? round(($value/$maks)*100,2) : 0}}%</span>
    </div>
</div>
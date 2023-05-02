<div class="d-inline">

    @if($aktif)
            @if ($mode_tes)
                <div class="col-sm-6">
                    <h4 class="m-0">Preview Informasi Yang Akan Ditampilkan :</h4>
                </div>
                <div class="px-0 bg-gradient-teal">
                    <div class="marquee">
                        <div>
                            <span>{{$data_tes_yang_ditampilkan}}</span>
                        </div>
                    </div>
                </div>

                <style>
                        .marquee {
                        height: 35px;
                        width: 100%;
                        
                        overflow: hidden;
                        position: relative;
                        padding: 8px 0 8px 0;
                        }
                        
                        .marquee div {
                        display: inline-block;
                        width: 300%;
                        height: 40px;
                        
                        position: absolute;
                        overflow: hidden;
                        
                        animation: marquee 15s linear infinite;
                        }
                        
                        .marquee span {
                        float: left;
                        width: 38%;
                        }
                        
                        @keyframes marquee {
                        0% { left: 0; }
                        100% { left: -200%; }
                        }
                </style>
            @else
                @if (count($data_yang_ditampilkan) > 0)
                <div class="col-sm-6">
                    <h4 class="m-0">Informasi</h4>
                </div>
                <div class="px-0 bg-gradient-teal">
                    <div class="marquee">
                        <div>
                            @foreach ($data_yang_ditampilkan as $item)
                                <span>{{$item}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <style>
                        .marquee {
                        height: 35px;
                        width: 100%;
                        
                        overflow: hidden;
                        position: relative;
                        padding: 8px 0 8px 0;
                        }
                        
                        .marquee div {
                        display: inline-block;
                        width: 300%;
                        height: 40px;
                        
                        position: absolute;
                        overflow: hidden;
                        
                        animation: marquee 15s linear infinite;
                        }
                        
                        .marquee span {
                        float: left;
                        width: 38%;
                        }
                        
                        @keyframes marquee {
                        0% { left: 0; }
                        100% { left: -200%; }
                        }
                </style>

                @endif
            @endif
    @endif

</div>
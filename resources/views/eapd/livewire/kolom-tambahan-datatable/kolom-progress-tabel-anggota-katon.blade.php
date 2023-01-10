<div>
    <a onclick="modal('modal-kolom-progress-tabel-anggota-katon',['{{$id_pegawai}}','{{$periode}}'],'panggilModalKolomProgress')"
        style="cursor: pointer;">
        <div class="my-2">
            <div class="row">
                <div class="col">
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width:{{ ($max != 0)? (($valueInput/$max)*100) : 0}}%" aria-valuenow="{{$valueInput}}"
                            aria-valuemax="{{$max}}" aria-valuemin="{{$min}}"></div>
                    </div>
                </div>

                <div class="col d-none d-sm-block">
                    <span class="badge badge-sm bg-success">{{ ($max != 0)? round(($valueInput/$max)*100,2) : 0}}%</span>
                </div>
            </div>
            <div class="row mt-n4 pt-2">
                <div class="col colspan-2">
                    <small>Terinput {{$valueInput}} dari {{$max}} item</small>
                </div>

            </div>
        </div>

    </a>
    <a onclick="modal('modal-kolom-progress-tabel-anggota-katon','')" style="cursor: pointer;">
        <div class="my-2">
            <div class="row">
                <div class="col">
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" style="width:{{ ($max != 0)? (($valueValid/$max)*100) : 0}}%"
                            aria-valuenow="{{$valueValid}}" aria-valuemax="{{$max}}" aria-valuemin="{{$min}}"></div>
                    </div>
                </div>

                <div class="col d-none d-sm-block">
                    <span class="badge badge-sm bg-info">{{ ($max != 0)? round(($valueValid/$max)*100,2) : 0}}%</span>
                </div>
            </div>
            <div class="row mt-n4 pt-2">
                <div class="col colspan-2">
                    <small>Tervalidasi {{$valueValid}} dari {{$max}} item</small>
                </div>

            </div>
        </div>
    </a>
</div>
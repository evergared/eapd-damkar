<div class="container">
    <h4>Capaian Inputan {{ auth()->user()->data->penempatan->nama_penempatan }}</h4>
        <div class="progress progress-sm">
            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="{{$maks_inputan}}" style="width: {{ ($value_inputan > 0 && $maks_inputan >0)? round(($value_inputan/$maks_inputan)*100,2) : 0}}%">
            </div>
        </div>
        <small>
            {{ ($value_inputan > 0 && $maks_inputan >0)? 'Terinput '.round(($value_inputan/$maks_inputan)*100,2).'%' : 'Belum ada data yang terinput'}}
        </small><br><br><br>
    <h4>Capaian Validasi {{ auth()->user()->data->penempatan->nama_penempatan }}</h4>
        <div class="progress progress-sm">
            <div class="progress-bar bg-info progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="{{$maks_inputan}}" style="width: {{ ($value_tervalidasi > 0 && $maks_inputan >0)? round(($value_tervalidasi/$maks_inputan)*100,2) : 0}}%">
            </div>
        </div>
        <small>
            {{ ($value_tervalidasi > 0 && $maks_inputan >0)? 'Terinput '.round(($value_tervalidasi/$maks_inputan)*100,2).'%' : 'Belum ada data yang tervalidasi'}}
        </small>
</div>
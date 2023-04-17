<div>
    {{-- Status loading Start --}}
    <div wire:loading>
        <div class="spinner-border spinner-border-sm" role="status"></div>
        <small> Memuat data inputan...</small>
    </div>
    {{-- Status loading End --}}

    {{-- start generate provinsi --}}
    <div id="provinsi-0">
        <h3 class="my-3">Capaian Input APD Damkar DKI Jakarta</h3>

        <div class="accordion" role="tablist" aria-multiselectable="true" id="provinsi-0-tablist">
            {{-- start generate sudin --}}
            @forelse($data_capaian["DKI Jakarta"] as $nama_sudin => $sudin)
                <div class="card">
                    <div class="card-header bg-info" role="tab">
                        {{-- untuk trigger collapse sudin --}}
                        <a class="btn btn-link btn-block text-left" 
                        type="button" 
                        data-toggle="collapse" 
                        aria-expanded="true" data-target="#provinsi-0-sudin-{{preg_replace('/\s+/', '_', $nama_sudin)}}-tabpanel">
                            {{$nama_sudin}}
                        </a>
                    </div>
                    {{-- collapse sudin --}}
                    <div class="collapse" role="tabpanel" id="provinsi-0-sudin-{{preg_replace('/\s+/', '_', $nama_sudin)}}-tabpanel">
                        <div class="card-body">
                            <div class="accordion" role="tablist" aria-multiselectable="true" id="provinsi-0-sudin-{{preg_replace('/\s+/', '_', $nama_sudin)}}-tablist">
                            {{-- start generate sektor --}}
                            @forelse ($sudin["sektor"] as $nama_sektor => $sektor)
                                <div class="card">
                                    <div class="card-header bg-secondary" role="tab">
                                        <div class="card-tools d-block d-sm-none">
                                            {{-- <span class="badge badge-success">{{($sektor["value_inputan"] > 0 && $sektor["value_max"] > 0) ? round(($sektor["value_inputan"]/$sektor["value_max"])*100) : "0"}}%</span> --}}
                                            {{-- <span class="badge badge-info">{{($sektor["value_validasi"] > 0 && $sektor["value_max"] > 0) ? round(($sektor["value_validasi"]/$sektor["value_max"])*100) : "0"}}%</span> --}}
                                        </div>
                                        <div class="card-title">
                                            {{-- untuk trigger collapse sektor --}}
                                            <a class="btn btn-link btn-block text-left text-white" 
                                            data-toggle="collapse" 
                                            data-parent="#provinsi-0-sudin-{{preg_replace('/\s+/', '_', $nama_sudin)}}-tablist" 
                                            aria-expanded="true" 
                                            data-target="#provinsi-0-sudin-{{preg_replace('/\s+/', '_', $nama_sudin)}}-sektor-{{preg_replace('/\s+/', '_', $nama_sektor)}}-tabpanel">
                                                {{$nama_sektor}}
                                            </a>
                                        </div>
                                        <div class="card-tools d-none d-sm-block">
                                                {{-- <div class="row my-n2" id="input-1"><small>Terinput : </small><span class="ml-1 badge text-center badge-success">{{($sektor["value_inputan"] > 0 && $sektor["value_max"] > 0) ? round(($sektor["value_inputan"]/$sektor["value_max"])*100) : "0"}}%</span></div> --}}
                                                {{-- <div class="row my-n2" id="verif-1"><small>Terverifikasi : </small><span class="ml-1 badge text-center badge-info">{{($sektor["value_validasi"] > 0 && $sektor["value_max"] > 0) ? round(($sektor["value_validasi"]/$sektor["value_max"])*100) : "0"}}%</span> </div> --}}
                                        </div>
                                    </div>
                                    {{-- collapse sektor --}}
                                    <div class="collapse" role="tabpanel" id="provinsi-0-sudin-{{preg_replace('/\s+/', '_', $nama_sudin)}}-sektor-{{preg_replace('/\s+/', '_', $nama_sektor)}}-tabpanel">
                                        <div class="card-body">
                                            <div class="accordion" role="tablist" aria-multiselectable="true" id="provinsi-0-sudin-{{preg_replace('/\s+/', '_', $nama_sudin)}}-sektor-{{preg_replace('/\s+/', '_', $nama_sektor)}}-tablist">
                                                {{-- start generate pos --}}
                                                @if (is_array($sektor))
                                                    @forelse ($sektor["pos"] as $nama_pos => $pos)
                                                        <div class="card">
                                                            <div class="card-header" role="tab">
                                                                <div class="card-tools d-block d-sm-none">
                                                                    <span class="badge badge-success">{{($pos["value_inputan"] > 0 && $pos["value_max"] > 0) ? round(($pos["value_inputan"]/$pos["value_max"])*100) : "0"}}%</span>
                                                                    <span class="badge badge-info">{{($pos["value_validasi"] > 0 && $pos["value_max"] > 0) ? round(($pos["value_validasi"]/$pos["value_max"])*100) : "0"}}%</span>
                                                                </div>
                                                                <div class="card-title">
                                                                    {{-- untuk trigger collapse pos --}}
                                                                    <a class="btn btn-link btn-block text-left" 
                                                                    data-toggle="collapse" 
                                                                    data-parent="#provinsi-0-sudin-{{preg_replace('/\s+/', '_', $nama_sudin)}}-sektor-{{preg_replace('/\s+/', '_', $nama_sektor)}}-tablist" 
                                                                    aria-expanded="true" 
                                                                    data-target="#provinsi-0-sudin-{{preg_replace('/\s+/', '_', $nama_sudin)}}-sektor-{{preg_replace('/\s+/', '_', $nama_sektor)}}-pos-{{preg_replace('/\s+/', '_', $nama_pos)}}-tabpanel">
                                                                        {{$nama_pos}}
                                                                    </a>
                                                                </div>
                                                                <div class="card-tools d-none d-sm-block">
                                                                    <div class="row my-n2" id="input-1"><small>Terinput : </small><span class="ml-1 badge text-center badge-success">{{($pos["value_inputan"] > 0 && $pos["value_max"] > 0) ? round(($pos["value_inputan"]/$pos["value_max"])*100) : "0"}}%</span></div>
                                                                    <div class="row my-n2" id="verif-1"><small>Terverifikasi : </small><span class="ml-1 badge text-center badge-info">{{($pos["value_validasi"] > 0 && $pos["value_max"] > 0) ? round(($pos["value_validasi"]/$pos["value_max"])*100) : "0"}}%</span> </div>
                                                                </div>
                                                            </div>
                                                            {{-- collapse pos --}}
                                                            <div class="collapse" role="tabpanel" id="provinsi-0-sudin-{{preg_replace('/\s+/', '_', $nama_sudin)}}-sektor-{{preg_replace('/\s+/', '_', $nama_sektor)}}-pos-{{preg_replace('/\s+/', '_', $nama_pos)}}-tabpanel">
                                                                <div class="card-body">
                                                                    Terinput : <div class="progress my-1"><div class="progress-bar bg-success" aria-valuenow="50" aria-valuemax="100" aria-valuemin="0">50%</div></div>
                                                                    Tervalidasi : <div class="progress my-1"><div class="progress-bar bg-info" aria-valuenow="50" aria-valuemax="100" aria-valuemin="0">20%</div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="jumbotron text-center">
                                                            Tidak ada yang dapat ditampilkan.
                                                        </div>
                                                    @endforelse
                                                @endif
                                                
                                                {{-- end generate pos --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="jumbotron text-center">
                                    Tidak ada data yang dapat ditampilkan.
                                </div>
                            @endforelse
                            {{-- end generate sektor --}}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="jumbotron text-center">
                        Tidak ada data yang dapat ditampilkan.
                </div>
            @endforelse
            {{-- end generate sudin --}}
            
        </div>
    </div>
    {{-- end generate provinsi --}}



</div>

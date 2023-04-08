<div>
    {{-- Status loading Start --}}
    <div wire:loading>
        <div class="spinner-border spinner-border-sm" role="status"></div>
        <small> Memuat data inputan...</small>
    </div>
    {{-- Status loading End --}}

    {{-- start generate provinsi --}}
    <div>
        <h3>Capaian Input APD Damkar DKI Jakarta</h3>

        <div class="accordion" role="tablist" aria-multiselectable="true" id="dki">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-parent="#dki" aria-expanded="true" data-target="#dki-1">Sudin Jakarta Pusat</a>
                </div>
            
                <div class="collapse show" role="tabpanel" id="dki-1">
                    <div class="card-body">

                            <div class="accordion" role="tablist" aria-multiselectable="true" id="dki-1-parent-sektor">
                                {{-- start generate sektor --}}
                                <div class="card">
                                    <div class="card-header" role="tab" id="dki-1-child-sektor-1-tab">
                                        <div class="card-title">
                                            <a class="btn btn-link btn-block text-left" data-toggle="collapse" data-parent="#dki-1-parent-sektor" aria-expanded="true" aria-controls="#dki-1-child-sektor-1-tabpanel">
                                                Sektor I Tanah Abang
                                            </a>
                                        </div>
                                        <div class="card-tools text-black">
                                            <div class="text-right d-none d-sm-block">
                                                <div class="row">Terinput : <div class="progress" ><div class="progress-bar" role="progressbar" style="width:20%" aria-valuenow="20" aria-valuemax="100" aria-valuemin="0"></div></div></div>
                                                <div class="row">Terverifikasi : <div class="progress" ><div class="progress-bar" role="progressbar" style="width:20%" aria-valuenow="20" aria-valuemax="100" aria-valuemin="0"></div></div></div>
                                            </div>
                                            <div class="text-justify d-block d-sm-none">
                                                <span class="badge badge-success">100%</span>
                                                <span class="badge badge-info">100%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" id="dki-1-child-sektor-1-tabpanel" role="tabpanel" aria-labelledby="#dki-1-child-sektor-1-tab">
                                        isinya list sektor
                                    </div>
                                </div>
                                {{-- end generate sektor --}}
                            </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end generate provinsi --}}
</div>

<div>
    <div class="card">           
        <div class="card-header">
        <div class="row flex">
            <div class="col-sm-6">
            <h5>Jenis :</h5>
            <h5>{{$nama_jenis_detail}}</h5>
            </div>
            <div class="col-sm-6 text-right">
            <button class="btn-primary btn-sm" onclick="backToRekapitulasi()">
                <i class="fas fa-arrow-left"></i>
            </button>
            
            </div>
        </div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
            </button>
        </div>
        </div>
        <div class="card-body">
            <livewire:dashboards.admin.periode-berjalan.apd.tabel-detail-rekap>
        </div>
    </div>
</div>

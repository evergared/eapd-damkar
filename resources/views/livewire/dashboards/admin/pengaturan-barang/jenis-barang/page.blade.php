<div>
    <section class="content">
        <div class="container-fluid">
            <div class="collapse show active" id="tabel-jenis">
                <div class="card">
                    <div class="card-header">
                        <h4>Tabel List Jenis Barang APD</h4>
                    </div>
                    <div class="card-body">
                        <div class="row my-2">
                            <button class="btn btn-md btn-default" wire:click='$emit("buatJenis")' onclick="tabelKeForm()">Buat Jenis APD Baru</button>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <livewire:dashboards.admin.pengaturan-barang.jenis-barang.tabel-jenis-barang>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="collapse" id="form-jenis">
                <livewire:dashboards.admin.pengaturan-barang.jenis-barang.form-jenis-barang>
            </div>
        </div>
        
    </section>

    @push('stack-body')
        <script type="module">
            function tabelKeForm()
            {
                $("#tabel-jenis").hide(500);
                $('#form-jenis').collapse('show')
            }

            function formKeTabel()
            {
                $('#form-jenis').collapse('hide');
                $("#tabel-jenis").show(500);
            }
        </script>
    @endpush

</div>

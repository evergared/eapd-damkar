<div>
    @include('komponen.breadcrumbs',[ 'halamanJudul'=>'APDku','halaman'=>'apdku'])
    <livewire:komponen.marquee>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs mb-2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab-list-permintaan" data-toggle='pill' role="tab" aria-controls="tab-list-permintaan" wire:ignore.self>
                                Permintaan Anda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab-form" data-toggle='pill' role="tab" aria-controls="tab-form" wire:ignore.self>
                                Form Pergantian Barang
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-list-permintaan" wire:ignore.self>
                            <div class="jumbotron text-center">
                                Tidak ada data yang dapat ditampilkan.
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-form" wire:ignore.self>
                            <livewire:dashboards.pegawai.bantuan-barang.ganti-barang.form-ganti-barang>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

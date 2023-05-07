<div>
    <section class="d-flex justify-content-center row connectedSortable ui-sortable">

        {{-- Start card-kendali-utama --}}
        <div class="card" id="card-kendali-utama">
            <div class="card-header">
                {{-- navigasi kendali utama --}}
                <ul class="nav nav-tabs" id="card-kendali-utama-tablist" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pengaturan-jenis-tab" data-toggle="tab" data-target="#pengaturan-jenis-tabpanel" type="button" role="tab" aria-controls="pengaturan-jenis-tabpanel" aria-selected="true">Jenis</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pengaturan-barang-tab" data-toggle="tab" data-target="#pengaturan-barang-tabpanel" type="button" role="tab" aria-controls="pengaturan-barang-tabpanel" aria-selected="false">Barang</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pengaturan-ukuran-tab" data-toggle="tab" data-target="#pengaturan-ukuran-tabpanel" type="button" role="tab" aria-controls="pengaturan-ukuran-tabpanel" aria-selected="false">Ukuran</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pengaturan-kerusakan-tab" data-toggle="tab" data-target="#pengaturan-kerusakan-tabpanel" type="button" role="tab" aria-controls="pengaturan-kerusakan-tabpanel" aria-selected="false">Ukuran</button>
                    </li>                     
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="card-kendali-utama-tablist-content">
                    {{-- start pengaturan jenis --}}
                    <div class="tab pane fade show active" id="pengaturan-jenis-tabpanel" role="tabpanel" aria-labelledby="#pengaturan-jenis-tab">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan Jenis APD</h3>
                            </div>
                            <div class="card-body">

                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                    {{-- end pengaturan jenis --}}

                    {{-- start pengaturan barang --}}
                    <div class="tab pane fade" id="pengaturan-barang-tabpanel" role="tabpanel" aria-labelledby="#pengaturan-barang-tab">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan APD</h3>
                            </div>
                            <div class="card-body">

                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                    {{-- end pengaturan barang --}}

                    {{-- start pengaturan ukuran --}}
                    <div class="tab pane fade" id="pengaturan-ukuran-tabpanel" role="tabpanel" aria-labelledby="#pengaturan-ukuran-tab">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan Opsi Ukuran APD</h3>
                            </div>
                            <div class="card-body">

                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                    {{-- end pengaturan ukuran --}}

                    {{-- start pengaturan kerusakan --}}
                    <div class="tab pane fade" id="pengaturan-kerusakan-tabpanel" role="tabpanel" aria-labelledby="#pengaturan-kerusakan-tab">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan Opsi Kerusakan APD</h3>
                            </div>
                            <div class="card-body">

                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                    {{-- end pengaturan kerusakan --}}

                </div>
            </div>
        </div>
        {{-- end card-kendali-utama --}}

    </section>
</div>

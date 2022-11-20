@extends('eapd.layouts.adminlte-dashboard',['title'=>'Dashboard Pegawai'])

@section('content')


@include('eapd.dashboard.komponen.breadcrumbs',[ 'halamanJudul'=>'APDku','halaman'=>'apdku'])
@include('eapd.dashboard.komponen.marquee-informasi')

<section class="content">
    <div class="container-fluid">
        @include('eapd.dashboard.komponen.statbox')
        <div class="row">
            <!-- Left col -->
            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4 class="card-title">List APD</h4>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="filter-container p-0 row">
                                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <!-- KONDISI RIBON
                                          -Baik
                                          -Ringan
                                          -Rusak -->
                                                        <div class="ribbon bg-danger">
                                                            Rusak
                                                        </div>
                                                    </div>
                                                    <!--  KONDISI PROSES
                                        -Proses Input
                                        -Validasi
                                        -tervalidasi
                                        -tertolak
                                        -update -->
                                                    <img src="/dist/img/image/fire-gloves.jpg"
                                                        class="img-fluid mb-2 h-75 w-100" alt="white sample"><span
                                                        class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-gradient-green">
                                                            Baik
                                                        </div>
                                                    </div>
                                                    <img src="/dist/img/image/fire-jumsuit.jpg"
                                                        class="img-fluid mb-2 h-75 w-100" alt="white sample"><span
                                                        class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-gradient-green">
                                                            Baik
                                                        </div>
                                                    </div>
                                                    <img src="/dist/img/image/firejacket.jpg"
                                                        class="img-fluid mb-2 h-75 w-100" alt="white sample"><span
                                                        class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                                <a href="#modal-lg" data-toggle="modal" data-target="#modal-lg"
                                                    data-title="Fire Boots">
                                                    <div class="ribbon-wrapper">
                                                        <div class="ribbon bg-warning">
                                                            Ringan
                                                        </div>
                                                    </div>
                                                    <img src="/dist/img/image/rescue-boots-pyros.jpg"
                                                        class="img-fluid mb-2 h-75 w-100" alt="white sample"><span
                                                        class="bg-secondary color-palette h6">Proses Input</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->



                <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Fire Boots</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <h3 class="d-inline-block d-sm-none"></h3>
                                        <div class="col-12">
                                            <img src="/dist/img/prod-1.jpg" class="product-image" alt="Product Image">
                                        </div>
                                        <div class="col-12 product-image-thumbs">
                                            <div class="product-image-thumb active"><img src="/dist/img/prod-1.jpg"
                                                    alt="Product Image"></div>
                                            <div class="product-image-thumb"><img src="/dist/img/prod-2.jpg"
                                                    alt="Product Image"></div>
                                            <div class="product-image-thumb"><img src="/dist/img/prod-3.jpg"
                                                    alt="Product Image"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <h3 class="my-3">Fire Boots <span class="bg-secondary color-palette h6">Proses
                                                Input</span></h3>
                                        <span class="bg-gradient-danger color-palette h6">Keterangan Admin
                                            Tertolak</span>
                                        <p></p>
                                        <div class="form-group">
                                            <label>Model</label>
                                            <select class="form-control">
                                                <option>Comfy</option>
                                                <option>Magnum</option>
                                            </select>
                                        </div>
                                        <p></p>
                                        <p></p>
                                        <div class="form-group">
                                            <label>Ukuran</label>
                                            <select class="form-control">
                                                <option>35</option>
                                                <option>36</option>
                                                <option>37</option>
                                                <option>38</option>
                                                <option>39</option>
                                                <option>40</option>
                                                <option>41</option>
                                                <option>42</option>
                                                <option>43</option>
                                                <option>44</option>
                                                <option>45</option>
                                            </select>
                                        </div>
                                        <p></p>

                                        <p></p>
                                        <div class="form-group">
                                            <label>Kondisi</label>
                                            <select class="form-control">
                                                <option>Baik</option>
                                                <option>Rusak Ringan</option>
                                                <option>Rusak Berat</option>
                                            </select>
                                        </div>
                                        <p></p>

                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="modal-footer">
                                <div class="btn btn-primary btn-m btn-flat rounded-pill">
                                    <i class="fas fa-save fa-lg mr-2"></i>
                                    Simpan
                                </div>
                                <div class="btn btn-secondary btn-m btn-flat rounded-pill">
                                    <i class="fas fa-image fa-lg mr-2"></i>
                                    Upload Gambar
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>



            </section>
            <!-- right col -->
        </div>
    </div>
</section>
@endsection
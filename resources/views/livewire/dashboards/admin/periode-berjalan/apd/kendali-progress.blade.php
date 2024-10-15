<div>
    <h4>Periode Berjalan : {{$nama_periode_berjalan}}</h4>  
    <div class="row">
        @if ($error_time_page)
        <div>
            <strong class="text-danger">Terjadi kesalahan saat inisiasi halaman. Silahkan refresh atau hubungin admin. ref : {{$error_time_page}}</strong>
        </div>
        @endif
        @if ($tampil_dropdown_wilayah)
            <div class="col">
                <div class="form-group">
                    <label>Wilayah</label>
                    <select class="form-control" id="wilayah" wire:model='model_dropdown_wilayah' wire:change='changeDropdownWilayah' >
                    <option value="" disabled>Silahkan Pilih</option>
                    @if ($opsi_dropdown_wilayah)
                        @foreach ($opsi_dropdown_wilayah as $item)
                            <option value="{{$item['value']}}">{{$item['text']}}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
            </div>
        @endif
        
            <div class="col" @if (!$tampil_dropdown_penempatan) style="visibility: hidden" @endif>
                <div class="form-group">
                    <label>Penempatan</label>
                    <select class="form-control" id="wilayah" wire:model='model_dropdown_penempatan' wire:change='changeDropdownPenempatan'>
                        <option value="" disabled>Silahkan Pilih</option>
                        @if ($opsi_dropdown_penempatan)
                            @foreach ($opsi_dropdown_penempatan as $item)
                                <option value="{{$item['value']}}">{{$item['text']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        
        
    </div>

    <div class="row" wire:loading='hitungCapaian'>
        <div class="spinner-border text-info" role="status" >
            <span class="sr-only">Memuat...</span>
        </div><span class="mx-2 text-info">Memuat data dari server . . .</span>
    </div>

    @if ($model_dropdown_penempatan || $model_dropdown_wilayah == "semua")
        <div class="row">
            <h4>Rangkuman Inputan</h4>
        </div>
        {{-- rangkuman progress --}}
        <div class="row" id="progress-basic">
            <div class="jumbotron text-center">
                <strong id="progress-basic-text">Silahkan pilih penempatan terlebih dahulu</strong>
            </div>
        </div>
        <div class="row" id="progress-spinner" style="display:none;">
            <div class="spinner-grow text-info" role="status" >
                <span class="sr-only">Memuat...</span>
            </div><span class="mx-2 text-info" id="progress-spinner-text">Memuat Data ......</span>
        </div>
        <div class="row" id="progress-tampil" style="display:none;">
            <div class="col">
                <div class="form-group">
                    <label>Inputan </label>
                    <a href="#"><div class="progress progress-sm">
                    <div class="progress-bar bg-green" id="progress-bar-inputan" role="progressbar" aria-valuemin="0">
                    </div>
                    </div></a>
                    <small>
                        <span id="progress-bar-inputan-val"></span>% Tercapai
                    </small>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Validasi</label>
                    <a href="#"><div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" id="progress-bar-validasi" aria-valuemin="0">
                        </div>
                    </div></a>
                    <small>
                        <span id="progress-bar-validasi-val"></span>% Tercapai
                    </small>
                </div>
            </div>
        </div>
        {{-- Rangkuman Keberadaan --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="card-title">
                            Rangkuman Keberadaan APD
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row" id="keberadaan-basic" style="display : block;">
                            <div class="jumbotron text-center">
                                <strong id="keberadaan-basic-text">Silahkan pilih penempatan terlebih dahulu.</strong>
                            </div>
                        </div>
                        <div class="row" id="keberadaan-spinner" style="display:none;">
                            <div class="spinner-grow text-info" role="status" >
                                <span class="sr-only">Memuat...</span>
                            </div><span class="mx-2 text-info" id="keberadaan-spinner-text">Memuat Data ......</span>
                        </div>
                        <div class="row" id="keberadaan-tampil" style="display: none;">
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="fas fa-check-double"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Ada</span>
                                        <span class="info-box-number" id="keberadaan-val-ada"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning"><i class="fas fa-box-open"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Belum Dapat</span>
                                        <span class="info-box-number" id="keberadaan-val-belum"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-danger"><i class="fas fa-question-circle"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Hilang</span>
                                        <span class="info-box-number" id="keberadaan-val-hilang"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Rangkuman Kondisi APD --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="card-title">
                            Rangkuman Kondisi APD
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row" id="kondisi-basic" style="display : block;">
                            <div class="jumbotron text-center">
                                <strong id="kondisi-basic-text">Silahkan pilih penempatan terlebih dahulu.</strong>
                            </div>
                        </div>
                        <div class="row" id="kondisi-spinner" style="display:none;">
                            <div class="spinner-grow text-info" role="status" >
                                <span class="sr-only">Memuat...</span>
                            </div><span class="mx-2 text-info" id="kondisi-spinner-text">Memuat Data ......</span>
                        </div>
                        <div class="row" id="kondisi-tampil" style="display:none;">
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="fas fa-thumbs-up"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Baik</span>
                                        <span class="info-box-number" id="kondisi-val-baik"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-yellow"><i class="fas fa-feather-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Rusak Ringan</span>
                                        <span class="info-box-number" id="kondisi-val-rusak-ringan"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-orange"><i class="fas fa-battery-half"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Rusak Sedang</span>
                                        <span class="info-box-number" id="kondisi-val-rusak-sedang"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="info-box">
                                    <span class="info-box-icon bg-danger"><i class="fas fa-window-close"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Rusak Berat</span>
                                        <span class="info-box-number" id="kondisi-val-rusak-berat"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#by-anggota" data-toggle="tab">Sortir by Personil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#by-inputan" data-toggle="tab">Sortir by Inputan</a></li>
                    </ul>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($model_dropdown_penempatan || $model_dropdown_wilayah == "semua")
                        <div class="tab-content">
                            <div class="tab-pane active" id="by-anggota">
                                @if ($pegawai_terakhir)
                                    <i><small class="text-muted">Pegawai terakhir yang dilihat : <strong>{{$pegawai_terakhir}}</strong></small></i>
                                @endif
                                <div class="col-lg-12">
                                    <livewire:dashboards.admin.periode-berjalan.apd.tabel-terinput-by-personil>
                                </div>
                            </div>
                            <div class="tab-pane" id="by-inputan">
                                <livewire:dashboards.admin.periode-berjalan.apd.tabel-terinput-by-inputan>
                            </div>
                        </div>
                    @else
                        <div class="jumbotron text-center">
                            <h4>Harap pilih penempatan terlebih dahulu.</h4>
                        </div>
                    @endif
                    
                </div>
                <!-- /.card-body -->
          </div>
        </div>
    </div>
</div>

@push('stack-body')

{{-- 
    Untuk penghitungan rangkuman, memiliki 3 elemen yakni :
    - basic
    - spinner
    - tampil

    1. basic adalah komponen yang menampilkan text awal ketika user belum memilih penempatan dan menampilkan text ketika terjadi error
    saat terjadi penghitungan

    2. spinner adalah komponen yang menampilkan animasi loading saat penghitungan dilakukan

    3. tampil adalah komponen yang menampilkan data hasil penghitungan


    Jenis Rangkuman : 
    1. progress : untuk capaian inputan pegawai dan validasi yang di setujui oleh admin
    2. keberadaan : untuk status keberadaan apd yang dimiliki oleh pegawai
    3. kondisi : untuk kondisi apd yang dimiliki oleh pegawai
--}}

{{-- JS untuk penghitungan progress inputan pegawai --}}
    <script>
        let wProgress;

        function mulaiKalkulasiProgress(e){
            if(typeof(Worker) !== "undefined")
            {
                if(typeof(wProgress) != "undefined")
                {
                    wProgress.postMessage(e)

                    document.getElementById('progress-basic').style.display = "none"
                    document.getElementById('progress-spinner-text').innerHTML = "Kalkulasi.."
                    document.getElementById('progress-spinner').style.display = 'block'

                    wProgress.addEventListener("message", (e) => {
                        switch(e.data.status){
                            case 'process' : prosesKalkulasiProgress(e);break;
                            case 'fail' : gagalkanKalkulasiProgress(e);break;
                            case 'success' : terimaKalkulasiProgress(e);break;
                            default : break;
                        }
                    })
                }   
            }
            else
            {
                alert('Proses penghitungan kalkulasi gagal! Silahkan update browser anda ke versi terbaru')
            }
        }

        function stopKalkulasiProgress()
        {
            wProgress.terminate();
            wProgress = undefined;
        }

        function prosesKalkulasiProgress(e)
        {
            document.getElementById('progress-spinner-text').innerHTML = e.data.message
        }

        function gagalkanKalkulasiProgress(e)
        {

            document.getElementById('progress-basic-text').innerHTML = e.data.message
            document.getElementById('progress-spinner').style.display = "none";
            document.getElementById('progress-basic').style.display = "block";
            stopKalkulasi();
        }

        function terimaKalkulasiProgress(e)
        {
            let max_inputan = e.data.max_inputan;
            let curr_inputan = e.data.curr_inputan;
            let max_validasi = e.data.max_validasi;
            let curr_validasi = e.data.curr_validasi;

            let inputan_val = (max_inputan > 0 && curr_inputan > 0)? Math.round(Number(curr_inputan/max_inputan) * 100) : 0
            let validasi_val = (max_validasi > 0 && curr_validasi > 0)? Math.round(Number(curr_validasi/max_validasi) * 100) : 0


            document.getElementById('progress-bar-inputan').setAttribute('aria-valuemax',max_inputan)
            document.getElementById('progress-bar-inputan').setAttribute('aria-valuenow',curr_inputan)
            document.getElementById('progress-bar-inputan').style.width = inputan_val + "%"
            document.getElementById('progress-bar-inputan-val').innerHTML = inputan_val

            document.getElementById('progress-bar-validasi').setAttribute('aria-valuemax',max_validasi)
            document.getElementById('progress-bar-validasi').setAttribute('aria-valuenow',curr_validasi)
            document.getElementById('progress-bar-validasi').style.width = validasi_val + "%"
            document.getElementById('progress-bar-validasi-val').innerHTML = validasi_val

            document.getElementById('progress-spinner').style.display = "none";
            document.getElementById('progress-tampil').style.display = "";
            stopKalkulasiProgress()
        }
    </script>
    {{-- JS untuk penghitungan keberadaan apd pegawai --}}
    <script>
        let wKeberadaan;

        function mulaiKalkulasiKeberadaan(e){
            if(typeof(Worker) !== "undefined")
            {
                if(typeof(wKeberadaan) != "undefined")
                {
                    wKeberadaan.postMessage(e)

                    document.getElementById('keberadaan-basic').style.display = "none"
                    document.getElementById('keberadaan-spinner-text').innerHTML = "Kalkulasi.."
                    document.getElementById('keberadaan-spinner').style.display = 'block'

                    wKeberadaan.addEventListener("message", (e) => {
                        switch(e.data.status){
                            case 'process' : prosesKalkulasiKeberadaan(e);break;
                            case 'fail' : gagalkanKalkulasiKeberadaan(e);break;
                            case 'success' : terimaKalkulasiKeberadaan(e);break;
                            default : break;
                        }
                    })
                }   
            }
            else
            {
                alert('Proses penghitungan keberadaan apd gagal! Silahkan update browser anda ke versi terbaru')
            }
        }

        function stopKalkulasiKeberadaan()
        {
            wKeberadaan.terminate();
            wKeberadaan = undefined;
        }

        function prosesKalkulasiKeberadaan(e)
        {
            document.getElementById('keberadaan-spinner-text').innerHTML = e.data.message
        }

        function gagalkanKalkulasiKeberadaan(e)
        {

            document.getElementById('keberadaan-basic-text').innerHTML = e.data.message
            document.getElementById('keberadaan-spinner').style.display = "none";
            document.getElementById('keberadaan-basic').style.display = "block";
            stopKalkulasiKeberadaan();
        }

        function terimaKalkulasiKeberadaan(e)
        {

            let ada = e.data.ada;
            let belum = e.data.belum;
            let hilang = e.data.hilang;

            document.getElementById('keberadaan-val-ada').innerHTML = ada;
            document.getElementById('keberadaan-val-belum').innerHTML = belum;
            document.getElementById('keberadaan-val-hilang').innerHTML = hilang;
            

            document.getElementById('keberadaan-spinner').style.display = "none";
            document.getElementById('keberadaan-tampil').style.display = "";
            stopKalkulasiKeberadaan()
        }
    </script>

    {{-- JS untuk penghitungan Kondisi apd pegawai --}}
    <script>
        let wKondisi;

        function mulaiKalkulasiKondisi(e){
            if(typeof(Worker) !== "undefined")
            {
                if(typeof(wKondisi) != "undefined")
                {
                    wKondisi.postMessage(e)

                    document.getElementById('kondisi-basic').style.display = "none"
                    document.getElementById('kondisi-spinner-text').innerHTML = "Kalkulasi.."
                    document.getElementById('kondisi-spinner').style.display = 'block'

                    wKondisi.addEventListener("message", (e) => {
                        switch(e.data.status){
                            case 'process' : prosesKalkulasiKondisi(e);break;
                            case 'fail' : gagalkanKalkulasiKondisi(e);break;
                            case 'success' : terimaKalkulasiKondisi(e);break;
                            default : break;
                        }
                    })
                }   
            }
            else
            {
                alert('Proses penghitungan Kondisi apd gagal! Silahkan update browser anda ke versi terbaru')
            }
        }

        function stopKalkulasiKondisi()
        {
            wKondisi.terminate();
            wKondisi = undefined;
        }

        function prosesKalkulasiKondisi(e)
        {
            document.getElementById('kondisi-spinner-text').innerHTML = e.data.message
        }

        function gagalkanKalkulasiKondisi(e)
        {

            document.getElementById('kondisi-basic-text').innerHTML = e.data.message
            document.getElementById('kondisi-spinner').style.display = "none";
            document.getElementById('kondisi-basic').style.display = "block";
            stopKalkulasiKondisi();
        }

        function terimaKalkulasiKondisi(e)
        {

            let baik = e.data.baik;
            let rusak_ringan = e.data.rusak_ringan;
            let rusak_sedang = e.data.rusak_sedang;
            let rusak_berat = e.data.rusak_berat;

            document.getElementById('kondisi-val-baik').innerHTML = baik;
            document.getElementById('kondisi-val-rusak-ringan').innerHTML = rusak_ringan;
            document.getElementById('kondisi-val-rusak-sedang').innerHTML = rusak_sedang;
            document.getElementById('kondisi-val-rusak-berat').innerHTML = rusak_berat;
            

            document.getElementById('kondisi-spinner').style.display = "none";
            document.getElementById('kondisi-tampil').style.display = "";
            stopKalkulasiKondisi()
        }
    </script>

    <script>
        window.addEventListener('JSWorkerCall-progress',e => {
            var data = e.detail.data.original
            if(data.status)
            {
                    wProgress = new Worker("{{asset('worker/progress.js')}}");
                    mulaiKalkulasiProgress(data)
                    wKeberadaan = new Worker("{{asset('worker/keberadaan.js')}}");
                    mulaiKalkulasiKeberadaan(data)
                    wKondisi = new Worker("{{asset('worker/kondisi.js')}}");
                    mulaiKalkulasiKondisi(data)
                
            }
            else
            alert('Terjadi kesalahan saat kalkulasi data apd')
        })

        function showRangkumanKembali()
        {
            if(typeof(wProgress) != "undefined" )
            {
                document.getElementById('progress-basic').style.display = "none"
                document.getElementById('progress-spinner').style.display = 'block'
            }

            if(typeof(wKeberadaan) != "undefined" )
            {
                document.getElementById('keberadaan-basic').style.display = "none"
                document.getElementById('keberadaan-spinner').style.display = 'block'
            }
            

            if(typeof(wKondisi) != "undefined" )
            {
                document.getElementById('kondisi-basic').style.display = "none"
                document.getElementById('kondisi-spinner').style.display = 'block'
            }
                
        }
    </script>
@endpush

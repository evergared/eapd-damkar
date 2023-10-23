<div>
    @include('komponen.breadcrumbs',[ 'halamanJudul'=>'Inputan Saat Ini','halaman'=>'admin-progress-apd'])
    <livewire:komponen.marquee>

    <section class="content">
        <div class="container-fluid">
            <div class="collapse active show" id="kendali" wire:ignore.self>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#progres" data-toggle="tab">Progress</a></li>
                            <li class="nav-item"><a class="nav-link" href="#rekapitulasi" data-toggle="tab">Rekapitulasi</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="progres" wire:ignore.self>
                                <livewire:dashboards.admin.periode-berjalan.apd.kendali-progress>
                            </div>
                            <div class="tab-pane" id="rekapitulasi" wire:ignore.self>
                                <h3>Periode TW</h3>
                                <div class="table-responsive p-0" style="height: 1000px;">
                                    <table class="table text-nowrap">
                                        <thead class="text-center table-bordered" style="background-color: gray ;">
                                            <tr >
                                                <th rowspan="2" style="vertical-align:middle; background-color: gray ;">#</th>
                                                <th style="width:20%; vertical-align:middle; background-color: gray ;" rowspan="2" >Jenis APD</th>
                                                <th style="width:50%; background-color: gray ;" class="text-center" colspan="4">Kondisi</th>
                                                <th style="width:20%; background-color: gray ;" colspan="3">Keberadaan</th>
                                                <th style="width:10%; vertical-align:middle; background-color: gray ;" rowspan="2">SubTotal</th>
                                                <th style="width:10%; vertical-align:middle; background-color: gray ;" rowspan="2">Distribusi</th>
                                            </tr>
                                            <tr class="table-head-fixed">
                                                <th>Baik</th>
                                                <th>Rusak Ringan</th>
                                                <th>Rusak Sedang</th>
                                                <th>Rusak Berat</th>
                                                <th>Belum Terima</th>
                                                <th>Hilang</th>
                                                <th>Diterima</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                <td class="text-center text-wrap my-auto align-middle">1</td>
                                                <td class="text-center text-wrap my-auto align-middle">Fire Jacket
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a onclick="detailRekapitulasi()" href="#rekap-tabel">8</a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a onclick="#" href="#rekap-tabel">5</a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a onclick="#" href="#rekap-tabel">6</a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a onclick="#" href="#rekap-tabel">4</a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a onclick="#" href="#rekap-tabel">2</a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a onclick="#" href="#rekap-tabel">5</a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a onclick="#" href="#rekap-tabel">6</a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a onclick="#" href="#rekap-tabel">2</a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a onclick="#" href="#rekap-tabel">2</a>
                                                </td>
                                            </tr>
                                            
                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            {{-- start detail progress untuk sortir By Personil --}}
            <div class="collapse" id="detail-progress" wire:ignore.self>
                <livewire:dashboards.admin.periode-berjalan.apd.detail-progress>
            </div>
            {{-- end detail progress untuk sortir By Personil --}}
            
            {{-- detail rekapitulasi --}}
            <div class="collapse" id="detail-rekapitulasi">
            <div class="card">           
                <div class="card-header">
                <div class="row flex">
                    <div class="col-sm-6">
                    <h5>Jenis :</h5>
                    <h5>Fire Jacket</h5>
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
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th>
                            APD
                            </th>
                            <th>
                                Nama
                            </th>
                            <th>
                                Nrk
                            </th>
                            <th>
                            Wilayah
                            </th>
                            <th>
                            Penempatan
                            </th>
                            <th>
                            Sub
                            </th>
                            <th style="width: 30%" class=" text-center">
                                Foto
                            </th>
                            
                            <th class="text-center">
                                Status
                            </th>
                            
                            <th class="text-center">
                                Validasi
                            </th>
                            <th >
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                1
                            </td>
                            <td>
                                <a>
                                    Spider Gear
                                </a>
                                <br/>
                                <small>
                                    L
                                </small>
                            </td>
                            <td>
                                Indra Purwoko
                            </td>
                            <td>
                                1235235
                            </td>
                            <td>
                                Sudin Selatan
                            </td>
                            <td>
                                Kantor Sudin
                            </td>
                            <td>
                                Tata Usaha
                            </td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item w-25">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2" alt="white sample"/>
                                        </a>
                                    </li>
                                    <li class="list-inline-item w-25">
                                        <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample"/>
                                        </a>
                                    </li>
                                    <li class="list-inline-item w-25">
                                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3" data-toggle="lightbox" data-title="sample 3 - red" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3" class="img-fluid mb-2" alt="red sample"/>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                            <td class="project-state text-center">
                                <span class="badge badge-success">Terima</span><br>
                                <span class="badge badge-success">Baik</span>
                            </td>
                            <td class="project-state text-center">
                                <span class="badge badge-success">Validasi</span><br>
                                <span class="badge badge-success">Sukur Sarwono</span>
                            </td>
                            <td class="project-actions text-right text-center">
                                <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#modal-edit">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            </div>

        </div>


       


    </section>

    

    
    
    
    {{-- rekapitulasi --}}
    
    
    <livewire:dashboards.admin.periode-berjalan.apd.modal-kolom-profil>
    
    @push('stack-body')
    <script>

        window.addEventListener('jsAlert', event=>{
                alert(event.detail.pesan);
            })
    
        window.addEventListener('progress-kendali-ke-detail', event=>{
                $("#kendali").hide(500)
                $("#detail-progress").collapse('show')
            })
      
        function detailProgressKeKendali(){
          $("#kendali").show(500)
          $("#detail-progress").collapse('hide')
        }

        window.addEventListener('list-inputan-ke-detail-inputan', event=>{
                $("#list-inputan").hide(500)
                $("#detail-inputan").collapse('show')
            })
        
        function listInputanKeDetailInputan()
        {
            $("#list-inputan").show(500)
                $("#detail-inputan").collapse('hide')
        }
      
        function detailRekapitulasi(Id,Filter){
          console.log("Id",Id)
          $("#kendali").hide(500)
          $("#detail-rekapitulasi").collapse('show')
        }
      
        function backToRekapitulasi(){
          $("#kendali").show(500)
          $("#detail-rekapitulasi").collapse('hide')
        }
      
        $(function () {
          $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
              alwaysShowClose: true
            });
          });
      
          $('.filter-container').filterizr({gutterPixels: 3});
          $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
          });
        })
      </script>
      <script src="{{ asset('admin-lte/ekko-lightbox.min.js')}}"></script>
    @endpush
    
    
    
</div>

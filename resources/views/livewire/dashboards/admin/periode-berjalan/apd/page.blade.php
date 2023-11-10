<div>
    @include('komponen.breadcrumbs',[ 'halamanJudul'=>'Inputan Saat Ini','halaman'=>'admin-progress-apd'])
    <livewire:komponen.marquee>

    <section class="content">
        <div class="container-fluid">
            <div class="collapse active show" id="kendali" wire:ignore.self>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#progres" data-toggle="tab" wire:ignore.self>Progress</a></li>
                            <li class="nav-item"><a class="nav-link" href="#rekapitulasi" data-toggle="tab" wire:ignore.self>Rekapitulasi</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="progres" wire:ignore.self>
                                <livewire:dashboards.admin.periode-berjalan.apd.kendali-progress>
                            </div>
                            <div class="tab-pane" id="rekapitulasi" wire:ignore.self>
                                <livewire:dashboards.admin.periode-berjalan.apd.kendali-rekapitulasi>
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
            <div class="collapse" id="detail-rekapitulasi" wire:ignore.self>
                <livewire:dashboards.admin.periode-berjalan.apd.detail-rekapitulasi>
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

                window.addEventListener('list-inputan-ke-detail-inputan', event=>{
                    console.log('test');
                        $("#list-inputan").hide(500)
                        $("#detail-inputan").collapse('show')
                })
      
        function detailProgressKeKendali(){
          $("#kendali").show(500)
          $("#detail-progress").collapse('hide')
        }

        window.addEventListener('rekap-kendali-ke-detail', event=>{
                $("#kendali").hide(500)
                $("#detail-rekapitulasi").collapse('show')
            })
        
        function detailInputanKeListInputan()
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
    
    <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
    <script>
        
        window.addEventListener('jsToast', event=>{
            $(document).Toasts('create', {
            class: event.detail.class,
            title: event.detail.title,
            subtitle: event.detail.subtitle,
            body: event.detail.body
            })
        })
        
    </script>
    
</div>


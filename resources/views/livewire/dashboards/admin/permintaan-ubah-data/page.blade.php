<div>
    @include('komponen.breadcrumbs',[ 'halamanJudul'=>'Permintaan Ubah Data Terverifikasi','halaman'=>'admin-ubah-data-terverifikasi'])
    <livewire:komponen.marquee>

    <section class="content">
        <div class="container-fluid">
            <div class="collapse active show" id="list-permintaan" wire:ignore.self>
                <div class="card card-primary">
                    <div class="card-header">
                       <h5>List Permintaan Ubah Data Pada Periode Ini</h5>
                    </div>
                    <div class="card-body">
                        @if (!is_null($id_periode))
                            <livewire:dashboards.admin.permintaan-ubah-data.tabel-list-permintaan>
                            
                        @else
                            <div class="jumbotron text-center">
                                Tidak ada yang dapat ditampilkan.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            

            {{-- start detail permintaan untuk sortir By Personil --}}
            <div class="collapse" id="detail-permintaan" wire:ignore.self>
                <livewire:dashboards.admin.permintaan-ubah-data.detail-permintaan>
            </div>
            {{-- end detail permintaan untuk sortir By Personil --}}
            
           <livewire:dashboards.admin.permintaan-ubah-data.modal-kolom-pegawai>

        </div>


        @push('stack-body')
        <script src="{{ asset('admin-lte/ekko-lightbox.min.js')}}"></script>
            <script>

          $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
              alwaysShowClose: true
            });
          });

                window.addEventListener('jsAlert', event=>{
                alert(event.detail.pesan);
            })
    
            window.addEventListener('list-ke-detail', event=>{
                    $("#list-permintaan").hide(500)
                    $("#detail-permintaan").collapse('show')
                })

                window.addEventListener('detail-ke-list', event=>{
                    $("#list-permintaan").show(500)
                    $("#detail-permintaan").collapse('hide')
                })
            </script>
        @endpush


    </section>
</div>

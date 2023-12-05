<div>
    @include('komponen.breadcrumbs',[ 'halamanJudul'=>'Pengaturan User','halaman'=>'admin-pengaturan-user'])

    <section class="content">
        <div class="container-fluid">
            <div class="collapse active show" id="kendali" wire:ignore.self>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#ada" data-toggle="tab" wire:ignore.self>List Akun User Pegawai</a></li>
                            <li class="nav-item"><a class="nav-link" href="#belum-ada" data-toggle="tab" wire:ignore.self>List Pegawai Aktif Tanpa Akun User</a></li>
                            @if(auth()->user()->tipe == "Admin Dinas")
                                <li class="nav-item"><a class="nav-link" href="#admin" data-toggle="tab" wire:ignore.self>List Akun Admin</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="ada" wire:ignore.self>
                                @livewire('dashboards.admin.user.tabel-list-user')
                            </div>
                            <div class="tab-pane" id="belum-ada" wire:ignore.self>
                                @livewire('dashboards.admin.user.tabel-pegawai-tanpa-akun')
                            </div>
                            @if(auth()->user()->tipe == "Admin Dinas")
                                <div class="tab-pane" id="admin" wire:ignore.self>
                                    @livewire('dashboards.admin.user.tabel-list-admin')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="collapse" id="form-user" wire:ignore.self>
                @livewire('dashboards.admin.user.form-user')
            </div>

            <div class="collapse" id="form-user-admin" wire:ignore.self>
                @livewire('dashboards.admin.user.form-user-admin')
            </div>

        </div>
    </section>

    @push('stack-body')
    
        <script>

            window.addEventListener('kendali-ke-form-user', event=>{
                $("#kendali").hide(500)
                $("#form-user").collapse('show')
            })

            window.addEventListener('kendali-ke-form-user-admin', event=>{
                $("#kendali").hide(500)
                $("#form-user-admin").collapse('show')
            })

            window.addEventListener('form-ke-kendali', event=>{
                $("#form-user-admin").collapse('hide')
                $("#form-user").collapse('hide')
                $("#kendali").show(500)
            })

        </script>

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
    @endpush

</div>

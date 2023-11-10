<div>


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('damkar/logo_damkar_dki.png')}}" alt="Damkar" class="brand-image elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">
            User Pegawai
            </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">   
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ (auth()->user()->data->profile_img ?? null )? asset('storage/img/avatar/user/'. auth()->user()->data->profile_img) : asset('storage/img/avatar/placeholder/avatar.jpg')}}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a class="d-block">{{ (auth()->user()->data->nama ?? null ) ? : 'Anonim' }}</a>
            </div>
        </div>

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a class="d-block">
                    {{ (auth()->user()->data->jabatan->nama_jabatan ?? null) ? : 'Guest' }}
                </a>
                <a class="d-block">
                    {{
                    (auth()->user()->data->grup == 'A') ? 'Grup Ambon' :
                    ((auth()->user()->data->grup == 'B') ? 'Grup Bandung' :
                    ((auth()->user()->data->grup == 'C') ? 'Grup Cepu' :
                    ''))
                    }}
                </a>
                <a class="d-block justify-self-auto">{{ auth()->user()->data->penempatan->id_penempatan}}
                    {{auth()->user()->data->penempatan->nama_penempatan }}</a>
                <a class="d-block">{{auth()->user()->data->penempatan->wilayah->nama_wilayah }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item {{ (Route::currentRouteName() == 'dashboard')? 'menu-open' :''}}">
                    <a href="{{route('dashboard')}}"
                        class="nav-link {{ (Route::currentRouteName() == 'dashboard')? 'active' :''}}">
                        <i class="nav-icon fas fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (Route::currentRouteName() =='profil')? 'menu-open' :''}}">
                    <a href="{{route('profil')}}"
                        class="nav-link {{ (Route::currentRouteName() =='profil')? 'active' :''}}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item  {{ (Route::currentRouteName() =='apdku')? 'menu-open' :''}}">
                    <a href="{{route('apdku')}}"
                        class="nav-link {{ (Route::currentRouteName() =='apdku')? 'active' :''}}">
                        <i class="nav-icon fas fa-tshirt"></i>
                        <p>
                            APDku
                            @if ($notif_apdku_belum_isi > 0)
                                <span class="badge badge-warning right">{{$notif_apdku_belum_isi}}</span>
                            @endif
                            @if ($notif_apdku_ditolak)
                                <span class="badge badge-danger right">{{$notif_apdku_ditolak}}</span>
                            @endif
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (Route::currentRouteName() =='ukuran')? 'menu-open' :''}}">
                    <a href="{{route('ukuran')}}"
                        class="nav-link {{ (Route::currentRouteName() =='ukuran')? 'active' :''}}">
                        <i class="nav-icon fas fa-suitcase"></i>
                        <p>
                            UKURANku
                            @if ($notif_ukuranku_belum_isi > 0)
                                <span class="badge badge-warning right">{{$notif_ukuranku_belum_isi}}</span>
                            @endif
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (Route::currentRouteName() =='ganti-barang' || Route::currentRouteName() =='lapor-hilang')? 'menu-open' :''}}">
                    <a 
                        class="nav-link">
                        <i class="nav-icon fab fa-stack-exchange"></i>
                        <p>
                            Bantuan Barang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Route::currentRouteName() =='ganti-barang')? 'menu-open' :''}}">
                          <a href="{{route('ganti-barang')}}" class="nav-link {{ (Route::currentRouteName() =='ganti-barang')? 'active' :''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Permohonan Ganti APD</p>
                          </a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() =='lapor-hilang')? 'menu-open' :''}}">
                            <a href="{{route('lapor-hilang')}}" class="nav-link {{ (Route::currentRouteName() =='lapor-hilang')? 'active' :''}}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Lapor Kehilangan APD</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (auth()->user()->data->jabatan->level_user == 'admin_sektor' || auth()->user()->data->jabatan->level_user == 'admin_sudin' || auth()->user()->data->jabatan->level_user == 'admin_dinas')
                <li class="nav-item {{ (Route::currentRouteName() =='print-laporan' || Route::currentRouteName() =='progress-apd' || Route::currentRouteName() =='data-ukuran' || Route::currentRouteName() =='data-distribusi')? 'menu-open' :''}}">
                    <a 
                        class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Route::currentRouteName() =='progress-apd')? 'menu-open' :''}}">
                          <a href="{{route('progress-apd')}}" class="nav-link {{ (Route::currentRouteName() =='progress-apd')? 'active' :''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Progres Inputan</p>
                          </a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() =='data-distribusi')? 'menu-open' :''}}">
                            <a href="{{route('data-distribusi')}}" class="nav-link {{ (Route::currentRouteName() =='data-distribusi')? 'active' :''}}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Data Distribusi</p>
                            </a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() =='data-ukuran')? 'menu-open' :''}}">
                            <a href="{{route('data-ukuran')}}" class="nav-link {{ (Route::currentRouteName() =='data-ukuran')? 'active' :''}}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Data Ukuran</p>
                            </a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() =='print-laporan')? 'menu-open' :''}}">
                          <a href="{{route('print-laporan')}}" class="nav-link {{ (Route::currentRouteName() =='print-laporan')? 'active' :''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Print Laporan</p>
                          </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item {{ (Route::currentRouteName() =='kepegawaian')? 'menu-open' :''}}">
                    <a href="{{route('kepegawaian')}}"
                        class="nav-link {{ (Route::currentRouteName() =='kepegawaian')? 'active' :''}}">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>
                            Kepegawaian
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->data->jabatan->level_user == 'admin_dinas')
                <li class="nav-item {{ (Route::currentRouteName() =='periode-setting')? 'menu-open' :''}}">
                    <a href="{{route('periode-setting')}}"
                        class="nav-link {{ (Route::currentRouteName() =='periode-setting')? 'active' :''}}">
                        <i class="nav-icon fas fa-paperclip"></i>
                        <p>
                            Pengaturan Periode
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (Route::currentRouteName() =='pengaturan-barang')? 'menu-open' :''}}">
                    <a href="{{route('pengaturan-barang')}}"
                        class="nav-link {{ (Route::currentRouteName() =='pengaturan-barang')? 'active' :''}}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Pengaturan Barang
                        </p>
                    </a>
                </li>
                @endif


                @if (auth()->user()->data->isPenanggungJawab())

                <li class="nav-header border-bottom mb-3"></li>

                    <li class="nav-item {{ (Route::currentRouteName() =='progress-apd' || Route::currentRouteName() =='progress-ukuran')? 'menu-open' :''}}">
                        <a 
                            class="nav-link">
                            <i class="fas fa-marker nav-icon"></i>
                            <p>
                                Progress Anggota
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item {{ (Route::currentRouteName() =='progress-apd')? 'menu-open' :''}}">
                            <a href="{{route('progress-apd')}}" class="nav-link {{ (Route::currentRouteName() =='progress-apd')? 'active' :''}}">
                                <i class="fas fa-tshirt nav-icon"></i>
                                <p>Input APD</p>
                            </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item {{ (Route::currentRouteName() =='progress-ukuran')? 'menu-open' :''}}">
                            <a href="{{route('progress-ukuran')}}" class="nav-link {{ (Route::currentRouteName() =='progress-ukuran')? 'active' :''}}">
                                <i class="fas fa-ruler nav-icon"></i>
                                <p>Input Ukuran</p>
                            </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item {{ (Route::currentRouteName() =='data-apd' || Route::currentRouteName() =='data-ukuran')? 'menu-open' :''}}">
                        <a 
                            class="nav-link">
                            <i class="fas fa-server nav-icon"></i>
                            <p>
                                Data Inputan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item {{ (Route::currentRouteName() =='data-apd')? 'menu-open' :''}}">
                            <a href="{{route('data-apd')}}" class="nav-link {{ (Route::currentRouteName() =='data-apd')? 'active' :''}}">
                                <i class="fas fa-hard-hat nav-icon"></i>
                                <p>APD Terinput</p>
                            </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item {{ (Route::currentRouteName() =='data-ukuran')? 'menu-open' :''}}">
                            <a href="{{route('data-ukuran')}}" class="nav-link {{ (Route::currentRouteName() =='data-ukuran')? 'active' :''}}">
                                <i class="fas fa-ruler-combined nav-icon"></i>
                                <p>Ukuran Terinput</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="nav-header border-bottom"></li>
                
                <li class="nav-item">
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <a href="" class="nav-link" role="button"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>
</div>
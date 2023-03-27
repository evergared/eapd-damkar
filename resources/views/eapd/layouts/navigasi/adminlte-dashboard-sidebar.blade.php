<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('damkar/logo_damkar_dki.png')}}" alt="Damkar" class="brand-image elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">
            @if (auth()->user()->data->jabatan->level_user == 'admin_sektor')
                Admin Sektor
            @else
                User Pegawai
            @endif
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
                    (auth()->user()->data->id_grup == 'A') ? 'Grup Ambon' :
                    ((auth()->user()->data->id_grup == 'B') ? 'Grup Bandung' :
                    ((auth()->user()->data->id_grup == 'C') ? 'Grup Cepu' :
                    ''))
                    }}
                </a>
                <a class="d-block">{{ auth()->user()->data->penempatan->id_penempatan}}
                    {{auth()->user()->data->penempatan->nama_penempatan }}</a>
                <a class="d-block">{{auth()->user()->data->wilayah->nama_wilayah }}</a>
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
                <li class="nav-item  {{ (Route::currentRouteName() =='apdku')? 'menu-open' :''}}">
                    <a href="{{route('apdku')}}"
                        class="nav-link {{ (Route::currentRouteName() =='apdku')? 'active' :''}}">
                        <i class="nav-icon fas fa-tshirt"></i>
                        <p>
                            APDku
                        </p>
                    </a>
                </li>
                <li class="nav-item  {{ (Route::currentRouteName() =='request-item')? 'menu-open' :''}}">
                    <a href="{{ route('request-item') }}"
                        class="nav-link {{ (Route::currentRouteName() =='request-item')? 'active' :''}}">
                        <i class="nav-icon fab fa-stack-exchange"></i>
                        <p>
                            Request Item
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
                <li class="nav-item {{ (Route::currentRouteName() =='ukuran')? 'menu-open' :''}}">
                    <a href="{{route('ukuran')}}"
                        class="nav-link {{ (Route::currentRouteName() =='ukuran')? 'active' :''}}">
                        <i class="nav-icon fas fa-suitcase"></i>
                        <p>
                            Ukuran
                        </p>
                    </a>
                </li>
                @if (auth()->user()->data->jabatan->level_user == 'admin_sektor' || auth()->user()->data->jabatan->level_user == 'admin_sudin' || auth()->user()->data->jabatan->level_user == 'admin_dinas')
                <li class="nav-item {{ (Route::currentRouteName() =='print-laporan' || Route::currentRouteName() =='progres-sektor' || Route::currentRouteName() =='data-ukuran' || Route::currentRouteName() =='data-distribusi')? 'menu-open' :''}}">
                    <a 
                        class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Route::currentRouteName() =='progres-sektor')? 'menu-open' :''}}">
                          <a href="{{route('progres-sektor')}}" class="nav-link {{ (Route::currentRouteName() =='progres-sektor')? 'active' :''}}">
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

                @if (auth()->user()->data->jabatan->level_user == 'admin_dinas')
                    <li class="nav-item {{ (Route::currentRouteName() =='running-text' )? 'menu-open' :''}}">
                        <a 
                            class="nav-link">
                            <i class="nav-icon fas fa-flag"></i>
                            <p>
                                Pengaturan Web
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item {{ (Route::currentRouteName() =='running-text')? 'menu-open' :''}}">
                            <a href="{{route('running-text')}}" class="nav-link {{ (Route::currentRouteName() =='running-text')? 'active' :''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Notice Text Berjalan</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                @endif
                
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
                
                <li class="nav-header border-bottom"><i class="nav-icon fas fa-book"></i><span></span> Manual Book</li>
                <li class="nav-item">
                    <a href="" onclick="alert('Coming soon'); return false" target="_blank" class="nav-link">
                        <p>
                            Manual User Pegawai
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" onclick="alert('Coming soon'); return false" target="_blank" class="nav-link">
                        <p>
                            Surat Pernyataan Kebenaran
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" onclick="alert('Coming soon'); return false" target="_blank" class="nav-link">
                        <p>
                            Laporan Kehilangan APD
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" onclick="alert('Coming soon'); return false" target="_blank" class="nav-link">
                        <p>
                            Kronologis Kehilangan APD
                        </p>
                    </a>
                </li>
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
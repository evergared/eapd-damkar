<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin-dashboard')}}" class="brand-link">
        <img src="{{asset('damkar/logo_damkar_dki.png')}}" alt="Damkar" class="brand-image"
            style="opacity: .8">
        <span class="brand-text font-weight-light">
            User Admin
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
                <a class="d-block">{{ (auth()->user()->nama_akun ?? null ) ? : 'ADMIN' }}</a>
            </div>
        </div>

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info text-light">
                        
                @if (auth()->user()->id_pegawai_plt)
                    <strong>PLT : </strong><br>
                    <strong>{{(auth()->user()->plt->nama ?? null ) ? : ''}}</strong><br>
                    <small class="text-muted"><i>{{(auth()->user()->plt->nip ?? null ) ? : ''}}</i></small>
                @else
                    <strong>{{(auth()->user()->data->nama ?? null ) ? : ''}}</strong><br>
                    <small class="text-muted"><i>{{(auth()->user()->data->nip ?? null ) ? : ''}}</i></small>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item {{ (Route::currentRouteName() == 'admin-dashboard')? 'menu-open' :''}}">
                    <a href="{{route('admin-dashboard')}}"
                        class="nav-link {{ (Route::currentRouteName() == 'admin-dashboard')? 'active' :''}}">
                        <i class="nav-icon fas fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (Route::currentRouteName() == 'admin-profil')? 'menu-open' :''}}">
                    <a href="{{route('admin-profil')}}"
                        class="nav-link {{ (Route::currentRouteName() == 'admin-profil')? 'active' :''}}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Profil
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (Route::currentRouteName() == 'admin-aduan-barang')? 'menu-open' :''}}">
                    <a href="{{route('admin-aduan-barang')}}"
                        class="nav-link {{ (Route::currentRouteName() == 'admin-aduan-barang')? 'active' :''}}">
                        <i class="nav-icon fab fa-stack-exchange"></i>
                        <p>
                            Aduan Barang
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (Route::currentRouteName() =='admin-progress-apd' || Route::currentRouteName() =='admin-progress-ukuran')? 'menu-open' :''}}">
                    <a href=""
                        class="nav-link {{ (Route::currentRouteName() =='admin-progress-apd' || Route::currentRouteName() =='admin-progress-ukuran')? 'active' :''}}">
                        <i class="nav-icon fas fa-business-time"></i>
                        <p>
                            Periode Berjalan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Route::currentRouteName() == 'admin-progress-apd')? 'menu-open' :''}}">
                          <a href="{{route('admin-progress-apd')}}" class="nav-link {{ (Route::currentRouteName() == 'admin-progress-apd')? 'active' :''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Input APD</p>
                          </a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() == 'admin-progress-ukuran')? 'menu-open' :''}}">
                          <a href="{{route('admin-progress-ukuran')}}" class="nav-link {{ (Route::currentRouteName() == 'admin-progress-ukuran')? 'active' :''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Input Ukuran</p>
                          </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item {{ (Route::currentRouteName() =='admin-data-apd-inputan' || Route::currentRouteName() =='admin-data-apd-no_seri' || Route::currentRouteName() =='admin-data-apd-pensiunan' || Route::currentRouteName() =='admin-data-apd-rekap')? 'menu-open' :''}}">
                    <a href=""
                        class="nav-link {{ (Route::currentRouteName() =='admin-data-apd-inputan' || Route::currentRouteName() =='admin-data-apd-no_seri' || Route::currentRouteName() =='admin-data-apd-pensiunan' || Route::currentRouteName() =='admin-data-apd-rekap')? 'active' :''}}">
                        <i class="nav-icon fab fa-hive"></i>
                        <p>
                            Data APD
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Route::currentRouteName() == 'admin-data-apd-inputan')? 'menu-open' :''}}">
                          <a href="{{route('admin-data-apd-inputan')}}" class="nav-link {{ (Route::currentRouteName() == 'admin-data-apd-inputan')? 'active' :''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Input APD</p>
                          </a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() == 'admin-data-apd-no_seri')? 'menu-open' :''}}">
                          <a href="{{route('admin-data-apd-no_seri')}}" class="nav-link {{ (Route::currentRouteName() == 'admin-data-apd-no_seri')? 'active' :''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List No Seri</p>
                          </a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() == 'admin-data-apd-pensiunan')? 'menu-open' :''}}">
                            <a href="{{route('admin-data-apd-pensiunan')}}" class="nav-link {{ (Route::currentRouteName() == 'admin-data-apd-pensiunan')? 'active' :''}}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>APD Pensiunan</p>
                            </a>
                          </li>
                          <li class="nav-item {{ (Route::currentRouteName() == 'admin-data-apd-rekap')? 'menu-open' :''}}">
                            <a href="{{route('admin-data-apd-rekap')}}" class="nav-link {{ (Route::currentRouteName() == 'admin-data-apd-rekap')? 'active' :''}}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Rekapitulasi APD</p>
                            </a>
                          </li>
                    </ul>
                </li>

                <li class="nav-item {{ (Route::currentRouteName() =='admin-data-ukuran-inputan' || Route::currentRouteName() =='admin-data-ukuran-rekap' )? 'menu-open' :''}}">
                    <a href=""
                        class="nav-link {{ (Route::currentRouteName() =='admin-data-ukuran-inputan' || Route::currentRouteName() =='admin-data-ukuran-rekap' )? 'active' :''}}">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Data Ukuran
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Route::currentRouteName() == 'admin-data-ukuran-inputan')? 'menu-open' :''}}">
                          <a href="{{route('admin-data-ukuran-inputan')}}" class="nav-link {{ (Route::currentRouteName() == 'admin-data-ukuran-inputan')? 'active' :''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List Ukuran</p>
                          </a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() == 'admin-data-ukuran-rekap')? 'menu-open' :''}}">
                          <a href="{{route('admin-data-ukuran-rekap')}}" class="nav-link {{ (Route::currentRouteName() == 'admin-data-ukuran-rekap')? 'active' :''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Rekapitulasi</p>
                          </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-header border-bottom mb-3"></li>

                <li class="nav-item  {{ (Route::currentRouteName() =='admin-pengaturan-apd-barang' || Route::currentRouteName() =='admin-pengaturan-jenis-barang')? 'menu-open' :''}}">
                    <a class="nav-link {{ (Route::currentRouteName() =='admin-pengaturan-apd-barang' || Route::currentRouteName() =='admin-pengaturan-jenis-barang')? 'active' :''}}">
                        <i class="nav-icon fas fa-hard-hat"></i>
                        <p>
                            Pengaturan Barang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Route::currentRouteName() == 'admin-pengaturan-jenis-barang')? 'menu-open' :''}}">
                            <a href="{{route('admin-pengaturan-jenis-barang')}}" class="nav-link {{ (Route::currentRouteName() == 'admin-pengaturan-jenis-barang')? 'active' :''}}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Jenis APD</p>
                            </a>
                          </li>
                          <li class="nav-item {{ (Route::currentRouteName() == 'admin-pengaturan-apd-barang')? 'menu-open' :''}}">
                            <a href="{{route('admin-pengaturan-apd-barang')}}" class="nav-link {{ (Route::currentRouteName() == 'admin-pengaturan-apd-barang')? 'active' :''}}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Barang APD</p>
                            </a>
                          </li>
                    </ul>
                </li>

                <li class="nav-item  {{ (Route::currentRouteName() =='admin-pengaturan-periode')? 'menu-open' :''}}">
                    <a href="{{ route('admin-pengaturan-periode') }}"
                        class="nav-link {{ (Route::currentRouteName() =='admin-pengaturan-periode')? 'active' :''}}">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Pengaturan Periode
                        </p>
                    </a>
                </li>
                <li class="nav-item  {{ (Route::currentRouteName() =='admin-pengaturan-kepegawaian')? 'menu-open' :''}}">
                    <a href="{{route('admin-pengaturan-kepegawaian')}}"
                        class="nav-link {{ (Route::currentRouteName() =='admin-pengaturan-kepegawaian')? 'active' :''}}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Kepegawaian
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (Route::currentRouteName() =='admin-pengaturan-user')? 'menu-open' :''}}">
                    <a href="{{route('admin-pengaturan-user')}}"
                        class="nav-link {{ (Route::currentRouteName() =='admin-pengaturan-user')? 'active' :''}}">
                        <i class="nav-icon fas fa-user-lock"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
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

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('damkar/logo_damkar_dki.png')}}" alt="Damkar" class="brand-image elevation-3"
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
                <a class="d-block">{{ (auth()->user()->data->nama ?? null ) ? : 'Anonim' }}</a>
            </div>
        </div>

        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
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
                <a class="d-block">{{ auth()->user()->data->penempatan->id_penempatan}}
                    {{auth()->user()->data->penempatan->nama_penempatan }}</a>
                <a class="d-block">{{auth()->user()->data->penempatan->wilayah->nama_wilayah }}</a>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item {{ (Route::currentRouteName() == 'dashboardAdmin')? 'menu-open' :''}}">
                    <a href="{{route('dashboardAdmin')}}"
                        class="nav-link {{ (Route::currentRouteName() == 'dashboardAdmin')? 'active' :''}}">
                        <i class="nav-icon fas fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (Route::currentRouteName() =='dataApdAdmin' || Route::currentRouteName() =='dataUkuranAdmin')? 'menu-open' :''}}">
                    <a href=""
                        class="nav-link">
                        <i class="nav-icon fas fa-asterisk"></i>
                        <p>
                            Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ (Route::currentRouteName() == 'dataApdAdmin')? 'menu-open' :''}}">
                          <a href="{{route('dataApdAdmin')}}" class="nav-link {{ (Route::currentRouteName() == 'dataApdAdmin')? 'active' :''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>APD</p>
                          </a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() == 'dataUkuranAdmin')? 'menu-open' :''}}">
                          <a href="{{route('dataUkuranAdmin')}}" class="nav-link {{ (Route::currentRouteName() == 'dataUkuranAdmin')? 'active' :''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ukuran</p>
                          </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  {{ (Route::currentRouteName() =='kepegawaianAdmin')? 'menu-open' :''}}">
                    <a href="{{route('kepegawaianAdmin')}}"
                        class="nav-link {{ (Route::currentRouteName() =='kepegawaianAdmin')? 'active' :''}}">
                        <i class="nav-icon fas fa-tshirt"></i>
                        <p>
                            Kepegawaian
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (Route::currentRouteName() =='userAdmin')? 'menu-open' :''}}">
                    <a href="{{route('userAdmin')}}"
                        class="nav-link {{ (Route::currentRouteName() =='userAdmin')? 'active' :''}}">
                        <i class="nav-icon fas fa-suitcase"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item  {{ (Route::currentRouteName() =='periodeAdmin')? 'menu-open' :''}}">
                    <a href="{{ route('periodeAdmin') }}"
                        class="nav-link {{ (Route::currentRouteName() =='periodeAdmin')? 'active' :''}}">
                        <i class="nav-icon fab fa-stack-exchange"></i>
                        <p>
                            Periode Setting
                        </p>
                    </a>
                </li>
                
                <li class="nav-item  {{ (Route::currentRouteName() =='itemAdmin')? 'menu-open' :''}}">
                    <a href="{{ route('itemAdmin') }}"
                        class="nav-link {{ (Route::currentRouteName() =='itemAdmin')? 'active' :''}}">
                        <i class="nav-icon fab fa-stack-exchange"></i>
                        <p>
                            Item Setting
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

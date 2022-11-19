<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('damkar/logo_damkar_dki.png')}}" alt="Damkar" class="brand-image elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">User Pegawai</span>
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
                <a class="d-block">{{ (auth()->user()->data->jabatan->nama_jabatan ?? null) ? : 'Guest' }}</a>
                <a class="d-block">{{ auth()->user()->data->penempatan->id_penempatan}}
                    {{auth()->user()->data->penempatan->nama_penempatan }}</a>
                <a class="d-block">{{auth()->user()->data->wilayah->nama_wilayah }}</a>
            </div>

        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{route('dashboard')}}" class="nav-link active">
                        <i class="nav-icon fas fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="apdku.html" class="nav-link">
                        <i class="nav-icon fas fa-tshirt"></i>
                        <p>
                            APDku
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('request-item') }}" class="nav-link">
                        <i class="nav-icon fab fa-stack-exchange"></i>
                        <p>
                            Request Item
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('profil')}}" class="nav-link">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>

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
<div>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('dashboard')}}" class="nav-link">Home</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link">
                    <small> Server Time : </small><small id="waktuServer"></small>
                </a>
            </li> --}}
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <!-- Notifications Dropdown Menu -->
            {{-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">4 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li> --}}
            <!-- Notifications Dropdown Menu end -->
            
            <li class="nav-item">
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <a class="nav-link" href="#" role="button"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="ion ion-log-out" alt="logout"></i>
                    </a>
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    @push('stack-body')
        {{-- <script>
            var serverTime = {{$server_time}};
            var localTime = Date.now();
            var timeDiff = serverTime - localTime;

            setInterval(function () {
                $('#waktuServer').html(new Date(serverTime + timeDiff))
            }, 1000);
        </script> --}}
    @endpush
</div>

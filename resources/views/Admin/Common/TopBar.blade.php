<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/') }}" class="nav-link">My School</a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">






        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>


        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-th-large"></i>
            </a>


            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="{{ url('/admin') }}/dashboard" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i>My Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ url('/admin') }}/logout" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> Logout
                </a>

            </div>
        </li>

    </ul>
</nav>
<!-- /.navbar -->

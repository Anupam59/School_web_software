<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin') }}/dashboard" class="brand-link">
        <img src="{{asset('Images/site-info/logo.png')}}" alt="School Web" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">School Web</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>

        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ url('/admin') }}/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                @if(auth()->user()->role_id <= 2)
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Site Info
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/info-edit" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Info</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/designation-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Designation</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/period-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Period</p>
                            </a>
                        </li>

                        <div class="d-none">
                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/about-edit" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>About</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/policy-edit" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Policy</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/terms-edit" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Terms</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/communication-edit" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Communication</p>
                            </a>
                        </li>
                        </div>

                    </ul>
                </li>
                @endif


                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Site Setup
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/banner-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banner</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/corner-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Corner</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/event-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Event</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/gallery-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gallery</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/link-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Link</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/news-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>News</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/notice-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Notice</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admin') }}/page-list" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Page</p>
                    </a>
                </li>


                @if(auth()->user()->role_id == 100)
                    <li class="nav-item menu-close">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Menu Setup
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/admin') }}/menu-list" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Menu List</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('/admin') }}/menu-item-list" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Menu Item List</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('/admin') }}/menu-sub-item-list" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Menu Sub Item List</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif



                <li class="nav-item menu-close">

                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Member Setup
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/member-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Member</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/teacher-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Teacher</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/staffs-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Staffs</p>
                            </a>
                        </li>

                    </ul>
                </li>

                @if(auth()->user()->role_id <= 2)
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            User Setup
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/user-list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/user-create" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Create</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Profile
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/dashboard" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Profile</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin') }}/logout" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Main Sidebar Container -->




{{--<li class="nav-item menu-open">--}}
{{--    <a href="#" class="nav-link active">--}}
{{--        <i class="nav-icon fas fa-tachometer-alt"></i>--}}
{{--        <p>--}}
{{--            Site Setup--}}
{{--            <i class="right fas fa-angle-left"></i>--}}
{{--        </p>--}}
{{--    </a>--}}

{{--    <ul class="nav nav-treeview">--}}

{{--        <li class="nav-item">--}}
{{--            <a href="#" class="nav-link active">--}}
{{--                <i class="far fa-circle nav-icon"></i>--}}
{{--                <p>Active Page</p>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        <li class="nav-item">--}}
{{--            <a href="#" class="nav-link">--}}
{{--                <i class="far fa-circle nav-icon"></i>--}}
{{--                <p>Inactive Page</p>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--    </ul>--}}
{{--</li>--}}

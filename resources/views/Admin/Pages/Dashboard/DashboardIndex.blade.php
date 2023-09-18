@extends('Admin.Layout.Main')

@section('content')



<div class="content-wrapper" style="min-height: 100px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Info boxes -->
            <div class="row">

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('/admin') }}/teacher-list">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fa fa-user-tie"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Teacher</span>
                                <span class="info-box-number">{{ $Teacher }}</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('/admin') }}/staffs-list">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Staffs</span>
                                <span class="info-box-number">{{ $Staffs }}</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('/admin') }}/member-list">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-user-plus"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Present Member</span>
                                <span class="info-box-number">{{ $PresentMember }}</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('/admin') }}/member-list">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-user-minus"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Previous Member</span>
                                <span class="info-box-number">{{ $PreviousMember }}</span>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            <!-- Info boxes -->
            <div class="row">



                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('/admin') }}/corner-list">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-image"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Corner</span>
                                <span class="info-box-number">{{ $Corner }}</span>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('/admin') }}/banner-list">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fa fa-chalkboard"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Banner</span>
                                <span class="info-box-number">{{ $Banner }}</span>
                            </div>
                        </div>
                    </a>
                </div>


                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('/admin') }}/event-list">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-republican"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Event</span>
                                <span class="info-box-number">{{ $Event }}</span>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('/admin') }}/notice-list">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-exclamation"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Notice</span>
                                <span class="info-box-number">{{ $Notice }}</span>
                            </div>
                        </div>
                    </a>
                </div>


            </div>

            <!-- Info boxes -->
            <div class="row">

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('/admin') }}/news-list">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fa fa-newspaper"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">News</span>
                                <span class="info-box-number">{{ $News }}</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('/admin') }}/link-list">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-link"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Important Link</span>
                                <span class="info-box-number">{{ $ImportantLink }}</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('/admin') }}/link-list">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-link"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Quick Link</span>
                                <span class="info-box-number">{{ $QuickLink }}</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ url('/admin') }}/gallery-list">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-images"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Gallery</span>
                                <span class="info-box-number">{{ $Gallery }}</span>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

        </div>
    </section>
    <!-- /.content -->
</div>


@endsection

@section('script')
    <script>

    </script>
@endsection

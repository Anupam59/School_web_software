

@extends('Admin.Layout.Main')

@section('content')


    <div class="content-wrapper" style="min-height: 1604.08px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Notice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Notice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">



            @if (session('success_message'))
                <div class="alert alert_success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('success_message') }}
                </div>
            @elseif (session('error_message'))
                <div class="alert error_success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('error_message') }}
                </div>
            @else

            @endif





                <div class="container-fluid">
                    <form action="{{ url('/admin/notice-list') }}" method="get">
                        <div class="row mb-2 justify-content-center">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" value="{{ request()->query('start_date') }}" name="start_date" placeholder="start date">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" value="{{ request()->query('end_date') }}" name="end_date" placeholder="end date">
                                </div>
                            </div>

                            <div class="col-md-2 text-center">
                                <input id="reset" type="reset" class="btn btn-danger" value="Reset">
                                <input type="submit" class="btn btn-primary" value="Search">
                            </div>
                        </div>
                    </form>
                </div>







            @if(!$Notice->isEmpty())

            <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/notice-create">
                            Add <i class="fas fa-plus"></i>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th style="width: 1%">
                                    SL
                                </th>
                                <th style="width: 60%">
                                    Title
                                </th>
                                <th class="text-center">
                                    Modifier
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th style="width: 10%" class="text-right">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($Notice as $key=>$NoticeItem)

                                <tr>
                                    <td>{{ $key+1 }}</td>


                                    <td>
                                        <a>{{ $NoticeItem->notice_en_title }}</a>
                                        <br>
                                        <small>{{ $NoticeItem->notice_bn_title }}</small>
                                    </td>


                                    <td>
                                        <a>{{ $NoticeItem->modifier_by }}</a>
                                        <br>
                                        <small>{{ $NoticeItem->modified_date }}</small>
                                    </td>


                                    <td class="project-state">
                                        @if($NoticeItem->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @elseif($NoticeItem->status == 2)
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>


                                    <td class="project-actions text-right">

                                        <a class="btn btn-primary btn-sm" href="{{ url('/admin') }}/notice-edit/{{ $NoticeItem->notice_id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <a class="btn btn-danger btn-sm NoticeDeleteBtn" data-id="{{ $NoticeItem->notice_id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                    </td>



                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center">
                        {{ $Notice->onEachSide(3)->links('Admin.Common.Paginate') }}
                    </div>
                </div>


            @else
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/notice-create">
                            Add <i class="fas fa-plus"></i>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        @include('Admin.Common.DataNotFound')
                    </div>
                </div>
            @endif

        </section>
        <!-- /.content -->
    </div>



    <div class="modal fade" id="NoticeDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('/admin/notice-delete')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-3 text-center">
                        <h5 class="mt-4">Do You Want To Delete?</h5>
                        <input type="hidden" id="NoticeDeleteId" name="notice_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn  btn-sm  btn-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection

@section('script')
    <script>

        $('.NoticeDeleteBtn').click(function(){
            var id= $(this).data('id');
            $('#NoticeDeleteId').val(id);
            $('#NoticeDeleteModal').modal('show');
        });

    </script>
@endsection

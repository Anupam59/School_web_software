

@extends('Admin.Layout.Main')

@section('content')


    <div class="content-wrapper" style="min-height: 1604.08px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Staffs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Staffs</li>
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
                <form action="{{ url('/admin/staffs-list') }}" method="get">
                    <div class="row mb-2 justify-content-center">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ request()->query('staffs_index') }}" name="staffs_index" placeholder="staffs index">
                            </div>
                        </div>

                        <div class="col-md-2 text-center">
                            <input id="reset" type="reset" class="btn btn-danger" value="Reset">
                            <input type="submit" class="btn btn-primary" value="Search">
                        </div>
                    </div>
                </form>
            </div>





            @if(!$Staffs->isEmpty())

            <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/staffs-create">
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
                                <th style="width: 10%">
                                    Image
                                </th>
                                <th style="width: 30%">
                                    Title
                                </th>

                                <th>
                                    Position
                                </th>

                                <th>
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

                            @foreach($Staffs as $key=>$StaffsItem)

                                <tr>
                                    <td>{{ $key+1 }}</td>


                                    <td>
                                        <img class="img-fluid w-100" src="{{asset($StaffsItem->staffs_image)}}" alt="Photo">
                                    </td>


                                    <td>
                                        <a>{{ $StaffsItem->staffs_en_name }}</a>
                                        <br>
                                        <small>{{ $StaffsItem->designation_en_title }}</small>

                                    </td>


                                    <td>
                                        <a>{{ $StaffsItem->position }}</a>
                                        <br>
                                        <small>index : {{ $StaffsItem->staffs_index }}</small>
                                    </td>


                                    <td>
                                        <a>{{ $StaffsItem->modifier_by }}</a>
                                        <br>
                                        <small>{{ $StaffsItem->modified_date }}</small>
                                    </td>


                                    <td class="project-state">
                                        @if($StaffsItem->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @elseif($StaffsItem->status == 2)
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>


                                    <td class="project-actions text-right">

                                        <a class="btn btn-primary btn-sm" href="{{ url('/admin') }}/staffs-edit/{{ $StaffsItem->staffs_id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <a class="btn btn-danger btn-sm StaffsDeleteBtn" data-id="{{ $StaffsItem->staffs_id }}">
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
                        {{ $Staffs->onEachSide(3)->links('Admin.Common.Paginate') }}
                    </div>
                </div>


            @else
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/staffs-create">
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



    <div class="modal fade" id="StaffsDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('/admin/staffs-delete')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-3 text-center">
                        <h5 class="mt-4">Do You Want To Delete?</h5>
                        <input type="hidden" id="StaffsDeleteId" name="staffs_id">
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

        $('.StaffsDeleteBtn').click(function(){
            var id= $(this).data('id');
            $('#StaffsDeleteId').val(id);
            $('#StaffsDeleteModal').modal('show');
        });

        $('#reset').click(function(){
            window.location.replace("/admin/staffs-list");
        });

    </script>
@endsection

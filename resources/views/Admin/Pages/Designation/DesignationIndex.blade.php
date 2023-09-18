

@extends('Admin.Layout.Main')

@section('content')


    <div class="content-wrapper" style="min-height: 1604.08px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Designation</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Designation</li>
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


            @if(!$Designation->isEmpty())

            <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/designation-create">
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
                                <th style="width: 30%">
                                    Title
                                </th>
                                <th class="text-center">
                                    Type
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

                            @foreach($Designation as $key=>$DesignationItem)

                                <tr>
                                    <td>{{ $key+1 }}</td>


                                    <td>
                                        <a>{{ $DesignationItem->designation_en_title }}</a>
                                        <br>
                                        <small>{{ $DesignationItem->designation_bn_title }}</small>
                                    </td>



                                    <td class="project-state">
                                        @if($DesignationItem->designation_type == 1)
                                            <a>Teacher</a>
                                        @elseif($DesignationItem->designation_type == 2)
                                            <a>Member</a>
                                        @elseif($DesignationItem->designation_type == 3)
                                            <a>Staffs</a>
                                        @endif
                                        <br>
                                        <small>{{ $DesignationItem->position }}</small>
                                    </td>



                                    <td>
                                        <a>{{ $DesignationItem->modifier_by }}</a>
                                        <br>
                                        <small>{{ $DesignationItem->modified_date }}</small>
                                    </td>


                                    <td class="project-state">
                                        @if($DesignationItem->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @elseif($DesignationItem->status == 2)
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>


                                    <td class="project-actions text-right">

                                        <a class="btn btn-primary btn-sm" href="{{ url('/admin') }}/designation-edit/{{ $DesignationItem->designation_id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <a class="btn btn-danger btn-sm DesignationDeleteBtn" data-id="{{ $DesignationItem->designation_id }}">
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
                        {{ $Designation->onEachSide(3)->links('Admin.Common.Paginate') }}
                    </div>
                </div>


            @else
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/designation-create">
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



    <div class="modal fade" id="DesignationDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('/admin/designation-delete')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-3 text-center">
                        <h5 class="mt-4">Do You Want To Delete?</h5>
                        <input type="hidden" id="DesignationDeleteId" name="designation_id">
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

        $('.DesignationDeleteBtn').click(function(){
            var id= $(this).data('id');
            $('#DesignationDeleteId').val(id);
            $('#DesignationDeleteModal').modal('show');
        });

    </script>
@endsection

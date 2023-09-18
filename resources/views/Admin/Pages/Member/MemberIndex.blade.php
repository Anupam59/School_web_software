

@extends('Admin.Layout.Main')

@section('content')


    <div class="content-wrapper" style="min-height: 1604.08px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Member</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Member</li>
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
                <form action="{{ url('/admin/member-list') }}" method="get">
                    <div class="row mb-2 justify-content-center">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ request()->query('member_index') }}" name="member_index" placeholder="member index">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <select class="form-control select2" data-placeholder="Select Period" id="period_id" name="period_id">
                                    @if($Period)
                                        @foreach($Period as $PeriodItem)
                                            <option value="{{ $PeriodItem->period_id }}"> {{ $PeriodItem->period_en_title }}</option>
                                        @endforeach
                                    @else

                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 text-center">
                            <input id="reset" type="reset" class="btn btn-danger" value="Reset">
                            <input type="submit" class="btn btn-primary" value="Search">
                        </div>
                    </div>
                </form>
            </div>





            @if(!$Member->isEmpty())

            <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/member-create">
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

                            @foreach($Member as $key=>$MemberItem)

                                <tr>
                                    <td>{{ $key+1 }}</td>


                                    <td>
                                        <img class="img-fluid w-100" src="{{asset($MemberItem->member_image)}}" alt="Photo">
                                    </td>


                                    <td>
                                        <a>{{ $MemberItem->member_en_name }}</a>
                                        <br>
                                        <small>{{ $MemberItem->designation_en_title }}</small>

                                    </td>


                                    <td>
                                        <a>{{ $MemberItem->position }}</a>
                                        <br>
                                        <small>index : {{ $MemberItem->member_index }}</small>
                                    </td>


                                    <td>
                                        <a>{{ $MemberItem->modifier_by }}</a>
                                        <br>
                                        <small>{{ $MemberItem->modified_date }}</small>
                                    </td>


                                    <td class="project-state">
                                        @if($MemberItem->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @elseif($MemberItem->status == 2)
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>


                                    <td class="project-actions text-right">

                                        <a class="btn btn-primary btn-sm" href="{{ url('/admin') }}/member-edit/{{ $MemberItem->member_id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <a class="btn btn-danger btn-sm MemberDeleteBtn" data-id="{{ $MemberItem->member_id }}">
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
                        {{ $Member->onEachSide(3)->links('Admin.Common.Paginate') }}
                    </div>
                </div>


            @else
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/member-create">
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

        <input type="hidden" id="getPeriodId" class="form-control" value="{{ request()->query('period_id') }}">
        <input type="hidden" id="StatusPeriodId" class="form-control" value="{{ $PeriodStatus->period_id }}">
    </div>



    <div class="modal fade" id="MemberDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('/admin/member-delete')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-3 text-center">
                        <h5 class="mt-4">Do You Want To Delete?</h5>
                        <input type="hidden" id="MemberDeleteId" name="member_id">
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
        $('#period_id').select2();

        $('.MemberDeleteBtn').click(function(){
            var id= $(this).data('id');
            $('#MemberDeleteId').val(id);
            $('#MemberDeleteModal').modal('show');
        });

        $('#reset').click(function(){
            window.location.replace("/admin/member-list");
        });

        PeriodShow();
        function PeriodShow(){
            var getPeriodId = $('#getPeriodId').val();
            var StatusPeriodId = $('#StatusPeriodId').val();
            if(getPeriodId){
                $("#period_id").val(getPeriodId).change();
            }else {
                $("#period_id").val(StatusPeriodId).change();
            }
        }

    </script>
@endsection

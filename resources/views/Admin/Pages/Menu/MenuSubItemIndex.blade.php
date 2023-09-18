

@extends('Admin.Layout.main')

@section('content')


    <div class="content-wrapper" style="min-height: 1604.08px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Menu Sub Item</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Menu Sub Item</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">





        @if(!$MenuSubItem->isEmpty())

            <!-- Default box -->
                <div class="card">
                    <div class="card-header">

                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/menu-sub-item-create">
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
                                <th style="width: 20%">
                                    Title
                                </th>
                                <th style="width: 30%">
                                    Link
                                </th>

                                <th style="width: 20%">
                                    Menu
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th style="width: 30%" class="text-right">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($MenuSubItem as $key=>$MenuSubItemI)

                                <tr>
                                    <td>{{ $key+1 }}</td>

                                    <td>
                                        <a>{{ $MenuSubItemI->menu_sub_item_title }}</a>
                                        <br>
                                        <small>{{ $MenuSubItemI->menu_sub_item_bn_title }}</small>
                                    </td>


                                    <td>
                                        <a>{{ $MenuSubItemI->menu_sub_item_link }}</a>
                                    </td>

                                    <td>
                                        <a>{{ $MenuSubItemI->menu_title }}</a>
                                        <br>
                                        <small>{{ $MenuSubItemI->menu_item_title }}</small>
                                    </td>


                                    <td class="project-state">
                                        @if($MenuSubItemI->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @elseif($MenuSubItemI->status == 2)
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>


                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="{{ url('/admin') }}/menu-sub-item-edit/{{ $MenuSubItemI->menu_sub_item_id }}">
                                            <i class="fas fa-pencil-alt"></i>
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
                        {{ $MenuSubItem->onEachSide(3)->links('Admin.Common.Paginate') }}
                    </div>
                </div>



            @else

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/menu-sub-item-create">
                            Add <i class="fas fa-plus"></i>
                        </a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.card -->

                @include('Admin.Common.DataNotFound')
            @endif

        </section>
        <!-- /.content -->
    </div>


@endsection

@section('script')
    <script>

    </script>
@endsection

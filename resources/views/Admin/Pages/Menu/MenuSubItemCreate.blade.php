@extends('Admin.Layout.main')

@section('content')



    <div class="content-wrapper" style="min-height: 1604.08px;" data-select2-id="31">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Menu Sub Item Create</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Menu Sub Item Create</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>



        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card card-default">

                    <div class="card-header">
                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/menu-sub-item-list">
                            All Data
                        </a>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">



                        @if ($errors->any())
                            <div class="alert error_success">
                                <ul class="m-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


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



                        <form action="{{ url('/admin/menu-sub-item-entry') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{ old('menu_sub_item_title') }}" name="menu_sub_item_title" placeholder="Title">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title (বাংলা)</label>
                                        <input type="text" class="form-control" value="{{ old('menu_sub_item_bn_title') }}" name="menu_sub_item_bn_title" placeholder="Title (বাংলা)">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Menu</label>
                                        <select class="form-control select2" id="menu_id" name="menu_id" required>
                                            <option value=" " selected="selected">Select One</option>

                                            @if($Menu)
                                                @foreach($Menu as $MenuI)
                                                    <option value="{{ $MenuI->menu_id }}"> {{ $MenuI->menu_title }}</option>
                                                @endforeach
                                            @else

                                            @endif

                                        </select>
                                    </div>
                                </div>




                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Menu Item</label>
                                        <select class="form-control select2" id="menu_item_id" name="menu_item_id" required>


                                        </select>
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Link</label>
                                        <input type="text" class="form-control" value="{{ old('menu_sub_item_link') }}" name="menu_sub_item_link" placeholder="Title">
                                    </div>
                                </div>



                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </section>
    </div>

@endsection

@section('script')
    <script>

        $('#menu_id').select2();
        $('#menu_item_id').select2();


        $('#menu_id').on('change',function (e){
            var menu_id = e.target.value;
            //UpazilaInput
            axios.post('/MenuItemGetData',{menu_id:menu_id}).then(function (response) {
                var JsonData = response.data;
                $('#menu_item_id').empty();
                $('#menu_item_id').append( JsonData );
            });

        });

    </script>
@endsection

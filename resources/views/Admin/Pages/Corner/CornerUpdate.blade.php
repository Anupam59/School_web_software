@extends('Admin.Layout.Main')

@section('content')


    <div class="content-wrapper" style="min-height: 1604.08px;" data-select2-id="31">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Corner Update</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Corner Update</li>
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

                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/corner-list">
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
                                <ul>
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




                        <form action="{{ url('/admin/corner-update/'.$Corner->corner_id)}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="corner_en_title" value="{{ $Corner->corner_en_title }}" placeholder="Title" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title (বাংলা)</label>
                                        <input type="text" class="form-control" name="corner_bn_title" value="{{ $Corner->corner_bn_title }}" placeholder="Title (বাংলা)" required>
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" id="corner_en_description" name="corner_en_description" placeholder="Description ...">{{ $Corner->corner_en_description }}</textarea>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description (বাংলা)</label>
                                        <textarea class="form-control" id="corner_bn_description" name="corner_bn_description" placeholder="Description (বাংলা) ...">{{ $Corner->corner_bn_description }}</textarea>
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Image (400 X 400)</label>
                                        <input type="file" class="form-control" name="corner_image">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        @if($Corner->corner_image)
                                            <img class="img-fluid w-100" src="{{asset($Corner->corner_image)}}" alt="Photo">
                                        @else
                                            <img class="img-fluid w-100" src="{{asset('Admin/dist/img/photo1.png')}}" alt="Photo">
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="" selected="selected">Select One</option>
                                            <option value="1" @if($Corner->status == "1") {{ 'selected' }} @endif>Active</option>
                                            <option value="2" @if($Corner->status == "2") {{ 'selected' }} @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
        $('#status').select2();
        $('#corner_en_description').summernote({
            placeholder: 'News Description',
            height: 120,
        });

        $('#corner_bn_description').summernote({
            placeholder: 'News Description (বাংলা)',
            height: 120,
        });
    </script>

@endsection

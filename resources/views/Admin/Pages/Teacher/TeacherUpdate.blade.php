@extends('Admin.Layout.Main')

@section('content')



    <div class="content-wrapper" style="min-height: 1604.08px;" data-select2-id="31">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Teacher Update</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Teacher Update</li>
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
                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/teacher-list">
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

                        <form action="{{ url('/admin/teacher-update/'.$Teacher->teacher_id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name </label>
                                        <input type="text" class="form-control" value="{{ $Teacher->teacher_en_name }}" name="teacher_en_name" placeholder="Name">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name (বাংলা) </label>
                                        <input type="text" class="form-control" value="{{ $Teacher->teacher_bn_name }}" name="teacher_bn_name" placeholder="Name (বাংলা)">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Teacher Designation</label>
                                        <select class="form-control select2" data-placeholder="Select Designation" id="designation_id" name="designation_id" required>
                                            <option value=" " selected="selected">Select Designation</option>
                                            @if($Designation)
                                                @foreach($Designation as $DesignationItem)
                                                    <option value="{{ $DesignationItem->designation_id }}" @if($DesignationItem->designation_id == $Teacher->designation_id) {{ 'selected' }} @endif > {{ $DesignationItem->designation_en_title }}</option>
                                                @endforeach
                                            @else

                                            @endif
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Index Number </label>
                                        <input type="text" class="form-control" value="{{ $Teacher->teacher_index }}" name="teacher_index" placeholder="Index Number">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control" id="teacher_gender" name="teacher_gender">
                                            <option value="" selected="selected">Select One</option>
                                            <option value="1" @if($Teacher->teacher_gender == "1") {{ 'selected' }} @endif>Male</option>
                                            <option value="2" @if($Teacher->teacher_gender == "2") {{ 'selected' }} @endif>Female</option>
                                        </select>
                                    </div>
                                </div>




                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Joining Date</label>
                                        <input type="datetime-local" class="form-control" value="{{ $Teacher->joining_date }}" name="joining_date" placeholder="Joining">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Resign Date</label>
                                        <input type="datetime-local" class="form-control" value="{{ $Teacher->resign_date }}" name="resign_date" placeholder="Resign">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" id="teacher_en_description" name="teacher_en_description" placeholder="Description ...">{{ $Teacher->teacher_en_description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description (বাংলা)</label>
                                        <textarea class="form-control" id="teacher_bn_description" name="teacher_bn_description" placeholder="Description ...">{{ $Teacher->teacher_bn_description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Speech</label>
                                        <textarea class="form-control" id="teacher_en_speech" name="teacher_en_speech" placeholder="Description ...">{{ $Teacher->teacher_en_speech }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Speech (বাংলা)</label>
                                        <textarea class="form-control" id="teacher_bn_speech" name="teacher_bn_speech" placeholder="Description ...">{{ $Teacher->teacher_bn_speech }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Whatsapp Number</label>
                                        <input type="text" class="form-control" value="{{ $Teacher->whatsapp_number }}" name="whatsapp_number" placeholder="Whatsapp Number">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Facebook Link</label>
                                        <input type="text" class="form-control" value="{{ $Teacher->facebook_link }}" name="facebook_link" placeholder="Facebook Link">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="text" class="form-control" value="{{ $Teacher->email_address }}" name="email_address" placeholder="Email Address">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" value="{{ $Teacher->phone_number }}" name="phone_number" placeholder="Phone Number">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Linkedin Link</label>
                                        <input type="text" class="form-control" value="{{ $Teacher->linkedin_link }}" name="linkedin_link" placeholder="Linkedin Link">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Twitter Link</label>
                                        <input type="text" class="form-control" value="{{ $Teacher->twitter_link }}" name="twitter_link" placeholder="Twitter Link">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Image (340 X 340)</label>
                                        <input type="file" class="form-control" name="teacher_image">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        @if($Teacher->teacher_image)
                                            <img class="img-fluid w-100" src="{{asset($Teacher->teacher_image)}}" alt="Photo">
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
                                            <option value="1" @if($Teacher->status == "1") {{ 'selected' }} @endif>Active</option>
                                            <option value="2" @if($Teacher->status == "2") {{ 'selected' }} @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Position</label>
                                        <input type="number" class="form-control" value="{{ $Teacher->position }}" name="position" placeholder="Position">
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

        $('#teacher_gender').select2();
        $('#designation_id').select2();

        $('#teacher_en_description').summernote({
            placeholder: 'News Description',
            height: 120,
        });

        $('#teacher_bn_description').summernote({
            placeholder: 'News Description (বাংলা)',
            height: 120,
        });

        $('#teacher_en_speech').summernote({
            placeholder: 'News Description',
            height: 120,
        });

        $('#teacher_bn_speech').summernote({
            placeholder: 'News Description (বাংলা)',
            height: 120,
        });


        TeacherGetData();
        function TeacherGetData(){
            axios.post('/TeacherGetData').then(function (response) {
                var JsonData = response.data;
                $('#designation_id').empty();
                $('#designation_id').append( JsonData );
            });
        }

    </script>
@endsection

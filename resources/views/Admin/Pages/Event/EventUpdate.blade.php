@extends('Admin.Layout.Main')

@section('content')


    <div class="content-wrapper" style="min-height: 1604.08px;" data-select2-id="31">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Event Update</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Event Update</li>
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

                        <a class="btn btn-danger btn-sm add_btn" href="{{ url('/admin') }}/event-list">
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




                        <form action="{{ url('/admin/event-update/'.$Event->event_id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="event_en_title" value="{{ $Event->event_en_title }}" placeholder="Title" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title (বাংলা)</label>
                                        <input type="text" class="form-control" name="event_bn_title" value="{{ $Event->event_bn_title }}" placeholder="Title (বাংলা)" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" id="event_en_description" name="event_en_description" placeholder="Description ...">{{ $Event->event_en_description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description (বাংলা)</label>
                                        <textarea class="form-control" id="event_bn_description" name="event_bn_description" placeholder="Description (বাংলা) ...">{{ $Event->event_bn_description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Image(750 X 400)</label>
                                        <input type="file" class="form-control" name="event_image">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        @if($Event->event_image)
                                            <img class="img-fluid w-100" src="{{asset($Event->event_image)}}" alt="Photo">
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
                                            <option value="1" @if($Event->status == "1") {{ 'selected' }} @endif>Active</option>
                                            <option value="2" @if($Event->status == "2") {{ 'selected' }} @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Multi Image</label>
                                        <input type="file" class="form-control" name="event_img[]" multiple>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row" id="EventImgDiv"></div>
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




    <div class="modal fade" id="EventImageDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-3 text-center">
                    <h5 class="mt-4">Do You Want To Image Delete?</h5>
                    <input type="hidden" id="EventImageDeleteId">
                    <input type="hidden" id="EventIdByImage">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
                    <button id="EventImageDeleteConfBtn" class="btn  btn-sm  btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>






    <input type="hidden" id="EventId" value="{{$Event->event_id}}">



@endsection

@section('script')
    <script>
        $('#status').select2();
        $('#event_en_description').summernote({
            placeholder: 'News Description',
            height: 120,
        });

        $('#event_bn_description').summernote({
            placeholder: 'News Description (বাংলা)',
            height: 120,
        });



        EventImgShow();
        //  Product Image Show
        function EventImgShow(){

            var event_id = $('#EventId').val();

            axios.post('/EventImgShow',{
                event_id:event_id,
            }).then(function (response) {
                if(response.status==200){
                    $('#EventImgDiv').empty();
                    var JsonData = response.data;
                    $.each(JsonData, function (i, item) {
                        $('<div class="col-md-2 col-6 mb-2 text-center">').html(
                            "<img style='width:100%;' src="+JsonData[i].event_img+">" +
                            "<a class='btn btn-sm btn-danger mt-1 EventSingleImageDelete' data-id='"+JsonData[i].event_image_id+"' data-event_id='"+JsonData[i].event_id+"'><i class='far fa-trash-alt'></i></a>"
                        ).appendTo('#EventImgDiv');
                    });

                    $('.EventSingleImageDelete').click(function () {
                        $('#EventImageDeleteId').val($(this).data('id'));
                        $('#EventIdByImage').val($(this).data('event_id'));
                        $('#EventImageDeleteModal').modal('show');
                    });
                }
            }).catch(function (error) {

            });
        }
        //  Product Image Show



        $('#EventImageDeleteConfBtn').click(function () {
            let event_image_id = $('#EventImageDeleteId').val();
            let event_id = $('#EventIdByImage').val();
            EventImageDelete(event_image_id,event_id);
        });



        //  Product Image Delete  Id
        function EventImageDelete(event_image_id,event_id){
            axios.post('/EventImageDelete',{
                event_image_id:event_image_id
            }).then(function (response) {
                if(response.status==200){
                    if (response.data==1){
                        EventImgShow(event_id);
                        $('#EventImageDeleteModal').modal('hide');
                    }else{
                        EventImgShow(event_id);
                        $('#EventImageDeleteModal').modal('hide');
                    }
                }else{
                    $('#EventImageDeleteModal').modal('hide');
                }
            }).catch(function (error) {
                $('#EventImageDeleteModal').modal('hide');
            });
        }
        //  Product Image Delete  Id



    </script>
@endsection

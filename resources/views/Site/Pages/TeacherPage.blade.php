@extends('Site.Layout.Main')


@if(session()->get('locale') == 'en')
    @section('title', __('message.nav_teacher'))
    @section('description',__('message.nav_teacher')." - ".$SiteCommon->site_description)
    @section('keywords', __('message.nav_teacher'))
@else
    @section('title', __('message.nav_teacher'))
    @section('description',__('message.nav_teacher')." - ".$SiteCommon->site_bn_description)
    @section('keywords', __('message.nav_teacher'))
@endif


@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li>{{ __('message.nav_teacher') }}</li>
            </ol>
            <h2>{{ __('message.nav_teacher') }}</h2>

        </div>
    </section><!-- End Breadcrumbs -->


    <section class="SearchPart">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <form action="{{ url('teacher') }}" method="get" class="formDiv">
                        <div class="row gy-4 justify-content-center">

                            <div class="col-md-4 ">
                                <label>Teacher Index Number</label>
                                <input type="text" class="form-control" value="{{ request()->query('index') }}" name="index" placeholder="Index Number" required>
                            </div>

                            <div class="col-md-3 text-center align-items-center">
                                <label class="invisible d-block" style="margin-bottom: 4px;">Search</label>
                                <input type="reset" value="Reset">
                                <input type="submit" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <section class="teacherSpeech">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>
                    @if(session()->get('locale') == 'en')
                        Teachers
                    @else
                        শিক্ষকমন্ডলী
                    @endif
                </h2>
            </header>

            @if(!$Teacher->isEmpty())
                <div class="row">
                    @foreach($Teacher as $key=>$TeacherItem)
                    <div class="col-lg-3 col-md-4 align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="100">
                        <a href="{{ url('/teacher')."/".$TeacherItem->teacher_id }}">
                            <div class="member">
                                <div class="memberBox">
                                    <div class="member-img">
                                        @if($TeacherItem->teacher_image)
                                            <img src="{{asset($TeacherItem->teacher_image)}}" class="img-fluid" alt="">
                                        @else
                                            @if($TeacherItem->teacher_gendar == 1)
                                                <img src="{{asset('Site/assets/img/male.jpg')}}" class="img-fluid" alt="">
                                            @else
                                                <img src="{{asset('Site/assets/img/female.jpg')}}" class="img-fluid" alt="">
                                            @endif
                                        @endif
                                        <div class="social">
                                            @if($TeacherItem->twitter_link)
                                                <a href="{{ $TeacherItem->twitter_link }}"><i class="bi bi-twitter"></i></a>
                                            @endif
                                            @if($TeacherItem->facebook_link)
                                                <a href="{{ $TeacherItem->facebook_link }}"><i class="bi bi-facebook"></i></a>
                                            @endif
                                            @if($TeacherItem->facebook_link)
                                                <a href="{{ $TeacherItem->facebook_link }}"><i class="bi bi-instagram"></i></a>
                                            @endif
                                            @if($TeacherItem->linkedin_link)
                                                <a href="{{ $TeacherItem->linkedin_link }}"><i class="bi bi-linkedin"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                    <a href="{{ url('/teacher')."/".$TeacherItem->teacher_id }}">
                                        <div class="member-info">
                                            <h4>
                                                @if(session()->get('locale') == 'en')
                                                    {{ $TeacherItem->teacher_en_name }}
                                                @else
                                                    {{ $TeacherItem->teacher_bn_name }}
                                                @endif
                                            </h4>
                                            <span>
                                                @if(session()->get('locale') == 'en')
                                                    {{ $TeacherItem->designation_en_title }}
                                                @else
                                                    {{ $TeacherItem->designation_bn_title }}
                                                @endif
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center mt-4">
                        {{ $Teacher->onEachSide(3)->links('Admin.Common.Paginate') }}
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center mt-5 mb-5">
                        <h3>
                            @if(session()->get('locale') == 'en')
                                Data Not Found
                            @else
                                তথ্য পাওয়া যায়নি
                            @endif
                        </h3>
                    </div>
                </div>
           @endif

        </div>

    </section><!-- End Testimonials Section -->


@endsection


@section('SiteScript')

@endsection

@extends('Site.Layout.Main')

@if(session()->get('locale') == 'en')
    @section('title', $Teacher->teacher_en_name)
@section('description', Str::limit($Teacher->teacher_bn_description, 120))
@section('keywords', __('message.nav_teacher'))
@else
    @section('title', $Teacher->teacher_bn_name)
@section('description', Str::limit($Teacher->teacher_bn_description, 120))
@section('keywords', __('message.nav_teacher'))
@endif


@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li><a href="{{ url('/teacher') }}">{{ __('message.nav_teacher') }}</a></li>
                <li>{{ __('message.details_teacher') }}</li>
            </ol>
            <h2>{{ __('message.details_teacher') }}</h2>
        </div>
    </section><!-- End Breadcrumbs -->




    <section class="TeacherDetailsPage">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-12 mb-3">
                    <div class="DetailsImage">
                        @if($Teacher->teacher_image)
                            <img src="{{asset($Teacher->teacher_image)}}" class="img-fluid" alt="">
                        @else
                            @if($Teacher->teacher_gendar == 1)
                                <img src="{{asset('Site/assets/img/male.jpg')}}" class="img-fluid" alt="">
                            @else
                                <img src="{{asset('Site/assets/img/female.jpg')}}" class="img-fluid" alt="">
                            @endif
                        @endif
                    </div>
                </div>

                <div class="col-lg-8 col-md-7 col-12 mb-3">
                    <div class="DetailsText">
                        <h1>
                            @if(session()->get('locale') == 'en')
                                {{ $Teacher->teacher_en_name }}
                            @else
                                {{ $Teacher->teacher_bn_name }}
                            @endif
                        </h1>
                        <span>
                            @if(session()->get('locale') == 'en')
                                {{ $Teacher->designation_en_title }}
                            @else
                                {{ $Teacher->designation_bn_title }}
                            @endif
                        </span>
                        <div class="speech">
                            <p>
                                @if(session()->get('locale') == 'en')
                                    {!! $Teacher->teacher_en_speech !!}
                                @else
                                    {!! $Teacher->teacher_bn_speech !!}
                                @endif
                            </p>
                        </div>
                        <hr>
                        <div class="social">
                            <div class="ms-3 d-flex">
                                <a class="Icon" href="{{ $Teacher->facebook_link }}" target="_blank">
                                    <i class="bi bi-facebook" style="color: #0A81ED;"></i>
                                </a>
                                <a class="Icon" href="{{ $Teacher->twitter_link }}" target="_blank">
                                    <i class="bi bi-twitter" style="color: #1DA1F2;"></i>
                                </a>
                                <a class="Icon" href="{{ $Teacher->linkedin_link }}" target="_blank">
                                    <i class="bi bi-linkedin" style="color: #0077B5;"></i>
                                </a>
                                <a class="Icon" href="https://wa.me/+88{{ $Teacher->whatsapp_number }}" target="_blank">
                                    <i class="bi bi-whatsapp" style="color: #52CB5F;"></i>
                                </a>
                            </div>
                        </div>
                        <div class="socialCall">
                            <p><strong>{{ __('message.email') }}</strong> :{{$Teacher->email_address}}</p>
                            <p><strong>{{ __('message.phone') }}</strong> :{{$Teacher->phone_number}}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="CodePart">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-6 mb-2">
                    <div class="count-box">
                        <div class="text-center">
                            <span>{{ __('message.index_number') }}</span>
                            @if($Teacher->teacher_index)
                                <p>
                                    @if(session()->get('locale') == 'en')
                                        {{ $Teacher->teacher_index }}
                                    @else
                                        {{ $Teacher->teacher_index }}
                                    @endif
                                </p>
                            @else
                                <p>N/A</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mb-2">
                    <div class="count-box">
                        <div class="text-center">
                            <span>{{ __('message.gender') }}</span>
                            @if($Teacher->teacher_gender)
                                <p>
                                    @if($Teacher->teacher_gender == 1)
                                        @if(session()->get('locale') == 'en')
                                            Male
                                        @else
                                            পুরুষ
                                        @endif
                                    @else
                                        @if(session()->get('locale') == 'en')
                                            Female
                                        @else
                                            মহিলা
                                        @endif
                                    @endif
                                </p>
                            @else
                                <p>N/A</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mb-2">
                    <div class="count-box">
                        <div class="text-center">
                            <span> {{ __('message.joining_date') }} </span>
                            @if($Teacher->joining_date)
                                <p>
                                    @if(session()->get('locale') == 'en')
                                        {{ $Teacher->joining_date }}
                                    @else
                                        {{ $Teacher->joining_date }}
                                    @endif
                                </p>
                            @else
                                <p>N/A</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mb-2">
                    <div class="count-box">
                        <div class="text-center">
                            <span> {{ __('message.resign_date') }}</span>
                            @if($Teacher->resign_date)
                                <p>
                                    @if(session()->get('locale') == 'en')
                                        {{ $Teacher->resign_date }}
                                    @else
                                        {{ $Teacher->resign_date }}
                                    @endif
                                </p>
                            @else
                                <p>N/A</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="TeacherDetailsPage itemBoxDiv">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-12">
                    <div class="Details">
                        <p>
                            @if(session()->get('locale') == 'en')
                                {!! $Teacher->teacher_en_description !!}
                            @else
                                {!! $Teacher->teacher_bn_description !!}
                            @endif

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection


@section('SiteScript')

@endsection

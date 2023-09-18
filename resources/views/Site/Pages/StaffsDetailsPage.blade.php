@extends('Site.Layout.Main')

@if(session()->get('locale') == 'en')
    @section('title', $Staffs->staffs_en_name)
@section('description', Str::limit($Staffs->staffs_bn_description, 120))
@section('keywords', __('message.nav_staffs'))
@else
    @section('title', $Staffs->staffs_bn_name)
@section('description', Str::limit($Staffs->staffs_bn_description, 120))
@section('keywords', __('message.nav_staffs'))
@endif


@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li><a href="{{ url('/staffs') }}">{{ __('message.nav_staffs') }}</a></li>
                <li>{{ __('message.details_staffs') }}</li>
            </ol>
            <h2>{{ __('message.details_staffs') }}</h2>
        </div>
    </section><!-- End Breadcrumbs -->




    <section class="TeacherDetailsPage">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-12 mb-3">
                    <div class="DetailsImage">
                        @if($Staffs->staffs_image)
                            <img src="{{asset($Staffs->staffs_image)}}" class="img-fluid" alt="">
                        @else
                            @if($Staffs->staffs_gendar == 1)
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
                                {{ $Staffs->staffs_en_name }}
                            @else
                                {{ $Staffs->staffs_bn_name }}
                            @endif
                        </h1>
                        <span>
                            @if(session()->get('locale') == 'en')
                                {{ $Staffs->designation_en_title }}
                            @else
                                {{ $Staffs->designation_bn_title }}
                            @endif
                        </span>
                        <div class="speech">
                            <p>
                                @if(session()->get('locale') == 'en')
                                    {!! $Staffs->staffs_en_speech !!}
                                @else
                                    {!! $Staffs->staffs_bn_speech !!}
                                @endif
                            </p>
                        </div>
                        <hr>
                        <div class="social">
                            <div class="ms-3 d-flex">
                                <a class="Icon" href="{{ $Staffs->facebook_link }}" target="_blank">
                                    <i class="bi bi-facebook" style="color: #0A81ED;"></i>
                                </a>
                                <a class="Icon" href="{{ $Staffs->twitter_link }}" target="_blank">
                                    <i class="bi bi-twitter" style="color: #1DA1F2;"></i>
                                </a>
                                <a class="Icon" href="{{ $Staffs->linkedin_link }}" target="_blank">
                                    <i class="bi bi-linkedin" style="color: #0077B5;"></i>
                                </a>
                                <a class="Icon" href="https://wa.me/+88{{ $Staffs->whatsapp_number }}" target="_blank">
                                    <i class="bi bi-whatsapp" style="color: #52CB5F;"></i>
                                </a>
                            </div>
                        </div>
                        <div class="socialCall">
                            <p><strong>{{ __('message.email') }}</strong> :{{$Staffs->email_address}}</p>
                            <p><strong>{{ __('message.phone') }}</strong> :{{$Staffs->phone_number}}</p>
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
                            @if($Staffs->staffs_index)
                                <p>
                                    @if(session()->get('locale') == 'en')
                                        {{ $Staffs->staffs_index }}
                                    @else
                                        {{ $Staffs->staffs_index }}
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
                            @if($Staffs->staffs_gender)
                                <p>
                                    @if($Staffs->staffs_gender == 1)
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
                            @if($Staffs->joining_date)
                                <p>
                                    @if(session()->get('locale') == 'en')
                                        {{ $Staffs->joining_date }}
                                    @else
                                        {{ $Staffs->joining_date }}
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
                            @if($Staffs->resign_date)
                                <p>
                                    @if(session()->get('locale') == 'en')
                                        {{ $Staffs->resign_date }}
                                    @else
                                        {{ $Staffs->resign_date }}
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
                                {!! $Staffs->staffs_en_description !!}
                            @else
                                {!! $Staffs->staffs_bn_description !!}
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

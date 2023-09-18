@extends('Site.Layout.Main')

@if(session()->get('locale') == 'en')
    @section('title', $Member->member_en_name)
@section('description', Str::limit($Member->member_bn_description, 120))
@section('keywords', __('message.nav_member'))
@else
    @section('title', $Member->member_bn_name)
@section('description', Str::limit($Member->member_bn_description, 120))
@section('keywords', __('message.nav_member'))
@endif


@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li><a href="{{ url('/member') }}">{{ __('message.nav_member') }}</a></li>
                <li>{{ __('message.details_member') }}</li>
            </ol>
            <h2>{{ __('message.details_member') }}</h2>
        </div>
    </section><!-- End Breadcrumbs -->




    <section class="TeacherDetailsPage">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-12 mb-3">
                    <div class="DetailsImage">
                        @if($Member->member_image)
                            <img src="{{asset($Member->member_image)}}" class="img-fluid" alt="">
                        @else
                            @if($Member->member_gendar == 1)
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
                                {{ $Member->member_en_name }}
                            @else
                                {{ $Member->member_bn_name }}
                            @endif
                        </h1>
                        <span>
                            @if(session()->get('locale') == 'en')
                                {{ $Member->designation_en_title }}
                            @else
                                {{ $Member->designation_bn_title }}
                            @endif
                        </span>
                        <div class="speech">
                            <p>
                                @if(session()->get('locale') == 'en')
                                    {!! $Member->member_en_speech !!}
                                @else
                                    {!! $Member->member_bn_speech !!}
                                @endif
                            </p>
                        </div>
                        <hr>
                        <div class="social">
                            <div class="ms-3 d-flex">
                                <a class="Icon" href="{{ $Member->facebook_link }}" target="_blank">
                                    <i class="bi bi-facebook" style="color: #0A81ED;"></i>
                                </a>
                                <a class="Icon" href="{{ $Member->twitter_link }}" target="_blank">
                                    <i class="bi bi-twitter" style="color: #1DA1F2;"></i>
                                </a>
                                <a class="Icon" href="{{ $Member->linkedin_link }}" target="_blank">
                                    <i class="bi bi-linkedin" style="color: #0077B5;"></i>
                                </a>
                                <a class="Icon" href="https://wa.me/+88{{ $Member->whatsapp_number }}" target="_blank">
                                    <i class="bi bi-whatsapp" style="color: #52CB5F;"></i>
                                </a>
                            </div>
                        </div>
                        <div class="socialCall">
                            <p><strong>{{ __('message.email') }}</strong> :{{$Member->email_address}}</p>
                            <p><strong>{{ __('message.phone') }}</strong> :{{$Member->phone_number}}</p>
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
                            @if($Member->member_index)
                                <p>
                                    @if(session()->get('locale') == 'en')
                                        {{ $Member->member_index }}
                                    @else
                                        {{ $Member->member_index }}
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
                            <span>{{ __('message.period') }}</span>
                            @if($Member->period_id)
                                <p>
                                    @if(session()->get('locale') == 'en')
                                        {{ $Member->period_en_title }}
                                    @else
                                        {{ $Member->period_bn_title }}
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
                            @if($Member->joining_date)
                                <p>
                                    @if(session()->get('locale') == 'en')
                                        {{ $Member->joining_date }}
                                    @else
                                        {{ $Member->joining_date }}
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
                            @if($Member->resign_date)
                                <p>
                                    @if(session()->get('locale') == 'en')
                                        {{ $Member->resign_date }}
                                    @else
                                        {{ $Member->resign_date }}
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
                                {!! $Member->member_en_description !!}
                            @else
                                {!! $Member->member_bn_description !!}
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

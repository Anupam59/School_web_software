@extends('Site.Layout.Main')


@if(session()->get('locale') == 'en')
    @section('title', $Notice->notice_en_title)
    @section('description', Str::limit($Notice->notice_en_description, 120))
    @section('keywords', __('message.nav_notice'))
@else
    @section('title', $Notice->notice_bn_title)
    @section('description', Str::limit($Notice->notice_bn_description, 120))
    @section('keywords', __('message.nav_notice'))
@endif


@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li><a href="{{ url('/notice') }}">{{ __('message.nav_notice') }}</a></li>
                <li>{{ __('message.details_notice') }}</li>
            </ol>
            <h2>{{ __('message.details_notice') }}</h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <section class="DetailsPage">
        <div class="container" data-aos="fade-up">
            @if($Notice)

                <div class="row">
                    <header class="section-header">
                        <h1>
                            @if(session()->get('locale') == 'en')
                                {{ $Notice->notice_en_title }}
                            @else
                                {{ $Notice->notice_bn_title }}
                            @endif
                        </h1>

                    </header>
                    <div class="col-md-8 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <p><b>{{ __('message.date') }}</b> :
                            @if(session()->get('locale') == 'en')
                                {{ date('d M Y', strtotime($Notice->created_date)) }}
                            @else
                                {{ bn_date(date('d M Y', strtotime($Notice->created_date))) }}
                            @endif
                        </p>
                    </div>
                </div>

                @if($Extension)
                    @if($Extension != 'pdf')
                        <div class="row justify-content-center">
                            <div class="col-md-8 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                                <img src="{{asset($Notice->notice_file)}}" class="img-fluid" alt="">
                            </div>
                        </div>
                    @endif
                @endif


                <div class="row">
                    <div class="col-md-12 mb-3" data-aos="fade-up" data-aos-delay="200">
                        @if(session()->get('locale') == 'en')
                            {!! $Notice->notice_en_description !!}
                        @else
                            {!! $Notice->notice_bn_description !!}
                        @endif
                    </div>

                    @if($Notice->notice_link)
                        <div class="col-md-12 mb-3" data-aos="fade-up" data-aos-delay="200">
                            @if(session()->get('locale') == 'en')
                                <a href="{{asset($Notice->notice_link)}}" class="btn-link d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>Link </span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            @else
                                <a href="{{asset($Notice->notice_link)}}" class="btn-link d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>লিংক </span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    @endif


                </div>


                @if($Extension)
                    @if($Extension == 'pdf')
                        <div class="row justify-content-center">
                            <div class="col-md-10 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                                <iframe src="{{asset($Notice->notice_file)}}" style="width:100%; height:500px;" frameborder="0"></iframe>
                            </div>
                        </div>
                    @endif
                @endif


            @endif
        </div>
    </section>

@endsection


@section('SiteScript')

@endsection

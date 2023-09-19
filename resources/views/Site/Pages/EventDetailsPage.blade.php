@extends('Site.Layout.Main')

@if(session()->get('locale') == 'en')
    @section('title', $Event->event_en_title)
    @section('description', Str::limit($Event->event_en_description, 120))
    @section('keywords', __('message.nav_event'))
@else
    @section('title', $Event->corner_bn_title)
    @section('description', Str::limit($Event->event_bn_description, 120))
    @section('keywords', __('message.nav_event'))
@endif


@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li><a href="{{ url('/event') }}">{{ __('message.nav_event') }}</a></li>
                <li>{{ __('message.details_event') }}</li>
            </ol>
            <h2>{{ __('message.details_event') }}</h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <section class="DetailsPage">
        <div class="container" data-aos="fade-up">
            @if($Event)

                <div class="row">
                    <header class="section-header">
                        <h1>
                            @if(session()->get('locale') == 'en')
                                {{ $Event->event_en_title }}
                            @else
                                {{ $Event->event_bn_title }}
                            @endif
                        </h1>
                    </header>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{asset($Event->event_image)}}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-8 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <p>{{ __('message.date') }} :
                            @if(session()->get('locale') == 'en')
                                {{ date('d M Y', strtotime($Event->created_date)) }}
                            @else
                                {{ bn_date(date('d M Y', strtotime($Event->created_date))) }}
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3" data-aos="fade-up" data-aos-delay="200">
                        @if(session()->get('locale') == 'en')
                            {!! $Event->event_en_description !!}
                        @else
                            {!! $Event->event_bn_description !!}
                        @endif
                    </div>
                </div>

            @endif
        </div>
    </section>


    <!-- ======= Portfolio Section ======= -->
    <section class="GalleryPart GalleryPart2">
        <div class="container" data-aos="fade-up">
            @if(!$EventImage->isEmpty())


                <header class="section-header">
                    <h2>
                        @if(session()->get('locale') == 'en')
                            Event Gallery
                        @else
                            ইভেন্ট গ্যালারী
                        @endif
                    </h2>
                </header>

                <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200" id="GalleryLoopId">
                    @foreach($EventImage as $key=>$EventImageItem)
                        <div class="col-lg-3 col-md-6 portfolio-item filter-app">
                            <div class="portfolio-wrap">
                                <img src="{{asset($EventImageItem->event_img)}}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <div class="portfolio-links">
                                        <a href="{{asset($EventImageItem->event_img)}}" data-gallery="portfolioGallery" class="portfokio-lightbox" title="App 1"><i class="bi bi-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>




@endsection


@section('SiteScript')

@endsection

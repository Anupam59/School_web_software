@extends('Site.Layout.Main')

@if(session()->get('locale') == 'en')
    @section('title', $Gallery->gallery_en_title)
    @section('description', Str::limit($Gallery->gallery_en_description, 120))
    @section('keywords', __('message.nav_gallery'))
@else
    @section('title', $Gallery->gallery_bn_title)
    @section('description', Str::limit($Gallery->gallery_bn_description, 120))
    @section('keywords', __('message.nav_gallery'))
@endif

@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li><a href="{{ url('/gallery') }}">{{ __('message.nav_gallery') }}</a></li>
                <li>{{ __('message.details_gallery') }}</li>
            </ol>
            <h2>{{ __('message.details_gallery') }}</h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <section class="DetailsPage">
        <div class="container" data-aos="fade-up">
            @if($Gallery)

                <div class="row">
                    <header class="section-header">
                        <h1>
                            @if(session()->get('locale') == 'en')
                                {{ $Gallery->gallery_en_title }}
                            @else
                                {{ $Gallery->gallery_bn_title }}
                            @endif
                        </h1>
                    </header>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-7 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{asset($Gallery->gallery_image)}}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-7 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <p>{{ __('message.date') }} : {{ $Gallery->modified_date }}</p>
                    </div>
                </div>


            @endif
        </div>
    </section>


    <!-- ======= Portfolio Section ======= -->
    <section class="GalleryPart GalleryPart2">
        <div class="container" data-aos="fade-up">
            @if(!$GalleryImage->isEmpty())


                <header class="section-header">
                    <h2>
                        @if(session()->get('locale') == 'en')
                            Gallery Images
                        @else
                            গ্যালারী ইমেজ
                        @endif
                    </h2>
                </header>

                <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200" id="GalleryLoopId">
                    @foreach($GalleryImage as $key=>$GalleryImageItem)
                        <div class="col-lg-3 col-md-6 portfolio-item filter-app">
                            <div class="portfolio-wrap">
                                <img src="{{asset($GalleryImageItem->gallery_img)}}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <div class="portfolio-links">
                                        <a href="{{asset($GalleryImageItem->gallery_img)}}" data-gallery="portfolioGallery" class="portfokio-lightbox" title="App 1"><i class="bi bi-plus"></i></a>
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

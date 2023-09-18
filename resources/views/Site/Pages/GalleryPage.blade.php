@extends('Site.Layout.Main')

@if(session()->get('locale') == 'en')
    @section('title', __('message.nav_gallery'))
    @section('description',__('message.nav_gallery')." - ".$SiteCommon->site_description)
    @section('keywords', __('message.nav_gallery'))
@else
    @section('title', __('message.nav_gallery'))
    @section('description',__('message.nav_gallery')." - ".$SiteCommon->site_bn_description)
    @section('keywords', __('message.nav_gallery'))
@endif


@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li>{{ __('message.nav_gallery') }}</li>
            </ol>
            <h2>{{ __('message.nav_gallery') }}</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Section ======= -->
    <section class="GalleryPart">
        <div class="container" data-aos="fade-up">
            @if(!$Gallery->isEmpty())
                <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200" id="GalleryLoopId">
                    @foreach($Gallery as $key=>$GalleryItem)
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <div class="portfolio-wrap">
                                <img src="{{asset($GalleryItem->gallery_image)}}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>
                                        @if(session()->get('locale') == 'en')
                                            {{ $GalleryItem->gallery_en_title }}
                                        @else
                                            {{ $GalleryItem->gallery_bn_title }}
                                        @endif
                                    </h4>
                                    <div class="portfolio-links">
                                        <a href="{{asset($GalleryItem->gallery_image)}}" data-gallery="portfolioGallery" class="portfokio-lightbox" title="App 1"><i class="bi bi-plus"></i></a>
                                        <a href="{{ url('/gallery')."/".$GalleryItem->gallery_id }}" title="More Details"><i class="bi bi-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center mt-4">
                        {{ $Gallery->onEachSide(3)->links('Admin.Common.Paginate') }}
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center mt-5 mb-5">
                        <h3>Data Not Found</h3>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection


@section('SiteScript')

@endsection

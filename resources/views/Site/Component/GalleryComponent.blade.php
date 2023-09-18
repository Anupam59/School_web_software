
<!-- ======= Portfolio Section ======= -->
<section class="GalleryPart">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <a href="{{ url('/gallery') }}">
                <h2>
                    @if(session()->get('locale') == 'en')
                        Gallery
                    @else
                        গ্যালারী
                    @endif
                </h2>
            </a>
        </header>

        <div class="row d-none" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                    <li data-filter="*" class="filter-active">All</li>
                </ul>
            </div>
        </div>

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
        @endif
    </div>
</section><!-- End Portfolio Section -->


@section('GalleryScript')

@endsection



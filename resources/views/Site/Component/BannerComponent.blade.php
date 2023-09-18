<section class="BannerPart">
    <div class="container">
        @if(!$Banner->isEmpty())
            <div class="banner-slider swiper" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper-wrapper bannerFull" id="BannerLoopId">
                    @foreach($Banner as $key=>$BannerItem)
                        <div class="swiper-slide">
                            <div class="bannerDiv" data-aos="zoom-out" data-aos-delay="200">
                                <img src="{{asset($BannerItem->banner_image)}}" class="img-fluid" alt="">
                                <div class="bannerTitle">
                                    <h2>
                                        @if(session()->get('locale') == 'en')
                                            {{ $BannerItem->banner_en_title }}
                                        @else
                                            {{ $BannerItem->banner_bn_title }}
                                        @endif
                                    </h2>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->
                    @endforeach
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        @endif
    </div>
</section>

@section('BannerScript')
    <script>
        new Swiper('.banner-slider', {
            speed: 600,
            loop: true,
            autoplay: false,
            slidesPerView: 'auto',
            allowSlidePrev: true,
            allowSlideNext: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 40
                },

                1200: {
                    slidesPerView: 1,
                }
            }
        });
    </script>
@endsection



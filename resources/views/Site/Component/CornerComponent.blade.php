
<!-- ======= Testimonials Section ======= -->
<section class="CornerPart">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <a href="{{ url('/corner') }}">
                <h2>
                    @if(session()->get('locale') == 'en')
                        Corner
                    @else
                        কর্নার
                    @endif
                </h2>
            </a>
        </header>
        @if(!$Corner->isEmpty())
        <div class="corner-slider swiper" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper-wrapper" id="CornerLoopId">
                @foreach($Corner as $key=>$CornerItem)

                    <div class="swiper-slide">
                        <a href="{{ url('/corner')."/".$CornerItem->corner_id }}">
                            <div class="testimonial-item">
                                <div class="profile mt-auto">
                                    <img src="{{asset($CornerItem->corner_image)}}" class="testimonial-img" alt="">
                                    <h3>
                                        @if(session()->get('locale') == 'en')
                                            {{ $CornerItem->corner_en_title }}
                                        @else
                                            {{ $CornerItem->corner_bn_title }}
                                        @endif
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>

                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
        @endif
    </div>

</section><!-- End Testimonials Section -->


@section('CornerScript')
    <script>

        new Swiper('.corner-slider', {
            speed: 600,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            slidesPerView: 'auto',
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
                    slidesPerView: 3,
                }
            }
        });

    </script>
@endsection



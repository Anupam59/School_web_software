
<!-- ======= Testimonials Section ======= -->
<section class="teacherSpeech">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <a href="{{ url('/member') }}">
                <h2>
                    @if(session()->get('locale') == 'en')
                        Member
                    @else
                        সদস্য
                    @endif
                </h2>
            </a>
        </header>
        @if(!$Member->isEmpty())
            <div class="member-slider swiper" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper-wrapper" id="CornerLoopId">
                    @foreach($Member as $key=>$MemberItem)
                        <div class="swiper-slide">
                            <a href="{{ url('/member')."/".$MemberItem->member_id }}">
                                <div class="member">
                                    <div class="memberBox">
                                        <div class="member-img">
                                            @if($MemberItem->member_image)
                                                <img src="{{asset($MemberItem->member_image)}}" class="img-fluid" alt="">
                                            @else
                                                @if($MemberItem->member_gendar == 1)
                                                    <img src="{{asset('Site/assets/img/male.jpg')}}" class="img-fluid" alt="">
                                                @else
                                                    <img src="{{asset('Site/assets/img/female.jpg')}}" class="img-fluid" alt="">
                                                @endif
                                            @endif
                                            <div class="social">
                                                @if($MemberItem->twitter_link)
                                                    <a href="{{ $MemberItem->twitter_link }}"><i class="bi bi-twitter"></i></a>
                                                @endif
                                                @if($MemberItem->facebook_link)
                                                    <a href="{{ $MemberItem->facebook_link }}"><i class="bi bi-facebook"></i></a>
                                                @endif
                                                @if($MemberItem->facebook_link)
                                                    <a href="{{ $MemberItem->facebook_link }}"><i class="bi bi-instagram"></i></a>
                                                @endif
                                                @if($MemberItem->linkedin_link)
                                                    <a href="{{ $MemberItem->linkedin_link }}"><i class="bi bi-linkedin"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="member-info">
                                            <h4>
                                                @if(session()->get('locale') == 'en')
                                                    {{ $MemberItem->member_en_name }}
                                                @else
                                                    {{ $MemberItem->member_bn_name }}
                                                @endif
                                            </h4>
                                            <span>
                                                @if(session()->get('locale') == 'en')
                                                    {{ $MemberItem->designation_en_title }}
                                                @else
                                                    {{ $MemberItem->designation_bn_title }}
                                                @endif
                                            </span>
                                        </div>
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

</section>


@section('MemberScript')
    <script>

        new Swiper('.member-slider', {
            speed: 500,
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
                    slidesPerView: 4,
                }
            }
        });

    </script>
@endsection



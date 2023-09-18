
<!-- ======= Testimonials Section ======= -->
<section class="teacherSpeech">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <a href="{{ url('/teacher') }}">
                <h2>
                    @if(session()->get('locale') == 'en')
                        Teacher
                    @else
                        শিক্ষক
                    @endif
                </h2>
            </a>
        </header>
        @if(!$Teacher->isEmpty())
            <div class="teacher-slider swiper" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper-wrapper" id="CornerLoopId">
                    @foreach($Teacher as $key=>$TeacherItem)
                        <div class="swiper-slide">
                            <a href="{{ url('/teacher')."/".$TeacherItem->teacher_id }}">
                            <div class="member">
                                <div class="memberBox">
                                    <div class="member-img">
                                        @if($TeacherItem->teacher_image)
                                            <img src="{{asset($TeacherItem->teacher_image)}}" class="img-fluid" alt="">
                                        @else
                                            @if($TeacherItem->teacher_gendar == 1)
                                                <img src="{{asset('Site/assets/img/male.jpg')}}" class="img-fluid" alt="">
                                            @else
                                                <img src="{{asset('Site/assets/img/female.jpg')}}" class="img-fluid" alt="">
                                            @endif
                                        @endif
                                        <div class="social">
                                            @if($TeacherItem->twitter_link)
                                                <a href="{{ $TeacherItem->twitter_link }}"><i class="bi bi-twitter"></i></a>
                                            @endif
                                            @if($TeacherItem->facebook_link)
                                                <a href="{{ $TeacherItem->facebook_link }}"><i class="bi bi-facebook"></i></a>
                                            @endif
                                            @if($TeacherItem->facebook_link)
                                                <a href="{{ $TeacherItem->facebook_link }}"><i class="bi bi-instagram"></i></a>
                                            @endif
                                            @if($TeacherItem->linkedin_link)
                                                <a href="{{ $TeacherItem->linkedin_link }}"><i class="bi bi-linkedin"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="member-info">
                                        <h4>
                                            @if(session()->get('locale') == 'en')
                                                {{ $TeacherItem->teacher_en_name }}
                                            @else
                                                {{ $TeacherItem->teacher_bn_name }}
                                            @endif
                                        </h4>
                                        <span>
                                            @if(session()->get('locale') == 'en')
                                                {{ $TeacherItem->designation_en_title }}
                                            @else
                                                {{ $TeacherItem->designation_bn_title }}
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

</section><!-- End Testimonials Section -->


@section('TeacherScript')
    <script>

        new Swiper('.teacher-slider', {
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
                    slidesPerView: 4,
                }
            }
        });

    </script>
@endsection



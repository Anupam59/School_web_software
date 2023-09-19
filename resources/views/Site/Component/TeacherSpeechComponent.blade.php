<section class="teacherSpeech TeachHead">
    <div class="container" data-aos="fade-up">
        <div class="row">

            @if($TeacherFirst)
                <div class="col-lg-4 col-md-4 mb-3 align-items-stretch" data-aos="fade-up" data-aos-delay="100">

                    <div class="member">
                        <div class="memberBox">

                            <div class="member-img">
                                @if($TeacherFirst->teacher_image)
                                    <img src="{{asset($TeacherFirst->teacher_image)}}" class="img-fluid" alt="">
                                @else
                                    @if($TeacherFirst->teacher_gendar == 1)
                                        <img src="{{asset('Site/assets/img/male.jpg')}}" class="img-fluid" alt="">
                                    @else
                                        <img src="{{asset('Site/assets/img/female.jpg')}}" class="img-fluid" alt="">
                                    @endif
                                @endif
                            </div>

                            <div class="member-info">
                                <h2>
                                    @if(session()->get('locale') == 'en')
                                        {{ $TeacherFirst->teacher_en_name }}
                                    @else
                                        {{ $TeacherFirst->teacher_bn_name }}
                                    @endif
                                </h2>
                                <span>
                                 @if(session()->get('locale') == 'en')
                                        {{ $TeacherFirst->designation_en_title }}
                                    @else
                                        {{ $TeacherFirst->designation_bn_title }}
                                    @endif
                            </span>
                                <div class="social1">
                                    @if($TeacherFirst->twitter_link)
                                        <a href="{{ $TeacherFirst->twitter_link }}"><i class="bi bi-twitter"></i></a>
                                    @endif

                                    @if($TeacherFirst->facebook_link)
                                        <a href="{{ $TeacherFirst->facebook_link }}"><i class="bi bi-facebook"></i></a>
                                    @endif

                                    @if($TeacherFirst->facebook_link)
                                        <a href="{{ $TeacherFirst->facebook_link }}"><i class="bi bi-instagram"></i></a>
                                    @endif

                                    @if($TeacherFirst->linkedin_link)
                                        <a href="{{ $TeacherFirst->linkedin_link }}"><i class="bi bi-linkedin"></i></a>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="member-info-speech">
                            <p>
                                @if(session()->get('locale') == 'en')
                                    {!! substr_replace($TeacherFirst->teacher_en_speech, "<a href=".url('/teacher')."/".$TeacherFirst->teacher_id.">... Read More </a>", 300) !!}
                                @else
                                    {!! substr_replace($TeacherFirst->teacher_bn_speech, "<a href=".url('/teacher')."/".$TeacherFirst->teacher_id.">... আরো পড়ুন </a>", 500) !!}
                                @endif
                            </p>
                        </div>

                    </div>

                </div>
            @endif


            @if($TeacherSecond)
                <div class="col-lg-4 col-md-4 mb-3 align-items-stretch" data-aos="fade-up" data-aos-delay="100">

                    <div class="member">
                        <div class="memberBox">

                            <div class="member-img">
                                @if($TeacherSecond->teacher_image)
                                    <img src="{{asset($TeacherSecond->teacher_image)}}" class="img-fluid" alt="">
                                @else
                                    @if($TeacherSecond->teacher_gendar == 1)
                                        <img src="{{asset('Site/assets/img/male.jpg')}}" class="img-fluid" alt="">
                                    @else
                                        <img src="{{asset('Site/assets/img/female.jpg')}}" class="img-fluid" alt="">
                                    @endif
                                @endif
                            </div>

                            <div class="member-info">
                                <h2>
                                    @if(session()->get('locale') == 'en')
                                        {{ $TeacherSecond->teacher_en_name }}
                                    @else
                                        {{ $TeacherSecond->teacher_bn_name }}
                                    @endif
                                </h2>
                                <span>
                             @if(session()->get('locale') == 'en')
                                        {{ $TeacherSecond->designation_en_title }}
                                    @else
                                        {{ $TeacherSecond->designation_bn_title }}
                                    @endif
                        </span>
                                <div class="social1">
                                    @if($TeacherSecond->twitter_link)
                                        <a href="{{ $TeacherSecond->twitter_link }}"><i class="bi bi-twitter"></i></a>
                                    @endif

                                    @if($TeacherSecond->facebook_link)
                                        <a href="{{ $TeacherSecond->facebook_link }}"><i class="bi bi-facebook"></i></a>
                                    @endif

                                    @if($TeacherSecond->facebook_link)
                                        <a href="{{ $TeacherSecond->facebook_link }}"><i class="bi bi-instagram"></i></a>
                                    @endif

                                    @if($TeacherSecond->linkedin_link)
                                        <a href="{{ $TeacherSecond->linkedin_link }}"><i class="bi bi-linkedin"></i></a>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="member-info-speech">
                            <p>
                                @if(session()->get('locale') == 'en')
                                    {!! substr_replace($TeacherSecond->teacher_en_speech, "<a href=".url('/teacher')."/".$TeacherSecond->teacher_id.">... Read More </a>", 300) !!}
                                @else
                                    {!! substr_replace($TeacherSecond->teacher_bn_speech, "<a href=".url('/teacher')."/".$TeacherSecond->teacher_id.">... আরো পড়ুন </a>", 500) !!}
                                @endif
                            </p>
                        </div>

                    </div>

                </div>
            @endif


            @if($MemberFirst)
                <div class="col-lg-4 col-md-4 mb-3 align-items-stretch" data-aos="fade-up" data-aos-delay="100">

                    <div class="member">
                        <div class="memberBox">

                            <div class="member-img">
                                @if($MemberFirst->member_image)
                                    <img src="{{asset($MemberFirst->member_image)}}" class="img-fluid" alt="">
                                @else
                                    @if($MemberFirst->member_gendar == 1)
                                        <img src="{{asset('Site/assets/img/male.jpg')}}" class="img-fluid" alt="">
                                    @else
                                        <img src="{{asset('Site/assets/img/female.jpg')}}" class="img-fluid" alt="">
                                    @endif
                                @endif
                            </div>

                            <div class="member-info">
                                <h2>
                                    @if(session()->get('locale') == 'en')
                                        {{ $MemberFirst->member_en_name }}
                                    @else
                                        {{ $MemberFirst->member_bn_name }}
                                    @endif
                                </h2>
                                <span>
                                    @if(session()->get('locale') == 'en')
                                        {{ $MemberFirst->designation_en_title }}
                                    @else
                                        {{ $MemberFirst->designation_bn_title }}
                                    @endif
                                </span>
                                <div class="social1">
                                    @if($MemberFirst->twitter_link)
                                        <a href="{{ $MemberFirst->twitter_link }}"><i class="bi bi-twitter"></i></a>
                                    @endif

                                    @if($MemberFirst->facebook_link)
                                        <a href="{{ $MemberFirst->facebook_link }}"><i class="bi bi-facebook"></i></a>
                                    @endif

                                    @if($MemberFirst->facebook_link)
                                        <a href="{{ $MemberFirst->facebook_link }}"><i class="bi bi-instagram"></i></a>
                                    @endif

                                    @if($MemberFirst->linkedin_link)
                                        <a href="{{ $MemberFirst->linkedin_link }}"><i class="bi bi-linkedin"></i></a>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="member-info-speech">
                            <p>
                                @if(session()->get('locale') == 'en')
                                    {!! substr_replace($MemberFirst->member_en_speech, "<a href=".url('/member')."/".$MemberFirst->member_id.">... Read More </a>", 300) !!}
                                @else
                                    {!! substr_replace($MemberFirst->member_bn_speech, "<a href=".url('/member')."/".$MemberFirst->member_id.">... আরো পড়ুন </a>", 500) !!}
                                @endif
                            </p>
                        </div>

                    </div>

                </div>
            @endif


        </div>
    </div>
</section>

<!-- Topbar Start -->
<div class="container-fluid HeadDivTop d-flex" data-aos="fade-up">
    <div class="container d-flex">
        <div class="ms-3 d-flex">
            <a class="Icon" href="{{ $SiteCommon->site_fb_link }}" target="_blank">
                <i class="bi bi-facebook" style="color: #0A81ED;"></i>
            </a>
            <a class="Icon" href="{{ $SiteCommon->site_tw_link }}" target="_blank">
                <i class="bi bi-twitter" style="color: #1DA1F2;"></i>
            </a>
            <a class="Icon" href="{{ $SiteCommon->site_ig_link }}" target="_blank">
                <i class="bi bi-linkedin" style="color: #0077B5;"></i>
            </a>
            <a class="Icon" href="{{ $SiteCommon->site_yt_link }}" target="_blank">
                <i class="bi bi-youtube" style="color: #FF0000;"></i>
            </a>
        </div>

        <div class="ms-auto">
            <a class="btn btn-primary rounded-pill LangBtn" id="ChangeLanguage">
                @if(session()->get('locale') == 'en')
                    বাংলা
                @else
                    English
                @endif
            </a>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Topbar Start -->
<div class="container-fluid HeadDivLogo d-none d-lg-flex" data-aos="fade-up">
    <div class="container py-3">
        <div class="d-flex align-items-center">
            <div class="siteLogo">
                <a href="{{ url('/') }}">
                    <img src="{{asset($SiteCommon->site_logo)}}" class="img-fluid" alt="">
                </a>
            </div>

            <div class="siteNameDiv">
                <p class="school_estd"> ESTD : {{ $SiteCommon->site_estd }} </p>
                <a href="{{ url('/') }}">
                    @if($SiteCommon->site_en_name && $SiteCommon->site_bn_name)
                        <h1 class="SiteName">
                            @if(session()->get('locale') == 'en')
                                {{ $SiteCommon->site_en_name }}
                            @else
                                {{ $SiteCommon->site_bn_name }}
                            @endif
                        </h1>
                    @else
                        <h1 class="fw-bold m-0">Demo School Website</h1>
                    @endif
                </a>
                <p class="school_adds">
                    @if(session()->get('locale') == 'en')
                        {{ $SiteCommon->site_address }}
                    @else
                        {{ $SiteCommon->site_bn_address }}
                    @endif
                </p>
            </div>

            <div class="ms-auto d-flex align-items-center PhoneIconDiv">
                <a href="mailto:{{ $SiteCommon->site_email }}" target="_blank" class="ms-4"><i class="bi bi-envelope-fill PhoneIcon"></i>{{ $SiteCommon->site_email }}</a>
                <a href="tel:{{ $SiteCommon->site_contact }}" target="_blank" class="ms-4"><i class="bi bi-telephone-fill PhoneIcon"></i>{{ $SiteCommon->site_contact }}</a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid HeadNavBar sticky-top" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="{{ url('/') }}" class="navbar-brand d-lg-none">
                <img src="{{asset($SiteCommon->site_logo)}}" height="50px" width="50px" class="img-fluid" alt="">
                @if($SiteCommon->site_en_name && $SiteCommon->site_bn_name)
                    <h1 class="fw-bold">
                        @if(session()->get('locale') == 'en')
                            {{ $SiteCommon->site_en_name }}
                        @else
                            {{ $SiteCommon->site_bn_name }}
                        @endif
                    </h1>
                @else
                    <h1 class="fw-bold m-0">Demo School Website</h1>
                @endif
            </a>

            <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <a href="{{ url('/') }}" class="nav-item nav-link active">{{ __('message.nav_home') }}</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ __('message.nav_about') }}</a>
                        <div class="dropdown-menu DropdownMenu m-0">
                            <a href="{{ url('/page/about') }}" class="dropdown-item">{{ __('message.nav_about_us') }}</a>
                            <a href="{{ url('/page/founder') }}" class="dropdown-item">{{ __('message.nav_founder') }}</a>
                            <a href="{{ url('/page/history') }}" class="dropdown-item">{{ __('message.nav_history') }}</a>
                            <a href="{{ url('/page/our-vision') }}" class="dropdown-item">{{ __('message.nav_vision') }}</a>
                            <a href="{{ url('/page/campus-tour') }}" class="dropdown-item">{{ __('message.nav_campus_tour') }}</a>
                            <a href="{{ url('/page/achievements') }}" class="dropdown-item">{{ __('message.nav_achievements') }}</a>
                            <a href="{{ url('/page/honorable-chairman') }}" class="dropdown-item">{{ __('message.nav_chairman') }}</a>
                            <a href="{{ url('/page/our-principal') }}" class="dropdown-item">{{ __('message.nav_principal') }}</a>
                            <a href="{{ url('/member') }}" class="dropdown-item">{{ __('message.nav_administrator') }}</a>
                        </div>
                    </div>


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ __('message.nav_academic') }}</a>
                        <div class="dropdown-menu DropdownMenu m-0">
                            <a href="{{ url('/page/class-schedule') }}" class="dropdown-item">{{ __('message.nav_class_schedule') }}</a>
                            <a href="{{ url('/teacher') }}" class="dropdown-item">{{ __('message.nav_teacher') }}</a>
                            <a href="{{ url('/staffs') }}" class="dropdown-item">{{ __('message.nav_staffs') }}</a>
                            <a href="{{ url('/page/academic-rules') }}" class="dropdown-item">{{ __('message.nav_academic_rules') }}</a>
                            <a href="{{ url('/page/academic-calender') }}" class="dropdown-item">{{ __('message.nav_academic_calender') }}</a>
                            <a href="{{ url('/page/attendance-sheet') }}" class="dropdown-item">{{ __('message.nav_attendance_sheet') }}</a>
                            <a href="{{ url('/page/leave-information') }}" class="dropdown-item">{{ __('message.nav_leave_information') }}</a>
                        </div>
                    </div>


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ __('message.nav_admission') }}</a>
                        <div class="dropdown-menu DropdownMenu m-0">
                            <a href="{{ url('/page/why-study') }}" class="dropdown-item">{{ __('message.nav_why_study') }}</a>
                            <a href="{{ url('/page/how-to-apply') }}" class="dropdown-item">{{ __('message.nav_how_apply') }}</a>
                            <a href="{{ url('/page/admission-test') }}" class="dropdown-item">{{ __('message.nav_admission_test') }}</a>
                            <a href="{{ url('/page/admission-policy') }}" class="dropdown-item">{{ __('message.nav_admission_policy') }}</a>
                            <a href="{{ url('/page/registration-system') }}" class="dropdown-item">{{ __('message.nav_registration_system') }}</a>
                        </div>
                    </div>


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ __('message.nav_student') }}</a>
                        <div class="dropdown-menu DropdownMenu m-0">
                            <a href="{{ url('/page/tuition-fees') }}" class="dropdown-item">{{ __('message.nav_tuition_fees') }}</a>
                            <a href="{{ url('/page/exam-schedule') }}" class="dropdown-item">{{ __('message.nav_exam_schedule') }}</a>
                            <a href="{{ url('/page/exam-system') }}" class="dropdown-item">{{ __('message.nav_exam_system') }}</a>
                            <a href="{{ url('/page/role-regulation') }}" class="dropdown-item">{{ __('message.nav_role_regulation') }}</a>
                        </div>
                    </div>


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ __('message.nav_facilities') }}</a>
                        <div class="dropdown-menu DropdownMenu m-0">
                            <a href="{{ url('/page/library') }}" class="dropdown-item">{{ __('message.nav_library') }}</a>
                            <a href="{{ url('/page/play-ground') }}" class="dropdown-item">{{ __('message.nav_play_ground') }}</a>
                            <a href="{{ url('/page/physics-lab') }}" class="dropdown-item">{{ __('message.nav_physics_lab') }}</a>
                            <a href="{{ url('/page/biology-lab') }}" class="dropdown-item">{{ __('message.nav_biology_lab') }}</a>
                            <a href="{{ url('/page/ict-lab') }}" class="dropdown-item">{{ __('message.nav_ict_lab') }}</a>
                            <a href="{{ url('/page/chemistry-lab') }}" class="dropdown-item">{{ __('message.nav_chemistry_lab') }}</a>
                            <a href="{{ url('/page/co-curricular-activities') }}" class="dropdown-item">{{ __('message.nav_co_curricular_activities') }}</a>
                        </div>
                    </div>

                    <a href="{{ url('/notice') }}" class="nav-item nav-link active">{{ __('message.nav_notice') }}</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ __('message.nav_other') }}</a>
                        <div class="dropdown-menu DropdownMenu m-0">
                            <a href="{{ url('/news') }}" class="dropdown-item">{{ __('message.nav_news') }}</a>
                            <a href="{{ url('/corner') }}" class="dropdown-item">{{ __('message.nav_corner') }}</a>
                            <a href="{{ url('/event') }}" class="dropdown-item">{{ __('message.nav_event') }}</a>
                            <a href="{{ url('/gallery') }}" class="dropdown-item">{{ __('message.nav_gallery') }}</a>
                            <a href="{{ url('/page/routine') }}" class="dropdown-item">{{ __('message.nav_routine') }}</a>
                        </div>
                    </div>

                    <a href="{{ url('/contact') }}" class="nav-item nav-link">{{ __('message.nav_contact') }}</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->

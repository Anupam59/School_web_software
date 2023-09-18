@extends('Site.Layout.Main')


@if(session()->get('locale') == 'en')
    @section('title', __('message.nav_staffs'))
    @section('description',__('message.nav_staffs')." - ".$SiteCommon->site_description)
    @section('keywords', __('message.nav_staffs'))
@else
    @section('title', __('message.nav_staffs'))
    @section('description',__('message.nav_staffs')." - ".$SiteCommon->site_bn_description)
    @section('keywords', __('message.nav_staffs'))
@endif


@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li>{{ __('message.nav_staffs') }}</li>
            </ol>
            <h2>{{ __('message.nav_staffs') }}</h2>

        </div>
    </section><!-- End Breadcrumbs -->


    <section class="SearchPart">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <form action="{{ url('staffs') }}" method="get" class="formDiv">
                        <div class="row gy-4 justify-content-center">

                            <div class="col-md-4 ">
                                <label>Staffs Index Number</label>
                                <input type="text" class="form-control" value="{{ request()->query('index') }}" name="index" placeholder="Index Number" required>
                            </div>

                            <div class="col-md-3 text-center align-items-center">
                                <label class="invisible d-block" style="margin-bottom: 4px;">Search</label>
                                <input type="reset" value="Reset">
                                <input type="submit" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <section class="teacherSpeech">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>
                    @if(session()->get('locale') == 'en')
                        Staffs
                    @else
                        কর্মচারীবৃন্দ
                    @endif
                </h2>
            </header>

            @if(!$Staffs->isEmpty())
                <div class="row">
                    @foreach($Staffs as $key=>$StaffsItem)
                        <div class="col-lg-3 col-md-4 align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="100">
                            <a href="{{ url('/staffs')."/".$StaffsItem->staffs_id }}">
                                <div class="member">
                                    <div class="memberBox">
                                        <div class="member-img">
                                            @if($StaffsItem->staffs_image)
                                                <img src="{{asset($StaffsItem->staffs_image)}}" class="img-fluid" alt="">
                                            @else
                                                @if($StaffsItem->staffs_gendar == 1)
                                                    <img src="{{asset('Site/assets/img/male.jpg')}}" class="img-fluid" alt="">
                                                @else
                                                    <img src="{{asset('Site/assets/img/female.jpg')}}" class="img-fluid" alt="">
                                                @endif
                                            @endif
                                            <div class="social">
                                                @if($StaffsItem->twitter_link)
                                                    <a href="{{ $StaffsItem->twitter_link }}"><i class="bi bi-twitter"></i></a>
                                                @endif
                                                @if($StaffsItem->facebook_link)
                                                    <a href="{{ $StaffsItem->facebook_link }}"><i class="bi bi-facebook"></i></a>
                                                @endif
                                                @if($StaffsItem->facebook_link)
                                                    <a href="{{ $StaffsItem->facebook_link }}"><i class="bi bi-instagram"></i></a>
                                                @endif
                                                @if($StaffsItem->linkedin_link)
                                                    <a href="{{ $StaffsItem->linkedin_link }}"><i class="bi bi-linkedin"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        <a href="{{ url('/staffs')."/".$StaffsItem->staffs_id }}">
                                            <div class="member-info">
                                                <h4>
                                                    @if(session()->get('locale') == 'en')
                                                        {{ $StaffsItem->staffs_en_name }}
                                                    @else
                                                        {{ $StaffsItem->staffs_bn_name }}
                                                    @endif
                                                </h4>
                                                <span>
                                                @if(session()->get('locale') == 'en')
                                                        {{ $StaffsItem->designation_en_title }}
                                                    @else
                                                        {{ $StaffsItem->designation_bn_title }}
                                                    @endif
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center mt-4">
                        {{ $Staffs->onEachSide(3)->links('Admin.Common.Paginate') }}
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center mt-5 mb-5">
                        <h3>
                            @if(session()->get('locale') == 'en')
                                Data Not Found
                            @else
                                তথ্য পাওয়া যায়নি
                            @endif
                        </h3>
                    </div>
                </div>
            @endif

        </div>

    </section><!-- End Testimonials Section -->


@endsection


@section('SiteScript')

@endsection

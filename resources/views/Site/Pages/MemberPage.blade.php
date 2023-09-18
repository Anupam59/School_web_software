@extends('Site.Layout.Main')


@if(session()->get('locale') == 'en')
    @section('title', __('message.nav_member'))
    @section('description',__('message.nav_member')." - ".$SiteCommon->site_description)
    @section('keywords', __('message.nav_member'))
@else
    @section('title', __('message.nav_member'))
    @section('description',__('message.nav_member')." - ".$SiteCommon->site_bn_description)
    @section('keywords', __('message.nav_member'))
@endif


@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li>{{ __('message.nav_member') }}</li>
            </ol>
            <h2>{{ __('message.nav_member') }}</h2>

        </div>
    </section><!-- End Breadcrumbs -->



    <style>
        .periodClass{
            padding: 10px 15px;
            border: none;
            border-radius: 0;
        }
        .periodClass:focus{
            padding: 10px 15px;
            border: none;
            border-radius: 0;
            box-shadow: unset;
        }

    </style>



    <section class="SearchPart">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <form action="{{ url('member') }}" method="get" class="formDiv">
                        <div class="row gy-4 justify-content-center">

                            <div class="col-md-4 mt-1">
                                <label>Member Index Number</label>
                                <input type="text" class="form-control" value="{{ request()->query('index') }}" name="index" placeholder="Index Number">
                            </div>

                            <div class="col-md-4 mt-1">
                                <label>Member Period</label>
                                <select class="form-control periodClass" id="period_id" name="period_id">
                                    @if($Period)
                                        @foreach($Period as $PeriodItem)
                                            <option value="{{ $PeriodItem->period_id }}"> {{ $PeriodItem->period_en_title }}</option>
                                        @endforeach
                                    @else

                                    @endif
                                </select>
                            </div>

                            <div class="col-md-3 mt-1 text-center align-items-center">
                                <label class="invisible d-block" style="margin-bottom: 4px;">Search</label>
                                <input type="reset" id="reset" value="Reset">
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
                        Member
                    @else
                        সদস্য
                    @endif
                </h2>
            </header>

            @if(!$Member->isEmpty())
                <div class="row">
                    @foreach($Member as $key=>$MemberItem)
                        <div class="col-lg-3 col-md-4 align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="100">
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
                                                    <a href="{{ $MemberItem->twitter_link }}" target="_blank"><i class="bi bi-twitter"></i></a>
                                                @endif
                                                @if($MemberItem->facebook_link)
                                                    <a href="{{ $MemberItem->facebook_link }}" target="_blank"><i class="bi bi-facebook"></i></a>
                                                @endif
                                                @if($MemberItem->facebook_link)
                                                    <a href="{{ $MemberItem->facebook_link }}" target="_blank"><i class="bi bi-instagram"></i></a>
                                                @endif
                                                @if($MemberItem->linkedin_link)
                                                    <a href="{{ $MemberItem->linkedin_link }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        <a href="{{ url('/member')."/".$MemberItem->member_id }}">
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
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center mt-4">
                        {{ $Member->onEachSide(3)->links('Admin.Common.Paginate') }}
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

        <input type="hidden" id="getPeriodId" class="form-control" value="{{ request()->query('period_id') }}">
        <input type="hidden" id="StatusPeriodId" class="form-control" value="{{ $PeriodStatus->period_id }}">
    </section><!-- End Testimonials Section -->


@endsection


@section('SiteScript')
    <script>

        $('#reset').click(function(){
            window.location.replace("/member");
        });

        PeriodShow();
        function PeriodShow(){
            var getPeriodId = $('#getPeriodId').val();
            var StatusPeriodId = $('#StatusPeriodId').val();
            if(getPeriodId){
                $("#period_id").val(getPeriodId).change();
            }else {
                $("#period_id").val(StatusPeriodId).change();
            }
        }

    </script>
@endsection

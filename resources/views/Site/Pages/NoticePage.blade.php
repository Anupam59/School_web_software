@extends('Site.Layout.Main')


@if(session()->get('locale') == 'en')
    @section('title', __('message.nav_notice'))
    @section('description',__('message.nav_notice')." - ".$SiteCommon->site_description)
    @section('keywords', __('message.nav_notice'))
@else
    @section('title', __('message.nav_notice'))
    @section('description',__('message.nav_notice')." - ".$SiteCommon->site_bn_description)
    @section('keywords', __('message.nav_notice'))
@endif


@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li>{{ __('message.nav_notice') }}</li>
            </ol>
            <h2>{{ __('message.nav_notice') }}</h2>
        </div>
    </section>


    <section class="SearchPart">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <form action="{{ url('notice') }}" method="get" class="formDiv">
                        <div class="row gy-4 justify-content-center">
                            <div class="col-md-4">
                                <label>Start Date</label>
                                <input type="date" class="form-control" value="{{ request()->query('start_date') }}" name="start_date" placeholder="Start Date" required>
                            </div>
                            <div class="col-md-4 ">
                                <label>End Date</label>
                                <input type="date" class="form-control" value="{{ request()->query('end_date') }}" name="end_date" placeholder="End Date" required>
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


    <!-- ======= Features Section ======= -->
    <section class="NoticePart">
        <div class="container" data-aos="fade-up">
            @if(!$Notice->isEmpty())
            <div class="row">
                @foreach($Notice as $key=>$NoticeItem)
                    <div class="col-md-12 mb-3" data-aos="zoom-out" data-aos-delay="200">
                        <a href="{{ url('/notice')."/".$NoticeItem->notice_id }}">
                            <div class="feature-box">
                                <div class="CheckText">
                                    <i class="bi bi-check"></i>
                                    <h3>
                                        @if(session()->get('locale') == 'en')
                                            {{ $NoticeItem->notice_en_title }}
                                        @else
                                            {{ $NoticeItem->notice_bn_title }}
                                        @endif
                                    </h3>
                                </div>
                                @if($NoticeItem->notice_file)
                                    <div class="checkDown">
                                        <span><i class="bi bi-download"></i></span>
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col d-flex align-items-center justify-content-center mt-4">
                    {{ $Notice->onEachSide(3)->links('Admin.Common.Paginate') }}
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
    </section><!-- End Features Section -->


@endsection


@section('SiteScript')

@endsection

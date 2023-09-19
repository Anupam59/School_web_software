@extends('Site.Layout.Main')

@if(session()->get('locale') == 'en')
    @section('title', __('message.nav_news'))
    @section('description',__('message.nav_news')." - ".$SiteCommon->site_description)
    @section('keywords', __('message.nav_news'))
@else
    @section('title', __('message.nav_news'))
    @section('description',__('message.nav_news')." - ".$SiteCommon->site_bn_description)
    @section('keywords', __('message.nav_news'))
@endif


@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li>{{ __('message.nav_news') }}</li>
            </ol>
            <h2>{{ __('message.nav_news') }}</h2>

        </div>
    </section><!-- End Breadcrumbs -->


    <section class="SearchPart">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <form action="{{ url('news') }}" method="get" class="formDiv">
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


    <section class="NewsPart">
        <div class="container" data-aos="fade-up">

            @if(!$News->isEmpty())
            <div class="row">

                @foreach($News as $key=>$NewsItem)
                <div class="col-lg-4 mb-3">
                    <a href="{{ url('/news')."/".$NewsItem->news_id }}">
                        <div class="post-box">
                            <div class="post-img"><img src="{{asset($NewsItem->news_image)}}" class="img-fluid" alt=""></div>
                            <span class="post-date">
                                @if(session()->get('locale') == 'en')
                                    {{ date('d M Y', strtotime($NewsItem->created_date)) }}
                                @else
                                    {{ bn_date(date('d M Y', strtotime($NewsItem->created_date))) }}
                                @endif
                            </span>
                            <h3 class="post-title">
                                @if(session()->get('locale') == 'en')
                                    {{ $NewsItem->news_en_title }}
                                @else
                                    {{ $NewsItem->news_bn_title }}
                                @endif
                            </h3>
                            <a href="{{ url('/news')."/".$NewsItem->news_id }}" class="readmore stretched-link mt-auto"><span>{{ __('message.read_more') }}</span><i class="bi bi-arrow-right"></i></a>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col d-flex align-items-center justify-content-center mt-4">
                    {{ $News->onEachSide(3)->links('Admin.Common.Paginate') }}
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
    </section><!-- End Recent Blog Posts Section -->


@endsection


@section('SiteScript')

@endsection

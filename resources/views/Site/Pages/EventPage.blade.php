@extends('Site.Layout.Main')

@if(session()->get('locale') == 'en')
    @section('title', __('message.nav_event'))
    @section('description',__('message.nav_event')." - ".$SiteCommon->site_description)
    @section('keywords', __('message.nav_event'))
@else
    @section('title', __('message.nav_event'))
    @section('description',__('message.nav_event')." - ".$SiteCommon->site_bn_description)
    @section('keywords', __('message.nav_event'))
@endif

@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li>{{ __('message.nav_event') }}</li>
            </ol>
            <h2>{{ __('message.nav_event') }}</h2>

        </div>
    </section><!-- End Breadcrumbs -->




    <section class="SearchPart">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <form action="{{ url('event') }}" method="get" class="formDiv">
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




    <section class="valuesPart">
        <div class="container" data-aos="fade-up">

            @if(!$Event->isEmpty())
                <div class="row">
                    @foreach($Event as $key=>$EventItem)
                        <div class="col-lg-4 mb-3" data-aos="fade-up" data-aos-delay="200">
                            <a href="{{ url('/event')."/".$EventItem->event_id }}">
                                <div class="box">
                                    <img src="{{asset($EventItem->event_image)}}" class="img-fluid" alt="">
                                    <span class="post-date">{{ $EventItem->created_date }}</span>
                                    <h3>
                                        @if(session()->get('locale') == 'en')
                                            {{ $EventItem->event_en_title }}
                                        @else
                                            {{ $EventItem->event_bn_title }}
                                        @endif
                                    </h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center mt-4">
                        {{ $Event->onEachSide(3)->links('Admin.Common.Paginate') }}
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

    </section>






@endsection


@section('SiteScript')

@endsection

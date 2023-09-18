@extends('Site.Layout.Main')

@if(session()->get('locale') == 'en')
    @section('title', __('message.nav_corner'))
    @section('description',__('message.nav_corner')." - ".$SiteCommon->site_description)
    @section('keywords', '')
@else
    @section('title', __('message.nav_corner'))
    @section('description',__('message.nav_corner')." - ".$SiteCommon->site_bn_description)
    @section('keywords', '')
@endif

@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li>{{ __('message.nav_corner') }}</li>
            </ol>
            <h2>{{ __('message.nav_corner') }}</h2>
        </div>
    </section><!-- End Breadcrumbs -->



    <section class="SearchPart">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <form action="{{ url('corner') }}" method="get" class="formDiv">
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

            @if(!$Corner->isEmpty())
                <div class="row">
                    @foreach($Corner as $key=>$CornerItem)
                        <div class="col-lg-4 mb-3" data-aos="fade-up" data-aos-delay="200">
                            <a href="{{ url('/corner')."/".$CornerItem->corner_id }}">
                                <div class="box">
                                    <img src="{{asset($CornerItem->corner_image)}}" class="img-fluid" alt="">
                                    <h3>
                                        @if(session()->get('locale') == 'en')
                                            {{ $CornerItem->corner_en_title }}
                                        @else
                                            {{ $CornerItem->corner_bn_title }}
                                        @endif
                                    </h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col d-flex align-items-center justify-content-center mt-4">
                        {{ $Corner->onEachSide(3)->links('Admin.Common.Paginate') }}
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

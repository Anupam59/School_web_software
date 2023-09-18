@extends('Site.Layout.Main')

@if(session()->get('locale') == 'en')
    @section('title', $Corner->corner_en_title)
    @section('description', Str::limit($Corner->corner_en_description, 120))
    @section('keywords', '')
@else
    @section('title', $Corner->corner_bn_title)
    @section('description', Str::limit($Corner->corner_bn_description, 120))
    @section('keywords', '')
@endif


@section('SiteContent')


    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li><a href="{{ url('/corner') }}">{{ __('message.nav_corner') }}</a></li>
                <li>{{ __('message.details_corner') }}</li>
            </ol>
            <h2>{{ __('message.details_corner') }}</h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <section class="DetailsPage">
        <div class="container" data-aos="fade-up">
            @if($Corner)

                <div class="row">
                    <header class="section-header">
                        <h1>
                            @if(session()->get('locale') == 'en')
                                {{ $Corner->corner_en_title }}
                            @else
                                {{ $Corner->corner_bn_title }}
                            @endif
                        </h1>
                    </header>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{asset($Corner->corner_image)}}" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3" data-aos="fade-up" data-aos-delay="200">
                            @if(session()->get('locale') == 'en')
                                {!! $Corner->corner_en_description !!}
                            @else
                                {!! $Corner->corner_bn_description !!}
                            @endif
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection


@section('SiteScript')

@endsection

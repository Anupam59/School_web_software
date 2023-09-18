@extends('Site.Layout.Main')


@if(session()->get('locale') == 'en')
    @section('title', $News->news_en_title)
    @section('description', Str::limit($News->news_en_description, 120))
    @section('keywords', __('message.nav_news'))
@else
    @section('title', $News->news_bn_title)
    @section('description', Str::limit($News->news_bn_description, 120))
    @section('keywords', __('message.nav_news'))
@endif


@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li><a href="{{ url('/news') }}">{{ __('message.nav_news') }}</a></li>
                <li>{{ __('message.details_news') }}</li>
            </ol>
            <h2>{{ __('message.details_news') }}</h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <section class="DetailsPage">
        <div class="container" data-aos="fade-up">
            @if($News)

                <div class="row">
                    <header class="section-header">
                        <h1>
                            @if(session()->get('locale') == 'en')
                                {{ $News->news_en_title }}
                            @else
                                {{ $News->news_bn_title }}
                            @endif
                        </h1>
                    </header>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{asset($News->news_image)}}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-8 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <p>{{ __('message.date') }} : {{ $News->modified_date }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3" data-aos="fade-up" data-aos-delay="200">
                        @if(session()->get('locale') == 'en')
                            {!! $News->news_en_description !!}
                        @else
                            {!! $News->news_bn_description !!}
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection


@section('SiteScript')

@endsection

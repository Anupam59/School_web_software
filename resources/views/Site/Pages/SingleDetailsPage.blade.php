@extends('Site.Layout.Main')

@if(session()->get('locale') == 'en')
    @section('title', $Page->page_en_title)
    @section('description', Str::limit($Page->page_en_description, 120))
    @section('keywords', $Page->page_en_title)
@else
    @section('title', $Page->page_bn_title)
    @section('description', Str::limit($Page->page_bn_description, 120))
    @section('keywords', $Page->page_en_title)
@endif


@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li>
                    @if(session()->get('locale') == 'en')
                        {{ $Page->page_en_title }}
                    @else
                        {{ $Page->page_bn_title }}
                    @endif
                </li>
            </ol>
            <h2>
                @if(session()->get('locale') == 'en')
                    {{ $Page->page_en_title }}
                @else
                    {{ $Page->page_bn_title }}
                @endif
            </h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <section class="DetailsPage">
        <div class="container" data-aos="fade-up">
            @if($Page)

                <div class="row">
                    <header class="section-header">
                        <h1>
                            @if(session()->get('locale') == 'en')
                                {{ $Page->page_en_title }}
                            @else
                                {{ $Page->page_bn_title }}
                            @endif
                        </h1>
                    </header>
                </div>

                @if($Extension)
                    @if($Extension != 'pdf')
                        <div class="row justify-content-center">
                            <div class="col-md-8 mb-5 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                                <img src="{{asset($Page->page_file)}}" class="img-fluid" alt="">
                            </div>
                        </div>
                    @endif
                @endif


                <div class="row">
                    <div class="col-md-12 mb-3" data-aos="fade-up" data-aos-delay="200">
                        @if(session()->get('locale') == 'en')
                            {!! $Page->page_en_description !!}
                        @else
                            {!! $Page->page_bn_description !!}
                        @endif
                    </div>

                    @if($Page->page_link)
                        <div class="col-md-12 mb-3" data-aos="fade-up" data-aos-delay="200">
                            @if(session()->get('locale') == 'en')
                                <a href="{{asset($Page->page_link)}}" class="btn-link d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>Link </span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            @else
                                <a href="{{asset($Page->page_link)}}" class="btn-link d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>লিংক </span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>


                @if($Extension)
                    @if($Extension == 'pdf')
                        <div class="row justify-content-center">
                            <div class="col-md-10 mb-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                                <iframe src="{{asset($Page->page_file)}}" style="width:100%; height:500px;" frameborder="0"></iframe>
                            </div>
                        </div>
                    @endif
                @endif


            @endif
        </div>
    </section>

@endsection


@section('SiteScript')

@endsection

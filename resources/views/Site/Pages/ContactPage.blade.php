@extends('Site.Layout.Main')

@if(session()->get('locale') == 'en')
    @section('title', __('message.nav_contact'))
    @section('description',__('message.nav_contact'))
    @section('keywords', __('message.nav_contact'))
@else
    @section('title', __('message.nav_contact'))
    @section('description',__('message.nav_contact'))
    @section('keywords', __('message.nav_contact'))
@endif

@section('SiteContent')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{ url('/') }}">{{ __('message.nav_home') }}</a></li>
                <li>{{ __('message.nav_contact') }}</li>
            </ol>
            <h2>{{ __('message.nav_contact') }}</h2>
        </div>
    </section><!-- End Breadcrumbs -->


    <section id="contact" class="contact">

        <div class="container aos-init aos-animate" data-aos="fade-up">

            <header class="section-header">
                <h2>{{ __('message.nav_contact') }}</h2>
            </header>

            <div class="row gy-4">

                <div class="col-lg-6">

                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-geo-alt"></i>
                                <h3>{{ __('message.address') }}</h3>
                                <p>
                                    @if(session()->get('locale') == 'en')
                                        {{ $SiteCommon->site_address }}
                                    @else
                                        {{ $SiteCommon->site_bn_address }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-telephone"></i>
                                <h3>{{ __('message.phone') }}</h3>
                                <p>{{ $SiteCommon->site_contact }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-envelope"></i>
                                <h3>{{ __('message.email') }}</h3>
                                <p>{{ $SiteCommon->site_email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-clock"></i>
                                <h3>{{ __('message.time') }}</h3>
                                <p>
                                    @if(session()->get('locale') == 'en')
                                        {{ $SiteCommon->site_en_open_time }}
                                    @else
                                        {{ $SiteCommon->site_bn_open_time }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6">
                    <div class="">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3623.9996597622185!2d91.36573357450385!3d24.72689195059084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375125df3b494ae5%3A0xa21e6f386c463276!2sDhal%20Public%20High%20School!5e0!3m2!1sen!2sbd!4v1694975338878!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </div>

        </div>

    </section>


@endsection


@section('SiteScript')

@endsection

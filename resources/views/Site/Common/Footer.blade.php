<!-- ======= Footer ======= -->
<footer id="footer" class="footer">


    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                        <img src="{{asset($SiteCommon->site_logo)}}" alt="">
                    </a>
                    <a href="{{ url('/') }}">
                        @if($SiteCommon->site_en_name && $SiteCommon->site_bn_name)
                            <h1 class="SiteName">
                                @if(session()->get('locale') == 'en')
                                    {{ $SiteCommon->site_en_name }}
                                @else
                                    {{ $SiteCommon->site_bn_name }}
                                @endif
                            </h1>
                        @else
                            <h1 class="fw-bold m-0">Demo School Website</h1>
                        @endif
                    </a>
                    <div class="social-links mt-3">
                        <a href="{{ $SiteCommon->site_tw_link }}" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="{{ $SiteCommon->site_fb_link }}" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $SiteCommon->site_yt_link }}" target="_blank" class="youtube"><i class="bi bi-youtube"></i></a>
                        <a href="{{ $SiteCommon->site_ig_link }}" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-7 col-12 footer-links">
                    <h4>Quick Links</h4>
                    @if($QuickLink)
                        <div class="row linkDiv">
                            @foreach($QuickLink as $key=>$QuickLinkItem)
                                <div class="col-md-4 col-6">
                                    <ul>
                                        <li>
                                            <i class="bi bi-chevron-right"></i>
                                            <a href="{{ $QuickLinkItem->link_url }}" target="_blank">
                                                @if(session()->get('locale') == 'en')
                                                    {{ $QuickLinkItem->link_en_title }}
                                                @else
                                                    {{ $QuickLinkItem->link_bn_title }}
                                                @endif
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>






                <div class="d-none col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>
                        A108 Adam Street <br>
                        New York, NY 535022<br>
                        United States <br><br>
                        <strong>Phone:</strong> +1 5589 55488 55<br>
                        <strong>Email:</strong> info@example.com<br>
                    </p>
                </div>


            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            @if(session()->get('locale') == 'en')
                &copy; Copyright <strong><span>{{ $SiteCommon->site_en_name }}</span></strong>. All Rights Reserved
            @else
                &copy; কপিরাইট <strong><span>{{ $SiteCommon->site_bn_name }}</span></strong>. সমস্ত অধিকার সংরক্ষিত
            @endif
        </div>
        <div class="credits">
            @if(session()->get('locale') == 'en')
                Developed by - <a href="#">Anupam Talukdar</a>
            @else
                তথ্যপ্রযুক্তি সহযোগী - <a href="#">অনুপম তালুকদার</a>
            @endif
        </div>
    </div>
</footer>

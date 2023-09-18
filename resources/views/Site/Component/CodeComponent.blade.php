<section class="CodePart">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-6 mb-2">
                <div class="count-box">
                    <div class="text-center">
                        <span> EIIN </span>
                        @if($SiteCommon->site_eiin)
                            <p>{{ $SiteCommon->site_eiin }}</p>
                        @else
                            <p>N/A</p>
                        @endif


                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-2">
                <div class="count-box">
                    <div class="text-center">
                        <span> Institute Code </span>
                        @if($SiteCommon->site_institute_code)
                            <p>{{ $SiteCommon->site_institute_code }}</p>
                        @else
                            <p>N/A</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-2">
                <div class="count-box">
                    <div class="text-center">
                        <span> Center Code </span>
                        @if($SiteCommon->site_center_code)
                            <p>{{ $SiteCommon->site_center_code }}</p>
                        @else
                            <p>N/A</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-2">
                <div class="count-box">
                    <div class="text-center">
                        <span> Estd </span>
                        @if($SiteCommon->site_estd)
                            <p>{{ $SiteCommon->site_estd }}</p>
                        @else
                            <p>N/A</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    @if(session()->get('locale') == 'en')
        <title> @yield('title') - {{ $SiteCommon->site_en_name }}</title>
        <meta property="og:title" content="@yield('title') - {{ $SiteCommon->site_en_name }}"/>
        <meta name="description" content="@yield('description')"/>
        <meta name="keywords" content="@yield('keywords'),{{ $SiteCommon->site_keyword }}">
        <meta property="og:keywords" content="@yield('keywords'),{{ $SiteCommon->site_keyword }}">
        <meta property="og:image" content="{{asset($SiteCommon->site_logo)}}"/>
    @else
        <title> @yield('title') - {{ $SiteCommon->site_bn_name }}</title>
        <meta property="og:title" content="@yield('title') - {{ $SiteCommon->site_bn_name }}"/>
        <meta name="description" content="@yield('description')"/>
        <meta name="keywords" content="@yield('keywords'),{{ $SiteCommon->site_keyword }}">
        <meta property="og:keywords" content="@yield('keywords'),{{ $SiteCommon->site_keyword }}">
        <meta property="og:image" content="{{asset($SiteCommon->site_logo)}}"/>
    @endif
    <meta name="theme-color" content="#92278F" />



    <!-- Favicons -->
    <link href="{{asset($SiteCommon->site_logo)}}" rel="icon">
    <link href="{{asset($SiteCommon->site_logo)}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{asset('Site/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('Site/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('Site/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('Site/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('Site/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('Site/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('Site/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('Site/assets/css/responsive.css')}}" rel="stylesheet">

</head>

<body>


<!-- Spinner Start -->
<div id="spinner"
     class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
</div>
<!-- Spinner End -->


@include('Site.Common.CommonValue')
@include('Site.Common.Header')
<main id="main">
    @yield('SiteContent')
</main><!-- End #main -->
@include('Site.Common.Footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- jQuery -->
<script src="{{asset('Admin/plugins/jquery/jquery.min.js')}}"></script>

<!-- Vendor JS Files -->
<script src="{{asset('Site/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
<script src="{{asset('Site/assets/vendor/aos/aos.js')}}"></script>
<script src="{{asset('Site/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('Site/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('Site/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('Site/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('Site/assets/vendor/php-email-form/validate.js')}}"></script>

<!-- axios.min.js -->
<script src="{{asset('Admin/dist/js/axios.min.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{asset('Site/assets/js/main.js')}}"></script>



<script>

    $("#ChangeLanguage").click(function(){
        var url =  window.location.href.split('?')[0];
        var dataLg= $('#locale').val();
        if(dataLg == 'en'){
            window.location.replace("/LanguageChange?url="+url+"&lang=bn");
        }else {
            window.location.replace("/LanguageChange?url="+url+"&lang=en");
        }
    });


    getLg();
    function getLg(){
        var url = window.location.href
        var dataLg= $('#locale').val();
        var langVar= $('#langVar').val();
        if(dataLg == 'en' && langVar == 'bn'){
            window.location.replace("/LanguageChange?url="+url+"&lang=bn");
        }
        else if(dataLg == 'bn' && langVar != 'bn'){
            if(url.includes("?") == false){
                window.history.replaceState("", "", url+"?lang=bn");
            }else{
                window.history.replaceState("", "", url+"&lang=bn");
            }
        }
    }
</script>

@yield('SiteScript')
</body>
</html>

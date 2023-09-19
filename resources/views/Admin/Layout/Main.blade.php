<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Web- Admin Panel</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('Admin/plugins/fontawesome-free/css/all.min.css')}}">

    <!-- select2 -->
    <link rel="stylesheet" href="{{asset('Admin/dist/css/select2.min.css')}}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('Admin/summernote/summernote-bs4.css')}}">

    <!-- Unicons CDN Link for Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('Admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/dist/css/style.css')}}">

    <style>

        .tag_input{
            /*display: flex;*/
            /*align-items: center;*/
            /*justify-content: center;*/
            /*min-height: 100vh;*/
            /*background: #5372F0;*/
        }
        ::selection{
            color: #fff;
            background: #5372F0;
        }
        .tag_input .wrapper{
            /*width: 496px;*/
            /*background: #fff;*/
            /*border-radius: 10px;*/
            /*padding: 18px 25px 20px;*/
            /*box-shadow: 0 0 30px rgba(0,0,0,0.06);*/
        }
        .tag_input .wrapper :where(.title, li, li i, .details){
            /*display: flex;*/
            /*align-items: center;*/
        }
        .tag_input .title img{
            max-width: 21px;
        }
        .tag_input .title h2{
            font-size: 21px;
            font-weight: 600;
            /*margin-left: 8px;*/
        }
        .tag_input .wrapper .content{
            margin: 0 0;
        }
        .tag_input .content p{
            font-size: 15px;
        }
        .tag_input .content ul{
            display: flex;
            flex-wrap: wrap;
            padding: 7px;
            margin: 1px 0;
            border-radius: 5px;
            border: 1px solid #a6a6a6;
        }
        .tag_input .content ul  li{
            color: #333;
            margin: 4px 3px;
            list-style: none;
            border-radius: 5px;
            background: #F2F2F2;
            padding: 3px 5px 3px 5px;
            border: 1px solid #e3e1e1;
        }
        .tag_input .content ul li i{
            height: 20px;
            width: 20px;
            color: #808080;
            margin-left: 8px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 50%;
            background: #dfdfdf;
            justify-content: center;
        }
        .tag_input .content ul input{
            flex: 1;
            padding: 5px;
            border: none;
            outline: none;
            font-size: 16px;
        }
        .tag_input .wrapper .details{
            justify-content: space-between;
        }
        .tag_input .title a{
            margin-left: 10px;
            border: none;
            font-weight: 600;
            outline: none;
            color: #fff;
            font-size: 12px;
            cursor: pointer;
            padding: 3px 7px;
            border-radius: 9px;
            background: #dc3545;
            transition: background 0.3s ease;
        }
        .tag_input .title a:hover{
            background: #d60d0d;
        }

    </style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


    @include('Admin.Common.TopBar')


    @include('Admin.Common.SideBar')



    <!--begin::Content wrapper-->
    @yield('content')
    <!--end::Content wrapper-->



    @include('Admin.Common.RightBar')


    @include('Admin.Common.Footer')



</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('Admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Select2 App -->
<script src="{{asset('Admin/dist/js/select2.min.js')}}"></script>

<!-- summernote -->
<script src="{{asset('Admin/summernote/summernote-bs4.js')}}"></script>

<!-- axios.min.js -->
<script src="{{asset('Admin/dist/js/axios.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('Admin/dist/js/adminlte.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('Admin/dist/js/demo.js')}}"></script>

<!-- tag_script App -->
<script src="{{asset('Admin/dist/js/tag_script.js')}}"></script>
<script src="{{asset('Admin/dist/js/tag_script2.js')}}"></script>

<script>
    $('form').bind("keypress", function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

    });
    scrollWin();
    function scrollWin() {
        window.scrollTo(0, 0);
    }
</script>

@yield('script')


</body>
</html>

@extends('Site.Layout.Main')

@if(session()->get('locale') == 'en')
    @section('title', __('message.nav_home'))
    @section('description',__('message.nav_home')." - ".$SiteCommon->site_description)
    @section('keywords', __('message.nav_home'))
@else
    @section('title', __('message.nav_home'))
    @section('description',__('message.nav_home')." - ".$SiteCommon->site_bn_description)
    @section('keywords', __('message.nav_home'))
@endif

@section('SiteContent')
    @include('Site.Component.BannerComponent')
    @include('Site.Component.CodeComponent')
    @include('Site.Component.TeacherSpeechComponent')
    @include('Site.Component.NoticeComponent')
    @include('Site.Component.CornerComponent')
    @include('Site.Component.TeacherComponent')
    @include('Site.Component.MemberComponent')
    @include('Site.Component.EventComponent')
    @include('Site.Component.CountComponent')
    @include('Site.Component.NewsComponent')
    @include('Site.Component.ImportantComponent')
    @include('Site.Component.GalleryComponent')

@endsection

@section('SiteScript')
    @yield('BannerScript')
    @yield('EventScript')
    @yield('NoticeScript')
    @yield('NewsScript')
    @yield('GalleryScript')
    @yield('CornerScript')
    @yield('TeacherScript')
    @yield('MemberScript')
@endsection

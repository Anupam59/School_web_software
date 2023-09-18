<?php

use App\Http\Controllers\Admin\AxiosCallController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CornerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Admin\SiteCommonController;
use App\Http\Controllers\Admin\StaffsController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Controllers\Site\LanguageController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

Route::middleware('alreadyLoggedIn')->group(function (){
    Route::get('admin/login', [CustomAuthController::class, 'index'])->name('login');
    Route::post('validate_login', [CustomAuthController::class, 'validate_login'])->name('sample.validate_login');
});
//Route::get('registration', [CustomAuthController::class, 'registration'])->name('registration');
//Route::post('validate_registration', [CustomAuthController::class, 'validate_registration'])->name('sample.validate_registration');
//
//Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
//Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
//Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
//Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::middleware('isLoggedIn')->group(function (){

//    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('admin/logout', [CustomAuthController::class, 'logout']);

    Route::get('admin/dashboard', [DashboardController::class, 'DashboardIndex']);

    Route::get('admin/user-list', [UserController::class, 'UserIndex']);
    Route::get('admin/user-create', [UserController::class,'UserCreate']);
    Route::post('admin/user-entry', [UserController::class, 'UserEntry']);
    Route::get('admin/user-edit/{id}', [UserController::class, 'UserEdit']);
    Route::post('admin/user-update/{id}', [UserController::class, 'UserUpdate']);
    Route::get('admin/user-edit-pass/{id}', [UserController::class, 'UserEditPassword']);
    Route::post('admin/user-update-pass/{id}', [UserController::class, 'UserUpdatePassword']);


    Route::get('admin/banner-list', [BannerController::class, 'BannerIndex']);
    Route::get('admin/banner-create', [BannerController::class, 'BannerCreate']);
    Route::post('admin/banner-entry', [BannerController::class, 'BannerEntry']);
    Route::get('admin/banner-edit/{id}', [BannerController::class, 'BannerEdit']);
    Route::post('admin/banner-update/{id}', [BannerController::class, 'BannerUpdate']);
    Route::post('admin/banner-delete', [BannerController::class, 'BannerDelete']);


    Route::get('admin/link-list', [LinkController::class, 'LinkIndex']);
    Route::get('admin/link-create', [LinkController::class, 'LinkCreate']);
    Route::post('admin/link-entry', [LinkController::class, 'LinkEntry']);
    Route::get('admin/link-edit/{id}', [LinkController::class, 'LinkEdit']);
    Route::post('admin/link-update/{id}', [LinkController::class, 'LinkUpdate']);
    Route::post('admin/link-delete', [LinkController::class, 'LinkDelete']);


    Route::get('admin/corner-list', [CornerController::class, 'CornerIndex']);
    Route::get('admin/corner-create', [CornerController::class, 'CornerCreate']);
    Route::post('admin/corner-entry', [CornerController::class, 'CornerEntry']);
    Route::get('admin/corner-edit/{id}', [CornerController::class, 'CornerEdit']);
    Route::post('admin/corner-update/{id}', [CornerController::class, 'CornerUpdate']);
    Route::post('admin/corner-delete', [CornerController::class, 'CornerDelete']);


    Route::get('admin/notice-list', [NoticeController::class, 'NoticeIndex']);
    Route::get('admin/notice-create', [NoticeController::class, 'NoticeCreate']);
    Route::post('admin/notice-entry', [NoticeController::class, 'NoticeEntry']);
    Route::get('admin/notice-edit/{id}', [NoticeController::class, 'NoticeEdit']);
    Route::post('admin/notice-update/{id}', [NoticeController::class, 'NoticeUpdate']);
    Route::post('admin/notice-delete', [NoticeController::class, 'NoticeDelete']);


    Route::get('admin/page-list', [PageController::class, 'PageIndex']);
    Route::get('admin/page-create', [PageController::class, 'PageCreate']);
    Route::post('admin/page-entry', [PageController::class, 'PageEntry']);
    Route::get('admin/page-edit/{id}', [PageController::class, 'PageEdit']);
    Route::post('admin/page-update/{id}', [PageController::class, 'PageUpdate']);
    Route::post('admin/page-delete', [PageController::class, 'PageDelete']);


    Route::get('admin/event-list', [EventController::class, 'EventIndex']);
    Route::get('admin/event-create', [EventController::class, 'EventCreate']);
    Route::post('admin/event-entry', [EventController::class, 'EventEntry']);
    Route::get('admin/event-edit/{id}', [EventController::class, 'EventEdit']);
    Route::post('admin/event-update/{id}', [EventController::class, 'EventUpdate']);
    Route::post('admin/event-delete', [EventController::class, 'EventDelete']);
    Route::post('EventImgShow', [EventController::class, 'EventImgShow']);
    Route::post('EventImageDelete', [EventController::class, 'EventImageDelete']);


    Route::get('admin/gallery-list', [GalleryController::class, 'GalleryIndex']);
    Route::get('admin/gallery-create', [GalleryController::class, 'GalleryCreate']);
    Route::post('admin/gallery-entry', [GalleryController::class, 'GalleryEntry']);
    Route::get('admin/gallery-edit/{id}', [GalleryController::class, 'GalleryEdit']);
    Route::post('admin/gallery-update/{id}', [GalleryController::class, 'GalleryUpdate']);
    Route::post('admin/gallery-delete', [GalleryController::class, 'GalleryDelete']);
    Route::post('GalleryImgShow', [GalleryController::class, 'GalleryImgShow']);
    Route::post('GalleryImageDelete', [GalleryController::class, 'GalleryImageDelete']);


    Route::get('admin/news-list', [NewsController::class, 'NewsIndex']);
    Route::get('admin/news-create', [NewsController::class, 'NewsCreate']);
    Route::post('admin/news-entry', [NewsController::class, 'NewsEntry']);
    Route::get('admin/news-edit/{id}', [NewsController::class, 'NewsEdit']);
    Route::post('admin/news-update/{id}', [NewsController::class, 'NewsUpdate']);
    Route::post('admin/news-delete', [NewsController::class, 'NewsDelete']);


    Route::get('admin/designation-list', [DesignationController::class, 'DesignationIndex']);
    Route::get('admin/designation-create', [DesignationController::class, 'DesignationCreate']);
    Route::post('admin/designation-entry', [DesignationController::class, 'DesignationEntry']);
    Route::get('admin/designation-edit/{id}', [DesignationController::class, 'DesignationEdit']);
    Route::post('admin/designation-update/{id}', [DesignationController::class, 'DesignationUpdate']);
    Route::post('admin/designation-delete', [DesignationController::class, 'DesignationDelete']);


    Route::get('admin/teacher-list', [TeacherController::class, 'TeacherIndex']);
    Route::get('admin/teacher-create', [TeacherController::class, 'TeacherCreate']);
    Route::post('admin/teacher-entry', [TeacherController::class, 'TeacherEntry']);
    Route::get('admin/teacher-edit/{id}', [TeacherController::class, 'TeacherEdit']);
    Route::post('admin/teacher-update/{id}', [TeacherController::class, 'TeacherUpdate']);
    Route::post('admin/teacher-delete', [TeacherController::class, 'TeacherDelete']);


    Route::get('admin/staffs-list', [StaffsController::class, 'StaffsIndex']);
    Route::get('admin/staffs-create', [StaffsController::class, 'StaffsCreate']);
    Route::post('admin/staffs-entry', [StaffsController::class, 'StaffsEntry']);
    Route::get('admin/staffs-edit/{id}', [StaffsController::class, 'StaffsEdit']);
    Route::post('admin/staffs-update/{id}', [StaffsController::class, 'StaffsUpdate']);
    Route::post('admin/staffs-delete', [StaffsController::class, 'StaffsDelete']);


    Route::get('admin/period-list', [PeriodController::class, 'PeriodIndex']);
    Route::get('admin/period-create', [PeriodController::class, 'PeriodCreate']);
    Route::post('admin/period-entry', [PeriodController::class, 'PeriodEntry']);
    Route::get('admin/period-edit/{id}', [PeriodController::class, 'PeriodEdit']);
    Route::post('admin/period-update/{id}', [PeriodController::class, 'PeriodUpdate']);
    Route::post('admin/period-delete', [PeriodController::class, 'PeriodDelete']);


    Route::get('admin/member-list', [MemberController::class, 'MemberIndex']);
    Route::get('admin/member-create', [MemberController::class, 'MemberCreate']);
    Route::post('admin/member-entry', [MemberController::class, 'MemberEntry']);
    Route::get('admin/member-edit/{id}', [MemberController::class, 'MemberEdit']);
    Route::post('admin/member-update/{id}', [MemberController::class, 'MemberUpdate']);
    Route::post('admin/member-delete', [MemberController::class, 'MemberDelete']);


    Route::get('admin/about-edit', [SiteCommonController::class, 'AboutEdit']);
    Route::post('admin/about-update', [SiteCommonController::class, 'AboutUpdate']);
    Route::get('admin/communication-edit', [SiteCommonController::class, 'CommunicationEdit']);
    Route::post('admin/communication-update', [SiteCommonController::class, 'CommunicationUpdate']);
    Route::get('admin/policy-edit', [SiteCommonController::class, 'PolicyEdit']);
    Route::post('admin/policy-update', [SiteCommonController::class, 'PolicyUpdate']);
    Route::get('admin/terms-edit', [SiteCommonController::class, 'TermsEdit']);
    Route::post('admin/terms-update', [SiteCommonController::class, 'TermsUpdate']);
    Route::get('admin/info-edit', [SiteCommonController::class, 'InfoEdit']);
    Route::post('admin/info-update', [SiteCommonController::class, 'InfoUpdate']);



    Route::get('admin/menu-list', [MenuController::class, 'MenuIndex']);
    Route::get('admin/menu-create', [MenuController::class, 'MenuCreate']);
    Route::post('admin/menu-entry', [MenuController::class, 'MenuEntry']);
    Route::get('admin/menu-edit/{id}', [MenuController::class, 'MenuEdit']);
    Route::post('admin/menu-update/{id}', [MenuController::class, 'MenuUpdate']);


    Route::get('admin/menu-item-list', [MenuController::class, 'MenuItemIndex']);
    Route::get('admin/menu-item-create', [MenuController::class, 'MenuItemCreate']);
    Route::post('admin/menu-item-entry', [MenuController::class, 'MenuItemEntry']);
    Route::get('admin/menu-item-edit/{id}', [MenuController::class, 'MenuItemEdit']);
    Route::post('admin/menu-item-update/{id}', [MenuController::class, 'MenuItemUpdate']);


    Route::get('admin/menu-sub-item-list', [MenuController::class, 'MenuSubItemIndex']);
    Route::get('admin/menu-sub-item-create', [MenuController::class, 'MenuSubItemCreate']);
    Route::post('admin/menu-sub-item-entry', [MenuController::class, 'MenuSubItemEntry']);
    Route::get('admin/menu-sub-item-edit/{id}', [MenuController::class, 'MenuSubItemEdit']);
    Route::post('admin/menu-sub-item-update/{id}', [MenuController::class, 'MenuSubItemUpdate']);



    Route::post('DesignationGetData',[AxiosCallController::class,'DesignationGetData']);
    Route::post('PeriodGetData',[AxiosCallController::class,'PeriodGetData']);
    Route::post('MenuItemGetData',[AxiosCallController::class,'MenuItemGetData']);

});








//Page
Route::get('/', [SiteController::class, 'HomePage']);
Route::get('news', [SiteController::class, 'NewsPage']);
Route::get('corner', [SiteController::class, 'CornerPage']);
Route::get('event', [SiteController::class, 'EventPage']);
Route::get('gallery', [SiteController::class, 'GalleryPage']);
Route::get('notice', [SiteController::class, 'NoticePage']);
Route::get('teacher', [SiteController::class, 'TeacherPage']);
Route::get('member', [SiteController::class, 'MemberPage']);
Route::get('staffs', [SiteController::class, 'StaffsPage']);
Route::get('contact', [SiteController::class, 'ContactPage']);


Route::get('corner/{id}', [SiteController::class, 'CornerDetailsPage']);
Route::get('news/{id}', [SiteController::class, 'NewsDetailsPage']);
Route::get('event/{id}', [SiteController::class, 'EventDetailsPage']);
Route::get('gallery/{id}', [SiteController::class, 'GalleryDetailsPage']);
Route::get('notice/{id}', [SiteController::class, 'NoticeDetailsPage']);
Route::get('page/{slug}', [SiteController::class, 'SingleDetailsPage']);

Route::get('teacher/{id}', [SiteController::class, 'TeacherDetailsPage']);
Route::get('member/{id}', [SiteController::class, 'MemberDetailsPage']);
Route::get('staffs/{id}', [SiteController::class, 'StaffsDetailsPage']);


//Language Change
Route::get('LanguageChange',[LanguageController::class,'LanguageChange']);


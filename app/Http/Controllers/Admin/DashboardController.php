<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\CornerModel;
use App\Models\EventModel;
use App\Models\GalleryModel;
use App\Models\LinkModel;
use App\Models\MemberModel;
use App\Models\NewsModel;
use App\Models\NoticeModel;
use App\Models\StaffsModel;
use App\Models\TeacherModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function DashboardIndex(){
        $Teacher = TeacherModel::where('status',1)->count();
        $Staffs = StaffsModel::where('status',1)->count();
        $PresentMember = MemberModel::where('status',1)->count();
        $PreviousMember = MemberModel::where('status',1)->count();

        $Banner = BannerModel::where('status',1)->count();
        $Corner = CornerModel::where('status',1)->count();
        $Notice = NoticeModel::where('status',1)->count();
        $Event = EventModel::where('status',1)->count();

        $News = NewsModel::where('status',1)->count();
        $ImportantLink = LinkModel::where('status',1)->count();
        $QuickLink = LinkModel::where('status',1)->count();
        $Gallery = GalleryModel::where('status',1)->count();

        return view('Admin.Pages.Dashboard.DashboardIndex',compact('Teacher',
        'Staffs',
        'PresentMember',
        'PreviousMember',
        'Banner',
        'Corner',
        'Notice',
        'Event',
        'News',
        'ImportantLink',
        'QuickLink',
        'Gallery',
        ));
    }
}

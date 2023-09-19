<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\CornerModel;
use App\Models\EventImageModel;
use App\Models\EventModel;
use App\Models\GalleryImageModel;
use App\Models\GalleryModel;
use App\Models\LinkModel;
use App\Models\MemberModel;
use App\Models\MenuItemModel;
use App\Models\MenuModel;
use App\Models\NewsModel;
use App\Models\NoticeModel;
use App\Models\PageModel;
use App\Models\PeriodModel;
use App\Models\SiteCommonModel;
use App\Models\StaffsModel;
use App\Models\TeacherModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class SiteController extends Controller
{

    public function __construct() {
        $SiteCommon = SiteCommonModel::where('status',1)->first();
        $QuickLink = LinkModel::where('status',1)
            ->where('link_type',2)
            ->orderBy('link_id','desc')
            ->limit(8)
            ->get();
        View::share ( 'SiteCommon', $SiteCommon );
        View::share ( 'QuickLink', $QuickLink );
    }

    public function HomePage(){
        $TotalTeacher = TeacherModel::where('status',1)->count();
        $TotalMember = MemberModel::where('status',1)->count();
        $TotalStaffs = StaffsModel::where('status',1)->count();

        $TeacherHH = TeacherModel::join('designation', 'designation.designation_id', '=', 'teacher.designation_id')
            ->select('designation.designation_en_title','designation.designation_bn_title','teacher.*')
            ->where('teacher.status',1)
            ->orderBy('designation.position','asc')
            ->orderBy('teacher.position','asc')
            ->limit(2)
            ->get();

        $TeacherFirst = $TeacherHH[0];
        $TeacherSecond = $TeacherHH[1];

        $PeriodStatus = PeriodModel::where('status',1)->where('period_status',1)->first();
        $StatusPeriodId = $PeriodStatus->period_id;
        $MemberFirst = MemberModel::join('designation', 'designation.designation_id', '=', 'member.designation_id')
            ->select('designation.designation_en_title','designation.designation_bn_title','member.*')
            ->where('member.status',1)
            ->where('period_id', $StatusPeriodId)
            ->orderBy('designation.position','asc')
            ->orderBy('member.position','asc')
            ->first();

        $Gallery = GalleryModel::where('status',1)->orderBy('gallery_id','desc')->limit(9)->get();
        $Corner = CornerModel::where('status',1)->orderBy('corner_id','desc')->limit(6)->get();
        $Banner = BannerModel::where('status',1)->orderBy('banner_id','desc')->limit(6)->get();
        $News = NewsModel::where('status',1)->orderBy('news_id','desc')->limit(3)->get();
        $Event = EventModel::where('status',1)->orderBy('event_id','desc')->limit(3)->get();
        $Notice = NoticeModel::where('status',1)->orderBy('notice_id','desc')->limit(8)->get();
        $Link = LinkModel::where('status',1)
            ->where('link_type',1)
            ->orderBy('link_id','desc')
            ->limit(8)
            ->get();
        $Teacher = TeacherModel::join('designation', 'designation.designation_id', '=', 'teacher.designation_id')
            ->select('designation.designation_en_title','designation.designation_bn_title','teacher.*')
            ->where('teacher.status',1)
            ->inRandomOrder()
            ->limit(5)
            ->get();
        $Member = MemberModel::join('designation', 'designation.designation_id', '=', 'member.designation_id')
            ->select('designation.designation_en_title','designation.designation_bn_title','member.*')
            ->where('member.status',1)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return view('Site/Pages/HomePage',compact(
            'Gallery', 'Corner', 'Banner', 'TeacherFirst','TeacherSecond',
            'MemberFirst','Teacher','Member', 'Link','Event','News','Notice',
            'TotalTeacher','TotalMember','TotalStaffs'));
    }

    public function NewsPage(){
        $start_date = \request('start_date');
        $end_date = \request('end_date');

        $query = NewsModel::where('status',1)
            ->orderBy('news_id','desc');
        if($start_date && $end_date) {
            $query = $query->whereBetween('created_date', [$start_date, $end_date]);
        }
        $News = $query->paginate(12);
        return view('Site/Pages/NewsPage',compact('News'));
    }

    public function CornerPage(){
        $start_date = \request('start_date');
        $end_date = \request('end_date');
        $query = CornerModel::where('status',1)
            ->orderBy('corner_id','desc');
        if($start_date && $end_date) {
            $query = $query->whereBetween('created_date', [$start_date, $end_date]);
        }
        $Corner = $query->paginate(12);
        return view('Site/Pages/CornerPage',compact('Corner'));
    }

    public function EventPage(){
        $start_date = \request('start_date');
        $end_date = \request('end_date');

        $query = EventModel::where('status',1)
            ->orderBy('event_id','desc');
        if($start_date && $end_date) {
            $query = $query->whereBetween('created_date', [$start_date, $end_date]);
        }
        $Event = $query->paginate(12);
        return view('Site/Pages/EventPage',compact('Event'));
    }

    public function GalleryPage(){
        $Gallery = GalleryModel::where('status',1)->orderBy('gallery_id','desc')->paginate(12);
        return view('Site/Pages/GalleryPage',compact('Gallery'));
    }

    public function NoticePage(){
        $start_date = \request('start_date');
        $end_date = \request('end_date');

        $query = NoticeModel::where('status',1)
            ->orderBy('notice_id','desc');
        if($start_date && $end_date) {
            $query = $query->whereBetween('created_date', [$start_date, $end_date]);
        }
        $Notice = $query->paginate(15);

        return view('Site/Pages/NoticePage',compact('Notice'));
    }



    public function TeacherPage(){
        $index = \request('index');
        $query = TeacherModel::join('designation', 'designation.designation_id', '=', 'teacher.designation_id')
            ->select('designation.designation_en_title','designation.designation_bn_title','teacher.*')
            ->where('teacher.status',1)
            ->orderBy('designation.position','asc')
            ->orderBy('teacher.position','asc');
        if($index) {
            $query = $query->where('teacher_index', $index);
        }
        $Teacher = $query->paginate(16);
        return view('Site/Pages/TeacherPage',compact('Teacher'));
    }


    public function TeacherDetailsPage($id){
        $Teacher = TeacherModel::join('designation', 'designation.designation_id', '=', 'teacher.designation_id')
            ->select('designation.designation_en_title','designation.designation_bn_title','teacher.*')
            ->where('teacher.teacher_id',$id)
            ->first();
        return view('Site/Pages/TeacherDetailsPage',compact('Teacher'));
    }



    public function MemberPage(){
        $index = \request('index');
        $period_id = \request('period_id');
        $PeriodStatus = PeriodModel::where('status',1)->where('period_status',1)->first();
        $StatusPeriodId = $PeriodStatus->period_id;

        $query = MemberModel::join('designation', 'designation.designation_id', '=', 'member.designation_id')
            ->select('designation.designation_en_title','designation.designation_bn_title','member.*')
            ->where('member.status',1)
            ->orderBy('designation.position','asc')
            ->orderBy('member.position','asc');

        if($index) {
            $query = $query->where('member_index', $index);
        }
        if($period_id) {
            $query = $query->where('period_id', $period_id);
        }else{
            $query = $query->where('period_id', $StatusPeriodId);
        }
        $Member = $query->paginate(16);
        $Period = PeriodModel::where('status',1)->get();
        return view('Site/Pages/MemberPage',compact('Member','Period','PeriodStatus'));
    }

    public function MemberDetailsPage($id){
        $Member = MemberModel::join('designation', 'designation.designation_id', '=', 'member.designation_id')
            ->leftJoin('period', 'period.period_id', '=', 'member.period_id')
            ->select('designation.designation_en_title','designation.designation_bn_title','period.period_en_title','period.period_bn_title','member.*')
            ->where('member.member_id',$id)
            ->first();
        return view('Site/Pages/MemberDetailsPage',compact('Member'));
    }




    public function StaffsPage(){
        $index = \request('index');
        $query = StaffsModel::join('designation', 'designation.designation_id', '=', 'staffs.designation_id')
            ->select('designation.designation_en_title','designation.designation_bn_title','staffs.*')
            ->where('staffs.status',1)
            ->orderBy('position','asc');
        if($index) {
            $query = $query->where('staffs_index', $index);
        }
        $Staffs = $query->paginate(4);
        return view('Site/Pages/StaffsPage',compact('Staffs'));
    }


    public function ContactPage(){
        return view('Site/Pages/ContactPage');
    }

    public function StaffsDetailsPage($id){
        $Staffs = StaffsModel::join('designation', 'designation.designation_id', '=', 'staffs.designation_id')
            ->select('designation.designation_en_title','designation.designation_bn_title','staffs.*')
            ->where('staffs.staffs_id',$id)
            ->first();
        return view('Site/Pages/StaffsDetailsPage',compact('Staffs'));
    }



    public function CornerDetailsPage($id){
        $Corner = CornerModel::where('status',1)
            ->where('corner_id',$id)
            ->first();
        return view('Site/Pages/CornerDetailsPage',compact('Corner'));
    }

    public function NewsDetailsPage($id){
        $News = NewsModel::where('status',1)
            ->where('news_id',$id)
            ->first();
        return view('Site/Pages/NewsDetailsPage',compact('News'));
    }

    public function EventDetailsPage($id){
        $Event = EventModel::where('status',1)
            ->where('event_id',$id)
            ->first();
        $EventImage = EventImageModel::where('event_id','=',$id)->get();
        return view('Site/Pages/EventDetailsPage',compact('Event','EventImage'));
    }


    public function GalleryDetailsPage($id){
        $Gallery = GalleryModel::where('status',1)
            ->where('gallery_id',$id)
            ->first();
        $GalleryImage = GalleryImageModel::where('gallery_id','=',$id)->get();
        return view('Site/Pages/GalleryDetailsPage',compact('Gallery','GalleryImage'));
    }


    public function NoticeDetailsPage($id){
        $Notice = NoticeModel::where('status',1)
            ->where('notice_id',$id)
            ->first();
        $Extension = '';
        $notice_file = '';
        if($Notice){
            $notice_file = $Notice->notice_file;
        }
        if ($notice_file){
            $file = explode('.', $notice_file);
            $Extension = array_pop($file);
        }
        return view('Site/Pages/NoticeDetailsPage',compact('Notice','Extension'));
    }


    public function SingleDetailsPage($slug){
        $Page = PageModel::where('status',1)
            ->where('page_slug',$slug)
            ->first();
        $Extension = '';
        $page_file = '';
        if($Page){
            $page_file = $Page->page_file;
        }
        if ($page_file){
            $file = explode('.', $page_file);
            $Extension = array_pop($file);
        }
        if($Page){
            return view('Site/Pages/SingleDetailsPage',compact('Page','Extension'));
        }else{
            return redirect('/');
        }
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignationModel;
use App\Models\MemberModel;
use App\Models\PeriodModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class MemberController extends Controller
{
    public function MemberIndex(){
        $member_index = \request('member_index');
        $period_id = \request('period_id');

        $PeriodStatus = PeriodModel::where('status',1)->where('period_status',1)->first();
        $StatusPeriodId = $PeriodStatus->period_id;

        $query = MemberModel::join('users as creator_by', 'creator_by.id', '=', 'member.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'member.modifier')
            ->leftJoin('designation', 'designation.designation_id', '=', 'member.designation_id')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'designation.designation_en_title',
                'member.*'
            )
            ->orderBy('designation.position','asc')
            ->orderBy('member.position','asc');
        if($member_index) {
            $query = $query->where('member_index', $member_index);
        }
        if($period_id) {
            $query = $query->where('period_id', $period_id);
        }else{
            $query = $query->where('period_id', $StatusPeriodId);
        }

        $Member = $query->paginate(15);
        $Period = PeriodModel::where('status',1)->get();
        return view('Admin/Pages/Member/MemberIndex',compact('Member','Period','PeriodStatus'));
    }

    public function MemberCreate(){
        return view('Admin/Pages/Member/MemberCreate');
    }

    public function MemberEntry(Request $request){
        $validation = $request->validate([
            'member_en_name' => 'required',
            'member_bn_name' => 'required',
            'position' => 'required',
            'member_image' => 'image',
        ]);
        $data =  array();
        $data['member_en_name'] = $request->member_en_name;
        $data['member_bn_name'] = $request->member_bn_name;
        $data['member_en_speech'] = $request->member_en_speech;
        $data['member_bn_speech'] = $request->member_bn_speech;
        $data['member_en_description'] = $request->member_en_description;
        $data['member_bn_description'] = $request->member_bn_description;
        $data['member_gender'] = $request->member_gender;
        $data['member_index'] = $request->member_index;
        $data['position'] = $request->position;
        $data['designation_id'] = $request->designation_id;
        $data['period_id'] = $request->period_id;
        $data['joining_date'] = $request->joining_date;
        $data['resign_date'] = $request->resign_date;

        $data['whatsapp_number'] = $request->whatsapp_number;
        $data['facebook_link'] = $request->facebook_link;
        $data['email_address'] = $request->email_address;
        $data['phone_number'] = $request->phone_number;
        $data['linkedin_link'] = $request->linkedin_link;
        $data['twitter_link'] = $request->twitter_link;

        $member_image =  $request->file('member_image');
        if ($member_image){
            $ImageName =time().".".$member_image->getClientOriginalExtension();
            $Path = "Images/member/";
            $ResizeImage = Image::make($member_image)->resize(340,340);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['member_image'] = $url_database;
        }
        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = MemberModel::insert($data);
        if ($res){
            return back()->with('success_message','Member Add Successfully!');
        }else{
            return back()->with('error_message','Member Add Fail!');
        }
    }

    public function MemberEdit($id){
        $Designation = DesignationModel::where('status',1)->where('designation_type',2)
            ->orderBy('position','asc')->get();
        $Period = PeriodModel::where('status',1)->get();
        $Member = MemberModel::where('member_id',$id)->first();
        return view('Admin/Pages/Member/MemberUpdate',compact('Member','Designation','Period'));
    }

    public function MemberUpdate(Request $request, $id){
        $request->validate([
            'member_en_name' => 'required',
            'member_bn_name' => 'required',
            'position' => 'required',
            'member_image' => 'image',
        ]);
        $data =  array();
        $data['member_en_name'] = $request->member_en_name;
        $data['member_bn_name'] = $request->member_bn_name;
        $data['member_en_speech'] = $request->member_en_speech;
        $data['member_bn_speech'] = $request->member_bn_speech;
        $data['member_en_description'] = $request->member_en_description;
        $data['member_bn_description'] = $request->member_bn_description;
        $data['member_gender'] = $request->member_gender;
        $data['member_index'] = $request->member_index;
        $data['position'] = $request->position;
        $data['designation_id'] = $request->designation_id;
        $data['period_id'] = $request->period_id;
        $data['joining_date'] = $request->joining_date;
        $data['resign_date'] = $request->resign_date;

        $data['whatsapp_number'] = $request->whatsapp_number;
        $data['facebook_link'] = $request->facebook_link;
        $data['email_address'] = $request->email_address;
        $data['phone_number'] = $request->phone_number;
        $data['linkedin_link'] = $request->linkedin_link;
        $data['twitter_link'] = $request->twitter_link;

        $member_image =  $request->file('member_image');
        if ($member_image){
            $ImageName =time().'.'.$member_image->getClientOriginalExtension();
            $Path = "Images/member/";
            $ResizeImage = Image::make($member_image)->resize(340,340);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = MemberModel::where('member_id','=',$id)->select('member_image')->first();
            $OldImage = $OldData->member_image;
            $OldImageUrl = substr($OldImage, 1);

            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['member_image'] = $url_database;
                }else{
                    $data['member_image'] = $url_database;
                }
            }else{
                $data['member_image'] = $url_database;
            }

        }
        $data['status'] = $request->status;
        $data['modifier'] = Auth::user()->id;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = MemberModel::where('member_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Member Update Successfully!');
        }else{
            return back()->with('error_message','Member Update Fail!');
        }

    }

    public function MemberDelete(Request $request){
        $id = $request->member_id;
        $OldData = MemberModel::where('member_id','=',$id)->select('member_image')->first();
        $OldImage = $OldData->member_image;
        $OldImageUrl = substr($OldImage, 1);
        if ($OldImage){
            unlink($OldImageUrl);
        }

        if ($OldImage){
            if (file_exists($OldImageUrl)){
                unlink($OldImageUrl);
            }
        }

        $result= MemberModel::where('member_id','=',$id)->delete();

        if($result==true){
            return back()->with('success_message','Member Delete Successfully!');
        }
        else{
            return back()->with('error_message','Member Delete Fail!');
        }
    }

}

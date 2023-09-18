<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignationModel;
use App\Models\StaffsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class StaffsController extends Controller
{
    public function StaffsIndex(){
        $staffs_index = \request('staffs_index');
        $query = StaffsModel::join('users as creator_by', 'creator_by.id', '=', 'staffs.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'staffs.modifier')
            ->leftJoin('designation', 'designation.designation_id', '=', 'staffs.designation_id')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'designation.designation_en_title',
                'staffs.*'
            )
            ->orderBy('designation.position','asc')
            ->orderBy('staffs.position','asc');
        if($staffs_index) {
            $query = $query->where('staffs_index', $staffs_index);
        }

        $Staffs = $query->paginate(15);
        return view('Admin/Pages/Staffs/StaffsIndex',compact('Staffs'));
    }

    public function StaffsCreate(){
        return view('Admin/Pages/Staffs/StaffsCreate');
    }

    public function StaffsEntry(Request $request){
        $validation = $request->validate([
            'staffs_en_name' => 'required',
            'staffs_bn_name' => 'required',
            'position' => 'required',
            'staffs_image' => 'image',
        ]);
        $data =  array();
        $data['staffs_en_name'] = $request->staffs_en_name;
        $data['staffs_bn_name'] = $request->staffs_bn_name;
        $data['staffs_en_speech'] = $request->staffs_en_speech;
        $data['staffs_bn_speech'] = $request->staffs_bn_speech;
        $data['staffs_en_description'] = $request->staffs_en_description;
        $data['staffs_bn_description'] = $request->staffs_bn_description;
        $data['staffs_gender'] = $request->staffs_gender;
        $data['staffs_index'] = $request->staffs_index;
        $data['position'] = $request->position;
        $data['designation_id'] = $request->designation_id;
        $data['joining_date'] = $request->joining_date;
        $data['resign_date'] = $request->resign_date;

        $data['whatsapp_number'] = $request->whatsapp_number;
        $data['facebook_link'] = $request->facebook_link;
        $data['email_address'] = $request->email_address;
        $data['phone_number'] = $request->phone_number;
        $data['linkedin_link'] = $request->linkedin_link;
        $data['twitter_link'] = $request->twitter_link;

        $staffs_image =  $request->file('staffs_image');
        if ($staffs_image){
            $ImageName =time().".".$staffs_image->getClientOriginalExtension();
            $Path = "Images/staffs/";
            $ResizeImage = Image::make($staffs_image)->resize(340,340);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['staffs_image'] = $url_database;
        }
        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = StaffsModel::insert($data);
        if ($res){
            return back()->with('success_message','Staffs Add Successfully!');
        }else{
            return back()->with('error_message','Staffs Add Fail!');
        }
    }

    public function StaffsEdit($id){
        $Designation = DesignationModel::where('status',1)->where('designation_type',3)
            ->orderBy('position','asc')->get();
        $Staffs = StaffsModel::where('staffs_id',$id)->first();
        return view('Admin/Pages/Staffs/StaffsUpdate',compact('Staffs','Designation'));
    }

    public function StaffsUpdate(Request $request, $id){
        $request->validate([
            'staffs_en_name' => 'required',
            'staffs_bn_name' => 'required',
            'position' => 'required',
            'staffs_image' => 'image',
        ]);
        $data =  array();
        $data['staffs_en_name'] = $request->staffs_en_name;
        $data['staffs_bn_name'] = $request->staffs_bn_name;
        $data['staffs_en_speech'] = $request->staffs_en_speech;
        $data['staffs_bn_speech'] = $request->staffs_bn_speech;
        $data['staffs_en_description'] = $request->staffs_en_description;
        $data['staffs_bn_description'] = $request->staffs_bn_description;
        $data['staffs_gender'] = $request->staffs_gender;
        $data['staffs_index'] = $request->staffs_index;
        $data['position'] = $request->position;
        $data['designation_id'] = $request->designation_id;
        $data['joining_date'] = $request->joining_date;
        $data['resign_date'] = $request->resign_date;

        $data['whatsapp_number'] = $request->whatsapp_number;
        $data['facebook_link'] = $request->facebook_link;
        $data['email_address'] = $request->email_address;
        $data['phone_number'] = $request->phone_number;
        $data['linkedin_link'] = $request->linkedin_link;
        $data['twitter_link'] = $request->twitter_link;

        $staffs_image =  $request->file('staffs_image');
        if ($staffs_image){
            $ImageName =time().'.'.$staffs_image->getClientOriginalExtension();
            $Path = "Images/staffs/";
            $ResizeImage = Image::make($staffs_image)->resize(340,340);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = StaffsModel::where('staffs_id','=',$id)->select('staffs_image')->first();
            $OldImage = $OldData->staffs_image;
            $OldImageUrl = substr($OldImage, 1);

            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['staffs_image'] = $url_database;
                }else{
                    $data['staffs_image'] = $url_database;
                }
            }else{
                $data['staffs_image'] = $url_database;
            }

        }
        $data['status'] = $request->status;
        $data['modifier'] = Auth::user()->id;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = StaffsModel::where('staffs_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Staffs Update Successfully!');
        }else{
            return back()->with('error_message','Staffs Update Fail!');
        }
    }

    public function StaffsDelete(Request $request){
        $id = $request->staffs_id;
        $OldData = StaffsModel::where('staffs_id','=',$id)->select('staffs_image')->first();
        $OldImage = $OldData->staffs_image;
        $OldImageUrl = substr($OldImage, 1);
        if ($OldImage){
            unlink($OldImageUrl);
        }

        if ($OldImage){
            if (file_exists($OldImageUrl)){
                unlink($OldImageUrl);
            }
        }

        $result= StaffsModel::where('staffs_id','=',$id)->delete();
        if($result==true){
            return back()->with('success_message','Staffs Delete Successfully!');
        }
        else{
            return back()->with('error_message','Staffs Delete Fail!');
        }
    }
}

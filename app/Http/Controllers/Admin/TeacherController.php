<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignationModel;
use App\Models\TeacherModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class TeacherController extends Controller
{
    public function TeacherIndex(){
        $teacher_index = \request('teacher_index');
        $query = TeacherModel::join('users as creator_by', 'creator_by.id', '=', 'teacher.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'teacher.modifier')
            ->leftJoin('designation', 'designation.designation_id', '=', 'teacher.designation_id')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'designation.designation_en_title',
                'teacher.*'
            )
            ->orderBy('designation.position','asc')
            ->orderBy('teacher.position','asc');
        if($teacher_index) {
            $query = $query->where('teacher_index', $teacher_index);
        }

        $Teacher = $query->paginate(15);
        return view('Admin/Pages/Teacher/TeacherIndex',compact('Teacher'));
    }

    public function TeacherCreate(){
        return view('Admin/Pages/Teacher/TeacherCreate');
    }

    public function TeacherEntry(Request $request){
        $validation = $request->validate([
            'teacher_en_name' => 'required',
            'teacher_bn_name' => 'required',
            'position' => 'required',
            'teacher_image' => 'image',
        ]);
        $data =  array();
        $data['teacher_en_name'] = $request->teacher_en_name;
        $data['teacher_bn_name'] = $request->teacher_bn_name;
        $data['teacher_en_speech'] = $request->teacher_en_speech;
        $data['teacher_bn_speech'] = $request->teacher_bn_speech;
        $data['teacher_en_description'] = $request->teacher_en_description;
        $data['teacher_bn_description'] = $request->teacher_bn_description;
        $data['teacher_gender'] = $request->teacher_gender;
        $data['teacher_index'] = $request->teacher_index;
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

        $teacher_image =  $request->file('teacher_image');
        if ($teacher_image){
            $ImageName =time().".".$teacher_image->getClientOriginalExtension();
            $Path = "Images/teacher/";
            $ResizeImage = Image::make($teacher_image)->resize(340,340);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['teacher_image'] = $url_database;
        }
        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = TeacherModel::insert($data);
        if ($res){
            return back()->with('success_message','Teacher Add Successfully!');
        }else{
            return back()->with('error_message','Teacher Add Fail!');
        }
    }

    public function TeacherEdit($id){
        $Designation = DesignationModel::where('status',1)->where('designation_type',1)
            ->orderBy('position','asc')->get();
        $Teacher = TeacherModel::where('teacher_id',$id)->first();
        return view('Admin/Pages/Teacher/TeacherUpdate',compact('Teacher','Designation'));
    }

    public function TeacherUpdate(Request $request, $id){
        $request->validate([
            'teacher_en_name' => 'required',
            'teacher_bn_name' => 'required',
            'position' => 'required',
            'teacher_image' => 'image',
        ]);
        $data =  array();
        $data['teacher_en_name'] = $request->teacher_en_name;
        $data['teacher_bn_name'] = $request->teacher_bn_name;
        $data['teacher_en_speech'] = $request->teacher_en_speech;
        $data['teacher_bn_speech'] = $request->teacher_bn_speech;
        $data['teacher_en_description'] = $request->teacher_en_description;
        $data['teacher_bn_description'] = $request->teacher_bn_description;
        $data['teacher_gender'] = $request->teacher_gender;
        $data['teacher_index'] = $request->teacher_index;
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

        $teacher_image =  $request->file('teacher_image');
        if ($teacher_image){
            $ImageName =time().'.'.$teacher_image->getClientOriginalExtension();
            $Path = "Images/teacher/";
            $ResizeImage = Image::make($teacher_image)->resize(340,340);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = TeacherModel::where('teacher_id','=',$id)->select('teacher_image')->first();
            $OldImage = $OldData->teacher_image;
            $OldImageUrl = substr($OldImage, 1);

            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['teacher_image'] = $url_database;
                }else{
                    $data['teacher_image'] = $url_database;
                }
            }else{
                $data['teacher_image'] = $url_database;
            }

        }
        $data['status'] = $request->status;
        $data['modifier'] = Auth::user()->id;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = TeacherModel::where('teacher_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Teacher Update Successfully!');
        }else{
            return back()->with('error_message','Teacher Update Fail!');
        }

    }

    public function TeacherDelete(Request $request){
        $id = $request->teacher_id;
        $OldData = TeacherModel::where('teacher_id','=',$id)->select('teacher_image')->first();
        $OldImage = $OldData->teacher_image;
        $OldImageUrl = substr($OldImage, 1);
        if ($OldImage){
            unlink($OldImageUrl);
        }

        if ($OldImage){
            if (file_exists($OldImageUrl)){
                unlink($OldImageUrl);
            }
        }

        $result= TeacherModel::where('teacher_id','=',$id)->delete();

        if($result==true){
            return back()->with('success_message','Teacher Delete Successfully!');
        }
        else{
            return back()->with('error_message','Teacher Delete Fail!');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NoticeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;

class NoticeController extends Controller
{
    public function NoticeIndex(){
        $Notice = NoticeModel::join('users as creator_by', 'creator_by.id', '=', 'notice.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'notice.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'notice.*'
            )
            ->orderBy('notice_id','desc')->paginate(15);
        return view('Admin/Pages/Notice/NoticeIndex',compact('Notice'));
    }

    public function NoticeCreate(){
        return view('Admin/Pages/Notice/NoticeCreate');
    }

    public function NoticeEntry(Request $request){
        $validation = $request->validate([
            'notice_en_title' => 'required|unique:notice',
            'notice_bn_title' => 'required|unique:notice',
            'notice_file' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024', //only 1MB is allowed
        ]);

        $data =  array();
        $data['notice_en_title'] = $request->notice_en_title;
        $data['notice_bn_title'] = $request->notice_bn_title;
        $data['notice_en_description'] = $request->notice_en_description;
        $data['notice_bn_description'] = $request->notice_bn_description;
        $data['notice_link'] = $request->notice_link;

        $notice_file =  $request->file('notice_file');
        if ($notice_file){
            $Extension = $notice_file->getClientOriginalExtension();
            if ($Extension == "pdf"){
                $ImageName =time().".".$notice_file->getClientOriginalExtension();
                $Path = "Images/notice/file/";
                $url = $Path;
                $url_database = "/".$Path.$ImageName;
                $notice_file->move($url, $ImageName);
                $data['notice_file'] = $url_database;
            }else{
                $ImageName =time().".".$notice_file->getClientOriginalExtension();
                $Path = "Images/notice/image/";
                $ResizeImage = Image::make($notice_file)->resize(1000,500);
                $url = $Path.$ImageName;
                $url_database = "/".$Path.$ImageName;
                $ResizeImage ->save($url);
                $data['notice_file'] = $url_database;
            }
        }
        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = NoticeModel::insert($data);
        if ($res){
            return back()->with('success_message','Notice Add Successfully!');
        }else{
            return back()->with('error_message','Notice Add Fail!');
        }
    }

    public function NoticeEdit($id){
        $Notice = NoticeModel::where('notice_id',$id)->first();
        return view('Admin/Pages/Notice/NoticeUpdate',compact('Notice'));
    }

    public function NoticeUpdate(Request $request, $id){
        $request->validate([
            'notice_en_title' => 'required|unique:notice,notice_en_title,'. $id .',notice_id',
            'notice_bn_title' => 'required|unique:notice,notice_bn_title,'. $id .',notice_id',
            'notice_file' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024', //only 1MB is allowed
        ]);

        $data =  array();
        $data['notice_en_title'] = $request->notice_en_title;
        $data['notice_bn_title'] = $request->notice_bn_title;
        $data['notice_en_description'] = $request->notice_en_description;
        $data['notice_bn_description'] = $request->notice_bn_description;
        $data['notice_link'] = $request->notice_link;

        $notice_file =  $request->file('notice_file');
        if ($notice_file){
            $Extension = $notice_file->getClientOriginalExtension();
            if ($Extension == "pdf"){
                $ImageName =time().".".$notice_file->getClientOriginalExtension();
                $Path = "Images/notice/file/";
                $url = $Path;
                $url_database = "/".$Path.$ImageName;
                $notice_file->move($url, $ImageName);
                $OldData = NoticeModel::where('notice_id','=',$id)->select('notice_file')->first();
                $OldImage = $OldData->notice_file;
                $OldImageUrl = substr($OldImage, 1);
                if ($OldImage){
                    if (file_exists($OldImageUrl)){
                        unlink($OldImageUrl);
                        $data['notice_file'] = $url_database;
                    }else{
                        $data['notice_file'] = $url_database;
                    }
                }else{
                    $data['notice_file'] = $url_database;
                }
            }else{
                $ImageName =time().".".$notice_file->getClientOriginalExtension();
                $Path = "Images/notice/image/";
                $ResizeImage = Image::make($notice_file)->resize(1000,500);
                $url = $Path.$ImageName;
                $url_database = "/".$Path.$ImageName;
                $ResizeImage ->save($url);
                $OldData = NoticeModel::where('notice_id','=',$id)->select('notice_file')->first();
                $OldImage = $OldData->notice_file;
                $OldImageUrl = substr($OldImage, 1);
                if ($OldImage){
                    if (file_exists($OldImageUrl)){
                        unlink($OldImageUrl);
                        $data['notice_file'] = $url_database;
                    }else{
                        $data['notice_file'] = $url_database;
                    }
                }else{
                    $data['notice_file'] = $url_database;
                }
            }
        }

        $data['status'] = $request->status;
        $data['modifier'] = Auth::user()->id;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = NoticeModel::where('notice_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Notice Update Successfully!');
        }else{
            return back()->with('error_message','Notice Update Fail!');
        }

    }

    public function NoticeDelete(Request $request){
        $id = $request->notice_id;
        $OldData = NoticeModel::where('notice_id','=',$id)->select('notice_file')->first();
        $OldImage = $OldData->notice_file;
        $OldImageUrl = substr($OldImage, 1);
        if ($OldImage){
            unlink($OldImageUrl);
        }
        $result= NoticeModel::where('notice_id','=',$id)->delete();

        if($result==true){
            return back()->with('success_message','Notice Delete Successfully!');
        }
        else{
            return back()->with('error_message','Notice Delete Fail!');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CornerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CornerController extends Controller
{
    public function CornerIndex(){
        $Corner = CornerModel::join('users as creator_by', 'creator_by.id', '=', 'corner.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'corner.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'corner.*'
            )
            ->orderBy('corner_id','desc')->paginate(15);
        return view('Admin/Pages/Corner/CornerIndex',compact('Corner'));
    }

    public function CornerCreate(){
        return view('Admin/Pages/Corner/CornerCreate');
    }

    public function CornerEntry(Request $request){
        $validation = $request->validate([
            'corner_en_title' => 'required|unique:corner',
            'corner_bn_title' => 'required|unique:corner',
            'corner_image' => 'image',
        ]);
        $data =  array();
        $data['corner_en_title'] = $request->corner_en_title;
        $data['corner_bn_title'] = $request->corner_bn_title;
        $data['corner_en_description'] = $request->corner_en_description;
        $data['corner_bn_description'] = $request->corner_bn_description;
        $corner_image =  $request->file('corner_image');
        if ($corner_image){
            $ImageName =time().".".$corner_image->getClientOriginalExtension();
            $Path = "Images/corner/";
            $ResizeImage = Image::make($corner_image)->resize(400,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['corner_image'] = $url_database;
        }
        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = CornerModel::insert($data);
        if ($res){
            return back()->with('success_message','Corner Add Successfully!');
        }else{
            return back()->with('error_message','Corner Add Fail!');
        }
    }

    public function CornerEdit($id){
        $Corner = CornerModel::where('corner_id',$id)->first();
        return view('Admin/Pages/Corner/CornerUpdate',compact('Corner'));
    }

    public function CornerUpdate(Request $request, $id){
        $request->validate([
            'corner_en_title' => 'required|unique:corner,corner_en_title,'. $id .',corner_id',
            'corner_bn_title' => 'required|unique:corner,corner_bn_title,'. $id .',corner_id',
            'corner_image' => 'image',
        ]);
        $data =  array();
        $data['corner_en_title'] = $request->corner_en_title;
        $data['corner_bn_title'] = $request->corner_bn_title;
        $data['corner_en_description'] = $request->corner_en_description;
        $data['corner_bn_description'] = $request->corner_bn_description;
        $corner_image =  $request->file('corner_image');
        if ($corner_image){
            $ImageName =time().'.'.$corner_image->getClientOriginalExtension();
            $Path = "Images/corner/";
            $ResizeImage = Image::make($corner_image)->resize(400,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = CornerModel::where('corner_id','=',$id)->select('corner_image')->first();
            $OldImage = $OldData->corner_image;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                unlink($OldImageUrl);
                $data['corner_image'] = $url_database;
            }else{
                $data['corner_image'] = $url_database;
            }
        }
        $data['status'] = $request->status;
        $data['modifier'] = Auth::user()->id;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = CornerModel::where('corner_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Corner Update Successfully!');
        }else{
            return back()->with('error_message','Corner Update Fail!');
        }

    }

    public function CornerDelete(Request $request){
        $id = $request->corner_id;
        $OldData = CornerModel::where('corner_id','=',$id)->select('corner_image')->first();
        $OldImage = $OldData->corner_image;
        $OldImageUrl = substr($OldImage, 1);
        if ($OldImage){
            unlink($OldImageUrl);
        }
        $result= CornerModel::where('corner_id','=',$id)->delete();

        if($result==true){
            return back()->with('success_message','Corner Delete Successfully!');
        }
        else{
            return back()->with('error_message','Corner Delete Fail!');
        }
    }

}

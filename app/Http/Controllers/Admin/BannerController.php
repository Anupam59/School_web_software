<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function BannerIndex(){
        $Banner = BannerModel::join('users as creator_by', 'creator_by.id', '=', 'banner.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'banner.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'banner.*'
            )
            ->orderBy('banner_id','desc')->paginate(15);

        return view('Admin/Pages/Banner/BannerIndex',compact('Banner'));
    }

    public function BannerCreate(){
        return view('Admin/Pages/Banner/BannerCreate');
    }

    public function BannerEntry(Request $request){
        $validation = $request->validate([
            'banner_en_title' => 'required|unique:banner',
            'banner_bn_title' => 'required|unique:banner',
            'banner_image' => 'required|image',
        ]);

        $data =  array();
        $data['banner_en_title'] = $request->banner_en_title;
        $data['banner_bn_title'] = $request->banner_bn_title;
        $data['banner_en_description'] = $request->banner_en_description;
        $data['banner_bn_description'] = $request->banner_bn_description;

        $banner_image =  $request->file('banner_image');
        if ($banner_image){
            $ImageName =time().".".$banner_image->getClientOriginalExtension();
            $Path = "Images/banner/";
            $ResizeImage = Image::make($banner_image)->resize(1000,500);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['banner_image'] = $url_database;
        }

        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = BannerModel::insert($data);


        if ($res){
            return back()->with('success_message','Banner Add Successfully!');
        }else{
            return back()->with('error_message','Banner Add Fail!');
        }

    }

    public function BannerEdit($id){
        $Banner = BannerModel::where('banner_id',$id)->first();
        return view('Admin/Pages/Banner/BannerUpdate',compact('Banner'));
    }

    public function BannerUpdate(Request $request, $id){

        $request->validate([
            'banner_en_title' => 'required|unique:banner,banner_en_title,'. $id .',banner_id',
            'banner_bn_title' => 'required|unique:banner,banner_bn_title,'. $id .',banner_id',
            'banner_image' => 'image',
        ]);

        $data =  array();
        $data['banner_en_title'] = $request->banner_en_title;
        $data['banner_bn_title'] = $request->banner_bn_title;
        $data['banner_en_description'] = $request->banner_en_description;
        $data['banner_bn_description'] = $request->banner_bn_description;


        $banner_image =  $request->file('banner_image');
        if ($banner_image){
            $ImageName =time().'.'.$banner_image->getClientOriginalExtension();
            $Path = "Images/banner/";
            $ResizeImage = Image::make($banner_image)->resize(1000,580);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = BannerModel::where('banner_id','=',$id)->select('banner_image')->first();
            $OldImage = $OldData->banner_image;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                unlink($OldImageUrl);
                $data['banner_image'] = $url_database;
            }else{
                $data['banner_image'] = $url_database;
            }
        }


        $data['status'] = $request->status;
        $data['modifier'] = Auth::user()->id;
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = BannerModel::where('banner_id','=',$id)->update($data);

        if ($res){
            return back()->with('success_message','Banner Update Successfully!');
        }else{
            return back()->with('error_message','Banner Update Fail!');
        }

    }


    public function BannerDelete(Request $request){
        $id = $request->banner_id;
        $OldData = BannerModel::where('banner_id','=',$id)->select('banner_image')->first();
        $OldImage = $OldData->banner_image;
        $OldImageUrl = substr($OldImage, 1);
        if ($OldImage){
            unlink($OldImageUrl);
        }
        $result= BannerModel::where('banner_id','=',$id)->delete();

        if($result==true){
            return back()->with('success_message','Banner Delete Successfully!');
        }
        else{
            return back()->with('error_message','Banner Delete Fail!');
        }

    }
}

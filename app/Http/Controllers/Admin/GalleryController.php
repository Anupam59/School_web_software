<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImageModel;
use App\Models\GalleryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function GalleryIndex(){
        $Gallery = GalleryModel::join('users as creator_by', 'creator_by.id', '=', 'gallery.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'gallery.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'gallery.*'
            )
            ->orderBy('gallery_id','desc')->paginate(15);
        return view('Admin/Pages/Gallery/GalleryIndex',compact('Gallery'));
    }

    public function GalleryCreate(){
        return view('Admin/Pages/Gallery/GalleryCreate');
    }

    public function GalleryEntry(Request $request){
        $validation = $request->validate([
            'gallery_en_title' => 'required|unique:gallery',
            'gallery_bn_title' => 'required|unique:gallery',
            'gallery_image' => 'image',
        ]);
        $data =  array();
        $data['gallery_en_title'] = $request->gallery_en_title;
        $data['gallery_bn_title'] = $request->gallery_bn_title;
        $gallery_image =  $request->file('gallery_image');
        if ($gallery_image){
            $ImageName =time().".".$gallery_image->getClientOriginalExtension();
            $Path = "Images/gallery/";
            $ResizeImage = Image::make($gallery_image)->resize(400,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['gallery_image'] = $url_database;
        }
        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $GalleryId = GalleryModel::insertGetId($data);

        $more_images =  $request->file('gallery_img');
        if($more_images){
            $index = 0;
            foreach($more_images as $image){
                $ImageName =time().$index.'.'.$image->getClientOriginalExtension();
                $Path = "Images/gallery/gallery-image/";
                $ResizeImage = Image::make($image)->resize(400,400);
                $url = $Path.$ImageName;
                $url_database = "/".$Path.$ImageName;
                $ResizeImage ->save($url);

                $result = GalleryImageModel::insert([
                    'gallery_id' => $GalleryId,
                    'gallery_img' => $url_database,
                    'creator' => Auth::user()->id,
                    'modifier' => Auth::user()->id,
                    'created_date' => date("Y-m-d h:i:s"),
                    'modified_date' => date("Y-m-d h:i:s")
                ]);
                $index++;
            }
        }

        if ($GalleryId){
            return back()->with('success_message','Gallery Add Successfully!');
        }else{
            return back()->with('error_message','Gallery Add Fail!');
        }
    }

    public function GalleryEdit($id){
        $Gallery = GalleryModel::where('gallery_id',$id)->first();
        return view('Admin/Pages/Gallery/GalleryUpdate',compact('Gallery'));
    }

    public function GalleryUpdate(Request $request, $id){
        $request->validate([
            'gallery_en_title' => 'required|unique:gallery,gallery_en_title,'. $id .',gallery_id',
            'gallery_bn_title' => 'required|unique:gallery,gallery_bn_title,'. $id .',gallery_id',
            'gallery_image' => 'image',
        ]);
        $data =  array();
        $data['gallery_en_title'] = $request->gallery_en_title;
        $data['gallery_bn_title'] = $request->gallery_bn_title;
        $gallery_image =  $request->file('gallery_image');
        if ($gallery_image){
            $ImageName =time().'.'.$gallery_image->getClientOriginalExtension();
            $Path = "Images/gallery/";
            $ResizeImage = Image::make($gallery_image)->resize(400,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = GalleryModel::where('gallery_id','=',$id)->select('gallery_image')->first();
            $OldImage = $OldData->gallery_image;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['gallery_image'] = $url_database;
                }else{
                    $data['gallery_image'] = $url_database;
                }
            }else{
                $data['gallery_image'] = $url_database;
            }
        }
        $data['status'] = $request->status;
        $data['modifier'] = Auth::user()->id;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = GalleryModel::where('gallery_id','=',$id)->update($data);


        $more_images =  $request->file('gallery_img');
        if ($more_images){
            $index = 0;
            foreach($more_images as $image){
                $ImageName = time().$index.'.'.$image->getClientOriginalExtension();
                $Path = "Images/gallery/gallery-image/";
                $ResizeImage = Image::make($image)->resize(400,400);
                $url = $Path.$ImageName;
                $url_database = "/".$Path.$ImageName;
                $ResizeImage ->save($url);

                $result = GalleryImageModel::insert([
                    'gallery_id' => $id,
                    'gallery_img' => $url_database,
                    'creator' => Auth::user()->id,
                    'modifier' => Auth::user()->id,
                    'created_date' => date("Y-m-d h:i:s"),
                    'modified_date' => date("Y-m-d h:i:s")
                ]);
                $index++;
            }
        }

        if ($res){
            return back()->with('success_message','Gallery Update Successfully!');
        }else{
            return back()->with('error_message','Gallery Update Fail!');
        }

    }


    public function GalleryDelete(Request $request){
        $id = $request->gallery_id;
        $OldData = GalleryModel::where('gallery_id','=',$id)->select('gallery_image')->first();
        $OldImage = $OldData->gallery_image;
        $OldImageUrl = substr($OldImage, 1);
        if ($OldImage){
            if (file_exists($OldImageUrl)){
                unlink($OldImageUrl);
            }
        }
        $result= GalleryModel::where('gallery_id','=',$id)->delete();
        $more_images =  GalleryImageModel::where('gallery_id','=',$id)->get();
        if ($more_images){
            foreach($more_images as $image){
                $OldImage = $image->gallery_img;
                $OldImageUrl = substr($OldImage, 1);
                if ($OldImage){
                    if (file_exists($OldImageUrl)){
                        unlink($OldImageUrl);
                    }
                }
            }
            GalleryImageModel::where('gallery_id','=',$id)->delete();
        }

        if($result==true){
            return back()->with('success_message','Gallery Delete Successfully!');
        }
        else{
            return back()->with('error_message','Gallery Delete Fail!');
        }
    }




    public function GalleryImgShow(Request $request){
        $gallery_id = $request->input('gallery_id');
        $result = GalleryImageModel::where('gallery_id','=',$gallery_id)->get();
        return $result;
    }

    public function GalleryImageDelete(Request $request){
        $gallery_image_id = $request->input('gallery_image_id');
        $OldData = GalleryImageModel::where('gallery_image_id','=',$gallery_image_id)->first();
        $OldImage = $OldData->gallery_img;
        $OldImageUrl = substr($OldImage, 1);

        if ($OldImage){
            if (file_exists($OldImageUrl)){
                unlink($OldImageUrl);
                $result = GalleryImageModel::where('gallery_image_id','=',$gallery_image_id)->delete();
            }else{
                $result = GalleryImageModel::where('gallery_image_id','=',$gallery_image_id)->delete();
            }
        }else{
            $result = GalleryImageModel::where('gallery_image_id','=',$gallery_image_id)->delete();
        }

        if($result){
            return 1;
        }else{
            return 0;
        }

    }
}

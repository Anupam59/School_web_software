<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    public function NewsIndex(){
        $News = NewsModel::join('users as creator_by', 'creator_by.id', '=', 'news.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'news.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'news.*'
            )
            ->orderBy('news_id','desc')->paginate(15);
        return view('Admin/Pages/News/NewsIndex',compact('News'));
    }

    public function NewsCreate(){
        return view('Admin/Pages/News/NewsCreate');
    }

    public function NewsEntry(Request $request){
        $validation = $request->validate([
            'news_en_title' => 'required|unique:news',
            'news_bn_title' => 'required|unique:news',
            'news_image' => 'image',
        ]);
        $data =  array();
        $data['news_en_title'] = $request->news_en_title;
        $data['news_bn_title'] = $request->news_bn_title;
        $data['news_en_description'] = $request->news_en_description;
        $data['news_bn_description'] = $request->news_bn_description;
        $news_image =  $request->file('news_image');
        if ($news_image){
            $ImageName =time().".".$news_image->getClientOriginalExtension();
            $Path = "Images/news/";
            $ResizeImage = Image::make($news_image)->resize(1000,500);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['news_image'] = $url_database;
        }
        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = NewsModel::insert($data);
        if ($res){
            return back()->with('success_message','News Add Successfully!');
        }else{
            return back()->with('error_message','News Add Fail!');
        }
    }

    public function NewsEdit($id){
        $News = NewsModel::where('news_id',$id)->first();
        return view('Admin/Pages/News/NewsUpdate',compact('News'));
    }

    public function NewsUpdate(Request $request, $id){
        $request->validate([
            'news_en_title' => 'required|unique:news,news_en_title,'. $id .',news_id',
            'news_bn_title' => 'required|unique:news,news_bn_title,'. $id .',news_id',
            'news_image' => 'image',
        ]);
        $data =  array();
        $data['news_en_title'] = $request->news_en_title;
        $data['news_bn_title'] = $request->news_bn_title;
        $data['news_en_description'] = $request->news_en_description;
        $data['news_bn_description'] = $request->news_bn_description;
        $news_image =  $request->file('news_image');
        if ($news_image){
            $ImageName =time().'.'.$news_image->getClientOriginalExtension();
            $Path = "Images/news/";
            $ResizeImage = Image::make($news_image)->resize(1000,580);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = NewsModel::where('news_id','=',$id)->select('news_image')->first();
            $OldImage = $OldData->news_image;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['news_image'] = $url_database;
                }else{
                    $data['news_image'] = $url_database;
                }
            }else{
                $data['news_image'] = $url_database;
            }
        }
        $data['status'] = $request->status;
        $data['modifier'] = Auth::user()->id;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = NewsModel::where('news_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','News Update Successfully!');
        }else{
            return back()->with('error_message','News Update Fail!');
        }

    }


    public function NewsDelete(Request $request){
        $id = $request->news_id;
        $OldData = NewsModel::where('news_id','=',$id)->select('news_image')->first();
        $OldImage = $OldData->news_image;
        $OldImageUrl = substr($OldImage, 1);

        if ($OldImage){
            if (file_exists($OldImageUrl)){
                unlink($OldImageUrl);
            }
        }
        $result= NewsModel::where('news_id','=',$id)->delete();

        if($result==true){
            return back()->with('success_message','News Delete Successfully!');
        }
        else{
            return back()->with('error_message','News Delete Fail!');
        }
    }
}

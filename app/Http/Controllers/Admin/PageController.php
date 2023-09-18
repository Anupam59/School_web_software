<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    public function PageIndex(){
        $Page = PageModel::join('users as creator_by', 'creator_by.id', '=', 'page.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'page.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'page.*'
            )
            ->orderBy('page_id','asc')->paginate(40);
        return view('Admin/Pages/Page/PageIndex',compact('Page'));
    }

    public function PageCreate(){
        return view('Admin/Pages/Page/PageCreate');
    }

    public function PageEntry(Request $request){
        $validation = $request->validate([
            'page_en_title' => 'required|unique:page',
            'page_bn_title' => 'required|unique:page',
            'page_file' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024', //only 1MB is allowed
        ]);

        $data =  array();
        $data['page_en_title'] = $request->page_en_title;
        $data['page_bn_title'] = $request->page_bn_title;
        $data['page_slug'] = Str::slug($request->page_en_title, '-');
        $data['page_en_description'] = $request->page_en_description;
        $data['page_bn_description'] = $request->page_bn_description;
        $data['page_link'] = $request->page_link;

        $page_file =  $request->file('page_file');
        if ($page_file){
            $Extension = $page_file->getClientOriginalExtension();
            if ($Extension == "pdf"){
                $ImageName =time().".".$page_file->getClientOriginalExtension();
                $Path = "Images/page/file/";
                $url = $Path;
                $url_database = "/".$Path.$ImageName;
                $page_file->move($url, $ImageName);
                $data['page_file'] = $url_database;
            }else{
                $ImageName =time().".".$page_file->getClientOriginalExtension();
                $Path = "Images/page/image/";
                $ResizeImage = Image::make($page_file)->resize(1000,500);
                $url = $Path.$ImageName;
                $url_database = "/".$Path.$ImageName;
                $ResizeImage ->save($url);
                $data['page_file'] = $url_database;
            }
        }
        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = PageModel::insert($data);
        if ($res){
            return back()->with('success_message','Page Add Successfully!');
        }else{
            return back()->with('error_message','Page Add Fail!');
        }
    }

    public function PageEdit($id){
        $Page = PageModel::where('page_id',$id)->first();
        return view('Admin/Pages/Page/PageUpdate',compact('Page'));
    }

    public function PageUpdate(Request $request, $id){
        $request->validate([
            'page_en_title' => 'required|unique:page,page_en_title,'. $id .',page_id',
            'page_bn_title' => 'required|unique:page,page_bn_title,'. $id .',page_id',
            'page_file' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024', //only 1MB is allowed
        ]);

        $data =  array();
        $data['page_en_title'] = $request->page_en_title;
        $data['page_bn_title'] = $request->page_bn_title;
        $data['page_slug'] = Str::slug($request->page_en_title, '-');
        $data['page_en_description'] = $request->page_en_description;
        $data['page_bn_description'] = $request->page_bn_description;
        $data['page_link'] = $request->page_link;

        $page_file =  $request->file('page_file');
        if ($page_file){
            $Extension = $page_file->getClientOriginalExtension();
            if ($Extension == "pdf"){
                $ImageName =time().".".$page_file->getClientOriginalExtension();
                $Path = "Images/page/file/";
                $url = $Path;
                $url_database = "/".$Path.$ImageName;
                $page_file->move($url, $ImageName);
                $OldData = PageModel::where('page_id','=',$id)->select('page_file')->first();
                $OldImage = $OldData->page_file;
                $OldImageUrl = substr($OldImage, 1);
                if ($OldImage){
                    if (file_exists($OldImageUrl)){
                        unlink($OldImageUrl);
                        $data['page_file'] = $url_database;
                    }else{
                        $data['page_file'] = $url_database;
                    }
                }else{
                    $data['page_file'] = $url_database;
                }
            }else{
                $ImageName =time().".".$page_file->getClientOriginalExtension();
                $Path = "Images/page/image/";
                $ResizeImage = Image::make($page_file)->resize(1000,500);
                $url = $Path.$ImageName;
                $url_database = "/".$Path.$ImageName;
                $ResizeImage ->save($url);
                $OldData = PageModel::where('page_id','=',$id)->select('page_file')->first();
                $OldImage = $OldData->page_file;
                $OldImageUrl = substr($OldImage, 1);
                if ($OldImage){
                    if (file_exists($OldImageUrl)){
                        unlink($OldImageUrl);
                        $data['page_file'] = $url_database;
                    }else{
                        $data['page_file'] = $url_database;
                    }
                }else{
                    $data['page_file'] = $url_database;
                }
            }
        }

        $data['status'] = $request->status;
        $data['modifier'] = Auth::user()->id;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = PageModel::where('page_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Page Update Successfully!');
        }else{
            return back()->with('error_message','Page Update Fail!');
        }
    }

    public function PageDelete(Request $request){
        $id = $request->page_id;
        $OldData = PageModel::where('page_id','=',$id)->select('page_file')->first();
        $OldImage = $OldData->page_file;
        $OldImageUrl = substr($OldImage, 1);
        if ($OldImage){
            unlink($OldImageUrl);
        }
        $result= PageModel::where('page_id','=',$id)->delete();

        if($result==true){
            return back()->with('success_message','Page Delete Successfully!');
        }
        else{
            return back()->with('error_message','Page Delete Fail!');
        }
    }

}

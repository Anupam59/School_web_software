<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LinkModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function LinkIndex(){
        $Link = LinkModel::join('users as creator_by', 'creator_by.id', '=', 'link.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'link.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'link.*'
            )
            ->orderBy('link_id','desc')->paginate(15);

        return view('Admin/Pages/Link/LinkIndex',compact('Link'));
    }

    public function LinkCreate(){
        return view('Admin/Pages/Link/LinkCreate');
    }

    public function LinkEntry(Request $request){
        $validation = $request->validate([
            'link_en_title' => 'required|unique:link',
            'link_bn_title' => 'required|unique:link',
        ]);

        $data =  array();
        $data['link_en_title'] = $request->link_en_title;
        $data['link_bn_title'] = $request->link_bn_title;
        $data['link_url'] = $request->link_url;
        $data['link_type'] = $request->link_type;

        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = LinkModel::insert($data);

        if ($res){
            return back()->with('success_message','Link Add Successfully!');
        }else{
            return back()->with('error_message','Link Add Fail!');
        }

    }

    public function LinkEdit($id){
        $Link = LinkModel::where('link_id',$id)->first();
        return view('Admin/Pages/Link/LinkUpdate',compact('Link'));
    }

    public function LinkUpdate(Request $request, $id){

        $request->validate([
            'link_en_title' => 'required|unique:link,link_en_title,'. $id .',link_id',
            'link_bn_title' => 'required|unique:link,link_bn_title,'. $id .',link_id',
        ]);

        $data =  array();
        $data['link_en_title'] = $request->link_en_title;
        $data['link_bn_title'] = $request->link_bn_title;
        $data['link_url'] = $request->link_url;
        $data['link_type'] = $request->link_type;

        $data['status'] = $request->status;
        $data['modifier'] = Auth::user()->id;
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = LinkModel::where('link_id','=',$id)->update($data);

        if ($res){
            return back()->with('success_message','Link Update Successfully!');
        }else{
            return back()->with('error_message','Link Update Fail!');
        }

    }


    public function LinkDelete(Request $request){
        $id = $request->link_id;
        $result= LinkModel::where('link_id','=',$id)->delete();
        if($result==true){
            return back()->with('success_message','Link Delete Successfully!');
        }
        else{
            return back()->with('error_message','Link Delete Fail!');
        }

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class DesignationController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role_id > 2) {
                return redirect('admin/dashboard');
            }
            return $next($request);
        });
    }


    public function DesignationIndex(){
        $Designation = DesignationModel::join('users as creator_by', 'creator_by.id', '=', 'designation.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'designation.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'designation.*'
            )
            ->orderBy('designation_type','asc')
            ->orderBy('position','asc')
            ->paginate(20);
        return view('Admin/Pages/Designation/DesignationIndex',compact('Designation'));
    }

    public function DesignationCreate(){
        return view('Admin/Pages/Designation/DesignationCreate');
    }

    public function DesignationEntry(Request $request){
        $validation = $request->validate([
            'designation_en_title' => 'required|unique:designation',
            'designation_bn_title' => 'required|unique:designation',
        ]);
        $data =  array();
        $data['designation_en_title'] = $request->designation_en_title;
        $data['designation_bn_title'] = $request->designation_bn_title;
        $data['position'] = $request->position;
        $data['designation_type'] = $request->designation_type;

        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = DesignationModel::insert($data);
        if ($res){
            return back()->with('success_message','Designation Add Successfully!');
        }else{
            return back()->with('error_message','Designation Add Fail!');
        }
    }

    public function DesignationEdit($id){
        $Designation = DesignationModel::where('designation_id',$id)->first();
        return view('Admin/Pages/Designation/DesignationUpdate',compact('Designation'));
    }

    public function DesignationUpdate(Request $request, $id){
        $request->validate([
            'designation_en_title' => 'required|unique:designation,designation_en_title,'. $id .',designation_id',
            'designation_bn_title' => 'required|unique:designation,designation_bn_title,'. $id .',designation_id',
        ]);
        $data =  array();
        $data['designation_en_title'] = $request->designation_en_title;
        $data['designation_bn_title'] = $request->designation_bn_title;
        $data['position'] = $request->position;
        $data['designation_type'] = $request->designation_type;

        $data['status'] = $request->status;
        $data['modifier'] = Auth::user()->id;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = DesignationModel::where('designation_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Designation Update Successfully!');
        }else{
            return back()->with('error_message','Designation Update Fail!');
        }

    }

    public function DesignationDelete(Request $request){
        $id = $request->designation_id;
        $result= DesignationModel::where('designation_id','=',$id)->delete();
        if($result==true){
            return back()->with('success_message','Designation Delete Successfully!');
        }
        else{
            return back()->with('error_message','Designation Delete Fail!');
        }
    }
}

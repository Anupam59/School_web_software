<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeriodModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodController extends Controller
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

    public function PeriodIndex(){
        $Period = PeriodModel::join('users as creator_by', 'creator_by.id', '=', 'period.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'period.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'period.*'
            )
            ->orderBy('period_id','asc')->paginate(15);
        return view('Admin/Pages/Period/PeriodIndex',compact('Period'));
    }

    public function PeriodCreate(){
        return view('Admin/Pages/Period/PeriodCreate');
    }

    public function PeriodEntry(Request $request){
        $validation = $request->validate([
            'period_en_title' => 'required|unique:period',
            'period_bn_title' => 'required|unique:period',
        ]);
        $data =  array();
        $data['period_en_title'] = $request->period_en_title;
        $data['period_bn_title'] = $request->period_bn_title;

        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = PeriodModel::insert($data);
        if ($res){
            return back()->with('success_message','Period Add Successfully!');
        }else{
            return back()->with('error_message','Period Add Fail!');
        }
    }

    public function PeriodEdit($id){
        $Period = PeriodModel::where('period_id',$id)->first();
        return view('Admin/Pages/Period/PeriodUpdate',compact('Period'));
    }

    public function PeriodUpdate(Request $request, $id){
        $request->validate([
            'period_en_title' => 'required|unique:period,period_en_title,'. $id .',period_id',
            'period_bn_title' => 'required|unique:period,period_bn_title,'. $id .',period_id',
        ]);
        $data =  array();
        $data['period_en_title'] = $request->period_en_title;
        $data['period_bn_title'] = $request->period_bn_title;
        $data['period_status'] = $request->period_status;

        $period_status = $request->period_status;
        if($period_status == 1){
            PeriodModel::where('period_id','!=',$id)->update([
                'period_status'=> 0
            ]);
        }

        $data['status'] = $request->status;
        $data['modifier'] = Auth::user()->id;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = PeriodModel::where('period_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Period Update Successfully!');
        }else{
            return back()->with('error_message','Period Update Fail!');
        }

    }

    public function PeriodDelete(Request $request){
        $id = $request->period_id;
        $result= PeriodModel::where('period_id','=',$id)->delete();
        if($result==true){
            return back()->with('success_message','Period Delete Successfully!');
        }
        else{
            return back()->with('error_message','Period Delete Fail!');
        }
    }
}

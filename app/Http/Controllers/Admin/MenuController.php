<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItemModel;
use App\Models\MenuModel;
use App\Models\MenuSubItemModel;
use App\Models\MenuSubSubItemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role_id == 100) {
                return redirect('admin/dashboard');
            }
            return $next($request);
        });
    }

    public function MenuIndex(){

        $Menu = MenuModel::join('users as creator_by', 'creator_by.id', '=', 'menu.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'menu.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'menu.*'
            )
            ->orderBy('menu_id','asc')->paginate(1);
        return view('Admin/Pages/Menu/MenuIndex',compact('Menu'));
    }
    public function MenuCreate(){
        return view('Admin/Pages/Menu/MenuCreate');
    }
    public function MenuEntry(Request $request){
        $validation = $request->validate([
            'menu_title' => 'required|unique:menu',
        ]);
        $data =  array();
        $data['menu_title'] = $request->menu_title;

        $data['status'] = 1;
        $data['creator'] = 1;
        $data['modifier'] = 1;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = MenuModel::insert($data);

        if ($res){
            return back()->with('success_message','Menu Add Successfully!');
        }else{
            return back()->with('error_message','Menu Add Fail!');
        }

    }
    public function MenuEdit($id){
        $Menu = MenuModel::where('menu_id',$id)->first();
        return view('Admin/Pages/Menu/MenuUpdate',compact('Menu'));
    }
    public function MenuUpdate(Request $request, $id){

        $request->validate([
            'menu_title' => 'required|unique:menu,menu_title,'. $id .',menu_id'
        ]);

        $data =  array();
        $data['menu_title'] = $request->menu_title;

        $data['status'] = $request->status;
        $data['modifier'] = 1;
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = MenuModel::where('menu_id','=',$id)->update($data);

        if ($res){
            return back()->with('success_message','Menu Update Successfully!');
        }else{
            return back()->with('error_message','Menu Update Fail!');
        }

    }


    public function MenuItemIndex(){
        $MenuI = MenuItemModel::join('users as creator_by', 'creator_by.id', '=', 'menu_item.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'menu_item.modifier')
            ->leftJoin('menu', 'menu.menu_id', '=', 'menu_item.menu_id')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'menu.menu_title',
                'menu_item.*'
            )
            ->orderBy('menu_item_id','asc')->paginate(10);
        return view('Admin/Pages/Menu/MenuItemIndex',compact('MenuI'));
    }
    public function MenuItemCreate(){
        $Menu = MenuModel::where('status',1)->get();
        return view('Admin/Pages/Menu/MenuItemCreate',compact('Menu'));
    }
    public function MenuItemEntry(Request $request){
        $validation = $request->validate([
            'menu_id' => 'required',
            'menu_item_title' => 'required',
            'menu_item_bn_title' => 'required',
            'menu_item_link' => 'required',
        ]);
        $data =  array();
        $data['menu_id'] = $request->menu_id;
        $data['menu_item_title'] = $request->menu_item_title;
        $data['menu_item_bn_title'] = $request->menu_item_bn_title;
        $data['menu_item_link'] = $request->menu_item_link;

        $data['status'] = 1;
        $data['creator'] = 1;
        $data['modifier'] = 1;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = MenuItemModel::insert($data);

        if ($res){
            return back()->with('success_message','Menu Item Add Successfully!');
        }else{
            return back()->with('error_message','Menu Item Add Fail!');
        }

    }
    public function MenuItemEdit($id){
        $Menu = MenuModel::where('status',1)->get();
        $MenuItem = MenuItemModel::where('menu_item_id',$id)->first();
        return view('Admin/Pages/Menu/MenuItemUpdate',compact('Menu','MenuItem'));
    }
    public function MenuItemUpdate(Request $request, $id){

        $validation = $request->validate([
            'menu_id' => 'required',
            'menu_item_title' => 'required',
            'menu_item_bn_title' => 'required',
            'menu_item_link' => 'required',
        ]);

        $data =  array();
        $data['menu_id'] = $request->menu_id;
        $data['menu_item_title'] = $request->menu_item_title;
        $data['menu_item_bn_title'] = $request->menu_item_bn_title;
        $data['menu_item_link'] = $request->menu_item_link;

        $data['status'] = $request->status;
        $data['modifier'] = 1;
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = MenuItemModel::where('menu_item_id','=',$id)->update($data);

        if ($res){
            return back()->with('success_message','Menu Item Update Successfully!');
        }else{
            return back()->with('error_message','Menu Item Update Fail!');
        }

    }


    public function MenuSubItemIndex(){

        $MenuSubItem = MenuSubItemModel::join('users as creator_by', 'creator_by.id', '=', 'menu_sub_item.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'menu_sub_item.modifier')
            ->leftJoin('menu', 'menu.menu_id', '=', 'menu_sub_item.menu_id')
            ->leftJoin('menu_item', 'menu_item.menu_item_id', '=', 'menu_sub_item.menu_item_id')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'menu.menu_title',
                'menu_item.menu_item_title',
                'menu_sub_item.*'
            )
            ->orderBy('menu_sub_item_id','asc')->paginate(10);
        return view('Admin/Pages/Menu/MenuSubItemIndex',compact('MenuSubItem'));
    }
    public function MenuSubItemCreate(){
        $Menu = MenuModel::where('status',1)->select('menu_id','menu_title')->get();
        return view('Admin/Pages/Menu/MenuSubItemCreate',compact('Menu'));
    }
    public function MenuSubItemEntry(Request $request){
        $validation = $request->validate([
            'menu_id' => 'required',
            'menu_item_id' => 'required',
            'menu_sub_item_title' => 'required',
            'menu_sub_item_bn_title' => 'required',
            'menu_sub_item_link' => 'required',
        ]);
        $data =  array();
        $data['menu_id'] = $request->menu_id;
        $data['menu_item_id'] = $request->menu_item_id;
        $data['menu_sub_item_title'] = $request->menu_sub_item_title;
        $data['menu_sub_item_bn_title'] = $request->menu_sub_item_bn_title;
        $data['menu_sub_item_link'] = $request->menu_sub_item_link;

        $data['status'] = 1;
        $data['creator'] = 1;
        $data['modifier'] = 1;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = MenuSubItemModel::insert($data);

        if ($res){
            return back()->with('success_message','Menu Sub Item Add Successfully!');
        }else{
            return back()->with('error_message','Menu Sub Item Add Fail!');
        }
    }
    public function MenuSubItemEdit($id){
        $Menu = MenuModel::where('status',1)->get();
        $MenuSubItem = MenuSubItemModel::where('menu_sub_item_id',$id)->first();
        $menu_id = $MenuSubItem->menu_id;
        $MenuItem = MenuItemModel::where('menu_id',$menu_id)->where('status',1)->get();


        return view('Admin/Pages/Menu/MenuSubItemUpdate',compact('Menu','MenuSubItem','MenuItem'));
    }
    public function MenuSubItemUpdate(Request $request, $id){

        $validation = $request->validate([
            'menu_id' => 'required',
            'menu_item_id' => 'required',
            'menu_sub_item_title' => 'required',
            'menu_sub_item_bn_title' => 'required',
            'menu_sub_item_link' => 'required',
        ]);

        $data =  array();
        $data['menu_id'] = $request->menu_id;
        $data['menu_item_id'] = $request->menu_item_id;
        $data['menu_sub_item_title'] = $request->menu_sub_item_title;
        $data['menu_sub_item_bn_title'] = $request->menu_sub_item_bn_title;
        $data['menu_sub_item_link'] = $request->menu_sub_item_link;

        $data['status'] = $request->status;
        $data['modifier'] = 1;
        $data['modified_date'] = date("Y-m-d h:i:s");

        $res = MenuSubItemModel::where('menu_sub_item_id','=',$id)->update($data);

        if ($res){
            return back()->with('success_message','Menu Sub Item Update Successfully!');
        }else{
            return back()->with('error_message','Menu Sub Item Update Fail!');
        }

    }


}

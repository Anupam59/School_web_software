<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignationModel;
use App\Models\DistrictModel;
use App\Models\MenuItemModel;
use App\Models\MenuSubItemModel;
use App\Models\PeriodModel;
use App\Models\SubCategoryModel;
use App\Models\SubSubCategoryModel;
use App\Models\UpazilaModel;
use Illuminate\Http\Request;

class AxiosCallController extends Controller
{
    public function DesignationGetData(Request $request){
        $type = $request->designation_type;
        $result = DesignationModel::where('status',1)->where('designation_type',$type)->select('designation_id','designation_en_title')
            ->orderBy('position','asc')->get();
        $data = array();
        $data[] = "<option value='' selected>Select One</option>";
        foreach ($result as $row){
            $data[] = "<option value='".$row->designation_id."'>".$row->designation_en_title."</option>";
        }
        return $data;
    }

    public function PeriodGetData(Request $request){
        $result = PeriodModel::where('status',1)->select('period_id','period_en_title')->get();
        $data = array();
        $data[] = "<option value='' selected>Select One</option>";
        foreach ($result as $row){
            $data[] = "<option value='".$row->period_id."'>".$row->period_en_title."</option>";
        }
        return $data;
    }

    public function MenuItemGetData(Request $request){
        $menu_id = $request->input('menu_id');
        $result = MenuItemModel::where('menu_id','=',$menu_id)->where('status',1)->select('menu_item_id','menu_item_title')->get();
        $data = array();
        $data[] = "<option value='' selected>Select One</option>";
        foreach ($result as $row){
            $data[] = "<option value='".$row->menu_item_id."'>".$row->menu_item_title."</option>";
        }
        return $data;
    }

}

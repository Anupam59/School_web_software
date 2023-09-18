<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventImageModel;
use App\Models\EventModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    public function EventIndex(){
        $Event = EventModel::join('users as creator_by', 'creator_by.id', '=', 'event.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'event.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'event.*'
            )
            ->orderBy('event_id','desc')->paginate(15);
        return view('Admin/Pages/Event/EventIndex',compact('Event'));
    }

    public function EventCreate(){
        return view('Admin/Pages/Event/EventCreate');
    }

    public function EventEntry(Request $request){
        $validation = $request->validate([
            'event_en_title' => 'required|unique:event',
            'event_bn_title' => 'required|unique:event',
            'event_image' => 'image',
        ]);
        $data =  array();
        $data['event_en_title'] = $request->event_en_title;
        $data['event_bn_title'] = $request->event_bn_title;
        $data['event_en_description'] = $request->event_en_description;
        $data['event_bn_description'] = $request->event_bn_description;
        $event_image =  $request->file('event_image');
        if ($event_image){
            $ImageName =time().".".$event_image->getClientOriginalExtension();
            $Path = "Images/event/";
            $ResizeImage = Image::make($event_image)->resize(750,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $data['event_image'] = $url_database;
        }
        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $EventId = EventModel::insertGetId($data);

        $more_images =  $request->file('event_img');
        if($more_images){
            $index = 0;
            foreach($more_images as $image){
                $ImageName =time().$index.'.'.$image->getClientOriginalExtension();
                $Path = "Images/event/event-image/";
                $ResizeImage = Image::make($image)->resize(750,400);
                $url = $Path.$ImageName;
                $url_database = "/".$Path.$ImageName;
                $ResizeImage ->save($url);

                $result = EventImageModel::insert([
                    'event_id' => $EventId,
                    'event_img' => $url_database,
                    'creator' => Auth::user()->id,
                    'modifier' => Auth::user()->id,
                    'created_date' => date("Y-m-d h:i:s"),
                    'modified_date' => date("Y-m-d h:i:s")
                ]);
                $index++;
            }
        }

        if ($EventId){
            return back()->with('success_message','Event Add Successfully!');
        }else{
            return back()->with('error_message','Event Add Fail!');
        }
    }

    public function EventEdit($id){
        $Event = EventModel::where('event_id',$id)->first();
        return view('Admin/Pages/Event/EventUpdate',compact('Event'));
    }

    public function EventUpdate(Request $request, $id){
        $request->validate([
            'event_en_title' => 'required|unique:event,event_en_title,'. $id .',event_id',
            'event_bn_title' => 'required|unique:event,event_bn_title,'. $id .',event_id',
            'event_image' => 'image',
        ]);
        $data =  array();
        $data['event_en_title'] = $request->event_en_title;
        $data['event_bn_title'] = $request->event_bn_title;
        $data['event_en_description'] = $request->event_en_description;
        $data['event_bn_description'] = $request->event_bn_description;
        $event_image =  $request->file('event_image');
        if ($event_image){
            $ImageName =time().'.'.$event_image->getClientOriginalExtension();
            $Path = "Images/event/";
            $ResizeImage = Image::make($event_image)->resize(750,400);
            $url = $Path.$ImageName;
            $url_database = "/".$Path.$ImageName;
            $ResizeImage ->save($url);
            $OldData = EventModel::where('event_id','=',$id)->select('event_image')->first();
            $OldImage = $OldData->event_image;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                    $data['event_image'] = $url_database;
                }else{
                    $data['event_image'] = $url_database;
                }
            }else{
                $data['event_image'] = $url_database;
            }
        }
        $data['status'] = $request->status;
        $data['modifier'] = Auth::user()->id;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = EventModel::where('event_id','=',$id)->update($data);


        $more_images =  $request->file('event_img');
        if ($more_images){
            $index = 0;
            foreach($more_images as $image){
                $ImageName = time().$index.'.'.$image->getClientOriginalExtension();
                $Path = "Images/event/event-image/";
                $ResizeImage = Image::make($image)->resize(750,400);
                $url = $Path.$ImageName;
                $url_database = "/".$Path.$ImageName;
                $ResizeImage ->save($url);

                $result = EventImageModel::insert([
                    'event_id' => $id,
                    'event_img' => $url_database,
                    'creator' => Auth::user()->id,
                    'modifier' => Auth::user()->id,
                    'created_date' => date("Y-m-d h:i:s"),
                    'modified_date' => date("Y-m-d h:i:s")
                ]);
                $index++;
            }
        }

        if ($res){
            return back()->with('success_message','Event Update Successfully!');
        }else{
            return back()->with('error_message','Event Update Fail!');
        }

    }


    public function EventDelete(Request $request){
        $id = $request->event_id;
        $OldData = EventModel::where('event_id','=',$id)->select('event_image')->first();
        $OldImage = $OldData->event_image;
        $OldImageUrl = substr($OldImage, 1);
        if ($OldImage){
            if (file_exists($OldImageUrl)){
                unlink($OldImageUrl);
            }
        }
        $result= EventModel::where('event_id','=',$id)->delete();
        $more_images =  EventImageModel::where('event_id','=',$id)->get();
        if ($more_images){
            foreach($more_images as $image){
                $OldImage = $image->event_img;
                $OldImageUrl = substr($OldImage, 1);
                if ($OldImage){
                    if (file_exists($OldImageUrl)){
                        unlink($OldImageUrl);
                    }
                }
            }
            EventImageModel::where('event_id','=',$id)->delete();
        }

        if($result==true){
            return back()->with('success_message','Event Delete Successfully!');
        }
        else{
            return back()->with('error_message','Event Delete Fail!');
        }
    }




    public function EventImgShow(Request $request){
        $event_id = $request->input('event_id');
        $result = EventImageModel::where('event_id','=',$event_id)->get();
        return $result;
    }

    public function EventImageDelete(Request $request){
        $event_image_id = $request->input('event_image_id');
        $OldData = EventImageModel::where('event_image_id','=',$event_image_id)->first();
        $OldImage = $OldData->event_img;
        $OldImageUrl = substr($OldImage, 1);

        if ($OldImage){
            if (file_exists($OldImageUrl)){
                unlink($OldImageUrl);
                $result = EventImageModel::where('event_image_id','=',$event_image_id)->delete();
            }else{
                $result = EventImageModel::where('event_image_id','=',$event_image_id)->delete();
            }
        }else{
            $result = EventImageModel::where('event_image_id','=',$event_image_id)->delete();
        }

        if($result){
            return 1;
        }else{
            return 0;
        }

    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function LanguageChange(Request $request){

        $url = \request('url');
        $lang = \request('lang');

//        print_r($lang); die();

        App::setLocale($lang);
        if($lang == "en"){
            session()->put('locale', $lang);
            return redirect($url);
        }else{
            session()->put('locale', $lang);
            return redirect($url);
        }
    }
}

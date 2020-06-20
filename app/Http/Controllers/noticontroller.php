<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notification;
use Carbon\Carbon;
class noticontroller extends Controller
{
    public function checknewNoti(Request $request){
        $lasttime = $request->time_lastNoti;
        $kk=$request->kk;
        $lastNoti= notification::orderBy('created_at','desc')->first()->created_at;
        
        if($lasttime<$lastNoti){
            return 1;
        }else{
            return 0;
        }
    }
}

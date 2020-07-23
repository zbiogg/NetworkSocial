<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\notification;
use  Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Resources\notification as notiResource;
class notificationcontroller extends Controller
{
    public function getNotification(){
      return  [
          'success' => true,
         'notifications'=> notiResource::collection(notification::where('receiverID',Auth::user()->id)->orderBy('created_at','desc')->paginate(10))
      ];
        }
}

<?php

namespace App\Http\Controllers;

use App\message;
use Illuminate\Http\Request;

class RedisController extends Controller
{
    public function viewChat(){
        $messages = message::all();
        return view('chat',compact('messages'));
    }
}

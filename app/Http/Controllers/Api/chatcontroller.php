<?php

namespace App\Http\Controllers\Api;

use App\Events\RedisEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\message;
use App\User;
class chatcontroller extends Controller
{
    public function sendMessage(Request $request){
        $CreateMessage= new message();
        $CreateMessage->message=$request->message;
        $CreateMessage->fromID=$request->fromID;
        $CreateMessage->toID=$request->toID;
        if($request->message!=''){
            $CreateMessage->save();
            event(
                $e = new RedisEvent($CreateMessage)
            );   
        }
        return response()->json([
            'from' => User::find($request->fromID),
            'to' => User::find($request->toID),
            'message' =>  $CreateMessage->message
        ]);
    }
}

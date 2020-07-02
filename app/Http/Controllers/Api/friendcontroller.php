<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\relationship;
use Illuminate\Support\Facades\Auth; 
use App\User;

class friendcontroller extends Controller
{
    public function addFriend(Request $request){
    	$send_id=$request->receiverID;
    	$rela=new relationship;
    	if(Auth::user()->id<$send_id){
    		$rela->userID_1=Auth::user()->id;
    		$rela->userID_2=$send_id;
    	}else{
    		$rela->userID_1=$send_id;
			$rela->userID_2=Auth::user()->id;
    	}
		
		$rela->status=0;
		$rela->action_userID=Auth::user()->id;
        $rela->save();
        return response()->json($rela);

    }

    public function requestFriends(){
        $rq = relationship::where('action_userID','!=',Auth::user()->id)
        ->where('status',0)
        ->where(function ($query){
            $query->where('userID_1',Auth::user()->id)
            ->orWhere('userID_2',Auth::user()->id);
        })->get('action_userID');
        $users_rq = User::find($rq);
        return response()->json($users_rq);
    } 

    // public function acceptFriend(Request $request){
    // 	$sender_ID=$request->senderID;
    // 	if(Auth::user()->id<$sender_ID){
    // 		$rl=relationship::where('userID_1',Auth::user()->id)->where('userID_2',$sender_ID)->update(['status'=> 1,'action_userID'=>Auth::user()->id]);
    // 	}else{
    // 		$rl=relationship::where('userID_1',$sender_ID)->where('userID_2',Auth::user()->id)->update(['status'=> 1,'action_userID'=>Auth::user()->id]);
	// 	}
	// 	return response()->json($rl);
	// }
	//  public function deleteRequest(Request $request){
	// 	$sender_ID=$request->senderID;
    // 	if(Auth::user()->id<$sender_ID){
    // 		$rl=relationship::where('userID_1',Auth::user()->id)->where('userID_2',$sender_ID)->delete();
    // 	}else{
    // 		$rl=relationship::where('userID_1',$sender_ID)->where('userID_2',Auth::user()->id)->delete();
	// 	}
	// 	return response()->json($rl);
		
	//  }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\relationship;
use PhpParser\Node\Expr\FuncCall;

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


    }

    public function acceptFriend(Request $request){
    	$sender_ID=$request->senderID;
    	if(Auth::user()->id<$sender_ID){
    		$rl=relationship::where('userID_1',Auth::user()->id)->where('userID_2',$sender_ID)->update(['status'=> 1,'action_userID'=>Auth::user()->id]);
    	}else{
    		$rl=relationship::where('userID_1',$sender_ID)->where('userID_2',Auth::user()->id)->update(['status'=> 1,'action_userID'=>Auth::user()->id]);
		}
		return response()->json($rl);
	}
	 public function deleteRequest(Request $request){
		$sender_ID=$request->senderID;
    	if(Auth::user()->id<$sender_ID){
    		$rl=relationship::where('userID_1',Auth::user()->id)->where('userID_2',$sender_ID)->delete();
    	}else{
    		$rl=relationship::where('userID_1',$sender_ID)->where('userID_2',Auth::user()->id)->delete();
		}
		return response()->json($rl);
		
	 }
}

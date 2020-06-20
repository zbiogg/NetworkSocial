<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\posts;
use Illuminate\Support\Facades\Auth;

class admincontroller extends Controller
{
    public function postLogin(Request $request){
        $arr1 = [
    		'email' => $request->login_username,
            'password' => $request->login_password,
            'auth' => '1'
    	];
        $arr2 = [
            'username' => $request->login_username,
            'password' => $request->login_password,
            'auth' => '1'
        ];
    	if(Auth::attempt($arr1)){
    		return redirect('/admin');
    	}
        else if(Auth::attempt($arr2))
        {
            return redirect('/admin');
        }
    	else{
    		return redirect()->back()->with('message','Tài khoản hoặc mật khẩu không chính xác');
    	}
    }

    public function blockUser(Request $request){
        $user=$request->uid;
        if(User::find($user)->status==0){
            User::where('id',$user)->update(['status' => 1]);
            Posts::where('userID',$user)->where('status',0)->update(['status'=>2]);
        }else{
            User::where('id',$user)->update(['status' => 0]);
            posts::where('userID',$user)->where('status',2)->update(['status'=>0]);
        }
        
        $stt=User::find($user)->status;
        return response()->json($stt);
    }

    public function deleteUser(Request $request){
        $user=$request->uid;
        User::where('id',$user)->delete();
    }

    public function blockPost(Request $request){
        $post=$request->pid;
        if(posts::where('postID',$post)->first()->status==0){
            posts::where('postID',$post)->update(['status' => 1]);
        }else{
            posts::where('postID',$post)->update(['status' => 0]);
        }
        
        $stt=posts::where('postID',$post)->first()->status;
        return response()->json($stt);
    }

    public function deletePost(Request $request){
        $post=$request->pid;
        posts::where('postID',$post)->delete();

    }
}

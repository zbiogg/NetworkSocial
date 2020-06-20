<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Auth;
use App\User;


class logincontroller extends Controller
{
    public function GetLogin(){
        if(Auth::check()){
           return redirect('/'); 
        }
    	else return view('/login');
    }
    public function PostLogin(Request $request){
        $request->validate([
            'login_username'=>'required',
            'login_password' => 'required'
        ]);

    	$arr1 = [
    		'email' => $request->login_username,
            'password' => $request->login_password
    	];
        $arr2 = [
            'username' => $request->login_username,
            'password' => $request->login_password
        ];
    	if(Auth::attempt($arr1) || Auth::attempt($arr2)){
            if($userlogin=User::where('username',$request->login_username)->orwhere('email',$request->login_username)->first()){
                $statusUser=$userlogin->status;
            }
            
            if($statusUser==0){
                return redirect('/');
            }else{
                Auth::logout();
                return redirect()->back()->with('userblock','Tài khoản của bạn đã bị vô hiệu hóa');
            }
    	}
    	else{
    		return redirect()->back()->with('message','Tài khoản hoặc mật khẩu không chính xác');
    	}
    
	}
	public function Logout(){
        if(Auth::user()->auth == 0){
            Auth::logout();
            return redirect('login');
        }else{
            Auth::logout();
            return redirect('login-admin');
        }
		
	}
    

    


}

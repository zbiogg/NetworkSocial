<?php

namespace App\Http\Controllers;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class registercontroller extends Controller
{
    public function GetSignup(){
        if(Auth::check()){
           return redirect('/'); 
        }
        else return view('/signup');
    }


    public function PostSignup(Request $request){
    	$arr = [
    		'email' => $request->register_email,
    		'password' => bcrypt($request->register_password),
    		'firstName' => $request->register_firstName,
    		'lastName' => $request->register_lastName,
    		'doB'=>$request->register_doB,
    		'username'=>$request->register_username,
    		'gender'=>$request->register_gender,
    		'phone'=>$request->register_phone
    	];
        if(User::where('username',$request->register_username)->orwhere('email',$request->register_email)->first()){
            return redirect('/signup')->with('emptyuser','Tài khoản đã tồn tại!');
        }else{
            if(User::insert($arr)){
                return redirect('/login')->with('dangkythanhcong','Đăng kí thành công, mời bạn đăng nhập');
    
            }
        }  
        
    }
}

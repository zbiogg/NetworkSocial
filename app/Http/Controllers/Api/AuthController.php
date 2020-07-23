<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  Illuminate\Support\Facades\Auth;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{
    public function checklogin(){
        return [
            'success' => true,
            'message' => 'token alive'
        ];
    }
    public function login(Request $request){
        $loginemail = $request->only('email','password');
        $loginusername = $request->only('username','password');
        if($token=JWTAuth::attempt($loginusername)){
            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => Auth::user()
            ]);
        }elseif($token=JWTAuth::attempt($loginemail)){
            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => Auth::user()
            ]);
        }else{
            return response()->json([
                'success' => true,
                'message' => "đăng nhập thất bại"
            ]);
        }
        
    }

    public function register(Request $request){
        try {
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
            $checkusername =User::where('username',$request->username)->first();
            $checkemail =User::where('email',$request->email)->first();
            if($checkusername==$request->username or $checkemail){
                return response()->json([
                    'success' => false,
                    'message' => 'Tài khoản đã tồn tại'
                ]);
            }else{
                $user = new User;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->firstName = $request->firstName;
                $user->lastName = $request->lastName;
                $user->doB =$request->doB;
                $user->username=$request->username;
                $user->gender=$request->gender;
                $user->phone=$request->phone;
                $user->save();
                return [
                    'success' => true,
                    'username' => $request->username,
                    'email' => $request->email
                ];
                
        
                
            }
            
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th
            ]);
        }
    }

    //
    public function logout(Request $request){
        try {
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return \response()->json([
               'success' => true,
               'message' => 'đăng xuất thành công' 
            ]);
        } catch (\Throwable $th) {
            //throw $th
            return \response()->json([
                'success' => false  ,
                'message' => 'đăng xuất thất bại: '.$th 
             ]);
        }

    }
}

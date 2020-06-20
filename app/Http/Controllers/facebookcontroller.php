<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class facebookcontroller extends Controller
{
    public function loginfb(){
        return Socialite::driver('facebook')->fields([
            'first_name', 'last_name', 'middle_name','email', 'gender', 'birthday'
        ])->redirect();
    }

    public function callback(){
         $user = Socialite::with('facebook')->fields([
            'first_name', 'last_name','middle_name', 'email'
        ])->user();
		   $authUser = $this->getOrCreateUser($user);
       	if(Auth()->login($authUser)){
			if($userlogin=User::where('email',$user->email)->first()){
                $statusUser=$userlogin->status;
            }
            
            if($statusUser==0){
                return redirect('/');
            }else{
                Auth::logout();
                return redirect()->back()->with('userblock','Tài khoản của bạn đã bị vô hiệu hóa');
            }
		}
       	return redirect('/');
    }
    private function getOrCreateUser($user){
    	if($authUser = User::where('fbID',$user->id)->first()){
    		return $authUser;
    	}else{
    		$url= substr($user->avatar, 0, -11).'width=1000';
    		$image=file_get_contents($url);
    		file_put_contents(public_path('img/avt/'.$user->id.'.png'), $image);

    		$arr = [
			'email' => $user->email,
			'password'=> bcrypt('matkhautamthoi@123'),
    		'firstName' => $user->user['middle_name'].' '.$user->user['first_name'],
    		'lastName' => $user->user['last_name'],
    		'doB'=> '1999-10-26',
    		'username'=>explode('@', $user->email)[0],
    		'gender'=>'Nam',
    		'fbID'=>$user->id,
    		'img_avt'=> $user->id.'.png'
   		
    		];
    		
    		User::insert($arr);
    	}

    }
}

<?php

namespace App\Http\Controllers;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\notification;

class profilecontroller extends Controller
{
    //
    public function GetProfile(Request $request){
		if($id=$request->get('id')){
		return view('profile',['id'=>$id]);
		}else{
			return view('profile',['id'=>Auth::	user()->id]);
		}
	
	
	}

	public function getFriends(Request $request){
		if($id=$request->get('uid')){
			return view('friends.friends',['id'=>$id]);
		}
	}

	public function getPhotos(Request $request){
		if($id=$request->get('uid')){
			return view('photos.photos',['id'=>$id]);
		}
	}

	public function editAvt(Request $request){

		if($request->hasFile('img_avt')){
			$file=$request->img_avt;
			$url_file=time().'_'.$file->getClientOriginalName();
			$file->move('img/avt', $url_file);
		}else{
			$url_file=$request->img_hidden;
		}
		$avt = User::where('id',Auth::user()->id)->update([
			'img_avt' => $url_file
		]);
		
	}

	public function editCover(Request $request){

		if($request->hasFile('img_cover')){
			$file=$request->img_cover;
			$url_file=time().'_'.$file->getClientOriginalName();
			$file->move('img/cover', $url_file);
		}else{
			$url_file=$request->img_hidden;
		}
		$cover = User::where('id',Auth::user()->id)->update([
			'img_cover' => $url_file
		]);
		return response()->json($url_file);
	}

	public function editInfo(Request $request){
		$edit_password=[
			'lastName' => $request->edit_lastName,
			'firstName'=> $request->edit_firstName,
			'email' =>$request->edit_email,
			'doB' =>$request->edit_doB,
			'gender' =>$request->edit_gender,
			'phone' => $request->edit_phone,
			'city' => $request->edit_city,
			'about' => $request->edit_about,
			'password' => bcrypt($request->edit_password)
			
		];
		$edit_normal=[
			'lastName' => $request->edit_lastName,
			'firstName'=> $request->edit_firstName,
			'email' =>$request->edit_email,
			'doB' =>$request->edit_doB,
			'gender' =>$request->edit_gender,
			'phone' => $request->edit_phone,
			'city' => $request->edit_city,
			'about' => $request->edit_about
			
		];
		if($request->edit_password!=null){
			User::where('id',Auth::user()->id)->update($edit_password);
		}else{
			User::where('id',Auth::user()->id)->update($edit_normal);
		}
		
	}

	public function readNoti(){
		$noti=notification::where('receiverID',Auth::user()->id)->update(['status'=>'1']);
		return response()->json($noti);
	}

}

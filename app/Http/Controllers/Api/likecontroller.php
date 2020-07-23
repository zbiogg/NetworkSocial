<?php

namespace App\Http\Controllers\Api;

use  Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\like;
use App\notification;
use App\posts;
class likecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $receiver=posts::where('postID',$request->postID)->first();
        if(like::where('postID',$request->postID)->where('like_userID',Auth::user()->id)->first()){
            $message = 'liked';      
        }else{
            $message = 'disliked';
        }

        return [
            'success' => true,
            'message' =>$message,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postID=$request->postID;
        $receiver=posts::where('postID',$postID)->first();
        if(like::where('postID',$request->postID)->where('like_userID',Auth::user()->id)->first()){
            $like =like::where('postID',$request->postID)->where('like_userID',Auth::user()->id)->delete();
            notification::where('senderID',Auth::user()->id)->where('receiverID',$receiver->userID)->delete();
            $message = 'disliked';
        }else{
            $like = new like;
            $like->like_userID = Auth::user()->id;
            $like->postID = $request->postID;
            $like->save();
            $message = 'liked';
            if(Auth::user()->id !=$receiver->userID){
                $noti= new notification;
                $noti->senderID=Auth::user()->id;
                $noti->receiverID=$receiver->userID;
                $noti->url="posts/".$postID;
                $noti->message=" đã thích bài viết của bạn.";
                $noti->status=0;
                $noti->save();
            }
        }

        return [
            'success' => true,
            'message' =>$message,
            'like_qty' =>like::where('postID',$request->postID)->count(),
            'like' => $like
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $like = like::where('like_id',$id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return like::update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        like::where('like_ID',$id)->delete();
    }
}

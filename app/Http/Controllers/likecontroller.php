<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\like;
use App\notification;
use App\posts;
use Auth;

class likecontroller extends Controller
{
    public function likePost(Request $request){
        $postID=$request->postID;
        $receiver=posts::where('postID',$postID)->first();
        if(like::where('postID',$postID)->where('like_userID',Auth::user()->id)->first()){
            like::where('postID',$postID)->where('like_userID',Auth::user()->id)->delete();
            notification::where('senderID',Auth::user()->id)->where('receiverID',$receiver->userID)->delete();
            return 0;
        }else{
            $like= new like;
            $like->like_userID=Auth::user()->id;
            $like->postID=$postID;
            $like->save();

            if(Auth::user()->id !=$receiver->userID){
                $noti= new notification;
                $noti->senderID=Auth::user()->id;
                $noti->receiverID=$receiver->userID;
                $noti->url="posts/".$postID;
                $noti->message=" đã thích bài viết của bạn.";
                $noti->status=0;
                $noti->save();
            }
            return 1;
            

        }
    }
}

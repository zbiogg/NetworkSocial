<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;
use App\replycomment;
use App\notification;
use App\posts;
use Illuminate\Support\Facades\Auth;
class commentcontroller extends Controller
{
    public function addCmt(Request $request){
        $cmt = new comment;
        $cmt->postID=$request->postID;
        $cmt->userID=Auth::user()->id;
        $cmt->content_cmt=$request->content_cmt;
        $cmt->save();
        $receiver=posts::where('postID',$request->postID)->first();
        if(Auth::user()->id !=$receiver->userID){
            $noti= new notification;
            $noti->senderID=Auth::user()->id;
            $noti->receiverID=$receiver->userID;
            $noti->url="posts/".$request->postID;
            $noti->message=" đã bình luận viết của bạn.";
            $noti->status=0;
            $noti->save();
        }
        
        return response()->json($cmt);

    }

    public function addrepCmt(Request $request){
        $repcmt= new replycomment;
        $repcmt->comment_ID=$request->cmtID;
        $repcmt->userID=$request->userID;
        $repcmt->content_repcmt=$request->input_rep_content;
        $repcmt->save();
        $receiver=comment::where('id',$request->cmtID)->first();
        if(Auth::user()->id !=$receiver->userID){ 
            $noti= new notification;
            $noti->senderID=Auth::user()->id;
            $noti->receiverID=$receiver->userID;
            $noti->url="posts/".$receiver->postID;
            $noti->message=" đã trả lời bình luận của bạn.";
            $noti->status=0;
            $noti->save();
        }
        return response()->json($repcmt);
        
    }
}

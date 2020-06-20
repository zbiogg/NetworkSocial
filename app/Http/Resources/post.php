<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\user as userResource;
use App\User;
use App\like;
use  Illuminate\Support\Facades\Auth;
use App\comment;
class post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user=User::find($this->userID);
        $like_qty=like::where('postID',$this->postID)->count();
        $cmt_qty=comment::where('postID',$this->postID)->count();
        $like=like::where('postID',$this->postID)->where('like_userID',Auth::user()->id)->count();
        return [
            'postID' => $this->postID,
            'userID' => $this->userID,
            'post_Content' => $this->post_Content,
            'post_Image' => $this->post_Image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'userfullname' => $user->lastName." ".$user->firstName,
            'userAvt' => $user->img_avt,
            'like_qty' => $like_qty,
            'cmt_qty' => $cmt_qty,
            'liked' => $like
        ];
    }
}

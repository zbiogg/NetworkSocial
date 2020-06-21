<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use  Illuminate\Support\Facades\Auth;
use App\replycomment;

class comment extends JsonResource
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
        $cmt_qty=replycomment::where('comment_ID',$this->id)->count();
        return [
            'id' => $this->id,
            'postID' => $this->postID,
            'userID' => $this->userID,
            'content_cmt' =>$this->content_cmt,
            'created_at' =>$this->created_at,
            'updated_at' => $this->updated_at,
            'userfullname' => $user->lastName." ".$user->firstName,
            'userAvt' => $user->img_avt,
            'repcmt_qty' => $cmt_qty
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
class replycomment extends JsonResource
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
        return [
            'id' => $this->id,
            'comment_ID' => $this->comment_ID,
            'userID' => $this->userID,
            'content_repcmt' =>$this->content_repcmt,
            'created_at' =>$this->created_at,
            'updated_at' => $this->updated_at,
            'userfullname' => $user->lastName." ".$user->firstName,
            'userAvt' => $user->img_avt
        ];
    }
}

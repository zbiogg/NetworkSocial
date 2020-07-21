<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class notification extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user=User::find($this->senderID);
        return [
            'id' => $this->id,
            'senderID' => $this->senderID,
            'sender_fullname' => $user->lastName." ".$user->firstName,
            'sender_Avt' => $user->img_avt,
            'receiverID' =>$this->receiverID,
            'url' => $this->url,
            'message' => $this->message,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}

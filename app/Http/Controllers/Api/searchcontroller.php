<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\posts;
use App\User;
use App\relationship;
use App\Http\Resources\post as postResource;
use App\Http\Resources\user as userResource;
use Illuminate\Support\Facades\Auth; 

class searchcontroller extends Controller
{
    public function search(Request $request){
        $key_search = $request->key_search;
        $search_users =User::where('id','<>',Auth::user()->id)->where(function ($q) use ($key_search) {
            $q->whereRaw("concat(firstName, ' ', lastName) LIKE '%".$key_search."%'")
            ->orWhereRaw("concat(lastName, ' ', firstName) LIKE '%".$key_search."%'");
        })->paginate(5);
        $search_posts = posts::where('post_Content','like','%'.$key_search.'%')->paginate(5);
        return response()->json([
            'success' => true,
            'search_users' => userResource::collection($search_users),
            'search_posts' => postResource::collection($search_posts)
        ]);
    }
}

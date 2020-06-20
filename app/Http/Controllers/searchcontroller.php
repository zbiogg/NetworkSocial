<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\posts;
use Illuminate\Support\Facades\Redirect;

class searchcontroller extends Controller
{
    public function viewsearch(Request $request){
        if($request->content){
            return view('search',['s_content'=>$request->get('content')]);
        }else{
            return view('search',['s_content'=>'']);
        }
        
    }
}

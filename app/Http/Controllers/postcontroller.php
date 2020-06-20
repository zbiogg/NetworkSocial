<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\posts;
use App\relationship;
use Illuminate\Support\Facades\Auth;

class postcontroller extends Controller
{

	public function showpost($postID){
		return view('post',['postID'=>$postID]);
	}

    public function CreatePost(Request $request){
    		
	    	$CreatePost= new posts;
	    	$CreatePost->userID=Auth::user()->id;
	    	$CreatePost->post_Content=$request->content_post;
	    	if($file=$request->file('img_post')){
    			$url_file=time().'_'.$file->getClientOriginalName();
    			$file->move('img/posts', $url_file);
    			$CreatePost->post_Image=$url_file;
	    	}
	    	if($request->content_post!=''||$file=$request->file('img_post')){
				$CreatePost->save();
	    		
			}
			return response()->json($CreatePost);
    	

    	
    }

    public function deletePost(Request $request){
		$postID=$request->postID;
    	posts::where('postID',$postID)->delete();
		return response()->json($postID);
	}
	
	public function editPost(Request $request){
		$postID=$request->postid_hidden;
		if(	$file=$request->img_post){

			$url_file=time().'_'.$file->getClientOriginalName();
			$file->move('img/posts', $url_file);
		}else{
			$url_file=$request->img_hidden;
		}
		posts::where('postID',$postID)->update([
			'post_Content' => $request->content_post,
			'post_Image' => $url_file

		]);
		
		$editPost=posts::where('postID',$postID)->first();
		return response()->json($editPost);
	}


  

}

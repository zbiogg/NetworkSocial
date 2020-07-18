<?php

namespace App\Http\Controllers\Api;

use App\posts;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\post as postResource;
use App\Http\Resources\user as userResource;
use Illuminate\Support\Facades\Auth;

class postcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        return postResource::collection(posts::orderBy('postID','desc')->paginate(20)->sortByDesc('postID'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
    public function store(Request $request)
    {
    
         $CreatePost= new posts;
        $CreatePost->userID=Auth::user()->id;
        $CreatePost->post_Content=$request->post_Content;
        if($request->post_Image!=''){
            $url_file=time().'_mobile';
            file_put_contents('img/posts'.$url_file,base64_decode($request->post_Image));
            $CreatePost->post_Image=$url_file;
        }
        if($request->post_Content!=''||$request->post_Image!=''){
            $CreatePost->save();
            
        }
        return response()->json([
            'success' => true,
            'message' => 'oke',
             postResource::collection(posts::where('postID',$CreatePost->post_Image)->get())
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return [
            'success' => true,
             'data' =>postResource::collection(posts::where('postID',$id)->get())
            ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, posts $posts,$id)
    {
        return $posts->where('postID',$id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(posts $posts,$id)
    {
        $posts->where('postID',$id)->delete();
    }

    public function myPosts(){
        return [
            'success' => true,
            'data' => postResource::collection(posts::where('userID',Auth::user()->id)->paginate(10)->sortBy('postID'))];
    }

    public function userPosts($id){
        return [
            'success' => true,
            'user' => userResource::collection(User::where('id',$id)->get()),
            'data' => postResource::collection(posts::where('userID',$id)->paginate(10)->sortBy('postID'))];
    }
    
    public function addPost(Request $request)
    {
    
         $CreatePost= new posts;
        $CreatePost->userID=Auth::user()->id;
        $CreatePost->post_Content=$request->post_Content;
        if($request->post_Image!=''){
            $url_file=time().'_mobile';
            file_put_contents('img/posts/'.$url_file,base64_decode($request->post_Image));
            $CreatePost->post_Image=$url_file;
        }
        if($request->post_Content!=''||$request->post_Image!=''){
            $CreatePost->save();
            $postid=$CreatePost->postID;
            
        }
        return response()->json([
            'success' => true,
            'message' => 'oke',
             'data' =>postResource::collection(posts::where('postID',$CreatePost->id)->get())
        ]);
    }

    public function deletePost(Request $request){
        posts::where('postID',$request->postID)->delete();
        if(posts::where('postID',$request->postID)->first()){
            return ['success' =>false];
        }else{
            return ['success' =>true];
        }
    
    }
}

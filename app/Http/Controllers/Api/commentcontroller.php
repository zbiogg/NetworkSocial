<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\comment as cmtResource;
use App\Http\Resources\replycomment as replycmtResource;
use App\replycomment;

class commentcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return comment::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return comment::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ['cmt' => cmtResource::collection(comment::where('id',$id)->get())];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return comment::where('id',$id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        comment::find($id)->delete();
    }
    public function postcmts(Request $request){
        return [
            'success' => true,
            'cmts' => cmtResource::collection(comment::where('postID',$request->postID)->orderBy('id','desc')->paginate(10)->sortBy('id'))
        ];
    }

    public function addCmt(Request $request){
            
        $CreateCmt= new comment;
        $CreateCmt->userID=Auth::user()->id;
        $CreateCmt->content_cmt=$request->content_cmt;
        $CreateCmt->postID=$request->postID;
        if($request->content_cmt!=''){
            $CreateCmt->save();
            $cmtid=$CreateCmt->id;
            
        }
        return response()->json([
            'success' => true,
            'message' => 'oke',
             'cmt' =>cmtResource::collection(comment::where('id',$cmtid)->get())
        ]);
    }

    public function replycomments(Request $request){
        return [
            'success' => true,
            'replycmts' => replycmtResource::collection(replycomment::where('comment_ID',$request->comment_ID)->orderBy('id','desc')->paginate(10)->sortBy('id'))
        ];
    }
}

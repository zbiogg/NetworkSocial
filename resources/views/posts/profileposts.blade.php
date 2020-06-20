@if($posts= DB::table('posts')->where('userID',$id)->where('status',0)->orderBy('postID', 'desc')->paginate(15))
@include('posts.allpost')
@endif


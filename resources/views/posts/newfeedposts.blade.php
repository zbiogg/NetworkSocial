@if($posts= DB::table('posts')->where('status',0)->orderBy('postID', 'desc')->paginate(20))       
@include('posts.allpost')       
@endif
                
                
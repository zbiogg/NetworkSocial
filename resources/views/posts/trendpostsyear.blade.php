@if($posts=DB::table('posts')
->join('likes','posts.postID','=','likes.postID')
->select(
    "posts.postID",
    "posts.userID",
    "posts.post_Content",
    "posts.post_Image",
    "posts.created_at",
    "posts.updated_at",
    DB::raw("COUNT(*) as like_count"))
->whereYear('posts.created_at', '>=', \Carbon\Carbon::now()->year)
->groupBy(
    "posts.postID",
    "posts.userID",
    "posts.post_Content",
    "posts.post_Image",
    "posts.created_at",
    "posts.updated_at")
->orderBy('like_count','desc')->get())
@include('posts.allpost')
@endif
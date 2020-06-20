<table class="table table-data2">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên người dùng</th>
            <th>Nội dung</th>
            <th>Thời gian</th>
            <th>Trạng thái</th>
            <th>Lượt thích</th>
            <th>Lượt bình luận</th>
            <th>Tác vụ</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts=App\posts::orderBy('created_at','desc')->paginate(10) as $post)
        <tr class="tr-shadow" id="post{{$post->postID}}">

            <td>{{$post->postID}}</td>
            <td>
                <span class="block-email">{{$u=App\User::where('id',$post->userID)->first()->firstName}}</span>
            </td>
            <td class="desc">
                <div>
                    {{$post->post_Content}}
                </div>
            </td>
            <td>{{$post->created_at}}</td>
            <td id="wrap_stt{{$post->postID}}">
                <div id="stt{{$post->postID}}">
                    @if($post->status==0)
                    <span class="status--process">Hiện thị</span>
                    @else
                    <span class="status--denied">Bị Chặn</span>
                    @endif
                </div>
            </td>
            <td>{{ App\like::where('postID',$post->postID)->count() }}</td>
            <td>{{ App\comment::where('postID',$post->postID)->count() }}</td>
            <td>
                <div class="table-data-feature">
                    <button onclick="blockPost({{$post->postID}})" class="item" data-toggle="tooltip" data-placement="top" title="Khóa bài viết">
                        <i class="fa fa-ban"></i>
                    </button>
                    <button onclick="deletePost({{$post->postID}})" class="item" data-toggle="tooltip" data-placement="top" title="Xóa bài viết">
                        <i class="zmdi zmdi-delete"></i>
                    </button>
                </div>
            </td>
            
        </tr>
        <tr class="spacer" id="spacer{{$post->postID}}"></tr>
        @endforeach

    </tbody>
</table>
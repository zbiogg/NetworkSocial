@if($rqfriends= DB::table('relationship')->where('userID_1',Auth::user()->id)->where('action_userID','!=',Auth::user()->id)->orderBy('created_at','desc')->get())
    @foreach($rqfriends as $rq)
    <div class="item-request item_request{{$rq->userID_2}}">
        <div class="item-request-detail">
            @if($user=DB::table('users')->where('status',0)->find($rq->userID_2))
            <a class="profile-request" href="profile?id={{$rq->userID_2}}">
            <img src="@if($user->img_avt=='') img/avt/avt-default.png @else img/avt/{{$user->img_avt}}  @endif" height="40px" width="40px" style="border-radius: 50%">
            <span class="name-request ml-2" style="font-size: 13px; margin-right: 10px;max-width: 200px;">
            {{$user->lastName}}
            {{$user->firstName}}
            </span>
            </a>
            @endif
            <div class="reply-request ml-auto replyfriend{{$rq->userID_2}}">
                <a><button onclick="acceptFriend({{$rq->userID_2}})" style="font-size: 12px;" class="btn apply-request">Chấp nhận</button></a>
                <a><button onclick="deleteRequest({{$rq->userID_2}})" style="font-size: 12px; color: #555555;" class="btn delete-request">Xóa</button></a>
            </div>
        </div>
    </div>
    @endforeach
@endif

@if($rqfriends= DB::table('relationship')->where('userID_2',Auth::user()->id)->where('action_userID','!=',Auth::user()->id)->where('status',0)->orderBy('created_at','desc')->get())
    @foreach($rqfriends as $rq)
    <div class="item-request item_request{{$rq->userID_1}}">
        <div class="item-request-detail">
            @if($user=DB::table('users')->where('status',0)->find($rq->userID_1))
            <a class="profile-request" href="profile?id={{$rq->userID_1}}">
            <img src="@if($user->img_avt=='') img/avt/avt-default.png @else img/avt/{{$user->img_avt}}  @endif" height="40px" width="40px" style="border-radius: 50%">
            <span class="name-request ml-2" style="font-size: 13px;margin-right: 10px;max-width: 200px;">
            {{$user->lastName}}
            {{$user->firstName}}
            </span>
            </a>
            @endif
            <div class="reply-request ml-auto replyfriend{{$rq->userID_1}}">
                <a><button onclick="acceptFriend({{$rq->userID_1}})" style="font-size: 12px;" class="btn apply-request">Chấp nhận</button></a>
                <a><button onclick="deleteRequest({{$rq->userID_1}})" style="font-size: 12px; color: #555555;" class="btn delete-request">Xóa</button></a>
            </div>
        </div>
    </div>
    @endforeach
    @if($rqfriends= DB::table('relationship')->where('userID_2',Auth::user()->id)->where('action_userID','!=',Auth::user()->id)->where('status',0)->get()->isEmpty()&& $rqfriends= DB::table('relationship')->where('userID_1',Auth::user()->id)->where('action_userID','!=',Auth::user()->id)->get()->isEmpty()) 
    <h6 align="center ">Không có lời mời kết bạn nào!!!!!</h6>
    @endif
@endif
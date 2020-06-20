@if($susgests= DB::table('users')->where('status',0)->where('id','!=',Auth::user()->id)->inRandomOrder()->get())
                @foreach($susgests as $key => $sg)
                @if($users = DB::table('relationship')->where('userID_2','=',Auth::user()->id)->where('userID_1','=',$sg->id)->get()->isEmpty())
                @if($users = DB::table('relationship')->where('userID_1','=',Auth::user()->id)->where('userID_2','=',$sg->id)->get()->isEmpty()) 
                <div class="item-request" id="item_sgs{{$sg->id}}">
                    <div class="item-request-detail">
                        @if($user=DB::table('users')->find($sg->id))
                        <a class="profile-request" href="profile?id={{$sg->id}}">
                        <img src="@if($user->img_avt=='') img/avt/avt-default.png @else img/avt/{{$user->img_avt}}  @endif" height="40px" width="40px" style="border-radius: 50%">
                        <span class="name-request ml-2" style="font-size: 13px;margin-right: 10px;max-width: 130px;">
                        {{$user->lastName}}
                        {{$user->firstName}}
                        </span>
                        </a>
                        @endif
                        <div class="reply-request ml-auto add_friend{{$sg->id}}">
                            <button onclick="addFriend({{$sg->id}})"  style="font-size: 12px;" class="btn apply-request">Thêm bạn bè</button>
                            <button onclick="deleteSGS({{$sg->id}})" class="btn delete-request" style="font-size: 12px;">Xóa</button>
                        </div>
                    </div>
                </div>
                @endif
                @endif
                @endforeach
                @endif

        @if($repcmts=DB::table('replycomments')->where('comment_ID',$cmtid)->orderBy('created_at','desc')->paginate(5))
            @foreach($repcmts->sortBy('created_at') as $rep)
                <div class="detail_repcmt" id="repcmt{{$rep->id}}">
                @if($userCmt=DB::table('users')->find($rep->userID))
                    <div style="display: flex;">
                        <a class="profile-cmt mr-2" href="profile?id={{$userCmt->id}}" style="display: inline-flex; align-items: center;" >
                        <img src="@if($userCmt->img_avt=='') img/avt/avt-default.png @else img/avt/{{$userCmt->img_avt}}  @endif" height="35px" width="35px" style="border-radius: 50%; border: 1px solid #d2d2d2;">
                        </a> 
                        <p style="background-color: #f2f3f5; border-radius: 40px; padding: 5px 10px; margin-bottom: 0px; font-size: 15px;">
                            <a href="profile?id={{$userCmt->id}}" style="font-weight: bold; color: #555555; ">{{$userCmt->lastName}} {{$userCmt->firstName}} :</a> {{$rep->content_repcmt}}
                        </p>
                        
                    </div>
                @endif
                    <div style="padding-left: 55px;">
                        <span style="font-size: 11px;" title="{{$rep->created_at}}">{{ \Carbon\Carbon::parse($rep->created_at)->diffForHumans() }}</span>
                        
                    </div>
                </div>
            @endforeach
        @endif
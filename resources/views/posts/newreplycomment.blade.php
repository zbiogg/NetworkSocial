@php ($repcmt=DB::table('replycomments')->where('userID',Auth::user()->id)->orderBy('created_at','desc')->first()) @endphp
@if($userCmt=DB::table('users')->find(Auth::user()->id))
    <div style="display: flex;">
        <a class="profile-cmt mr-2" href="profile?id={{$userCmt->id}}" style="display: inline-flex; align-items: center;" >
        <img src="@if($userCmt->img_avt=='') img/avt/avt-default.png @else img/avt/{{$userCmt->img_avt}}  @endif" height="35px" width="35px" style="border-radius: 50%; border: 1px solid #d2d2d2;">
        </a> 
        <p style="background-color: #f2f3f5; border-radius: 40px; padding: 5px 10px; margin-bottom: 0px; font-size: 15px;">
            <a href="profile?id={{$userCmt->id}}" style="font-weight: bold; color: #555555; ">{{$userCmt->lastName}} {{$userCmt->firstName}} :</a> {{$repcmt->content_repcmt}}
        </p>
        
    </div>
@endif
    <div style="padding-left: 55px;">
        <span style="font-size: 11px;" title="{{$repcmt->created_at}}">{{ \Carbon\Carbon::parse($repcmt->created_at)->diffForHumans() }}</span>
        
    </div>
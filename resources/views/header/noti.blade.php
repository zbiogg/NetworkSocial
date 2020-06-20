<div class="drop-content" id="noti_header" >
    @foreach(DB::table('notifications')->where('receiverID',Auth::user()->id)->orderBy('created_at','desc')->paginate(10) as $noti)
    <div class="item-noti" style="@if($noti->status==1) background-color: #fff @else background-color: #bdd9a5 @endif">
        <div class="item-noti-detail">
            @php ($user=DB::table('users')->find($noti->senderID))  @endphp
            <a class="profile-request" href="{{$noti->url}}" onclick="haha()" style="text-decoration: none">
            <img src="@if($user->img_avt=='') img/avt/avt-default.png @else img/avt/{{$user->img_avt}}  @endif" height="40px" width="40px" style="border-radius: 50%">
            <span class="name-request ml-2 mr-1" style="font-size: 13px;">
            
            {{$user->firstName}}
            </span>
            <span style=" font-size: 13px;font-weight: normal">{{$noti->message}}</span>
            <span class="ml-auto" style="font-size: 10px; font-weight: normal; color: #555555">{{ \Carbon\Carbon::parse($noti->created_at)->diffForHumans() }}</span>
            </a>
            
        </div>
    </div>
    @endforeach								
</div>
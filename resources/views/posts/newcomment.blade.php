@php ($cmt=DB::table('comments')->where('userID',Auth::user()->id)->orderBy('created_at','desc')->first()) @endphp

        @if($userCmt=DB::table('users')->find(Auth::user()->id))
        <div style="display: flex;">
            <a class="profile-cmt mr-2" href="profile?id={{$userCmt->id}}" style="display: inline-flex; align-items: center;" >
            <img src="@if($userCmt->img_avt=='') img/avt/avt-default.png @else img/avt/{{$userCmt->img_avt}}  @endif" height="35px" width="35px" style="border-radius: 50%; border: 1px solid #d2d2d2;">
            </a> 
            <p style="background-color: #f2f3f5; border-radius: 40px; padding: 5px 10px; margin-bottom: 0px; font-size: 15px;">
                <a href="profile?id={{$userCmt->id}}" style="font-weight: bold; color: #555555; ">{{$userCmt->lastName}} {{$userCmt->firstName}} :</a> {{$cmt->content_cmt}}
            </p>
            
        </div>
        @endif
        <div style="padding-left: 55px;">
            <span style="font-size: 11px;" title="{{$cmt->created_at}}">{{ \Carbon\Carbon::parse($cmt->created_at)->diffForHumans() }}</span>
            <button id="btn_repcmt{{$cmt->id}}" class="btn btn-repcmt" style="font-size: 13px;"><i class="fa fa-reply mr-1" aria-hidden="true"></i> trả lời </button>
        </div>
        <div class="all-repcmt" id="all_repcmt{{$cmt->id}}" style="padding-left: 45px;">
        @if($repcmts=DB::table('replycomments')->where('comment_ID',$cmt->id)->orderBy('created_at','desc')->paginate(5))
            @foreach($repcmts as $rep)
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
        </div>

        
        <div id="input_repcmt{{$cmt->id}}" class="repcmt" style="padding-left:45px; display: none; ">
        
        <div style="display: flex; padding: 10px 0px;">
        <a class="profile-cmt mr-2" href="profile?id=1" style="display: inline-flex; align-items: center;">
        <img src="@if(Auth::user()->img_avt=='') img/avt/avt-default.png @else img/avt/{{Auth::user()->img_avt}}  @endif" height="35px" width="35px" style="border-radius: 50%; border: 1px solid #d2d2d2;">
    </a>
    <form id="addrepCmt{{$cmt->id}}" onsubmit="addrepCmt({{$cmt->id}})" action="javascript:void(0)" enctype="multipart/form-data" style="display: flex; width: 100%;margin: 0">
                @csrf
                <input type="hidden" name="userID" value="{{Auth::user()->id}}">
                <input type="hidden" name="cmtID" value="{{$cmt->id}}">
                <input id="input_rep_content{{$cmt->id}}" name="input_rep_content" type="text" class="input-cmt" placeholder="Viết trả lời" autocomplete="off">
                <button type="submit" class="btn ml-1" style="border: 1px solid #a9a9a9"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </form>
        </div>
        </div>
        <script>
            $("#btn_repcmt{{$cmt->id}}").on('click', function(){
                $("#input_repcmt{{$cmt->id}}").show();
                $("#input_rep_content{{$cmt->id}}").focus();
            });
        </script>           

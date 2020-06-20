@extends('header.header')
@section('title','ZBIO')
@section('content')
<div class="zbio-main container-fluid">
    <div class="row">
        <div class="l-main col-3">
            <div class="l-wrap">
                <div class="user-profile">
                    <a class="profile-menu" href="" style="display: inline-flex; align-items: center;">
                    <img src="@if(Auth::user()->img_avt=='') img/avt/avt-default.png @else  img/avt/{{Auth::user()->img_avt}}  @endif" height="35px" width="35px" style="border-radius: 50%; border: 1px solid #d2d2d2; background-color: #f1f1f1;">
                    <span class="ml-1">
                    {{Auth::user()->lastName}}
                    {{Auth::user()->firstName}}</span>
                    </a>
                </div>
                <ul class="item-menu">
                    <li><a class="m-newfeeds" href="" style="text-decoration: none; ">
                        <img src="img/home1.png" style="padding-bottom: 3px;" height="32px"><span class="title-tl ml-1">Bảng tin</span></a>
                    </li>
                    <li>
                        <a class="m-topposts" href="/trend" style="text-decoration: none;" >
                        <img src="img/topposts1.png" height="30px"><span class="ml-1">Nổi bật</span>
                        </a>
                    </li>
                    <li>
                        <a class="m-messenger" href="" style="text-decoration: none;" >
                        <img src="img/mess1.png" height="30px"><span class="ml-1">Tin nhắn</span>
                        </a>
                    </li>
                    <li>
                        <a class="m-friends" href="/profile/friends?uid={{Auth::user()->id}}" style="text-decoration: none;" >
                        <img src="img/friends.png" height="30px"><span class="ml-1">Bạn bè</span>
                        </a>
                    </li>
                    <li>
                        <a class="m-rq" href="/friends/requests" style="text-decoration: none;" >
                        <img src="img/rq.png" height="30px"><span class="ml-1">Lời mời kết bạn</span>
                        </a>
                    </li>
                    <li>
                        <a class="m-noti" href="/notifications" style="text-decoration: none;" >
                        <img src="img/noti-menu.png" height="30px"><span class="ml-1">Thông báo</span>
                        </a>
                    </li>
                    <li>
                        <a class="m-search" href="/search" style="text-decoration: none;" >
                        <img src="img/search.png" height="30px"><span class="ml-1">Tìm kiếm</span>
                        </a>
                    </li>
                </ul>
                <ul class="menu-main">
                </ul>
                <footer style="position: fixed; bottom: 0vh; padding: 5px; text-align: center;">
                    <!-- <a href="tel:0949261099">Hotline: 0949261099</a>
                        <p>&copy; Coppyright ViTu 2019 DACS2<p> -->
                </footer>
            </div>
        </div>
        <div class="c-main col" id="c_main">
            
            <div class="" id="wrap_noti">
            <div style="background-color: #d3d6db; border-top-right-radius:2px;border-top-left-radius: 2px; border: 1px solid #aaa; padding-top: 5px;">
                    <h3 align="center">Thông báo</h3>
                </div>
                @foreach(DB::table('notifications')->where('receiverID',Auth::user()->id)->orderBy('created_at','desc')->get() as $noti)
                <div class="item-noti" style="@if($noti->status==1) background-color: #fff @else background-color: #bdd9a5 @endif">
                    <div class="item-noti-detail">
                        @php ($user=DB::table('users')->find($noti->senderID))  @endphp
                        <a class="profile-request" href="{{$noti->url}}" style="text-decoration: none">
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
        </div>
        <div class="r-main col-3">
            <div class="r-wrap">
                <div style="border-bottom: 1px solid #aaa; padding-top: 5px;">
                    <h5 align="center" style="font-weight: bold">Danh bạ</h5>
                </div>
                <div style="margin-top: 10px" id="wrap_online_list">
                <div id="online_list">
                @foreach(DB::table('relationship')->where('userID_1',Auth::user()->id)->where('status','1')->get() as $r)
                        
                        @if($user=App\User::where('id',$r->userID_2)->first())
                            
                            <div class="user-online" style="margin: 10px">
                                <a class="profile-menu" href="/profile?id={{$user->id}}" style="display: inline-flex; align-items: center;">
                                <img src="@if($user->img_avt=='') img/avt/avt-default.png @else  img/avt/{{$user->img_avt}}  @endif" height="30px" width="30px" style="border-radius: 50%; border: 1px solid #d2d2d2; background-color: #f1f1f1;">
                                <span style="font-size: 14px" class="ml-2">
                                {{$user->firstName}}</span>
                                @if($user->isOnline())
                                <span class="ml-auto mr-3" style="font-size: 12px; color:green"><i class="fa fa-circle mr-1" aria-hidden="true"></i>online</span>
                                @else <span class="ml-auto mr-3" style="font-size: 12px; color:grey"><i class="fa fa-circle mr-1" aria-hidden="true"></i>offline</span>
                                @endif
                                </a>
                            </div>
                            
                        @endif
                    @endforeach

                    @foreach(DB::table('relationship')->where('userID_2',Auth::user()->id)->where('status','1')->get() as $r)
                    @if($user=App\User::where('id',$r->userID_1 )->first())
 
                            <div class="user-online" style="margin: 10px">
                                <a class="profile-menu" href="/profile?id={{$user->id}}" style="display: inline-flex; align-items: center;">
                                <img src="@if($user->img_avt=='') img/avt/avt-default.png @else  img/avt/{{$user->img_avt}}  @endif" height="30px" width="30px" style="border-radius: 50%; border: 1px solid #d2d2d2; background-color: #f1f1f1;">
                                <span style="font-size: 14px" class="ml-2">
                                {{$user->firstName}}</span>
                                @if($user->isOnline())
                                <span class="ml-auto mr-3" style="font-size: 12px; color:green"><i class="fa fa-circle mr-1" aria-hidden="true"></i>online</span>
                                @else <span class="ml-auto mr-3" style="font-size: 12px; color:grey"><i class="fa fa-circle mr-1" aria-hidden="true"></i>offline</span>
                                @endif
                                </a>
                            </div>
                            
                            
                        @endif 
                @endforeach
                            </div> 
                </div>
                
            </div>
        </div>
    </div>
</div>
@include('myjs.customjs')
@endsection
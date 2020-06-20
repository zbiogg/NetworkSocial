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
            
            <div class="" id="wrap_search">
            <div style="background-color: #d3d6db; border-top-right-radius:2px;border-top-left-radius: 2px; border: 1px solid #aaa; padding-top: 5px; ">
                <form id="searchForm" action="javascript:void(0)" enctype="multipart/form-data" style="margin: 10px 0; padding: 0 10px; width: 100%">
                @csrf
                    <div class="form-group" style="display: flex;">
                        <input type="text" id="search_content" name="search_content" class="form-control" placeholder="Nhập nội dung tìm kiếm">
                        <button type="submit" class="btn btn-info ml-2"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </form> 
                
            </div>
            
            <h5 id="title_keysearch" align="center" style="display: none">Kết quả tìm kiếm cho từ khóa: "<span id="keysearch"></span>"</h5>
            
           
            <div id="wrap_rs_users">
            @if($s_content)   
                <div id="rs_users" style="background-color: #fff; border-top-right-radius:2px;border-top-left-radius: 2px; border: 1px solid #aaa; margin-top: 15px; ">
                 
                <div style="display: flex; border-bottom: 1px solid #aaa; background-color: #d3d6db">
                        <h6 class="mx-auto" style="margin: 5px"><b>Người dùng</b></h6>
                </div>
                    <div>
                    
                        @foreach(App\User::where('firstName','like','%'.$s_content.'%')->get() as $rsu)
                        <div class="item-request item_request6">
                            <div class="item-request-detail">
                                <a class="profile-request" href="profile?id={{$rsu->id}}">
                                <img src="@if($rsu->img_avt=='') img/avt/avt-default.png @else img/avt/{{$rsu->img_avt}}  @endif" height="40px" width="40px" style="border-radius: 50%">
                                <span class="name-request ml-2" style=" margin-right: 10px;max-width: 200px;">
                                {{$rsu->lastName}}
                                {{$rsu->firstName}}
                                </span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                        @if($rs_users=App\User::where('firstName','like','%'.$s_content.'%')->get()->isEmpty())
                            <h6 align="center">Không tìm thấy kết quả phù hợp</h6>
                        @endif
                        
                        
                 
                    </div>
                    
                </div>
                @endif
            </div>
            <div id="wrap_rs_posts">
                <div id="rs_posts">
                    @if($s_content)
                        <div style="display: flex; border: 1px solid #aaa; background-color: #d3d6db; margin-top:10px;">
                                <h6 class="mx-auto" style="margin: 5px"><b>Bài đăng</b></h6>
                        </div>
                        @if($posts=App\posts::where('post_Content','like','%'.$s_content.'%')->get())
                        @include('posts.allpost')
                        @endif
                        @if($rs_posts=App\posts::where('post_Content','like','%'.$s_content.'%')->get()->isEmpty())
                            <h6 align="center">Không tìm thấy kết quả phù hợp</h6>
                        @endif
                    @endif
                </div>
            </div>
                							
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
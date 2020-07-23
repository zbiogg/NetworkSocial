@extends('header.header')
@section('title','ZBIO')
@section('content')
<div class="zbio-main container-fluid" style="">
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
                    <li><a class="m-newfeeds" href="/" style="text-decoration: none; ">
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
                    <li>
                        <a class="m-search" href="/android/ZBIO.apk" download="" style="text-decoration: none;" >
                        <img src="img/android.png" height="30px"><span class="ml-1">Tải ứng dụng cho Android</span>
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
            
                
                <div class="create-post" >
                
                    <div class="create-label"><b>Tạo bài viết</b></div>
                    <form id="uploadPost" action="javascript:void(0)" enctype="multipart/form-data" style="margin-bottom: 0">
                    @csrf
                    <div class="content-create">
                        <div style="margin: 0 5px;">
                            <textarea class="input-post" rows="3" placeholder="Bạn đang nghĩ gì?" name="content_post" id="content_post"></textarea>
                            <img id="img_show" class="img-thumbnail" src="" style="max-height: 100px; max-width: 400px ">
                            <script>
                                $('#img_show').hide();
                                function showpreviewimg(){
                                    
                                    if($('#img_show').attr('src')==''){
                                        $('#img_show').hide();
                                    }else{
                                        $('#img_show').show();
                                    }
                                }
                                
                            </script>
                        </div>
                    </div>
                    <div class="create-options">
                        <div class="create-options-left mr-auto" style="border: 1px solid 	#778899; border-radius: 5px;">
                            <input class="input_file" accept="image/*" type="file" name="img_post" id="img_post" onchange="document.getElementById('img_show').src = window.URL.createObjectURL(this.files[0]); showpreviewimg()  " />
                            <label for="img_post" class="" style="margin: 5px 8px 2px 5px; color:#555555"><i class="fa fa-camera mr-2" aria-hidden="true" style="font-size: 20px;"></i>Ảnh</label>
                            <img id="img_show" src="" style="max-height: 30px; ">
                        </div>
                        <div class="create-options-right ml-auto">
                            <button class="btn btn-post ml-auto" id="addPost" type="submit">Đăng</button>
                        </div>
                    </div>
                    </form>
                </div>

                <div style="display: flex; background-color: #fff; border-radius: 5px; margin-top: 15px;align-items: center;padding: 10px">
                    <span>Hiện thị các bài viết: </span>		
                    <div class="center ml-1">
                    <select onchange="selectView(value)" name="sources" id="sources" class="custom-select sources" placeholder="Source Type">
                        <option value="1" selected="selected">Mọi người</option>
                        <option value="2">Bạn bè</option>
                        
                    </select>
                    </div>
				</div>
            
            
            <div class="allpost" id="allpost">   
            @include('posts.newfeedposts')      
            </div>
            <div id="loading"></div>
            <div style="display: flex; padding: 5px 0px" id="loadmore">
                 <button type="button" onclick="loadmore()" class="btn btn-link mx-auto">Xem thêm...</button>
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
                        
                        @if($user_rq1=App\User::where('id',$r->userID_2)->where('status',0)->first())
                            
                            <div class="user-online" style="margin: 10px">
                                <a class="profile-menu" href="/profile?id={{$user_rq1->id}}" style="display: inline-flex; align-items: center;">
                                <img src="@if($user_rq1->img_avt=='') img/avt/avt-default.png @else  img/avt/{{$user_rq1->img_avt}}  @endif" height="30px" width="30px" style="border-radius: 50%; border: 1px solid #d2d2d2; background-color: #f1f1f1;">
                                <span style="font-size: 14px" class="ml-2">
                                {{$user_rq1->firstName}}</span>
                                @if($user_rq1->isOnline())
                                <span class="ml-auto mr-3" style="font-size: 12px; color:green"><i class="fa fa-circle mr-1" aria-hidden="true"></i>online</span>
                                @else <span class="ml-auto mr-3" style="font-size: 12px; color:grey"><i class="fa fa-circle mr-1" aria-hidden="true"></i>offline</span>
                                @endif
                                </a>
                            </div>
                            
                        @endif
                    @endforeach

                    @foreach(DB::table('relationship')->where('userID_2',Auth::user()->id)->where('status','1')->get() as $r)
                    @if($user_rq2=App\User::where('id',$r->userID_1 )->where('status',0)->first())
 
                            <div class="user-online" style="margin: 10px">
                                <a class="profile-menu" href="/profile?id={{$user_rq2->id}}" style="display: inline-flex; align-items: center;">
                                <img src="@if($user_rq2->img_avt=='') img/avt/avt-default.png @else  img/avt/{{$user_rq2->img_avt}}  @endif" height="30px" width="30px" style="border-radius: 50%; border: 1px solid #d2d2d2; background-color: #f1f1f1;">
                                <span style="font-size: 14px" class="ml-2">
                                {{$user_rq2->firstName}}</span>
                                @if($user_rq2->isOnline())
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
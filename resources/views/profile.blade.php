@extends('header.header')
@section('content')
@section('title')
@if($user = DB::table('users')->where('status',0)->find($id)) {{$user->lastName}} {{$user->firstName}}  @endif
@endsection
@if($user = DB::table('users')->where('status',0)->find($id))
<div class="zbio-main  container">
    <div class="profile">
        @if(Auth::user()->id==$id)
        <div style="display: flex">
            <div class="ml-auto">
                <div style="display: flex; position: absolute;">
                    <div class="dropdown upload-image-profile">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-shadow: 2px 2px 4px #000000; border: 1px solid #fff;">
                        <i class="fa fa-camera mr-1" aria-hidden="true" style="color:#fff; "></i><span style="color:#fff;">Cập nhập ảnh</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right"   aria-labelledby="dropdownMenuButton">
                            <div>
                                <button class="btn btn-default" data-toggle="modal" data-target="#model-avt">
                                Ảnh đại diện
                                </button>			
                            </div>
                            <div>
                                <button class="btn btn-default" data-toggle="modal" data-target="#model-cover">
                                Ảnh bìa
                                </button>
                            </div>
                        </div>
                        <div class="modal" id="model-avt">
                            <form id="uploadAvt" onsubmit="uploadAvt()" action="javascript:void(0)" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h5 class="modal-title">Thay đổi ảnh đại diện</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <img class="img-thumbnail" id="img_show_avt" src="@if(Auth::user()->img_avt=='') img/avt/avt-default.png @else  img/avt/{{Auth::user()->img_avt}}  @endif" width="100%">
                                            <input type="hidden" name="img_hidden" value="{{Auth::user()->img_avt}}">
                                            <input type="file" accept="image/*" name="img_avt" id="img_avt" onchange="document.getElementById('img_show_avt').src = window.URL.createObjectURL(this.files[0])" />
                                            <label for="img_avt" class="btn-avt" style=" margin-top: 10px; border: 1px solid #778899; border-radius: 5px; padding: 5px 5px 5px 5px;">
                                            <i class="fa fa-camera mr-2" aria-hidden="true" style="font-size: 20px;"></i>Chọn ảnh
                                            </label>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal" id="model-cover">
                            <form id="uploadCover" onsubmit="uploadCover()" action="javascript:void(0)" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h5 class="modal-title">Thay đổi ảnh bìa</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <img class="img-thumbnail" id="img_show_cover" src="@if(Auth::user()->img_cover=='') img/cover/cover-default.png @else  img/cover/{{Auth::user()->img_cover}}  @endif" width="100%">
                                            <input type="hidden" name="img_hidden" value="{{Auth::user()->img_cover}}">
                                            <input type="file" accept="image/*"name="img_cover" id="img_cover" onchange="document.getElementById('img_show_cover').src = window.URL.createObjectURL(this.files[0])"  />
                                            <label for="img_cover" class="btn-cover" style=" margin-top: 10px; border: 1px solid #778899; border-radius: 5px; padding: 5px 5px 5px 5px;">
                                            <i class="fa fa-camera mr-2" aria-hidden="true" style="font-size: 20px;"></i>Chọn ảnh
                                            </label>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <input type="hidden" id="idprofile" value="{{$id}}">
        <div id="cover_profile" class="profile-header img-thumbnail" style="background-image: url('@if($user->img_cover=='') img/cover/cover-default.png @else  img/cover/{{$user->img_cover}}  @endif'); background-color: #000; ">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4" style="" id="wrap_avt_profile">
                    <div class="profile-avt" align="center" id="avt_profile">
                        <a  style="list-style: none;">
                        <img src="@if($user->img_avt=='') img/avt/avt-default.png @else  img/avt/{{$user->img_avt}}  @endif" style="width: 280px; height: 280px;border: 5px solid #fff; border-radius: 50%; background-color: #f1f1f1;">
                        </a>
                    </div>
                </div>
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <div class="profile-name">
                        <h1>{{$user->lastName}} {{$user->firstName}} </h1>
                        <div id="wrap_rela_status">
                            <div id="rela_status">
                                @if(Auth::user()->id<$id)
                                @if($rela= DB::table('relationship')->where('userID_1',Auth::user()->id)->where('userID_2',$id)->get())
                                @foreach($rela as $rela)
                                @if($rela->status==1)
                                <button class="btn btn-friend" href=""><i style="margin-right: 3px;" class="fa fa-check" aria-hidden="true" id="btn-friend"></i>Bạn bè</button>	
                                @elseif($rela->status==0)
                                @if($rela->action_userID==$id)
                                <button onclick="acceptFriend({{$id}})" class="btn btn-friend" href="" id="btn-friend"><i style="margin-right: 3px;" class="fa fa-check-square-o" aria-hidden="true"></i>Xác nhận</button>
                                @else
                                <button class="btn btn-friend" href="" id="btn-friend"><i style="margin-right: 3px;" class="fa fa-reply" aria-hidden="true" ></i> Đã gửi lời mời kết bạn</button>
                                @endif
                                @endif
                                @endforeach
                                @if($rela= DB::table('relationship')->where('userID_1',Auth::user()->id)->where('userID_2',$id)->get()->isEmpty()) 
                                <button class="btn btn-friend" onclick="addFriend({{$id}})" id="btn-friend"><i style="margin-right: 3px;" class="fa fa-reply" aria-hidden="true"></i> Kết bạn</button>
                                @endif
                                @endif
                                @endif
                                @if(Auth::user()->id>$id)
                                @if($rela= DB::table('relationship')->where('userID_1',$id)->where('userID_2',Auth::user()->id)->get())
                                @foreach($rela as $rela)
                                @if($rela->status==1)
                                <button class="btn btn-friend" id="btn-friend"><i style="margin-right: 3px;" class="fa fa-check" aria-hidden="true"></i>Bạn bè</button>	
                                @elseif($rela->status==0)
                                @if($rela->action_userID==$id)
                                <button onclick="acceptFriend({{$id}})" class="btn btn-friend" href="" id="btn-friend"><i style="margin-right: 3px;" class="fa fa-check-square-o" aria-hidden="true"></i>Xác nhận</button>
                                @else
                                <button class="btn btn-friend" id="btn-friend"><i style="margin-right: 3px;" class="fa fa-reply" aria-hidden="true"></i> Đã gửi lời mời kết bạn</button>
                                @endif
                                @endif
                                @endforeach
                                @if($rela= DB::table('relationship')->where('userID_1',$id)->where('userID_2',Auth::user()->id)->get()->isEmpty()) 
                                <button class="btn btn-friend" onclick="addFriend({{$id}})" id="btn-friend"><i style="margin-right: 3px;" class="fa fa-reply" aria-hidden="true"></i> Kết bạn</button>
                                @endif
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-content">
            <div style="display: flex">
            <button class="btn btn-success mx-auto" data-toggle="modal" data-target="#editInfoModal" style="margin-bottom: 2px">Chỉnh sửa thông tin</button>
            <!-- Modal -->
            <div class="modal fade" id="editInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    @if($u=Auth::user())
                    <form id="editInfo" onsubmit="editInfo()" action="javascript:void(0)">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa thông tin cá nhân</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="login-form-wrap">
                        <label>Họ:</label>
                        <input class="login-input" value="{{$u->lastName}}" style="margin-top: 0px" type="text" id="edit_username" name="edit_lastName" placeholder="Họ" >
                        <label>Tên:</label>
                        <input class="login-input" value="{{$u->firstName}}" style="margin-top: 0px" id="edit_firstName" type="text" name="edit_firstName" placeholder="Tên" >
                        <label>Email:</label>
                        <input class="login-input" value="{{$u->email}}" style="margin-top: 0px" id="edit_email" type="text" name="edit_email" placeholder="Email của bạn" >
                        <label>Ngày sinh:</label>
                        <input class="login-input" value="{{$u->doB}}" style="margin-top: 0px" id="edit_doB" type="date" name="edit_doB" placeholder="Ngày sinh của bạn" >
                        <label>Giới tính:</label>
                        <select class="custom-select mr-sm-2" style="" name="edit_gender">
                        <option value="Nam" @if($u->gender=="Nam") selected="selected"  @endif>Nam</option>
                        <option value="Nữ" @if($u->gender=="Nữ") selected="selected" @endif>Nữ</option>
                        <option value="Khác" @if($u->gender=="Khác") selected="selected" @endif>Khác</option>
                        </select>
                        <label>Di động:</label>
                        <input class="login-input" value="{{$u->phone}}" style="margin-top: 0px" id="edit_phone" type="text" name="edit_phone" placeholder="Số điện thoại của bạn">
                        <label>Tỉnh/TP:</label>
                        <input class="login-input" value="{{$u->city}}" style="margin-top: 0px" id="edit_city" type="text" name="edit_city" placeholder="Nhập tỉnh/TP của bạn">
                        <label>Giới thiệu:</label>
                        <input class="login-input" value="{{$u->about}}" style="margin-top: 0px" id="edit_about" type="text" name="edit_about" placeholder="Giới thiệu về bản thân">
                        <label>Mật khẩu mới:</label>
                        <input class="login-input" style="margin-top: 0px" id="edit_password" type="password" name="edit_password" placeholder="Nhập mật khẩu">
                        
                        
                    
                        
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                    </div>
                    </form>
                     @endif
                </div>
            </div>
            </div>
            </div>
            <div class="profile-about" id="wrap_info_profile">
                <div class="row" id="info_profile" style="border: 5px solid #aaa; border-radius: 10px; padding: 15px 0px; background-color: #fff;">
                    <div class="col-xs-12 col-sm-6">
                        <div class="profile-about-content">
                            <h3><span>Giới thiệu</span></h3>
                            <p style="	white-space: pre-wrap;">{{$user->about}}</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6" style="border-left: 1px solid #ccc;">
                        <div class="profile-about-content">
                            <ul>
                                <li>
                                    <span class="profile-about-title">Giới tính:</span> {{$user->gender}}
                                </li>
                                <li>
                                    <span class="profile-about-title">Ngày sinh:</span> {{\Carbon\Carbon::parse($user->doB)->format('d-m-Y')}}
                                </li>
                                <li>
                                    <span class="profile-about-title">Tỉnh/TP:</span> {{$user->city}}
                                </li>
                                <li>
                                    <span class="profile-about-title">Email:</span> {{$user->email}}
                                </li>
                                <li>
                                    <span class="profile-about-title">Di động:</span> {{$user->phone}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <div class="profile-statistic">
                <div style="background-color: #bec3c9; padding: 5px; border-bottom: 1px solid #aaa;">
                    <h4 align="center"><i class="fa fa-bar-chart mr-1" aria-hidden="true"></i>Thống kê
                    </h4>
                </div>
                <div style="padding: 10px;">
                    <div>
                        <span><i class="fa fa-clipboard mr-1" aria-hidden="true"></i>Bài viết:</span>
                        <span id="wrap_qtypostprofile">
                        <span id="qtypostprofile" style="float: right;">@if($posts= DB::table('posts')->where('userID',$id)->get())
                        {{$posts->count()}}
                        @endif</span> 
                        </span>
                    </div>
                    <div>
                        <span><i class="fa fa-thumbs-o-up mr-1" aria-hidden="true"></i>Lượt thích:
                        </span>
                        <span id="wrap_qtypostprofile">
                        <span id="qtypostprofile" style="float: right;">@if($likes= DB::table('likes')->join('posts','likes.postID','=','posts.postID')->where('posts.userID',$id)->get())
                        {{$likes->count()}}
                        @endif</span> 
                        </span>
                    </div>
                    <div>
                        <span><i class="fa fa-comments-o mr-1" aria-hidden="true"></i>Bình luận:
                        </span>
                        <span id="wrap_qtypostprofile">
                        <span id="qtypostprofile" style="float: right;">@if($cmts= DB::table('comments')->join('posts','comments.postID','=','posts.postID')->where('posts.userID',$id)->get())
                        {{$cmts->count()}}
                        @endif</span> 
                        </span>
                    </div>
                </div>
            </div>
            <div class="profile-9img">
                <div class="p-3" style="background-color: #bec3c9;">
                    <span>Ảnh</span>
                    <a href="/profile/photos?uid={{$id}}" style="float: right;">Xem tất cả</a>
                </div>
                <div class="row" style="margin: 0; padding: 15px">
                    @if($images= DB::table('posts')->where('userID',$id)->where('post_Image','!=','')->orderBy('postID', 'desc')->paginate(9))
                    @foreach($images as $img)
                    <div class="col-4 profile-9img-detail">
                        <a href="/posts/{{$img->postID}}">
                            <img class="img-thumbnail" src="img/posts/{{$img->post_Image}}" style="width: 100%; height:102px; object-fit: cover;">
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="profile-9img">
                <div class="p-3" style="background-color: #bec3c9;">
                    <span>Bạn bè</span>
                    <a href="/profile/friends?uid={{$id}}" style="float: right;">Xem tất cả</a>
                </div>
                <div class="row" style="margin: 0; padding: 15px">
                    @foreach(DB::table('relationship')->where('userID_1',$id)->where('status','1')->get() as $r)  
                        @if($user=App\User::where('id',$r->userID_2)->first())
                        <div class="col-4 profile-9img-detail">
                            <a href="/profile?id={{$user->id}}">
                                <img class="img-thumbnail" src="@if($user->img_avt=='') img/avt/avt-default.png @else  img/avt/{{$user->img_avt}}  @endif" style="width: 100%; height:102px; object-fit: cover;">
                                <div><h6 align="center">{{$user->firstName}}</h6></div>
                            </a>
                        </div>
                        
                        @endif
                    @endforeach

                    @foreach(DB::table('relationship')->where('userID_2',$id)->where('status','1')->get() as $r)  
                        @if($user=App\User::where('id',$r->userID_1)->first())
                        <div class="col-4 profile-9img-detail">
                            <a href="/profile?id={{$user->id}}">
                                <img class="img-thumbnail" src="@if($user->img_avt=='') img/avt/avt-default.png @else  img/avt/{{$user->img_avt}}  @endif" style="width: 100%; height:102px; object-fit: cover;">
                                <div><h6 align="center">{{$user->firstName}}</h6></div>
                            </a>
                        </div>
                        @endif
                    @endforeach
                    
                </div>
            </div>
            
            

        </div>
        
        <div class="get-posts col-lg-7">
            @if(Auth::user()->id==$id)
            <div class="" style="margin-top: 15px;">
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
            </div>
            @endif
            <div class="allpost" id="allpost">
                @include('posts.profileposts')
            </div>
            <div id="loading"></div>
            <div style="display: flex; padding: 5px 0px" id="loadmore">
                <button type="button" onclick="loadmoreprofile()" class="btn btn-link mx-auto">Xem thêm...</button>
            </div>
        </div>
    </div>
</div>
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
@endif
@include('myjs.customjs')
@endsection
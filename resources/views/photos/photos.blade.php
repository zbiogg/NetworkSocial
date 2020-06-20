@extends('header.header')
@section('content')
@section('title')
@if($user = DB::table('users')->find($id)) {{$user->lastName}} {{$user->firstName}}  @endif
@endsection
@if($user = DB::table('users')->find($id))
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
                            <form action="/profile/editAvt" method="POST" enctype="multipart/form-data">
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
                            <form action="/profile/editCover" method="POST" enctype="multipart/form-data">
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
        <div class="profile-header img-thumbnail" style="background-image: url('@if($user->img_cover=='') img/cover/cover-default.png @else  img/cover/{{$user->img_cover}}  @endif'); background-color: #000; ">
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4" style="">
                    <div class="profile-avt" align="center">
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
            <div class="profile-about">
                <div class="row" style="border: 5px solid #aaa; border-radius: 10px; padding: 15px 0px; background-color: #fff;">
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
  <div class="col-md-12">

    @php ($photos= DB::table('posts')->where('userID',$id)->where('post_Image','!=','null')->where('status',0)->count()) @endphp
    
    <div class="header-friend"><h4><i class="fa fa-users mr-1" aria-hidden="true"></i>Ảnh ({{$photos}})</h4></div>
    <div class="mdb-lightbox no-margin p-3" style="background-color: #fff; border: 1px solid #d3d6db">
    <div class="row">
    @foreach(DB::table('posts')->where('userID',$id)->where('post_Image','!=','null')->where('status','0')->orderBy('created_at','desc')->get() as $p)  
      <figure class="col-md-3">
        <a href="/posts/{{$p->postID}}" class="black-text article">
          <div class="img-profile img-thumbnail" style="background-image: url('img/posts/{{$p->post_Image}}'); min-height:200px;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;"></div>
        </a>
      </figure>
    @endforeach
    
    

    


    
    </div>
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
<html>
	<head>
		<base href="{{asset('')}}">
		<meta charset="UTF-8">
	    <meta name="viewport"
	          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
	    <title>@yield('title')</title>
		<link rel="shortcut icon" href="/img/logo1.png">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	    <link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<header class="zbio-header" id="myHeader">
			<div class="header-content container ">
				<a href="/" class="header-logo mr-3" title="Trang chủ">
					<img src="img/logo1.png" height="80px">
				</a>
				<button type="button" class="navbar-toggler	" data-toggle="collapse" data-target="#sidebar-collapse" aria-expanded="true"><span class="sr-only">Toggle navigation</span>
					<span class="navbar-toggler-icon">

					</button>
				
	  
				@if(Auth::check())
				<!-- <div class="search-box">
					<form class="search-form">
						<input class="search-input form-control" type="text" name="search-input" placeholder="Tìm kiếm">
					</form>
				</div> -->

				<a class="timeline mr-auto ml-3" title="Bảng tin" href="/" style="text-decoration: none;">
					<span class="title-tl ml-1">Bảng tin</span></a>
				<a class="topposts mr-auto" title="TopPosts" href="/" style="text-decoration: none;" >
					<span class="ml-1">Nổi bật</span>
				</a>
				<div style="width: 1px; height: 30px; background-color: #aaa;"></div>

					
				<div class="item-header mx-auto">
				
					<div class="row">
					<!-- Loi moi ket ban -->
						<div class="btn-group">
							<a href="#" onclick="dropmenuitem('drdown-Request')" class="drop-group dropdown-toggle ml-2 mr-2 mx-auto	" role="button"  data-toggle="dropdown" style="text-decoration: none"	>
								<img src="img/request.png" id="img-request" height="30px">
								<div id="wrap_qty_request">
								@include('header.qtyrequest')
								</div>
							</a>
							
							<div id="drdown-Request" class="request-header dropdown-menu dropdown-menu-request" >
							
							   <div class="drop-tilte"><h6>Lời mời kết bạn</h6></div>
							   
							   <div class="drop-content" style="min-width: 330px;">
							   
									   @include('friends.requestfriends')
									 
							   </div>
							   	
							   <div class="drop-final">
							   		<a href="#"><b>Xem tất cả</b></a>
								   </div>
		  					</div>
	  					</div>

	  					<!-- Tin nhắn -->
						<div class="btn-group">
							<a href="" onclick="dropmenuitem('drdown-Mess')" class="drop-group dropdown-toggle mr-2 ml-2 mx-auto" role="button" data-toggle="dropdown"	>
								<img src="img/mess.png" id="img-mess" height="30px">
							</a>
							<div id="drdown-Mess" class="mess-header dropdown-menu dropdown-menu-mess">
							   <div class="drop-tilte"><h6>Tin nhắn</h6></div>
							   
							   <div class="drop-content">
							   	
							   				<!-- <div class="item-mess">
							   					<div class="item-mess-detail">
							   						<img src="img/avt/avt-default.png" height="40px" style="border-radius: 50%">
							   						<div class="mess-content">
							   							<span class="name-mess ml-2">Thanh Tùng</span>
							   							<div class="final-mess ml-2">hihi</div>
							   						</div>
							   						<div class="time-mess ml-auto">12:34</div>
							   					</div>	
							   				</div> -->
							   		
							   </div>
							   
							   <div class="drop-final">
							   		<a href="#">Xem tất cả</a>
							   	</div>
		  					</div>
	  					</div>

	  					<div class="btn-group">
						<a href="" onclick="dropmenuitem('drdown-Noti')" class="drop-group dropdown-toggle ml-2 mr-2 mx-auto" role="button" data-toggle="dropdown"	>
							<img src="img/noti.png" height="25px" id="img-noti">
							<div id="wrap_qty_noti">
							@include('header.qtynoti')
							</div>
						</a>
						<div class="noti-header dropdown-menu dropdown-menu-noti" id="drdown-Noti">
						   <div class="drop-tilte"><h6>Thông báo</h6></div>
						   <div id="wrap_noti_header">
						   
						</div>
						   
						   <!--  -->
						   <div class="drop-final">
						   		<button class="btn btn-secondary" style="margin-top:5px" onclick="ok()">Xem tất cả</button>
							   </div>
							   
	  					</div>
	  					</div>
	  				</div>
					
					
				</div>

				<div style="width: 1px; height: 30px; background-color: #aaa;"></div>

				<div class="pr-select ml-auto">
						<a class="link-profile" href="/profile" title="Trang cá nhân" style="text-decoration: none;">
							<img src="@if(Auth::user()->img_avt=='') img/avt/avt-default.png @else  img/avt/{{Auth::user()->img_avt}}  @endif" height="35px" width="35px" style="border-radius: 50%; border: 1px solid #d2d2d2; background-color: #f1f1f1;">
							<span class="link-profile-title mr-2">{{Auth::user()->firstName}}</span>
						
						</a>
						
						<a class="header-logout" href="logout" title="Đăng xuất">
							<img src="img/logout.png" height="30px" style="border-radius:50%; "> Đăng xuất
						</a>
					</div>

					@else
					<div class="ml-auto">
						<a class="header-login" href="/login">Đăng nhập</a>
						<a class="header-signup" href="/signup">Đăng ký miễn phí</a>
					</div>
					@endif
			</div>
			
		</header>
		@if(Auth::check())
		<div id="sidebar-collapse" class="sidebar collapse in" aria-expanded="true" style="margin-top: 60px; padding: 0;background-color: #fff;width: 100%;">
			<div class="item-sidebar">
                    <a class="profile-menu" href="" style="display: inline-flex; align-items: center;">
                    <img src="@if(Auth::user()->img_avt=='') img/avt/avt-default.png @else  img/avt/{{Auth::user()->img_avt}}  @endif" height="35px" width="35px" style="border-radius: 50%; border: 1px solid #d2d2d2; background-color: #f1f1f1;">
                    <span class="ml-1">
                    {{Auth::user()->lastName}}
                    {{Auth::user()->firstName}}</span>
                    </a>
			</div>
			<ul class="item-menu-sidebar">
                    <li class="item-sidebar"><a class="m-newfeeds" href="/" style="text-decoration: none; height: 100% ">
                        <img src="img/home1.png" style="padding-bottom: 3px;" height="32px"><span class="title-tl1 ml-1">Bảng tin</span></a>
                    </li>
                    <li class="item-sidebar">
                        <a class="m-topposts" href="/trend" style="text-decoration: none;height: 100%;" >
                        <img src="img/topposts1.png" height="30px"><span class="ml-1">Nổi bật</span>
                        </a>
                    </li>
                    <li class="item-sidebar">
                        <a class="m-messenger" href="" style="text-decoration: none;height: 100%;" >
                        <img src="img/mess1.png" height="30px"><span class="ml-1">Tin nhắn</span>
                        </a>
                    </li>

                    <li class="item-sidebar">
                        <a class="m-friends" href="/profile/friends?uid={{Auth::user()->id}}" style="text-decoration: none;height: 100%;" >
                        <img src="img/friends.png" height="30px"><span class="ml-1">Bạn bè</span>
                        </a>
					</li>
					
					<li class="item-sidebar">
                        <a class="m-rq" href="/friends/requests" style="text-decoration: none;" >
                        <img src="img/rq.png" height="30px"><span class="ml-1">Lời mời kết bạn</span>
                        </a>
                    </li>

                    <li class="item-sidebar">
                        <a class="m-noti" href="/notifications" style="text-decoration: none;height: 100%;" >
                        <img src="img/noti-menu.png" height="30px"><span class="ml-1">Thông báo</span>
                        </a>
                    </li>
                    <li class="item-sidebar">
                        <a class="m-search" href="/search" style="text-decoration: none;height: 100%;	" >
                        <img src="img/search.png" height="30px"><span class="ml-1">Tìm kiếm</span>
                        </a>
                    </li>
                </ul>
		</div>
		@endif
		@yield('content')
		
	</body>


</html>
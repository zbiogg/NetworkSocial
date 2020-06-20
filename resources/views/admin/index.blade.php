<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
	<meta name="keywords" content="au theme template">
	<meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Title Page-->
    <title>ADMIN</title>

    <!-- Fontfaces CSS-->
    <link rel="shortcut icon" href="/img/logo1.png">
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="#">
                            <img src="images/icon/logo-white.png" alt="CoolAdmin" />
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
							<li>
								<div class="au-breadcrumb-content">
									<form class="au-form-icon--sm" action="javascript:void(0)" method="post">
										<input class="au-input--w300 au-input--style2" type="text" placeholder="Nhập nội dung tìm kiếm">
										<button class="au-btn--submit2" type="submit">
											<i class="zmdi zmdi-search"></i>
										</button>
									</form>
								</div>
							</li>
                            <li class="has-sub">
                                <a href="/admin">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard
                                    <span class="bot-line"></span>
                                </a>
                                
                            </li>
                            
                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-copy"></i>
                                    <span class="bot-line"></span>Pages</a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="login.html">Login</a>
                                    </li>
                                    
                                </ul>
							</li>
							
                            
                        </ul>
                    </div>
                    <div class="header__tool">
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="image">
                                    <img src="@if(Auth::user()->img_avt=='') img/avt/avt-default.png @else  img/avt/{{Auth::user()->img_avt}}  @endif" alt="Admin" />
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#">ADMIN</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                <img src="@if(Auth::user()->img_avt=='') img/avt/avt-default.png @else  img/avt/{{Auth::user()->img_avt}}  @endif" alt="John Doe" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#">ADMIN</a>
                                            </h5>
                                            <span class="email">{{Auth::user()->firstName}}</span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-settings"></i>Setting</a>
                                        </div>
                                        
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="/logout">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo-white.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="/admin">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none">
            <div class="header__tool">
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            <img src="@if(Auth::user()->img_avt=='') img/avt/avt-default.png @else  img/avt/{{Auth::user()->img_avt}}  @endif" alt="{{Auth::user()->firstName}}" />
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#">Admin: {{Auth::user()->firstName}}</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="#">
                                        <img src="@if(Auth::user()->img_avt=='') img/avt/avt-default.png @else  img/avt/{{Auth::user()->img_avt}}  @endif" alt="{{Auth::user()->firstName}}" />
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="#">{{Auth::user()->firstName}}</a>
                                    </h5>
                                    <span class="email">{{Auth::user()->email}}</span>
                                </div>
                            </div>
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-account"></i>Account</a>
                                </div>
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="/logout">
                                    <i class="zmdi zmdi-power"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HEADER MOBILE -->

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">

            <!-- WELCOME-->
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4">ADMIN: 
                                <span>{{Auth::user()->firstName}}</span>
                            </h1>
                            <hr class="line-seprate">
                        </div>
                    </div>
                </div>
            </section>
            <!-- END WELCOME-->

            <!-- STATISTIC-->
            <section class="statistic statistic2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--green">
                                <h2 class="number">{{App\User::count()}}</h2>
                                <span class="desc">Thành viên</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number">{{App\posts::count()}}</h2>
                                <span class="desc">Bài viết</span>
                                <div class="icon">
									<i class="zmdi zmdi-edit"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number">{{App\like::count()}}</h2>
                                <span class="desc">Lượt thích</span>
                                <div class="icon">
									<i class="zmdi zmdi-thumb-up"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--red">
                                <h2 class="number">{{App\comment::count()}}</h2>
                                <span class="desc">Lượt bình luận</span>
                                <div class="icon">
									<i class="zmdi zmdi-comments"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->

            <!-- DATA TABLE-->
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
							
							<div style="display: flex">
							<h3 class="title-5 m-b-35 mr-2" style="padding-top: 10px">Dữ liệu</h3>
								<div class="table-data__tool">
									<div class="table-data__tool-left">
										<div class="rs-select2--light rs-select2--sm">
											<select class="js-select2" name="time" onchange="haha(value)">
												<option selected="selected" value="1">Người dùng</option>
												<option value="2">Bài viết</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
									
								</div>
                       		</div>
							<script>
								function haha(select){
									if(select==1){
										$('#wrap_table_admin').fadeOut(function(){
											$('#wrap_table_admin').load('/admin/users');
										});
										$('#wrap_table_admin').fadeIn();
									}else{
										$('#wrap_table_admin').fadeOut(function(){
											$('#wrap_table_admin').load('/admin/posts');
										});
										$('#wrap_table_admin').fadeIn();
									}
								}
							</script>
							<!-- posts -->
                            <div class="table-responsive table-responsive-data2" id="wrap_table_admin">
								<table class="table table-data2">
									<thead>
										<tr>
											<th>ID</th>
											<th>Tên người dùng</th>
											<th>Giới tính</th>
											<th>Ngày sinh</th>
											<th>Trạng thái</th>
											<th>Tác vụ</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($users=App\User::orderBy('created_at','desc')->paginate(20) as $user)
										<tr class="tr-shadow" id="user{{$user->id}}">

											<td>{{$user->id}}</td>
											<td>
												<span class="block-email">{{$user->firstName}}</span>
											</td>
											<td class="desc">
												<div>
													{{$user->gender}}
												</div>
											</td>
											<td>{{$user->doB}}</td>
											
											<td id="wrap_stt{{$user->id}}">
                                                <div id="stt{{$user->id}}">
												@if($user->status==0)
												<span class="status--process">Hoạt động</span>
												@else
												<span class="status--denied">Bị Chặn</span>
                                                @endif
                                                </div>
											</td>
											<td>
												<div class="table-data-feature">
												<button onclick="blockUser({{$user->id}})" class="item" data-toggle="tooltip" data-placement="top" title="Chặn người dùng">
													<i class="fa fa-ban"></i>
												</button>
												<button onclick="deleteUser({{$user->id}})" class="item" data-toggle="tooltip" data-placement="top" title="Xóa người dùng">
													<i class="zmdi zmdi-delete"></i>
												</button>
												</div>
											</td>
											
										</tr>
										<tr class="spacer" id="spacer{{$user->id}}"></tr>
										@endforeach

									</tbody>
								</table>

							</div>

							
							
                        </div>
                    </div>
                </div>
			</section>
			
            <!-- END DATA TABLE-->

            <!-- COPYRIGHT-->
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>HOME: <a href="/">Về trang chủ</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <!-- block and delete User -->
	<script>
		function blockUser(uid){
			$.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url: 'admin/blockUser',
                type: 'POST',
                data: {"uid": uid},
                success: function (data) { 
                    console.log(data);
                    $('#wrap_stt'+uid).fadeOut(function(){
                        $('#wrap_stt'+uid).load("/admin/users"+" #stt"+uid);
                    });
                    $('#wrap_stt'+uid).fadeIn("slow");
                    
                }
            }); 
		}

        function deleteUser(uid){
			$.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url: 'admin/deleteUser',
                type: 'POST',
                data: {"uid": uid},
                success: function (data) { 
                    console.log(data);
                    $('#user'+uid).fadeOut(1000,function(){
                        $('#user'+uid).remove();
                        $('spacer'+uid).remove();
                    })
                }
            }); 
		}

        function blockPost(pid){
			$.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url: 'admin/blockPost',
                type: 'POST',
                data: {"pid": pid},
                success: function (data) { 
                    console.log(data);
                    $('#wrap_stt'+pid).fadeOut(function(){
                        $('#wrap_stt'+pid).load("/admin/posts"+" #stt"+pid);
                    });
                    $('#wrap_stt'+pid).fadeIn("slow");
                    
                }
            }); 
		}

        function deletePost(pid){
			$.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url: 'admin/deletePost',
                type: 'POST',
                data: {"pid": pid},
                success: function (data) { 
                    console.log(data);
                    $('#post'+pid).fadeOut(1000,function(){
                        $('#post'+pid).remove();
                        $('spacer'+pid).remove();
                    });
                }
            }); 
		}

	</script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->

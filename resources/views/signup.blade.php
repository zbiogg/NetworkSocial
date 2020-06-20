@extends('header.header')
@section('title','Đăng Ký')
@section('content')
<div class="zbio-main container-fluid">
    <div class="login mx-auto">
        <form class="login-form" action="" method="POST">
            @csrf
            <h2 class="login-title">Đăng ký VITU</h2>
            <div class="login-form-wrap">
                @if(session('emptyuser'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{session('emptyuser')}}</strong>
                </div>
                @endif
                <!-- <label class="lbl-login_username" for="login_username">Email or Phone</label> -->
                <input class="login-input" type="text" id="register_username" name="register_username" placeholder="Nhập tên đăng nhập" required>
                <!-- <label class="lbl-login_password" for="register_password">Password</label> -->
                <input class="login-input" id="register_lastName" type="text" name="register_lastName" placeholder="Họ" required>
                <input class="login-input" id="register_firstName" type="text" name="register_firstName" placeholder="Tên" required>
                <input class="login-input" id="register_email" type="email" name="register_email" placeholder="Email của bạn" required>
                <div class="wrap_doB">
                    <label class="" style="margin-top: 35px;" for="register_doB">Ngày sinh:</label>
                    <input class="login-input doB" id="register_doB" type="date" name="register_doB" placeholder="Ngày sinh của bạn" >
                </div>
                <input class="login-input" id="register_phone" type="text" name="register_phone" placeholder="Số di động" required>
                <input class="login-input" id="register_password" type="password" name="register_password" placeholder="Nhập mật khẩu" required>
                <select class="custom-select mr-sm-2" style="margin-top:25px" name="register_gender"required>
                    <option selected="">Giới tính...</option>
                    <option value="Nam">Nam</option>
                    <option class="" value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
                <button class="btn btn-login" type="submit">Đăng ký</button>
                @if(session('message'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{session('message')}}</strong>
                </div>
                @endif
                <div class="wrap_line">
                    <div class="_line"></div>
                    <span class="title-or">Hoặc</span>
                    <div class="_line"></div>
                </div>
                <a class="btn btn-login-fb"  href="/loginfb">
                <span>
                <i class="fa fa-facebook-square"></i>
                </span> 
                Đăng nhập bằng Facebook
                </a>
            </div>
        </form>
        <div class="link-signup">
            <span class="tiltle-link-signup">Bạn đã có tài khoản?</span>
            <a href="login" class="btn-link-signup">Đăng nhập</a>
        </div>
    </div>
</div>
@endsection

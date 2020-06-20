@extends('header.header')
@section('title','Đăng nhập')
@section('content')
<div class="zbio-main container-fluid">
    <div class="login mx-auto">
        <form class="login-form" action="" method="POST">
            @csrf
            <h2 class="login-title">Đăng nhập VITU</h2>
            <div class="login-form-wrap">
                @if(session('checklogin'))
                <div class="alert alert-success" role="alert">
                    <strong>{{session('checklogin')}}</strong>
                </div>
                @endif
                @if(session('dangkythanhcong'))
                <div class="alert alert-success" role="alert">
                    <strong>{{session('dangkythanhcong')}}</strong>
                </div>
                @endif
                <label class="lbl-login_username" for="login_username">Email or Phone</label>
                <input class="login-input" type="text" id="login_username" name="login_username" placeholder="Nhập email hoặc số điện thoại">
                <label class="lbl-login_password" for="login_password">Password</label>
                <input class="login-input" id="login_password" type="password" name="login_password" placeholder="Nhập mật khẩu" required>
                <a class="forgot-pwd mx-auto" href="">Quên mật khẩu?</a>
                <button class="btn btn-login" type="submit">Đăng nhập</button>
                @if(session('message'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{session('message')}}</strong>
                </div>
                @endif
                @if(session('userblock'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{session('userblock')}}</strong>
                </div>
                @endif
                <div class="wrap_line">
                    <div class="_line"></div>
                    <span class="title-or">Hoặc</span>
                    <div class="_line"></div>
                </div>
                <a class="btn btn-login-fb" href="/loginfb">
                <span>
                <i class="fa fa-facebook-square"></i>
                </span> 
                Đăng nhập bằng Facebook
                </a>
            </div>
        </form>
        <div class="link-signup">
            <span class="tiltle-link-signup">Bạn không có tài khoản?</span>
            <a href="signup" class="btn-link-signup">Đăng ký</a>
        </div>
    </div>
</div>
@endsection
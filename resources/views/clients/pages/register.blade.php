@extends('layouts.client')

@section('title','Đăng ký')
@section('breadcrumb','Đăng ký')

@section('content')

<!-- LOGIN AREA START (Register) -->
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center mb-0">
                    <h1 class="section-title">Đăng ký <br>tài khoản của bạn</h1>
                    <p>Hãy đăng ký tài khoản để trải nghiệm mua sắm rau củ tươi ngon, nhanh chóng và tiện lợi.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="account-login-inner">
                    <form action="{{route('post-register')}}" class="ltn__form-box contact-form-box" method="POST" id="register-form">
                        @csrf
                        <div style="position: relative;">
                            <input type="text" name="name" placeholder="Họ và tên*" required value="{{old('name')}}" style="padding-left: 40px;">
                            <i class="fa fa-user" style="position: absolute; top: 33px; left: 15px; transform: translateY(-50%); color: #888;"></i>
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        
                        <div style="position: relative;">
                            <input type="email" name="email" placeholder="Email*" required value="{{old('email')}}" style="padding-left: 40px;" >
                            <i class="fa fa-envelope" style="position: absolute; top: 33px; left: 15px; transform: translateY(-50%); color: #888;"></i>
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div style="position: relative;">
                            <input type="password" name="password" placeholder="Mật khẩu*" required style="padding-left: 40px;"  id="password">
                            <i class="fa fa-lock" style="position: absolute; top: 33px; left: 15px; transform: translateY(-50%); color: #888;"></i>
                            <i class="fa fa-eye-slash" id="togglePassword" style="position: absolute; top: 33px; right: 15px; transform: translateY(-50%); cursor: pointer; color: #888;"></i>
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div style="position: relative;">
                            <input type="password" name="confirmpassword" placeholder="Xác nhận mật khẩu*" required style="padding-left: 40px;" id="confirmpassword">
                            <i class="fa fa-lock" style="position: absolute; top: 33px; left: 15px; transform: translateY(-50%); color: #888;"></i>
                            <i class="fa fa-eye-slash" id="toggleConfirmPassword" style="position: absolute; top: 33px; right: 15px; transform: translateY(-50%); cursor: pointer; color: #888;"></i>
                        </div>
                        @error('confirmpassword')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <label class="checkbox-inline">
                            <input type="checkbox" name=checkbox1 value="" required>
                            Tôi đồng ý cho Broccoli xử lý dữ liệu cá nhân của tôi để gửi tài liệu tiếp thị
                            được cá nhân hóa theo mẫu đơn đồng ý và chính sách bảo mật.
                        </label>
                        @error('checkbox1')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <label class="checkbox-inline">
                            <input type="checkbox" name="checkbox2" value="" required>                            
                            Bằng cách nhấp vào "tạo tài khoản", tôi đồng ý với chính sách bảo mật.
                        </label>
                        @error('checkbox2')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="btn-wrapper text-center mt-20">
                            <button class="theme-btn-1 btn reverse-color btn-block" type="submit">TẠO TÀI KHOẢN</button>
                        </div>
                    </form>
                    <div class="by-agree text-center">
                        <p class="mb-10">Bằng cách tạo tài khoản, bạn đồng ý với:</p>
                        <p><a href="#">ĐIỀU KHOẢN VÀ ĐIỀU KIỆN&nbsp; &nbsp; | &nbsp; &nbsp; CHÍNH SÁCH BẢO MẬT</a></p>
                        <div class="go-to-btn mt-20 fw-bold">
                            <a href="{{route('login')}}">BẠN ĐÃ CÓ TÀI KHOẢN ?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- LOGIN AREA END -->

@endsection

@extends('layouts.admin')

@section('title', 'Thông tin cá nhân')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2 style="font-size: 25px;">Thông tin tài khoản</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3  profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar" class="text-center">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view img-account" id="avatar-preview" src="{{ asset('storage/' . ($user->avatar ?? 'uploads/users/user.jpg')) }}">
                                    </div>
                                    <form enctype="multipart/form-data" class="text-center">
                                        <input type="file" name="avatar" id="avatar" accept="image/*" style="display: none">
                                        <a href="javascript:void(0)" class="btn btn-primary update-avatar" style="margin: 10px 5px;">
                                            <i class="fa fa-edit m-right-xs"> Chọn ảnh</i>
                                        </a>
                                    </form>
                                </div>
                                <h3 id="user-name">{{ $user->name }}</h3>

                                <ul class="list-unstyled user_data" style="font-size: 14px;">
                                    <li><i class="fa fa-map-marker user-profile-icon"></i> <span id="user-address">{{ $user->address }}</span>
                                    </li>

                                    <li>
                                        <i class="fa fa-phone user-profile-icon"></i> <span id="user-phone">{{ $user->phone_number }}</span>
                                    </li>

                                    <li class="m-top-xs">
                                        <i class="fa fa-envelope user-profile-icon"></i> <span id="user-email">{{ $user->email }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-9 col-sm-9" style="font-size: 15px;">
                                <form id="update-profile" data-parsley-validate class="form-horizontal form-label-left">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Họ và tên: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="name" required class="form-control" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="email" name="email" readonly class="form-control" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Số điện thoại: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="phone" name="phone" required class="form-control" value="{{ $user->phone_number }}">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="address">Địa chỉ: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="address" name="address" required class="form-control" value="{{ $user->address }}">
                                        </div>
                                    </div>
                                    <div class="item form-group text-center" style="margin-top: 30px;">
                                        <div class="col-md-6 col-sm-6 offset-md-3">
                                            <button class="btn btn-primary form-change-pass">Đổi mật khẩu</button>
                                            <button class="btn btn-secondary" type="reset">Làm lại</button>
                                            <button type="submit" class="btn btn-success">Cập nhật</button>
                                        </div>
                                    </div>
                                </form>

                                <form id="change-password" data-parsley-validate class="form-horizontal form-label-left" style="display: none;">
                                    <div class="ln_solid"></div>
                                    <h2 class="text-center" style="color: #000; font-weight: 500">CẬP NHẬT MẬT KHẨU MỚI</h2>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="current_password">Mật khẩu hiện tại: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="password" id="current_password" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="new_password">Mật khẩu mới: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="password" id="new_password" name="new_password" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="confirm_password">Xác nhận mật khẩu: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="password" id="confirm_password" name="confirm_password" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group text-center">
                                        <div class="col-md-6 col-sm-6 offset-md-3">
                                            <button class="btn btn-secondary" type="reset">Làm lại</button>
                                            <button type="submit" class="btn btn-success">Cập nhật</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

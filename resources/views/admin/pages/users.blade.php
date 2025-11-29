@extends('layouts.admin')

@section('title', 'Quản lý tài khoản')

@section('content')
    <style>
        .profile_details {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }

        .profile_view {
            width: 100%;
            max-width: 370px;
            min-height: 200px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .profile_view p,
        .profile_view li {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Quản lý tài khoản</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        @foreach ($users as $user)
                            <div class="col-md-4 col-sm-4  profile_details">
                                <div class="well profile_view">
                                    <div class="col-sm-12">
                                        <h4 class="brief text-uppercase"><i>{{ $user->role->name }}</i></h4>
                                        <div class="left col-md-8 col-sm-8">
                                            <h2>{{ $user->name }}</h2>
                                            <p><strong>Email: </strong> {{ $user->email }} </p>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-building"></i> Địa chỉ: {{ $user->address }}</li>
                                                <li><i class="fa fa-phone"></i> Số điện thoại: {{ $user->phone_number }}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="right col-md-4 col-sm-4 text-center">
                                            <img src="{{ asset('storage/' . ($user->avatar ?? 'uploads/users/user.jpg')) }}"
                                                alt="" class="img-circle img-fluid fixed-avatar">
                                        </div>
                                    </div>
                                    <div class="profile-bottom text-center">
                                        <div class=" col-sm-12 emphasis">
                                            @if ($user->role->name == 'customer')
                                                <button type="button" class="btn btn-primary btn-sm upgradeStaff"
                                                    data-userid="{{ $user->id }}">
                                                    <i class="fa fa-user"> </i> Nhân viên
                                                </button>

                                                @if ($user->status == 'banned')
                                                    <button type="button" class="btn btn-success btn-sm changeStatus"
                                                        data-userid="{{ $user->id }}" data-status="active">
                                                        <i class="fa fa-unlock"> </i> Bỏ chặn
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-warning btn-sm changeStatus"
                                                        data-userid="{{ $user->id }}" data-status="banned">
                                                        <i class="fa fa-lock"> </i> Chặn
                                                    </button>
                                                @endif

                                                @if ($user->status == 'deleted')
                                                    <button type="button" class="btn btn-success btn-sm changeStatus"
                                                        data-userid="{{ $user->id }}" data-status="active">
                                                        <i class="fa fa-unlock"> </i> Khôi phục
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm changeStatus"
                                                        data-userid="{{ $user->id }}" data-status="deleted">
                                                        <i class="fa fa-trash"> </i> Xóa
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

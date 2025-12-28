@extends('layouts.admin')

@section('title', 'Quản lý thông báo')

@section('content')
    <div class="right_col" role="main">
        <div class="">

            <div class="page-title">
                <div class="title_left">
                    <h3>Quản lý thông báo</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Trang này giúp bạn xem, theo dõi và quản lý tất cả các thông báo hệ thống. Bạn có thể dễ
                                dàng nhận biết các sự kiện quan trọng, <br>cập nhật trạng thái và đảm bảo không bỏ lỡ thông
                                tin
                                cần thiết để vận hành hệ thống hiệu quả hơn. </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-md-9 col-sm-9 ">
                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active " aria-labelledby="home-tab">

                                                <ul class="messages">
                                                    @foreach ($notifications as $notification)
                                                        <li style="display: flex;">
                                                            <div>
                                                                <img src="{{ asset('assets/admin/images/bell.png') }}" style="width: 34px; height: 34px;">
                                                            </div>   
                                                            
                                                            <div class="message_wrapper" style="min-width: 400px;">
                                                                <a href="{{ '../admin' . $notification->link }}" class="notification-item" data-id="{{ $notification->id }}">
                                                                    <h4 class="heading">{{ $notification->title }}</h4>
                                                                </a>
                                                                <blockquote class="message">{{ Str::limit($notification->message, 50) }}</blockquote>
                                                            </div>

                                                            <div class="message_date">
                                                                <p class="month">{{ $notification->created_at->format('h:i A d-m-Y') }}</p>         
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

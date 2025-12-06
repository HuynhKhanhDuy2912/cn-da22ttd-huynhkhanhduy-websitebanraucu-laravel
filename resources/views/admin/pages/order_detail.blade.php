@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Quản lý đơn hàng </h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Chi tiết hóa đơn</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <section class="content invoice">
                                <!-- title row -->
                                <div class="row">
                                    <div class="  invoice-header">
                                        <h3>
                                            <i class="fas fa-receipt"></i></i> Hóa đơn
                                            {{ 'HD-' . $order->created_at->format('Ymd') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) }}

                                            <small class="pull-right">Ngày tạo: {{ $order->created_at }}</small>
                                            </h1>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        Từ
                                        <address>
                                            <strong>{{ $order->shippingAddress->full_name }}</strong>
                                            <br>Địa chỉ: {{ $order->shippingAddress->address }}
                                            <br>Thành phố: {{ $order->shippingAddress->city }}
                                            <br>Số điện thoại: {{ $order->shippingAddress->phone }}
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        Đến
                                        <address>
                                            <strong>Veggie Shop</strong>
                                            <br>Địa chỉ: Thành Thới, Vĩnh Long, Việt Nam
                                            <br>Số điện thoại: 0999999999
                                            <br>Email: duy2912www@gmail.com
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <b>Mã hóa đơn:</b>
                                        {{ 'HD-' . $order->created_at->format('Ymd') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                        <br>
                                        <b>Email:</b> {{ $order->user->email }}
                                        <br>
                                        <b>Tài khoản:</b> {{ $order->shippingAddress->full_name }}
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="  table">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Ảnh</th>
                                                    <th>Sản phẩm</th>
                                                    <th>Giá</th>
                                                    <th>Số lượng</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->orderItems as $item)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ $item->product->image_url }}" width="50px">
                                                        </td>
                                                        <td>{{ $item->product->name }}</td>
                                                        <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ number_format($item->quantity * $item->price, 0, ',', '.') }} VNĐ</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-md-6">
                                        <p class="lead">Phương thức thanh toán:</p>
                                        @if ($order->payment->payment_method == 'paypal')
                                            <img src="{{ asset('assets/admin/images/paypal.png') }}" alt="Paypal"> Thanh
                                            toán bằng Paypal
                                        @else
                                            <img src="{{ asset('assets/admin/images/cash.jpg') }}" alt="Cash"
                                                style="width: 50px; border-radius: 3px;"> Thanh toán bằng tiền mặt
                                        @endif

                                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                            Đây là phương thức thanh toán mà khác hàng đã chọn cho đơn hàng này.
                                            Nếu là Paypal, thanh toán đã được xử lý trực tuyến. Nếu là thanh toán
                                            khi nhận hàng, khách hàng sẽ thanh toán trực tiếp khi nhận sản phẩm.
                                        </p>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <p class="lead">Thanh toán</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th style="width:50%">Tổng tiền sản phẩm:</th>
                                                        <td>{{ number_format($order->total_price - 25000, 0, ',', '.') }} VNĐ</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phí vận chuyển: </th>
                                                        <td>{{ number_format(25000, 0, ',', '.') }} VNĐ</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tổng tiền thanh toán:</th>
                                                        <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div>
                                        @if ($order->status != 'canceled')
                                            <button class="btn btn-secondary" onclick="window.print();">
                                                <i class="fa fa-print"></i> In hóa đơn</button>
                                            <button class="btn btn-success send-invoice-mail" data-id="{{ $order->id }}">
                                                <i class="fa fa-send"></i> Gửi hóa đơn
                                            </button>
                                            @if ($order->status == 'pending')
                                                <button class="btn btn-danger cancel-order" data-id="{{ $order->id }}">
                                                    <i class="fa fa-remove"></i> Hủy đơn hàng
                                                </button>
                                            @endif
                                        @else
                                            <div class="text-center bg-red" style="font-size: 16px; padding: 5px;"> Đơn hàng đã hủy
                                            </div>    
                                        @endif
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

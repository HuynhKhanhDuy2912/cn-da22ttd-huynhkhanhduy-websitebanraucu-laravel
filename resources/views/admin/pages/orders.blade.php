@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Quản lý đơn hàng</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Danh sách đơn hàng</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive" style="font-size: 15px;">
                                        <p class="text-muted font-13 m-b-30">
                                            Trang quản lý đơn hàng cho phép quản trị viên theo dõi, xử lý và cập nhật trạng
                                            thái các đơn hàng trong hệ thống.
                                            Các đơn hàng được tổ chức và hiển thị một cách rõ ràng, giúp quản trị viên dễ
                                            dàng kiểm tra thông tin khách hàng, sản phẩm đã mua và phương thức thanh toán.
                                            Dữ liệu đơn hàng được trình bày dưới dạng bảng, hỗ trợ các chức năng như tìm
                                            kiếm, lọc theo trạng thái, phân trang và xuất dữ liệu, giúp việc quản lý trở nên
                                            nhanh chóng và hiệu quả.
                                        </p>
                                        <table id="datatable-buttons" class="table table-striped table-bordered text-center"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tài khoản</th>
                                                    <th>Thông tin người đặt</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Trạng thái đơn hàng</th>
                                                    <th>Trạng thái thanh toán</th>
                                                    <th>Chi tiết đơn hàng</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $order->user->name }}</td>
                                                        <td><a href="" data-toggle="modal" data-target="#InfoUserModal-{{ $order->id }}">
                                                            {{ $order->shippingAddress->address }}</a>
                                                        </td>
                                                        <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                                                        <td class="order-status">
                                                            @if ($order->status == 'pending')
                                                                <span class="custom-badge badge badge-warning">Đợi xác
                                                                    nhận</span>
                                                            @elseif ($order->status == 'processing')
                                                                    <span class="custom-badge badge badge-primary">Đang giao
                                                                        hàng</span>
                                                            @elseif ($order->status == 'completed')
                                                                <span class="custom-badge badge badge-success">Đã hoàn
                                                                    thành</span>
                                                            @elseif ($order->status == 'canceled')
                                                                <span class="custom-badge badge badge-danger">Đã hủy</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($order->payment->status == 'completed')
                                                                <span class="custom-badge badge badge-success">Đã thanh
                                                                    toán</span>
                                                            @else
                                                                <span class="custom-badge badge badge-secondary">Chưa thanh
                                                                    toán</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-info" data-toggle="modal" 
                                                                data-target="#orderItemModal-{{ $order->id }}"> Xem 
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="btn btn-danger dropdown-toggle dropdown-toggle-split 
                                                                    dropdown-toggle-custom" data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-custom">
                                                                    @if ($order->status == 'pending')
                                                                        <a href="#"
                                                                            class="dropdown-item confirm-order"
                                                                            data-id="{{ $order->id }}"> Xác nhận</a>
                                                                    @endif
                                                                    <a class="dropdown-item" target="_blank"
                                                                        href="{{ route('admin.order.detail', ['id' => $order->id]) }}">Xem chi tiết</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @foreach ($orders as $order)
                                            <!-- Modal InfoUser-->
                                            <div class="modal fade" id="InfoUserModal-{{ $order->id }}" tabindex="-1"
                                                aria-labelledby="InfoUserModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Thông tin người đặt</h5>
                                                            <button type="button" class="btn-close" data-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-borderd">
                                                                <tr>
                                                                    <td>Họ và tên:</td>
                                                                    <td>{{ $order->shippingAddress->full_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Số điện thoại:</td>
                                                                    <td>{{ $order->shippingAddress->phone }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Địa chỉ:</td>
                                                                    <td>{{ $order->shippingAddress->address }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Thành phố:</td>
                                                                    <td>{{ $order->shippingAddress->city }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal OrderItem-->
                                            <div class="modal fade" id="orderItemModal-{{ $order->id }}" tabindex="-1"
                                                aria-labelledby="orderItemModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Chi tiết hóa đơn</h5>
                                                            <button type="button" class="btn-close" data-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bored text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Tên sản phẩm</th>
                                                                        <th>Số lượng</th>
                                                                        <th>Đơn giá</th>
                                                                        <th>Thành tiền</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($order->orderItems as $item)
                                                                        <tr>
                                                                            <td>{{ $loop->iteration }}</td>
                                                                            <td>{{ $item->product->name }}</td>
                                                                            <td>{{ $item->quantity }}</td>
                                                                            <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                                                            <td>{{ number_format($item->quantity * $item->price, 0, ',', '.') }} VNĐ</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
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
                </div>
            </div>
        </div>
    </div>
@endsection

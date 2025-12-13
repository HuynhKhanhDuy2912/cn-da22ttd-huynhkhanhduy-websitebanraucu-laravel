@extends('layouts.client')

@section('title', 'Chi tiết đơn hàng')
@section('breadcrumb', 'Chi tiết đơn hàng')

@section('content')
    <div class="liton__shoping-cart-area mb-100">
        <div class="container order-detail-container">            
            <h3 class="order-summary-title">Chi tiết đơn hàng #{{ $order->id }}</h3>
            <div class="order-summary-box">
                <p>Ngày đặt: {{ $order->created_at->format('d/m/Y') }}</p>
                <p>Trạng thái:
                    @if ($order->status == 'pending')
                        <span class="badge bg-warning order-status-pending text-dark" style="font-size: 14px !important">Chờ xác nhận</span>
                    @elseif($order->status == 'processing')
                        <span class="badge bg-primary order-status-processing" style="font-size: 14px !important">Đang xử lý</span>
                    @elseif($order->status == 'completed')
                        <span class="badge bg-success order-status-completed" style="font-size: 14px !important">Hoàn thành</span>
                    @elseif($order->status == 'canceled')
                        <span class="badge bg-danger order-status-canceled" style="font-size: 14px !important">Đã hủy</span>
                    @endif
                </p>
                <p>Phương thức thanh toán:
                    @if ($order->payment && $order->payment->payment_method == 'cash')
                        <span class="badge bg-success payment-method-cash" style="font-size: 14px !important">Thanh toán khi nhận hàng</span>
                    @elseif($order->payment && $order->payment->payment_method == 'paypal')
                        <span class="badge bg-success payment-method-paypal" style="font-size: 14px !important">Thanh toán bằng Paypal</span>
                    @endif
                </p>
                <p class="order-total-price">Tổng tiền: {{ number_format($order->total_price, 0, ',', '.') }} VNĐ</p>
            </div>

            <h4 class="section-title-1 product-list-title">Sản phẩm trong đơn hàng</h4>
            <div class="order-items-table-wrapper">
                <table class="table order-items-table">
                    <thead>
                        <tr class="text-center">
                            <th>Ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr class="text-center">
                                <td>
                                    <img src="{{ $item->product->image_url }}" width="50">
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h4 class="section-title-1 shipping-info-title">Thông tin giao hàng</h4>
            <div class="shipping-info-box">
                <p>Người nhận:<b> {{ $order->shippingAddress->full_name }} </b></p>
                <p>Địa chỉ:<b> {{ $order->shippingAddress->address }} </b></p>
                <p>Thành phố:<b> {{ $order->shippingAddress->city }} </b></p>
                <p>Số điện thoại:<b> {{ $order->shippingAddress->phone }} </b></p>
            </div>


            @if($order->status == 'completed')
                <h4 class="mt-4">Đánh giá sản phẩm</h4>
                <table class="table order-items-table w-100 table-fixed">
                    <thead>
                        <tr class="text-center">
                            <th>Ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Đánh giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr class="text-center">
                                <td>
                                    <img src="{{ $item->product->image_url }}" width="50">
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>
                                    <a href="{{ route('products.detail', $item->product->slug) }}" class="theme-btn-1 btn btn-effect-1">Đánh giá</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
                
            <div class="d-flex button-actions-row">
                @if($order->status == 'pending')
                    <form action="{{ route('order.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm mt-3 me-3">Hủy đơn hàng</button>
                    </form>
                @endif

                @if($order->status == 'processing')
                    <form action="{{ route('order.received', $order->id) }}" method="POST" onsubmit="return confirm('Bạn đã nhận được hàng này chưa?');">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm mt-3 me-3">Đã nhận được hàng</button>
                    </form>
                @endif

                <a href="{{ route('account') }}"><button class="btn btn-warning mt-3">Quay lại</button></a>
            </div>
        </div>
    </div>
@endsection

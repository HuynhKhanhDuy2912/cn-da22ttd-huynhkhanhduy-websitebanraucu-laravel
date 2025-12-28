@extends('layouts.client')

@section('title', 'Giỏ hàng')
@section('breadcrumb', 'Giỏ hàng')

@section('content')
    <style>
        .table {
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
            padding: 10px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .cart-product-image img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
    <!-- SHOPING CART AREA START -->
    <div class="liton__shoping-cart-area mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table">
                                <thead>
                                    <th class="cart-product-remove"></th>
                                    <th class="cart-product-image">Ảnh sản phẩm</th>
                                    <th class="cart-product-info">Tên sản phẩm</th>
                                    <th class="cart-product-price">Giá tiền</th>
                                    <th class="cart-product-quantity">Số lượng</th>
                                    <th class="cart-product-subtotal">Thành tiền</th>
                                </thead>
                                <tbody>
                                    @php
                                        $cartTotal = 0;
                                    @endphp
                                    @forelse ($cartItems as $item)
                                        @php
                                            $subTotal = $item['price'] * $item['quantity'];
                                            $cartTotal += $subTotal;
                                        @endphp
                                        <tr>
                                            <td class="cart-product-remove">
                                                <button class="remove-from-cart"
                                                    data-id="{{ $item['product_id'] }}">x</button>
                                            </td>
                                            <td class="cart-product-image">
                                                <a href="javascript:void(0)"><img
                                                        src="{{ asset('storage/' . $item['image'] ?? 'storage/uploads/products/product-default.png') }}"
                                                        alt="#"></a>
                                            </td>
                                            <td class="cart-product-info">
                                                <h4><a href="javascript:void(0)">{{ $item['name'] }}</a></h4>
                                            </td>
                                            <td class="cart-product-price">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                                            <td class="cart-product-quantity">
                                                <div class="cart-plus-minus">
                                                    <div class="dec qtybutton">-</div>
                                                    <input type="text" value="{{ $item['quantity'] }}" name="qtybutton"
                                                        class="cart-plus-minus-box" readonly data-max="{{ $item['stock'] }}"
                                                        data-id="{{ $item['product_id'] }}">
                                                    <div class="inc qtybutton">+</div>
                                                </div>
                                            </td>
                                            <td class="cart-product-subtotal">{{ number_format($subTotal, 0, ',', '.') }}
                                                đ</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center pt-115">Không có sản phẩm nào trong giỏ hàng</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if (!empty($cartItems))
                            <div class="shoping-cart-total mt-50">
                                <h4 class="text-center">TỔNG GIỎ HÀNG</h4>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Tổng tiền:</td>
                                            <td><spn class="cart-total">{{ number_format($cartTotal, 0, ',', '.') }} đ</spn></td>
                                        </tr>
                                        <tr>
                                            <td>Phí vận chuyển:</td>
                                            <td>25.000 đ</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tổng thanh toán</strong></td>
                                            <td><strong><span class="cart-grand-total">{{ number_format($cartTotal + 25000, 0, ',', '.') }} đ</span></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-wrapper text-right text-end">
                                    <a href="{{ route('checkout') }}" class="theme-btn-1 btn btn-effect-1">Tiến hành thanh toán</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOPING CART AREA END -->
@endsection

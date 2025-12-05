@extends('layouts.client')

@section('title', 'Sản phẩm tìm kiếm')
@section('breadcrumb', 'Sản phẩm tìm kiếm')

@section('content')
    <div class="ltn__product-area ltn__product-gutter mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="liton_product_grid">
                            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="ltn__shop-options">
                                            <ul>
                                                <li>
                                                    <div class="ltn__grid-list-tab-menu ">
                                                        <div class="nav">
                                                            <a class="active show" data-bs-toggle="tab"
                                                                href="#liton_product_grid"><i
                                                                    class="fas fa-th-large"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    @if ($products->total() == 0)
                                                        <div class="showing-product-number text-right text-end"></div>
                                                    @else
                                                        <div class="showing-product-number text-right text-end">
                                                            <span style="font-size: 15px !important">
                                                                Hiển thị {{ $products->lastItem() }} trong tổng số
                                                                {{ $products->total() }} sản phẩm
                                                            </span>
                                                        </div>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="row">
                                            @forelse ($products as $product)
                                                <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                                    <div class="ltn__product-item ltn__product-item-3 text-center">
                                                        <div class="product-img">
                                                            <a href="{{ route('products.detail', $product->slug) }}"><img
                                                                    src="{{ $product->image_url }}"
                                                                    alt="{{ $product->name }}"></a>
                                                            <div class="product-hover-action">
                                                                <ul>
                                                                    <li>
                                                                        <a href="#" title="Xem nhanh"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#quick_view_modal-{{ $product->id }}">
                                                                            <i class="far fa-eye"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        @if (Auth::check())
                                                                            <a href="#" class="add-to-cart-btn"
                                                                                title="Thêm vào giỏ hàng"
                                                                                data-bs-toggle="modal"
                                                                                data-id="{{ $product->id }}"
                                                                                data-bs-target="#add_to_cart_modal-{{ $product->id }}">
                                                                                <i class="fas fa-shopping-cart"></i>
                                                                            </a>
                                                                        @else
                                                                            <a href="javascript:void(0)"
                                                                                onclick="showLoginWarning()">
                                                                                <i class="fas fa-shopping-cart"></i>
                                                                            </a>
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        @if (Auth::check())
                                                                            @if (in_array($product->id, $likedProduct))
                                                                                <a href="javascript:void(0)"
                                                                                    style="cursor: default;">
                                                                                    <i class="fas fa-heart"
                                                                                        style="color: red;"></i>
                                                                                </a>
                                                                            @else
                                                                                <a href="#" class="add-to-wishlist"
                                                                                    title="Yêu thích" data-bs-toggle="modal"
                                                                                    data-id = "{{ $product->id }}"
                                                                                    data-bs-target="#liton_wishlist_modal-{{ $product->id }}">
                                                                                    <i class="far fa-heart"></i></a>
                                                                            @endif
                                                                        @else
                                                                            <a href="javascript:void(0)"
                                                                                onclick="showLoginWarning()">
                                                                                <i class="far fa-heart"></i>
                                                                            </a>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="product-info">
                                                            <div class="product-ratting">
                                                                @include(
                                                                    'clients.components.includes.rating',
                                                                    ['product' => $product]
                                                                )
                                                            </div>
                                                            <h2 class="product-title"><a
                                                                    href="{{ route('products.detail', $product->slug) }}">{{ $product->name }}</a>
                                                            </h2>
                                                            <div class="product-price">
                                                                <span>{{ number_format($product->price, 0, ',', '.') }}
                                                                    VNĐ/{{ $product->unit }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center my-5">
                                                    <h4>Không có sản phẩm phù hợp với từ khóa bạn đã nhập. Thử các từ khóa
                                                        phổ biến hơn để có thêm lựa chọn nhé!</h4>
                                                </div>
                                            @endforelse
                                        </div>
                                        <div class="ltn__pagination-area text-center">
                                            <div class="ltn__pagination">
                                                {!! $products->links('clients.components.pagination.pagination-custom') !!}
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

@extends('layouts.client')

@section('title', 'Sản phẩm yêu thích')
@section('breadcrumb', 'Sản phẩm yêu thích')

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
    }

    .table th:nth-child(1),
    .table td:nth-child(1) {
        width: 5%;
    }

    .table th:nth-child(2),
    .table td:nth-child(2) {
        width: 15%;
    }

    .table th:nth-child(3),
    .table td:nth-child(3) {
        width: 30%;
        white-space: normal;
    }

    .table th:nth-child(4),
    .table td:nth-child(4) {
        width: 15%;
    }

    .table th:nth-child(5),
    .table td:nth-child(5) {
        width: 35%;
    }
</style>

    <div class="liton__shoping-cart-area mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table">
                                <thead>
                                    <th class="wishlist-product-remove"></th>
                                    <th class="wishlist-product-image">Ảnh sản phẩm</th>
                                    <th class="wishlist-product-info">Tên sản phẩm</th>
                                    <th class="wishlist-product-status">Trạng thái</th>
                                    <th class="wishlist-product-add"></th>
                                </thead>
                                <tbody>
                                    @forelse ($wishlists as $item)
                                        <tr>
                                            <td class="wishlist-product-remove" data-id="{{ $item->product->id }}">
                                                <button class="remove-from-wishlist">x</button>
                                            </td>
                                            <td class="wishlist-product-image">
                                                <a href="{{ route('products.detail', $item->product->slug) }}"><img src="{{ $item->product->image_url }}"></a>
                                            </td>
                                            <td class="wishlist-product-info">
                                                <a href="{{ route('products.detail', $item->product->slug) }}">{{ $item->product->name }}</a>
                                            </td>
                                            <td class="wishlist-product-status">
                                                {{ $item->product->status == "in_stock" ? "Còn hàng" : "Hết hàng" }}
                                            </td>
                                            <td class="wishlist-product-add">
                                                <a href="{{ route('products.detail', $item->product->slug) }}" 
                                                    class="theme-btn-1 btn btn-effect-1 add-to-cart-btn"
                                                    title="Thêm vào giỏ hàng"><i class="fas fa-shopping-cart"></i>
                                                    <span>Thêm vào giỏ hàng</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center pt-115">Không có sản phẩm nào trong danh sách yêu thích.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="ltn__pagination-area text-center">
                        <div class="ltn__pagination">
                            {!!$wishlists->links('clients.components.pagination.pagination-custom')!!}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

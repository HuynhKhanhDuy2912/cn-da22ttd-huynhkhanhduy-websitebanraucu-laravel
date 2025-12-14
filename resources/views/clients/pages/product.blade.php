@extends('layouts.client')

@section('title', 'Sản phẩm')
@section('breadcrumb', 'Sản phẩm')

@section('content')
    <div class="ltn__product-area ltn__product-gutter">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-lg-2 mb-80">
                    <div class="ltn__shop-options">
                        <ul>
                            <li>
                                <div class="ltn__grid-list-tab-menu ">
                                    <div class="nav">
                                        <a class="active show" data-bs-toggle="tab" href="#liton_product_grid"><i
                                                class="fas fa-th-large"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="short-by text-center">
                                    <select id="sort-by" class="nice-select">
                                        <option value="default">Sắp xếp mặc định</option>
                                        <option value="latest">Sắp xếp theo hàng mới về</option>
                                        <option value="price_asc">Sắp xếp theo giá: thấp đến cao</option>
                                        <option value="price_desc">Sắp xếp theo giá: cao đến thấp</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="showing-product-number text-right text-end">
                                    <span style="font-size: 15px !important">
                                        @php
                                            $currentPage = $products->currentPage();
                                            $perPage = $products->perPage();
                                            $total = $products->total();

                                            $from = ($currentPage - 1) * $perPage + 1;
                                            $to = min($currentPage * $perPage, $total);
                                        @endphp

                                        @if ($total > 0)
                                            Hiển thị {{ $from }} đến {{ $to }} của {{ $total }} sản phẩm
                                        @else
                                            Không có sản phẩm nào
                                        @endif
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="loading-spinner">
                            <div class="loader"></div>
                        </div>
                        @include('clients.components.products_grid', ['products' => $products])
                    </div>
                    <div class="ltn__pagination-area text-center">
                        <div class="ltn__pagination">
                            {!!$products->links('clients.components.pagination.pagination-custom')!!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  mb-80">
                    <aside class="sidebar ltn__shop-sidebar">
                        <!-- Search Widget -->
                        <div class="widget ltn__search-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Tìm kiếm sản phẩm</h4>
                            <form method="GET" action="{{ route('search') }}">
                                <input type="text" name="keyword" placeholder="Nhập tên sản phẩm...">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <!-- Category Widget -->
                        <div class="widget ltn__menu-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Danh mục sản phẩm</h4>
                            <ul>
                                @foreach ($categories as $category)
                                <li>
                                    <a href="#" class="category-filter" data-id="{{$category->id}}">{{{$category->name}}} 
                                        <span><i class="fas fa-long-arrow-alt-right"></i></span></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Price Filter Widget -->
                        <div class="widget ltn__price-filter-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Lọc theo giá</h4>
                            <div class="price_filter">
                                <div class="price_slider_amount">
                                    <input type="submit" value="Giá:" />
                                    <input type="text" class="amount" name="price"
                                        placeholder="Add Your Price"  style="width: 200px !important"/>
                                </div>
                                <div class="slider-range"></div>
                            </div>
                        </div>
                        <!-- Top Rated Product Widget -->
                        <div class="widget ltn__top-rated-product-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Sản phẩm được đánh giá cao nhất</h4>
                            <ul>
                                @foreach ($productHighRate as $product)
                                    <li>
                                    <div class="top-rated-product-item clearfix">
                                        <div class="top-rated-product-img me-0">
                                            <a href="{{ route('products.detail', $product->slug) }}"><img src="{{ $product->image_url }}"
                                                    alt="#"></a>
                                        </div>
                                        <div class="top-rated-product-info" style="padding-left: 15px">
                                            <div class="product-ratting">
                                                <ul>
                                                    @include('clients.components.includes.rating', ['product' => $product])
                                                </ul>
                                            </div>
                                            <h6><a href="{{ route('products.detail', $product->slug) }}">{{ $product->name }}</a></h6>
                                            <div class="product-price">
                                                <span>{{ number_format($product->price, 0, ',', '.') }} VNĐ/{{ $product->unit }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Banner Widget -->
                        <div class="widget ltn__banner-widget mt-45">
                            <a href="javascript:void(0)"><img src="{{asset('assets/clients/img/banner/banner-1.jpg')}}" alt="#"></a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection

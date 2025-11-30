@extends('layouts.client')

@section('title', 'Chi tiết sản phẩm')
@section('breadcrumb', 'Chi tiết sản phẩm')

@section('content')
    <!-- SHOP DETAILS AREA START -->
    <div class="ltn__shop-details-area pb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="ltn__shop-details-inner mb-60">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ltn__shop-details-img-gallery">
                                    <div class="ltn__shop-details-large-img">
                                        <div class="single-large-img">
                                            @foreach ($product->images as $image)
                                                <a href="{{ asset('storage/' . $image->image) }}"
                                                    data-rel="lightcase:myCollection">
                                                    <img src="{{ asset('storage/' . $image->image) }}"
                                                        alt="{{ $product->name }}">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="ltn__shop-details-small-img slick-arrow-2">
                                        @foreach ($product->images as $image)
                                            <div class="single-small-img">
                                                <img src="{{ asset('storage/' . $image->image) }}"
                                                    alt="{{ $product->name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-product-info shop-details-info pl-0">
                                    <div class="product-ratting">
                                        @include('clients.components.includes.rating', [
                                            'product' => $product,
                                        ])
                                    </div>
                                    <h3>{{ $product->name }}</h3>
                                    <div class="product-price">
                                        <span>{{ number_format($product->price, 0, ',', '.') }}
                                            VNĐ/{{ $product->unit }}</span>
                                    </div>
                                    <div class="modal-product-meta ltn__product-details-menu-1">
                                        <ul>
                                            <li>
                                                <strong>Danh mục:</strong>
                                                <span>
                                                    <a href="#">{{ $product->category->name }}</a>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ltn__product-details-menu-2">
                                        <ul>
                                            <li>
                                                <div class="cart-plus-minus">
                                                    <div class="dec qtybutton">-</div>
                                                    <input type="text" value="1" name="qtybutton"
                                                        class="cart-plus-minus-box" readonly
                                                        data-max="{{ $product->stock }}">
                                                    <div class="inc qtybutton">+</div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#" class="theme-btn-1 btn btn-effect-1 add-to-cart-btn"
                                                    title="Thêm vào giỏ hàng" data-id="{{ $product->id }}">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    <span>Thêm vào giỏ hàng</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ltn__product-details-menu-3">
                                        <ul>
                                            <li style="margin-right: 198px">
                                                <span style="font-weight: 500">Còn lại: </span><span>{{ $product->stock }}
                                                    sản phẩm</span><br>
                                            </li>
                                            <li>
                                                @if (Auth::check())
                                                    @if (in_array($product->id, $likedProduct))
                                                        <a href="javascript:void(0)" style="cursor: default;">
                                                            <i class="fas fa-heart" style="color: red;"></i>
                                                        </a> Đã thích
                                                    @else
                                                        <a href="#" class="add-to-wishlist" title="Yêu thích" 
                                                        data-bs-toggle="modal" data-id = "{{ $product->id }}"
                                                        data-bs-target="#liton_wishlist_modal-{{ $product->id }}">
                                                        <i class="far fa-heart"></i></a> Yêu thích
                                                    @endif
                                                @else
                                                    <a href="javascript:void(0)" onclick="showLoginWarning()">
                                                        <i class="far fa-heart"></i> Yêu thích
                                                    </a>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <hr style="height: 2px;">
                                    <div class="ltn__social-media">
                                        <ul>
                                            <li>Chia sẻ:</li>
                                            <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                            </li>
                                            <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                            <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <hr style="height: 2px;">
                                    <div class="ltn__safe-checkout">
                                        <h5>Đảm bảo an toàn thanh toán</h5>
                                        <img src="{{ asset('assets/clients/img/icons/payment-2.png') }}"
                                            alt="Payment Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Tab Start -->
                    <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                        <div class="ltn__shop-details-tab-menu">
                            <div class="nav">
                                <a class="active show" data-bs-toggle="tab" href="#liton_tab_details_description">Mô tả sản
                                    phẩm</a>
                                <a data-bs-toggle="tab" href="#liton_tab_details_review" class="">Đánh giá sản
                                    phẩm</a>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="liton_tab_details_description">
                                <div class="ltn__shop-details-tab-content-inner">
                                    <h4 class="title-2">{{ $product->name }}</h4>
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="liton_tab_details_review">
                                <div class="ltn__shop-details-tab-content-inner">
                                    <h4 class="title-2">Đánh giá của khách hàng</h4>
                                    <div class="product-ratting">
                                        <ul>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($avgRating))
                                                    <li><i class="fas fa-star"></i></li>
                                                @elseif ($i == ceil($avgRating) && $avgRating - floor($avgRating) >= 0.5)
                                                    <li><i class="fas fa-star-half-alt"></i></li>
                                                @else
                                                    <li><i class="far fa-star"></i></li>
                                                @endif
                                            @endfor
                                            <li class="review-total">({{ $product->reviews->count() }} Đánh giá)</li>
                                        </ul>
                                    </div>
                                    <hr>
                                    <!-- comment-area -->
                                    <div class="ltn__comment-area mb-30">
                                        <div class="ltn__comment-inner">
                                            @include('clients.components.includes.review-list', [
                                                'product' => $product,
                                            ])
                                        </div>
                                    </div>
                                    <!-- comment-reply -->
                                    @if (Auth::check() && $hasPurchased && !$hasReviewed)
                                        <div class="ltn__comment-reply-area ltn__form-box mb-30">
                                            <div id="rating-error"></div>
                                            <form id="review-form" data-product-id={{ $product->id }}>
                                                <h4 class="title-2">Thêm đánh giá</h4>
                                                <div class="mb-30">
                                                    <div class="add-a-review">
                                                        <h6>Số sao:</h6>
                                                        <div class="product-ratting">
                                                            <ul>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <li><a href="javascript:void(0)" class="rating-star"
                                                                            data-value="{{ $i }}"><i
                                                                                class="far fa-star"></i>
                                                                        </a>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="rating" id="rating-value">
                                                <div class="input-item input-item-textarea ltn__custom-icon">
                                                    <textarea placeholder="Nhập đánh giá của bạn..." id="review-content"></textarea>
                                                </div>
                                                <div class="btn-wrapper">
                                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase"
                                                        type="submit">Gửi</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Tab End -->
                </div>
            </div>
        </div>
    </div>
    <!-- SHOP DETAILS AREA END -->
    @include('clients.components.includes.include_modal')

    <!-- PRODUCT SLIDER AREA START -->
    <div class="ltn__product-slider-area ltn__product-gutter pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2">
                        <h5 class="section-title" style="font-size: 35px !important">Sản phẩm tương tự</h5>
                    </div>
                </div>
            </div>
            <div class="row ltn__related-product-slider-one-active slick-arrow-1">
                <!-- ltn__product-item -->
                @foreach ($relatedProducts as $product)
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="{{ route('products.detail', $product->slug) }}"><img
                                        src="{{ $product->image_url }}" alt="{{ $product->name }}"></a>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Xem nhanh" data-bs-toggle="modal"
                                                data-bs-target="#quick_view_modal-{{ $product->id }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            @if (Auth::check())
                                                <a href="#" class="add-to-cart-btn" title="Thêm vào giỏ hàng"
                                                    data-bs-toggle="modal" data-id="{{ $product->id }}"
                                                    data-bs-target="#add_to_cart_modal-{{ $product->id }}">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" onclick="showLoginWarning()">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                            @endif
                                        </li>
                                        <li>
                                            @if (Auth::check())
                                                @if (in_array($product->id, $likedProduct))
                                                    <a href="javascript:void(0)" style="cursor: default;">
                                                        <i class="fas fa-heart" style="color: red;"></i>
                                                    </a>
                                                @else
                                                    <a href="#" class="add-to-wishlist" title="Yêu thích" 
                                                    data-bs-toggle="modal" data-id = "{{ $product->id }}"
                                                    data-bs-target="#liton_wishlist_modal-{{ $product->id }}">
                                                    <i class="far fa-heart"></i></a>
                                                @endif
                                            @else
                                                <a href="javascript:void(0)" onclick="showLoginWarning()">
                                                    <i class="far fa-heart"></i> 
                                                </a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-ratting">
                                    @include('clients.components.includes.rating', ['product' => $product])
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
                @endforeach
                <!--  -->
            </div>
            @foreach ($relatedProducts as $product)
                @include('clients.components.includes.include_modal')
            @endforeach
        </div>
    </div>
    <!-- PRODUCT SLIDER AREA END -->
@endsection

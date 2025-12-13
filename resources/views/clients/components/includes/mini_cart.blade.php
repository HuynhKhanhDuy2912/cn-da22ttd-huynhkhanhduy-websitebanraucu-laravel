<div class="ltn__utilize-menu-head">
    <span class="ltn__utilize-menu-title" style="font-size: 20px">Giỏ hàng</span>
    <button class="ltn__utilize-close">x</button>
</div>
<div class="mini-cart-product-area ltn__scrollbar">
    @php
        $subtotal = 0;
    @endphp
    @if (count($cartItems) > 0)
        @foreach ($cartItems as $item)
            @php
                $product = $item->product;
                $quantity = $item->quantity;
                $subtotal += $quantity * $product->price;
            @endphp
            <div class="mini-cart-item clearfix">
                <div class="mini-cart-img">
                    <a href="#">
                        <img src="{{ $product->image_url }}" alt="Image">
                    </a>
                    <span class="mini-cart-item-delete" data-id="{{$product->id}}">
                        <i class="icon-cancel"></i>
                    </span>
                </div>
                <div class="mini-cart-info">
                    <h6><a href="#">{{$product->name}}</a></h6>
                    <span class="mini-cart-quantity">{{$quantity}} x {{number_format($product->price, 0, ',', '.')}}</span>
                </div>
            </div>
        @endforeach  
    @else
        <div style="margin-top: 200px; margin-bottom: 150px;">
            <h5>Không có sản phẩm nào trong giỏ hàng</h5>
        </div>   
    @endif
</div>
@if (count($cartItems) > 0)
    <div class="mini-cart-footer">
        <div class="mini-cart-sub-total">
            <h5>Tổng tiền: <span></span>{{number_format($subtotal, 0, ',', '.')}} VNĐ</h5>
        </div>
        <div class="btn-wrapper" >
            <a href="{{route('cart.index')}}" class="theme-btn-1 btn btn-effect-1" style="font-size: 15px; padding: 15px 25px;">Xem giỏ hàng</a>
            <a href="{{ route('checkout') }}" class="theme-btn-2 btn btn-effect-2" style="font-size: 15px; padding: 15px 25px;">Thanh toán</a>
        </div>
    </div>
@else
    <div class="mini-cart-footer" style="display: flex; justify-content: center;">
        <div class="btn-wrapper " >
            <a href="{{route('products.index')}}" class="theme-btn-1 btn btn-effect-1" style="font-size: 15px; padding: 15px 25px;">Mua ngay</a>
        </div>
    </div>
@endif


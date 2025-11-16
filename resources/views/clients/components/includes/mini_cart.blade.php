<div class="ltn__utilize-menu-head">
    <span class="ltn__utilize-menu-title" style="font-size: 20px">Giỏ hàng</span>
    <button class="ltn__utilize-close">x</button>
</div>
<div class="mini-cart-product-area ltn__scrollbar">
    @if (!empty($cartItems) && count($cartItems) > 0)
        @php
            $subtotal = 0;
        @endphp
        @foreach ($cartItems as $item)
            @php
                $product = $item->product;
                $quantity = $item->quantity;
                $subtotal += $quantity * $product->price;
            @endphp
            <div class="mini-cart-item clearfix">
                <div class="mini-cart-img">
                    <a href="#">
                        <img src="{{asset($product->images->first()->image_path ?? 'storage/uploads/products/product-default.png')}}" alt="Image">
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
    @endif
</div>
<div class="mini-cart-footer">
    <div class="mini-cart-sub-total">
        <h5>Tổng tiền: <span></span>{{number_format($subtotal, 0, ',', '.')}} VNĐ</h5>
    </div>
    <div class="btn-wrapper" >
        <a href="{{route('cart.index')}}" class="theme-btn-1 btn btn-effect-1" style="font-size: 15px; padding: 15px 25px;">Xem giỏ hàng</a>
        <a href="cart.html" class="theme-btn-2 btn btn-effect-2" style="font-size: 15px; padding: 15px 25px;">Thanh toán</a>
    </div>
</div>

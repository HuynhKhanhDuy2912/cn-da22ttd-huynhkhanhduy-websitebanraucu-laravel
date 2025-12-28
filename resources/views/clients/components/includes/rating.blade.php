<ul>
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= floor($product->average_rating))
            <li><i class="fas fa-star"></i></li>
        @elseif ($i == ceil($product->average_rating) && $product->average_rating - floor($product->average_rating) >= 0.5)
            <li><i class="fas fa-star-half-alt"></i></li>
        @else
            <li><i class="far fa-star"></i></li>
        @endif
    @endfor
    <li class="review-total">({{ $product->reviews->count() }} đánh giá)</li>
</ul>

<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();

        $products = Product::with('firstImage')->where('status', 'in_stock')->paginate(9);

        $likedProduct = []; 
        if (Auth::check()) {
            $likedProduct = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }

        return view('clients.pages.product', compact('categories', 'products', 'likedProduct'));
    }

    public function filter(Request $request)
    {
        $likedProduct = [];
        if (Auth::check()) {
            $likedProduct = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }

        $query = Product::query()->where('status', 'in_stock');

        //Filter Category if exist
        if($request->has('category_id') && $request->category_id != "")
        {
            $query->where('category_id', $request->category_id);
        }

        //Filter Price if exist
        if($request->has('min_price') && $request->has('max_price'))
        {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        //Filter SortBy if exist
        if($request->has('sort_by'))
        {
            switch ($request->sort_by) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;  
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;                                
                default:
                    $query->orderBy('id', 'desc');
                    break;
            }
        }

        $products = $query->paginate(9);

        return response()->json([
            'products' => view('clients.components.products_grid', compact('products', 'likedProduct'))->render(),
            'pagination' => $products->links('clients.components.pagination.pagination-custom')->toHtml(),
            'count' => $products->count(),   
            'total' => $products->total()
        ]);
    }

    public function detail($slug)
    {
        $product = Product::with(['category', 'images', 'reviews.user'])->where('slug', $slug)->firstOrFail();

        $likedProduct = [];
        if (Auth::check()) {
            $likedProduct = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }

        //Get product in the same category
        $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->limit(9)->get();

        //Calculate average rating 
        $avgRating = round($product->reviews()->avg('rating') ?? 0, 1);

        $hasPurchased = false;
        $hasReviewed = false;

        if(Auth::check())
        {
            $user = Auth::user();

            $hasPurchased = OrderItem::whereHas('order',function($query) use ($user){
                $query->where('user_id', $user->id)->where('status', 'completed');
            })->where('product_id', $product->id)->exists();

            $hasReviewed = Review::where('user_id', $user->id)->where('product_id', $product->id)->exists();
        }

        return view('clients.pages.product_detail', compact('product','relatedProducts', 'hasPurchased', 'hasReviewed', 'avgRating', 'likedProduct'));
    }
}

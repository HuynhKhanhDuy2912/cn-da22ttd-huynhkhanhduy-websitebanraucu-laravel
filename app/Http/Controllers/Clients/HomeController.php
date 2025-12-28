<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();

        foreach ($categories as $index => $category) {
            foreach ($category->products as $product) {
                $product->image_url = $product->firstImage?->Image
                    ? asset('storage/uploads/products/' . $product->firstImage->image) : asset('storage/uploads/products/product-default.png');
            }
        }

        $bestSelling = Product::select('products.*')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->selectRaw('SUM(order_items.quantity) as total_sold')
            ->groupBy('products.id', 'products.name', 'products.slug', 'products.category_id', 'products.description', 'products.price', 'products.stock', 'products.status', 'products.unit', 'products.created_at', 'products.updated_at')
            ->orderByDesc('total_sold')
            ->limit(8)->get();
        
        $likedProduct = [];
        if (Auth::check()) {
            $likedProduct = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }

        return view('clients.pages.home', compact('categories', 'bestSelling', 'likedProduct'));
    }
}

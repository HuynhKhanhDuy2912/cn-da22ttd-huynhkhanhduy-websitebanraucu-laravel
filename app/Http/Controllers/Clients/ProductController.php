<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();

        $products = Product::with('firstImage')->where('status', 'in_stock')->paginate(9);

        foreach ($products as $product) {
            $product->image_url = $product->firstImage?->Image
                ? asset('storage/uploads/products/' . $product->firstImage->image) : asset('storage/uploads/products/product-default.png');
        }

        return view('clients.pages.product', compact('categories', 'products'));
    }

    public function filter(Request $request)
    {
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
        
        foreach ($products as $product) {
            $product->image_url = $product->firstImage?->Image
                ? asset('storage/uploads/products/' . $product->firstImage->image) : asset('storage/uploads/products/product-default.png');
        }

        return response()->json([
            'products' => view('clients.components.products_grid', compact('products'))->render(),
        ]);
    }
}

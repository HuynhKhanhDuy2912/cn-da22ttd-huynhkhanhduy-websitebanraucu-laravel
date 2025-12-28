<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Flasher\Toastr\Prime\toastr;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        if (!$keyword) {
            toastr()->error('Vui lòng nhập từ khóa tìm kiếm!');
            return redirect()->back();
        }

        $products = Product::where('name', 'LIKE', "%$keyword%")
            ->orWhere('description', 'LIKE', "%$keyword%")
            ->paginate(12)->appends(['keyword' => $keyword]);


        $likedProduct = [];
        if (Auth::check()) {
            $likedProduct = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }

        return view('clients.pages.product_search', compact('products', 'likedProduct'));
    }
}

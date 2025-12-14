<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->paginate(4);

        $likedProduct = [];
        if (Auth::check()) 
        {
            $likedProduct = $wishlists->pluck('product_id')->toArray();
        }

        return view('clients.pages.wishlist', compact('wishlists', 'likedProduct'));
    }

    public function addToWishList(Request $request)
    {
        $user_id = Auth::id();
        $product_id = $request->product_id;

        Wishlist::create([
            'user_id' => $user_id,
            'product_id' => $product_id
        ]);
        
        return response()->json([
            'status' => true
        ]);
    }

    public function removeWishListItem(Request $request)
    {
        Wishlist::where('user_id', Auth::id())->where('product_id', $request->product_id)->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Đã xóa sản phẩm khỏi danh sách yêu thích'
        ]);
    }
}

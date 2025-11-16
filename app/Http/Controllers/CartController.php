<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //Add to cart
    public function addToCart(Request $request)
    {
        $request->merge(['quantity' => (int) $request->quantity]);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        if ($request->quantity > $product->stock) {
            return response()->json(['message' => 'Số lượng vượt quá tồn kho'], 400);
        }

        $cartCount = 0;

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        $cartCount = CartItem::where('user_id', Auth::id())->count();
        return response([
            'message' => true,
            'cart_count' => $cartCount
        ]);
    }

    //Show MiniCart
    public function loadMiniCart()
    {
        $cartItems = [];
        
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
            return response([
                'status' => true,
                'html' => view('clients.components.includes.mini_cart', compact('cartItems'))->render()           
        ]);
    }

    //Delete product in MiniCart
    public function deleteMiniCart(Request $request)
    {
        $request->validate(['product_id' => 'required']);


        CartItem::where('user_id', Auth::id())->where('product_id', $request->product_id)->delete();

        $cartCount = CartItem::where('user_id', Auth::id())->count();

        return response([
            'status' => true,
            'cart_count' => $cartCount
        ]);
    }

    //Show products in Cart
    public function viewCart()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get()->map(function($item){
            return [
                'product_id' => $item->product->id,
                'name' => $item->product->name,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'stock' => $item->product->stock,
                'image' => $item->product->images->first()->image ?? 'uploads/products/product-default.png',
            ];
        })->toArray();
        
        return view('clients.pages.cart', compact('cartItems'));
    }

    //Handle update quantity product in cart
    public function updateCart(Request $request)    
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;
        
        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->where('product_id', $productId)->first();
        if(!$cartItems)
        {
            return response()->json(['error' => 'Sản phẩm không tồn tại trong giỏ hàng.'], 404);
        }

        $product = Product::find($productId);
        if($quantity > $product->stock)
        {
            return response()->json(['error' => 'Số lượng vượt quá tồn kho.'], 400);
        }
        
        $cartItems->quantity = $quantity;
        $cartItems->save();

        //Calculate CartTotal Again
        $subTotal = $quantity * $product->price;
        $total = $this->calculateCartTotal();
        $grandTotal = $total + 25000;

        return response()->json([
            'quantity' => $quantity,
            'subTotal' => number_format($subTotal, 0, ',', '.'),
            'total' => number_format($total, 0, ',', '.'),
            'grandTotal' => number_format($grandTotal, 0, ',', '.'),
        ]);
    }

    //Handle delete product in cart
    public function deleteCartittem(Request $request)
    {
        $productId = $request->product_id;        
        CartItem::where('user_id', Auth::id())->with('product')->where('product_id', $productId)->delete();

        //Calculate CartTotal Again
        $total = $this->calculateCartTotal();
        $grandTotal = $total + 25000;

        return response()->json([
            'total' => number_format($total, 0, ',', '.'),
            'grandTotal' => number_format($grandTotal, 0, ',', '.'),
        ]);
    }

    //Calculate CartTotal
    function calculateCartTotal()
    {
        return CartItem::where('user_id',Auth::id())->with('product')->get()->sum(fn($item) => $item->quantity * $item->product->price);
    }
}

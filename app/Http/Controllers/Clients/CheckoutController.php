<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ShippingAddress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Matcher\Any;

use function Flasher\Toastr\Prime\toastr;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $addresses = ShippingAddress::where('user_id', $user->id)->get();
        $defaultAddress = $addresses->where('default', 1)->first();
        if (is_null($addresses) || is_null($defaultAddress)) {
            toastr()->error('Vui lòng thêm địa chỉ giao hàng!');
            return redirect()->route('account');
        }

        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();
        $totalPrice = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);

        return view('clients.pages.checkout', compact('addresses', 'defaultAddress', 'cartItems', 'totalPrice'));
    }

    public function getAddress(Request $request)
    {
        $address = ShippingAddress::where('id', $request->address_id)->where('user_id', Auth::id())->first();

        if (!$address) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy địa chỉ!']);
        }

        return response()->json([
            'success' => true,
            'data' => $address
        ]);
    }

    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        DB::beginTransaction();

        try {
            //Create order
            $order = new Order();
            $order->user_id = $user->id;
            $order->total_price = $cartItems->sum(fn($item) => $item->quantity * $item->product->price) + 25000;
            $order->status = 'pending';
            $order->shipping_address_id = $request->address_id;
            $order->save();

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);

                //Delete the number of products sold
                $product = $item->product;
                $product->stock  -= $item->quantity;
                if ($product->stock  < 0) {
                    $product->stock  = 0;
                }
                $product->save();
            }

            //Create payment
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'amount' => $order->total_price,
                'status' => 'pending',
                'paid_at' => null
            ]);

            //Delete products form cart after order
            CartItem::where('user_id', $user->id)->delete();

            DB::commit();
            toastr()->success('Đặt hàng thành công!');

            return redirect()->route('account');
        } catch (\Exception $e) {
            toastr()->error('Có xảy ra lỗi vui lòng thử lại!');
            return redirect()->route('checkout');
        }
    }

    public function placeOrderPaypal(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $cartItems = CartItem::where('user_id', $user->id)->get();

            //Create order
            $order = new Order();
            $order->user_id = $user->id;
            $order->total_price = $request->amount * 25000;
            $order->status = 'pending';
            $order->shipping_address_id = $request->address_id;
            $order->save();

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);

                //Delete the number of products sold
                $product = $item->product;
                $product->stock  -= $item->quantity;
                if ($product->stock  < 0) {
                    $product->stock  = 0;
                }
                $product->save();
            }

            //Create payment
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'paypal',
                'transaction_id' => $request->transactionID,
                'amount' => $order->total_price,
                'status' => 'completed',
                'paid_at' => now()
            ]);

            //Delete products form cart after order
            CartItem::where('user_id', $user->id)->delete();

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            toastr()->error('Có xảy ra lỗi vui lòng thử lại!');
            return redirect()->route('checkout');
        }
    }
}

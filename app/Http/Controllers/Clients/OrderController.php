<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Flasher\Toastr\Prime\toastr;

class OrderController extends Controller
{
    public function showOrder($id)
    {
        $order = Order::with(['orderItems.product', 'user', 'shippingAddress', 'payment'])->findOrFail($id);
        $userId = Auth::id();

        return view('clients.pages.order_detail', compact('order'));
    }

    public function cancelOrder($id)
    {
        $order = Order::where('id', $id)
        ->where('user_id', Auth::id())
        ->where('status', 'pending')
        ->firstOrFail();

        foreach($order->orderItems as $item)
        {
            $item->product->increment('stock', $item->quantity);
        }

        //Update order status has been canceled
        $order->update(['status' => 'canceled']);

        toastr()->success('Đơn hàng của bạn đã được hủy thành công!');
        return redirect()->back();

    }
}

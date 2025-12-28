<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems', 'shippingAddress', 'user', 'payment')->get();

        return view('admin.pages.orders', compact('orders'));
    }

    public function confirmOrder(Request $request)
    {
        $order = Order::find($request->id);

        if ($order) {
            $order->status = 'processing';
            $order->save();
            return response()->json([
                'status' => true,
                'message' => 'Xác nhận đơn hàng thành công!'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Đơn hàng không tồn tại.'
        ]);
    }

    public function confirmPayment(Request $request)
    {
        $order = Order::find($request->id);

        if ($order) {
            $order->payment->status = 'completed';
            $order->payment->save();
            return response()->json([
                'status' => true,
                'message' => 'Xác nhận thanh toán thành công!'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Đơn hàng không tồn tại.'
        ]);
    }
    
    public function orderDetail($id)
    {
        $order = Order::with('orderItems.product', 'shippingAddress', 'user', 'payment')->find($id);

        return view('admin.pages.order_detail', compact('order'));
    }

    public function sendMail(Request $request)
    {
        $id = $request->id;
        $order = Order::with('orderItems.product', 'shippingAddress', 'user', 'payment')->find($id);

        try {
            Mail::send('admin.emails.invoice',  compact('order'), function ($message) use ($order) {
                $message->to($order->user->email)->subject('Hóa đơn đơn hàng #' . $order->created_at->format('Ymd') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT));
            });

            return response()->json([
                'status' => true,
                'message' => 'Hóa đơn đã được gửi đến khách hàng!'
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể gửi hóa đơn qua email. Vui lòng thử lại sau' . $th->getMessage()
            ]);
        }
    }

    public function cancelOrder(Request $request)
    {
        $id = $request->id;
        $order = Order::find($id);
        if ($order) {

            foreach($order->orderItems as $item){
                // Update product stock
                $item->product->increment('stock', $item->quantity);
            }

            $order->status = 'canceled';
            $order->save();

            return response()->json([
                'status' => true,
                'message' => 'Đơn hàng đã được hủy thành công!'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Đơn hàng không tồn tại.'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems', 'shippingAddress', 'user', 'payment')->get();

        return view('admin.pages.orders', compact('orders'));
    }
}

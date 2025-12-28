<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 3)->latest()->get();
        $categories = Category::with('products')->get();
        $products = Product::where('stock', '>', 0)->get();
        $orders = Order::with('shippingAddress')->latest()->get();

        //Get list top 3 products best selling
        $topSelling = Product::withCount(['orderItems as total_sold' => function ($query){
            $query->select(DB::raw("SUM(quantity)"));
        }]) ->orderByDesc('total_sold')->take(3)->get();

        $monthlyRevenue = Order::select(
            DB::raw('SUM(total_price) as revenue'),
            DB::raw('MONTH(created_at) as month')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy('month', 'asc')
        ->get();

        return view('admin.pages.dashboard', compact('users', 'categories', 'products', 'orders', 'topSelling', 'monthlyRevenue'));
    }
}

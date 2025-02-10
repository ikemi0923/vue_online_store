<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::whereIn('status', ['pending', 'preparing'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.dashboard', compact('orders'));
    }
}

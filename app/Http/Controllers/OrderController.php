<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $query = Order::query();
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'LIKE', '%' . $request->phone . '%');
        }
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product')->find($id);
        if (!$order) {
            return redirect()->route('admin.orders.index')->with('error', '注文が見つかりませんでした。');
        }
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:未発送,発送準備中,発送済み',
        ]);
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();
        return redirect()->route('admin.orders.show', $id)->with('success', '発送状況を更新しました。');
    }
}

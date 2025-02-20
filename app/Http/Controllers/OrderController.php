<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;

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

        $orders = $query->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }



    public function show($id)
    {
        $order = Order::with('orderItems')->find($id);

        if (!$order) {
            return redirect()->route('orders.index')->with('error', '注文が見つかりませんでした。');
        }

        return view('admin.orders.show', compact('order'));
    }



    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,preparing,completed',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', '発送状況が更新されました');
    }



    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'images' => 'nullable|array',
                'images.*' => 'file|max:5120|mimes:jpg,jpeg,png,gif,webp',
            ]);

            DB::beginTransaction();

            $product = Product::create([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'description' => $validated['description'] ?? null,
            ]);

            if ($request->hasFile('images')) {
                $order = 0;
                foreach ($request->file('images') as $image) {
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('products', $filename, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $path,
                        'order' => $order++,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', '商品が追加されました！');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => '商品の追加に失敗しました。']);
        }
    }
}

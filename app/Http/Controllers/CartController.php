<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
// use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $tax = floor($subtotal * 0.1);
        $shipping = 500;
        $total = $subtotal + $tax + $shipping;
        return view('cart.index', compact('cart', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $cart = session()->get('cart', []);
        $image = $product->image ? asset('storage/' . $product->image->path) : asset('images/no-image.png');
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += (int)$request->quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => (int)$request->quantity,
                'image' => $image
            ];
        }
        session()->put('cart', $cart);
        return response()->json(['message' => 'カートに追加しました', 'cart' => $cart]);
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = max(1, $request->quantity);
            session()->put('cart', $cart);
        }
        return response()->json(['message' => '数量を更新しました', 'cart' => $cart]);
    }

    public function remove(Request $request)
    {
        try {
            if (!$request->id) {
                return redirect()->route('cart.index')->withErrors(['error' => '商品IDが指定されていません。']);
            }
            $cart = session()->get('cart', []);
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart); 
                return redirect()->route('cart.index')->with('success', '商品を削除しました。');
            }
            return redirect()->route('cart.index')->withErrors(['error' => '指定された商品がカートにありません。']);
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->withErrors(['error' => 'エラーが発生しました。']);
        }
    }
    
    

    public function clear()
    {
        session()->forget('cart');
        return response()->json(['message' => 'カートを空にしました']);
    }
}

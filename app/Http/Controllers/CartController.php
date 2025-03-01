<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $shipping = 500;
        $tax = round($subtotal * 0.1);
        $total = $subtotal + $shipping + $tax;

        return view('cart.index', compact('cart', 'subtotal', 'shipping', 'tax', 'total'));
    }


    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        if (!$productId) {
            return response()->json(['error' => '商品IDがありません'], 400);
        }

        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => '商品が見つかりません'], 404);
        }

        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->input('quantity', 1);
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->input('quantity', 1),
                'image' => $product->getFirstImageUrlAttribute(),
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['message' => '商品がカートに追加されました']);
    }
    public function getCartData()
    {
        $cart = session()->get('cart', []);

        return response()->json(['cart' => $cart]);
    }

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');

        if (!$productId) {
            return response()->json(['error' => '商品IDが指定されていません'], 400);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return response()->json(['message' => '商品を削除しました']);
    }

    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $newQuantity = (int) $request->input('quantity');

        if (!$productId || $newQuantity < 1) {
            return response()->json(['error' => '無効なデータです'], 400);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $newQuantity;
            session()->put('cart', $cart);
            return response()->json(['message' => '数量を更新しました', 'cart' => $cart]);
        } else {
            return response()->json(['error' => '商品がカートにありません'], 404);
        }
    }


    public function clear()
    {
        session()->forget('cart');
        return response()->json(['message' => 'カートを空にしました']);
    }
}

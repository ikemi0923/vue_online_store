<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->orderBy('created_at', 'desc')->get();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('images')->find($id);
    
        if (!$product) {
            abort(404, '商品が見つかりません');
        }
    
        return view('products.show', compact('product'));
    }
    
    
}

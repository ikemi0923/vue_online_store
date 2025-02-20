<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['images' => function ($query) {
            $query->orderBy('order')->limit(1);
        }])->orderBy('created_at', 'desc')->get();
    
        return view('home', compact('products'));
    }
    
}

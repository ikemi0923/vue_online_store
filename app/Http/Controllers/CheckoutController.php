<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'カートが空です');
        }
        return view('order.checkout', compact('cart'));
    }

    public function confirm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kana' => 'required|string|max:255',
            'zip1' => 'required|digits:3',
            'zip2' => 'required|digits:4',
            'address_prefecture' => 'required|string',
            'address_city' => 'required|string',
            'phone1' => 'required|digits:3',
            'phone2' => 'required|digits:4',
            'phone3' => 'required|digits:4',
            'payment_option' => 'required|string|in:credit,bank,cash',
        ]);
        try {
            DB::beginTransaction();
            $order = new Order();
            $order->user_id = null;
            $order->name = $validatedData['name'];
            $order->furigana = $validatedData['kana'];
            $order->zip = $validatedData['zip1'] . '-' . $validatedData['zip2'];
            $order->address = $validatedData['address_prefecture'] . $validatedData['address_city'];
            $order->phone = $validatedData['phone1'] . '-' . $validatedData['phone2'] . '-' . $validatedData['phone3'];
            $order->payment_method = $validatedData['payment_option'];
            $order->total_price = 1000;
            $order->status = 'pending';
            $order->save();
            DB::commit();
            return response()->json(['success' => true, 'message' => '注文完了']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => '注文処理に失敗しました。']);
        }
    }

    public function complete()
    {
        return view('order.complete');
    }
}

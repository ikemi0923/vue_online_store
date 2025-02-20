<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

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
        try {   
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'kana' => 'required|string|max:255|regex:/^[ァ-ヶー]+$/u',
                'zip1' => 'required|digits:3',
                'zip2' => 'required|digits:4',
                'address_prefecture' => 'required|string',
                'address_city' => 'required|string',
                'phone1' => 'required|digits:3',
                'phone2' => 'required|digits:4',
                'phone3' => 'required|digits:4',
                'payment_option' => 'required|string|in:credit,bank,cash',
            ]);
    
            if ($validatedData['payment_option'] === 'credit') {
                $request->validate([
                    'cardholder_name' => 'required|string|min:2|max:30|regex:/^[A-Z\s]+$/',
                    'card_number' => 'required|digits_between:13,16',
                    'expiration_month' => 'required|digits:2|between:1,12',
                    'expiration_year' => 'required|digits:2',
                    'security_code' => 'required|digits_between:3,4',
                ]);
            }
    
            DB::beginTransaction();
    
            $order = new Order();
            $order->name = $validatedData['name'];
            $order->furigana = $validatedData['kana'];
            $order->zip = $validatedData['zip1'] . '-' . $validatedData['zip2'];
            $order->address = $validatedData['address_prefecture'] . $validatedData['address_city'];
            $order->phone = $validatedData['phone1'] . '-' . $validatedData['phone2'] . '-' . $validatedData['phone3'];
            $order->payment_method = $validatedData['payment_option'];
            $order->total_price = 1000;
            $order->status = 'pending';
            $order->save();
    
            $cart = session()->get('cart', []);

            if (empty($cart)) {
                return response()->json(['success' => false, 'message' => 'カートが空です。']);
            }
    
            foreach ($cart as $productId => $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $cartItem['quantity'],
                    'price' => $cartItem['price'],
                ]);
            }
    
            session()->forget('cart');
    
            DB::commit();
    
            return response()->json(['success' => true, 'message' => '注文完了']);
    
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json(['success' => false, 'message' => '注文処理に失敗しました。', 'error' => $e->getMessage()]);
        }
    }

    public function complete()
    {
        return view('order.complete');
    }

}

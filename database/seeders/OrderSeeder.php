<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function index(Request $request)
{

    $query = Order::query();
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('id', $search)
              ->orWhereHas('user', function ($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              });
    }

    $orders = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.orders.index', compact('orders'));
}
    public function run(): void
    {
        $users = DB::table('users')->pluck('id')->toArray();

        if (count($users) < 10) {
            $users = array_merge($users, range(count($users) + 1, 10));
        }

        $orders = [];

        for ($i = 0; $i < 10; $i++) {
            $orders[] = [
                'user_id' => $users[$i],
                'name' => "注文者 " . ($i + 1),
                'furigana' => "ちゅうもんしゃ " . ($i + 1),
                'zip' => "200000" . $i,
                'address' => "東京都区" . $i,
                'phone' => "0801234567" . $i,
                'payment_method' => ($i % 2 == 0) ? 'クレジットカード' : '銀行振込',
                'status' => ($i % 3 == 0) ? 'completed' : 'pending',
                'total_price' => rand(1000, 10000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('orders')->insert($orders);
    }
}

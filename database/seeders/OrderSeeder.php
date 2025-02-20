<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')->pluck('id')->toArray();

        if (empty($users)) {
            return;
        }

        $orders = [];

        for ($i = 0; $i < 10; $i++) {
            $orders[] = [
                'user_id' => $users[array_rand($users)],
                'name' => "注文者 " . ($i + 1),
                'furigana' => "チュウモンシャ " . ($i + 1),
                'zip' => "200-" . str_pad($i, 3, '0', STR_PAD_LEFT), 
                'address' => "東京都区" . ($i + 1),
                'phone' => "080-1234-567" . $i,
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

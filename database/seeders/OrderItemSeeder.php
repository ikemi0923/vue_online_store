<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderItemSeeder extends Seeder
{
    public function run()
    {
        DB::table('order_items')->insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'quantity' => 2,
                'price' => 500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'order_id' => 1,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'order_id' => 2,
                'product_id' => 3,
                'quantity' => 3,
                'price' => 800,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

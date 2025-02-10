<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    public function run()
    {
        DB::table('order_details')->insert([
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 2, 'price' => 2000],
            ['order_id' => 1, 'product_id' => 2, 'quantity' => 1, 'price' => 1500],
            ['order_id' => 2, 'product_id' => 3, 'quantity' => 1, 'price' => 2000],
        ]);
    }
}

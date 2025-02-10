<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            ['name' => 'Product A', 'price' => 1000, 'stock' => 50, 'description' => 'Description for Product A'],
            ['name' => 'Product B', 'price' => 1500, 'stock' => 30, 'description' => 'Description for Product B'],
            ['name' => 'Product C', 'price' => 2000, 'stock' => 20, 'description' => 'Description for Product C'],
        ]);
    }
}

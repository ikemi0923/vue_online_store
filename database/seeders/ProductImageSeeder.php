<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductImageSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_images')->insert([
            ['product_id' => 1, 'path' => 'products/image1.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['product_id' => 2, 'path' => 'products/image2.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['product_id' => 3, 'path' => 'products/image3.jpg', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}

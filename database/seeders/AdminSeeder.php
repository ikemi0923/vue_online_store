<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            ['name' => 'Admin 1', 'email' => 'admin1@example.com', 'password' => bcrypt('password123')],
            ['name' => 'Admin 2', 'email' => 'admin2@example.com', 'password' => bcrypt('password123')],
            ['name' => 'Admin 0', 'email' => 'admin@codelab-vuetech.net', 'password' => bcrypt('admin1234')],
        ]);
    }
}

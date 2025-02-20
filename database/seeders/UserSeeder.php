<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [];

        for ($i = 1; $i <= 10; $i++) {
            $users[] = [
                'id' => $i,
                'name' => "User {$i}",
                'furigana' => "ユーザー{$i}",
                'zip' => "100000{$i}",
                'address' => "東京都区{$i}",
                'phone' => "0901234567{$i}",
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('users')->insert($users);
    }
}

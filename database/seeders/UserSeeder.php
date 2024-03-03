<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_name' => 'takw',
            'full_name' => 'Takwa Al Nassouh',
            'email' => 'takwasyr81@gmail.com',
            'password' => Hash::make('password'), 
            'account_type' => 'Individual',
            'is_verify' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

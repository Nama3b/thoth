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
            'id' => 1,
            'user_name' => 'namaeb',
            'name' => 'Le Thanh Long',
            'email' => 'leethanhlong7890@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}

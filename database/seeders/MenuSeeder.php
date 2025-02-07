<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'id' => 1,
                'name' => 'Work',
                'documents' => '{"Laravel":1, "Github":2, "VueJs":3}'
            ]
        ]);
    }
}

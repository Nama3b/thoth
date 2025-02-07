<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('folders')->insert([
            [
                'id' => 1,
                'name' => 'Work',
                'user_id' => 1,
                'parent_folder_id' => null
            ]
        ]);
    }
}

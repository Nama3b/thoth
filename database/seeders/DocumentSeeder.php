<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('documents')->insert([
            [
                'id' => 1,
                'title' => 'Laravel documents',
                'content' => 'Data test',
                'user_id' => 1,
                'folder_id' => 1
            ],
            [
                'id' => 2,
                'title' => 'Github',
                'content' => 'Data test',
                'user_id' => 1,
                'folder_id' => 1
            ],
            [
                'id' => 3,
                'title' => 'VueJs',
                'content' => 'Data test',
                'user_id' => 1,
                'folder_id' => 1
            ],
        ]);
    }
}

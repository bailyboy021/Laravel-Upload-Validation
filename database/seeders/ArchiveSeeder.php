<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArchiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert archives
        $archives = [
            [
                'file_name' => 'coral.jpg', 
                'remark' => 'Coral The Cat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'file_name' => 'doflamingo.docx', 
                'remark' => 'Doflamingo quotes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'file_name' => 'Welcome.xlsx', 
                'remark' => 'Excel welcome',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('archives')->insert($archives);
    }
}

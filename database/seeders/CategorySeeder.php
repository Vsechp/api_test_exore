<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'First category'],
            ['name' => 'Second category'],
            ['name' => 'Third category'],
            ['name' => 'Fourth category'],
            ['name' => 'Fifth category'],
            ['name' => 'Sixth category'],
        ]);
    }
}

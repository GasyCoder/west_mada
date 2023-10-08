<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryStockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('category_stocks')->insert([
            ['name' => 'Entrées'],
            ['name' => 'Plats principaux'],
            ['name' => 'Desserts'],
        ]);
    }
}

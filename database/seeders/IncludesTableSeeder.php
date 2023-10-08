<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IncludesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('includeds')->insert([
            ['name' => 'Piscine', 'is_active' => true],
            ['name' => 'Coca', 'is_active' => true]
        ]);
    }
}

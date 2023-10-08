<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('room_types')->insert([
            ['name' => 'Double', 'is_active' => true],
            ['name' => 'Familliale', 'is_active' => true]
        ]);
    }
}

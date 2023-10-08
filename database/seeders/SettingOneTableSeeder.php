<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingOneTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('setting_ones')->insert([
            [
                'app_name' => 'Application WestMada',
                'logo' => 'default.jpg'
            ]
        ]);
    }
}

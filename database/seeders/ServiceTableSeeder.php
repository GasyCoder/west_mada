<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('services')->insert([
            [
                'title' => 'Service 1',
                'desc' => 'Description du service 1'
            ]
        ]);
    }
}
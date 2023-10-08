<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StocksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('stocks')->insert([
            [
                'reference' => 2456,
                'name' => 'Caesar Salad',
                'category_id' => 1,
                'service_id' => 1,
                'stock_quantity' => 50,
                'price_u' => 500,
                'min_quantity' => 0,
                'unite_stock' => 'kg',
                'description' => 'loremipsum',
                'is_active' => true,
                'uuid' => 'fed-23-fd2-fdfds-'
            ]
        ]);
    }
}
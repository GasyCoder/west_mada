<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RoomTypeTableSeeder::class);
        $this->call(IncludesTableSeeder::class);
        $this->call(HotelTableSeeder::class);
        $this->call(CategoryStockTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(StocksTableSeeder::class);

       
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

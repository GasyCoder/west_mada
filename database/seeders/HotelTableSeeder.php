<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Included;
use App\Models\RoomType;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelTableSeeder extends Seeder
{
    public function run()
    {
        // Seed hotel data
        $hotelsData = [
            [
                'room_number' => 101,   
                'room_type_id' => 1,
                'bed_capacity' => 2,
                'tarif' => 150000,
                'include' => 'Piscine',
                'description' => 'loremipsum',
                'is_active' => true,
            ],
            [
                'room_number' => 201,
                'room_type_id' => 2,
                'bed_capacity' => 3,
                'tarif' => 200000,
                'include' => 'Jus',
                'description' => 'loremipsum',
                'is_active' => true,
            ],
            // Add more hotel records as needed
        ];

        foreach ($hotelsData as $hotelData) {
            $roomType = RoomType::find($hotelData['room_type_id']);
            $included = Included::find($hotelData['include']);

            if ($roomType && $included) {
                Hotel::create($hotelData);
            }
        }
    }
}

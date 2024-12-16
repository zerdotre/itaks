<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZipcoderangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Place::factory()->create(['id' => 140,'name' => '1361', 'type' => 'zipcoderange', 'zipcoderange_to'=>'1364']);
        \App\Models\Place::factory()->create(['id' => 141,'name' => '1309', 'type' => 'zipcoderange', 'zipcoderange_to'=>'1329']);
        \App\Models\Place::factory()->create(['id' => 142,'name' => '1351', 'type' => 'zipcoderange', 'zipcoderange_to'=>'1359']);
        \App\Models\Place::factory()->create(['id' => 143,'name' => '1341', 'type' => 'zipcoderange', 'zipcoderange_to'=>'1349']);
        \App\Models\Place::factory()->create(['id' => 144,'name' => '1331', 'type' => 'zipcoderange', 'zipcoderange_to'=>'1339']);

        DB::table('place_vehicle')->insert([
            ['place_id' => 140, 'vehicle_id' => 1, 'price' => 6500],
            ['place_id' => 141, 'vehicle_id' => 1, 'price' => 7000],
            ['place_id' => 142, 'vehicle_id' => 1, 'price' => 7000],
            ['place_id' => 143, 'vehicle_id' => 1, 'price' => 7500],
            ['place_id' => 144, 'vehicle_id' => 1, 'price' => 7500],

            ['place_id' => 140, 'vehicle_id' => 2, 'price' => 8500],
            ['place_id' => 141, 'vehicle_id' => 2, 'price' => 9000],
            ['place_id' => 142, 'vehicle_id' => 2, 'price' => 9000],
            ['place_id' => 143, 'vehicle_id' => 2, 'price' => 9500],
            ['place_id' => 144, 'vehicle_id' => 2, 'price' => 9500],
        ]);
    }
}

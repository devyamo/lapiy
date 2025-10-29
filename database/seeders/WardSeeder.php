<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wards = [
            ['lga_id' => 1, 'name' => 'Rigasa', 'code' => 'RGS'],
            ['lga_id' => 1, 'name' => 'Turunku', 'code' => 'TRK'],
            ['lga_id' => 1, 'name' => 'Rigachikun', 'code' => 'RGC'],
            
            ['lga_id' => 2, 'name' => 'Unguwar Sarki', 'code' => 'UGS'],
            ['lga_id' => 2, 'name' => 'Kawo', 'code' => 'KAW'],
            ['lga_id' => 2, 'name' => 'Badiko', 'code' => 'BDK'],
            
            ['lga_id' => 3, 'name' => 'Barnawa', 'code' => 'BNW'],
            ['lga_id' => 3, 'name' => 'Kakuri', 'code' => 'KKR'],
            ['lga_id' => 3, 'name' => 'Makera', 'code' => 'MKR'],
            
            ['lga_id' => 4, 'name' => 'Tudun Wada', 'code' => 'TWD'],
            ['lga_id' => 4, 'name' => 'Gyallesu', 'code' => 'GYL'],
            ['lga_id' => 4, 'name' => 'Tukur Tukur', 'code' => 'TTK'],
        ];

        foreach ($wards as $ward) {
            \App\Models\Ward::create($ward);
        }
    }
}

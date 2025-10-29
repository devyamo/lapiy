<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phcs = [
            ['clinic_name' => 'Rigasa Primary Health Center', 'lga_id' => 1, 'ward_id' => 1],
            ['clinic_name' => 'Turunku Health Clinic', 'lga_id' => 1, 'ward_id' => 2],
            ['clinic_name' => 'Kawo PHC', 'lga_id' => 2, 'ward_id' => 5],
            ['clinic_name' => 'Barnawa Mother & Child Center', 'lga_id' => 3, 'ward_id' => 7],
        ];

        foreach ($phcs as $phc) {
            \App\Models\Phc::create($phc);
        }
    }
}

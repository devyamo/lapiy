<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LgaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lgas = [
            ['name' => 'Igabi', 'code' => 'IGA'],
            ['name' => 'Kaduna North', 'code' => 'KDN'],
            ['name' => 'Kaduna South', 'code' => 'KDS'],
            ['name' => 'Zaria', 'code' => 'ZAR'],
            ['name' => 'Sabon Gari', 'code' => 'SBG'],
            ['name' => 'Chikun', 'code' => 'CHK'],
            ['name' => 'Kachia', 'code' => 'KCH'],
            ['name' => 'Kubau', 'code' => 'KUB'],
        ];

        foreach ($lgas as $lga) {
            \App\Models\Lga::create($lga);
        }
    }
}

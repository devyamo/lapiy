<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'System Administrator',
            'email' => 'admin@lafiyariyali.ng',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'role' => 'admin',
            'phc_id' => null,
            'email_verified_at' => now(),
        ]);

        \App\Models\User::create([
            'name' => 'Rigasa PHC Staff',
            'email' => 'rigasa@lafiyariyali.ng',
            'password' => \Illuminate\Support\Facades\Hash::make('staff123'),
            'role' => 'phc_staff',
            'phc_id' => 1,
            'email_verified_at' => now(),
        ]);

        \App\Models\User::create([
            'name' => 'Kawo PHC Staff',
            'email' => 'kawo@lafiyariyali.ng',
            'password' => \Illuminate\Support\Facades\Hash::make('staff123'),
            'role' => 'phc_staff',
            'phc_id' => 3,
            'email_verified_at' => now(),
        ]);
    }
}

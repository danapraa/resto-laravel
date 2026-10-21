<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Lim Kok Tong',
            'email' => 'admin@limkoktong.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Customer Demo',
            'email' => 'customer@limkoktong.test',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        $others = [
            ['Budi Santoso', 'budi@example.test'],
            ['Siti Rahayu', 'siti@example.test'],
            ['Agus Wijaya', 'agus@example.test'],
            ['Dewi Lestari', 'dewi@example.test'],
            ['Rizky Pratama', 'rizky@example.test'],
        ];

        foreach ($others as [$name, $email]) {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]);
        }
    }
}

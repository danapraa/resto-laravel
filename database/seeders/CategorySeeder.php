<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['Makanan Utama', 'makanan-utama', 'Hidangan utama khas Tionghoa untuk disantap bersama keluarga.'],
            ['Nasi & Mie', 'nasi-mie', 'Nasi goreng, mie, dan kwetiau dengan bumbu rumahan.'],
            ['Dimsum & Pembuka', 'dimsum-pembuka', 'Camilan hangat dan hidangan pembuka.'],
            ['Minuman', 'minuman', 'Teh, kopi, dan minuman segar.'],
            ['Dessert', 'dessert', 'Penutup manis untuk menyempurnakan santapan.'],
        ];

        foreach ($categories as [$name, $slug, $description]) {
            Category::create([
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
            ]);
        }
    }
}

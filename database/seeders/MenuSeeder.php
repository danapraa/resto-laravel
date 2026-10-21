<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            // [kategori slug, nama, deskripsi, harga, status]
            ['makanan-utama', 'Bebek Peking Panggang', 'Bebek panggang berkulit renyah disajikan dengan pancake, timun, dan saus hoisin.', 185000, 'available'],
            ['makanan-utama', 'Ayam Kung Pao', 'Potongan ayam tumis dengan kacang mete, cabai kering, dan saus khas.', 55000, 'available'],
            ['makanan-utama', 'Sapo Tahu Seafood', 'Tahu lembut dengan udang, cumi, dan sayuran dalam kuah kental gurih.', 65000, 'available'],
            ['makanan-utama', 'Ikan Kakap Saus Asam Manis', 'Ikan kakap goreng garing disiram saus asam manis nanas dan paprika.', 95000, 'available'],

            ['nasi-mie', 'Nasi Goreng Lim Kok Tong', 'Nasi goreng spesial dengan udang, ayam, telur, dan acar.', 42000, 'available'],
            ['nasi-mie', 'Mie Hokkien Seafood', 'Mie tebal tumis dengan udang, cumi, dan sayuran segar.', 48000, 'available'],
            ['nasi-mie', 'Kwetiau Siram Sapi', 'Kwetiau goreng disiram saus kental dengan irisan daging sapi empuk.', 46000, 'available'],

            ['dimsum-pembuka', 'Siomay Udang', 'Siomay kukus isi udang dan ayam, disajikan dengan saus cabai.', 32000, 'available'],
            ['dimsum-pembuka', 'Hakau Udang Bening', 'Dimsum kulit bening isi udang segar, dikukus hangat.', 34000, 'available'],
            ['dimsum-pembuka', 'Lumpia Goreng Rebung', 'Lumpia renyah isi rebung dan ayam cincang.', 28000, 'unavailable'],

            ['minuman', 'Teh Tarik Jahe', 'Teh susu hangat dengan aroma jahe segar.', 18000, 'available'],
            ['minuman', 'Es Lemon Tea', 'Teh dingin segar dengan perasan lemon.', 16000, 'available'],
            ['minuman', 'Kopi Susu Gula Aren', 'Kopi susu dengan manis alami gula aren.', 22000, 'available'],

            ['dessert', 'Bubur Kacang Hijau Hangat', 'Bubur kacang hijau lembut dengan santan.', 20000, 'available'],
            ['dessert', 'Pisang Goreng Madu', 'Pisang goreng renyah disiram madu dan taburan wijen.', 24000, 'available'],
            ['dessert', 'Es Cendol Durian', 'Cendol dengan santan, gula merah, dan durian.', 30000, 'unavailable'],
        ];

        foreach ($menus as [$categorySlug, $name, $description, $price, $status]) {
            $category = Category::where('slug', $categorySlug)->firstOrFail();

            Menu::create([
                'category_id' => $category->id,
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $description,
                'price' => $price,
                'status' => $status,
            ]);
        }
    }
}

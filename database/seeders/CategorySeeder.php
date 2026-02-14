<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'categoryName' => 'Teknologi & Digital', 
                'description' => 'Gadget, Software, Programming, AI, dan Tren Digital.'
            ],
            [
                'categoryName' => 'Politik & Hukum', 
                'description' => 'Pemerintahan, Kebijakan Publik, Isu Internasional, dan Hukum.'
            ],
            [
                'categoryName' => 'Ekonomi & Bisnis', 
                'description' => 'Keuangan, Investasi, Startup, dan Entrepreneurship.'
            ],
            [
                'categoryName' => 'Edukasi & Sains', 
                'description' => 'Tips Belajar, Pengembangan Diri, Karir, dan Ilmu Pengetahuan.'
            ],
            [
                'categoryName' => 'Gaya Hidup & Kesehatan', 
                'description' => 'Travel, Kuliner, Kesehatan, dan Hobi.'
            ],
            [
                'categoryName' => 'Seni & Budaya', 
                'description' => 'Desain, Fotografi, Film, Sastra, dan Isu Sosial.'
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['categoryName' => $category['categoryName']], // Cek jika nama sudah ada
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
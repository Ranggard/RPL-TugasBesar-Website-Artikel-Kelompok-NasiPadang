<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // Menggunakan locale Indonesia
        $faker = Faker::create('id_ID');
        
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->error('Kategori kosong! Jalankan CategorySeeder terlebih dahulu.');
            return;
        }

        foreach ($categories as $category) {
            
            // --- ARTIKEL 1 (Penulis Baru / Rekomendasi) ---
            $author1 = User::create([
                'username' => $faker->unique()->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'role' => 'penulis',
                'isNewAuthor' => true
            ]);

            $title1 = $this->generateIndoTitle($category->categoryName, $faker);
            
            $art1 = Article::create([
                'authorId'    => $author1->userid, 
                'title'       => $title1,
                'content'     => $this->generateFakeContent($title1, $faker),
                'isPublished' => true,
                'isDraft'     => false, 
                'viewCount'   => rand(100, 500),
                'publishedAt' => now(),
            ]);
            $art1->categories()->attach($category->categoryId);

            // --- ARTIKEL 2 (Penulis Lama / Semua Artikel) ---
            $author2 = User::create([
                'username' => $faker->unique()->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'role' => 'penulis',
                'isNewAuthor' => false
            ]);

            $title2 = "Pentingnya Mengetahui " . $category->categoryName . " di Era Modern";

            $art2 = Article::create([
                'authorId'    => $author2->userid, 
                'title'       => $title2,
                'content'     => $this->generateFakeContent($title2, $faker),
                'isPublished' => true,
                'isDraft'     => false,
                'viewCount'   => rand(50, 200),
                'publishedAt' => now()->subDays(2),
            ]);
            $art2->categories()->attach($category->categoryId);
        }
    }

    /**
     * Membuat judul Bahasa Indonesia yang relevan dengan kategori
     */
    private function generateIndoTitle($categoryName, $faker)
    {
        $templates = [
            "Cara Mudah Menguasai $categoryName dalam 7 Hari",
            "Panduan Lengkap Belajar $categoryName untuk Pemula",
            "10 Tips Rahasia Sukses di Bidang $categoryName",
            "Masa Depan $categoryName di Indonesia: Apa yang Perlu Diketahui?",
            "Mengapa $categoryName Sangat Penting Bagi Generasi Muda",
            "Tren Terbaru $categoryName Tahun 2026",
            "Analisis Mendalam Mengenai Dampak $categoryName",
        ];

        return $templates[array_rand($templates)];
    }

    /**
     * Membuat isi konten yang lebih rapi dalam format HTML
     */
    private function generateFakeContent($title, $faker)
    {
        return "<div>
            <p><strong>" . $title . "</strong> adalah topik yang sangat menarik untuk dibahas saat ini.</p>
            <p>" . implode('</p><p>', $faker->paragraphs(4)) . "</p>
            <p>Kesimpulannya, memahami materi ini akan memberikan dampak positif bagi perkembangan kita ke depannya.</p>
        </div>";
    }
}
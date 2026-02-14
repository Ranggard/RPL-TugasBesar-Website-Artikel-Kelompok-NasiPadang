<?php

namespace Database\Seeders; // PASTIKAN ADA BARIS INI

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ArticleSeeder::class
        ]);
    }
}
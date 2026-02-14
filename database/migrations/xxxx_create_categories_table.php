<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            // Kita gunakan 'categoryId' sebagai Primary Key sesuai keinginan Anda
            $table->id('categoryId'); 
            // Tambahkan categoryName agar sesuai dengan pemanggilan di Controller/View
            $table->string('categoryName'); 
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('article_category', function (Blueprint $table) {
            $table->id();
            // Pastikan foreignId merujuk ke nama Primary Key yang benar
            $table->foreignId('articleId')->constrained('articles', 'articleId')->onDelete('cascade');
            $table->foreignId('categoryId')->constrained('categories', 'categoryId')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_category');
        Schema::dropIfExists('categories');
    }
};
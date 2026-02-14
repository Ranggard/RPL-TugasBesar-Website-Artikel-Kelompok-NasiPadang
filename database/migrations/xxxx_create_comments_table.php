<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('commentId');
            
            // Relasi ke Artikel
            $table->foreignId('articleId')->constrained('articles', 'articleId')->onDelete('cascade');
            
            // Relasi ke User
            $table->foreignId('userId')->constrained('users', 'userid')->onDelete('cascade');

            /** * TAMBAHKAN INI: Relasi ke tabel ini sendiri (Self-Referencing)
             * nullable() karena komentar utama tidak memiliki parent.
             * references('commentId')->on('comments') mengacu pada ID di tabel ini juga.
             */
            $table->foreignId('parent_id')->nullable()->constrained('comments', 'commentId')->onDelete('cascade');
            
            $table->text('content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
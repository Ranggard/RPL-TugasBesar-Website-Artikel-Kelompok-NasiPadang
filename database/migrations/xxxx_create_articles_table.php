<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id('articleId'); // Primary Key
            
            // PERBAIKAN: Sesuaikan dengan primary key tabel users Anda (userid)
            $table->foreignId('authorId')->constrained('users', 'userid')->onDelete('cascade'); 
            
            $table->string('title');
            $table->text('content');
            $table->boolean('isPublished')->default(false);
            $table->boolean('isDraft')->default(true);
            $table->integer('viewCount')->default(0);
            $table->timestamp('publishedAt')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
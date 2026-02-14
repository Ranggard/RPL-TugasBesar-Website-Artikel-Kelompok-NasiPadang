<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id('likeId');
            
            // PERBAIKAN: Sebutkan 'articleId' sebagai primary key target
            $table->foreignId('articleId')->constrained('articles', 'articleId')->onDelete('cascade');
            
            // PERBAIKAN: Sebutkan 'userid' sebagai primary key target
            $table->foreignId('userId')->constrained('users', 'userid')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
};
// database/migrations/xxxx_create_users_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('userid');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['penulis', 'pembaca'])->default('pembaca');
            $table->boolean('isNewAuthor')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'userid'; // Sudah benar
    
    // TAMBAHKAN INI agar Laravel tahu userid adalah angka yang bertambah otomatis
    public $incrementing = true; 
    protected $keyType = 'int';

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'isNewAuthor',
        'google_id'
    ];

    protected $hidden = [
        'password',
        'remember_token', // Tambahkan ini jika di migrasi ada rememberToken()
    ];

    protected $casts = [
        'isNewAuthor' => 'boolean', // Pastikan di-cast ke boolean agar logic isNewAuthor() tepat
    ];

    // Relasi ke artikel (authorId di tabel articles merujuk ke userid di tabel users)
    public function articles()
    {
        return $this->hasMany(Article::class, 'authorId', 'userid');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'userId', 'userid');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'userId', 'userid');
    }

    // Method helper
    public function promoteToExperiencedAuthor()
    {
        $this->update(['isNewAuthor' => false]);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $primaryKey = 'articleId';
    protected $fillable = [
        'authorId',
        'title',
        'content',
        'isPublished',
        'isDraft',
        'viewCount',
        'publishedAt'
    ];

    protected $casts = [
        'publishedAt' => 'datetime',
        'isPublished' => 'boolean',
        'isDraft' => 'boolean'
    ];

    // Relationship dengan author
    public function author()
    {
        // Relasi ke User (Penulis)
        return $this->belongsTo(User::class, 'authorId', 'userid');
    }

    // Relationship dengan kategori
    public function categories()
    {
        // many-to-many relasi
        return $this->belongsToMany(Category::class, 'article_category', 'articleId', 'categoryId');
    }

    // Relationship dengan komentar
    public function comments()
{
    // Pastikan foreign key-nya 'articleId' sesuai database kamu
    return $this->hasMany(Comment::class, 'articleId')->orderBy('created_at', 'desc');
}

    // Relationship dengan likes
    public function likes()
    {
        // Hubungkan dengan model Like menggunakan foreign key articleId
        return $this->hasMany(Like::class, 'articleId');
    }
    // Method untuk menampilkan artikel
    public function display()
    {
        $this->incrementView();
        return $this;
    }

    // Method untuk menambah view count
    public function incrementView()
    {
        $this->viewCount++;
        $this->save();
    }

    // Method untuk publish artikel
    public function publish()
    {
        $this->isPublished = true;
        $this->isDraft = false;
        $this->publishedAt = now();
        $this->save();
    }

    // Method untuk save sebagai draft
    public function saveAsDraft()
    {
        $this->isPublished = false;
        $this->isDraft = true;
        $this->save();
    }
}
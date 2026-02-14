<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'commentId';
    protected $fillable = ['articleId', 'userId', 'parent_id', 'content'];

    // Relationship dengan user
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'userid');
    }

    // Relationship dengan artikel
    public function article()
    {
        return $this->belongsTo(Article::class, 'articleId');
    }

    // Method untuk menambah komentar
    public static function addComment($content, $userId, $articleId)
    {
        return self::create([
            'content' => $content,
            'userId' => $userId,
            'articleId' => $articleId
        ]);
    }

    // Relasi untuk mengambil semua balasan dari sebuah komentar
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'commentId')->orderBy('created_at', 'asc');
    }

    // Relasi balik (opsional, untuk tahu ini membalas siapa)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'commentId');
}
}
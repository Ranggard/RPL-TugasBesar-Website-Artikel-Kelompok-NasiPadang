<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // WAJIB: Beritahu nama primary key yang benar
    protected $primaryKey = 'likeId';

    protected $fillable = ['userId', 'articleId'];

    // Jika kamu menggunakan timestamps (created_at, updated_at)
    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class, 'userId', 'userid');
    }

    public function article() {
        return $this->belongsTo(Article::class, 'articleId', 'articleId');
    }
}
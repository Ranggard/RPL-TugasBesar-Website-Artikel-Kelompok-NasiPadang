<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'categoryId'; // Wajib karena bukan 'id'
    protected $fillable = ['categoryName', 'description'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_category', 'categoryId', 'articleId');
    }
}
<?php

// app/Http/Controllers/LikeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store($articleId)
    {
        $userId = Auth::id();

        // 1. Cek berapa kali user ini sudah like ARTIKEL INI
        $userLikesInThisArticle = Like::where('userId', $userId)
                                      ->where('articleId', $articleId)
                                      ->count();

        // 2. Batasi maksimal 30 like per artikel per akun
        if ($userLikesInThisArticle >= 30) {
            return back()->with('error', 'Maksimal 30 like untuk artikel ini!');
        }

        // 3. Simpan Like baru
        Like::create([
            'userId' => $userId,
            'articleId' => $articleId
        ]);

        return back()->with('success', 'Like berhasil ditambahkan!');
    }
}
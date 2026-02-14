<?php

namespace App\Http\Controllers; // Pastikan namespace ini benar

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $articleId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,commentId' // Validasi agar parent_id benar-benar ada di tabel comments
        ]);

        Comment::create([
            'articleId' => $articleId,
            'userId'    => Auth::id(),
            'content'   => $request->content,
            'parent_id' => $request->parent_id // Tangkap ID komentar yang dibalas
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Keamanan: Cek apakah yang menghapus adalah benar pemilik komentar
        if ($comment->userId !== Auth::id()) {
            return back()->with('error', 'Anda tidak punya akses menghapus ini.');
        }

        $comment->delete();
        return back()->with('success', 'Komentar dihapus.');
    }
}
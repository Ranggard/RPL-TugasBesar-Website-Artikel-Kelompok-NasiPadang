<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // UC-04: Home
    public function home()
    {
        $recommendedArticles = $this->getRecommendedArticles();
        $categories = Category::all();
        return view('home', compact('recommendedArticles', 'categories'));
    }

    // UC-03: Daftar Artikel Publik (Search & Filter)
    public function index(Request $request)
    {
        $query = Article::where('isPublished', true)->with(['author', 'categories']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('content', 'like', "%$search%")
                  ->orWhereHas('categories', function($catQuery) use ($search) {
                      $catQuery->where('categoryName', 'like', "%$search%");
                  });
            });
        }

        if ($request->has('categories') && is_array($request->categories)) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->whereIn('categories.categoryId', $request->categories);
            });
        }

        $sort = $request->get('filter', 'terbaru');
        if ($sort == 'terlama') $query->orderBy('publishedAt', 'asc');
        elseif ($sort == 'populer') $query->orderBy('viewCount', 'desc');
        else $query->orderBy('publishedAt', 'desc');

        // Pagination Utama
        $articles = $query->paginate(6, ['*'], 'page')->withQueryString();
        
        // PENTING: Gunakan paginate() agar method appends() di View tidak error
        $newAuthorArticles = Article::where('isPublished', true)
            ->whereHas('author', fn($q) => $q->where('isNewAuthor', true))
            ->latest()
            ->paginate(3, ['*'], 'newAuthors'); 

        $allCategories = Category::all();

        return view('articles.index', compact('articles', 'allCategories', 'newAuthorArticles'));
    }

    // INI FUNGSI YANG TADI HILANG (Halaman Tulis Artikel)
    public function create()
    {
        if (Auth::user()->role !== 'penulis') {
            abort(403, 'Hanya penulis yang dapat mengakses halaman ini.');
        }
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    // Simpan Artikel Baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categoryId' => 'required|array', 
        ]);

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'authorId' => auth()->id(),
            'isPublished' => false,
            'isDraft' => true,
        ]);

        // Hubungkan ke tabel pivot agar kategori tidak "Umum"
        $article->categories()->attach($request->categoryId);

        return redirect()->route('articles.management')->with('success', 'Artikel berhasil disimpan ke draf!');
    }

    // Halaman Kelola Artikel (Penulis)
    public function management(Request $request)
    {
        $query = Article::where('authorId', auth()->id())->with('categories');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhereHas('categories', function($catQuery) use ($search) {
                      $catQuery->where('categoryName', 'like', "%$search%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('isPublished', $request->status == 'published');
        }

        $myArticles = $query->latest()->get(); 
        return view('articles.management', compact('myArticles'));
    }

    public function publish($id)
    {
        $article = Article::where('authorId', auth()->id())->findOrFail($id);
        $article->update([
            'isPublished' => true,
            'isDraft' => false,
            'publishedAt' => now()
        ]);
        return back()->with('success', 'Artikel telah berhasil diterbitkan!');
    }

    public function destroy($id)
    {
        $article = Article::where('authorId', auth()->id())->findOrFail($id);
        $article->categories()->detach(); // Hapus relasi pivot
        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus.');
    }

    public function show($id)
    {
        $article = Article::with(['author', 'categories', 'comments.user'])->findOrFail($id);
        $article->increment('viewCount');
        return view('articles.show', compact('article'));
    }

    private function getRecommendedArticles()
    {
        $newAuthorArticles = Article::whereHas('author', fn($q) => $q->where('isNewAuthor', true))
            ->where('isPublished', true)->latest()->limit(5)->get();

        if ($newAuthorArticles->count() < 5) {
            $popular = Article::where('isPublished', true)
                ->whereNotIn('articleId', $newAuthorArticles->pluck('articleId'))
                ->orderBy('viewCount', 'desc')->limit(5 - $newAuthorArticles->count())->get();
            return $newAuthorArticles->merge($popular);
        }
        return $newAuthorArticles;
    }
}
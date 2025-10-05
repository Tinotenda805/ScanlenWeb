<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of articles.
     */
    public function index(Request $request)
    {
        $query = Article::with(['authors', 'category', 'tags'])
            ->published()
            ->latest('published_at');

        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by tag
        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Paginate articles (9 per page)
        $articles = $query->paginate(9);

        // Get featured articles for the top section
        $featuredArticles = Article::with(['authors', 'category'])
            ->published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();

        // Get all categories with article count
        $categories = Category::withCount('articles')
            ->has('articles')
            ->orderBy('name')
            ->get();

        // Get popular tags
        $popularTags = Tag::withCount('articles')
            ->has('articles')
            ->orderBy('articles_count', 'desc')
            ->take(10)
            ->get();

        return view('articles.index', compact(
            'articles',
            'featuredArticles',
            'categories',
            'popularTags'
        ));
    }

    /**
     * Display a single article.
     */
    public function show($slug)
    {
        // Find article by slug
        $article = Article::with(['authors', 'category', 'tags'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Increment view count 
        $article->incrementViews();

        // Get related articles from same category
        $relatedArticles = Article::with(['authors', 'category'])
            ->published()
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}

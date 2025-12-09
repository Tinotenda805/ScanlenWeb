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
        $query = Article::with(['category', 'authors', 'tags'])
            ->where('is_published', true)
            ->where('published_at', '<=', now());

        // Filter by category slug from query string
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by tag
        if ($request->has('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $articles = $query->latest('published_at')->paginate(12);

        // Get featured articles (only for main page, not search/filter)
        $featuredArticles = collect();
        if (!$request->has('category') && !$request->has('tag') && !$request->has('search')) {
            $featuredArticles = Article::with(['category', 'authors'])
                ->where('is_published', true)
                ->where('is_featured', true)
                ->where('published_at', '<=', now())
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        // Categories with article counts
        $categories = Category::withCount(['articles' => function($query) {
                $query->where('is_published', true)
                      ->where('published_at', '<=', now());
            }])
            ->has('articles')
            ->orderBy('name')
            ->get();

        // Popular tags
        $popularTags = Tag::withCount(['articles' => function($query) {
                $query->where('is_published', true)
                      ->where('published_at', '<=', now());
            }])
            ->has('articles')
            ->orderBy('articles_count', 'desc')
            ->take(10)
            ->get();

        // Total articles count for "All" badge
        $totalArticlesCount = Article::where('is_published', true)
            ->where('published_at', '<=', now())
            ->count();

        return view('articles.index', compact(
            'articles', 
            'featuredArticles', 
            'categories', 
            'popularTags',
            'totalArticlesCount'
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


    public function category(Category $category)
    {
        $articles = $category->articles()
            ->with(['authors', 'tags', 'category'])
            ->where('is_published', true)
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(12);

        // Categories with article counts
        $categories = Category::withCount(['articles' => function($query) {
                $query->where('is_published', true)
                      ->where('published_at', '<=', now());
            }])
            ->has('articles')
            ->orderBy('name')
            ->get();

        // Related categories (exclude current)
        $relatedCategories = Category::where('id', '!=', $category->id)
            ->withCount(['articles' => function($query) {
                $query->where('is_published', true)
                      ->where('published_at', '<=', now());
            }])
            ->has('articles')
            ->orderBy('articles_count', 'desc')
            ->take(5)
            ->get();

        // Popular tags
        $popularTags = Tag::withCount(['articles' => function($query) {
                $query->where('is_published', true)
                      ->where('published_at', '<=', now());
            }])
            ->has('articles')
            ->orderBy('articles_count', 'desc')
            ->take(10)
            ->get();

        return view('articles.index', compact(
            'articles', 
            'category', 
            'categories', 
            'relatedCategories',
            'popularTags'
        ));
    }
}

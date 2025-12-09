<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class InsightsController extends Controller
{
     public function index()
    {
        $articles = Article::published()
            ->with(['category', 'authors', 'tags'])
            ->latest('published_at')
            ->paginate(12);

        $categories = Category::withCount(['articles' => function($query) {
                $query->published();
            }])
            ->has('articles')
            ->orderBy('name')
            ->get();

        return view('insights.index', compact('articles', 'categories'));
    }

    // Category-specific insights
    public function category(Category $category)
    {
        $articles = $category->articles()
            ->published()
            ->with(['authors', 'tags'])
            ->latest('published_at')
            ->paginate(12);

        $relatedCategories = Category::where('id', '!=', $category->id)
            ->withCount(['articles' => function($query) {
                $query->published();
            }])
            ->has('articles')
            ->take(4)
            ->get();

        return view('insights.category', compact('category', 'articles', 'relatedCategories'));
    }

    // Single article view
    public function show(Article $article)
    {
        // Load relationships
        $article->load(['category', 'authors', 'tags']);

        // Get related articles
        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->with(['category', 'authors'])
            ->latest('published_at')
            ->take(3)
            ->get();

        // Increment view count
        $article->increment('views');

        return view('insights.show', compact('article', 'relatedArticles'));
    }
}

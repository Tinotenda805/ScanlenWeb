<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Blog;
use App\Models\Category;
use App\Models\OurPeople;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_articles' => Article::count(),
            'published_articles' => Article::published()->count(),
            'total_blogs' => Blog::count(),
            'published_blogs' => Blog::published()->count(),
            'total_people' => OurPeople::count(),
            'partners' => OurPeople::where('type', 'partner')->count(),
            'associates' => OurPeople::where('type', 'associate')->count(),
            'total_categories' => Category::count(),
            'total_tags' => Tag::count(),
        ];

        // Recent articles
        $recentArticles = Article::with(['authors', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // Recent blogs
        $recentBlogs = Blog::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.index', compact('stats', 'recentArticles', 'recentBlogs'));
    }
}

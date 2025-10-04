<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     */
    public function index(Request $request)
    {
        $query = Blog::with(['category', 'tags'])
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

        // Paginate blogs (9 per page)
        $blogs = $query->paginate(9);

        // Get featured blogs for the top section
        $featuredBlogs = Blog::with('category')
            ->published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();

        // Get all categories with blog count
        $categories = Category::withCount('blogs')
            ->has('blogs')
            ->orderBy('name')
            ->get();

        // Get popular tags
        $popularTags = Tag::withCount('blogs')
            ->has('blogs')
            ->orderBy('blogs_count', 'desc')
            ->take(10)
            ->get();

        return view('blogs.index', compact(
            'blogs',
            'featuredBlogs',
            'categories',
            'popularTags'
        ));
    }

    /**
     * Display a single blog post.
     */
    public function show($slug)
    {
        // Find blog by slug
        $blog = Blog::with(['category', 'tags'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Increment view count
        $blog->incrementViews();

        // Get related blogs from same category
        $relatedBlogs = Blog::with('category')
            ->published()
            ->where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blogs.show', compact('blog', 'relatedBlogs'));
    }
}
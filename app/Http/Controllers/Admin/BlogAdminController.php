<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\OurPeople;
use App\Models\Tag;
use App\Services\SeoAnalyzer;
use App\Services\ReadabilityAnalyzer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogAdminController extends Controller
{

    public function index()
    {
        $blogs = Blog::with(['category', 'tags'])
            ->withCount('comments')
            ->latest()
            ->paginate(15);

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $people = OurPeople::orderBy('name')->get();

        return view('admin.blogs.create', compact('categories', 'tags', 'people'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'author_name' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|max:2048',
            'reading_time' => 'required|integer|min:1',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'comments_enabled' => 'boolean',
            'published_at' => 'nullable|date',
            'focus_keyword' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string|max:160',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Analyze SEO
        $seoAnalyzer = new SeoAnalyzer(
            $validated['title'],
            $validated['content'],
            $validated['meta_description'] ?? '',
            $validated['focus_keyword'] ?? '',
            $validated['slug'],
            $request->hasFile('featured_image'),
        );
        $seoResult = $seoAnalyzer->analyze();

        // Analyze Readability
        $readabilityAnalyzer = new ReadabilityAnalyzer($validated['content']);
        $readabilityResult = $readabilityAnalyzer->analyze();

        $validated['seo_score'] = $seoResult['score'];
        $validated['readability_score'] = $readabilityResult['score'];

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        $blog = Blog::create($validated);

        // Attach tags
        if (!empty($validated['tags'])) {
            $blog->tags()->attach($validated['tags']);
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully!');
    }

    public function edit(Blog $blog)
    {
        $blog->load('tags');
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.blogs.edit', compact('blog', 'categories', 'tags'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'author_name' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|max:2048',
            'reading_time' => 'required|integer|min:1',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'comments_enabled' => 'boolean',
            'published_at' => 'nullable|date',
            'focus_keyword' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string|max:160',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Analyze SEO
        $seoAnalyzer = new SeoAnalyzer(
            $validated['title'],
            $validated['content'],
            $validated['meta_description'] ?? '',
            $validated['focus_keyword'] ?? '',
            $validated['slug'],
            $request->hasFile('featured_image') || $blog->featured_image
        );
        $seoResult = $seoAnalyzer->analyze();

        // Analyze Readability
        $readabilityAnalyzer = new ReadabilityAnalyzer($validated['content']);
        $readabilityResult = $readabilityAnalyzer->analyze();

        $validated['seo_score'] = $seoResult['score'];
        $validated['readability_score'] = $readabilityResult['score'];

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        $blog->update($validated);

        // Sync tags
        $blog->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        // Delete image if exists
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }

    public function toggleFeatured(Blog $blog)
    {
        $blog->update(['is_featured' => !$blog->is_featured]);

        return back()->with('success', 'Featured status updated!');
    }

    public function togglePublished(Blog $blog)
    {
        $blog->update(['is_published' => !$blog->is_published]);

        return back()->with('success', 'Published status updated!');
    }

    public function toggleComments(Blog $blog)
    {
        $blog->update(['comments_enabled' => !$blog->comments_enabled]);

        return back()->with('success', 'Comments status updated!');
    }

    /**
     * AJAX endpoint for real-time SEO & Readability analysis
     */
    public function analyzeContent(Request $request)
    {
        $seoAnalyzer = new SeoAnalyzer(
            $request->title ?? '',
            $request->content ?? '',
            $request->meta_description ?? '',
            $request->focus_keyword ?? '',
            $request->slug ?? Str::slug($request->title ?? ''),
            $request->has_featured_image ?? false
        );
        $seoResult = $seoAnalyzer->analyze();

        $readabilityAnalyzer = new ReadabilityAnalyzer($request->content ?? '');
        $readabilityResult = $readabilityAnalyzer->analyze();

        return response()->json([
            'seo' => $seoResult,
            'readability' => $readabilityResult,
        ]);
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\OurPeople;
use App\Models\Category;
use App\Models\Tag;
use App\Services\ReadabilityAnalyzer;
use App\Services\SeoAnalyzer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleAdminController extends Controller
{
    public function index()
    {
        $articles = Article::with(['authors', 'category', 'tags'])
            ->latest()
            ->paginate(15);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $people = OurPeople::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.articles.create', compact('people', 'categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'authors' => 'required|array|min:1',
            'authors.*' => 'exists:our_people,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id', 
            'featured_image' => 'nullable|image|max:2048',
            'reading_time' => 'required|integer|min:1',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'focus_keyword' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string|max:160'
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Analyze SEO
        $seoAnalyzer = new SeoAnalyzer(
            $validated['title'],
            $validated['content'],
            $validated['meta_description'] ?? '',
            $validated['focus_keyword'] ?? '',
            $validated['slug'],
            $request->hasFile('featured_image')
        );
        $seoResult = $seoAnalyzer->analyze();

        // Analyze Readability
        $readabilityAnalyzer = new ReadabilityAnalyzer($validated['content']);
        $readabilityResult = $readabilityAnalyzer->analyze();

        $validated['seo_score'] = $seoResult['score'];
        $validated['readability_score'] = $readabilityResult['score'];

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $article = Article::create($validated);

        // Attach authors
        $article->authors()->attach($validated['authors']);

        // Attach tags
        if (!empty($validated['tags'])) {
            $article->tags()->attach($validated['tags']);
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article created successfully!');
    }

    public function edit(Article $article)
    {
        $article->load(['authors', 'tags']);
        $people = OurPeople::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.articles.edit', compact('article', 'people', 'categories', 'tags'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'authors' => 'required|array|min:1',
            'authors.*' => 'exists:our_people,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|max:2048',
            'reading_time' => 'required|integer|min:1',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
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
            $request->hasFile('featured_image') || $article->featured_image
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
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $article->update($validated);

        // Sync authors
        $article->authors()->sync($validated['authors']);

        // Sync tags
        $article->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully!');
    }

    public function destroy(Article $article)
    {
        // Delete image if exists
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article deleted successfully!');
    }

    public function toggleFeatured(Article $article)
    {
        $article->update(['is_featured' => !$article->is_featured]);

        return back()->with('success', 'Featured status updated!');
    }

    public function togglePublished(Article $article)
    {
        $article->update(['is_published' => !$article->is_published]);

        return back()->with('success', 'Published status updated!');
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
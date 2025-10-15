<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Faq;
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

    public function faqs()
    {
        $faqs = Faq::all();
        return view('admin.faqs', compact('faqs'));
    }

    public function storeFaq(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string'
        ]);

        $faq = Faq::create($validated);
        return redirect()->back()->with('success', 'FAQ created successfully!');
    }

    public function updateFaq(Request $request, $id)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string'
        ]);

        $faq = Faq::findOrFail($id);
        $faq->question = $validated['question'];
        $faq->answer = $validated['answer'];
        $faq->save();

        return redirect()->back()->with('success', 'FAQ updated successfully!');
    }

    public function deleteFaq($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->back()->with('success', 'FAQ deleted successfully.');
    }
}

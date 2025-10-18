<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Judgement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JudgementsController extends Controller
{
    public function index(Request $request)
    {
        $query = Judgement::active()->with('category');

        // Filter by court
        if ($request->filled('court')) {
            $query->where('court', $request->court);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('case_number', 'like', "%{$search}%")
                  ->orWhere('court', 'like', "%{$search}%");
            });
        }

        $judgements = $query->ordered()->paginate(15);

        // Get featured judgements
        $featured = Judgement::featured()->take(5)->get();

        // Get unique courts for filter
        $courts = Judgement::active()
            ->select('court')
            ->distinct()
            ->whereNotNull('court')
            ->pluck('court');

        $categories = Category::where('status', 'active')->orderBy('name')->get();

        return view('judgements.index', compact('judgements', 'featured', 'courts', 'categories'));
    }

    public function download(Judgement $judgement)
    {
        // Increment download count
        $judgement->incrementDownloadCount();

        // Download file
        return Storage::disk('public')->download($judgement->file_path);
    }

    public function view(Judgement $judgement)
    {
        // View file in browser
        return Storage::disk('public')->response($judgement->file_path);
    }
}

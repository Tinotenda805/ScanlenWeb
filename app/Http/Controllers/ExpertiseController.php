<?php

namespace App\Http\Controllers;

use App\Models\Expertise;
use Illuminate\Http\Request;

class ExpertiseController extends Controller
{
    /**
     * Display a listing of expertise
     */
    public function index()
    {
        // Get featured expertise
        $featuredExpertise = Expertise::active()
            ->featured()
            ->ordered()
            ->limit(6)
            ->get();

        // Get all expertise with pagination
        $allExpertise = Expertise::active()
            ->ordered()
            ->paginate(12);

        return view('expertise.index', compact('featuredExpertise', 'allExpertise'));
    }

    /**
     * Display the specified expertise
     */
    public function show($slug)
    {
        $expertise = Expertise::where('slug', $slug)
            ->where('status', 'active')
            ->with(['relatedExpertise' => function($query) {
                $query->where('status', 'active')->ordered();
            }, 'people' => function($query) {
                $query->where('status', 'active');
            }])
            ->firstOrFail();

        return view('expertise.show', compact('expertise'));
    }

    /**
     * Search expertise
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $expertise = Expertise::active()
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('short_description', 'like', "%{$query}%")
                  ->orWhere('overview', 'like', "%{$query}%");
            })
            ->ordered()
            ->paginate(12);

        return view('expertise.search', compact('expertise', 'query'));
    }
}
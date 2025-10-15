<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expertise;
use App\Models\OurPeople;
use Illuminate\Http\Request;

class OurPeopleController extends Controller
{
    public function ourPartners()
    {
        $title = "Our Parteners";
        $subtitle = "-";
        return view('our-people.partners', compact('title', 'subtitle'));
    }

    public function ourAssociates()
    {
        $title = "Our Associates";
        $subtitle = "-";
        return view('our-people.associates', compact('title', 'subtitle'));
    }

    public function partner()
    {
        return view('our-people.partner');
    }

    public function gallery()
    {
        $title = "Our Gallery";
        $subtitle = "-";
        return view('gallery', compact('title', 'subtitle'));
    }

    public function search(Request $request)
    {
        $query = OurPeople::where('status', 'active');

        // Search by name
        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }

        // Filter by expertise
        if ($request->filled('expertise')) {
            $query->whereHas('expertise', function($q) use ($request) {
                $q->where('expertise.id', $request->expertise);
            });
        }

        // Filter by sector (category)
        if ($request->filled('sector')) {
            $query->where('category_id', $request->sector);
        }

        $people = $query->with(['expertise', 'category'])
                        ->orderBy('name', 'asc')
                        ->paginate(12);

        // Get all expertise and sectors for the filter form
        $allExpertise = Expertise::active()->ordered()->get();
        $sectors = Category::where('type', 'sector')
            ->where('status', 'active')
            ->orderBy('name', 'asc')
            ->get();

        return view('our-people.find-lawyer', compact('people', 'allExpertise', 'sectors'));
    }
}

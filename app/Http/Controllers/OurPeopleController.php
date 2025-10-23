<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expertise;
use App\Models\OurPeople;
use Illuminate\Http\Request;

class OurPeopleController extends Controller
{
    /**
     * Display partners listing
     */
    public function partners()
    {
        $partners = OurPeople::partners()
            ->active()
            ->with('expertise', 'category')
            // ->ordered()
            ->get();

        return view('our-people.partners', compact('partners'));
    }

    /**
     * Display associates listing
     */
    public function associates()
    {
        $associates = OurPeople::associates()
            ->active()
            ->with('expertise', 'category')
            // ->ordered()
            ->get();

        return view('our-people.associates', compact('associates'));
    }

    /**
     * Display individual profile
     */
    public function show($id)
    {
        $person = OurPeople::where('id', $id)
            ->where('status', 'active')
            ->with(['expertise', 'category', 'articles'])
            ->firstOrFail();

        return view('our-people.partner', compact('person'));
    }

    /**
     * Find a lawyer search
     */
    public function findLawyer(Request $request)
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

        $people = $query->with(['expertise'])
                        // ->ordered()
                        ->paginate(12);

        // Get all expertise and sectors for the filter form
        $allExpertise = Expertise::active()->get();
        $sectors = Category::where('type', 'sector')
                          ->where('status', 'active')
                          ->orderBy('name', 'asc')
                          ->get();

        return view('our-people.find-lawyer', compact('people', 'allExpertise', 'sectors'));
    }
}

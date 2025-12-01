<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expertise;
use App\Models\Gallery;
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
            ->with('expertise', 'categories')
            ->ordered()
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
            ->with('expertise', 'categories')
            // ->ordered()
            ->get();

        return view('our-people.associates', compact('associates'));
    }

    /**
     * Display individual profile
     */
    public function show($slug)
    {
        $person = OurPeople::where('slug', $slug)
            ->where('status', 'active')
            ->with(['expertise', 'categories', 'articles'])
            ->firstOrFail();
        // dd($person); 

        return view('our-people.partner', compact('person'));
    }

    /**
 * Find a lawyer search
 */
public function findLawyer(Request $request)
{
    $query = OurPeople::where('status', 'active')
        ->whereHas('employeeType', function($q) {
            $q->where('name', 'like', '%partner%')
            ->orWhere('name', 'like', '%associate%');
        });

    // Search by name
    if ($request->filled('name')) {
        $query->where('name', 'like', "%{$request->name}%");
    }

    // Filter by expertise (many-to-many)
    if ($request->filled('expertise')) {
        $query->whereHas('expertise', function($q) use ($request) {
            $q->where('expertise.id', $request->expertise);
        });
    }

    // Filter by sector/category (many-to-many)
    if ($request->filled('category')) {
        $query->whereHas('categories', function($q) use ($request) {
            $q->where('categories.id', $request->category);
        });
    }

    $people = $query->with(['expertise', 'categories'])
        // ->orderBy('order', 'asc')
        ->orderBy('name', 'asc')
        ->paginate(9);

    // Get all expertise and sectors for the filter form
    $allExpertise = Expertise::active()->get();
    $sectors = Category::where('status', 'active')
        ->orderBy('name', 'asc')
        ->get();

    return view('our-people.find-lawyer', compact('people', 'allExpertise', 'sectors'));
}

    
}

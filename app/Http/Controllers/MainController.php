<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expertise;
use App\Models\Faq;
use App\Models\OurPeople;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $faqs = Faq::all();

        $partners = OurPeople::where(function($query) {
            $query->where('type', 'partner');
                // ->orWhere('role', 'partner');
            })
            ->where('status', 'active')
            ->orderBy('name', 'asc')
            ->get();
        
        $allExpertise = Expertise::active()
            ->ordered()
            ->get();
        
        $sectors = Category::where('type', 'sector')
            ->where('status', 'active')
            ->orderBy('name', 'asc')
            ->get();
        return view('index', compact('faqs', 'partners', 'allExpertise', 'sectors'));
    }

    public function expertise()
    {
        $title = "Our Expertise";
        $subtitle = "Explore our areas of legal specialization.";
        return view('expertise', compact('title', 'subtitle'));
    }

    public function contactUs()
    {
        return view('contact-us');
    }

    public function ourHistory()
    {
        $title = "Our Legacy";
        $subtitle = "Decades of Excellence in Legal Service";
        return view('our-history', compact('title', 'subtitle'));
    }

    
}

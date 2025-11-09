<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Expertise;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\OurPeople;
use App\Models\Statistic;
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
        
        $allExpertise = Expertise::where('status', 'active')
            ->orderBy('name', 'asc')
            ->get();

        // $sectors = Category::where('type', 'sector')
        $sectors = Category::where('status', 'active')
            ->orderBy('name', 'asc')
            ->get();

        $statistics = Statistic::active()
            ->ordered()
            ->take(3)
            ->get();

        $awards = Award::where('is_active',1)
            ->ordered()
            ->take(4)
            ->get();
            
        return view('index', compact('faqs', 'partners', 'allExpertise', 'sectors', 'statistics', 'awards'));
    }

    public function contactUs()
    {
        return view('contact-us');
    }

    public function storeMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Add IP address
        $validated['ip_address'] = $request->ip();
        $validated['status'] = 'unread';

        // Create message
        ContactMessage::create($validated);

        // Optional: Send email notification to admin
        // Mail::to('admin@scanlen.co.zw')->send(new ContactMessageReceived($validated));

        return back()->with('success', 'Your message has been sent successfully!');
    }

   
    public function gallery()
    {
        $gallery = Gallery::active()->ordered()->get();

        // Group by category for easier filtering
        $categories = [
            'our-team' => $gallery->where('category', 'our-team'),
            'practice-areas' => $gallery->where('category', 'practice-areas'),
            'achievements' => $gallery->where('category', 'achievements'),
            'resources' => $gallery->where('category', 'resources'),
            'events' => $gallery->where('category', 'events'),
            'awards' => $gallery->where('category', 'awards'),
        ];

        return view('gallery', compact('gallery', 'categories'));
    }

    
}

<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageNotification;
use App\Models\Award;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Expertise;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\OurPeople;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        $categories = Category::withCount(['articles' => function($query) {
                $query->published();
            }])
            ->has('articles')
            ->orderBy('name')
            // ->take(6)
            ->get();

        $featuredPeople = OurPeople::active()
            ->partners()
            // ->with('expertise')
            ->inRandomOrder()
            // ->take(5) 
            ->get();

        $featuredExpertise = Expertise::withCount('people')
            ->inRandomOrder()
            ->take(3) 
            ->get();
            
        return view('home', compact(
            'faqs', 'partners', 
            'allExpertise', 'sectors', 
            'statistics', 'awards', 
            'categories', 'featuredPeople',
            'featuredExpertise'
        ));
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

        $validated['ip_address'] = $request->ip();
        $validated['status'] = 'unread';

        // Create message
        $contactMessage = ContactMessage::create($validated);

        // Send email notification to admin - using send() instead of queue()
        try {
            Mail::to(config('mail.admin_email', 'dlomo0308@gmail.com')) 
                ->send(new ContactMessageNotification($contactMessage));
            
            Log::info('Contact form email sent successfully to: ' . config('mail.admin_email'));
            
        } catch (\Exception $e) {
            // Log the error but don't fail the request
            Log::error('Failed to send contact email: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Optionally, you can still show success to user since message was saved
            // Or you can notify them there was an issue
        }

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

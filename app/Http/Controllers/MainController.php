<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        return view('index');
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

    public function articles()
    {
        $title = "Our Articles";
        $subtitle = "-";
        return view('articles.articles', compact('title', 'subtitle'));
    }

    public function article()
    {
        $title = "Artcle Heading Goes Here";
        $subtitle = "-";
        return view('articles.article', compact('title', 'subtitle'));
    }
    
    public function partner()
    {
        return view('partner');
    }

    public function gallery()
    {
        $title = "Our Gallery";
        $subtitle = "-";
        return view('gallery', compact('title', 'subtitle'));
    }
}

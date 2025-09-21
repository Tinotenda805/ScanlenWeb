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
        return view('expertise');
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
        return view('our-partners', compact('title', 'subtitle'));
    }

    public function ourAssociates()
    {
        $title = "Our Associates";
        $subtitle = "-";
        return view('our-associates', compact('title', 'subtitle'));
    }

    public function articles()
    {
        $title = "Our Articles";
        $subtitle = "-";
        return view('articles', compact('title', 'subtitle'));
    }

    public function article()
    {
        $title = "Artcle Heading Goes Here";
        $subtitle = "-";
        return view('article', compact('title', 'subtitle'));
    }

    public function partner()
    {
        return view('partner');
    }
}

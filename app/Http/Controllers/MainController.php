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
        return view('our-history');
    }

    public function ourPartners()
    {
        return view('our-partners');
    }
}

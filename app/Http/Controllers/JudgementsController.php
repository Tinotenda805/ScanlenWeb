<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JudgementsController extends Controller
{
    public function index()
    {
        return view('judgements');
    }
}

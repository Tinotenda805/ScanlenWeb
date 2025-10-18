<?php

namespace App\Http\Controllers;

use App\Models\HistoryTimeline;
use App\Models\Statistic;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $timelines = HistoryTimeline::active()
            ->ordered()
            ->get();

        $statistics = Statistic::active()
            ->ordered()
            ->get();

        $title = "Our Legacy";
        $subtitle = "Decades of Excellence in Legal Service";

        return view('history.index', compact('timelines', 'statistics', 'title', 'subtitle'));
    }

}

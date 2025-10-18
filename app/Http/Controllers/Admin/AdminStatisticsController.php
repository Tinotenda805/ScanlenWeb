<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;

class AdminStatisticsController extends Controller
{
    public function index()
    {
        $statistics = Statistic::ordered()->paginate(20);
        return view('admin.statistics.index', compact('statistics'));
    }

    public function create()
    {
        return view('admin.statistics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:50',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
        ]);

        Statistic::create($validated);

        return redirect()->route('admin.statistics.index')
            ->with('success', 'Statistic created successfully.');
    }

    public function edit(Statistic $statistic)
    {
        return view('admin.statistics.edit', compact('statistic'));
    }

    public function update(Request $request, Statistic $statistic)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:50',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
        ]);

        $statistic->update($validated);

        return redirect()->route('admin.statistics.index')
            ->with('success', 'Statistic updated successfully.');
    }

    public function destroy(Statistic $statistic)
    {
        $statistic->delete();

        return redirect()->route('admin.statistics.index')
            ->with('success', 'Statistic deleted successfully.');
    }
}

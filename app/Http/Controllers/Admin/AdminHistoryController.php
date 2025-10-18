<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HistoryTimeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHistoryController extends Controller
{
    public function index()
    {
        $timelines = HistoryTimeline::ordered()->paginate(20);
        return view('admin.history.index', compact('timelines'));
    }

    public function create()
    {
        return view('admin.history.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'decade' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'highlights' => 'nullable|array',
            'highlights.*' => 'string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('history', 'public');
        }

        // Clean up empty highlights
        if (isset($validated['highlights'])) {
            $validated['highlights'] = array_filter($validated['highlights']);
        }

        HistoryTimeline::create($validated);

        return redirect()->route('admin.history.index')
            ->with('success', 'Timeline entry created successfully.');
    }

    public function edit(HistoryTimeline $history)
    {
        return view('admin.history.edit', compact('history'));
    }

    public function update(Request $request, HistoryTimeline $history)
    {
        $validated = $request->validate([
            'decade' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'highlights' => 'nullable|array',
            'highlights.*' => 'string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($history->image) {
                Storage::disk('public')->delete($history->image);
            }
            $validated['image'] = $request->file('image')->store('history', 'public');
        }

        // Clean up empty highlights
        if (isset($validated['highlights'])) {
            $validated['highlights'] = array_filter($validated['highlights']);
        }

        $history->update($validated);

        return redirect()->route('admin.history.index')
            ->with('success', 'Timeline entry updated successfully.');
    }

    public function destroy(HistoryTimeline $history)
    {
        if ($history->image) {
            Storage::disk('public')->delete($history->image);
        }

        $history->delete();

        return redirect()->route('admin.history.index')
            ->with('success', 'Timeline entry deleted successfully.');
    }
}

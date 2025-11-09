<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AwardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $awards = Award::ordered()->get();
        return view('admin.awards.index', compact('awards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Award::getCategories();
        return view('admin.awards.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'display_order' => 'nullable|integer',
            'category' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('awards', 'public');
            $validated['image'] = $imagePath;
        }

        Award::create($validated);

        return redirect()->route('admin.awards.index')
            ->with('success', 'Award created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Award $award)
    {
        return view('admin.awards.show', compact('award'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Award $award)
    {
        $categories = Award::getCategories();
        return view('admin.awards.edit', compact('award', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Award $award)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'display_order' => 'nullable|integer',
            'category' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($award->image) {
                Storage::disk('public')->delete($award->image);
            }
            
            $imagePath = $request->file('image')->store('awards', 'public');
            $validated['image'] = $imagePath;
        }

        $award->update($validated);

        return redirect()->route('admin.awards.index')
            ->with('success', 'Award updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Award $award)
    {
        if ($award->image) {
            Storage::disk('public')->delete($award->image);
        }

        $award->delete();

        return redirect()->route('admin.awards.index')
            ->with('success', 'Award deleted successfully.');
    }

    /**
     * Toggle award active status
     */
    public function toggleStatus(Award $award)
    {
        $award->update([
            'is_active' => !$award->is_active
        ]);

        $status = $award->is_active ? 'activated' : 'deactivated';

        return back()->with('success', "Award {$status} successfully.");
    }
}

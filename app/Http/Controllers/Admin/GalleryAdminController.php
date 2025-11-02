<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryAdminController extends Controller
{
    public function index()
    {
        $gallery = Gallery::ordered()->paginate(20);
        return view('admin.gallery.index', compact('gallery'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
            'category' => 'required|in:our-team,practice-areas,achievements,resources,events,awards',
            'badge_label' => 'nullable|string|max:100',
            'link_url' => 'nullable|url',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item added successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'category' => 'required|in:our-team,practice-areas,achievements,resources,events,awards',
            'badge_label' => 'nullable|string|max:100',
            'link_url' => 'nullable|url',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item deleted successfully.');
    }

    // Bulk actions
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate,deactivate',
            'selected' => 'required|array|min:1',
            'selected.*' => 'exists:gallery,id',
        ]);

        $items = Gallery::whereIn('id', $request->selected);

        switch ($request->action) {
            case 'delete':
                foreach ($items->get() as $item) {
                    if ($item->image) {
                        Storage::disk('public')->delete($item->image);
                    }
                }
                $items->delete();
                $message = 'Selected items deleted successfully.';
                break;

            case 'activate':
                $items->update(['status' => 'active']);
                $message = 'Selected items activated successfully.';
                break;

            case 'deactivate':
                $items->update(['status' => 'inactive']);
                $message = 'Selected items deactivated successfully.';
                break;
        }

        return redirect()->route('admin.gallery.index')->with('success', $message);
    }
}

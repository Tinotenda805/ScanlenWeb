<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Expertise;
use App\Models\OurPeople;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExpertiseAdminController extends Controller
{
    public function index()
    {
        $expertise = Expertise::withCount('people')
            ->ordered()
            ->paginate(20);

        return view('admin.expertise.index', compact('expertise'));
    }

    public function create()
    {
        $allExpertise = Expertise::active()->ordered()->get();
        $people = OurPeople::where('status', 'active')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.expertise.create', compact('allExpertise', 'people'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:expertise,slug',
            'short_description' => 'nullable|string|max:500',
            'overview' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'related_expertise' => 'nullable|array',
            'related_expertise.*' => 'exists:expertise,id',
            'key_contacts' => 'nullable|array',
            'key_contacts.*' => 'exists:our_people,id',
        ]);

        // Handle image uploads
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('expertise', 'public');
        }

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('expertise/banners', 'public');
        }

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $expertise = Expertise::create($validated);

        // Sync related expertise
        if ($request->has('related_expertise')) {
            $expertise->relatedExpertise()->sync($request->related_expertise);
        }

        // Sync key contacts
        if ($request->has('key_contacts')) {
            $syncData = [];
            foreach ($request->key_contacts as $index => $personId) {
                $syncData[$personId] = ['order' => $index];
            }
            $expertise->people()->sync($syncData);
        }

        return redirect()->route('admin.expertise.index')
            ->with('success', 'Expertise created successfully.');
    }

    public function edit(Expertise $expertise)
    {
        // $expertise = Expertise::find($id);
        $allExpertise = Expertise::where('id', '!=', $expertise->id)
            ->active()
            ->ordered()
            ->get();
        
        $people = OurPeople::where('status', 'active')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.expertise.edit', compact('expertise', 'allExpertise', 'people'));
    }

    public function update(Request $request, Expertise $expertise)
    {
        // $expertise = Expertise::find($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:expertise,slug,' . $expertise->id,
            'short_description' => 'nullable|string|max:500',
            'overview' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'related_expertise' => 'nullable|array',
            'related_expertise.*' => 'exists:expertise,id',
            'key_contacts' => 'nullable|array',
            'key_contacts.*' => 'exists:our_people,id',
        ]);

        // Handle image uploads
        if ($request->hasFile('image')) {
            // Delete old image
            if ($expertise->image) {
                Storage::disk('public')->delete($expertise->image);
            }
            $validated['image'] = $request->file('image')->store('expertise', 'public');
        }

        if ($request->hasFile('banner_image')) {
            // Delete old banner
            if ($expertise->banner_image) {
                Storage::disk('public')->delete($expertise->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('expertise/banners', 'public');
        }

        $expertise->update($validated);

        // Sync related expertise
        if ($request->has('related_expertise')) {
            $expertise->relatedExpertise()->sync($request->related_expertise);
        } else {
            $expertise->relatedExpertise()->detach();
        }

        // Sync key contacts
        if ($request->has('key_contacts')) {
            $syncData = [];
            foreach ($request->key_contacts as $index => $personId) {
                $syncData[$personId] = ['order' => $index];
            }
            $expertise->people()->sync($syncData);
        } else {
            $expertise->people()->detach();
        }

        return redirect()->route('admin.expertise.index')
            ->with('success', 'Expertise updated successfully.');
    }

    public function destroy(Expertise $expertise)
    {
        // $expertise = Expertise::find($id);
        // Delete images
        if ($expertise->image) {
            Storage::disk('public')->delete($expertise->image);
        }
        if ($expertise->banner_image) {
            Storage::disk('public')->delete($expertise->banner_image);
        }

        $expertise->delete();

        return redirect()->route('admin.expertise.index')
            ->with('success', 'Expertise deleted successfully.');
    }

    public function show($id)
    {

    }

    // Toggle featured status
    public function toggleFeatured(Expertise $expertise)
    {
        $expertise->update(['is_featured' => !$expertise->is_featured]);

        return back()->with('success', 'Featured status updated.');
    }

    // Bulk actions
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate,deactivate',
            'selected' => 'required|array',
            'selected.*' => 'exists:expertise,id',
        ]);

        $expertise = Expertise::whereIn('id', $request->selected);

        switch ($request->action) {
            case 'delete':
                foreach ($expertise->get() as $item) {
                    if ($item->image) {
                        Storage::disk('public')->delete($item->image);
                    }
                    if ($item->banner_image) {
                        Storage::disk('public')->delete($item->banner_image);
                    }
                }
                $expertise->delete();
                $message = 'Selected expertise deleted successfully.';
                break;

            case 'activate':
                $expertise->update(['status' => 'active']);
                $message = 'Selected expertise activated successfully.';
                break;

            case 'deactivate':
                $expertise->update(['status' => 'inactive']);
                $message = 'Selected expertise deactivated successfully.';
                break;
        }

        return back()->with('success', $message);
    }
}

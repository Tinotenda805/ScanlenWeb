<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Judgement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminJudgementController extends Controller
{
    public function index(Request $request)
    {
        $query = Judgement::with('category');

        // Filter by court
        if ($request->filled('court')) {
            $query->where('court', $request->court);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('case_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $judgements = $query->ordered()->paginate(20);
        
        // Get unique courts for filter
        $courts = Judgement::select('court')
            ->distinct()
            ->whereNotNull('court')
            ->pluck('court');

        $categories = Category::where('status', 'active')->orderBy('name')->get();

        return view('admin.judgements.index', compact('judgements', 'courts', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->orderBy('name')->get();
        return view('admin.judgements.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'case_number' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'judgement_date' => 'nullable|date',
            'court' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB max
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|string',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $validated['file_path'] = $file->store('judgements', 'public');
            $validated['file_type'] = $file->getClientOriginalExtension();
            $validated['file_size'] = $file->getSize();
        }

        // Process tags
        if ($request->filled('tags')) {
            $validated['tags'] = array_map('trim', explode(',', $request->tags));
        }

        Judgement::create($validated);

        return redirect()->route('admin.judgements.index')
            ->with('success', 'Judgement uploaded successfully.');
    }

    public function edit(Judgement $judgement)
    {
        $categories = Category::where('status', 'active')->orderBy('name')->get();
        
        // Convert tags array to string for editing
        $judgement->tags_string = $judgement->tags ? implode(', ', $judgement->tags) : '';
        
        return view('admin.judgements.edit', compact('judgement', 'categories'));
    }

    public function update(Request $request, Judgement $judgement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'case_number' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'judgement_date' => 'nullable|date',
            'court' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|string',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file
            if ($judgement->file_path) {
                Storage::disk('public')->delete($judgement->file_path);
            }

            $file = $request->file('file');
            $validated['file_path'] = $file->store('judgements', 'public');
            $validated['file_type'] = $file->getClientOriginalExtension();
            $validated['file_size'] = $file->getSize();
        }

        // Process tags
        if ($request->filled('tags')) {
            $validated['tags'] = array_map('trim', explode(',', $request->tags));
        } else {
            $validated['tags'] = null;
        }

        $judgement->update($validated);

        return redirect()->route('admin.judgements.index')
            ->with('success', 'Judgement updated successfully.');
    }

    public function destroy(Judgement $judgement)
    {
        // Delete file
        if ($judgement->file_path) {
            Storage::disk('public')->delete($judgement->file_path);
        }

        $judgement->delete();

        return redirect()->route('admin.judgements.index')
            ->with('success', 'Judgement deleted successfully.');
    }

    // Toggle featured status
    public function toggleFeatured(Judgement $judgement)
    {
        $judgement->update(['is_featured' => !$judgement->is_featured]);

        return back()->with('success', 'Featured status updated.');
    }

    // Bulk actions
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate,deactivate,feature,unfeature',
            'selected' => 'required|array|min:1',
            'selected.*' => 'exists:judgements,id',
        ]);

        $judgements = Judgement::whereIn('id', $request->selected);

        switch ($request->action) {
            case 'delete':
                foreach ($judgements->get() as $item) {
                    if ($item->file_path) {
                        Storage::disk('public')->delete($item->file_path);
                    }
                }
                $judgements->delete();
                $message = 'Selected judgements deleted successfully.';
                break;

            case 'activate':
                $judgements->update(['status' => 'active']);
                $message = 'Selected judgements activated successfully.';
                break;

            case 'deactivate':
                $judgements->update(['status' => 'inactive']);
                $message = 'Selected judgements deactivated successfully.';
                break;

            case 'feature':
                $judgements->update(['is_featured' => true]);
                $message = 'Selected judgements marked as featured.';
                break;

            case 'unfeature':
                $judgements->update(['is_featured' => false]);
                $message = 'Selected judgements unmarked as featured.';
                break;
        }

        return redirect()->route('admin.judgements.index')->with('success', $message);
    }

    // View download statistics
    public function downloadStats(Judgement $judgement)
    {
        $downloads = $judgement->downloads()
            ->orderBy('downloaded_at', 'desc')
            ->paginate(50);

        return view('admin.judgements.download-stats', compact('judgement', 'downloads'));
    }
}

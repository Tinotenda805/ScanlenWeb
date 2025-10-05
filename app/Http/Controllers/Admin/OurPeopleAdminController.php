<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurPeople;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OurPeopleAdminController extends Controller
{
    public function index()
    {
        $people = OurPeople::withCount('articles')
            ->latest()
            ->paginate(20);

        return view('admin.people.index', compact('people'));
    }

    public function create()
    {
        return view('admin.people.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:our_people,email',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048',
            'type' => 'required|in:partner,associate',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('people', 'public');
        }

        OurPeople::create($validated);

        return redirect()->route('admin.people.index')
            ->with('success', 'Person added successfully!');
    }

    public function edit(OurPeople $person)
    {
        return view('admin.people.edit', compact('person'));
    }

    public function update(Request $request, OurPeople $person)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:our_people,email,' . $person->id,
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048',
            'type' => 'required|in:partner,associate',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($person->avatar) {
                Storage::disk('public')->delete($person->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('people', 'public');
        }

        $person->update($validated);

        return redirect()->route('admin.people.index')
            ->with('success', 'Person updated successfully!');
    }

    public function destroy(OurPeople $person)
    {
        // Delete avatar if exists
        if ($person->avatar) {
            Storage::disk('public')->delete($person->avatar);
        }

        $person->delete();

        return redirect()->route('admin.people.index')
            ->with('success', 'Person deleted successfully!');
    }
}

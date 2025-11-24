<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expertise;
use App\Models\OurPeople;
use App\Models\OurPeopleExpertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OurPeopleAdminController extends Controller
{
    public $id;

    public function index()
    {
        $people = OurPeople::withCount('articles')
            ->latest()
            ->paginate(20);

        return view('admin.people.index', compact('people'));
    }

    public function create()
    {
        $expertise = Expertise::all();

        return view('admin.people.create', compact('expertise'));
    }

    public function storeOld(Request $request)
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $this->validateRequest($request);
        // dd($validated);

        DB::beginTransaction();

        try {
            // Handle file uploads
            $avatarPath = $this->handleAvatarUpload($request);
            $bannerPath = $this->handleBannerUpload($request);


            // Create the person record
            $person = OurPeople::create([
                'name' => $validated['name'],
                // 'slug' => $slug,
                'designation' => $validated['designation'],
                'email' => $validated['email'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'linkedin' => $validated['linkedin'] ?? null,
                'whatsapp' => $validated['whatsapp'] ?? null,
                'location' => $validated['location'] ?? null,
                'languages' => $validated['languages'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'profile_overview' => $validated['profile_overview'] ?? null,
                'years_of_experience' => $validated['years_of_experience'] ?? null,
                'deals_completed' => $validated['deals_completed'] ?? null,
                'type' => $validated['type'],
                'status' => $validated['status'],
                // 'order' => $validated['order'] ?? 0,
                'avatar' => $avatarPath,
                'banner_image' => $bannerPath,
                // 'areas_of_expertise' => $this->formatArrayData($validated['areas_of_expertise'] ?? []),
                'professional_experience' => $this->formatArrayData($validated['professional_experience'] ?? []),
                'qualifications' => $this->formatArrayData($validated['qualifications'] ?? []),
            ]);

            // $expertiseValidation =  $this->formatArrayData($validated['areas_of_expertise'] ?? []);
            // // Attach expertise
            // if (!empty($expertiseValidation)) {
            //     $person->expertise()->attach($expertiseValidation);
            // }

            DB::commit();

            return redirect()
                ->route('admin.people.index')
                ->with('success', 'Team member created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            dd($e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'Failed to create team member: ' . $e->getMessage());
        }
    }

    public function edit(OurPeople $person)
    {
        return view('admin.people.edit', compact('person'));
    }

    public function updateOld(Request $request, OurPeople $person)
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

        // $validated['slug'] = Str::slug($validated['name']);

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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OurPeople $person)
    {
        // Validate the request
        $validated = $this->validateRequest($request, $person);

        DB::beginTransaction();

        try {
            // Handle file uploads
            $avatarPath = $this->handleAvatarUpload($request, $person);
            $bannerPath = $this->handleBannerUpload($request, $person);

            // Generate slug if not provided or if name changed
            // $slug = $this->generateSlug(
            //     $validated['slug'] ?? null, 
            //     $validated['name'], 
            //     $person
            // );

            // Update the person record
            $updateData = [
                'name' => $validated['name'],
                'designation' => $validated['designation'],
                'email' => $validated['email'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'linkedin' => $validated['linkedin'] ?? null,
                'whatsapp' => $validated['whatsapp'] ?? null,
                'location' => $validated['location'] ?? null,
                'languages' => $validated['languages'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'profile_overview' => $validated['profile_overview'] ?? null,
                'years_of_experience' => $validated['years_of_experience'] ?? null,
                'deals_completed' => $validated['deals_completed'] ?? null,
                'type' => $validated['type'],
                'status' => $validated['status'],
                // 'order' => $validated['order'] ?? 0,
                'areas_of_expertise' => $this->formatArrayData($validated['areas_of_expertise'] ?? []),
                'professional_experience' => $this->formatArrayData($validated['professional_experience'] ?? []),
                'qualifications' => $this->formatArrayData($validated['qualifications'] ?? []),
            ];

            // Only update avatar if a new one was uploaded
            if ($avatarPath) {
                $updateData['avatar'] = $avatarPath;
            }

            // Only update banner if a new one was uploaded
            if ($bannerPath) {
                $updateData['banner_image'] = $bannerPath;
            }

            $person->update($updateData);

            DB::commit();

            return redirect()
                ->route('admin.people.index')
                ->with('success', 'Team member updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()
                ->withInput()
                ->with('error', 'Failed to update team member: ' . $e->getMessage());
        }
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

    /**
     * Validate the request data
     */
    private function validateRequest(Request $request, $person = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            // 'slug' => 'nullable|string|max:255|unique:our_people,slug' . ($person ? ',' . $person->id : ''),
            'designation' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'linkedin' => 'nullable|url|max:500',
            'whatsapp' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'profile_overview' => 'nullable|string',
            'years_of_experience' => 'nullable|integer|min:0',
            'deals_completed' => 'nullable|integer|min:0',
            'type' => 'required|in:partner,associate',
            'status' => 'required|in:active,inactive',
            'order' => 'nullable|integer|min:0',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'areas_of_expertise' => 'nullable|array',
            'areas_of_expertise.*.expertise_id' => 'nullable|int|exists:expertise,id',
            'areas_of_expertise.*.description' => 'nullable|string',
            'professional_experience' => 'nullable|array',
            'professional_experience.*.period' => 'nullable|string|max:255',
            'professional_experience.*.role' => 'nullable|string|max:255',
            'professional_experience.*.company' => 'nullable|string|max:255',
            'professional_experience.*.description' => 'nullable|string',
            'qualifications' => 'nullable|array',
            'qualifications.*.title' => 'nullable|string|max:255',
            'qualifications.*.institution' => 'nullable|string|max:255',
            'qualifications.*.year' => 'nullable|string|max:10',
            'qualifications.*.details' => 'nullable|string',
        ];

        // If creating a new person, make avatar required
        if (!$person) {
            $rules['avatar'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        // return Validator::make($request->all(), $rules);
        return $request->validate($rules);
    }



    /**
     * Handle avatar file upload
     */
    private function handleAvatarUpload(Request $request, $person = null)
    {
        if (!$request->hasFile('avatar')) {
            return $person->avatar ?? null;
        }

        // Delete old avatar if exists
        if ($person && $person->avatar) {
            Storage::disk('public')->delete($person->avatar);
        }

        // Store new avatar
        return $request->file('avatar')->store('people/avatars', 'public');
    }

    /**
     * Handle banner file upload
     */
    private function handleBannerUpload(Request $request, $person = null)
    {
        if (!$request->hasFile('banner_image')) {
            return $person->banner_image ?? null;
        }

        // Delete old banner if exists
        if ($person && $person->banner_image) {
            Storage::disk('public')->delete($person->banner_image);
        }

        // Store new banner
        return $request->file('banner_image')->store('people/banners', 'public');
    }

    /**
     * Format array data by removing empty entries
     */
    private function formatArrayData(array $data)
    {
        return collect($data)
            ->filter(function ($item) {
                // Remove items where all fields are empty
                return !empty(array_filter($item, function ($value) {
                    return !empty(trim($value));
                }));
            })
            ->values()
            ->toArray();
    }

}

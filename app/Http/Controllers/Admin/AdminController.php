<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Faq;
use App\Models\OurPeople;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_articles' => Article::count(),
            'published_articles' => Article::published()->count(),
            'total_blogs' => Blog::count(),
            'published_blogs' => Blog::published()->count(),
            'total_people' => OurPeople::count(),
            'partners' => OurPeople::where('type', 'partner')->count(),
            'associates' => OurPeople::where('type', 'associate')->count(),
            'total_categories' => Category::count(),
            'total_tags' => Tag::count(),
        ];

        // Recent articles
        $recentArticles = Article::with(['authors', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // Recent blogs
        $recentBlogs = Blog::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.index', compact('stats', 'recentArticles', 'recentBlogs'));
    }

    public function faqs()
    {
        $faqs = Faq::all();
        return view('admin.faqs', compact('faqs'));
    }

    public function storeFaq(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string'
        ]);

        $faq = Faq::create($validated);
        return redirect()->back()->with('success', 'FAQ created successfully!');
    }

    public function updateFaq(Request $request, $id)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string'
        ]);

        $faq = Faq::findOrFail($id);
        $faq->question = $validated['question'];
        $faq->answer = $validated['answer'];
        $faq->save();

        return redirect()->back()->with('success', 'FAQ updated successfully!');
    }

    public function deleteFaq($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->back()->with('success', 'FAQ deleted successfully.');
    }

    // ==================== USER MANAGEMENT ====================

    /**
     * Display all users
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Store a newly created user
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'in:user,admin'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'password' => Hash::make($validated['password']),
            ]);

            DB::commit();

            return redirect()->back()
                ->with('success', 'User created successfully!');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to create user: ' . $th->getMessage());
        }
    }

    /**
     * Update existing user
     */
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,user'],
        ]);

        DB::beginTransaction();
        
        try {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
            ]);

            DB::commit();
            
            return redirect()->back()
                ->with('success', 'User updated successfully!');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to update user: ' . $th->getMessage());
        }
    }

    /**
     * Reset user password
     */
    public function resetPassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::beginTransaction();

        try {
            $user->update([
                'password' => Hash::make($validated['password']),
            ]);

            DB::commit();

            return redirect()->back()
                ->with('success', 'Password reset successfully!');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to reset password: ' . $th->getMessage());
        }
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'You cannot delete your own account!');
        }

        DB::beginTransaction();

        try {
            $user->delete();
            
            DB::commit();
            
            return redirect()->back()
                ->with('success', 'User deleted successfully!');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to delete user: ' . $th->getMessage());
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function store(Request $request, Blog $blog)
    {
        // Check if comments are enabled
        if (!$blog->comments_enabled) {
            return back()->with('error', 'Comments are disabled for this blog post.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:1000',
        ]);

        $validated['blog_id'] = $blog->id;
        $validated['ip_address'] = $request->ip();
        $validated['is_approved'] = false; // Comments need approval by default

        BlogComment::create($validated);

        return back()->with('success', 'Your comment has been submitted and is awaiting approval!');
    }
}

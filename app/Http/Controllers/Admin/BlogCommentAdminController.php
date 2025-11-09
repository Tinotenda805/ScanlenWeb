<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentAdminController extends Controller
{
    public function index()
    {
        $comments = BlogComment::with('blog')
            ->latest()
            ->paginate(20);

        $pendingCount = BlogComment::pending()->count();
        $approvedCount = BlogComment::approved()->count();

        return view('admin.blogs.comments', compact('comments', 'pendingCount', 'approvedCount'));
    }

    public function approve($id)
    {
        $comment = BlogComment::findOrFail($id);
        $comment->update(['is_approved' => true]);

        return back()->with('success', 'Comment approved successfully!');
    }

    public function unapprove($id)
    {
        $comment = BlogComment::findOrFail($id);
        $comment->update(['is_approved' => false]);

        return back()->with('success', 'Comment unapproved successfully!');
    }

    public function destroy(BlogComment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }

    public function bulkApprove(Request $request)
    {
        $request->validate([
            'comment_ids' => 'required|array',
            'comment_ids.*' => 'exists:blog_comments,id',
        ]);

        BlogComment::whereIn('id', $request->comment_ids)
            ->update(['is_approved' => true]);

        return back()->with('success', 'Comments approved successfully!');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'comment_ids' => 'required|array',
            'comment_ids.*' => 'exists:blog_comments,id',
        ]);

        BlogComment::whereIn('id', $request->comment_ids)->delete();

        return back()->with('success', 'Comments deleted successfully!');
    }
}

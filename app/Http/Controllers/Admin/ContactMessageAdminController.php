<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $messages = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get counts for badges
        $counts = [
            'unread' => ContactMessage::unread()->count(),
            'read' => ContactMessage::read()->count(),
            'replied' => ContactMessage::replied()->count(),
            'total' => ContactMessage::count(),
        ];

        return view('admin.contact-messages.index', compact('messages', 'counts'));
    }

    public function show(ContactMessage $contactMessage)
    {
        // Mark as read if unread
        if ($contactMessage->status === 'unread') {
            $contactMessage->markAsRead();
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function updateStatus(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'status' => 'required|in:unread,read,replied',
            'admin_notes' => 'nullable|string',
        ]);

        $contactMessage->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'read_at' => $request->status !== 'unread' ? now() : null,
        ]);

        return back()->with('success', 'Message status updated successfully.');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }

    // Bulk actions
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,mark-read,mark-replied',
            'selected' => 'required|array|min:1',
            'selected.*' => 'exists:contact_messages,id',
        ]);

        $messages = ContactMessage::whereIn('id', $request->selected);

        switch ($request->action) {
            case 'delete':
                $messages->delete();
                $message = 'Selected messages deleted successfully.';
                break;

            case 'mark-read':
                $messages->update(['status' => 'read', 'read_at' => now()]);
                $message = 'Selected messages marked as read.';
                break;

            case 'mark-replied':
                $messages->update(['status' => 'replied']);
                $message = 'Selected messages marked as replied.';
                break;
        }

        return redirect()->route('admin.contact-messages.index')->with('success', $message);
    }
}

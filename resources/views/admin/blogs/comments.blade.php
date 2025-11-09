@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Blog Comments</h1>
        <div class="d-flex gap-2">
            <span class="badge bg-warning text-dark fs-6">{{ $pendingCount }} Pending</span>
            <span class="badge bg-success fs-6">{{ $approvedCount }} Approved</span>
        </div>
    </div>


    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <!-- Filter Tabs -->
            <ul class="nav nav-tabs mb-4" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#all" type="button">
                        All Comments ({{ $comments->total() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pending" type="button">
                        Pending ({{ $pendingCount }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#approved" type="button">
                        Approved ({{ $approvedCount }})
                    </button>
                </li>
            </ul>

            <!-- Bulk Actions -->
            <form id="bulkActionForm" method="POST">
                @csrf
                <div class="d-flex gap-2 mb-3">
                    <button type="button" class="btn btn-sm btn-success" onclick="bulkAction('approve')">
                        <i class="fas fa-check me-1"></i>Approve Selected
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="bulkAction('delete')">
                        <i class="fas fa-trash me-1"></i>Delete Selected
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 30px;">
                                    <input type="checkbox" id="selectAll" class="form-check-input">
                                </th>
                                <th>Commenter</th>
                                <th>Comment</th>
                                <th>Blog Post</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($comments as $comment)
                            <tr data-status="{{ $comment->is_approved ? 'approved' : 'pending' }}">
                                <td>
                                    <input type="checkbox" name="comment_ids[]" value="{{ $comment->id }}" class="form-check-input comment-checkbox">
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $comment->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $comment->email }}</small>
                                        <br>
                                        <small class="text-muted">IP: {{ $comment->ip_address }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div style="max-width: 300px;">
                                        {{ Str::limit($comment->comment, 100) }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('blogs.show', $comment->blog->slug) }}" target="_blank" class="text-decoration-none">
                                        {{ Str::limit($comment->blog->title, 40) }}
                                        <i class="fas fa-external-link-alt ms-1 small"></i>
                                    </a>
                                </td>
                                <td>
                                    @if($comment->is_approved)
                                    <span class="badge bg-success">Approved</span>
                                    @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <small>{{ $comment->created_at->format('M d, Y') }}</small>
                                    <br>
                                    <small class="text-muted">{{ $comment->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        @if(!$comment->is_approved)
                                        <a href="{{url('admin/blogs/comments/' . $comment->id . '/approve')}}" class="btn btn-outline-success">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        {{-- <form action="{{ url('admin/blogs/comments/' . $comment->id . '/approve') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form> --}}
                                        @else
                                        <a href="{{url('admin/blogs/comments/' . $comment->id . '/unapprove')}}" class="btn btn-outline-warning">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        {{-- <form action="{{ url('admin/blogs/comments/' . $comment->id . '/unapprove') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-warning" title="Unapprove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form> --}}
                                        @endif
                                        
                                        <button type="button" 
                                                class="btn btn-outline-info" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#viewModal{{ $comment->id }}"
                                                title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        
                                        <form action="{{ url('admin/blogs/comments/' . $comment->id . '/delete') }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- View Comment Modal -->
                                    <div class="modal fade" id="viewModal{{ $comment->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Comment Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <strong>Blog Post:</strong>
                                                        <p>{{ $comment->blog->title }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Name:</strong>
                                                        <p>{{ $comment->name }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Email:</strong>
                                                        <p>{{ $comment->email }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>IP Address:</strong>
                                                        <p>{{ $comment->ip_address }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Comment:</strong>
                                                        <p class="border rounded p-3 bg-light">{{ $comment->comment }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Status:</strong>
                                                        @if($comment->is_approved)
                                                        <span class="badge bg-success">Approved</span>
                                                        @else
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <strong>Submitted:</strong>
                                                        <p>{{ $comment->created_at->format('F d, Y \a\t H:i') }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-comments fa-2x mb-3 d-block"></i>
                                    <p class="mb-0">No comments found.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>

            <!-- Pagination -->
            @if($comments->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $comments->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<script>
// Select all checkbox functionality
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.comment-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

// Bulk actions
function bulkAction(action) {
    const form = document.getElementById('bulkActionForm');
    const checkedBoxes = document.querySelectorAll('.comment-checkbox:checked');
    
    if (checkedBoxes.length === 0) {
        alert('Please select at least one comment.');
        return;
    }
    
    if (action === 'approve') {
        form.action = '{{ url("admin/blogs/comments/bulk-approve") }}';
    } else if (action === 'delete') {
        if (!confirm('Are you sure you want to delete the selected comments?')) {
            return;
        }
        form.action = '{{ url("admin/blogs/comments/bulk-delete") }}';
    }
    
    form.submit();
}

// Tab filtering
document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
    tab.addEventListener('shown.bs.tab', function(e) {
        const target = e.target.getAttribute('data-bs-target');
        const rows = document.querySelectorAll('tbody tr[data-status]');
        
        rows.forEach(row => {
            if (target === '#all') {
                row.style.display = '';
            } else if (target === '#pending') {
                row.style.display = row.dataset.status === 'pending' ? '' : 'none';
            } else if (target === '#approved') {
                row.style.display = row.dataset.status === 'approved' ? '' : 'none';
            }
        });
    });
});
</script>
@endsection
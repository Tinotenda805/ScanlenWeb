@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Contact Messages</h1>
    </div>

    {{-- @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif --}}

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-primary border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Total Messages</p>
                            <h3 class="mb-0">{{ $counts['total'] }}</h3>
                        </div>
                        <div class="text-primary">
                            <i class="fa fa-envelope" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-warning border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Unread</p>
                            <h3 class="mb-0">{{ $counts['unread'] }}</h3>
                        </div>
                        <div class="text-warning">
                            <i class="fa fa-envelope-exclamation" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-info border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Read</p>
                            <h3 class="mb-0">{{ $counts['read'] }}</h3>
                        </div>
                        <div class="text-info">
                            <i class="fa fa-envelope-open" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Replied</p>
                            <h3 class="mb-0">{{ $counts['replied'] }}</h3>
                        </div>
                        <div class="text-success">
                            <i class="fa fa-envelope-check" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Filters -->
            <form method="GET" action="{{ route('admin.contact-messages.index') }}" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">All Status</option>
                            <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                            <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Replied</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Search by name, email, or subject..."
                                   value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i> Search
                            </button>
                            @if(request('search') || request('status'))
                            <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">
                                <i class="fa fa-x"></i> Clear
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>

            <!-- Bulk Actions -->
            <form method="POST" action="{{ route('admin.contact-messages.bulk-action') }}" id="bulkActionForm">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex gap-2">
                        <select name="action" class="form-select form-select-sm" style="width: auto;" required>
                            <option value="">Bulk Actions</option>
                            <option value="mark-read">Mark as Read</option>
                            <option value="mark-replied">Mark as Replied</option>
                            <option value="delete">Delete</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-secondary">Apply</button>
                    </div>
                    <div class="text-muted small">
                        Showing {{ $messages->firstItem() ?? 0 }} to {{ $messages->lastItem() ?? 0 }} of {{ $messages->total() }} messages
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="30">
                                    <input type="checkbox" id="selectAll" class="form-check-input">
                                </th>
                                <th>From</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th width="100">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $message)
                            <tr class="{{ $message->status === 'unread' ? 'table-warning' : '' }}">
                                <td>
                                    <input type="checkbox" name="selected[]" value="{{ $message->id }}" class="form-check-input item-checkbox">
                                </td>
                                <td>
                                    <strong>{{ $message->name }}</strong>
                                    <br><small class="text-muted">{{ $message->email }}</small>
                                </td>
                                <td>
                                    <span class="{{ $message->status === 'unread' ? 'fw-bold' : '' }}">
                                        {{ Str::limit($message->subject, 40) }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ Str::limit($message->message, 60) }}</small>
                                </td>
                                <td>
                                    @if($message->status === 'unread')
                                    <span class="badge bg-warning text-dark">Unread</span>
                                    @elseif($message->status === 'read')
                                    <span class="badge bg-info">Read</span>
                                    @else
                                    <span class="badge bg-success">Replied</span>
                                    @endif
                                </td>
                                <td>
                                    <small>{{ $message->created_at->diffForHumans() }}</small>
                                    <br><small class="text-muted">{{ $message->created_at->format('M d, Y H:i') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.contact-messages.show', $message) }}" 
                                           class="btn btn-outline-primary" title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" 
                                                onclick="deleteMessage({{ $message->id }})" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fa fa-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                    <p class="text-muted mt-2">No messages found.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>

            <div class="d-flex justify-content-center mt-4">
                {{ $messages->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
// Select all checkbox
document.getElementById('selectAll').addEventListener('change', function() {
    document.querySelectorAll('.item-checkbox').forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

// Bulk action form validation
document.getElementById('bulkActionForm').addEventListener('submit', function(e) {
    const action = this.querySelector('select[name="action"]').value;
    const selected = this.querySelectorAll('input[name="selected[]"]:checked').length;
    
    if (!action) {
        e.preventDefault();
        alert('Please select an action');
        return;
    }
    
    if (selected === 0) {
        e.preventDefault();
        alert('Please select at least one message');
        return;
    }
    
    if (action === 'delete') {
        if (!confirm(`Are you sure you want to delete ${selected} message(s)?`)) {
            e.preventDefault();
        }
    }
});

// Delete single message
function deleteMessage(id) {
    if (confirm('Are you sure you want to delete this message?')) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/contact-messages/${id}`;
        form.submit();
    }
}
</script>
@endsection
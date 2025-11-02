@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gallery Management</h1>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Item
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.gallery.bulk-action') }}" id="bulkActionForm">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex gap-2">
                        <select name="action" class="form-select form-select-sm" style="width: auto;" required>
                            <option value="">Bulk Actions</option>
                            <option value="activate">Activate</option>
                            <option value="deactivate">Deactivate</option>
                            <option value="delete">Delete</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-secondary">Apply</button>
                    </div>
                    <div class="text-muted small">
                        Total: {{ $gallery->total() }} items
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="30">
                                    <input type="checkbox" id="selectAll" class="form-check-input">
                                </th>
                                <th width="80">Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Badge</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($gallery as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="selected[]" value="{{ $item->id }}" class="form-check-input item-checkbox">
                                </td>
                                <td>
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" 
                                         class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                </td>
                                <td>
                                    <strong>{{ $item->title }}</strong>
                                    @if($item->description)
                                    <br><small class="text-muted">{{ Str::limit($item->description, 50) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ ucwords(str_replace('-', ' ', $item->category)) }}</span>
                                </td>
                                <td>
                                    @if($item->badge_label)
                                    <span class="badge bg-info">{{ $item->badge_label }}</span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $item->order ?? '-' }}</td>
                                <td>
                                    @if($item->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.gallery.edit', $item) }}" 
                                           class="btn btn-outline-primary" title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" 
                                                onclick="deleteItem({{ $item->id }})" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <i class="bi bi-images" style="font-size: 3rem; color: #ccc;"></i>
                                    <p class="text-muted mt-2">No gallery items found.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>

            <div class="d-flex justify-content-center mt-4">
                {{ $gallery->links() }}
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
        alert('Please select at least one item');
        return;
    }
    
    if (action === 'delete') {
        if (!confirm(`Are you sure you want to delete ${selected} item(s)?`)) {
            e.preventDefault();
        }
    }
});

// Delete single item
function deleteItem(id) {
    if (confirm('Are you sure you want to delete this item?')) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/gallery/${id}`;
        form.submit();
    }
}
</script>
@endsection
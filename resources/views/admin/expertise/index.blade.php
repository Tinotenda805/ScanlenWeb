{{-- resources/views/admin/expertise/index.blade.php --}}
@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Expertise Management</h1>
        <a href="{{ route('admin.expertise.create') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle"></i> Add New Expertise
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Bulk Actions --}}
    <form action="{{ route('admin.expertise.bulk-action') }}" method="POST" id="bulkActionForm">
        @csrf
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            {{-- <select name="action" class="form-select" required>
                                <option value="">-- Bulk Actions --</option>
                                <option value="activate">Activate</option>
                                <option value="deactivate">Deactivate</option>
                                <option value="delete">Delete</option>
                            </select>
                            <button type="submit" class="btn btn-secondary">Apply</button> --}}
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <span class="text-muted">Total: {{ $expertise->total() }} expertise</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Expertise Table --}}
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">
                                <input type="checkbox" id="selectAll" class="form-check-input">
                            </th>
                            <th width="80">Image</th>
                            <th>Name</th>
                            <th>Short Description</th>
                            <th width="120">Key Contacts</th>
                            <th width="80">Order</th>
                            <th width="100">Status</th>
                            <th width="80">Featured</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expertise as $item)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected[]" value="{{ $item->id }}" class="form-check-input select-item">
                            </td>
                            <td>
                                <img src="{{ $item->image_url }}" alt="{{ $item->name }}" 
                                     class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            </td>
                            <td>
                                <strong>{{ $item->name }}</strong><br>
                                <small class="text-muted">{{ $item->slug }}</small>
                            </td>
                            <td>{{ Str::limit($item->short_description, 60) }}</td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $item->people_count }}</span>
                            </td>
                            <td class="text-center">{{ $item->order }}</td>
                            <td>
                                <span class="badge bg-{{ $item->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.expertise.toggle-featured', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-link p-0" title="Toggle Featured">
                                        <i class="fa fa-star {{ $item->is_featured ? '-fill text-warning' : '' }}" style="font-size: 1.2rem;"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('expertise.show', $item->slug) }}" 
                                       class="btn btn-outline-info" 
                                       target="_blank" 
                                       title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.expertise.edit', $item->id) }}" 
                                       class="btn btn-outline-primary" 
                                       title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-danger" 
                                            onclick="deleteExpertise({{ $item->id }})"
                                            title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>

                                <form id="delete-form-{{ $item->id }}" 
                                      action="{{ route('admin.expertise.destroy', $item->id) }}" 
                                      method="POST" 
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="fa fa-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                <p class="text-muted mt-3">No expertise found. Create your first one!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($expertise->hasPages())
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    {{ $expertise->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @endif
        </div>
    </form>
</div>

<script>
// Select All Checkbox
document.getElementById('selectAll')?.addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.select-item');
    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
});

// Delete Confirmation
function deleteExpertise(id) {
    if (confirm('Are you sure you want to delete this expertise? This action cannot be undone.')) {
        document.getElementById('delete-form-' + id).submit();
    }
}

// Bulk Action Confirmation
document.getElementById('bulkActionForm')?.addEventListener('submit', function(e) {
    const action = this.querySelector('select[name="action"]').value;
    const selected = this.querySelectorAll('.select-item:checked').length;

    if (!action) {
        e.preventDefault();
        alert('Please select an action.');
        return;
    }

    if (selected === 0) {
        e.preventDefault();
        alert('Please select at least one expertise.');
        return;
    }

    if (action === 'delete') {
        if (!confirm(`Are you sure you want to delete ${selected} expertise? This action cannot be undone.`)) {
            e.preventDefault();
        }
    }
});
</script>

<style>
.table td {
    vertical-align: middle;
}

.btn-group-sm .btn {
    padding: 0.25rem 0.5rem;
}

.badge {
    font-size: 0.8rem;
    padding: 0.35rem 0.65rem;
}
</style>
@endsection
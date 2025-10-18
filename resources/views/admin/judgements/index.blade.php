@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Judgements Management</h1>
        <a href="{{ route('admin.judgements.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Upload Judgement
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Filters --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.judgements.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Search title, case number..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="court" class="form-select">
                            <option value="">All Courts</option>
                            @foreach($courts as $court)
                                <option value="{{ $court }}" {{ request('court') == $court ? 'selected' : '' }}>
                                    {{ $court }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="category" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-secondary w-100">
                            <i class="bi bi-search"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Bulk Actions --}}
    <form action="{{ route('admin.judgements.bulk-action') }}" method="POST" id="bulkActionForm">
        @csrf
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select name="action" class="form-select" required>
                                <option value="">-- Bulk Actions --</option>
                                <option value="activate">Activate</option>
                                <option value="deactivate">Deactivate</option>
                                <option value="feature">Mark as Featured</option>
                                <option value="unfeature">Unmark as Featured</option>
                                <option value="delete">Delete</option>
                            </select>
                            <button type="submit" class="btn btn-secondary">Apply</button>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <span class="text-muted">Total: {{ $judgements->total() }} judgements</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Judgements Table --}}
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">
                                <input type="checkbox" id="selectAll" class="form-check-input">
                            </th>
                            <th>Title</th>
                            <th>Case Number</th>
                            <th>Court</th>
                            <th>Date</th>
                            <th>File</th>
                            <th width="80">Downloads</th>
                            <th width="80">Featured</th>
                            <th width="100">Status</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($judgements as $item)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected[]" value="{{ $item->id }}" class="form-check-input select-item">
                            </td>
                            <td>
                                <strong>{{ $item->title }}</strong>
                                @if($item->category)
                                    <br><small class="text-muted">{{ $item->category->name }}</small>
                                @endif
                            </td>
                            <td>{{ $item->case_number ?? 'N/A' }}</td>
                            <td>{{ $item->court ?? 'N/A' }}</td>
                            <td>{{ $item->judgement_date ? $item->judgement_date->format('M d, Y') : 'N/A' }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ strtoupper($item->file_type) }}</span>
                                <br><small class="text-muted">{{ $item->formatted_file_size }}</small>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.judgements.download-stats', $item) }}" 
                                   class="badge bg-info text-decoration-none"
                                   title="View download statistics">
                                    {{ $item->download_count }}
                                </a>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.judgements.toggle-featured', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-link p-0" title="Toggle Featured">
                                        <i class="bi bi-star{{ $item->is_featured ? '-fill text-warning' : '' }}" style="font-size: 1.2rem;"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <span class="badge bg-{{ $item->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ $item->file_url }}" 
                                       class="btn btn-outline-info" 
                                       target="_blank" 
                                       title="View File">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.judgements.edit', $item) }}" 
                                       class="btn btn-outline-primary" 
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-danger" 
                                            onclick="deleteJudgement({{ $item->id }})"
                                            title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>

                                <form id="delete-form-{{ $item->id }}" 
                                      action="{{ route('admin.judgements.destroy', $item) }}" 
                                      method="POST" 
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-5">
                                <i class="bi bi-file-earmark-text" style="font-size: 3rem; color: #ccc;"></i>
                                <p class="text-muted mt-3">No judgements found. Upload your first one!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($judgements->hasPages())
            <div class="card-footer">
                <div class="d-flex justify-content-center">
                    {{ $judgements->appends(request()->query())->links() }}
                </div>
            </div>
            @endif
        </div>
    </form>
</div>

<script>
// Select All
document.getElementById('selectAll')?.addEventListener('change', function() {
    document.querySelectorAll('.select-item').forEach(cb => cb.checked = this.checked);
});

// Delete Confirmation
function deleteJudgement(id) {
    if (confirm('Are you sure you want to delete this judgement? This will also delete the file.')) {
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
        alert('Please select at least one judgement.');
        return;
    }

    if (action === 'delete') {
        if (!confirm(`Are you sure you want to delete ${selected} judgement(s)? This will also delete the files.`)) {
            e.preventDefault();
        }
    }
});
</script>
@endsection
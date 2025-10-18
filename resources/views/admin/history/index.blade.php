@extends('admin.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">History Timeline Management</h1>
        <a href="{{ route('admin.history.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Timeline Entry
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="80">Image</th>
                        <th>Decade</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th width="100">Highlights</th>
                        <th width="80">Order</th>
                        <th width="100">Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($timelines as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->image_url }}" alt="{{ $item->decade }}" 
                                 class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td><strong>{{ $item->decade }}</strong></td>
                        <td>{{ $item->title }}</td>
                        <td>{{ Str::limit($item->description, 80) }}</td>
                        <td class="text-center">
                            <span class="badge bg-info">{{ count($item->highlights ?? []) }}</span>
                        </td>
                        <td class="text-center">{{ $item->order }}</td>
                        <td>
                            <span class="badge bg-{{ $item->status === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('admin.history.edit', $item) }}" 
                                   class="btn btn-outline-primary" 
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-outline-danger" 
                                        onclick="deleteItem({{ $item->id }})"
                                        title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                            <form id="delete-form-{{ $item->id }}" 
                                  action="{{ route('admin.history.destroy', $item) }}" 
                                  method="POST" 
                                  class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="bi bi-clock-history" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">No timeline entries found. Create your first one!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($timelines->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {{ $timelines->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<script>
function deleteItem(id) {
    if (confirm('Are you sure you want to delete this timeline entry?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endsection

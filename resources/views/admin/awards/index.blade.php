@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Awards</h1>
        <a href="{{ route('admin.awards.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-2"></i> Add New Award
        </a>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Organization</th>
                        <th>Year</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($awards as $award)
                        <tr>
                            <td>
                                @if($award->image)
                                    <img src="{{ $award->image_url }}" alt="{{ $award->title }}" 
                                            class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                            style="width: 60px; height: 60px;">
                                        <i class="fas fa-trophy text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $award->title }}</strong>
                                @if($award->description)
                                    <br><small class="text-muted">{{ Str::limit($award->description, 50) }}</small>
                                @endif
                            </td>
                            <td>{{ $award->issuing_organization }}</td>
                            <td>{{ $award->year }}</td>
                            <td>
                                @if($award->category)
                                    <span class="badge bg-secondary">{{ $award->category }}</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.awards.toggle-status', $award) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm {{ $award->is_active ? 'btn-success' : 'btn-secondary' }}">
                                        {{ $award->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td>{{ $award->display_order }}</td>
                            <td>
                                <div class="btn-group btn-group-sm ">
                                    <a href="{{ route('admin.awards.edit', $award) }}" 
                                        class="btn btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="submit" class="btn btn-outline-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $award->id }}"
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>


                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $award->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete Award Post</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('admin.awards.destroy', $award) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        Are you sure you want to delete "<strong>{{ $award->title }}</strong>"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-trophy fa-2x text-muted mb-3"></i>
                                <p class="text-muted">No awards found.</p>
                                <a href="{{ route('admin.awards.create') }}" class="btn btn-maroon">
                                    Add Your First Award
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
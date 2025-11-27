@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0"></h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.blogs.comments.index') }}" class="btn btn-info">
                <i class="fas fa-comments me-2"></i>Manage Comments
            </a>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>New Blog Post
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Comments</th>
                            <th>Views</th>
                            <th>Published</th>
                            <th style="width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $blog)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($blog->featured_image)
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                                            class="rounded me-2" 
                                            width="50" height="50" 
                                            style="object-fit: cover;">
                                    @endif
                                    <div>
                                        <strong>{{ Str::limit($blog->title, 40) }}</strong>
                                        @if($blog->is_featured)
                                        <span class="badge bg-warning text-dark ms-1">Featured</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <small>{{ $blog->author_name ?? 'N/A' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $blog->category->name }}</span>
                            </td>
                            <td>
                                @if($blog->is_published)
                                <span class="badge bg-success">Published</span>
                                @else
                                <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-info">{{ $blog->comments_count }}</span>
                                    @if($blog->comments_enabled)
                                    <i class="fas fa-comment-dots text-success" title="Comments enabled"></i>
                                    @else
                                    <i class="fas fa-comment-slash text-muted" title="Comments disabled"></i>
                                    @endif
                                </div>
                            </td>
                            <td>{{ number_format($blog->views) }}</td>
                            <td>{{ $blog->published_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('blogs.show', $blog->slug) }}" 
                                        class="btn btn-outline-info" 
                                        target="_blank"
                                        title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.blogs.edit', $blog) }}" 
                                        class="btn btn-outline-primary"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <!-- Toggle Comments -->
                                    <form action="{{ route('admin.blogs.toggle-comments', $blog) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn {{ $blog->comments_enabled ? 'btn-outline-success' : 'btn-outline-secondary' }}" 
                                                title="{{ $blog->comments_enabled ? 'Disable Comments' : 'Enable Comments' }}">
                                            <i class="fas fa-comment{{ $blog->comments_enabled ? '-dots' : '-slash' }}"></i>
                                        </button>
                                    </form>
                                    
                                    <button type="button" 
                                            class="btn btn-outline-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $blog->id }}"
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $blog->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Blog Post</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    Are you sure you want to delete "<strong>{{ $blog->title }}</strong>"?
                                                    @if($blog->comments_count > 0)
                                                    <div class="alert alert-warning mt-3">
                                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                                        This will also delete {{ $blog->comments_count }} comment(s).
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <p class="text-muted mb-0">No blog posts found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-4 px-3 pb-3">
            {{ $blogs->links("pagination::bootstrap-5") }}
        </div>
    </div>
</div>
@endsection
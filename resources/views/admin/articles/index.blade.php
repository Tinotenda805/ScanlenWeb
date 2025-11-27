@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Articles</h1>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>New Article
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Authors</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>SEO</th>
                            <th>Readability</th>
                            <th>Views</th>
                            <th>Published</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($article->featured_image)
                                    <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                         class="rounded me-2" 
                                         width="50" height="50" 
                                         style="object-fit: cover;">
                                    @endif
                                    <div>
                                        <strong>{{ Str::limit($article->title, 40) }}</strong>
                                        @if($article->is_featured)
                                        <span class="badge bg-warning text-dark ms-1">Featured</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <small>{{ $article->authors->pluck('name')->join(', ') }}</small>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $article->category->name }}</span>
                            </td>
                            
                            <td>
                                @if($article->is_published)
                                <span class="badge bg-success">Published</span>
                                @else
                                <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $article->getSeoStatusColor() }}" 
                                      title="SEO Score: {{ $article->seo_score }}%">
                                    {{ $article->seo_score }}%
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $article->getReadabilityStatusColor() }}" 
                                      title="Readability Score: {{ $article->readability_score }}%">
                                    {{ $article->readability_score }}%
                                </span>
                            </td>
                            <td>{{ number_format($article->views) }}</td>
                            <td>{{ $article->published_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('articles.show', $article->slug) }}" 
                                       class="btn btn-outline-info" 
                                       target="_blank"
                                       title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.articles.edit', $article) }}" 
                                       class="btn btn-outline-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $article->id }}"
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $article->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Article</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    Are you sure you want to delete "<strong>{{ $article->title }}</strong>"?
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
                            <td colspan="7" class="text-center py-4">
                                <p class="text-muted mb-0">No articles found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end mt-4">
        {{ $articles->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
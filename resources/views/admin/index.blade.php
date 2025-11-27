@extends('admin.app')

@section('content')
<div class="container-fluid px-4 py-4">

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Articles</h6>
                            <h2 class="mb-0">{{ $stats['total_articles'] }}</h2>
                            <small class="text-success">{{ $stats['published_articles'] }} published</small>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="fas fa-newspaper fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Blogs</h6>
                            <h2 class="mb-0">{{ $stats['total_blogs'] }}</h2>
                            <small class="text-success">{{ $stats['published_blogs'] }} published</small>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="fas fa-blog fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Our People</h6>
                            <h2 class="mb-0">{{ $stats['total_people'] }}</h2>
                            <small class="text-info">{{ $stats['partners'] }} partners, {{ $stats['associates'] }} associates</small>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Categories & Tags</h6>
                            <h2 class="mb-0">{{ $stats['total_categories'] + $stats['total_tags'] }}</h2>
                            <small class="text-warning">{{ $stats['total_categories'] }} categories, {{ $stats['total_tags'] }} tags</small>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="fas fa-tags fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Quick Actions</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>New Article
                        </a>
                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>New Blog Post
                        </a>
                        <a href="{{ route('admin.people.create') }}" class="btn btn-info">
                            <i class="fas fa-plus me-2"></i>Add Person
                        </a>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus me-2"></i>New Category
                        </a>
                        <a href="{{ route('admin.tags.create') }}" class="btn btn-secondary">
                            <i class="fas fa-plus me-2"></i>New Tag
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Content -->
    <div class="row g-4">
        <!-- Recent Articles -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Articles</h5>
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($recentArticles as $article)
                    <div class="d-flex align-items-start mb-3 pb-3 border-bottom">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ Str::limit($article->title, 50) }}</h6>
                            <small class="text-muted">
                                By {{ $article->authors->pluck('name')->join(', ') }} • 
                                {{ $article->category->name }} • 
                                {{ $article->created_at->diffForHumans() }}
                            </small>
                            <div class="mt-1">
                                @if($article->is_published)
                                <span class="badge bg-success">Published</span>
                                @else
                                <span class="badge bg-secondary">Draft</span>
                                @endif
                                @if($article->is_featured)
                                <span class="badge bg-warning">Featured</span>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    </div>
                    @empty
                    <p class="text-muted text-center py-3">No articles yet</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Blogs -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Blog Posts</h5>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-outline-success">View All</a>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($recentBlogs as $blog)
                    <div class="d-flex align-items-start mb-3 pb-3 border-bottom">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ Str::limit($blog->title, 50) }}</h6>
                            <small class="text-muted">
                                @if($blog->author_name)By {{ $blog->author_name }} • @endif
                                {{ $blog->category->name }} • 
                                {{ $blog->created_at->diffForHumans() }}
                            </small>
                            <div class="mt-1">
                                @if($blog->is_published)
                                <span class="badge bg-success">Published</span>
                                @else
                                <span class="badge bg-secondary">Draft</span>
                                @endif
                                @if($blog->is_featured)
                                <span class="badge bg-warning">Featured</span>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    </div>
                    @empty
                    <p class="text-muted text-center py-3">No blog posts yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
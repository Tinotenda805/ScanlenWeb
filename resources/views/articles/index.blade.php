@extends('layouts.app')

@section('content')
@include('layouts.page-header', ['title' => 'Articles', 'breadcrumb' => 'Articles'])

<!-- Featured Articles Section -->
@if($featuredArticles->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold">Featured Articles</h2>
                <p class="text-muted">Handpicked articles worth your time</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($featuredArticles as $featured)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    @if($featured->featured_image)
                    <img src="{{ asset('storage/' . $featured->featured_image) }}" class="card-img-top" alt="{{ $featured->title }}" style="height: 220px; object-fit: cover;">
                    @else
                    <div class="bg-gradient bg-maroon text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                        <i class="bi bi-newspaper fs-1"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-maroon me-2">{{ $featured->category->name }}</span>
                            <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ $featured->reading_time }}</small>
                        </div>
                        <h5 class="card-title fw-bold mb-2">{{ Str::limit($featured->title, 60) }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($featured->excerpt, 100) }}</p>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div class="d-flex align-items-center">
                                @foreach($featured->authors->take(2) as $author)
                                <img src="{{ $author->avatar ? asset('storage/' . $author->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($author->name) }}" 
                                     class="rounded-circle me-2" width="30" height="30" alt="{{ $author->name }}">
                                @endforeach
                                <small class="text-muted">{{ $featured->authors->first()->name }}</small>
                            </div>
                            <a href="{{ route('articles.show', $featured->slug) }}" class="btn btn-sm btn-maroon-outline">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Main Articles Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Articles Grid -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">All Articles</h3>
                    <form action="{{ route('articles.index') }}" method="GET" class="d-flex">
                        <input type="search" name="search" class="form-control me-2" placeholder="Search articles..." value="{{ request('search') }}" style="max-width: 300px;">
                        <button type="submit" class="btn btn-maroon-new">Search</button>
                    </form>
                </div>

                <div class="row g-4">
                    @forelse($articles as $article)
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            @if($article->featured_image)
                            <img src="{{ asset('storage/' . $article->featured_image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                            @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="bi bi-file-text fs-1"></i>
                            </div>
                            @endif
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge bg-secondary me-2">{{ $article->category->name }}</span>
                                    <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ $article->reading_time }}</small>
                                </div>
                                <h5 class="card-title fw-bold">{{ Str::limit($article->title, 70) }}</h5>
                                <p class="card-text text-muted small">{{ Str::limit($article->excerpt, 120) }}</p>
                                
                                @if($article->tags->count() > 0)
                                <div class="mb-3">
                                    @foreach($article->tags->take(3) as $tag)
                                    <a href="{{ route('articles.index', ['tag' => $tag->slug]) }}" class="badge bg-light text-dark text-decoration-none me-1">#{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                                @endif

                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $article->authors->first()->avatar ? asset('storage/' . $article->authors->first()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($article->authors->first()->name) }}" 
                                             class="rounded-circle me-2" width="32" height="32" alt="{{ $article->authors->first()->name }}">
                                        <div>
                                            <small class="d-block fw-semibold">{{ $article->authors->first()->name }}</small>
                                            <small class="text-muted">{{ $article->published_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                    <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-sm btn-maroon-new">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info">No articles found.</div>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-5">
                    {{ $articles->links() }}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <!-- Categories Widget -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Categories</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach($categories as $category)
                                <li class="mb-2">
                                    <a href="{{ route('articles.index', ['category' => $category->slug]) }}" 
                                       class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                                        <span>{{ $category->name }}</span>
                                        <span class="badge bg-light text-dark">{{ $category->articles_count }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Popular Tags -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Popular Tags</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($popularTags as $tag)
                                <a href="{{ route('articles.index', ['tag' => $tag->slug]) }}" 
                                   class="badge bg-maroon text-decoration-none">#{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15) !important;
}
</style>
@endsection
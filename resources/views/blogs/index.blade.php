@extends('layouts.app')

@section('content')
@include('layouts.page-header', ['title' => 'Blogs', 'breadcrumb' => 'Blog'])

<!-- Featured Blogs Section -->
@if($featuredBlogs->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold">Featured Posts</h2>
                <p class="text-muted">Don't miss these amazing posts</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($featuredBlogs as $featured)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    @if($featured->featured_image)
                    <img src="{{ asset('storage/' . $featured->featured_image) }}" class="card-img-top" alt="{{ $featured->title }}" style="height: 220px; object-fit: cover;">
                    @else
                    <div class="bg-gradient bg-maroon text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                        <i class="bi bi-journal-text fs-1"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-maroon me-2">{{ $featured->category->name }}</span>
                            <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ $featured->reading_time }} min read</small>
                        </div>
                        <h5 class="card-title fw-bold mb-2">{{ Str::limit($featured->title, 60) }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($featured->excerpt, 100) }}</p>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div class="d-flex align-items-center">
                                @if($featured->author_name)
                                <div class="rounded-circle bg-maroon text-white d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                                    {{ strtoupper(substr($featured->author_name, 0, 1)) }}
                                </div>
                                <small class="text-muted">{{ $featured->author_name }}</small>
                                @endif
                            </div>
                            <a href="{{ route('blogs.show', $featured->slug) }}" class="btn btn-sm btn-maroon-outline">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Main Blogs Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Blogs Grid -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">Latest Posts</h3>
                    <form action="{{ route('blogs.index') }}" method="GET" class="d-flex">
                        <input type="search" name="search" class="form-control me-2" placeholder="Search blog posts..." value="{{ request('search') }}" style="max-width: 300px;">
                        <button type="submit" class="btn btn-maroon-new">Search</button>
                    </form>
                </div>

                <div class="row g-4">
                    @forelse($blogs as $blog)
                    <div class="col-12">
                        <div class="card border-0 shadow-sm hover-shadow">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    @if($blog->featured_image)
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                                         class="img-fluid rounded-start h-100" 
                                         alt="{{ $blog->title }}" 
                                         style="object-fit: cover; min-height: 250px;">
                                    @else
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded-start h-100" style="min-height: 250px;">
                                        <i class="bi bi-journal-text fs-1"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body h-100 d-flex flex-column">
                                        <div>
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-maroon me-2">{{ $blog->category->name }}</span>
                                                <small class="text-muted">{{ $blog->published_at->format('M d, Y') }}</small>
                                                <span class="mx-2">•</span>
                                                <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ $blog->reading_time }} min read</small>
                                            </div>
                                            <h4 class="card-title fw-bold mb-3">{{ $blog->title }}</h4>
                                            <p class="card-text text-muted">{{ Str::limit($blog->excerpt, 180) }}</p>
                                        </div>
                                        
                                        @if($blog->tags->count() > 0)
                                        <div class="mb-3">
                                            @foreach($blog->tags->take(4) as $tag)
                                            <a href="{{ route('blogs.index', ['tag' => $tag->slug]) }}" 
                                               class="badge bg-light text-dark text-decoration-none me-1">#{{ $tag->name }}</a>
                                            @endforeach
                                        </div>
                                        @endif

                                        <div class="mt-auto d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                @if($blog->author_name)
                                                <div class="rounded-circle bg-maroon text-white d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-size: 14px;">
                                                    {{ strtoupper(substr($blog->author_name, 0, 2)) }}
                                                </div>
                                                <small class="fw-semibold">{{ $blog->author_name }}</small>
                                                @endif
                                            </div>
                                            <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-maroon-new">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info">No blog posts found.</div>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-5">
                    {{ $blogs->links('pagination::bootstrap-5') }}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <!-- Newsletter Widget -->
                    <div class="card border-0 shadow-sm bg-maroon text-white mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Subscribe to our Newsletter</h5>
                            <p class="small mb-3">Get the latest blog posts delivered straight to your inbox.</p>
                            <form>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Your email address" required>
                                </div>
                                <button type="submit" class="btn btn-light w-100">Subscribe</button>
                            </form>
                        </div>
                    </div>

                    <!-- Categories Widget -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Categories</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                   <a href="{{route('blogs.index')}}" class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                                        <span>ALL</span>
                                        <span class="badge bg-light text-dark">{{ $blogs->count() }}</span>
                                    </a> 
                                </li>
                                @foreach($categories as $category)
                                <li class="mb-2">
                                    <a href="{{ route('blogs.index', ['category' => $category->slug]) }}" 
                                       class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                                        <span><i class="bi bi-folder me-2"></i>{{ $category->name }}</span>
                                        <span class="badge bg-light text-dark">{{ $category->blogs_count }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Popular Tags -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Trending Topics</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($popularTags as $tag)
                                <a href="{{ route('blogs.index', ['tag' => $tag->slug]) }}" 
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
.hover-shadow {
    transition: box-shadow 0.3s ease;
}
.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15) !important;
}
</style>
@endsection
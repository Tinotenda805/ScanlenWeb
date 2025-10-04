@extends('layouts.app')

@section('content')
@include('layouts.page-header', ['title' => $blog->title, 'breadcrumb' => 'Blog Post'])

<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Blog Content -->
            <div class="col-lg-8 mx-auto">
                <article class="mb-5">
                    <!-- Blog Header -->
                    <div class="mb-4">
                        <span class="badge bg-success mb-3">{{ $blog->category->name }}</span>
                        <h1 class="display-5 fw-bold mb-3">{{ $blog->title }}</h1>
                        <p class="lead text-muted">{{ $blog->excerpt }}</p>
                    </div>

                    <!-- Blog Meta -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between border-top border-bottom py-3 mb-4">
                        <div class="d-flex align-items-center mb-2 mb-md-0">
                            @if($blog->author_name)
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; font-size: 18px;">
                                {{ strtoupper(substr($blog->author_name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="fw-semibold">{{ $blog->author_name }}</div>
                                <small class="text-muted">{{ $blog->published_at->format('F d, Y') }}</small>
                            </div>
                            @else
                            <small class="text-muted">Published on {{ $blog->published_at->format('F d, Y') }}</small>
                            @endif
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-3"><i class="bi bi-clock me-1"></i>{{ $blog->reading_time }} min read</span>
                            <span><i class="bi bi-eye me-1"></i>{{ number_format($blog->views) }} views</span>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    @if($blog->featured_image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                             class="img-fluid rounded shadow-sm w-100" 
                             alt="{{ $blog->title }}"
                             style="max-height: 500px; object-fit: cover;">
                    </div>
                    @endif

                    <!-- Blog Content -->
                    <div class="blog-content fs-5 lh-lg">
                        {!! nl2br(e($blog->content)) !!}
                    </div>

                    <!-- Tags -->
                    @if($blog->tags->count() > 0)
                    <div class="mt-5 pt-4 border-top">
                        <h6 class="fw-bold mb-3">Tags:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($blog->tags as $tag)
                            <a href="{{ route('blogs.index', ['tag' => $tag->slug]) }}" 
                               class="badge bg-light text-dark text-decoration-none px-3 py-2">#{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="mt-4 pt-4 border-top">
                        <h6 class="fw-bold mb-3">Share this post:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blogs.show', $blog->slug)) }}&text={{ urlencode($blog->title) }}" 
                               class="btn btn-outline-success" target="_blank">
                                <i class="bi bi-twitter me-1"></i> Twitter
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blogs.show', $blog->slug)) }}" 
                               class="btn btn-outline-success" target="_blank">
                                <i class="bi bi-facebook me-1"></i> Facebook
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blogs.show', $blog->slug)) }}" 
                               class="btn btn-outline-success" target="_blank">
                                <i class="bi bi-linkedin me-1"></i> LinkedIn
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . route('blogs.show', $blog->slug)) }}" 
                               class="btn btn-outline-success" target="_blank">
                                <i class="bi bi-whatsapp me-1"></i> WhatsApp
                            </a>
                            <button class="btn btn-outline-success" onclick="copyToClipboard()">
                                <i class="bi bi-link-45deg me-1"></i> Copy Link
                            </button>
                        </div>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="mt-5 pt-4 border-top">
                        <div class="card border-0 bg-light">
                            <div class="card-body text-center py-5">
                                <h4 class="fw-bold mb-3">Enjoyed this post?</h4>
                                <p class="text-muted mb-4">Subscribe to get more content like this delivered to your inbox.</p>
                                <form class="row g-2 justify-content-center">
                                    <div class="col-auto" style="min-width: 300px;">
                                        <input type="email" class="form-control" placeholder="Enter your email" required>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-success">Subscribe</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Related Blogs -->
                @if($relatedBlogs->count() > 0)
                <div class="mt-5 pt-5 border-top">
                    <h3 class="fw-bold mb-4">You Might Also Like</h3>
                    <div class="row g-4">
                        @foreach($relatedBlogs as $related)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm hover-lift">
                                @if($related->featured_image)
                                <img src="{{ asset('storage/' . $related->featured_image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $related->title }}" 
                                     style="height: 180px; object-fit: cover;">
                                @else
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 180px;">
                                    <i class="bi bi-journal-text fs-1"></i>
                                </div>
                                @endif
                                <div class="card-body">
                                    <span class="badge bg-success mb-2">{{ $related->category->name }}</span>
                                    <h6 class="card-title fw-bold">{{ Str::limit($related->title, 60) }}</h6>
                                    <p class="card-text text-muted small">{{ Str::limit($related->excerpt, 80) }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <small class="text-muted">{{ $related->published_at->format('M d, Y') }}</small>
                                        <a href="{{ route('blogs.show', $related->slug) }}" class="btn btn-sm btn-outline-success">Read</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Comments Section -->
                <div class="mt-5 pt-5 border-top">
                    <h3 class="fw-bold mb-4">Leave a Comment</h3>
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="commentName" class="form-label">Name *</label>
                                <input type="text" class="form-control" id="commentName" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="commentEmail" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="commentEmail" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="commentMessage" class="form-label">Comment *</label>
                            <textarea class="form-control" id="commentMessage" rows="5" placeholder="Your Comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Post Comment</button>
                    </form>

                    <!-- Sample Comments (Optional) -->
                    <div class="mt-5">
                        <h5 class="fw-bold mb-4">Comments (0)</h5>
                        <div class="text-muted text-center py-4">
                            <p>No comments yet. Be the first to comment!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.blog-content {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
}
.blog-content p {
    margin-bottom: 1.5rem;
}
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15) !important;
}
</style>

<script>
function copyToClipboard() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(function() {
        alert('Link copied to clipboard!');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
@endsection
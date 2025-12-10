@extends('layouts.app')

@section('content')
@include('layouts.page-blog', ['title' => $blog->title, 'breadcrumb' => 'Blog Post'])

<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Blog Content -->
            <div class="col-lg-12 mx-auto">
                <article class="mb-5">
                    <!-- Blog Header -->
                    <div class="mb-4">
                        <span class="badge bg-maroon mb-3">{{ $blog->category->name }}</span>
                        <h1 class="display-5 fw-bold mb-3">{{ $blog->title }}</h1>
                        <p class="lead text-muted">{{ $blog->excerpt }}</p>
                    </div>

                    <!-- Blog Meta -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between border-top border-bottom py-3 mb-4">
                        <div class="d-flex align-items-center mb-2 mb-md-0">
                            @if($blog->author_name)
                            <div class="rounded-circle bg-maroon text-white d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; font-size: 18px;">
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
                    <div class="blog-content fs-5 lh-base " style="align-items:stretch">
                        {{-- {!! nl2br(e($blog->content)) !!} --}}
                        {!! $blog->content !!}
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
                               class="btn btn-maroon-outline" target="_blank">
                                <i class="bi bi-twitter me-1"></i> Twitter
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blogs.show', $blog->slug)) }}" 
                               class="btn btn-maroon-outline" target="_blank">
                                <i class="bi bi-facebook me-1"></i> Facebook
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blogs.show', $blog->slug)) }}" 
                               class="btn btn-maroon-outline" target="_blank">
                                <i class="bi bi-linkedin me-1"></i> LinkedIn
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . route('blogs.show', $blog->slug)) }}" 
                               class="btn btn-maroon-outline" target="_blank">
                                <i class="bi bi-whatsapp me-1"></i> WhatsApp
                            </a>
                            <button class="btn btn-maroon-outline" onclick="copyToClipboard()">
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
                                        <button type="submit" class="btn btn-maroon-new">Subscribe</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Comments Section -->
                @if($blog->comments_enabled)
                <div class="mt-5 pt-5 border-top" id="comments-section">
                    <h3 class="fw-bold mb-4">Comments ({{ $blog->approvedComments->count() }})</h3>

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <!-- Comment Form -->
                    <div class="card border-0 shadow-sm mb-5">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Leave a Comment</h5>
                            <form action="{{ route('blogs.comments.store', $blog->slug) }}" method="POST">
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="commentName" class="form-label">Name *</label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="commentName" 
                                               name="name"
                                               value="{{ old('name') }}"
                                               placeholder="Your Name" 
                                               required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="commentEmail" class="form-label">Email *</label>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="commentEmail" 
                                               name="email"
                                               value="{{ old('email') }}"
                                               placeholder="Your Email" 
                                               required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Your email will not be published</small>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="commentMessage" class="form-label">Comment *</label>
                                    <textarea class="form-control @error('comment') is-invalid @enderror" 
                                              id="commentMessage" 
                                              name="comment"
                                              rows="5" 
                                              placeholder="Share your thoughts..." 
                                              required>{{ old('comment') }}</textarea>
                                    @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-maroon-new">
                                    <i class="bi bi-send me-2"></i>Post Comment
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Display Comments -->
                    @if($blog->approvedComments->count() > 0)
                        <div class="comments-section">
                            <h5 class="mb-4">{{ $blog->approvedComments->count() }} {{ Str::plural('Comment', $blog->approvedComments->count()) }}</h5>
                            
                            <div class="comments-list">
                                @foreach($blog->approvedComments as $comment)
                                <div class="comment-card mb-4">
                                    <div class="d-flex">
                                        <!-- Avatar -->
                                        <div class="flex-shrink-0">
                                            <div class="avatar-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                                style="width: 44px; height: 44px; font-size: 16px; font-weight: 600;">
                                                {{ strtoupper(substr($comment->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        
                                        <!-- Comment Content -->
                                        <div class="flex-grow-1 ms-3">
                                            <!-- Comment Header -->
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <div>
                                                    <h6 class="mb-0 fw-bold text-dark">{{ $comment->name }}</h6>
                                                    <small class="text-muted">@_{{ 
                                                        \Illuminate\Support\Str::of($comment->name)
                                                            ->before(' ')
                                                            ->lower()
                                                            ->append(
                                                                \Illuminate\Support\Str::of($comment->name)
                                                                    ->after(' ')
                                                                    ->before(' ')
                                                                    ->substr(0, 1)
                                                                    ->lower()
                                                            )
                                                    }}</small>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-link text-muted p-0" type="button" data-bs-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href=""><i class="fas fa-flag me-2"></i>Report</a></li>
                                                        <li><a class="dropdown-item" href=""><i class="fas fa-ban me-2"></i>Block</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <!-- Comment Timestamp -->
                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            
                                            <!-- Comment Text -->
                                            <div class="comment-text mt-2">
                                                <p class="mb-2 text-dark">{{ $comment->comment }}</p>
                                            </div>
                                            
                                            <!-- Comment Actions -->
                                            <div class="comment-actions d-flex align-items-center mt-2">
                                                <button class="btn btn-sm btn-link text-muted p-0 me-3 like-btn">
                                                    <i class="far fa-heart me-1"></i>
                                                    <span class="like-count">12</span>
                                                </button>
                                                
                                                <button class="btn btn-sm btn-link text-muted p-0 me-3 reply-btn">
                                                    <i class="far fa-comment me-1"></i>
                                                    Reply
                                                </button>
                                                
                                                <button class="btn btn-sm btn-link text-muted p-0 share-btn">
                                                    <i class="far fa-share-square me-1"></i>
                                                    Share
                                                </button>
                                            </div>
                                            
                                            <!-- Reply Section (Optional) -->
                                            <div class="reply-section mt-3 d-none">
                                                <form class="reply-form">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm" placeholder="Write a reply...">
                                                        <button class="btn btn-primary btn-sm" type="submit">Reply</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                    <div class="text-center py-5 bg-light rounded">
                        <i class="bi bi-chat-dots fs-1 text-muted mb-3 d-block"></i>
                        <p class="text-muted mb-0">No comments yet. Be the first to comment!</p>
                    </div>
                    @endif
                </div>
                @else
                <div class="mt-5 pt-5 border-top text-center py-5 bg-light rounded">
                    <i class="bi bi-chat-dots-fill fs-1 text-muted mb-3 d-block"></i>
                    <p class="text-muted mb-0">Comments are currently disabled for this post.</p>
                </div>
                @endif

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
                                    <span class="badge bg-maroon mb-2">{{ $related->category->name }}</span>
                                    <h6 class="card-title fw-bold">{{ Str::limit($related->title, 60) }}</h6>
                                    <p class="card-text text-muted small">{{ Str::limit($related->excerpt, 80) }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <small class="text-muted">{{ $related->published_at->format('M d, Y') }}</small>
                                        <a href="{{ route('blogs.show', $related->slug) }}" class="btn btn-sm btn-maroon-outline">Read</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<style>
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

.comments-section {
    max-width: 100%;
}

.comment-card {
    background: #fff;
    border-radius: 12px;
    padding: 16px;
    transition: all 0.2s ease;
    border: 1px solid #e0e0e0;
}

.comment-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transform: translateY(-1px);
}

.avatar-circle {
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    font-weight: 600;
}

.comment-text {
    line-height: 1.5;
    font-size: 15px;
}

.comment-actions .btn-link {
    text-decoration: none;
    font-size: 13px;
    transition: all 0.2s ease;
}

.comment-actions .btn-link:hover {
    color: #007bff !important;
    transform: scale(1.05);
}

.like-btn.active {
    color: #e74c3c !important;
}

.like-btn.active i {
    font-weight: 900;
}

.dropdown-toggle::after {
    display: none;
}

.reply-form .form-control {
    border-radius: 20px;
    border: 1px solid #ddd;
}

.reply-form .btn {
    border-radius: 20px;
    margin-left: 8px;
}

/* Social media inspired colors */
.text-muted {
    color: #65676b !important;
}

.bg-primary {
    background: linear-gradient(135deg, #0095f6, #007bff) !important;
}

/* Responsive design */
@media (max-width: 768px) {
    .comment-card {
        padding: 12px;
        margin-bottom: 16px;
    }
    
    .avatar-circle {
        width: 40px !important;
        height: 40px !important;
        font-size: 14px !important;
    }
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

// Scroll to comments if there's a success message
@if(session('success') || session('error'))
document.addEventListener('DOMContentLoaded', function() {
    const commentsSection = document.getElementById('comments-section');
    if (commentsSection) {
        commentsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
});
@endif
</script>
@endsection
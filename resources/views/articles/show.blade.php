@extends('layouts.app')

@section('content')
@include('layouts.page-Currentheader', ['title' => $article->title, 'breadcrumb' => 'Article'])

<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Article Content -->
            <div class="col-lg-8 mx-auto">
                <!-- Article Header -->
                <article class="mb-5">
                    <div class="mb-4">
                        <span class="badge badge-maroon mb-3">{{ $article->category->name }}</span>
                        <h1 class="display-5 fw-bold mb-3">{{ $article->title }}</h1>
                        <p class="lead text-muted">{{ $article->excerpt }}</p>
                    </div>

                    <!-- Article Meta -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between border-top border-bottom py-3 mb-4">
                        <div class="d-flex align-items-center mb-2 mb-md-0">
                            <div class="d-flex me-3">
                                @foreach($article->authors as $author)
                                <img src="{{ $author->avatar ? asset('storage/' . $author->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($author->name) }}" 
                                     class="rounded-circle border border-2 border-white" 
                                     width="40" height="40" 
                                     alt="{{ $author->name }}"
                                     style="margin-left: {{ $loop->first ? '0' : '-10px' }}">
                                @endforeach
                            </div>
                            <div>
                                <div class="fw-semibold">
                                    {{ $article->authors->pluck('name')->join(', ', ' & ') }}
                                </div>
                                <small class="text-muted">{{ $article->published_at->format('F d, Y') }}</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-3"><i class="bi bi-clock me-1"></i>{{ $article->reading_time }}</span>
                            <span><i class="bi bi-eye me-1"></i>{{ number_format($article->views) }} views</span>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    @if($article->featured_image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $article->featured_image) }}" 
                             class="img-fluid rounded shadow-sm w-100" 
                             alt="{{ $article->title }}"
                             style="max-height: 500px; object-fit: cover;">
                    </div>
                    @endif

                    <!-- Article Content -->
                    <div class="article-content fs-5 lh-base justify-info">
                        {{-- {!! nl2br(e($article->content)) !!} --}}
                        {!! $article->content !!}
                    </div>

                    <!-- Tags -->
                    {{-- @if($article->tags->count() > 0)
                    <div class="mt-5 pt-4 border-top">
                        <h6 class="fw-bold mb-3">Tags:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($article->tags as $tag)
                            <a href="{{ route('articles.index', ['tag' => $tag->slug]) }}" 
                               class="badge bg-light text-dark text-decoration-none px-3 py-2">#{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif --}}

                    <!-- Author Bio Section -->
                    {{-- <div class="mt-5 pt-4 border-top">
                        <h5 class="fw-bold mb-4">About the Author{{ $article->authors->count() > 1 ? 's' : '' }}</h5>
                        @foreach($article->authors as $author)
                        <div class="card border-0 bg-light mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="{{ $author->avatar ? asset('storage/' . $author->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($author->name) . '&size=100' }}" 
                                             class="rounded-circle" 
                                             width="80" height="80" 
                                             alt="{{ $author->name }}">
                                    </div>
                                    <div class="col">
                                        <h6 class="fw-bold mb-1">{{ $author->name }}</h6>
                                        @if($author->bio)
                                        <p class="text-muted mb-2 small">{{ $author->bio }}</p>
                                        @endif
                                        <div class="d-flex gap-2">
                                            @if($author->twitter)
                                            <a href="{{ $author->twitter }}" class="btn btn-sm btn-maroon-outline" target="_blank">
                                                <i class="bi bi-twitter"></i>
                                            </a>
                                            @endif
                                            @if($author->linkedin)
                                            <a href="{{ $author->linkedin }}" class="btn btn-sm btn-maroon-outline" target="_blank">
                                                <i class="bi bi-linkedin"></i>
                                            </a>
                                            @endif
                                            @if($author->email)
                                            <a href="mailto:{{ $author->email }}" class="btn btn-sm btn-maroon-outline">
                                                <i class="bi bi-envelope"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div> --}}

                    <!-- Share Buttons -->
                    <div class="mt-4 pt-4 border-top">
                        <h6 class="fw-bold mb-3">Share this article:</h6>
                        <div class="d-flex gap-2">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('articles.show', $article->slug)) }}&text={{ urlencode($article->title) }}" 
                               class="btn btn-maroon-outline" target="_blank">
                                <i class="bi bi-twitter me-1"></i> Twitter
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articles.show', $article->slug)) }}" 
                               class="btn btn-maroon-outline" target="_blank">
                                <i class="bi bi-facebook me-1"></i> Facebook
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('articles.show', $article->slug)) }}" 
                               class="btn btn-maroon-outline" target="_blank">
                                <i class="bi bi-linkedin me-1"></i> LinkedIn
                            </a>
                            <button class="btn btn-maroon-outline" onclick="copyToClipboard()">
                                <i class="bi bi-link-45deg me-1"></i> Copy Link
                            </button>
                        </div>
                    </div>
                </article>

                <!-- Related Articles -->
                @if($relatedArticles->count() > 0)
                <div class="mt-5 pt-5 border-top">
                    <h3 class="fw-bold mb-4">Related Articles</h3>
                    <div class="row g-4">
                        @foreach($relatedArticles as $related)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                @if($related->featured_image)
                                <img src="{{ asset('storage/' . $related->featured_image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $related->title }}" 
                                     style="height: 180px; object-fit: cover;">
                                @else
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 180px;">
                                    <i class="bi bi-file-text fs-1"></i>
                                </div>
                                @endif
                                <div class="card-body">
                                    <span class="badge bg-secondary mb-2">{{ $related->category->name }}</span>
                                    <h6 class="card-title fw-bold">{{ Str::limit($related->title, 60) }}</h6>
                                    <p class="card-text text-muted small">{{ Str::limit($related->excerpt, 80) }}</p>
                                    <a href="{{ route('articles.show', $related->slug) }}" class="btn btn-sm btn-maroon-outline">Read More</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-3" >
                <div class="sticky-top" style="top: 100px;">
                    <!-- Author Bio Section -->
                    <div class="mt-4 pt-4 "  >
                        <h5 class="fw-bold mb-4">About the Author{{ $article->authors->count() > 1 ? 's' : '' }}</h5>
                        @foreach($article->authors as $author)
                        <div class="card border-0 bg-light mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="{{ $author->avatar ? asset('storage/' . $author->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($author->name) . '&size=100' }}" 
                                                class="rounded-circle" 
                                                width="80" height="80" 
                                                alt="{{ $author->name }}">
                                    </div>
                                    <div class="col">
                                        <h6 class="fw-bold mb-1">{{ $author->name }}</h6>
                                        {{-- @if($author->bio)
                                        <p class="text-muted mb-2 small">{{ Str::words($author->bio, 10, '...') }}</p>
                                        @endif --}}
                                        <div class="d-flex gap-2">
                                            @if($author->twitter)
                                            <a href="{{ $author->twitter }}" class="btn btn-sm btn-maroon-outline" target="_blank">
                                                <i class="bi bi-twitter"></i>
                                            </a>
                                            @endif
                                            @if($author->linkedin)
                                            <a href="{{ $author->linkedin }}" class="btn btn-sm btn-maroon-outline" target="_blank">
                                                <i class="bi bi-linkedin"></i>
                                            </a>
                                            @endif
                                            @if($author->email)
                                            <a href="mailto:{{ $author->email }}" class="btn btn-sm btn-maroon-outline">
                                                <i class="bi bi-envelope"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
    
                    <!-- Tags -->
                    @if($article->tags->count() > 0)
                    <div class="mt-5 pt-4 border-top">
                        <h6 class="fw-bold mb-3">Tags:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($article->tags as $tag)
                            <a href="{{ route('articles.index', ['tag' => $tag->slug]) }}" 
                                class="badge bg-light text-dark text-decoration-none px-3 py-2">#{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* .article-content h1, h2, h3{
    font-family: Georgia, 'Times New Roman', serif;
} */
.article-content p {
    margin-bottom: 1.5rem;
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
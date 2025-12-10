@extends('layouts.app')

@section('content')
@include('layouts.page-expertise', [
    'title' => 'Our Expertise',
    'subtitle' => 'Practical legal expertise across diverse practice areas'
])



<section class="expertise-section py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title mb-3">Legal Services That Drive Success</h2>
                <p class="lead text-muted">
                    Our team of specialized lawyers provides comprehensive legal solutions across multiple practice areas, 
                    delivering excellence and innovation in every engagement.
                </p>
            </div>
        </div>

        {{-- Featured Expertise --}}
        @if($featuredExpertise->count() > 0)
        <div class="featured-expertise mb-5">
            <h3 class="mb-4 text-center">Featured Expertise</h3>
            <div class="row g-4">
                @foreach($featuredExpertise as $expertise)
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('expertise.show', $expertise->slug) }}" class="expertise-card expertise-card-featured">
                        <div class="expertise-image">
                            <img src="{{ $expertise->image_url }}" alt="{{ $expertise->name }}">
                            <div class="expertise-overlay">
                                <i class="bi bi-arrow-right-circle"></i>
                            </div>
                        </div>
                        <div class="expertise-content">
                            <h4>{{ $expertise->name }}</h4>
                            <p>{{ Str::limit($expertise->short_description, 100) }}</p>
                            <span class="learn-more">Learn More <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- All Expertise Grid --}}
        <div class="all-expertise">
            <h3 class="mb-4 text-center">All Practice Areas</h3>
            <div class="row g-4">
                @forelse($allExpertise as $expertise)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="expertise-card" onclick="window.location.href='{{ route('expertise.show', $expertise->slug) }}'">
                        <div class="expertise-image">
                            <img src="{{ $expertise->image ? asset('storage/' . $expertise->image) : asset('images/globe.png') }}" alt="{{ $expertise->name }}">
                            <div class="expertise-overlay">
                                <i class="bi bi-arrow-right-circle"></i>
                            </div>
                        </div>
                        <div class="expertise-content">
                            <h5>{{ $expertise->name }}</h5>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-briefcase" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">No expertise available at the moment.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Pagination --}}
        @if($allExpertise->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $allExpertise->links() }}
        </div>
        @endif
    </div>
</section>

<style>
/* Expertise Section */
.expertise-section {
    background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
}

.section-title {
    color: #2c3e50;
    font-weight: 600;
    font-size: 2.5rem;
}

/* Expertise Cards */
.expertise-card {
    display: block;
    text-decoration: none;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
    height: 100%;
}

.expertise-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}

.expertise-image {
    position: relative;
    padding-top: 75%; /* 4:3 aspect ratio */
    overflow: hidden;
}

.expertise-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.expertise-card:hover .expertise-image img {
    transform: scale(1.1);
}

.expertise-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(52, 0, 25, 0.7), rgba(220, 53, 69, 0.7));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.expertise-card:hover .expertise-overlay {
    opacity: 1;
}

.expertise-overlay i {
    font-size: 3rem;
    color: white;
    transform: scale(0.8);
    transition: transform 0.3s ease;
}

.expertise-card:hover .expertise-overlay i {
    transform: scale(1);
}

.expertise-content {
    padding: 1.5rem;
}

.expertise-content h4,
.expertise-content h5 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.expertise-content h4 {
    font-size: 1.5rem;
}

.expertise-content h5 {
    font-size: 1.1rem;
}

.expertise-content p {
    color: #6c757d;
    font-size: 0.95rem;
    margin-bottom: 1rem;
}

.learn-more {
    color: var(--maroon, #dc3545);
    font-weight: 600;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.expertise-card:hover .learn-more {
    gap: 0.8rem;
}

/* Featured Cards - Larger */
.expertise-card-featured {
    min-height: 400px;
}

.expertise-card-featured .expertise-content h4 {
    font-size: 1.75rem;
}

/* Responsive Design */
@media (max-width: 991px) {
    .section-title {
        font-size: 2rem;
    }

    .expertise-card-featured {
        min-height: 350px;
    }
}

@media (max-width: 767px) {
    .section-title {
        font-size: 1.75rem;
    }

    .expertise-image {
        padding-top: 65%;
    }

    .expertise-content {
        padding: 1rem;
    }

    .expertise-content h4 {
        font-size: 1.3rem;
    }

    .expertise-content h5 {
        font-size: 1rem;
    }

    .expertise-overlay i {
        font-size: 2.5rem;
    }
}

@media (max-width: 576px) {
    .col-sm-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .expertise-card-featured {
        min-height: 320px;
    }
}
</style>

@endsection



    



   
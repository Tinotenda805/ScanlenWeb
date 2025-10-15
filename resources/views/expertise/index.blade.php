@extends('layouts.app')

@section('content')
@include('layouts.page-header', [
    'title' => 'Our Expertise',
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
                    <a href="{{ route('expertise.show', $expertise->slug) }}" class="expertise-card">
                        <div class="expertise-image">
                            <img src="{{ $expertise->image_url }}" alt="{{ $expertise->name }}">
                            <div class="expertise-overlay">
                                <i class="bi bi-arrow-right-circle"></i>
                            </div>
                        </div>
                        <div class="expertise-content">
                            <h5>{{ $expertise->name }}</h5>
                        </div>
                    </a>
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



    
@endsection



   
@extends('layouts.app')

@section('content')
@include('layouts.page-Currentheader', [
    'title' => $expertise->name ,
    'subtitle'=> $expertise->short_description ?? ''
])


<section class="expertise-detail py-5">
    <div class="container">
        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <div class="expertise-overview mb-5">
                    <h2 class="mb-4">Overview</h2>
                    <div class="content-text">
                        {!! $expertise->overview !!}
                        {{-- {!! nl2br(e($expertise->overview)) !!} --}}
                    </div>
                </div>

                {{-- Related Expertise --}}
                @if($expertise->relatedExpertise->count() > 0)
                <div class="related-expertise mb-5">
                    <h3 class="mb-4">Related Practice Areas</h3>
                    <div class="row g-3">
                        @foreach($expertise->relatedExpertise as $related)
                        <div class="col-md-6">
                            <a href="{{ route('expertise.show', $related->slug) }}" class="related-card">
                                <div class="related-image">
                                    <img src="{{ $related->image_url }}" alt="{{ $related->name }}">
                                </div>
                                <div class="related-info">
                                    <h5>{{ $related->name }}</h5>
                                    <span class="view-link">View Details <i class="bi bi-arrow-right"></i></span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar: Key Contacts --}}
            <div class="col-lg-4">
                <div class="key-contacts-sidebar sticky-top" style="top: 100px;">
                    <h3 class="mb-4">Key Contacts</h3>
                    
                    @forelse($expertise->people as $person)
                    <div class="card border-0 bg-white mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="{{ $person->avatar_url ?? ''}}" 
                                                class="rounded-circle border" 
                                                width="50" height="50" 
                                                alt="{{ $person->name }}">
                                    </div>
                                    <div class="col">
                                        <h6 class="fw-bold mb-3"><a href="{{route('expertise.show', $person->id)}}" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">{{ $person->name }}</a></h6>
                                        <div class="d-flex gap-2">
                                            @if($person->twitter)
                                            <a href="{{ $person->twitter }}" class="btn btn-sm btn-maroon-outline" target="_blank">
                                                <i class="bi bi-twitter"></i>
                                            </a>
                                            @endif
                                            @if($person->linkedin)
                                            <a href="{{ $person->linkedin }}" class="btn btn-sm btn-maroon-outline" target="_blank">
                                                <i class="bi bi-linkedin"></i>
                                            </a>
                                            @endif
                                            @if($person->email)
                                            <a href="mailto:{{ $person->email }}" class="btn btn-sm btn-maroon-outline">
                                                <i class="bi bi-envelope"></i>
                                            </a>
                                            @endif
                                            {{-- <a href="#" class="btn btn-sm btn-outline-info"><i class="bi bi-person"></i></a> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    <p class="text-muted">No key contacts assigned yet.</p>
                    @endforelse

                    <div class="mt-4 pt-4 border-top">
                        <a href="{{ route('contactUs') }}" class="btn btn-danger w-100">
                            <i class="bi bi-telephone"></i> Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Banner */
.expertise-banner {
    background-size: cover;
    background-position: center;
    padding: 120px 0 80px;
    color: white;
    text-align: center;
}

.banner-content h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.banner-content .lead {
    font-size: 1.3rem;
    max-width: 700px;
    margin: 0 auto;
    opacity: 0.95;
}

/* Overview */
.expertise-overview .content-text {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #495057;
}

/* Related Cards */
.related-card {
    display: flex;
    text-decoration: none;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.related-card:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.12);
}

.related-image {
    width: 120px;
    flex-shrink: 0;
}

.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-info {
    padding: 1rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.related-info h5 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.view-link {
    color: var(--maroon, #dc3545);
    font-size: 0.9rem;
    font-weight: 600;
}

/* Key Contacts Sidebar */
.key-contacts-sidebar {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 12px;
}



/* Responsive Design */
@media (max-width: 991px) {
    .banner-content h1 {
        font-size: 2.5rem;
    }

    .banner-content .lead {
        font-size: 1.1rem;
    }

    .key-contacts-sidebar {
        margin-top: 3rem;
        position: static !important;
    }
}

@media (max-width: 767px) {
    .expertise-banner {
        padding: 80px 0 60px;
    }

    .banner-content h1 {
        font-size: 2rem;
    }

    .banner-content .lead {
        font-size: 1rem;
    }

    .related-card {
        flex-direction: column;
    }

    .related-image {
        width: 100%;
        height: 150px;
    }

    .contact-image img {
        width: 80px;
        height: 80px;
    }
}
</style>

@endsection
@extends('layouts.app')

@section('content')

@include('layouts.page-header', [
    'title' => 'Find A Lawyer',
])

<section class="find-lawyer-section py-5">
    <div class="container">
        {{-- Search Form --}}
        <div class="card shadow-sm mb-5">
            <div class="card-body p-4">
                <form action="{{ route('our-people.find-lawyer') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6">
                            <input type="text" 
                                   name="name" 
                                   class="form-control" 
                                   placeholder="Search by name" 
                                   value="{{ request('name') }}">
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <select name="" class="form-select">
                                <option value="">All Expertise</option>
                                @foreach($allExpertise as $expertise)
                                    <option value="{{ $expertise->id }}" 
                                            {{ request('expertise') == $expertise->id ? 'selected' : '' }}>
                                        {{ $expertise->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <select name="sector" class="form-select">
                                <option value="">All Sectors</option>
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}" 
                                            {{ request('sector') == $sector->id ? 'selected' : '' }}>
                                        {{ $sector->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Results --}}
        <div class="results-header mb-4">
            <h3>
                @if(request()->anyFilled(['name', 'expertise', 'sector']))
                    Search Results: {{ $people->total() }} lawyer(s) found
                @else
                    All Lawyers ({{ $people->total() }})
                @endif
            </h3>
        </div>

        {{-- Lawyer Cards --}}
        <div class="row g-4">
            @forelse($people as $person)
            <div class="col-lg-4 col-md-6">
                <div class="lawyer-card">
                    <div class="lawyer-image">
                        <img src="{{ $person->avatar ? asset('storage/' . $person->avatar) : asset('images/default-avatar.png') }}" 
                             alt="{{ $person->name }}">
                    </div>
                    <div class="lawyer-info">
                        <h4>{{ $person->name }}</h4>
                        @if($person->designation)
                            <p class="designation">{{ $person->designation }}</p>
                        @endif
                        
                        {{-- Expertise Tags --}}
                        @if($person->expertise && $person->expertise->count() > 0)
                            <div class="expertise-tags mb-3">
                                @foreach($person->expertise->take(3) as $exp)
                                    <span class="badge bg-secondary">{{ $exp->name }}</span>
                                @endforeach
                                @if($person->expertise->count() > 3)
                                    <span class="badge bg-light text-dark">+{{ $person->expertise->count() - 3 }} more</span>
                                @endif
                            </div>
                        @endif

                        {{-- Contact Info --}}
                        <div class="contact-info mb-3">
                            @if($person->email)
                                <a href="mailto:{{ $person->email }}" class="contact-link">
                                    <i class="bi bi-envelope"></i> {{ $person->email }}
                                </a>
                            @endif
                            @if($person->phone)
                                <a href="tel:{{ $person->phone }}" class="contact-link">
                                    <i class="bi bi-telephone"></i> {{ $person->phone }}
                                </a>
                            @endif
                        </div>

                        <a href="{{ route('our-people.partner', $person->id) }}" 
                           class="btn btn-outline-danger w-100">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-search" style="font-size: 4rem; color: #ccc;"></i>
                <h4 class="mt-3 text-muted">No lawyers found</h4>
                <p class="text-muted">Try adjusting your search criteria</p>
                <a href="{{ route('find-lawyer') }}" class="btn btn-primary mt-3">
                    Clear Filters
                </a>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($people->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $people->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</section>

<style>
.find-lawyer-section {
    background: #f8f9fa;
    min-height: 60vh;
}

.lawyer-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.lawyer-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.lawyer-image {
    position: relative;
    padding-top: 100%;
    overflow: hidden;
    background: #f0f0f0;
}

.lawyer-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.lawyer-info {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.lawyer-info h4 {
    color: #2c3e50;
    font-size: 1.3rem;
    margin-bottom: 0.5rem;
}

.designation {
    color: #dc3545;
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.expertise-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.expertise-tags .badge {
    font-size: 0.75rem;
    padding: 0.4rem 0.8rem;
    font-weight: 500;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.contact-link {
    color: #6c757d;
    text-decoration: none;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: color 0.3s ease;
}

.contact-link:hover {
    color: #dc3545;
}

.contact-link i {
    font-size: 1rem;
}

.results-header h3 {
    color: #2c3e50;
    font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {
    .lawyer-info h4 {
        font-size: 1.1rem;
    }

    .lawyer-info {
        padding: 1rem;
    }
}
</style>

@endsection
@extends('layouts.app')

@section('content')

@include('layouts.page-header', [
    'title' => 'Find A Lawyer',
])

<section class="find-lawyer-section py-5">
    <div class="container">

        {{-- SEARCH / FILTER --}}
        <div class="card search-card mb-5">
            <div class="card-body p-4">
                <form action="{{ route('our-people.find-lawyer') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label small text-muted">Lawyer Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   placeholder="e.g. John Doe"
                                   value="{{ request('name') }}">
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label class="form-label small text-muted">Expertise</label>
                            <select name="expertise" class="form-select">
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
                            <label class="form-label small text-muted">Sector</label>
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
                                <i class="bi bi-search me-1"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- RESULTS HEADER --}}
        <div class="results-header mb-4">
            <h4 class="fw-semibold">
                @if(request()->anyFilled(['name', 'expertise', 'sector']))
                    Search Results ({{ $people->total() }})
                    <a href="{{route('our-people.find-lawyer')}}" class="btn btn-outline-danger"><i class="bi bi-x"></i>Clear</a>
                @else
                    All Lawyers ({{ $people->total() }})
                @endif
            </h4>
        </div>

        {{-- LAWYER CARDS --}}
        <div class="row g-4">
            @forelse($people as $person)
                <div class="col-lg-4 col-md-6">
                    <div class="lawyer-card">

                        {{-- IMAGE --}}
                        <div class="lawyer-image">
                            <img src="{{ $person->avatar
                                    ? asset('storage/' . $person->avatar)
                                    : asset('images/default-avatar.png') }}"
                                 alt="{{ $person->name }}">
                            <div class="lawyer-name-overlay">
                                {{ $person->name }}
                            </div>
                        </div>

                        {{-- INFO --}}
                        <div class="lawyer-info">
                            @if($person->designation)
                                <div class="designation">{{ $person->designation }}</div>
                            @endif

                            {{-- EXPERTISE --}}
                            @if($person->expertise && $person->expertise->count())
                                <div class="expertise-tags mb-3">
                                    @foreach($person->expertise->take(3) as $exp)
                                        <span class="badge expertise-badge">{{ $exp->name }}</span>
                                    @endforeach
                                    @if($person->expertise->count() > 3)
                                        <span class="badge more-badge">
                                            +{{ $person->expertise->count() - 3 }} more
                                        </span>
                                    @endif
                                </div>
                            @endif

                            {{-- CONTACT --}}
                            <div class="contact-info">
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

                            {{-- CTA --}}
                            <a href="{{ route('our-people.partner', $person->id) }}"
                               class="btn btn-maroon-new w-100 fw-semibold mt-3">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-search display-4 text-muted"></i>
                    <h5 class="mt-3 text-muted">No lawyers found</h5>
                    <p class="text-muted mb-3">Try adjusting your filters</p>
                    <a href="{{ route('our-people.find-lawyer') }}" class="btn btn-outline-danger">
                        Clear Filters
                    </a>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($people->hasPages())
            <div class="d-flex justify-content-end mt-5">
                {{ $people->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</section>

{{-- PAGE STYLES --}}
<style>
.find-lawyer-section {
    background: linear-gradient(to bottom, #f8f9fa, #ffffff);
    min-height: 70vh;
}

/* Search Card */
.search-card {
    background: linear-gradient(135deg, #ffffff, #f6f6f6);
    border: none;
    border-radius: 16px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}

.search-card .form-control,
.search-card .form-select {
    height: 48px;
}

/* Lawyer Card */
.lawyer-card {
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: transform .3s ease, box-shadow .3s ease;
}

.lawyer-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}

/* Image */
.lawyer-image {
    position: relative;
    padding-top: 65%;
    background: linear-gradient(135deg, #eaeaea, #f9f9f9);
}

.lawyer-image img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.lawyer-image::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,.45));
}

.lawyer-name-overlay {
    position: absolute;
    bottom: 14px;
    left: 14px;
    right: 14px;
    color: #fff;
    font-size: 1.1rem;
    font-weight: 600;
    z-index: 2;
}

/* Info */
.lawyer-info {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.designation {
    color: var(--new-maroon);
    font-weight: 600;
    font-size: .95rem;
    margin-bottom: 1rem;
}

/* Expertise */
.expertise-tags {
    display: flex;
    flex-wrap: wrap;
    gap: .5rem;
}

.expertise-badge {
    background: rgba(220,53,69,.1);
    color: var(--new-maroon);
    border: 1px solid rgba(220,53,69,.25);
    border-radius: 20px;
    padding: .4rem .8rem;
    font-size: .75rem;
}

.more-badge {
    background: #f1f1f1;
    color: #555;
    border-radius: 20px;
    padding: .4rem .7rem;
    font-size: .75rem;
}

/* Contact */
.contact-info {
    margin-top: auto;
    opacity: .85;
}

.contact-link {
    font-size: .85rem;
    color: #6c757d;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: .5rem;
}

.contact-link:hover {
    color: #dc3545;
}

/* Responsive */
@media (max-width: 768px) {
    .lawyer-info {
        padding: 1.2rem;
    }
}
</style>

@endsection

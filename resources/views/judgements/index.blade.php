@extends('layouts.app')

@section('content')

@include('layouts.page-judge', [
    'title' => 'Judgements',
    'subtitle' => 'Authoritative court decisions and legal precedents.'
])

<section class="judgements-section py-5">
    <div class="container">
        {{-- Featured Judgements --}}
        @if($featured->count() > 0)
        <div class="featured-judgements mb-5">
            <h3 class="mb-4">Featured Judgements</h3>
            <div class="row g-3">
                @foreach($featured as $judgement)
                <div class="col-md-6">
                    <div class="featured-judgement-card">
                        <div class="card-header-custom">
                            <h5>{{ $judgement->title }}</h5>
                            @if($judgement->case_number)
                                <span class="badge bg-danger">{{ $judgement->case_number }}</span>
                            @endif
                        </div>
                        <div class="card-body-custom">
                            @if($judgement->description)
                                <p>{{ Str::limit($judgement->description, 120) }}</p>
                            @endif
                            <div class="judgement-meta">
                                @if($judgement->court)
                                    <span><i class="bi bi-bank"></i> {{ $judgement->court }}</span>
                                @endif
                                @if($judgement->judgement_date)
                                    <span><i class="bi bi-calendar"></i> {{ $judgement->judgement_date->format('M d, Y') }}</span>
                                @endif
                            </div>
                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('judgements.view', $judgement) }}" 
                                   class="btn btn-outline-primary btn-sm" 
                                   target="_blank">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="{{ route('judgements.download', $judgement) }}" 
                                   class="btn btn-maroon-new btn-sm">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Search & Filters --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('judgements.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Search title, case number..." 
                                   value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="court" class="form-select">
                                <option value="">All Courts</option>
                                @foreach($courts as $court)
                                    <option value="{{ $court }}" {{ request('court') == $court ? 'selected' : '' }}>
                                        {{ $court }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-maroon-new w-100">
                                <i class="bi bi-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Results Header --}}
        <div class="results-header mb-4">
            <h4>
                @if(request()->anyFilled(['search', 'court', 'category']))
                    Search Results: {{ $judgements->total() }} judgement(s) found
                @else
                    All Judgements ({{ $judgements->total() }})
                @endif
            </h4>
        </div>

        {{-- Judgements List --}}
        <div class="judgements-list">
            @forelse($judgements as $judgement)
            <div class="judgement-item">
                <div class="judgement-icon">
                    <i class="bi bi-file-earmark-text"></i>
                    <span class="file-badge">{{ strtoupper($judgement->file_type) }}</span>
                </div>
                <div class="judgement-details">
                    <h5>{{ $judgement->title }}</h5>
                    @if($judgement->case_number)
                        <p class="case-number">Case No: {{ $judgement->case_number }}</p>
                    @endif
                    @if($judgement->description)
                        <p class="description">{{ Str::limit($judgement->description, 150) }}</p>
                    @endif
                    <div class="judgement-meta">
                        @if($judgement->court)
                            <span><i class="bi bi-bank"></i> {{ $judgement->court }}</span>
                        @endif
                        @if($judgement->judgement_date)
                            <span><i class="bi bi-calendar"></i> {{ $judgement->judgement_date->format('M d, Y') }}</span>
                        @endif
                        @if($judgement->category)
                            <span><i class="bi bi-tag"></i> {{ $judgement->category->name }}</span>
                        @endif
                        <span><i class="bi bi-download"></i> {{ $judgement->download_count }} downloads</span>
                    </div>
                    @if($judgement->tags && count($judgement->tags) > 0)
                        <div class="tags mt-2">
                            @foreach($judgement->tags as $tag)
                                <span class="tag-badge">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="judgement-actions">
                    <a href="{{ route('judgements.view', $judgement) }}" 
                       class="btn btn-outline-primary" 
                       target="_blank">
                        <i class="bi bi-eye"></i> View
                    </a>
                    <a href="{{ route('judgements.download', $judgement) }}" 
                       class="btn btn-maroon-new">
                        <i class="bi bi-download"></i> Download
                    </a>
                    <small class="text-muted mt-2">{{ $judgement->formatted_file_size }}</small>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="bi bi-search" style="font-size: 4rem; color: #ccc;"></i>
                <h4 class="mt-3 text-muted">No judgements found</h4>
                <p class="text-muted">Try adjusting your search criteria</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($judgements->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $judgements->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</section>

<style>
:root {
    --maroon: #3c0008;
    --light-maroon: #50010b;
    --white: #ffffff;
    --light-gray: #f8f9fa;
    --dark-gray: #343a40;
    --gold: #d4af37;

    --new-maroon:#861043;
}
.judgements-section {
    background: #f8f9fa;
    min-height: 60vh;
}

/* Featured Judgements */
.featured-judgement-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.featured-judgement-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.card-header-custom {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    padding: 1.5rem;
}

.card-header-custom h5 {
    margin: 0 0 0.5rem 0;
    font-size: 1.1rem;
}

.card-body-custom {
    padding: 1.5rem;
}

/* Judgements List */
.judgements-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.judgement-item {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    display: flex;
    gap: 1.5rem;
    transition: all 0.3s ease;
}

.judgement-item:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
}

.judgement-icon {
    flex-shrink: 0;
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--new-maroon) 0%, var(--light-maroon) 100%);
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    position: relative;
}

.judgement-icon i {
    font-size: 2rem;
}

.file-badge {
    position: absolute;
    bottom: 5px;
    font-size: 0.7rem;
    font-weight: 600;
    background: rgba(0,0,0,0.3);
    padding: 2px 6px;
    border-radius: 4px;
}

.judgement-details {
    flex: 1;
}

.judgement-details h5 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 1.3rem;
    font-weight: 600;
}

.case-number {
    color: var(--new-maroon);
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.description {
    color: #6c757d;
    margin-bottom: 1rem;
    line-height: 1.6;
}

.judgement-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 0.5rem;
}

.judgement-meta span {
    color: #6c757d;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.judgement-meta i {
    color: var(--new-maroon);
}

.tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tag-badge {
    background: #e9ecef;
    color: #495057;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.judgement-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: stretch;
}

.judgement-actions .btn {
    white-space: nowrap;
    min-width: 120px;
}

.judgement-actions small {
    text-align: center;
    display: block;
}

.results-header h4 {
    color: #2c3e50;
    font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {
    .judgement-item {
        flex-direction: column;
    }

    .judgement-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto;
    }

    .judgement-actions {
        flex-direction: row;
        justify-content: center;
    }

    .judgement-meta {
        flex-direction: column;
        gap: 0.5rem;
    }

    .featured-judgement-card .card-header-custom h5 {
        font-size: 1rem;
    }
}
</style>

@endsection
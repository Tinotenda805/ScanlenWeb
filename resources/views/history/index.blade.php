@extends('layouts.app')

@section('content')

@include('components.page-header', [
    'title' => 'Our History',
])

<!-- History Timeline Section -->
<main class="timeline-section">
    <div class="timeline-header">
        <h2>Our Journey</h2>
        <p>A journey of growth, innovation, and unwavering commitment to legal excellence</p>
    </div>

    <div class="timeline">
        @foreach($timelines as $timeline)
        <div class="decade">
            <div class="decade-marker"></div>
            <div class="decade-content">
                <div class="decade-year">{{ $timeline->decade }}</div>
                <h3 class="decade-title">{{ $timeline->title }}</h3>
                
                @if($timeline->image)
                <div class="decade-image">
                    <img src="{{ $timeline->image_url }}" alt="{{ $timeline->decade }}">
                </div>
                @endif

                <p class="decade-description">
                    {{ $timeline->description }}
                </p>

                @if($timeline->highlights && count($timeline->highlights) > 0)
                <ul class="highlights">
                    @foreach($timeline->highlights as $highlight)
                        <li>{{ $highlight }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <!-- Statistics Section -->
    @if($statistics->count() > 0)
    <section class="stats-section">
        <div class="stats-container">
            @foreach($statistics as $stat)
            <div class="stat-item">
                @if($stat->icon)
                    <div class="stat-icon">
                        <i class="{{ $stat->icon }}"></i>
                    </div>
                @endif
                <div class="stat-number">{{ $stat->value }}</div>
                <div class="stat-label">{{ $stat->label }}</div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</main>

<style>
.timeline-section {
    padding: 3rem 0;
    background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
}

.timeline-header {
    text-align: center;
    margin-bottom: 4rem;
    padding: 0 1rem;
}

.timeline-header h2 {
    font-size: 2.5rem;
    color: #2c3e50;
    margin-bottom: 1rem;
    font-weight: 600;
}

.timeline-header p {
    font-size: 1.2rem;
    color: #6c757d;
    max-width: 700px;
    margin: 0 auto;
}

.timeline {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 2rem;
    position: relative;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 2px;
    height: 100%;
    background: linear-gradient(180deg, transparent, #dc3545, transparent);
}

.decade {
    position: relative;
    margin-bottom: 4rem;
}

.decade-marker {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 20px;
    height: 20px;
    background: #dc3545;
    border-radius: 50%;
    border: 4px solid #fff;
    box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.2);
    z-index: 2;
}

.decade-content {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    margin-left: 60%;
    transition: all 0.3s ease;
}

.decade:nth-child(even) .decade-content {
    margin-left: 0;
    margin-right: 60%;
}

.decade-content:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.decade-year {
    display: inline-block;
    background: #dc3545;
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 1rem;
}

.decade-title {
    color: #2c3e50;
    font-size: 1.8rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.decade-image {
    margin: 1.5rem 0;
    border-radius: 8px;
    overflow: hidden;
}

.decade-image img {
    width: 100%;
    height: auto;
    display: block;
}

.decade-description {
    color: #495057;
    font-size: 1.05rem;
    line-height: 1.8;
    margin-bottom: 1.5rem;
}

.highlights {
    list-style: none;
    padding: 0;
    margin: 0;
}

.highlights li {
    padding-left: 1.5rem;
    margin-bottom: 0.75rem;
    position: relative;
    color: #495057;
}

.highlights li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: #dc3545;
    font-weight: bold;
    font-size: 1.2rem;
}

/* Statistics Section */
.stats-section {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    padding: 4rem 0;
    margin-top: 4rem;
}

.stats-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 3rem;
    padding: 0 2rem;
}

.stat-item {
    text-align: center;
    color: white;
}

.stat-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #dc3545;
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.9);
    font-weight: 500;
}

/* Responsive */
@media (max-width: 768px) {
    .timeline::before {
        left: 20px;
    }

    .decade-marker {
        left: 20px;
    }

    .decade-content {
        margin-left: 60px !important;
        margin-right: 0 !important;
    }

    .decade-year {
        font-size: 1rem;
        padding: 0.4rem 1rem;
    }

    .decade-title {
        font-size: 1.4rem;
    }

    .timeline-header h2 {
        font-size: 2rem;
    }

    .stats-container {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 2rem;
    }

    .stat-number {
        font-size: 2.5rem;
    }
}
</style>

@endsection
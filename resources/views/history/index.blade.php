@extends('layouts.app')

@section('content')

<style>
    :root {
    --maroon: #3c0008;
    --light-maroon: #50010b;
    --white: #ffffff;
    --light-gray: #f8f9fa;
    --dark-gray: #343a40;
    --gold: #d4af37;
    --new-maroon: #861043;
}

/* ===== MAIN LAYOUT ===== */
.maincontent {
    display: flex;
    margin: 0 auto;
    min-height: 100vh;
    gap: 0;
}

/* ===== SIDEBAR ===== */
.sidebar {
    width: 400px;
    flex-shrink: 0;
    background: linear-gradient(135deg, rgba(84, 42, 48, 0.783) 0%, rgba(60, 0, 8, 0.5) 100%);
    color: white;
    padding: 60px 40px;
    position: sticky;
    top: 70px;
    height: calc(100vh - 70px);
    overflow-y: auto;
}

.sidebar h2 {
    font-size: 2rem;
    margin-bottom: 30px;
    color: #ecf0f1;
    border-bottom: 3px solid var(--light-gray);
    padding-bottom: 15px;
    font-weight: 400;
}

.firm-description {
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 40px;
    color: #bdc3c7;
}

.values-section h3 {
    font-size: 1.4rem;
    color: var(--light-gray);
    margin-bottom: 20px;
    font-weight: 600;
}

.values-list {
    list-style: none;
    padding: 0;
}

.values-list li {
    margin-bottom: 15px;
    padding-left: 25px;
    position: relative;
    color: #ecf0f1;
    font-size: 1rem;
}

.values-list li::before {
    content: '▸';
    position: absolute;
    left: 0;
    color: var(--gold);
    font-weight: bold;
}

/* ===== TIMELINE SECTION ===== */
.timeline-section {
    flex: 1;
    background: white;
    padding: 60px 40px;
}

.timeline-header {
    text-align: center;
    margin-bottom: 60px;
}

.timeline-header h2 {
    font-size: clamp(2rem, 4vw, 3rem);
    color: #000;
    margin-bottom: 20px;
    font-weight: 300;
}

.timeline-header p {
    font-size: 1.2rem;
    color: #5a6c7d;
    max-width: 600px;
    margin: 0 auto;
}

.timeline {
    position: relative;
    margin: 0 auto;
    max-width: 1000px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 40px;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(180deg, #3c0008, #3c0008);
    border-radius: 2px;
    box-shadow: 0 0 20px rgba(30, 60, 114, 0.3);
}

/* ===== DECADE ITEMS ===== */
.decade {
    position: relative;
    margin-bottom: 80px;
    padding-left: 100px;
    padding-right: 50px;
    opacity: 0;
    transform: translateY(50px);
    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.decade.visible {
    opacity: 1;
    transform: translateY(0);
}

.decade-marker {
    position: absolute;
    left: 40px;
    top: 30px;
    width: 30px;
    height: 30px;
    background: linear-gradient(135deg, #3c0008, #343a40);
    border: 5px solid white;
    border-radius: 50%;
    transform: translateX(-50%);
    box-shadow: 0 0 20px rgba(30, 60, 114, 0.4);
    z-index: 2;
}

.decade-content {
    position: relative;
    background: white;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    border: 1px solid #e0e6ed;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}

.decade-content:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
}

.decade-content::after {
    content: '';
    position: absolute;
    left: -15px;
    top: 40px;
    width: 0;
    height: 0;
    border: 15px solid transparent;
    border-right-color: white;
    z-index: 2;
}

.decade-year {
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    color: var(--maroon);
    font-weight: bold;
    margin-bottom: 20px;
    letter-spacing: 2px;
}

/* ===== IMAGE-BASED CONTENT ===== */
.background-image-container {
    position: relative;
    min-height: 300px;
    border-radius: 15px;
    overflow: hidden;
}

.background-image-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%);
    z-index: 1;
}

.background-image-container img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
    transition: transform 0.5s ease;
}

.background-image-container:hover img {
    transform: scale(1.05);
}

.image-content-overlay {
    position: relative;
    z-index: 2;
    color: white;
    padding: 40px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}

.image-overlay-title {
    font-size: 1.8rem;
    margin-bottom: 15px;
    color: white;
    font-weight: 600;
}

.image-overlay-caption {
    font-size: 1.1rem;
    opacity: 0.9;
    line-height: 1.6;
    margin-bottom: 20px;
}

/* ===== NO-IMAGE CONTENT ===== */
.decade-content:has(.no-image) {
    background: transparent;
    box-shadow: none;
    border: none;
}

.decade-content:has(.no-image)::after {
    display: none;
}

.main-content-area.no-image {
    padding: 40px;
    background: linear-gradient(135deg, rgba(84, 42, 48, 0.783) 0%, rgba(60, 0, 8, 0.5) 100%);
    border-radius: 12px;
    border: 1px solid #e0e6ed;
    margin-top: 5px;
}

.main-content-area.no-image .decade-year {
    color: var(--gold) !important;
}

.main-content-area.no-image .decade-title {
    color: var(--white);
    font-size: 1.8rem;
    margin-bottom: 10px;
    border-bottom: 2px solid var(--light-gray);
    padding-bottom: 5px;
}

.main-content-area.no-image .decade-description {
    color: var(--light-gray);
}

/* ===== SHORT CONTENT STYLES ===== */
.decade-content.short-content .background-image-container {
    min-height: 400px;
}

.decade-content.short-content .background-image-container::before {
    background: linear-gradient(to bottom, rgba(60, 0, 8, 0.3) 0%, rgba(60, 0, 8, 0.85) 100%);
}

.decade-content.short-content .image-content-overlay {
    padding: 60px 40px;
    justify-content: center;
}

.decade-content.short-content .decade-year {
    color: var(--gold) !important;
}

/* ===== COMMON STYLES ===== */
.decade-description {
    font-size: 1rem;
    line-height: 1.8;
}

.highlights {
    list-style: none;
    padding: 0;
}

.highlights li {
    position: relative;
    padding-left: 25px;
    margin-bottom: 12px;
    font-size: 1rem;
}

.highlights li::before {
    content: '⚖️';
    position: absolute;
    left: 0;
    top: 0;
}

/* ===== STATISTICS ===== */
.stats-section {
    padding: 60px;
    margin-top: 60px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 30px;
}

.stat-item {
    background: white;
    padding: 30px 20px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    color: var(--maroon);
    margin-bottom: 10px;
}

.stat-label {
    font-size: 1rem;
    color: #5a6c7d;
    font-weight: 500;
}

.stat-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: var(--new-maroon);
}

/* ===== TABLET (992px - 1199px) ===== */
@media (max-width: 1199px) {
    .sidebar {
        width: 350px;
        padding: 50px 30px;
    }
    
    .timeline-section {
        padding: 50px 30px;
    }
}

/* ===== TABLET (768px - 991px) ===== */
@media (max-width: 991px) {
    .maincontent {
        flex-direction: column;
    }
    
    .sidebar {
        width: 100%;
        position: relative;
        top: 0;
        height: auto;
        padding: 50px 40px;
    }
    
    .timeline-section {
        width: 100%;
        padding: 50px 40px;
    }
    
    .decade {
        padding-left: 90px;
        padding-right: 30px;
    }
    
    .background-image-container {
        min-height: 250px;
    }
    
    .decade-content.short-content .background-image-container {
        min-height: 350px;
    }
}

/* ===== MOBILE (577px - 767px) ===== */
@media (max-width: 767px) {
    .sidebar {
        padding: 40px 30px;
    }
    
    .sidebar h2 {
        font-size: 1.8rem;
    }
    
    .firm-description {
        font-size: 1rem;
    }
    
    .timeline-section {
        padding: 40px 20px;
    }
    
    .timeline-header p {
        text-align: center;
        font-size: 1rem;
    }
    
    .timeline::before {
        left: 20px;
    }
    
    .decade {
        padding-left: 60px;
        padding-right: 15px;
        margin-bottom: 50px;
    }
    
    .decade-marker {
        left: 20px;
        width: 20px;
        height: 20px;
        border: 3px solid white;
    }
    
    .decade-content::after {
        left: -10px;
        border-width: 10px;
    }
    
    .decade-year {
        font-size: 1.8rem;
    }
    
    .image-overlay-title {
        font-size: 1.4rem;
    }
    
    .image-overlay-caption {
        font-size: 1rem;
    }
    
    .background-image-container {
        min-height: 200px;
    }
    
    .decade-content.short-content .background-image-container {
        min-height: 300px;
    }
    
    .image-content-overlay {
        padding: 25px;
    }
    
    .decade-content.short-content .image-content-overlay {
        padding: 40px 25px;
    }
    
    .main-content-area.no-image {
        padding: 30px 25px;
    }
    
    .stats-section {
        padding: 40px 20px;
    }
    
    .stats-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
}

/* ===== SMALL MOBILE (max 576px) ===== */
@media (max-width: 576px) {
    .sidebar {
        padding: 30px 20px;
    }
    
    .sidebar h2 {
        font-size: 1.6rem;
        margin-bottom: 20px;
    }
    
    .firm-description {
        font-size: 0.95rem;
        margin-bottom: 30px;
    }
    
    .values-section h3 {
        font-size: 1.2rem;
    }
    
    .timeline-section {
        padding: 30px 15px;
    }
    
    .timeline-header {
        margin-bottom: 40px;
    }
    
    .timeline-header h2 {
        font-size: 1.8rem;
    }
    
    .timeline-header p {
        font-size: 0.95rem;
    }
    
    .decade {
        padding-left: 50px;
        padding-right: 10px;
        margin-bottom: 40px;
    }
    
    .decade-marker {
        left: 18px;
        width: 18px;
        height: 18px;
    }
    
    .decade-year {
        font-size: 1.6rem;
        margin-bottom: 15px;
    }
    
    .decade-title {
        font-size: 1.3rem;
    }
    
    .decade-description {
        font-size: 0.95rem;
    }
    
    .background-image-container {
        min-height: 180px;
    }
    
    .decade-content.short-content .background-image-container {
        min-height: 250px;
    }
    
    .image-content-overlay {
        padding: 20px;
    }
    
    .decade-content.short-content .image-content-overlay {
        padding: 30px 20px;
    }
    
    .image-overlay-title {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }
    
    .image-overlay-caption {
        font-size: 0.9rem;
        margin-bottom: 15px;
    }
    
    .main-content-area.no-image {
        padding: 25px 20px;
    }
    
    .main-content-area.no-image .decade-title {
        font-size: 1.4rem;
    }
    
    .highlights li {
        font-size: 0.95rem;
        margin-bottom: 10px;
    }
    
    .stats-section {
        padding: 30px 15px;
        margin-top: 40px;
    }
    
    .stats-container {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .stat-item {
        padding: 25px 15px;
    }
    
    .stat-icon {
        font-size: 2.5rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}

/* ===== VERY SMALL MOBILE (max 480px) ===== */
@media (max-width: 480px) {
    .decade-content::after {
        display: none;
    }
    
    .timeline::before {
        left: 15px;
    }
    
    .decade {
        padding-left: 45px;
    }
    
    .decade-marker {
        left: 15px;
        width: 16px;
        height: 16px;
    }
    
    .background-image-container {
        min-height: 150px;
    }
    
    .decade-content.short-content .background-image-container {
        min-height: 220px;
    }
    
    .image-content-overlay {
        padding: 15px;
    }
    
    .decade-content.short-content .image-content-overlay {
        padding: 25px 15px;
    }
}

html {
    scroll-behavior: smooth;
}
</style>

@include('layouts.page-header')

<div class="maincontent" >
    <!-- Who We Are Sidebar -->
    <aside class="sidebar px-5">
        <h2>Who We Are</h2>
        
        <div class="firm-description">
            Scanlen and Holderness is a premier law firm dedicated to delivering exceptional legal services with integrity, innovation, and unwavering commitment to our clients' success.
        </div>
        
        <div class="values-section">
            <h3>Our Values</h3>
            <ul class="values-list">
                <li>Integrity</li>
                <li>Excellence</li>
                <li>Respect</li>
                <li>Innovation</li>
            </ul>
        </div>
    </aside>

    <!-- History Timeline Section -->
    <main class="timeline-section bg-secondary-subtle">
        <div class="timeline-header">
            <h2 class="fw-bolder">Our Journey</h2>
            <p>A journey of growth, innovation, and unwavering commitment to legal excellence</p>
        </div>

        <div class="timeline">
            @foreach($timelines as $timeline)
                @php
                    $cleanDescription = strip_tags($timeline->description);
                    $descriptionLength = strlen($cleanDescription);
                    
                    // Calculate total content length including highlights
                    $highlightsLength = 0;
                    if ($timeline->highlights && count($timeline->highlights) > 0) {
                        foreach ($timeline->highlights as $highlight) {
                            $highlightsLength += strlen($highlight) + 50; // Approx 50 chars for formatting
                        }
                    }
                    
                    $totalContentLength = $descriptionLength + $highlightsLength;
                    $isShortContent = $totalContentLength < 500; // Adjust threshold as needed
                @endphp
                
                <div class="decade">
                    <div class="decade-marker"></div>
                    <div class="decade-content {{ $isShortContent ? 'short-content' : '' }}">
                        @if($timeline->image)
                            {{-- WITH IMAGE --}}
                            <div class="background-image-container">
                                <img src="{{ $timeline->image_url }}" alt="{{ $timeline->decade }}" loading="lazy">
                                
                                <div class="image-content-overlay">
                                    @if($timeline->image_title)
                                    <h4 class="image-overlay-title">{{ $timeline->image_title }}</h4>
                                    @endif
                                    
                                    @if($timeline->image_caption)
                                    <p class="image-overlay-caption">{{ $timeline->image_caption }}</p>
                                    @endif
                                    
                                    <div class="decade-year">{{ $timeline->decade }}</div>
                                    <h3 class="decade-title">{{ $timeline->title }}</h3>
                                    
                                    @if($isShortContent)
                                        <div class="decade-description fs-5 lh-base">
                                            {!! $timeline->description !!}
                                        </div>
                                        
                                        @if($timeline->highlights && count($timeline->highlights) > 0)
                                        <ul class="highlights">
                                            @foreach($timeline->highlights as $highlight)
                                                <li>{{ $highlight }}</li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            
                            {{-- Long content WITH image --}}
                            {{-- @if(!$isShortContent)
                            <div class="main-content-area">
                                <div class="decade-description fs-5 justify-info">
                                    {!! $timeline->description !!}
                                </div>

                                @if($timeline->highlights && count($timeline->highlights) > 0)
                                <ul class="highlights">
                                    @foreach($timeline->highlights as $highlight)
                                        <li>{{ $highlight }}</li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            @endif --}}
                        @else
                            {{-- WITHOUT IMAGE --}}
                            <div class="main-content-area no-image">
                                <div class="decade-year">{{ $timeline->decade }}</div>
                                <h3 class="decade-title">{{ $timeline->title }}</h3>
                                
                                <div class="decade-description fs-5 justify-info">
                                    {!! $timeline->description !!}
                                </div>

                                @if($timeline->highlights && count($timeline->highlights) > 0)
                                <ul class="highlights">
                                    @foreach($timeline->highlights as $highlight)
                                        <li>{{ $highlight }}</li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
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
</div>

<script>
    // Intersection Observer for timeline animations
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, index * 200);
            }
        });
    }, observerOptions);

    // Observe all decade elements
    document.querySelectorAll('.decade').forEach(decade => {
        observer.observe(decade);
    });

    // Animate statistics on scroll
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const number = entry.target.querySelector('.stat-number');
                const finalValue = parseInt(number.textContent);
                const suffix = number.textContent.replace(/[0-9]/g, '');
                
                let current = 0;
                const increment = finalValue / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= finalValue) {
                        number.textContent = finalValue + suffix;
                        clearInterval(timer);
                    } else {
                        number.textContent = Math.floor(current) + suffix;
                    }
                }, 30);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.stat-item').forEach(stat => {
        statsObserver.observe(stat);
    });

    // Add hover effect for background images
    document.querySelectorAll('.background-image-container').forEach(container => {
        const img = container.querySelector('img');
        
        container.addEventListener('mouseenter', () => {
            img.style.transform = 'scale(1.05)';
        });
        
        container.addEventListener('mouseleave', () => {
            img.style.transform = 'scale(1)';
        });
    });
</script>

@endsection
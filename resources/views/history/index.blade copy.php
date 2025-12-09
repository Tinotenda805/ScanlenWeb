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
    
    /* Main Content Layout */
    .maincontent {
        display: flex;
        margin: 0 auto;
        min-height: 100vh;
        gap: 0;
    }

    /* Who We Are Sidebar */
    .sidebar {
        max-width: 500px;
        background: linear-gradient(180deg, #3c0008 0%, #50010b 100%);
        color: white;
        padding: 60px 5px;
        position: sticky;
        top: 60px;
        height: 100vh;
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

    /* History Timeline Section */
    .timeline-section {
        background: white;
        padding: 60px 5px;
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

    /* Flexible Decade Content Layout */
    .decade-content {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid #e0e6ed;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
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
    }

    .decade-year {
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        color: var(--maroon);
        font-weight: bold;
        margin-bottom: 20px;
        letter-spacing: 2px;
    }

    .decade-title {
        font-size: 1.8rem;
        color: var(--light-maroon);
        margin-bottom: 20px;
        font-weight: 600;
    }

    /* Flexible Grid Layout */
    .decade-content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: start;
    }

    .decade-text-content {
        display: flex;
        flex-direction: column;
    }

    .decade-description {
        font-size: 1rem;
        color: #5a6c7d;
        line-height: 1.8;
        margin-bottom: 25px;
    }

    /* Image Container with Overlay */
    .image-container {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        min-height: 300px;
        max-height: 400px;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .image-container:hover img {
        transform: scale(1.05);
    }

    .image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(60, 0, 8, 0.8));
        padding: 30px;
        color: white;
    }

    .image-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: white;
        font-weight: 600;
    }

    .image-caption {
        font-size: 1rem;
        opacity: 0.9;
        line-height: 1.6;
        margin: 0;
    }

    /* For shorter content - single column layout */
    .decade-content.short-content .decade-content-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .decade-content.short-content .image-container {
        min-height: 250px;
        max-height: 350px;
    }

    .decade-content.short-content .image-overlay {
        background: linear-gradient(transparent, rgba(60, 0, 8, 0.7));
        padding: 40px;
    }

    .highlights {
        list-style: none;
        padding: 0;
        margin-top: 20px;
    }

    .highlights li {
        position: relative;
        padding-left: 25px;
        margin-bottom: 12px;
        color: #4a5568;
        font-size: 1rem;
    }

    .highlights li::before {
        content: '⚖️';
        position: absolute;
        left: 0;
        top: 0;
    }

    /* Statistics Section */
    .stats-section {
        background: linear-gradient(135deg, #f1f3f4 0%, #e8eaf6 100%);
        padding: 60px;
        margin-top: 60px;
        border-radius: 15px;
        text-align: center;
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 30px;
        margin: 0 auto;
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

    /* Responsive Design */
    @media (max-width: 1200px) {
        .maincontent {
            flex-direction: column;
        }
        
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            padding: 40px 20px;
        }
        
        .timeline-section {
            width: 100%;
            padding: 40px 20px;
        }
        
        .timeline::before {
            left: 30px;
        }
        
        .decade {
            padding-left: 80px;
            padding-right: 20px;
        }
        
        .decade-marker {
            left: 30px;
        }
    }

    @media (max-width: 992px) {
        .decade-content-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .image-container {
            min-height: 250px;
            max-height: 350px;
        }
        
        .decade-content.short-content .image-overlay {
            padding: 30px;
        }
    }

    @media (max-width: 768px) {
        .timeline-header p {
            text-align: justify;
        }
        
        .timeline-section {
            margin-top: 40px;
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
            border: 3px solid var(--maroon);
            background: var(--white);
        }
        
        .decade-content {
            padding: 25px;
        }
        
        .decade-content::after {
            left: -10px;
            border-width: 10px;
        }
        
        .decade-year {
            font-size: 2rem;
        }
        
        .decade-title {
            font-size: 1.5rem;
        }
        
        .image-overlay {
            padding: 20px;
        }
        
        .image-title {
            font-size: 1.3rem;
        }
        
        .stats-section {
            padding: 40px 20px;
        }
        
        .stats-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        .stat-item {
            padding: 20px 15px;
        }
    }

    @media (max-width: 576px) {
        .sidebar {
            padding: 30px 15px;
        }
        
        .sidebar h2 {
            font-size: 1.8rem;
        }
        
        .decade {
            padding-left: 50px;
        }
        
        .decade-content {
            padding: 20px;
        }
        
        .decade-title {
            font-size: 1.3rem;
        }
        
        .decade-description {
            font-size: 0.95rem;
        }
        
        .image-overlay {
            padding: 15px;
        }
        
        .image-title {
            font-size: 1.2rem;
        }
        
        .stats-container {
            grid-template-columns: 1fr;
        }
    }

    html {
        scroll-behavior: smooth;
    }
</style>

@include('layouts.page-header')

<div class="maincontent">
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
    <main class="timeline-section">
        <div class="timeline-header">
            <h2 class="fw-bolder">Our Journey</h2>
            <p>A journey of growth, innovation, and unwavering commitment to legal excellence</p>
        </div>

        <div class="timeline">
            @foreach($timelines as $timeline)
                @php
                    // Check if content is short (less than 300 characters without HTML tags)
                    $cleanDescription = strip_tags($timeline->description);
                    $isShortContent = strlen($cleanDescription) < 300;
                @endphp
                
                <div class="decade">
                    <div class="decade-marker"></div>
                    <div class="decade-content {{ $isShortContent ? 'short-content' : '' }}">
                        <div class="decade-year">{{ $timeline->decade }}</div>
                        
                        <div class="decade-content-grid">
                            <div class="decade-text-content">
                                <h3 class="decade-title">{{ $timeline->title }}</h3>
                                
                                <p class="decade-description fs-5 lh-base justify-info">
                                    {!! $timeline->description !!}
                                </p>

                                @if($timeline->highlights && count($timeline->highlights) > 0)
                                <ul class="highlights">
                                    @foreach($timeline->highlights as $highlight)
                                        <li>{{ $highlight }}</li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            
                            @if($timeline->image)
                            <div class="image-container">
                                <img src="{{ $timeline->image_url }}" alt="{{ $timeline->decade }}" loading="lazy">
                                
                                @if($timeline->image_title || $timeline->image_caption)
                                <div class="image-overlay">
                                    @if($timeline->image_title)
                                    <h4 class="image-title">{{ $timeline->image_title }}</h4>
                                    @endif
                                    
                                    @if($timeline->image_caption)
                                    <p class="image-caption">{{ $timeline->image_caption }}</p>
                                    @endif
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
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

    // Optional: Auto-detect content length for layout adjustment
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.decade-content').forEach(content => {
            const description = content.querySelector('.decade-description');
            if (description) {
                const textLength = description.textContent.trim().length;
                const highlights = content.querySelectorAll('.highlights li');
                const totalContentLength = textLength + (highlights.length * 50); // Approximate highlight length
                
                // If you want more dynamic control, you can add classes here
                if (totalContentLength < 200 && !content.classList.contains('short-content')) {
                    content.classList.add('short-content');
                }
            }
        });
    });
</script>

@endsection
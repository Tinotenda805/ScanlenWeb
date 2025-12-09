@extends('layouts.app')

<style>
    

    /* Hero Section */
    .hero-landing {
        min-height: 100vh;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.85) 0%, rgba(60, 0, 8, 0.4) 100%),
                    url('../images/scales.jpg') center/cover;
        position: relative;
        display: flex;
        align-items: center;
        padding: 10rem 0 4rem 0; /* Added top padding to push content below ribbon */
        overflow: hidden;
    }

    /* Timeline Ribbon - NOW AT TOP */
    .timeline-ribbon {
        position: absolute;
        top: 0; /* Changed from 2rem to 0 */
        left: 0;
        width: 100%;
        padding-top: 0.5rem;
        height: 130px;
        z-index: 10; /* Increased to be above everything */
        overflow: hidden;
        pointer-events: none;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0) 100%);
        border-bottom: 1px solid rgba(212, 175, 55, 0.2);
    }

    .timeline-track {
        display: flex;
        align-items: center;
        height: 100%;
        animation: scrollTimeline 60s linear infinite;
        will-change: transform;
    }

    .letter-spacing-2 {
        letter-spacing: 2px;
    }

    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15) !important;
    }

    @keyframes scrollTimeline {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    .timeline-item {
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 3rem;
        position: relative;
        opacity: 0.3; /* Increased from 0.3 for better visibility */
    }

    .timeline-portrait {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid var(--gold);
        object-fit: cover;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
        background: white;
        padding: 3px;
        filter: grayscale(30%);
        transition: all 0.3s ease;
    }

    .timeline-year {
        margin-top: 0.5rem;
        background: rgba(212, 175, 55, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid var(--gold);
        color: var(--gold);
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1px;
        white-space: nowrap;
    }

    .hero-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
        position: relative;
        z-index: 2;
    }

    .hero-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5rem;
        align-items: center;
    }

    /* LEFT SIDE - Carousel & Heading */
    .carousel-content-section {
        animation: fadeInLeft 1s ease-out;
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Heading Above Carousel */
    .carousel-heading {
        color: white;
        text-align: center;
        margin-bottom: 1rem; /* Reduced from 2rem to close the gap */
    }

    .carousel-badge {
        display: inline-block;
        background: rgba(212, 175, 55, 0.1);
        border: 1px solid var(--gold);
        color: var(--gold);
        padding: 0.4rem 1.2rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 0; /* Removed bottom margin */
        backdrop-filter: blur(10px);
    }

    .carousel-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        font-weight: 700;
        line-height: 1.2;
        display: none; /* Hidden as per your requirement */
    }

    .carousel-title .firm-name {
        color: var(--gold);
        display: block;
        font-size: clamp(1.5rem, 2.5vw, 2rem);
    }

    /* 3D Carousel Below Heading */
    .c-partners-container {
        width: 500px; 
        height: 500px; 
        display: flex; 
        align-items: center; 
        justify-content: center;
        margin: 0 auto;
        position: relative;
        perspective: 1200px;
    }

    /* Founder Center Image */
    .founder-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 0;
    }

    .founder-center .founder-img {
        width: 300px;
        height: 300px;
        border-radius: 50%;
        border: 5px solid white;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
        object-fit: cover;
        background: var(--light-maroon);
        padding: 5px;
    }

    .founder-center .founder-label {
        margin-top: 0.8rem;
        background: var(--gold);
        color: var(--maroon);
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        display: inline-block;
        text-transform: uppercase;
    }

    /* Carousel Circle */
    #circular-carousel {
        width: 500px;
        height: 500px;
        position: relative;
        margin: auto;
        border: none;
        background: transparent;
        transform-style: preserve-3d;
    }

    /* Carousel Images */
    #circular-carousel .carousel-img {
        position: absolute;
        left: 50%;
        top: 50%;
        transform-style: preserve-3d;
        transition: all 0.3s ease;
        text-decoration: none;
        z-index: 10;
    }

    #circular-carousel img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 5px 20px rgba(0,0,0,0.4);
        transition: all 0.3s ease;
        object-fit: cover;
    }

    #circular-carousel .carousel-img:hover img {
        transform: scale(1.2);
        border-color: var(--maroon);
        box-shadow: 0 8px 30px var(--maroon);
    }

    /* When behind founder - hide completely */
    #circular-carousel .carousel-img.behind {
        z-index: 1;
        opacity: 0;
        pointer-events: none;
    }

    .partner-info {
        position: absolute;
        bottom: -40px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--maroon);
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        white-space: nowrap;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        z-index: 20;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    .carousel-img:hover .partner-info {
        opacity: 1;
    }

    .carousel-img.behind .partner-info {
        opacity: 0 !important;
    }

    /* RIGHT SIDE - Main Content */
    .main-content-section {
        color: white;
        animation: fadeInRight 1s ease-out;
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .content-tagline {
        font-size: 1rem;
        color: var(--gold);
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
    }

    .content-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 2rem;
    }

    .content-description {
        font-size: 1.15rem;
        line-height: 1.8;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 3rem;
        max-width: 550px;
    }

    /* Statistics Section */
        .stats-section {
            /* background: linear-gradient(135deg, #f1f3f4 0%, #e8eaf6 100%); */
            padding: 10px;
            /* margin-top: 10px; */
            border-radius: 15px;
            text-align: center;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 10px;
            /* max-width: 700px; */
            margin: 0 auto;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.009);
            padding: 10px 8px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(134, 16, 67, 0.15) !important;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--maroon);
            /* margin-bottom: 10px; */
        }

        .stat-label {
            font-size: 1rem;
            color: #5a6c7d;
            font-weight: 500;
        }

        .stat-icon {
            font-size: 3rem;
            /* margin-bottom: 1rem; */
            color: var(--new-maroon);
        }

    /* CTA Buttons */
    .content-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-hero {
        padding: 1rem 2.5rem;
        font-size: 1rem;
        font-weight: 600;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        letter-spacing: 0.5px;
    }

    .btn-primary {
        background: var(--gold);
        color: var(--maroon);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
    }

    .btn-outline {
        background: transparent;
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .btn-outline:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--gold);
        color: var(--gold);
        transform: translateY(-2px);
    }

    /* Scroll Hint */
    .scroll-hint {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.85rem;
        text-align: center;
        cursor: pointer;
        animation: bounce 2s infinite;
        z-index: 3;
    }

    .scroll-hint i {
        display: block;
        font-size: 1.5rem;
        margin-bottom: 0.3rem;
    }

/* Mission & Vision Carousel Styles */
    .mission-vision-card {
        border-radius: 20px;
        overflow: hidden;
        /* transition: transform 0.3s ease, box-shadow 0.3s ease; */
        transition: all 0.3s ease;
    }

    .mission-vision-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1) !important;
    }

    .mission-indicators {
        position: static;
        margin-bottom: 0;
    }

    .mission-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid var(--new-maroon);
        background: transparent;
        margin: 0 4px;
    }

    .mission-indicators button.active {
        background: var(--new-maroon);
    }

    .icon-wrapper {
        width: 60px;
        height: 60px;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .carousel-item.active .icon-wrapper {
        transform: scale(1.1);
    }

    .mission-vision-content {
        /* padding: 1rem 0; */
    }

    .content-header {
        border-bottom: 2px solid #f8f9fa;
        /* padding-bottom: 1rem; */
    }

    .vision-list li {
        /* padding: 0.5rem 0; */
        border-bottom: 1px solid #f8f9fa;
    }

    .vision-list li:last-child {
        border-bottom: none;
    }

    .carousel-controls .carousel-control-prev,
    .carousel-controls .carousel-control-next {
        width: 45px;
        height: 45px;
        border: 2px solid var(--new-maroon);
        background: white;
        opacity: 1;
        transition: all 0.3s ease;
    }

    .carousel-controls .carousel-control-prev:hover,
    .carousel-controls .carousel-control-next:hover {
        background: var(--new-maroon);
    }

    .carousel-controls .carousel-control-prev:hover .carousel-control-prev-icon,
    .carousel-controls .carousel-control-next:hover .carousel-control-next-icon {
        filter: invert(1);
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(0.3);
    }

    .slide-indicator {
        font-size: 0.9rem;
    }

    /* Auto-slide animation enhancements */
    .carousel-item {
        transition: transform 0.8s ease-in-out;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .mission-vision-content {
            padding: 0.5rem 0;
        }
        
        .content-header {
            flex-direction: column;
            text-align: center;
            gap: 1rem !important;
        }
        
        .icon-wrapper {
            width: 50px;
            height: 50px;
        }
        
        .carousel-controls {
            flex-wrap: wrap;
        }
    }

    .features li .icon {
        /* display: block; */
        width: 20px;
        height: 20px;
        line-height: 20px;
        background-color: var(--new-maroon);
        color: var(--bs-white);

    }

    .features__v2 .icon {
    width: 60px;
    height: 60px;
    /* line-height: 60px; */
    border-radius: 50%;
    background-color: var(--white);
    color: var(--new-maroon);
    }

    .features__v2 .content {
    background-color: rgba(var(--bs-secondary-rgb), 0.2);
    }

    .features__v2 .btn-play i {
    width: 30px;
    height: 30px;
    /* line-height: 30px; */
    border-radius: 50%;
    background-color: var(--bs-white);
    color: var(--bs-primary);
    }

    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(-10px); }
    }

    .membership-logo {
        width: 250px;       /* adjust as needed */
        height: 250px;
        object-fit: contain; /* keeps image ratio without stretching */
        background-color: #fff;
        }

        /* membership */
        .membership-section {
            /* background-color: #fff; */
            padding: 3rem 0;
        }

        .logo-container {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            flex-shrink: 0;
            width: 200px;
        }

        .logo-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .membership-logo {
            max-width: 100%;
            max-height: 100px;
            object-fit: contain;
        }

        .carousel-track {
            display: flex;
            animation: scroll 20s linear infinite;
        }

        .carousel-container {
            overflow: hidden;
            position: relative;
            padding: 20px 0;
        }

        .carousel-container:hover .carousel-track {
            animation-play-state: paused;
        }

        .carousel-container::before,
        .carousel-container::after {
            content: '';
            position: absolute;
            top: 0;
            width: 100px;
            height: 100%;
            z-index: 2;
        }

        .carousel-container::before {
            left: 0;
            background: linear-gradient(to right, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%);
        }

        .carousel-container::after {
            right: 0;
            background: linear-gradient(to left, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%);
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

    /* Responsive */
    @media (max-width: 1200px) {
        .hero-grid {
            gap: 4rem;
        }
        
        .c-partners-container {
            width: 450px;
            height: 450px;
        }
        
        #circular-carousel {
            width: 450px;
            height: 450px;
        }
        
        .founder-center .founder-img {
            width: 250px;
            height: 250px;
        }
        
        #circular-carousel img {
            width: 65px;
            height: 65px;
        }
    }

    @media (max-width: 991px) {
        .hero-landing {
            padding: 8rem 0 3rem 0;
        }

        .hero-grid {
            grid-template-columns: 1fr;
            gap: 3rem;
        }
        
        .carousel-content-section {
            order: 1;
        }
        
        .main-content-section {
            order: 2;
            text-align: center;
        }
        
        .content-description {
            margin-left: auto;
            margin-right: auto;
        }
        
        .stats-grid {
            justify-content: center;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .content-buttons {
            justify-content: center;
        }
        
        .c-partners-container {
            width: 400px;
            height: 400px;
        }
        
        #circular-carousel {
            width: 400px;
            height: 400px;
        }
        
        .founder-center .founder-img {
            width: 200px;
            height: 200px;
        }
        
        .timeline-ribbon {
            height: 100px;
        }
        
        .timeline-portrait {
            width: 70px;
            height: 70px;
        }
    }

    @media (max-width: 768px) {
        .hero-landing {
            min-height: auto;
            padding: 7rem 0 3rem 0;
        }
        
        .c-partners-container {
            width: 350px;
            height: 350px;
        }
        
        #circular-carousel {
            width: 350px;
            height: 350px;
        }
        
        .founder-center .founder-img {
            width: 180px;
            height: 180px;
            border-width: 4px;
        }
        
        .founder-center .founder-label {
            font-size: 0.7rem;
            padding: 0.3rem 0.8rem;
        }
        
        #circular-carousel img {
            width: 55px;
            height: 55px;
            border-width: 2px;
        }
        
        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
        }
        
        .timeline-ribbon {
            height: 90px;
        }
        
        .timeline-portrait {
            width: 60px;
            height: 60px;
        }
        
        .timeline-item {
            margin: 0 2rem;
        }
    }

    @media (max-width: 576px) {
        .hero-landing {
            padding: 6rem 0 3rem 0;
        }

        .c-partners-container {
            width: 350px;
            height: 350px;
        }
        
        #circular-carousel {
            width: 350px;
            height: 350px;
        }
        
        .founder-center .founder-img {
            width: 190px;
            height: 190px;
        }
        
        #circular-carousel img {
            width: 50px;
            height: 50px;
        }
        
        .stats-grid {
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        .btn-hero {
            width: 100%;
            max-width: 280px;
        }
        
        .timeline-ribbon {
            height: 80px;
        }
        
        .timeline-portrait {
            width: 50px;
            height: 50px;
            border-width: 2px;
        }
        
        .timeline-year {
            font-size: 0.65rem;
            padding: 0.2rem 0.6rem;
        }
        
        .timeline-item {
            margin: 0 1.5rem;
        }
    }
</style>

@section('content')
    <section class="hero-landing">
        <!-- Timeline Ribbon - NOW AT TOP -->
        <div class="timeline-ribbon">
            <div class="timeline-track" id="timelineTrack">
                <!-- Timeline items will be generated via JavaScript -->
            </div>
        </div>

        <div class="hero-container">
            <div class="hero-grid">
                <!-- LEFT SIDE - Heading + 3D Carousel -->
                <div class="carousel-content-section">
                    <!-- Heading Above Carousel -->
                    <div class="carousel-heading">
                        <div class="carousel-badge">Since 1894</div>
                        <h2 class="carousel-title">
                            Legal Excellence
                            <span class="firm-name">Scanlen & Holderness</span>
                        </h2>
                    </div>

                    <!-- 3D Carousel -->
                    <div class="c-partners-container">
                        <!-- Founder Center -->
                        <div class="founder-center">
                            <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" 
                                alt="Sir Thomas Scanlen" 
                                class="founder-img">
                            <div class="founder-label">Founder</div>
                        </div>

                        <!-- 3D Carousel -->
                        <div id="circular-carousel">
                            @if(isset($partners) && $partners->count() > 0)
                                @foreach($partners as $index => $partner)
                                    <a href="{{ route('our-people.partner', $partner->slug) }}" 
                                    class="carousel-img" 
                                    title="{{ $partner->name }}">
                                        <img src="{{ $partner->avatar ? asset('storage/' . $partner->avatar) : asset('images/default-avatar.png') }}" 
                                            alt="{{ $partner->name }}">
                                        <div class="partner-info">
                                            {{ $partner->name }}
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <!-- Fallback -->
                                <a href="#" class="carousel-img">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Partner">
                                    <div class="partner-info">Current Partner</div>
                                </a>
                                <a href="#" class="carousel-img">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Partner">
                                    <div class="partner-info">Current Partner</div>
                                </a>
                                <a href="#" class="carousel-img">
                                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Partner">
                                    <div class="partner-info">Current Partner</div>
                                </a>
                                <a href="#" class="carousel-img">
                                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Partner">
                                    <div class="partner-info">Current Partner</div>
                                </a>
                                <a href="#" class="carousel-img">
                                    <img src="https://randomuser.me/api/portraits/men/86.jpg" alt="Partner">
                                    <div class="partner-info">Current Partner</div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE - Main Content -->
                <div class="main-content-section">
                    <div class="content-tagline">Heritage • Excellence • Trust</div>
                    
                    <h1 class="content-title">
                        Building On<br>
                        A Legacy Of Trust
                    </h1>

                    <p class="content-description">
                        For over a century, we've been delivering exceptional legal counsel 
                        to clients who demand excellence. Our heritage of distinguished service 
                        continues with today's leading attorneys.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="content-buttons">
                        <a href="{{route('contactUs')}}" class="btn-hero btn-primary">Schedule Consultation</a>
                        <a href="#about" class="btn-hero btn-outline">Learn More</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Hint -->
        <div class="scroll-hint" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
            <i class="fas fa-chevron-down"></i>
            <span>Scroll</span>
        </div>
    </section>

    <!-- IMPROVED ABOUT SECTION WITH BETTER SPACING -->
    <section class="company-overview-section py-5 bg-light" id="about">
        <div class="container">
            <!-- Stats Section Moved to Top for Impact -->
            @if($statistics->count() > 0)
            <div class="text-center mb-5">
                <h5 class="text-uppercase text-maroon fw-bold mb-4 letter-spacing-2">Our Track Record</h5>
                <div class="row g-4 justify-content-center">
                    @foreach($statistics as $stat)
                    <div class="col-6 col-md-3">
                        <div class="stat-card bg-white rounded-3 shadow-sm p-4 h-100">
                            @if($stat->icon)
                            <div class="stat-icon mb-3">
                                <i class="{{ $stat->icon }} text-maroon" style="font-size: 2.5rem;"></i>
                            </div>
                            @endif
                            <div class="stat-number text-maroon fw-bold" style="font-size: 2.5rem;">{{ $stat->value }}</div>
                            <div class="stat-label text-muted">{{ $stat->label }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Main Content -->
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="pe-lg-5">
                        <span class="badge bg-maroon text-white mb-3 px-3 py-2">EST. 1894</span>
                        <h2 class="display-5 fw-bold mb-4">About Scanlen & Holderness</h2>
                        <p class="lead text-maroon mb-4">Legal Excellence Since 1894</p>
                        <p class="text-muted mb-4" style="line-height: 1.8;">
                            Scanlen & Holderness is a premier Zimbabwean law firm offering you a full circle of legal services 
                            whether you are a local, regional or international client. Our quality of expertise consistently earns 
                            us and our lawyers a top ranking in both local and international legal surveys.
                        </p>
                        <p class="text-muted mb-4" style="line-height: 1.8;">
                            Throughout history Team Scanlen has proudly influenced jurisprudential development in Zimbabwe. 
                            Our continued involvement in landmark cases sets precedent in many areas of law.
                        </p>
                        
                        <!-- Key Features -->
                        <div class="row g-3 mt-4">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-maroon me-2 fs-5"></i>
                                    <span class="fw-semibold">Premier Legal Services</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-maroon me-2 fs-5"></i>
                                    <span class="fw-semibold">Top Rankings</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-maroon me-2 fs-5"></i>
                                    <span class="fw-semibold">Landmark Cases</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-maroon me-2 fs-5"></i>
                                    <span class="fw-semibold">Global Recognition</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Video Section -->
                <div class="col-lg-6">
                    <div class="position-relative">
                        <h3 class="fw-bold mb-3">Our Story in Motion</h3>
                        <p class="text-muted mb-4">Watch our firm overview to learn more about our history and values</p>
                        
                        <div class="ratio ratio-16x9 rounded-3 shadow-lg overflow-hidden">
                            <video width="320" height="240" autoplay muted>
                                <source src="{{asset('videos/law.mp4')}}" type="video/mp4">
                            </video>
                            {{-- <iframe src="https://www.youtube.com/embed/Z4Mpu5Ansl0" 
                                    title="About Scanlen & Holderness"
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- IMPROVED MISSION & VISION SECTION -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                <!-- Mission Card -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg h-100 mission-vision-card">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-wrapper bg-maroon text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                    <i class="bi bi-bullseye fs-3"></i>
                                </div>
                                <h3 class="text-uppercase fw-bold text-maroon mb-0">Our Mission</h3>
                            </div>
                            <p class="text-muted" style="line-height: 1.8;">
                                To continue to be the leading firm at all times offering the finest legal services timeously 
                                and efficiently in a friendly atmosphere to the corporate and business world, investors, property 
                                owners and those individuals with high impact cases. We are committed to upholding the integrity 
                                of our profession while making a real difference in the lives of our people.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Vision Card -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg h-100 mission-vision-card">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-wrapper bg-maroon text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                    <i class="bi bi-eye fs-3"></i>
                                </div>
                                <h3 class="text-uppercase fw-bold text-maroon mb-0">Our Vision</h3>
                            </div>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-start mb-3">
                                    <i class="bi bi-check-circle-fill text-maroon me-3 mt-1"></i>
                                    <span class="text-muted">To become a one stop firm for all corporate and commercial legal matters and kindred services</span>
                                </li>
                                <li class="d-flex align-items-start mb-3">
                                    <i class="bi bi-check-circle-fill text-maroon me-3 mt-1"></i>
                                    <span class="text-muted">To be the clear choice for potential clients consistently providing service in excellence with global recognition</span>
                                </li>
                                <li class="d-flex align-items-start mb-3">
                                    <i class="bi bi-check-circle-fill text-maroon me-3 mt-1"></i>
                                    <span class="text-muted">To be influential in all matters of jurisprudence at all levels of society</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="bi bi-check-circle-fill text-maroon me-3 mt-1"></i>
                                    <span class="text-muted">To attain and maintain a certain living standard for our people</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Core Values - Single Clean Section -->
            <div class="mt-5 pt-4">
                <h3 class="text-center fw-bold mb-4">Our Core Values</h3>
                <div class="row g-4 justify-content-center">
                    <div class="col-6 col-md-3">
                        <div class="text-center p-4 bg-light rounded-3 h-100">
                            <i class="bi bi-shield-check text-maroon fs-1 mb-3"></i>
                            <h5 class="fw-bold">Integrity</h5>
                            <p class="small text-muted mb-0">Uncompromising ethical standards</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="text-center p-4 bg-light rounded-3 h-100">
                            <i class="bi bi-gem text-maroon fs-1 mb-3"></i>
                            <h5 class="fw-bold">Excellence</h5>
                            <p class="small text-muted mb-0">Highest quality legal services</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="text-center p-4 bg-light rounded-3 h-100">
                            <i class="bi bi-people text-maroon fs-1 mb-3"></i>
                            <h5 class="fw-bold">Respect</h5>
                            <p class="small text-muted mb-0">Valuing diverse perspectives</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="text-center p-4 bg-light rounded-3 h-100">
                            <i class="bi bi-lightbulb text-maroon fs-1 mb-3"></i>
                            <h5 class="fw-bold">Innovation</h5>
                            <p class="small text-muted mb-0">Embracing new ideas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- IMPROVED HOW WE WORK SECTION -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-maroon text-white mb-3 px-3 py-2">OUR APPROACH</span>
                <h2 class="display-6 fw-bold mb-3">How We Work</h2>
                <p class="text-muted mx-auto" style="max-width: 700px;">
                    We have a culture of collaborating with our clients to ensure that we tailor advice 
                    that minimizes clients' risk, propagating client objectives whatever they may be.
                </p>
            </div>

            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <div class="card-body">
                            <div class="bg-maroon text-white rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="bi bi-balloon-heart fs-1"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Client-Centric Approach</h4>
                            <p class="text-muted mb-0">
                                We listen first, then develop tailored legal strategies that align with your 
                                business objectives and personal goals.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <div class="card-body">
                            <div class="bg-maroon text-white rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="bi bi-people fs-1"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Collaborative Teams</h4>
                            <p class="text-muted mb-0">
                                Multi-disciplinary teams work together to provide comprehensive solutions 
                                across all legal practice areas.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <div class="card-body">
                            <div class="bg-maroon text-white rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="bi bi-graph-up-arrow fs-1"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Strategic Innovation</h4>
                            <p class="text-muted mb-0">
                                We leverage technology and innovative thinking to deliver efficient, 
                                cost-effective legal services.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-5 p-4 bg-white rounded-3 shadow-sm">
                <p class="text-muted mb-0" style="line-height: 1.8;">
                    We believe in long term relationships, relationships which can only be built if we are 
                    trustworthy, open and fair to our clients and to each other. Work in our teams is distributed 
                    according to the complexity of the matter and the ability of the practitioners handling the work. 
                    The engagement partner(s) will weigh the complexity of the matter, distribute the work to be done and 
                    monitor the quality of work produced.
                </p>
            </div>
        </div>
    </section>

    <!-- IMPROVED AWARDS SECTION -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-maroon text-white mb-3 px-3 py-2">RECOGNITION</span>
                <h2 class="display-6 fw-bold mb-3">Awards & Achievements</h2>
            </div>
            
            @if($awards->count() > 0)
            <div class="row g-4 d-flex justify-content-center">
                @foreach($awards as $award)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4 hover-lift">
                        <div class="card-body">
                            @if($award->image_url)
                            <img src="{{ $award->image_url }}" alt="{{ $award->title }}" 
                                class="img-fluid mb-3 rounded-circle mx-auto d-block" style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                            <div class="bg-light rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="bi bi-trophy text-maroon" style="font-size: 3rem;"></i>
                            </div>
                            @endif
                            <h5 class="fw-bold mb-2">{{ $award->title }}</h5>
                            <p class="small text-muted mb-1">{{ $award->issuing_organization }}</p>
                            <p class="small text-maroon fw-semibold">{{ $award->year }}</p>
                            @if($award->description)
                            <p class="small text-muted mt-2 mb-0">{{ Str::limit($award->description, 100) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-5">
                <div class="bg-light rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                    <i class="bi bi-trophy text-muted" style="font-size: 4rem;"></i>
                </div>
                <p class="text-muted">Our achievements will be showcased here soon.</p>
            </div>
            @endif
        </div>
    </section>

    {{-- PROFESSIONAL MEMBERSHIP --}} 
    <section class="membership-section bg-light p-5 border-top">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="section-title mb-2 text-uppercase text-center">Professional Memberships</h2>
                    <p class="section-description mb-5 text-center">Our clients are our top priority, and we are committed to providing them with the highest level of service.</p>
                    <hr class="divider mb-5 mb-xl-9">
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="carousel-container">
                <div class="carousel-track">
                    <!-- Original Logos -->
                    <div class="logo-container">
                        <a href="https://chambers.com/" target="_blank" class="text-decoration-none">
                            <img src="{{asset('images/champers.jpg')}}" class="membership-logo" alt="Champers">
                        </a>
                    </div>
                    <div class="logo-container">
                        <a href="https://lexafrica.com/" target="_blank" class="text-decoration-none">
                            <img src="{{asset('images/lexafrica.png')}}" class="membership-logo" alt="Lex Africa">
                        </a>
                    </div>
                    <div class="logo-container">
                        <a href="https://www.meritas.org/" target="_blank" class="text-decoration-none">
                            <img src="{{asset('images/meritas_logo.png')}}" class="membership-logo" alt="Maritas">
                        </a>
                    </div>
                    
                    
                    <!-- Duplicate Logos for Seamless Loop -->
                    <div class="logo-container">
                        <a href="https://chambers.com/" target="_blank" class="text-decoration-none">
                            <img src="{{asset('images/champers.jpg')}}" class="membership-logo" alt="Champers">
                        </a>
                    </div>
                    <div class="logo-container">
                        <a href="https://lexafrica.com/" target="_blank" class="text-decoration-none">
                            <img src="{{asset('images/lexafrica.png')}}" class="membership-logo" alt="Lex Africa">
                        </a>
                    </div>
                    <div class="logo-container">
                        <a href="https://www.meritas.org/" target="_blank" class="text-decoration-none">
                            <img src="{{asset('images/meritas_logo.png')}}" class="membership-logo" alt="Maritas">
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>


    {{-- FIND A LAWYER --}}
    <section class="find-lawyer p-5 bg-white text-center">
        <div class="bg-body-secondary p-5 rounded">
            <h3 class="fw-bold text-maroon mb-4">Find A Lawyer</h3>
            <form action="{{ route('our-people.find-lawyer') }}" method="GET">
                <div class="row g-3 justify-content-center">
                    <div class="col-lg-3 col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Search By Name" value="{{ request('name') }}">
                    </div>
                    <div class="col-lg-1 col-12 d-flex align-items-center justify-content-center">
                        <span class="fw-bold">OR</span>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <select name="expertise" class="form-select">
                            <option value="">EXPERTISE</option>
                            @if(isset($allExpertise))
                                @foreach($allExpertise as $expertise)
                                    <option value="{{ $expertise->id }}" {{ request('expertise') == $expertise->id ? 'selected' : '' }}>
                                        {{ $expertise->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <select name="category" class="form-select">
                            <option value="">CATEGORIES</option>
                            @if(isset($sectors))
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}" {{ request('category') == $sector->id ? 'selected' : '' }}>
                                        {{ $sector->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <button type="submit" class="btn btn-danger w-100">Search</button>
                    </div>
                </div>
            </form>

            <a href="{{route('our-people.find-lawyer')}}" class="btn btn-outline-danger mt-5">View All <i class="bi bi-arrow-up-right-circle-fill ms-2"></i></a>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ===== TIMELINE RIBBON =====
            const timelineTrack = document.getElementById('timelineTrack');
            
            // Historical partners data with years
            const historicalPartners = [
                { image: '{{ asset("images/oldpartners/scanlen.jpeg") }}', year: '1894' },
                { image: '{{ asset("images/oldpartners/op1.jpeg") }}', year: '1902' },
                { image: '{{ asset("images/oldpartners/op2.jpeg") }}', year: '1915' },
                { image: '{{ asset("images/oldpartners/op3.jpeg") }}', year: '1928' },
                { image: '{{ asset("images/oldpartners/op4.jpeg") }}', year: '1935' },
                { image: '{{ asset("images/oldpartners/op5.jpeg") }}', year: '1947' },
                { image: '{{ asset("images/oldpartners/op6.jpeg") }}', year: '1956' },
                { image: '{{ asset("images/oldpartners/op7.jpeg") }}', year: '1968' },
                { image: '{{ asset("images/oldpartners/op8.jpeg") }}', year: '1979' },
            ];
            
            function createTimelineItem(partner) {
                return `
                    <div class="timeline-item">
                        <img src="${partner.image}" alt="Partner ${partner.year}" class="timeline-portrait">
                        <div class="timeline-year">${partner.year}</div>
                    </div>
                `;
            }
            
            // Create timeline items (duplicate for seamless loop)
            let timelineHTML = '';
            historicalPartners.forEach(partner => {
                timelineHTML += createTimelineItem(partner);
            });
            // Duplicate for seamless infinite scroll
            historicalPartners.forEach(partner => {
                timelineHTML += createTimelineItem(partner);
            });
            
            timelineTrack.innerHTML = timelineHTML;
            
            // ===== 3D CAROUSEL =====
            const carousel = document.getElementById('circular-carousel');
            if (!carousel) return;
            
            const images = carousel.querySelectorAll('.carousel-img');
            const total = images.length;
            
            if (total === 0) return;
            
            let radius = 180;
            let angle = 0;
            let animationId;
            const rotationSpeed = 0.25;

            function getResponsiveValues() {
                const width = window.innerWidth;
                
                if (width <= 576) {
                    radius = 115;
                } else if (width <= 768) {
                    radius = 135;
                } else if (width <= 991) {
                    radius = 155;
                } else if (width <= 1200) {
                    radius = 170;
                } else {
                    radius = 180;
                }
            }

            function positionImages() {
                const angleStep = (2 * Math.PI) / total;
                
                for (let i = 0; i < total; i++) {
                    const currentAngle = (angle * Math.PI / 180) + (angleStep * i);
                    const x = Math.sin(currentAngle) * radius;
                    const z = Math.cos(currentAngle) * radius;
                    const scale = (z + radius) / (radius * 2) * 0.4 + 0.6;
                    
                    images[i].style.transform = `
                        translate(-50%, -50%)
                        translateX(${x}px)
                        translateZ(${z}px)
                        scale(${scale})
                    `;
                    
                    if (z < 0) {
                        images[i].classList.add('behind');
                        images[i].style.zIndex = 1;
                    } else {
                        images[i].classList.remove('behind');
                        images[i].style.zIndex = 10;
                    }
                }
            }

            function animate() {
                angle += rotationSpeed;
                if (angle >= 360) angle = 0;
                positionImages();
                animationId = requestAnimationFrame(animate);
            }

            function initialize() {
                getResponsiveValues();
                positionImages();
            }

            initialize();
            animate();
            
            carousel.addEventListener('mouseenter', () => cancelAnimationFrame(animationId));
            carousel.addEventListener('mouseleave', () => animationId = requestAnimationFrame(animate));
            
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    cancelAnimationFrame(animationId);
                    initialize();
                    animationId = requestAnimationFrame(animate);
                }, 250);
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
        });
    </script>
@endsection
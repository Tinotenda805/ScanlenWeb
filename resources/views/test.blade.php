@extends('layouts.app')

@section('content')

<style>
:root {
    --maroon: #3c0008;
    --light-maroon: #50010b;
    --light-gray: #f8f9fa;
    --gold: #d4af37;
}

/* Hero Section */
.hero-landing {
    min-height: 100vh;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.85) 0%, rgba(60, 0, 8, 0.4) 100%),
                url('../images/scales.jpg') center/cover;
    position: relative;
    display: flex;
    align-items: center;
    padding: 4rem 0;
    overflow: hidden;
}

/* Floating Historical Portraits */
.floating-portraits {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    pointer-events: none;
}

.floating-portrait {
    position: absolute;
    opacity: 0;
    transition: opacity 2s ease-in-out;
    filter: blur(1px) grayscale(50%);
}

.floating-portrait.active {
    opacity: 0.5;
}

.floating-portrait img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 3px solid rgba(212, 175, 55, 0.3);
    object-fit: cover;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
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
    margin-bottom: 2rem;
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
    margin-bottom: 1rem;
    backdrop-filter: blur(10px);
}

.carousel-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 0.5rem;
    display: none;
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

/* Founder Center Image - BEHIND carousel */
.founder-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 0; /* Middle layer */
    text-align: center;
}

.founder-center .founder-img {
    width: 300px;
    height: 300px;
    border-radius: 50%;
    border: 5px solid var(--gold);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
    object-fit: cover;
    background: white;
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
    z-index: 10; /* Front by default */
}

#circular-carousel img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 3px solid white;
    box-shadow: 0 5px 20px rgba(0,0,0,0.4);
    transition: all 0.3s ease;
    object-fit: cover;
}

#circular-carousel .carousel-img:hover img {
    transform: scale(1.2);
    border-color: var(--gold);
    box-shadow: 0 8px 30px rgba(212, 175, 55, 0.6);
}

/* When behind founder - hide completely */
#circular-carousel .carousel-img.behind {
    z-index: 1; /* Behind founder */
    opacity: 0; /* Invisible */
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

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    margin-bottom: 3rem;
}

.stat-item {
    text-align: left;
}

.stat-number {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 3rem;
    font-weight: 700;
    color: var(--gold);
    line-height: 1;
    display: block;
    margin-bottom: 0.3rem;
}

.stat-label {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.7);
    text-transform: uppercase;
    letter-spacing: 1px;
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
}

.scroll-hint i {
    display: block;
    font-size: 1.5rem;
    margin-bottom: 0.3rem;
}

@keyframes bounce {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50% { transform: translateX(-50%) translateY(-10px); }
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
        width: 180px;
        height: 180px;
    }
    
    #circular-carousel img {
        width: 65px;
        height: 65px;
    }
}

@media (max-width: 991px) {
    .hero-grid {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
    
    .carousel-content-section {
        order: 2;
    }
    
    .main-content-section {
        order: 1;
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
        width: 160px;
        height: 160px;
    }
}

@media (max-width: 768px) {
    .hero-landing {
        min-height: auto;
        padding: 3rem 0;
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
        width: 140px;
        height: 140px;
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
    
    .floating-portrait img {
        width: 100px;
        height: 100px;
        border-width: 2px;
    }
}

@media (max-width: 576px) {
    .c-partners-container {
        width: 300px;
        height: 300px;
    }
    
    #circular-carousel {
        width: 300px;
        height: 300px;
    }
    
    .founder-center .founder-img {
        width: 120px;
        height: 120px;
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
    
    .floating-portrait img {
        width: 80px;
        height: 80px;
    }
}
</style>

<section class="hero-landing">
    <!-- Floating Historical Portraits Background -->
    <div class="floating-portraits" id="floatingPortraits">
        <!-- These will be populated dynamically via JavaScript -->
    </div>

    <div class="hero-container">
        <div class="hero-grid">
            <!-- LEFT SIDE - Heading + 3D Carousel -->
            <div class="carousel-content-section">
                <!-- Heading Above Carousel -->
                <div class="carousel-heading">
                    <div class="carousel-badge">Since 1895</div>
                    <h2 class="carousel-title">
                        Legal Excellence
                        <span class="firm-name">Scanlen & Holderness</span>
                    </h2>
                </div>

                <!-- 3D Carousel -->
                <div class="c-partners-container">
                    <!-- Founder Center (BEHIND) -->
                    <div class="founder-center">
                        <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" 
                             alt="Sir Thomas Scanlen" 
                             class="founder-img">
                        <div class="founder-label">Founder</div>
                    </div>

                    <!-- 3D Carousel (FRONT) -->
                    <div id="circular-carousel" >
                        @if(isset($partners) && $partners->count() > 0)
                            @foreach($partners as $index => $partner)
                                <a href="{{ route('our-people.partner', $partner->id) }}" 
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

                <!-- Stats -->
                <div class="stats-grid" style="display: none">
                    <div class="stat-item">
                        <span class="stat-number">129+</span>
                        <span class="stat-label">Years</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">Attorneys</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">98%</span>
                        <span class="stat-label">Success</span>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="content-buttons">
                    <a href="#contact" class="btn-hero btn-primary">Schedule Consultation</a>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== FLOATING HISTORICAL PORTRAITS =====
    const floatingContainer = document.getElementById('floatingPortraits');
    
    // List of old partner images - ADD YOUR IMAGE PATHS HERE
    const oldPartners = [
        '{{ asset("images/oldpartners/op1.jpeg") }}',
        '{{ asset("images/oldpartners/op2.jpeg") }}',
        '{{ asset("images/oldpartners/op3.jpeg") }}',
        '{{ asset("images/oldpartners/op4.jpeg") }}',
        '{{ asset("images/oldpartners/op5.jpeg") }}',
        '{{ asset("images/oldpartners/op6.jpeg") }}',
        '{{ asset("images/oldpartners/op7.jpeg") }}',
        '{{ asset("images/oldpartners/op8.jpeg") }}',
        '{{ asset("images/oldpartners/op8.jpeg") }}',
        // Add more paths as needed
    ];
    
    const maxVisiblePortraits = 4; // Number of portraits visible at once
    const fadeInterval = 8000; // How long each portrait stays (8 seconds)
    
    let activePortraits = [];
    
    function getRandomPosition() {
        // Generate random positions, avoiding center where main content is
        const side = Math.random() > 0.5 ? 'left' : 'right';
        const x = side === 'left' 
            ? Math.random() * 30  // Left 25% of screen
            : 75 + Math.random() * 25; // Right 25% of screen
        const y = Math.random() * 100; // Any vertical position
        
        return { x, y };
    }
    
    function createFloatingPortrait(imageSrc) {
        const portrait = document.createElement('div');
        portrait.className = 'floating-portrait';
        
        const pos = getRandomPosition();
        portrait.style.left = pos.x + '%';
        portrait.style.top = pos.y + '%';
        
        const img = document.createElement('img');
        img.src = imageSrc;
        img.alt = 'Historical Partner';
        
        portrait.appendChild(img);
        floatingContainer.appendChild(portrait);
        
        // Fade in after a brief delay
        setTimeout(() => portrait.classList.add('active'), 100);
        
        return portrait;
    }
    
    function removePortrait(portrait) {
        portrait.classList.remove('active');
        setTimeout(() => {
            if (portrait.parentNode) {
                portrait.parentNode.removeChild(portrait);
            }
        }, 2000); // Wait for fade out transition
    }
    
    function cyclePortraits() {
        // Remove oldest portrait if we're at max
        if (activePortraits.length >= maxVisiblePortraits) {
            const oldestPortrait = activePortraits.shift();
            removePortrait(oldestPortrait);
        }
        
        // Add new random portrait
        const randomImage = oldPartners[Math.floor(Math.random() * oldPartners.length)];
        const newPortrait = createFloatingPortrait(randomImage);
        activePortraits.push(newPortrait);
    }
    
    // Initialize with some portraits
    for (let i = 0; i < maxVisiblePortraits; i++) {
        setTimeout(() => cyclePortraits(), i * 2000);
    }
    
    // Continue cycling
    setInterval(cyclePortraits, fadeInterval);
    
    
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
            
            // Images behind founder (negative Z) are hidden
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
});
</script>

@endsection
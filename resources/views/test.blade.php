@extends('layouts.app')

@section('content')

<style>
:root {
    --maroon: #3c0008;
    --gold: #d4af37;
    --dark: #1a1a1a;
}

/* Main Landing Container */
.landing-hero {
    min-height: 100vh;
    background: linear-gradient(135deg, #1a1a1a 0%, var(--maroon) 100%);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    padding: 2rem 0;
}

/* Animated Background Shapes */
.landing-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 800px;
    height: 800px;
    background: radial-gradient(circle, rgba(212, 175, 55, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 20s ease-in-out infinite;
}

.landing-hero::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -15%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(212, 175, 55, 0.08) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 15s ease-in-out infinite reverse;
}

@keyframes float {
    0%, 100% { transform: translateY(0) translateX(0); }
    50% { transform: translateY(-30px) translateX(20px); }
}

/* Container Layout */
.landing-container {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

.landing-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

/* Left Side - 3D Globe Carousel */
.globe-container {
    position: relative;
    width: 100%;
    max-width: 600px;
    height: 600px;
    margin: 0 auto;
    perspective: 1500px;
}

/* Center Founder Image */
.founder-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 100;
    text-align: center;
}

.founder-img {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    border: 6px solid var(--gold);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    object-fit: cover;
    background: #fff;
    padding: 6px;
}

.founder-label {
    margin-top: 1rem;
    background: var(--gold);
    color: var(--dark);
    padding: 0.7rem 1.5rem;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
}

/* 3D Carousel Stage */
.carousel-3d-stage {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    transform-style: preserve-3d;
    transform: translate(-50%, -50%);
    animation: rotate3d 30s linear infinite;
}

/* Pause on hover */
.globe-container:hover .carousel-3d-stage {
    animation-play-state: paused;
}

/* Partner Cards in 3D Space */
.partner-card-3d {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 120px;
    height: 160px;
    transform-style: preserve-3d;
    transition: all 0.3s ease;
}

.partner-card-3d img {
    width: 100%;
    height: 120px;
    border-radius: 15px;
    border: 4px solid white;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    object-fit: cover;
    transition: all 0.3s ease;
    filter: grayscale(30%);
}

.partner-card-3d:hover img {
    transform: scale(1.15);
    border-color: var(--gold);
    filter: grayscale(0%);
    box-shadow: 0 15px 40px rgba(212, 175, 55, 0.5);
}

.partner-label {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(60, 0, 8, 0.95);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.8rem;
    white-space: nowrap;
    font-weight: 600;
    opacity: 0;
    transition: opacity 0.3s ease;
    backdrop-filter: blur(10px);
}

.partner-card-3d:hover .partner-label {
    opacity: 1;
}

/* Hide cards when behind center */
.partner-card-3d.behind {
    opacity: 0.3;
    pointer-events: none;
}

/* 3D Rotation Animation */
@keyframes rotate3d {
    from {
        transform: translate(-50%, -50%) rotateY(0deg);
    }
    to {
        transform: translate(-50%, -50%) rotateY(360deg);
    }
}

/* Right Side - Content */
.landing-content {
    color: white;
    animation: fadeInRight 1s ease-out;
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.landing-subtitle {
    font-size: 0.9rem;
    letter-spacing: 4px;
    color: var(--gold);
    text-transform: uppercase;
    font-weight: 600;
    margin-bottom: 1.5rem;
    animation: fadeIn 0.8s ease-out 0.2s both;
}

.landing-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(2.5rem, 6vw, 5rem);
    font-weight: 700;
    line-height: 1.1;
    margin-bottom: 2rem;
    animation: fadeIn 0.8s ease-out 0.4s both;
}

.landing-title .highlight {
    color: var(--gold);
}

.landing-description {
    font-size: 1.2rem;
    line-height: 1.8;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 3rem;
    max-width: 600px;
    animation: fadeIn 0.8s ease-out 0.6s both;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    margin-bottom: 3rem;
    animation: fadeIn 0.8s ease-out 0.8s both;
}

.stat-box {
    text-align: left;
}

.stat-number {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 3.5rem;
    font-weight: 700;
    color: var(--gold);
    line-height: 1;
    display: block;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.7);
    text-transform: uppercase;
    letter-spacing: 2px;
}

/* CTA Buttons */
.cta-buttons {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    animation: fadeIn 0.8s ease-out 1s both;
}

.btn-primary, .btn-secondary {
    padding: 1.2rem 3rem;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    display: inline-block;
    letter-spacing: 1px;
    position: relative;
    overflow: hidden;
    border-radius: 50px;
}

.btn-primary {
    background: var(--gold);
    color: var(--dark);
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s;
}

.btn-primary:hover::before {
    left: 100%;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(212, 175, 55, 0.6);
}

.btn-secondary {
    background: transparent;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.4);
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: var(--gold);
    color: var(--gold);
    transform: translateY(-3px);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Scroll Indicator */
.scroll-indicator {
    position: absolute;
    bottom: 3rem;
    left: 50%;
    transform: translateX(-50%);
    color: rgba(255, 255, 255, 0.6);
    text-align: center;
    cursor: pointer;
    animation: bounce 2s infinite;
}

.scroll-indicator i {
    font-size: 2rem;
    display: block;
    margin-bottom: 0.5rem;
}

@keyframes bounce {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50% { transform: translateX(-50%) translateY(-10px); }
}

/* Responsive Design */
@media (max-width: 1200px) {
    .landing-grid {
        gap: 3rem;
    }
    
    .globe-container {
        max-width: 500px;
        height: 500px;
    }
    
    .founder-img {
        width: 150px;
        height: 150px;
    }
    
    .partner-card-3d {
        width: 100px;
        height: 140px;
    }
    
    .partner-card-3d img {
        height: 100px;
    }
}

@media (max-width: 991px) {
    .landing-grid {
        grid-template-columns: 1fr;
        gap: 4rem;
    }
    
    .globe-container {
        max-width: 450px;
        height: 450px;
        order: 1;
    }
    
    .landing-content {
        order: 2;
        text-align: center;
    }
    
    .landing-description {
        margin-left: auto;
        margin-right: auto;
    }
    
    .stats-grid {
        justify-content: center;
    }
    
    .stat-box {
        text-align: center;
    }
    
    .cta-buttons {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .landing-hero {
        min-height: auto;
        padding: 3rem 0;
    }
    
    .globe-container {
        max-width: 380px;
        height: 380px;
    }
    
    .founder-img {
        width: 120px;
        height: 120px;
        border-width: 4px;
    }
    
    .founder-label {
        font-size: 0.85rem;
        padding: 0.5rem 1.2rem;
    }
    
    .partner-card-3d {
        width: 85px;
        height: 115px;
    }
    
    .partner-card-3d img {
        height: 85px;
        border-width: 3px;
    }
    
    .landing-title {
        font-size: 2.5rem;
    }
    
    .stat-number {
        font-size: 2.5rem;
    }
    
    .stats-grid {
        gap: 1.5rem;
    }
}

@media (max-width: 480px) {
    .globe-container {
        max-width: 320px;
        height: 320px;
    }
    
    .founder-img {
        width: 100px;
        height: 100px;
    }
    
    .partner-card-3d {
        width: 70px;
        height: 95px;
    }
    
    .partner-card-3d img {
        height: 70px;
        border-width: 2px;
    }
    
    .landing-title {
        font-size: 2rem;
    }
    
    .btn-primary, .btn-secondary {
        width: 100%;
        max-width: 300px;
    }
}
</style>

<section class="landing-hero">
    <div class="landing-container">
        <div class="landing-grid">
            <!-- Left Side - 3D Globe with Partners -->
            <div class="globe-container">
                <!-- Center Founder -->
                <div class="founder-center">
                    <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" 
                         alt="Sir Thomas Scanlen" 
                         class="founder-img">
                    <div class="founder-label">Est. 1895</div>
                </div>

                <!-- 3D Rotating Globe -->
                <div class="carousel-3d-stage" id="globe3d">
                    <!-- Old partners will be positioned here by JavaScript -->
                </div>
            </div>

            <!-- Right Side - Content -->
            <div class="landing-content">
                <div class="landing-subtitle">Excellence Since 1895</div>
                
                <h1 class="landing-title">
                    Legacy Meets<br>
                    <span class="highlight">Legal Excellence</span>
                </h1>

                <p class="landing-description">
                    For over a century, we've been building on the foundation laid by 
                    distinguished legal minds. Today, our current partners continue this 
                    tradition of excellence in legal practice.
                </p>

                <!-- Stats -->
                <div class="stats-grid">
                    <div class="stat-box">
                        <span class="stat-number">129+</span>
                        <span class="stat-label">Years Excellence</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">Expert Attorneys</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">5,000+</span>
                        <span class="stat-label">Cases Won</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">98%</span>
                        <span class="stat-label">Success Rate</span>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="cta-buttons">
                    <a href="#contact" class="btn-primary">Schedule Consultation</a>
                    <a href="#about" class="btn-secondary">Our Legacy</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
        <i class="fas fa-chevron-down"></i>
        <small>Scroll to explore</small>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Old Partners Data
    const oldPartners = [
        { img: '{{ asset("images/oldpartners/op1.jpeg") }}', name: 'Legacy Partner' },
        { img: '{{ asset("images/oldpartners/op2.jpeg") }}', name: 'Legacy Partner' },
        { img: '{{ asset("images/oldpartners/op3.jpeg") }}', name: 'Legacy Partner' },
        { img: '{{ asset("images/oldpartners/op4.jpeg") }}', name: 'Legacy Partner' },
        { img: '{{ asset("images/oldpartners/op5.jpeg") }}', name: 'Legacy Partner' },
        { img: '{{ asset("images/oldpartners/op6.jpeg") }}', name: 'Legacy Partner' },
        { img: '{{ asset("images/oldpartners/op7.jpeg") }}', name: 'Legacy Partner' },
        { img: '{{ asset("images/oldpartners/op8.jpeg") }}', name: 'Legacy Partner' },
        { img: '{{ asset("images/oldpartners/op9.jpeg") }}', name: 'Legacy Partner' }
    ];

    const stage = document.getElementById('globe3d');
    let radius = 250;

    // Get responsive radius
    function getRadius() {
        const width = window.innerWidth;
        if (width <= 480) return 130;
        if (width <= 768) return 170;
        if (width <= 991) return 200;
        if (width <= 1200) return 220;
        return 250;
    }

    // Initialize 3D Globe
    function initGlobe() {
        radius = getRadius();
        stage.innerHTML = '';

        const total = oldPartners.length;
        const angleStep = 360 / total;

        oldPartners.forEach((partner, index) => {
            const card = document.createElement('div');
            card.className = 'partner-card-3d';
            
            const angle = angleStep * index;
            const rotateY = angle;
            const translateZ = radius;
            
            // Position in 3D space
            card.style.transform = `
                translate(-50%, -50%)
                rotateY(${rotateY}deg)
                translateZ(${translateZ}px)
                rotateY(-${rotateY}deg)
            `;

            card.innerHTML = `
                <img src="${partner.img}" alt="${partner.name}">
                <div class="partner-label">${partner.name}</div>
            `;

            stage.appendChild(card);
        });

        // Update visibility based on Z position
        updateCardVisibility();
    }

    // Update which cards are behind
    function updateCardVisibility() {
        const cards = stage.querySelectorAll('.partner-card-3d');
        cards.forEach((card, index) => {
            const angleStep = 360 / oldPartners.length;
            const currentRotation = parseFloat(getComputedStyle(stage).transform.split(',')[4]) || 0;
            const angle = (angleStep * index + currentRotation) % 360;
            
            // Cards between 90° and 270° are "behind"
            if (angle > 90 && angle < 270) {
                card.classList.add('behind');
            } else {
                card.classList.remove('behind');
            }
        });
    }

    // Initialize
    initGlobe();

    // Update visibility periodically
    setInterval(updateCardVisibility, 100);

    // Handle window resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            initGlobe();
        }, 250);
    });
});
</script>

@endsection
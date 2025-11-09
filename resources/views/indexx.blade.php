@extends('layouts.app')

@section('content')

<style>
:root {
    --maroon: #3c0008;
    --gold: #d4af37;
    --dark: #1a1a1a;
    --white: #fff;
}

/* Main Landing Section */
.landing-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: linear-gradient(135deg, 
        rgba(26, 26, 26, 0.2) 0%, 
        rgba(60, 0, 8, 0.2) 100%
    );
}

/* Background Layer - Scales Image */
.landing-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('../images/scales-justice.jpg') center/cover no-repeat;
    opacity: 0.15;
    z-index: 0;
}

/* Heritage Partners Background - Scattered & Blurred */
.heritage-layer {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
    pointer-events: none;
    overflow: hidden;
}

.heritage-partner {
    position: absolute;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    /* filter: grayscale(100%) blur(2px); */
    opacity: 0.5;
    border: 3px solid rgba(212, 175, 55, 0.2);
    animation: float 20s ease-in-out infinite;
}

/* Scattered positions for heritage partners */
.heritage-partner:nth-child(1) {
    top: 10%;
    left: 8%;
    width: 100px;
    height: 100px;
    animation-delay: 0s;
}

.heritage-partner:nth-child(2) {
    top: 15%;
    right: 12%;
    width: 140px;
    height: 140px;
    animation-delay: -5s;
}

.heritage-partner:nth-child(3) {
    bottom: 20%;
    left: 15%;
    width: 110px;
    height: 110px;
    animation-delay: -10s;
}

.heritage-partner:nth-child(4) {
    bottom: 15%;
    right: 10%;
    width: 130px;
    height: 130px;
    animation-delay: -15s;
}

.heritage-partner:nth-child(5) {
    top: 50%;
    right: 5%;
    width: 90px;
    height: 90px;
    animation-delay: -7s;
}

.heritage-partner:nth-child(6) {
    top: 60%;
    left: 5%;
    width: 100px;
    height: 100px;
    animation-delay: -12s;
}

/* Floating animation */
@keyframes float {
    0%, 100% {
        transform: translateY(0) translateX(0) rotate(0deg);
    }
    25% {
        transform: translateY(-20px) translateX(10px) rotate(5deg);
    }
    50% {
        transform: translateY(-10px) translateX(-10px) rotate(-3deg);
    }
    75% {
        transform: translateY(-15px) translateX(5px) rotate(2deg);
    }
}

/* Main Content Container */
.landing-content {
    position: relative;
    z-index: 2;
    width: 100%;
    padding: 2rem;
    /* color: #000; */
}

/* Left Side - Carousel */
.carousel-side {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 600px;
    position: relative;
    /* background: url('../images/law-life.jpg') center/cover no-repeat; */
}

/* 3D Carousel Container */
.carousel-3d-wrapper {
    width: 100%;
    max-width: 500px;
    height: 500px;
    position: relative;
    perspective: 1200px;
}

/* Founder Center Image */
.founder-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 10;
    text-align: center;
}

.founder-center .founder-img {
    width: 350px;
    height: 350px;
    border-radius: 50%;
    border: 5px solid var(--maroon);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
    object-fit: cover;
    background: white;
    padding: 5px;
}

.founder-center .founder-label {
    margin-top: 12px;
    background: var(--maroon);
    color: var(--);
    padding: 0.5rem 1.2rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 700;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    display: inline-block;
    text-transform: uppercase;
}

/* Carousel Circle */
#circular-carousel {
    width: 100%;
    height: 100%;
    position: relative;
    transform-style: preserve-3d;
    z-index: 100;
}

.carousel-img {
    position: absolute;
    left: 50%;
    top: 50%;
    transform-style: preserve-3d;
    transition: all 0.3s ease;
    text-decoration: none;
}

.carousel-img img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 4px solid #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    object-fit: cover;
    transition: all 0.3s ease;
}

.carousel-img:hover img {
    transform: scale(1.15);
    border-color: var(--maroon);
    box-shadow: 0 8px 20px rgba(212, 175, 55, 0.5);
}

.carousel-img.behind {
    opacity: 0.2;
    pointer-events: none;
}

.partner-info {
    position: absolute;
    bottom: -50px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--maroon);
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 13px;
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
    z-index: 10;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

.carousel-img:hover .partner-info {
    opacity: 1;
}

.carousel-img.behind .partner-info {
    opacity: 0 !important;
}

/* Right Side - Content */
.content-side {
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: black;
    padding-left: 3rem;
}

.landing-subtitle {
    font-size: 0.85rem;
    letter-spacing: 3px;
    color: var(--maroon);
    text-transform: uppercase;
    font-weight: 600;
    margin-bottom: 1rem;
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

.landing-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(2.5rem, 5vw, 4.5rem);
    font-weight: 700;
    color: #000;
    line-height: 1.1;
    margin-bottom: 1.5rem;
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

.landing-description {
    font-size: 1.15rem;
    color: var(--dark);
    line-height: 1.8;
    margin-bottom: 2.5rem;
    max-width: 600px;
    animation: fadeInUp 0.8s ease-out 0.6s both;
}

.landing-stats {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    margin-bottom: 2.5rem;
    max-width: 500px;
    animation: fadeInUp 0.8s ease-out 0.8s both;
}

/* Statistics Section */
        .stats-section {
            /* background: linear-gradient(135deg, #f1f3f43a 0%, #e8eaf64f 100%); */
            padding: 10px;
            margin: 10px 0;
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
            background: rgba(255, 255, 255, 0.046);
            padding: 30px 20px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.144);
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

.landing-cta {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    animation: fadeInUp 0.8s ease-out 1s both;
}

.btn {
    padding: 1.2rem 2.5rem;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.4s ease;
    text-decoration: none;
    display: inline-block;
    letter-spacing: 1px;
    position: relative;
    overflow: hidden;
}

.btn-primary {
    background: var(--maroon);
    color: var(--white);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
}

.btn-secondary {
    background: transparent;
    color: #fff;
    border: 2px solid rgba(255, 255, 255, 0.4);
}

.btn-secondary:hover {
    background: var(--white);
    border-color: var(--maroon);
    color: var(--maroon);
    transform: translateY(-3px);
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 991px) {
    .content-side {
        padding-left: 2rem;
    }

    .landing-title {
        font-size: 3rem;
    }

    .carousel-3d-wrapper {
        max-width: 400px;
        height: 400px;
    }

    .founder-center .founder-img {
        width: 120px;
        height: 120px;
    }

    .carousel-img img {
        width: 70px;
        height: 70px;
    }
}

@media (max-width: 767px) {
    .landing-section {
        min-height: auto;
        padding: 3rem 0;
    }

    .carousel-side {
        margin-bottom: 3rem;
        min-height: 450px;
    }

    .content-side {
        padding-left: 0;
        text-align: center;
    }

    .landing-title {
        font-size: 2.5rem;
    }

    .landing-stats {
        grid-template-columns: repeat(2, 1fr);
        margin: 0 auto 2rem;
    }

    .stat-item {
        text-align: center;
    }

    .landing-cta {
        justify-content: center;
    }

    .carousel-3d-wrapper {
        max-width: 350px;
        height: 350px;
    }

    .founder-center .founder-img {
        width: 100px;
        height: 100px;
        border-width: 4px;
    }

    .founder-center .founder-label {
        font-size: 0.8rem;
        padding: 0.4rem 1rem;
    }

    .carousel-img img {
        width: 60px;
        height: 60px;
        border-width: 3px;
    }

    /* Hide some heritage partners on mobile */
    .heritage-partner:nth-child(5),
    .heritage-partner:nth-child(6) {
        display: none;
    }
}

@media (max-width: 480px) {
    .landing-section::before {
        background: url('../images/justice-potrait.jpg') center/cover no-repeat;
        opacity: 0.15;
        z-index: 0;
        background-size: cover;
    }
    .landing-title {
        font-size: 2rem;
    }

    .landing-description {
        font-size: 1rem;
    }

    .stat-number {
        font-size: 2.5rem;
    }

    .btn {
        padding: 1rem 2rem;
        font-size: 0.9rem;
        width: 100%;
        max-width: 280px;
    }

    .carousel-3d-wrapper {
        max-width: 300px;
        height: 300px;
    }

    .founder-center .founder-img {
        width: 150px;
        height: 150px;
    }

    .carousel-img img {
        width: 50px;
        height: 50px;
    }
}
</style>

<section class="landing-section">
    <!-- Heritage Layer - Scattered Old Partners (Blurred) -->
    <div class="heritage-layer">
        <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" alt="Heritage" class="heritage-partner">
        <img src="{{ asset('images/oldpartners/op1.jpeg') }}" alt="Heritage" class="heritage-partner">
        <img src="{{ asset('images/oldpartners/op2.jpeg') }}" alt="Heritage" class="heritage-partner">
        <img src="{{ asset('images/oldpartners/op3.jpeg') }}" alt="Heritage" class="heritage-partner">
        <img src="{{ asset('images/oldpartners/op4.jpeg') }}" alt="Heritage" class="heritage-partner">
        <img src="{{ asset('images/oldpartners/op5.jpeg') }}" alt="Heritage" class="heritage-partner">
    </div>

    <!-- Main Content -->
    <div class="container landing-content">
        <div class="row align-items-center">
            <!-- Left Side - 3D Carousel -->
            <div class="col-lg-6 carousel-side">
                <div class="carousel-3d-wrapper">
                    <!-- Founder Center -->
                    <div class="founder-center">
                        <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" alt="Sir Thomas Scanlen" class="founder-img">
                        {{-- <div class="founder-label">Founder</div> --}}
                    </div>

                    <!-- 3D Carousel -->
                    <div id="circular-carousel">
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
                            <div class="no-partners-message">
                                <p class="text-muted">Partner information coming soon</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Side - Content -->
            <div class="col-lg-6 content-side">
                <div class="landing-subtitle">Excellence Since 1895</div>
                <h1 class="landing-title">Legal Expertise Built on Legacy</h1>
                <p class="landing-description">
                    For over a century, we've been delivering exceptional legal counsel to clients who demand excellence. 
                    Our heritage of distinguished service continues with today's leading attorneys.
                </p>

                <!-- Stats Grid -->
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
                {{-- <div class="landing-stats">
                    <div class="stat-item">
                        <div class="stat-number">129+</div>
                        <div class="stat-label">Years Excellence</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Expert Attorneys</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">5,000+</div>
                        <div class="stat-label">Cases Won</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Success Rate</div>
                    </div>
                </div> --}}

                <!-- CTAs -->
                <div class="landing-cta">
                    <a href="#contact" class="btn btn-primary">Schedule Consultation</a>
                    <a href="#practice" class="btn btn-secondary">Our Expertise</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('circular-carousel');
    if (!carousel) return;
    
    const images = carousel.querySelectorAll('.carousel-img');
    const total = images.length;
    
    if (total === 0) return;
    
    let radius = 175;
    let angle = 0;
    let animationId;
    const rotationSpeed = 0.3;

    function getRadius() {
        const width = window.innerWidth;
        if (width <= 480) return 112.5;
        if (width <= 767) return 137.5;
        if (width <= 991) return 150;
        return 175;
    }

    function positionImages() {
        const angleStep = (2 * Math.PI) / total;
        
        for (let i = 0; i < total; i++) {
            const currentAngle = (angle * Math.PI / 180) + (angleStep * i);
            const x = Math.sin(currentAngle) * radius;
            const z = Math.cos(currentAngle) * radius;
            const scale = (z + radius) / (radius * 2) * 0.5 + 0.5;
            
            images[i].style.transform = `
                translate(-50%, -50%)
                translateX(${x}px)
                translateZ(${z}px)
                scale(${scale})
            `;
            
            images[i].style.zIndex = Math.round(z);
            
            if (z < 0) {
                images[i].classList.add('behind');
            } else {
                images[i].classList.remove('behind');
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
        radius = getRadius();
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
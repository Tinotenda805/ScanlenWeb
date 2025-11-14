@extends('layouts.app')

@section('content')
   <style>
/* ===============================
   Main Content & Background
=============================== */
.main-content {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 4rem 2rem;
}
/* ===============================
   Memorial Wall — Old Partners
=============================== */
.memorial-wall {
  position: relative;
  background: radial-gradient(circle at center, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.6)); /* Lighter shades */
  overflow: hidden;
  min-height: 100vh;
}

/* Soft fade vignette */
.memorial-wall::after {
  content: "";
  position: absolute;
  inset: 0;
  background: radial-gradient(circle, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.6)); /* Lighter shades */
  pointer-events: none;
  z-index: 2;
}

/* Partner portraits */
.partner {
  position: absolute;
  object-fit: cover;
  border-radius: 10px;
  opacity: 0.3;
  filter: grayscale(100%) sepia(10%) brightness(0.9) contrast(1.1);
  mix-blend-mode: soft-light;
  transition: all 0.6s ease;
  animation: float 16s ease-in-out infinite;
  z-index: 1;
}

/* Floating effect */
@keyframes float {
  0%, 100% { transform: translateY(0) scale(1); }
  50% { transform: translateY(-10px) scale(1.03); }
}

/* Layout — positioned to create symmetry around the center */
.partner:nth-of-type(1) { top: 10%; left: 15%; width: 160px; height: 200px; animation-delay: 0s; }
.partner:nth-of-type(2) { top: 20%; right: 18%; width: 160px; height: 200px; animation-delay: 2s; }
.partner:nth-of-type(3) { top: 50%; left: 10%; width: 180px; height: 220px; animation-delay: 4s; }
.partner:nth-of-type(4) { top: 55%; right: 10%; width: 180px; height: 220px; animation-delay: 6s; }
.partner:nth-of-type(5) { bottom: 10%; left: 25%; width: 160px; height: 200px; animation-delay: 8s; }
.partner:nth-of-type(6) { bottom: 10%; right: 25%; width: 160px; height: 200px; animation-delay: 10s; }

/* Hover respectfulness */
.partner:hover {
  opacity: 0.6;
  filter: grayscale(0%) brightness(1.05);
  transform: scale(1.05);
}

/* Foreground content */
.memorial-content {
  position: relative;
  z-index: 3;
  text-align: center;
  color: #f8f8f8;
  padding: 150px 20px;
}

.memorial-content h1 {
  font-size: 3rem;
  letter-spacing: 2px;
  margin-bottom: 1rem;
}

.memorial-content p {
  font-size: 1.2rem;
  max-width: 700px;
  margin: 0 auto;
  color: #ddd;
}


/* ===============================
   Founder Center
=============================== */
.founder-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 5;
    text-align: center;
}

.founder-img {
    width: 280px;
    height: 280px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow:
        0 0 60px rgba(139, 105, 20, 0.6),
        0 20px 60px rgba(0, 0, 0, 0.7);
    position: relative;
    z-index: 2;
}

.founder-label {
    margin-top: 1.5rem;
    font-size: 1.5rem;
    font-weight: bold;
    color: #8B6914;
    text-transform: uppercase;
    letter-spacing: 3px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    background: rgba(0, 0, 0, 0.7);
    padding: 0.8rem 2rem;
    border-radius: 30px;
    display: inline-block;
}

/* ===============================
   Circular Carousel
=============================== */
#circular-carousel {
    position: relative;
    width: 100%;
    max-width: 700px;
    height: 700px;
    margin: 0 auto;
    z-index: 10;
    transform-style: preserve-3d;
}

.carousel-img {
    position: absolute;
    width: 80px;
    height: 80px;
    left: 50%;
    top: 50%;
    transition: all 0.4s ease;
    transform-style: preserve-3d;
}

#circular-carousel .carousel-img:hover img {
    transform: scale(1.15);
    border-color: var(--maroon);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

#circular-carousel .carousel-img.behind {
    opacity: 0;
    pointer-events: none;
}

.carousel-img img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #8B6914;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6);
    transition: all 0.4s ease;
}

.carousel-img:hover img {
    border-color: #d4a574;
    box-shadow: 0 12px 32px rgba(139, 105, 20, 0.7);
    transform: scale(1.5);
}

.partner-info {
    position: absolute;
    bottom: -50px;
    left: 50%;
    background: rgba(139, 105, 20, 0.95);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
    text-align: center;
    min-width: 200px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
}

.carousel-img:hover .partner-info {
    opacity: 1;
}

.carousel-img {
    --angle: calc(var(--i) * (360deg / 8));
    --radius: 160px;
    transform:
        translate(-50%, -50%)
        rotate(var(--angle))
        translateY(calc(var(--radius) * -1));
}

/* Carousel rotation */
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

/* Decorative rotating circle */
.founder-center::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 320px;
    height: 320px;
    border: 2px dashed rgba(139, 105, 20, 0.3);
    border-radius: 50%;
    animation: rotate 20s linear infinite;
    z-index: 1;
}

@keyframes rotate {
    from { transform: translate(-50%, -50%) rotate(0deg); }
    to { transform: translate(-50%, -50%) rotate(360deg); }
}

/* ===============================
   Responsive Adjustments
=============================== */
@media (max-width: 1200px) {
    .partner {
        width: 140px;
        height: 190px;
    }

    .carousel-img {
        --radius: 140px;
        width: 100px;
        height: 100px;
    }

    .founder-img {
        width: 220px;
        height: 220px;
    }

    .founder-center::before {
        width: 280px;
        height: 280px;
    }

    #circular-carousel {
        max-width: 600px;
        height: 600px;
    }
}

@media (max-width: 768px) {
    .hero-partners-bg {
        background: url('../images/justice-potrait.jpg');
        background-size: cover;
        background-position: initial;
        background-repeat: no-repeat;
        z-index: -10;
        opacity: 0.5;
    }

    .partner {
        display: none;
    }

    .founder-img {
        width: 160px;
        height: 160px;
    }

    .founder-center::before {
        width: 200px;
        height: 200px;
    }

    .carousel-img {
        --radius: 100px;
        width: 50px;
        height: 50px;
    }

    #circular-carousel {
        max-width: 450px;
        height: 450px;
    }

    .partner-info {
        font-size: 0.7rem;
        min-width: 150px;
        padding: 0.4rem 0.8rem;
    }
}

/* ===============================
   Other Sections (unchanged)
=============================== */
.find-lawyer { }
.find-lawyer h3 { margin-bottom: 2rem; }

.find-lawyer .form-control,
.find-lawyer .form-select {
    border: 2px solid #dee2e6;
    padding: 0.75rem;
}

.find-lawyer .form-control:focus,
.find-lawyer .form-select:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.membership-logo {
    width: 250px;
    height: 250px;
    object-fit: contain;
    background-color: #fff;
}

.membership-section {
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
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

.section-title {
    color: #6c757d;
    font-size: 0.9rem;
    letter-spacing: 1px;
}

.section-description {
    color: #6c757d;
    font-size: 1.1rem;
}

.divider {
    border-color: #969696;
    width: 50%;
    margin: 0 auto;
}

/* Statistics Section */
.stats-section {
    padding: 10px;
    border-radius: 15px;
    text-align: center;
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 10px;
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

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    color: var(--maroon);
}

.stat-label {
    font-size: 1rem;
    color: #5a6c7d;
    font-weight: 500;
}

.stat-icon {
    font-size: 3rem;
    color: var(--new-maroon);
}
</style>


<div class="main-content memorial-wall">
    <!-- 🔹 Background with Old Partners (stays behind everything) -->
    <div class="hero-partners-bg">
        <div class="founder-center">
            <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" 
                 alt="Sir Thomas Scanlen" 
                 class="founder-img">
        </div>

        <img src="{{ asset('images/oldpartners/op1.jpeg') }}" alt="Old Partner" class="partner random">
        <img src="{{ asset('images/oldpartners/op2.jpeg') }}" alt="Old Partner" class="partner random">
        <img src="{{ asset('images/oldpartners/op3.jpeg') }}" alt="Old Partner" class="partner random">
        <img src="{{ asset('images/oldpartners/op4.jpeg') }}" alt="Old Partner" class="partner random">
        <img src="{{ asset('images/oldpartners/op5.jpeg') }}" alt="Old Partner" class="partner random">
        <img src="{{ asset('images/oldpartners/op6.jpeg') }}" alt="Old Partner" class="partner random">
        <img src="{{ asset('images/oldpartners/op7.jpeg') }}" alt="Old Partner" class="partner random">
        <img src="{{ asset('images/oldpartners/op8.jpeg') }}" alt="Old Partner" class="partner random">
        <img src="{{ asset('images/oldpartners/op9.jpeg') }}" alt="Old Partner" class="partner random">
    </div>

    <!-- 🔹 Your existing 3D Carousel (unchanged) -->
    <div id="circular-carousel" class="memorial-content">
        @if(isset($partners) && $partners->count() > 0)
            @foreach($partners as $index => $partner)
                <a href="{{ route('our-people.partner', $partner->id) }}" 
                   class="carousel-img" 
                   style="--i:{{ $index }};" 
                   title="{{ $partner->name }}">
                    <img src="{{ $partner->avatar ? asset('storage/' . $partner->avatar) : asset('images/default-avatar.png') }}" 
                         alt="{{ $partner->name }}" 
                         class="rounded-circle">
                    <div class="partner-info">
                        {{ $partner->name }} - {{ $partner->designation ?? 'Partner' }}
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


    
<section class="company-overview-section py-5" >
    <div class="container">
        <div class="row ">
            <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-4">
                <h2 class="mb-4">About Scanlen & Holderness</h2>
                <p class="lead">Legal Excellence Since 1894</p>
                <p>
                    Scanlen & Holderness is a premier Zimbabwean law firm offering you a full circle of legal services 
                    whether you are a local, regional or international client. Our quality of expertise consistently earns 
                    us and our lawyers a top ranking in both local and international legal surveys. 
                </p>
                <p>
                    Throughout history Team Scanlen has proudly influenced jurisprudential development in Zimbabwe. 
                    Our continued involvement in landmark cases sets precedent in many areas of law.
                </p>

                @if($statistics->count() > 0)
                    <section class="stats-section container">
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
            </div>
            
            <!-- Right Column - Association Memberships -->
            <div class="col-lg-6 ps-lg-4 p-2">
                {{-- <h2 class="mb-4">Professional Memberships</h2> --}}
                {{-- <video class="w-100 rounded" autoplay loop muted>
                    <source src="{{asset('videos/law-firm.mp4')}}" type="video/mp4" />
                </video> --}}

                <h2 class="fw-bold mb-4">Our Story in Motion</h2>
                <p class="text-muted mb-4">Watch our firm overview to learn more about our history and values</p>
                
                {{-- YouTube Video Embed --}}
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/Z4Mpu5Ansl0" 
                            title="About Scanlen & Holderness" class="rounded"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>
                
            </div>
        </div>

    </div>
</section>

{{-- Awards & Recognition Section --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Awards & Recognition</h2>
        
        {{-- @php
            $awards = App\Models\Award::active()->ordered()->recent()->get();
        @endphp --}}
        
        @if($awards->count() > 0)
            <div class="row g-4 justify-content-center">
                @foreach($awards as $award)
                    <div class="col-md-6 col-lg-3">
                        <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                            @if($award->image_url)
                                <img src="{{ $award->image_url }}" alt="{{ $award->title }}" 
                                     class="img-fluid mb-3 rounded-circle" style="max-height: 100px;">
                            @else
                                <i class="fas fa-trophy fa-3x text-maroon mb-3"></i>
                            @endif
                            <h5 class="fw-bold mb-2">{{ $award->title }}</h5>
                            <p class="small text-muted mb-0">
                                {{ $award->issuing_organization }}<br>
                                {{ $award->year }}
                            </p>
                            @if($award->description)
                                <p class="small mt-2">{{ $award->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                <p class="text-muted">Awards information coming soon.</p>
            </div>
        @endif
    </div>
</section>



{{-- Mission & Vision Cards --}}
<section class="py-5 bg-light" style="display: none">
    <div class="container">
        <div class="row g-4">
            {{-- Mission --}}
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-bullseye fa-3x text-maroon mb-3"></i>
                        <h3 class="h4 fw-bold mb-3">Our Mission</h3>
                        <p class="text-muted">
                            To provide exceptional legal services that exceed client expectations through 
                            innovative solutions, deep industry knowledge, and unwavering ethical standards. 
                            We are committed to advancing justice while building lasting relationships 
                            with our clients and communities.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Vision --}}
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-eye fa-3x text-maroon mb-3"></i>
                        <h3 class="h4 fw-bold mb-3">Our Vision</h3>
                        <p class="text-muted">
                            To be Zimbabwe's most trusted and innovative law firm, recognized for our 
                            legal expertise, client-centric approach, and positive impact on the 
                            development of law and business in Southern Africa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- How We Work Section --}}
<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">How We Work</h2>
        <div class="row g-4">
            {{-- Process 1 --}}
            <div class="col-md-4">
                <div class="text-center">
                    <div class="bg-maroon text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-handshake fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Client-Centric Approach</h4>
                    <p class="text-muted">
                        We listen first, then develop tailored legal strategies that align with your 
                        business objectives and personal goals.
                    </p>
                </div>
            </div>

            {{-- Process 2 --}}
            <div class="col-md-4">
                <div class="text-center">
                    <div class="bg-maroon text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Collaborative Teams</h4>
                    <p class="text-muted">
                        Multi-disciplinary teams work together to provide comprehensive solutions 
                        across all legal practice areas.
                    </p>
                </div>
            </div>

            {{-- Process 3 --}}
            <div class="col-md-4">
                <div class="text-center">
                    <div class="bg-maroon text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Strategic Innovation</h4>
                    <p class="text-muted">
                        We leverage technology and innovative thinking to deliver efficient, 
                        cost-effective legal services.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Core Values --}}
<section class="py-5 bg-white text-dark border-top">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Our Core Values</h2>
        <div class="row g-4">
            <div class="col-md-3 text-center">
                <i class="fas fa-scale-balanced fa-2x mb-3"></i>
                <h5 class="fw-bold">Integrity</h5>
                <p class="small">Uncompromising ethical standards in all we do</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="fas fa-gem fa-2x mb-3"></i>
                <h5 class="fw-bold">Excellence</h5>
                <p class="small">Commitment to the highest quality legal services</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="fas fa-heart fa-2x mb-3"></i>
                <h5 class="fw-bold">Respect</h5>
                <p class="small">Valuing diverse perspectives and treating all with dignity</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="fas fa-lightbulb fa-2x mb-3"></i>
                <h5 class="fw-bold">Innovation</h5>
                <p class="small">Embracing new ideas and technologies</p>
            </div>
        </div>
    </div>
</section>








{{-- PROFESSIONAL MEMBERSHIP --}}
<!-- Client 2 - Bootstrap Brain Component -->
<section class="membership-section bg-white p-5 border-top">
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
<section class="find-lawyer p-5 bg-body-secondary text-center">
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
                    <option value="">SECTORS</option>
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
</section>
{{-- Call to Action --}}
{{-- <section class="py-5 bg-maroon text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Ready to Work With Us?</h2>
        <p class="lead mb-4">Contact our team to discuss how we can assist with your legal needs.</p>
        <a href="/contact" class="btn btn-light btn-lg">Get In Touch</a>
    </div>
</section> --}}

<!-- Faq Section -->
{{-- <section id="faq" class="faq bg-white py-5">
    <div class="container">

        <div class="d-flex flex-column justify-content-center order-2 order-lg-1">

        <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
            <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
            </p>
        </div>

        <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">

            @if ($faqs->isNotEmpty())
                @foreach ($faqs as $item)
                    <div class="faq-item ">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>
                            {{$item->question ?? ''}}
                        </h3>
                        <div class="faq-content">
                            <p>{{$item->answer ?? ''}} </p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div><!-- End Faq item-->
                    
                @endforeach
            @else
                <div class="faq-item ">
                    <i class="faq-icon bi bi-question-circle"></i>
                    <h3>There are no FAQs yet.</h3>
                </div><!-- End Faq item-->
                
            @endif

        </div>

        </div>

    </div>

    </div>

</section> --}}
<!-- /Faq Section -->

@endsection
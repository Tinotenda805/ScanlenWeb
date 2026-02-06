@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endpush

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
                    

                    <!-- 3D Carousel -->
                    <div class="c-partners-container">
                        <!-- Founder Center -->
                        <div class="founder-center">
                            <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" 
                                alt="Sir Thomas Scanlen" 
                                class="founder-img">
                            <div class="founder-label">Current Partners</div>
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
                            
                            @endif
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE - Main Content -->
                <div class="main-content-section">
                    <!-- Heading Above Carousel -->
                    <div class="carousel-heading">
                        <div class="carousel-badge">Since 1894</div>
                    </div>
                    <div class="content-tagline">Heritage • Excellence • Trust</div>
                    
                    <h1 class="content-title">
                        Scanlen & Holderness
                    </h1>

                    <h4>Building On A Legacy Of Trust</h4>

                    <p class="content-description">
                        For over a century, we've been delivering exceptional legal counsel 
                        to clients who demand excellence. Our heritage of distinguished service 
                        continues with today's leading attorneys.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="content-buttons">
                        <a href="{{route('contactUs')}}" class="btn-hero btn-primary">Schedule Consultation</a>
                        <a href="{{route('expertise.index')}}" class="btn-hero btn-outline text-white">Learn More</a>
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

    <button class="find-lawyer-sticky-btn" id="findLawyerBtn">
        <i class="bi bi-arrow-down-left-circle-fill"></i>
        Find A Lawyer
        <i class="bi bi-arrow-up-right-circle-fill"></i>
    </button>

    <!-- Find Lawyer Panel (Hidden by default) -->
    <div class="find-lawyer-panel" id="findLawyerPanel">
        <button class="close-panel" id="closePanelBtn">
            <i class="bi bi-x-lg"></i>
        </button>
        
        <div class="container">
            <h4 class="text-center mb-4">Find The Right Lawyer For You</h4>
            <form action="{{ route('our-people.find-lawyer') }}" method="GET">
                <div class="row g-3 justify-content-center align-items-center">
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Search By Name" value="{{ request('name') }}">
                    </div>
                    <div class="col-md-1 text-center d-none d-md-block">
                        <span class="text-white fw-bold">OR</span>
                    </div>
                    <div class="col-md-3">
                        <select name="expertise" class="form-select">
                            <option value="">Select Expertise</option>
                            @if(isset($allExpertise))
                                @foreach($allExpertise as $expertise)
                                    <option value="{{ $expertise->id }}">{{ $expertise->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="category" class="form-select">
                            <option value="">Select Category</option>
                            @if(isset($sectors))
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-search w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. UPDATED ABOUT SECTION WITH MISSION/VISION CAROUSEL -->
    <section class="about-overlap-section bg-secondary-subtle " id="about" >
        <div class="about-overlap-wrapper">
            <!-- Dark Content Area -->
            <div class="dark-content-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="content-wrapper">
                                <span class="badge-est border border-danger-subtle rounded-5 py-2 px-3">EST. 1894</span>
                                <h2 class="about-title mt-2">About Scanlen & Holderness</h2>
                                <p class="about-subtitle mt-2">Legal Excellence Since 1894</p>
                                
                                <p class="about-text">
                                    Scanlen & Holderness is a premier Zimbabwean law firm offering you a full circle of legal services 
                                    whether you are a local, regional or international client.
                                </p>
                                
                                <p class="about-text">
                                    Throughout history Team Scanlen has proudly influenced jurisprudential development in Zimbabwe. 
                                    Our continued involvement in landmark cases sets precedent in many areas of law.
                                </p>
                                
                                <!-- Key Features -->
                                <div class="key-features">
                                    <div class="feature-item">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>Premier Legal Services</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>Top Rankings</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>Landmark Cases</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>Global Recognition</span>
                                    </div>
                                </div>

                                <div class="mission-vision mt-2">
                                    <div class="mv-title">
                                        {{-- <i class="bi bi-bullseye"></i> --}}
                                        <h5>Our Mission</h5>
                                    </div>
                                    <p>
                                        To continue to be the leading firm at all times offering the finest legal services
                                        timeously and efficiently in a friendly atmosphere.
                                    </p>
                                </div>

                                <div class="mission-vision mt-2">
                                    <div class="mv-title">
                                        {{-- <i class="bi bi-eye"></i> --}}
                                        <h5>Our Vision</h5>
                                    </div>
                                    <ul class="list-unstyled mb-0">
                                        <li><i class="bi bi-check-round-fill"></i>
                                            One stop firm for all corporate legal matters
                                        </li>
                                        <li><i class="bi bi-check-round-fill"></i>
                                            Clear choice with excellence and global recognition
                                        </li>
                                    </ul>
                                </div>


                                
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-4">
                        <h3 class="text-center fw-bold mb-4 text-white">Our Core Values</h3>
                        <div class="row g-4 justify-content-center">
                            <div class="col-6 col-md-3">
                                <div class="text-center p-2 bg-light rounded-3 h-100">
                                    <i class="bi bi-shield-check text-maroon fs-1 mb-3"></i>
                                    <h5 class="fw-bold">Integrity</h5>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="text-center p-2 bg-light rounded-3 h-100">
                                    <i class="bi bi-gem text-maroon fs-1 mb-3"></i>
                                    <h5 class="fw-bold">Excellence</h5>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="text-center p-2 bg-light rounded-3 h-100">
                                    <i class="bi bi-people text-maroon fs-1 mb-3"></i>
                                    <h5 class="fw-bold">Respect</h5>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="text-center p-2 bg-light rounded-3 h-100">
                                    <i class="bi bi-lightbulb text-maroon fs-1 mb-3"></i>
                                    <h5 class="fw-bold">Innovation</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Container -->
            <div class="video-container">
                <div class="video-wrapper">
                    <video id="aboutVideo" autoplay muted loop playsinline>
                        <source src="{{asset('videos/lex.mp4')}}" type="video/mp4">
                    </video>
                    <div class="video-controls">
                        <button class="mute-btn" id="muteToggle">
                            <i class="bi bi-volume-mute" id="muteIcon"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="awards bg-secondary-subtle">
                @if($awards->count() > 0)
                    <div class="text-center">
                        <span class="badge bg-maroon text-white">RECOGNITION</span>
                        {{-- <h2 class="display-6 fw-bold mb-3">Awards & Achievements</h2> --}}
                    </div>
                    <div class="row justify-content-between ">
                        @foreach($awards as $award)
                        <div class="col-6 col-md-3">
                            @if($award->image_url)
                                <img src="{{ $award->image_url }}" alt="{{ $award->title }}" 
                                    class="img-fluid rounded-circle">
                            @else
                                <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center" 
                                    style="width: 60px; height: 60px;">
                                    <i class="bi bi-trophy text-maroon"></i>
                                </div>
                            @endif
                            <h5 class="fw-bold mb-1">{{ $award->title }}</h5>
                            {{-- <p class="small text-muted mb-0">{{ $award->issuing_organization }}</p> --}}
                            <p class="small text-maroon fw-semibold">{{ $award->year }}</p>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-3">
                        <div class="bg-light rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-trophy text-muted fs-1"></i>
                        </div>
                        <p class="text-muted mb-0">Our achievements will be showcased here soon.</p>
                    </div>
                @endif
            </div>

            
        </div>
    </section>

    {{-- FIND A LAWYER SECTION - Updated Background --}}
    <section class="find-lawyer text-center p-5 bg-secondary-subtle">
        <div class="rounded p-3 shadow-lg" style="background: linear-gradient(135deg, #50010b 0%, #50010b 100%) !important;">
            <h3 class="fw-bold text-white mb-4">Find A Lawyer</h3>
            <form action="{{ route('our-people.find-lawyer') }}" method="GET">
                <div class="row g-3 justify-content-center">
                    <div class="col-lg-3 col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Search By Name" value="{{ request('name') }}">
                    </div>
                    <div class="col-lg-1 col-12 d-flex align-items-center justify-content-center">
                        <span class="fw-bold text-white">OR</span>
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
                        <button type="submit" class="btn btn-maroon-outline w-100">Search <i class="bi bi-search ms-2"></i></button>
                    </div>
                </div>
            </form>

            <a href="{{route('our-people.find-lawyer')}}" class="btn btn-maroon-outline mt-5">View All <i class="bi bi-arrow-up-right-circle-fill ms-2"></i></a>
        </div>
    </section>

    <!-- 3. INSIGHTS BY CATEGORY SECTION (Bowmans Style) -->
    <section class="insights-section position-relative bg-secondary-subtle" >
        <div class="container">
            <div class="insights-header">
                <h2>Insights By Practice Area</h2>
                <p>Explore our latest legal insights, articles, and commentary organized by practice area</p>
            </div>

            <div id="insightsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($categories->chunk(4) as $chunk)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="row g-4">
                            @foreach($chunk as $category)
                            <div class="col-md-6 col-lg-6">
                                <a href="{{ route('articles.category', $category->slug) }}" class="text-decoration-none">
                                    <div class="category-card">
                                        <img src="{{ $category->avatar ? asset('storage/' . $category->avatar) : asset('images/law.jpg') }}" 
                                            alt="{{ $category->name }}" 
                                            class="category-card-img">
                                        
                                        <div class="category-overlay">
                                            <h3 class="category-title">{{ $category->name }}</h3>
                                            <p class="category-count">{{ $category->articles_count }} Articles</p>
                                            <p class="category-description">
                                                {{ Str::limit($category->description ?? 'Explore our insights and expertise in ' . $category->name, 100) }}
                                            </p>
                                            <div class="category-arrow">
                                                <i class="bi bi-arrow-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('articles.index') }}" class="btn btn-maroon-outline btn-lg">
                    View All Insights
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        
        <!-- Move arrows outside container but inside section -->
        <button class="carousel-control-prev" type="button" data-bs-target="#insightsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#insightsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </section>

    <!-- OUR PEOPLE CAROUSEL SECTION -->
    <section id="peopleCarousel" class="our-people-section carousel slide bg-secondary-subtle shadow-lg" data-bs-ride="carousel">
        <!-- Add indicators (optional) -->
        <div class="carousel-inner">
            @if(isset($featuredPeople) && $featuredPeople->count() > 0)
                @foreach($featuredPeople as $index => $person)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="container">
                            <div class="text-start mb-3">
                                <h2 class="person-name mb-0">MEET OUR TEAM</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="person-content">
                                        <span class="person-badge">{{ $person->employeeType->name ?? 'Partner' }}</span>
                                        <h3 class="person-name">{{ $person->name }}</h3>
                                        {{-- <p class="person-title">{{ $person->title ?? 'Senior Attorney' }}</p> --}}
                                        
                                        <p class="person-bio">
                                            {{ Str::limit($person->bio ?? 'Experienced legal professional with a proven track record in delivering exceptional results for clients across various practice areas.', 400) }}
                                        </p>

                                        @if(isset($person->expertise) && $person->expertise->count() > 0)
                                            <div class="person-expertise">
                                                <h4>Areas of Expertise</h4>
                                                <div class="expertise-tags">
                                                    @foreach($person->expertise->take(4) as $exp)
                                                        <span class="expertise-tag">{{ $exp->name }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <a href="{{ route('our-people.partner', $person->slug) }}" class="person-cta">
                                            View Full Profile
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="person-image-container">
                                        <img src="{{ $person->avatar ? asset('storage/' . $person->avatar) : asset('images/law.jpg') }}" 
                                            alt="{{ $person->name }}" 
                                            class="person-main-image img-fluid">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="text-center mt-5">
                                <a href="{{ route('our-people.find-lawyer') }}" class="btn-hero btn-outline">
                                    View All Attorneys
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback content if no people data -->
                <div class="carousel-item active">
                    <div class="container">
                        <div class="text-start mb-5">
                            <h2 class="person-name mb-0">Meet Our Legal Experts</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="person-content">
                                    <span class="person-badge">Partner</span>
                                    <h3 class="person-name">Our Legal Team</h3>
                                    <p class="person-title">Experienced Legal Professionals</p>
                                    <p class="person-bio">
                                        Our team of dedicated attorneys brings decades of combined experience 
                                        in delivering exceptional legal services to clients across Zimbabwe and beyond.
                                    </p>
                                    <a href="{{ route('our-people.find-lawyer') }}" class="person-cta">
                                        Meet Our Team
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="person-image-container">
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="Attorney" class="person-main-image img-fluid">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="text-center mt-5">
                            <a href="{{ route('our-people.find-lawyer') }}" class="btn-hero btn-outline">
                                View All Attorneys
                                <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>
            @endif
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#peopleCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#peopleCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </section>


    <!-- EXPERTISE SECTION -->
    <section class="expertise-section" style="background: linear-gradient(135deg, #dec6d4 0%, #fff 50%); display:none;">
        <div class="container">
            <div class="expertise-header">
                <h2>Our Areas of Expertise</h2>
                <p>Comprehensive legal solutions across multiple practice areas</p>
            </div>

            <div class="row g-4 mb-5">
                @if(isset($featuredExpertise) && $featuredExpertise->count() > 0)
                    @foreach($featuredExpertise->take(3) as $expertise)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('expertise.show', $expertise->slug) }}" class="text-decoration-none">
                                <div class="expertise-card">
                                    <div class="expertise-card-bg"></div>
                                    <div class="expertise-card-content">
                                        <div>
                                            <div class="expertise-icon">
                                                <i class="bi bi-{{ $expertise->icon ?? 'briefcase' }}"></i>
                                            </div>
                                            <h3>{{ $expertise->name }}</h3>
                                            <p class="expertise-card-description">
                                                {{ Str::limit($expertise->description ?? 'Comprehensive legal services in ' . $expertise->name, 120) }}
                                            </p>
                                            @if(isset($expertise->lawyers_count))
                                                <div class="expertise-stats">
                                                    <div class="expertise-stat">
                                                        <span class="expertise-stat-number">{{ $expertise->lawyers_count }}</span>
                                                        <span class="expertise-stat-label">Specialists</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="expertise-arrow">
                                            <i class="bi bi-arrow-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback expertise cards -->
                    <div class="col-lg-4 col-md-6">
                        <div class="expertise-card">
                            <div class="expertise-card-bg"></div>
                            <div class="expertise-card-content">
                                <div>
                                    <div class="expertise-icon">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <h3>Corporate Law</h3>
                                    <p class="expertise-card-description">
                                        Comprehensive corporate legal services including mergers, acquisitions, and compliance.
                                    </p>
                                </div>
                                <div class="expertise-arrow">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="expertise-card">
                            <div class="expertise-card-bg"></div>
                            <div class="expertise-card-content">
                                <div>
                                    <div class="expertise-icon">
                                        <i class="bi bi-shield-check"></i>
                                    </div>
                                    <h3>Litigation</h3>
                                    <p class="expertise-card-description">
                                        Expert representation in commercial disputes and complex litigation matters.
                                    </p>
                                </div>
                                <div class="expertise-arrow">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="expertise-card">
                            <div class="expertise-card-bg"></div>
                            <div class="expertise-card-content">
                                <div>
                                    <div class="expertise-icon">
                                        <i class="bi bi-bank"></i>
                                    </div>
                                    <h3>Banking & Finance</h3>
                                    <p class="expertise-card-description">
                                        Specialized advice on financial transactions, regulatory compliance, and banking law.
                                    </p>
                                </div>
                                <div class="expertise-arrow">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="text-center">
                <a href="{{ route('expertise.index') }}" class="btn btn-maroon-outline btn-lg">
                    View All Practice Areas
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    
    


    


     {{-- PROFESSIONAL MEMBERSHIP - Updated Background --}} 
    <section class="membership-section p-5 border-top bg-secondary-subtle" >
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

@endsection

@push('scripts')
    <script src="{{asset('js/home.js')}}"></script>
@endpush
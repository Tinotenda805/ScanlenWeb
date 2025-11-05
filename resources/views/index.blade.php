@extends('layouts.app')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <div class="hero-partners-bg" >
            {{-- founder image on the centre --}}
            {{-- <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" alt="Sir Thomas Scanlen" class="partner founder"> --}}
            <!-- Other partners placed randomly -->
            {{-- Founder image in center --}}
            <div class="founder-center">
                <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" alt="Sir Thomas Scanlen" class="founder-img">
                <div class="founder-label">Founder</div>
            </div>

            <img src="{{ asset('images/oldpartners/op1.jpeg') }}" alt="Old Partner" class="partner random">
            <img src="{{ asset('images/oldpartners/op2.jpeg') }}" alt="Old Partner" class="partner random">
            <img src="{{ asset('images/oldpartners/op3.jpeg') }}" alt="Old Partner" class="partner random">
            <img src="{{ asset('images/oldpartners/op4.jpeg') }}" alt="Old Partner" class="partner random">
            <img src="{{ asset('images/oldpartners/op5.jpeg') }}" alt="Old Partner" class="partner random">
        </div>
        
        {{-- Circular carousel for current partners --}}
         {{-- 3D Carousel for current partners --}}
        <div id="circular-carousel" class="position-relative">
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
                {{-- Fallback if no partners found --}}
                <div class="no-partners-message">
                    <p class="text-muted">Partner information coming soon</p>
                </div>
            @endif
        </div>
    </div>




    

<section class="company-overview-section py-5">
    <div class="container">
        <div class="row align-items-stretch">
        <!-- Left Column - Company Overview -->
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
            </div>
            
            <!-- Right Column - Association Memberships -->
            <div class="col-lg-6 ps-lg-4 p-2">
                {{-- <h2 class="mb-4">Professional Memberships</h2> --}}
                <video class="w-100 rounded" autoplay loop muted>
                    <source src="{{asset('videos/law-firm.mp4')}}" type="video/mp4" />
                </video>

                {{-- Awards Section --}}
                {{-- Awards Carousel --}}
                {{-- Awards Badge Wall --}}
                {{-- <div class="card border-0 shadow-sm">
                    <div class="card-header bg-maroon text-white">
                        <h5 class="card-title mb-0 fw-bold">
                            <i class="fas fa-certificate me-2"></i>Recognitions & Certifications
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center g-4">
                            <div class="col-6 col-md-3">
                                <div class="award-badge">
                                    <div class="badge-icon bg-maroon text-white rounded-circle mx-auto mb-2">
                                        <i class="fas fa-gavel fa-2x"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">AV Preeminent</h6>
                                    <small class="text-muted">Martindale-Hubbell</small>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="award-badge">
                                    <div class="badge-icon bg-warning text-dark rounded-circle mx-auto mb-2">
                                        <i class="fas fa-star fa-2x"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Super Lawyers</h6>
                                    <small class="text-muted">Rated 2024</small>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="award-badge">
                                    <div class="badge-icon bg-success text-white rounded-circle mx-auto mb-2">
                                        <i class="fas fa-balance-scale fa-2x"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Best Lawyers</h6>
                                    <small class="text-muted">2024 Edition</small>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="award-badge">
                                    <div class="badge-icon bg-info text-white rounded-circle mx-auto mb-2">
                                        <i class="fas fa-shield-alt fa-2x"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Top Law Firm</h6>
                                    <small class="text-muted">US News & World Report</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <style>
                .badge-icon {
                    width: 80px;
                    height: 80px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                }
                .award-badge:hover .badge-icon {
                    transform: translateY(-5px);
                    transition: transform 0.3s ease;
                }
                </style> --}}
            </div>
        </div>
    </div>
</section>

{{-- PROFESSIONAL MEMBERSHIP --}}
<!-- Client 2 - Bootstrap Brain Component -->
<section class="membership-section bg-white p-5">
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
                            <option value="{{ $sector->id }}" {{ request('sector') == $sector->id ? 'selected' : '' }}>
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

<style>
    /* * Find Lawyer Section */
    /* Find Lawyer Section */
.find-lawyer {
    /* background: linear-gradient(135deg, #3c0008 50%, #343a40 100%); */
}

.find-lawyer h3 {
    margin-bottom: 2rem;
}

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



</style>
    
@endsection



   
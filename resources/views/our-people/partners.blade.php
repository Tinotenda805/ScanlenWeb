@extends('layouts.app')

@section('content')

@include('layouts.page-Currentheader', [
    'title' => 'Our Partners',
    'subtitle' => 'Leadership & Expertise'
])

<!-- Team Start -->
<div class="container-fluid team py-5 bg-secondary-subtle">
    <div class="container">
        <!-- Header Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10 text-center">
                <div class="pb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="display-5 fw-bold mb-4 text-dark">Meet Our Partners</h1>
                    <div class="title-divider mx-auto mb-4"></div>
                    <p class="mb-4" style="text-align: justify; line-height: 1.8;">
                        At the heart of our firm is a dedicated team of partners whose combined experience spans decades of legal practice. 
                        Each partner brings unique expertise in areas such as corporate law, litigation, property, family law, and advisory services. 
                        Together, they uphold the firm's values of integrity, professionalism, and client-focused solutions—guiding both individuals 
                        and businesses with clarity and confidence.
                    </p>
                    <div class="partners-stats row mt-5 justify-content-center">
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                {{-- <h3 class="text-maroon fw-bold">{{ $partners->count() }}+</h3> --}}
                                <h3 class="text-maroon fw-bold counter" data-target="{{ $partners->count() }}">{{ $partners->count() ?? ''}}</h3>
                                <p class="text-muted mb-0">Partners</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                {{-- <h3 class="text-maroon fw-bold">{{$partners->sum('years_of_experience') ?? ''}}+</h3> --}}
                                <h3 class="text-maroon fw-bold counter" data-target="{{$partners->sum('years_of_experience') ?? ''}}">{{$partners->sum('years_of_experience') ?? ''}}</h3>
                                {{-- <p class="text-muted mb-0">Partners</p> --}}
                                <p class="text-muted mb-0">Years of Experience - Combined</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                {{-- <h3 class="text-maroon fw-bold">{{$partners->sum('deals_completed') ?? ''}}+</h3> --}}
                                <h3 class="text-maroon fw-bold counter" data-target="{{$partners->sum('deals_completed') ?? ''}}">{{$partners->sum('deals_completed') ?? ''}}</h3>
                                <p class="text-muted mb-0">Cases Handled - Combined</p>
                            </div>
                        </div>
                        {{-- <div class="col-md-3 col-6">
                            <div class="stat-item">
                                <h3 class="text-maroon fw-bold">98%</h3>
                                <p class="text-muted mb-0">Success Rate</p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Partners Grid -->
        <div class="row g-4 justify-content-center">
            @forelse($partners as $partner)
            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="{{ 0.1 * ($loop->iteration) }}s">
                <div class="team-item h-100">
                    <div class="team-img">
                        <img src="{{ $partner->avatar_url ?? '/images/default-avatar.png' }}" class="img-fluid" alt="{{ $partner->name }}" loading="lazy">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-1">{{ $partner->name }}</h4>
                        <p class="mb-2">{{ $partner->designation ?? 'Partner' }}</p>
                        @if($partner->specialization)
                        <div class="specialization">
                            <span class="badge bg-light text-maroon small">{{ $partner->specialization }}</span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="team-icon">
                        @if($partner->email)
                        <a class="btn btn-icon" href="mailto:{{ $partner->email }}" title="Email {{ $partner->name }}">
                            <i class="fas fa-envelope"></i>
                        </a>
                        @endif
                        @if($partner->linkedin_url)
                        <a class="btn btn-icon" href="{{ $partner->linkedin_url }}" target="_blank" title="LinkedIn Profile">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        @endif
                        @if($partner->whatsapp_link)
                        <a class="btn btn-icon" href="{{ $partner->whatsapp_link }}" target="_blank" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        @endif
                        @if($partner->phone)
                        <a class="btn btn-icon" href="tel:{{ $partner->phone }}" title="Call {{ $partner->name }}">
                            <i class="fas fa-phone"></i>
                        </a>
                        @endif
                    </div>
                    
                    <div class="team-btn">
                        <a href="{{ route('our-people.partner', $partner->slug) }}" class="btn read-more-btn">
                            <i class="fas fa-user me-2"></i>View Profile
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="team-empty-state wow fadeInUp">
                    <i class="bi bi-people display-1"></i>
                    <h4 class="text-muted mt-3">No Partners Available</h4>
                    <p class="text-muted">Our partner team profiles are currently being updated.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        <!-- CTA Section -->
        @if($partners->count() > 0)
        <div class="row mt-5">
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="cta-section p-5 rounded-4 bg-maroon text-white">
                    <h3 class="mb-3">Ready to Work With Our Legal Experts?</h3>
                    <p class="mb-4">Contact us today to schedule a consultation with one of our partners.</p>
                    <a href="{{ route('contactUs') }}" class="btn btn-light btn-lg px-4">
                        <i class="fas fa-calendar me-2"></i>Schedule Consultation
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Team End -->

@endsection

@push('styles')
<style>
    .title-divider {
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, var(--new-maroon), var(--maroon));
        border-radius: 2px;
    }

    .partners-stats {
        margin-top: 3rem;
    }

    .stat-item {
        text-align: center;
        padding: 1rem;
    }

    .stat-item h3 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .cta-section {
        background: linear-gradient(135deg, var(--new-maroon), var(--maroon)) !important;
    }

    .specialization {
        margin-top: 0.5rem;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }
</style>
@endpush

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');
            
            // Function to check if element is in viewport
            function isInViewport(element) {
                const rect = element.getBoundingClientRect();
                return (
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                );
            }
            
            // Function to animate counter
            function animateCounter(counter) {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000; // Animation duration in milliseconds
                const step = target / (duration / 16); // Calculate step for 60fps
                let current = 0;
                
                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current) + (counter.getAttribute('data-target') === '98' ? '%' : '+');
                }, 16);
            }
            
            // Function to handle scroll event
            function handleScroll() {
                counters.forEach(counter => {
                    if (isInViewport(counter) && !counter.classList.contains('animated')) {
                        counter.classList.add('animated');
                        animateCounter(counter);
                    }
                });
            }
            
            // Initial check on page load
            handleScroll();
            
            // Listen for scroll events
            window.addEventListener('scroll', handleScroll);
        });
    </script>
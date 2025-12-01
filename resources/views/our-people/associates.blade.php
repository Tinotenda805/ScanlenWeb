@extends('layouts.app')

@section('content')

@include('layouts.page-associatesheader', [
    'title' => 'Our Associates',
])

<!-- Team Start -->
<div class="container-fluid team py-5">
    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10 text-center">
                <div class="pb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="display-5 fw-bold mb-4 text-dark">Meet Our Associates</h1>
                    <p class="mb-4" style="text-align: justify; line-height: 1.8;">
                        At the heart of our firm is a dedicated team of associates whose combined experience spans decades of legal practice. 
                        Each associate brings unique expertise in areas such as corporate law, litigation, property, family law, and advisory services. 
                        Together, they uphold the firm's values of integrity, professionalism, and client-focused solutions  guiding both individuals 
                        and businesses with clarity and confidence.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="row g-4 justify-content-center">
            @forelse($associates as $associate)
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="{{ 0.1 * ($loop->iteration) }}s">
                <div class="team-item h-100">
                    <div class="team-img">
                        <img src="{{ $associate->avatar_url }}" class="img-fluid" alt="{{ $associate->name }}">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">{{ $associate->name }}</h4>
                        <p class="mb-0">{{ $associate->designation }}</p>
                    </div>
                    <div class="team-icon">
                        @if($associate->email)
                        <a class="rounded-circle btn me-3" href="mailto:{{ $associate->email }}">
                            <i class="fas fa-envelope"></i>
                        </a>
                        @endif
                        @if($associate->linkedin_url)
                        <a class="rounded-circle btn me-3" href="{{ $associate->linkedin_url }}" target="_blank">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        @endif
                        @if($associate->whatsapp_link)
                        <a class="rounded-circle btn me-3" href="{{ $associate->whatsapp_link }}" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        @endif
                        @if($associate->phone)
                        <a class="rounded-circle btn me-0" href="tel:{{ $associate->phone }}">
                            <i class="fas fa-phone"></i>
                        </a>
                        @endif
                    </div>
                    <div class="team-btn mt-3">
                        <a href="{{ route('our-people.partner', $associate->slug) }}" class="btn read-more-btn">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-people" style="font-size: 4rem; color: #ccc;"></i>
                <p class="text-muted mt-3">No associates found at the moment.</p>
            </div>
            @endforelse
        </div>

        <!-- CTA Section -->
        @if($associates->count() > 0)
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
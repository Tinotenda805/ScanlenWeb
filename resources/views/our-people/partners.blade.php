@extends('layouts.app')

@section('content')

@include('layouts.page-Currentheader', [
    'title' => 'Our Partners',
])

<!-- Team Start -->
<div class="container-fluid team py-5">
    <div class="container py-5">
        <div class="mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">
            <h1 class="display-5 mb-4 text-center">Meet Our Partners</h1>
            <p class="mb-0" style="text-align: justify">
                At the heart of our firm is a dedicated team of partners whose combined experience spans decades of legal practice. 
                Each partner brings unique expertise in areas such as corporate law, litigation, property, family law, and advisory services. 
                Together, they uphold the firm's values of integrity, professionalism, and client-focused solutions  guiding both individuals 
                and businesses with clarity and confidence.
            </p>
        </div>
        
        <div class="row g-4">
            @forelse($partners as $partner)
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="{{ 0.2 * ($loop->iteration) }}s">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{ $partner->avatar_url }}" class="img-fluid" alt="{{ $partner->name }}">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">{{ $partner->name }}</h4>
                        <p class="mb-0">{{ $partner->designation }}</p>
                    </div>
                    <div class="team-icon">
                        @if($partner->email)
                        <a class="rounded-circle btn me-3" href="mailto:{{ $partner->email }}">
                            <i class="fas fa-envelope"></i>
                        </a>
                        @endif
                        @if($partner->linkedin_url)
                        <a class="rounded-circle btn me-3" href="{{ $partner->linkedin_url }}" target="_blank">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        @endif
                        @if($partner->whatsapp_link)
                        <a class="rounded-circle btn me-3" href="{{ $partner->whatsapp_link }}" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        @endif
                        @if($partner->phone)
                        <a class="rounded-circle btn me-0" href="tel:{{ $partner->phone }}">
                            <i class="fas fa-phone"></i>
                        </a>
                        @endif
                    </div>
                    <div class="team-btn mt-3">
                        <a href="{{ route('our-people.partner', $partner->id) }}" class="btn read-more-btn">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-people" style="font-size: 4rem; color: #ccc;"></i>
                <p class="text-muted mt-3">No partners found at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
<!-- Team End -->

@endsection
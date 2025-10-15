@extends('layouts.app')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <div class="hero-partners-bg">
            {{-- founder image on the centre --}}
            <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" alt="Sir Thomas Scanlen" class="partner founder">
            <!-- Other partners placed randomly -->

            <img src="{{ asset('images/oldpartners/op1.jpeg') }}" alt="Old Partner" class="partner random">
            <img src="{{ asset('images/oldpartners/op2.jpeg') }}" alt="Old Partner" class="partner random">
            <img src="{{ asset('images/oldpartners/op3.jpeg') }}" alt="Old Partner" class="partner random">
            <img src="{{ asset('images/oldpartners/op4.jpeg') }}" alt="Old Partner" class="partner random">
            <img src="{{ asset('images/oldpartners/op5.jpeg') }}" alt="Old Partner" class="partner random">
        </div>
        
        {{-- Circular carousel for current partners --}}
        <div class="c-partners-container">
            <span class="cpartners-text">Current Partners</span>
            <div id="circular-carousel" class="position-relative">
                @if(isset($partners) && $partners->count() > 0)
                    @foreach($partners as $index => $partner)
                        <a href="{{ route('our-people.partners') }}#partner-{{ $partner->id }}" 
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
            <div class="col-lg-6 ps-lg-4">
                {{-- <h2 class="mb-4">Professional Memberships</h2> --}}
                <video class="w-100 rounded" autoplay loop muted>
                    <source src="{{asset('videos/law-firm.mp4')}}" type="video/mp4" />
                </video>
            </div>
        </div>
    </div>
</section>

<section class="find-lawyer p-5 bg-primary-subtle text-center">
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
                <select name="sector" class="form-select">
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
<section id="faq" class="faq bg-white py-5">
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

</section>
<!-- /Faq Section -->

<style>
    /* * Find Lawyer Section */
    /* Find Lawyer Section */
.find-lawyer {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
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


</style>
    
@endsection



   
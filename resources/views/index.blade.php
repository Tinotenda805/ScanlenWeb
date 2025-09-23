@extends('layouts.app')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        {{-- <div class="hero-partners-bg" >
            @for ($i = 0; $i < 60; $i++)
                <img src="{{ asset(['images/period3.jpg','images/period1.jpg','images/period2.jpg'][$i%3]) }}" alt="Old Partner {{ $i+1 }}" style="width:100%;height:100%;object-fit:cover;">
            @endfor
        </div> --}}
        <div class="hero-partners-bg">
            <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" alt="Sir Thomas Scanlen" class="partner founder">

            <!-- Other partners placed randomly -->

            <img src="{{ asset('images/oldpartners/op1.jpeg') }}" alt="Old Partner" class="partner random">
            <img src="{{ asset('images/oldpartners/op2.jpeg') }}" alt="Old Partner" class="partner random">
            <img src="{{ asset('images/oldpartners/op3.jpeg') }}" alt="Old Partner" class="partner random">
            <img src="{{ asset('images/oldpartners/op4.jpeg') }}" alt="Old Partner" class="partner random">
            <img src="{{ asset('images/oldpartners/op5.jpeg') }}" alt="Old Partner" class="partner random">
        </div>
        
        <!-- Circular carousel -->
        <div class="c-partners-container">
            <span class="cpartners-text" style="display: ">Current Partners</span>
            <div id="circular-carousel" class="position-relative">
                <!-- Partner 1 -->
                <a href="#partner1" class="carousel-img" style="--i:0;" title="Partner 1">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Partner 1" class="rounded-circle">
                    <div class="partner-info">Robert Scanlen - Senior Partner</div>
                </a>
                
                <!-- Partner 2 -->
                <a href="#partner2" class="carousel-img" style="--i:1;" title="Partner 2">
                    <img src="https://images.unsplash.com/photo-1557862921-37829c790f19?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Partner 2" class="rounded-circle">
                    <div class="partner-info">Sarah Holderness - Managing Partner</div>
                </a>
                
                <!-- Partner 3 -->
                <a href="#partner3" class="carousel-img" style="--i:2;" title="Partner 3">
                    <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Partner 3" class="rounded-circle">
                    <div class="partner-info">Emily Chen - Litigation Partner</div>
                </a>
                
                <!-- Partner 4 -->
                <a href="#partner4" class="carousel-img" style="--i:3;" title="Partner 4">
                    <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Partner 4" class="rounded-circle">
                    <div class="partner-info">Michael Rodriguez - Corporate Partner</div>
                </a>
                
                <!-- Partner 5 -->
                <a href="#partner5" class="carousel-img" style="--i:4;" title="Partner 5">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Partner 5" class="rounded-circle">
                    <div class="partner-info">David Williams - Real Estate Partner</div>
                </a>
                
                <!-- Partner 6 -->
                <a href="#partner6" class="carousel-img" style="--i:5;" title="Partner 6">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Partner 6" class="rounded-circle">
                    <div class="partner-info">James Brown - Intellectual Property</div>
                </a>
                
                <!-- Partner 7 -->
                <a href="#partner7" class="carousel-img" style="--i:6;" title="Partner 7">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Partner 7" class="rounded-circle">
                    <div class="partner-info">Jennifer Wilson - Family Law</div>
                </a>
                
                <!-- Partner 8 -->
                <a href="#partner8" class="carousel-img" style="--i:7;" title="Partner 8">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Partner 8" class="rounded-circle">
                    <div class="partner-info">Maria Garcia - Criminal Defense</div>
                </a>
                
                <!-- Partner 9 -->
                <a href="#partner9" class="carousel-img" style="--i:8;" title="Partner 9">
                    <img src="https://images.unsplash.com/photo-1542178243-bc20204b769f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Partner 9" class="rounded-circle">
                    <div class="partner-info">Thomas Moore - Tax Law</div>
                </a>
            </div>
        </div>
    </div>

    <!-- Company Overview & Membership Section -->
    <!-- Additional Section Below Landing Page -->
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
    <h3 class="fw-bold text-maroon ">Find A Lawyer</h3>
    <form action="">
        
        <div class="row py-2">
            <div class="col-sm">
                <input type="text" name="name" class="form-control" placeholder="Search By Name" id="">
            </div>
            OR
            <div class="col-sm">
                <select name="service" id="" class="form-select">
                    <option value="" selected>SERVICES</option>
                </select>
            </div>
            <div class="col-sm">
                <select name="service" id="" class="form-select">
                    <option value="" selected>SECTORS</option>
                </select>
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

            <div class="faq-item faq-active">
            <i class="faq-icon bi bi-question-circle"></i>
            <h3>Non consectetur a erat nam at lectus urna duis?</h3>
            <div class="faq-content">
                <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
            </div><!-- End Faq item-->

            <div class="faq-item">
            <i class="faq-icon bi bi-question-circle"></i>
            <h3>Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?</h3>
            <div class="faq-content">
                <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
            </div><!-- End Faq item-->

            <div class="faq-item">
            <i class="faq-icon bi bi-question-circle"></i>
            <h3>Dolor sit amet consectetur adipiscing elit pellentesque?</h3>
            <div class="faq-content">
                <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis</p>
            </div>
            <i class="faq-toggle bi bi-chevron-right"></i>
            </div><!-- End Faq item-->

        </div>

        </div>

    </div>

    </div>

</section>
<!-- /Faq Section -->


    
@endsection


{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

   
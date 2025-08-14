@extends('layouts.app')

@section('title', 'Home - Scanlen & Holderness')

@section('content')
    <!-- <section class="hero bg-light py-5 text-center">
        <div class="container">
            Removed heading and lead text
            <a href="{{ route('contact') }}" class="btn btn-primary btn-lg mt-3">Request Consultation</a>
        </div> -->
    </section>

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0" style="background: linear-gradient(135deg, #cc9999 60%, #fff 100%); border-radius: 1.5rem; box-shadow: none; border: none;">
                    <div class="card-body py-5 d-flex flex-column align-items-center" style="background: transparent; box-shadow: none;">
                        <h3 class="fw-bold text-maroon mb-2" style="color:#800000;">Firm Milestones</h3>
                        <p class="text-secondary mb-4 text-center" style="max-width: 500px;">
                            Celebrating our journey since 1894. Explore the key periods that shaped Scanlen & Holderness.
                        </p>
                        <div id="circular-carousel" style="position:relative;width:260px;height:260px;">
                            <a href="#period1" class="carousel-img" style="--i:0;" title="1894-1920">
                                <img src="{{ asset('images/period1.jpg') }}" alt="1894-1920" style="width:70px;height:70px;border-radius:50%;" data-bs-toggle="tooltip" data-bs-placement="top" title="1894-1920">
                            </a>
                            <a href="#period2" class="carousel-img" style="--i:1;"><img src="{{ asset('images/period2.jpg') }}" alt="1921-1960" style="width:70px;height:70px;border-radius:50%;"></a>
                            <a href="#period3" class="carousel-img" style="--i:2;"><img src="{{ asset('images/period3.jpg') }}" alt="1961-2000" style="width:70px;height:70px;border-radius:50%;"></a>
                            <a href="#period4" class="carousel-img" style="--i:3;"><img src="{{ asset('images/period4.jpg') }}" alt="2001-Present" style="width:70px;height:70px;border-radius:50%;"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        #circular-carousel {
            position: relative;
            width: 260px;
            height: 260px;
            margin: 0 auto;
            box-shadow: 0 4px 24px rgba(128,0,0,0.10);
            border: 4px solid #800000;
            border-radius: 50%;
            background: #fff;
        }
        .carousel-img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(calc(var(--i) * 90deg)) translate(110px) rotate(calc(var(--i) * -90deg));
            transition: transform 0.5s;
        }
        .carousel-img img {
            transition: box-shadow 0.3s, transform 0.3s;
        }
        .carousel-img.active img {
            box-shadow: 0 0 16px #80000088;
            transform: scale(1.15);
            z-index: 2;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .col-md-6 {
            animation: fadeInUp 1s ease;
        }
        @media (min-width: 768px) {
            .row > .col-md-6:first-child {
                border-right: 2px solid #80000022;
                padding-right: 2rem;
            }
        }
        @media (max-width: 767px) {
            .row > .col-md-6 {
                border-right: none;
                padding-right: 0;
                margin-bottom: 2rem;
            }
            #circular-carousel {
                margin: 0 auto;
            }
        }
    </style>

    <script>
        let angle = 0;
        const imgs = document.querySelectorAll('#circular-carousel .carousel-img');
        function rotateCarousel() {
            angle += 0.5;
            imgs.forEach((img, i) => {
                img.classList.remove('active');
                img.style.transform = `translate(-50%, -50%) rotate(${angle + i*90}deg) translate(110px) rotate(${-angle - i*90}deg)`;
                // Highlight the image closest to the top (angle % 360 == 0)
                if (Math.round((angle + i*90) % 360) === 0) {
                    img.classList.add('active');
                }
            });
            requestAnimationFrame(rotateCarousel);
        }
        rotateCarousel();

        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
            new bootstrap.Tooltip(el);
        });
    </script>
@endsection
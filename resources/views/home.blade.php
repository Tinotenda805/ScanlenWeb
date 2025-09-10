@extends('layouts.app')

@section('content')

<div id="hero" class="hero-section d-flex align-items-center justify-content-center position-relative">
    <!-- Blurry old partners background grid -->
    <div class="hero-partners-bg" >
        @for ($i = 0; $i < 60; $i++)
            <img src="{{ asset(['images/period3.jpg','images/period1.jpg','images/period2.jpg'][$i%3]) }}" alt="Old Partner {{ $i+1 }}" style="width:100%;height:100%;object-fit:cover;">
        @endfor
    </div>
    <div class="container position-relative" style="z-index:10;">
        <div class="d-sm-flex align-items-center">
            <!-- Left content -->
            <div class="col-lg-7 col-md-12 mb-4 mb-lg-0 text-start">
                <!-- <h1 class="fw-bold">Welcome to Scanlen and Holdernesss</h1> -->
               {{-- <p class="lead">
                    A premier Zimbabwean law firm offering you a full 
                    circle of legal services whether you are a local, regional or international 
                    client. Our quality of expertise consistently earns us and our lawyers a top 
                    ranking in both local and international legal surveys.
                </p> --}}
            </div>

            <!-- Right circular carousel -->
                <div class="col-lg-5 col-md-12 d-flex flex-column align-items-start justify-content-center position-relative" style="text-align:center; height:; display:flex; align-items:start; justify-content:flex-start;">
                    <div class="position-relative c-partners-container">
                        <span class="cpartners-text">Current Partners</span>
                        <div id="circular-carousel" class="position-relative">
                            <!-- Partner 1 -->
                            <a href="#partner1" class="carousel-img" style="--i:0;" title="Partner 1">
                                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Partner 1" class="rounded-circle">
                                <div class="partner-info">John Smith - Senior Partner</div>
                            </a>
                            
                            <!-- Partner 2 -->
                            <a href="#partner2" class="carousel-img" style="--i:1;" title="Partner 2">
                                <img src="https://images.unsplash.com/photo-1557862921-37829c790f19?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Partner 2" class="rounded-circle">
                                <div class="partner-info">Sarah Johnson - Managing Partner</div>
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


    
@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('circular-carousel');
            if (!carousel) return;
            
            const images = carousel.querySelectorAll('.carousel-img');
            const total = images.length;
            const radius = 150; // px, distance from center
            const centerX = carousel.offsetWidth / 2;
            const centerY = carousel.offsetHeight / 2;
            const imgSize = 90; // px, image width/height
            let angle = 0;

            function positionImages() {
                for (let i = 0; i < total; i++) {
                    // Calculate angle for each image
                    const theta = ((360 / total) * i + angle) * Math.PI / 180;
                    const x = centerX + Math.cos(theta) * radius - imgSize / 2;
                    const y = centerY + Math.sin(theta) * radius - imgSize / 2;
                    
                    images[i].style.left = x + 'px';
                    images[i].style.top = y + 'px';
                    images[i].style.transform = 'rotate(0deg)'; // Always upright
                }
            }

            function animate() {
                angle += 0.3; // rotation speed
                positionImages();
                requestAnimationFrame(animate);
            }

            // Initialize and start animation
            positionImages();
            animate();
            
            // Reposition on window resize
            window.addEventListener('resize', function() {
                // Recalculate center position
                centerX = carousel.offsetWidth / 2;
                centerY = carousel.offsetHeight / 2;
                positionImages();
            });
        });
</script>







{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

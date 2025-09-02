@extends('layouts.app')

@section('content')

<div id="hero" class="hero-section d-flex align-items-center justify-content-center position-relative" style="min-height: 100vh;">
    <!-- Blurry old partners background grid -->
    <div class="hero-partners-bg" style="position:absolute;top:0;left:0;width:100%;height:100%;display:grid;grid-template-columns:repeat(12,1fr);grid-auto-rows:120px;gap:10px;opacity:0.45;filter:blur(2px) grayscale(100%);z-index:1;">
        @for ($i = 0; $i < 48; $i++)
            <img src="{{ asset(['images/period3.jpg','images/period1.jpg','images/period2.jpg'][$i%3]) }}" alt="Old Partner {{ $i+1 }}" style="width:100%;height:100%;object-fit:cover;">
        @endfor
    </div>
    <div class="container position-relative" style="z-index:10;">
        <div class="d-sm-flex align-items-center">
            <!-- Left content -->
            <div class="col-lg-7 col-md-12 mb-4 mb-lg-0 text-start">
                <!-- <h1 class="fw-bold">Welcome to Scanlen and Holdernesss</h1> -->
                <!-- <p class="lead">
                    A premier Zimbabwean law firm offering you a full 
                    circle of legal services whether you are a local, regional or international 
                    client. Our quality of expertise consistently earns us and our lawyers a top 
                    ranking in both local and international legal surveys.
                </p> -->
            </div>

            <!-- Right circular carousel -->
                <div class="col-lg-5 col-md-12 d-flex flex-column align-items-start justify-content-center position-relative" style="text-align:center; height:100vh; display:flex; align-items:start; justify-content:flex-start;">
                    <div class="position-relative" style="width:400px; height:400px; margin-left:-300px; margin-top:-240px; display:flex; align-items:center; justify-content:flex-start;">
                    <span style="
                        position:absolute;
                        top:50%;
                        left:50%;
                        transform:translate(-50%,-50%);
                        font-size:1.3rem;
                        color:#3c0008;
                        background:linear-gradient(135deg,#fff 70%,#f7e6ee 100%);
                        border-radius:50%;
                        padding:1rem 1.5rem;
                        border:4px solid #800000;
                        font-family:'Segoe UI','Arial',sans-serif;
                        font-weight:700;
                        letter-spacing:1.5px;
                        z-index:2;
                    ">Current Partners</span>
                    <div id="circular-carousel" class="position-relative">
                    <a href="#img4" class="carousel-img" style="--i:0;" title="Partner 4">
                        <img src="{{ asset('images/4.jpeg') }}" alt="Partner 4" class="rounded-circle">
                    </a>
                    <a href="#img5" class="carousel-img" style="--i:1;" title="Partner 5">
                        <img src="{{ asset('images/5.jpeg') }}" alt="Partner 5" class="rounded-circle">
                    </a>
                    <a href="#img7" class="carousel-img" style="--i:2;" title="Partner 7">
                        <img src="{{ asset('images/7.jpeg') }}" alt="Partner 7" class="rounded-circle">
                    </a>
                    <a href="#img8" class="carousel-img" style="--i:3;" title="Partner 8">
                        <img src="{{ asset('images/8.jpeg') }}" alt="Partner 8" class="rounded-circle">
                    </a>
                    <a href="#img9" class="carousel-img" style="--i:4;" title="Partner 9">
                        <img src="{{ asset('images/9.jpeg') }}" alt="Partner 9" class="rounded-circle">
                    </a>
                    <a href="#img1" class="carousel-img" style="--i:5;" title="Partner 1">
                        <img src="{{ asset('images/1.jpeg') }}" alt="Partner 1" class="rounded-circle">
                    </a>
                    <a href="#img2" class="carousel-img" style="--i:6;" title="Partner 2">
                        <img src="{{ asset('images/2.jpeg') }}" alt="Partner 2" class="rounded-circle">
                    </a>
                    <a href="#img3" class="carousel-img" style="--i:7;" title="Partner 3">
                        <img src="{{ asset('images/3.jpeg') }}" alt="Partner 3" class="rounded-circle">
                    </a>
                    <a href="#img6" class="carousel-img" style="--i:8;" title="Partner 6">
                        <img src="{{ asset('images/6.jpeg') }}" alt="Partner 6" class="rounded-circle">
                    </a>
                    </div>
                </div>
                </div>

            </div>
        </div>
    </div>
</div>

    
{{-- <div id="hero" class="p-5 text-center">
    <div class="container">
        <div class="d-sm-flex">
            <div>
                <h1> Welcome to Scanlen and Holderness</h1>
                <p>
                    Scanlen & Holderness is a premier Zimbabwean law firm offering you a full 
                    circle of legal services whether you are a local, regional or international 
                    client. Our quality of expertise consistently earns us and our lawyers a top 
                    ranking in both local and international legal surveys. 
                </p>
            </div>
            <div id="circular-carousel" class="">
                <a href="#period1" class="carousel-img" style="--i:0;" title="1894-1920">
                    <img src="{{ asset('images/period1.jpg') }}" alt="1894-1920" style="width:70px;height:70px;border-radius:50%;" data-bs-toggle="tooltip" data-bs-placement="top" title="1894-1920">
                </a>
                <a href="#period2" class="carousel-img" style="--i:1;"><img src="{{ asset('images/period2.jpg') }}" alt="1921-1960" style="width:70px;height:70px;border-radius:50%;"></a>
                <a href="#period3" class="carousel-img" style="--i:2;"><img src="{{ asset('images/period3.jpg') }}" alt="1961-2000" style="width:70px;height:70px;border-radius:50%;"></a>
                <a href="#period4" class="carousel-img" style="--i:3;"><img src="{{ asset('images/period4.jpg') }}" alt="2001-Present" style="width:70px;height:70px;border-radius:50%;"></a>
            </div>
        </div>

    </div>
    
</div> --}}
{{-- <div class="row">
    <div class="col-12">
        <h1 class="text-uppercase display-1 fw-semi-bold"> Welcome to Scanlen and Holderness</h1>
        <div id="circular-carousel" >
            <a href="#period1" class="carousel-img" style="--i:0;" title="1894-1920">
                <img src="{{ asset('images/period1.jpg') }}" alt="1894-1920" style="width:70px;height:70px;border-radius:50%;" data-bs-toggle="tooltip" data-bs-placement="top" title="1894-1920">
            </a>
            <a href="#period2" class="carousel-img" style="--i:1;"><img src="{{ asset('images/period2.jpg') }}" alt="1921-1960" style="width:70px;height:70px;border-radius:50%;"></a>
            <a href="#period3" class="carousel-img" style="--i:2;"><img src="{{ asset('images/period3.jpg') }}" alt="1961-2000" style="width:70px;height:70px;border-radius:50%;"></a>
            <a href="#period4" class="carousel-img" style="--i:3;"><img src="{{ asset('images/period4.jpg') }}" alt="2001-Present" style="width:70px;height:70px;border-radius:50%;"></a>
        </div>
    </div>
</div> --}}

    
@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('circular-carousel');
    if (!carousel) return;
    const images = carousel.querySelectorAll('.carousel-img');
    const total = images.length;
    const radius = 170; // px, distance from center
    const centerX = 200; // half of carousel width
    const centerY = 200; // half of carousel height
    const imgSize = 70; // px, image width/height
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
        angle += 0.5; // speed
        positionImages();
        requestAnimationFrame(animate);
    }

    positionImages();
    animate();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('circular-carousel');
    if (!carousel) return;
    const images = carousel.querySelectorAll('.carousel-img');
    const total = images.length;
    const radius = 170; // px, distance from center
    const centerX = 200; // half of carousel width
    const centerY = 200; // half of carousel height
    const imgSize = 70; // px, image width/height
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
        angle += 0.5; // speed
        positionImages();
        requestAnimationFrame(animate);
    }

    positionImages();
    animate();
});
</script>
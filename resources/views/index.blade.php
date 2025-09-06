<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanlen & Holderness - Law Firm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --maroon: #3c0008;
            --light-maroon: #50010b;
            --white: #ffffff;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
            --gold: #d4af37;
        }
        
        body {
            font-family: 'Georgia', serif;
            color: #333;
            line-height: 1.6;
            padding-top: 80px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.9), rgba(248, 249, 250, 0.9)), 
                        url('https://images.unsplash.com/photo-1589391886645-d51941baf7fb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80') center/cover no-repeat;
            min-height: 100vh;
        }
        
        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1030;
            background: linear-gradient(90deg, #3c0008 0%, #555555 100%) !important;
            box-shadow: 0 2px 8px rgba(128,0,0,0.08);
        }
        
        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: 500;
            font-size: 1.08rem;
            letter-spacing: 1px;
            transition: color 0.2s, background 0.2s;
        }
        
        .nav-link.active, .nav-link:hover {
            color: #d2c59cff !important;
            text-decoration: none;
            border-bottom: 2.5px solid #d4af37;
            background: rgba(128,0,0,0.10);
        /* Dropdown menu styling */
        .dropdown-menu {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(60,0,8,0.12);
            padding: 0.5rem 0.2rem;
            min-width: 220px;
            border: none;
        }
        .dropdown-item {
            font-size: 1rem;
            color: #3c0008;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: background 0.18s, color 0.18s;
        }
        .dropdown-item:hover, .dropdown-item:focus {
            background: #f7e6ee;
            color: #d4af37;
        }
        .nav-link.dropdown-toggle {
            padding-right: 1.5em;
        }
        .navbar-nav .nav-item {
            margin-left: 0.5rem;
            margin-right: 0.5rem;
        }
        }
        
        
        /* Main Content */
        .main-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            padding: 2rem 0;
            background: linear-gradient(rgba(33, 22, 28, 0.831), #000);
        }
        
        /* Partner Carousel */
        .c-partners-container {
            width: 500px; 
            height: 500px; 
            display: flex; 
            align-items: center; 
            justify-content: center;
            margin: 0 auto;
            position: relative;
        }
        
        .cpartners-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.5rem;
            color: var(--maroon);
            background: linear-gradient(135deg, #fff 70%, #f7e6ee 100%);
            border-radius: 50%;
            padding: 1.8rem 1rem;
            border: 2px solid var(--maroon);
            font-family: 'Segoe UI', 'Arial', sans-serif;
            font-weight: 700;
            letter-spacing: 1.5px;
            z-index: 2;
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        #circular-carousel {
            width: 500px;
            height: 500px;
            border-radius: 50%;
            position: relative;
            margin: auto;
            border: none;
            background: transparent;
        }
        
        #circular-carousel .carousel-img {
            position: absolute;
            transform-origin: center;
            transition: all 0.3s ease;
            z-index: 1;
        }
        
        #circular-carousel img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            object-fit: cover;
        }
        
        #circular-carousel .carousel-img:hover img {
            transform: scale(1.15);
            border-color: var(--maroon);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        
        /* Partner Info on Hover */
        .partner-info {
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--maroon);
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            font-size: 14px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
            z-index: 10;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .carousel-img:hover .partner-info {
            opacity: 1;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1030;
            background: #3c0008;
            color: #fff;
            border-top: 1px solid #3c0008;
            padding: 1.5rem 0;
            text-align: center;
            margin-top: auto;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .c-partners-container {
                width: 450px;
                height: 450px;
            }
            
            #circular-carousel {
                width: 450px;
                height: 450px;
            }
            
            #circular-carousel img {
                width: 100px;
                height: 100px;
            }
            
            .cpartners-text {
                width: 130px;
                height: 130px;
                font-size: 1.3rem;
            }
        }
        
        @media (max-width: 768px) {
            .c-partners-container {
                width: 380px;
                height: 380px;
            }
            
            #circular-carousel {
                width: 380px;
                height: 380px;
            }
            
            #circular-carousel img {
                width: 85px;
                height: 85px;
            }
            
            .cpartners-text {
                width: 110px;
                height: 110px;
                font-size: 1.1rem;
                padding: 1.5rem 0.8rem;
            }
        }
        
        @media (max-width: 576px) {
            .c-partners-container {
                width: 320px;
                height: 320px;
            }
            
            #circular-carousel {
                width: 320px;
                height: 320px;
            }
            
            #circular-carousel img {
                width: 70px;
                height: 70px;
            }
            
            .cpartners-text {
                width: 90px;
                height: 90px;
                font-size: 0.9rem;
                padding: 1.2rem 0.6rem;
            }
        }
        
        /* Firm Name */
        .firm-name {
            text-align: center;
            margin-bottom: 2.5rem;
            color: var(--maroon);
        }
        
        .firm-name h2 {
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        
        .firm-name p {
            font-size: 1.1rem;
            color: #555;
            font-style: italic;
        }

        .hero-partners-bg{
            position:absolute;
            top:0;left:0;
            width:100%;
            height:100%;
            display:grid;
            grid-template-columns:repeat(12,1fr);
            grid-auto-rows:120px;
            gap:10px;
            opacity:0.45;
            filter:blur(2px) grayscale(100%);
            z-index:1;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="{{ url('/') }}" style="letter-spacing:2px;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:55px; width:auto; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); background:#fff; margin-right:14px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Our History</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="ourPeopleDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Our People
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="ourPeopleDropdown">
                            <li><a class="dropdown-item" href="#">Partners</a></li>
                            <li><a class="dropdown-item" href="#">Associates</a></li>
                            <li><a class="dropdown-item" href="#">Gallery</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="expertiseDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Expertise
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="expertiseDropdown">
                            <li><a class="dropdown-item" href="#">Corporate and commercial law</a></li>
                            <li><a class="dropdown-item" href="#">Dispute resolution and litigation</a></li>
                            <li><a class="dropdown-item" href="#">Constitutional and administrative law</a></li>
                            <li><a class="dropdown-item" href="#">Employment law</a></li>
                            <li><a class="dropdown-item" href="#">Conveyancing and property law</a></li>
                            <li><a class="dropdown-item" href="#">Insolvency law and debt</a></li>
                            <li><a class="dropdown-item" href="#">Restructuring</a></li>
                            <li><a class="dropdown-item" href="#">Criminal law</a></li>
                            <li><a class="dropdown-item" href="#">Immigration law</a></li>
                            <li><a class="dropdown-item" href="#">Family law</a></li>
                            <li><a class="dropdown-item" href="#">Estate planning and administration</a></li>
                            <li><a class="dropdown-item" href="#">Intellectual property</a></li>
                            <li><a class="dropdown-item" href="#">Licensing</a></li>
                            <li><a class="dropdown-item" href="#">Compliance and regulatory law</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="briefcaseDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Briefcase
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="briefcaseDropdown">
                            <li><a class="dropdown-item" href="#">Articles</a></li>
                            <li><a class="dropdown-item" href="#">Judgements</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="hero-partners-bg" >
            @for ($i = 0; $i < 60; $i++)
                <img src="{{ asset(['images/period3.jpg','images/period1.jpg','images/period2.jpg'][$i%3]) }}" alt="Old Partner {{ $i+1 }}" style="width:100%;height:100%;object-fit:cover;">
            @endfor
        </div>
        {{-- <div class="firm-name">
            <h2>Scanlen & Holderness</h2>
            <p>Legal Excellence Since 1894</p>
        </div> --}}
        
        <!-- Circular carousel -->
        <div class="c-partners-container">
            <span class="cpartners-text">Current Partners</span>
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

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            &copy; {{ date('Y') }} Scanlen & Holderness. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap & JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('circular-carousel');
            if (!carousel) return;
            
            const images = carousel.querySelectorAll('.carousel-img');
            const total = images.length;
            const radius = 200; // px, distance from center
            const centerX = carousel.offsetWidth / 2;
            const centerY = carousel.offsetHeight / 2;
            const imgSize = 110; // px, image width/height
            let angle = 0;
            let animationId;

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
                angle += 0.2; // rotation speed
                positionImages();
                animationId = requestAnimationFrame(animate);
            }

            function stopAnimation() {
                cancelAnimationFrame(animationId);
            }

            function startAnimation() {
                animationId = requestAnimationFrame(animate);
            }

            // Initialize and start animation
            positionImages();
            startAnimation();
            
            // Pause animation on hover
            carousel.addEventListener('mouseenter', stopAnimation);
            carousel.addEventListener('mouseleave', startAnimation);
            
            // Reposition on window resize
            window.addEventListener('resize', function() {
                // Recalculate center position
                centerX = carousel.offsetWidth / 2;
                centerY = carousel.offsetHeight / 2;
                positionImages();
            });
        });
    </script>
</body>
</html>
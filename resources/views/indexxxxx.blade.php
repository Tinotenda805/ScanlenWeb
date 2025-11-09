<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partners - V-Shape Layout</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', serif;
            background: #f5f5f5;
            overflow-x: hidden;
        }

        .main-content {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 100%);
        }

        /* V-Shape Background Container */
        .hero-partners-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        /* Old Partner Images in V-Shape - STATIC */
        .partner {
            position: absolute;
            width: 180px;
            height: 240px;
            object-fit: cover;
            border: 4px solid rgba(139, 105, 20, 0.6);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            filter: grayscale(30%) sepia(20%);
            transition: all 0.5s ease;
            opacity: 0.85;
        }

        .partner:hover {
            filter: grayscale(0%) sepia(0%);
            opacity: 1;
            transform: scale(1.05) !important;
            z-index: 10;
            border-color: #8B6914;
        }

        /* V-Shape Left Side (Top to Bottom) - No animation */
        .partner:nth-child(1) {
            top: 5%;
            left: 15%;
            transform: rotate(-5deg);
        }

        .partner:nth-child(2) {
            top: 20%;
            left: 22%;
            transform: rotate(-3deg);
        }

        .partner:nth-child(3) {
            top: 35%;
            left: 28%;
            transform: rotate(-2deg);
        }

        .partner:nth-child(4) {
            top: 50%;
            left: 33%;
            transform: rotate(-1deg);
        }

        /* V-Shape Right Side (Top to Bottom) - No animation */
        .partner:nth-child(5) {
            top: 5%;
            right: 15%;
            transform: rotate(5deg);
        }

        .partner:nth-child(6) {
            top: 20%;
            right: 22%;
            transform: rotate(3deg);
        }

        .partner:nth-child(7) {
            top: 35%;
            right: 28%;
            transform: rotate(2deg);
        }

        .partner:nth-child(8) {
            top: 50%;
            right: 33%;
            transform: rotate(1deg);
        }

        /* Founder Center */
        .founder-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 5;
            text-align: center;
        }

        .founder-img {
            width: 280px;
            height: 280px;
            border-radius: 50%;
            object-fit: cover;
            border: 8px solid #8B6914;
            box-shadow: 
                0 0 60px rgba(139, 105, 20, 0.6),
                0 20px 60px rgba(0, 0, 0, 0.7);
            position: relative;
            z-index: 2;
        }

        .founder-label {
            margin-top: 1.5rem;
            font-size: 1.5rem;
            font-weight: bold;
            color: #8B6914;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            background: rgba(0, 0, 0, 0.7);
            padding: 0.8rem 2rem;
            border-radius: 30px;
            display: inline-block;
        }

        /* 3D Circular Carousel - Partners orbit on the golden circle */
        #circular-carousel {
            position: relative;
            width: 100%;
            max-width: 700px;
            height: 700px;
            margin: 0 auto;
            z-index: 10;
        }

        .carousel-img {
            position: absolute;
            width: 120px;
            height: 120px;
            left: 50%;
            top: 50%;
            text-decoration: none;
            transition: all 0.4s ease;
        }

        .carousel-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 4px solid #8B6914;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6);
            transition: all 0.4s ease;
        }

        .carousel-img:hover img {
            border-color: #d4a574;
            box-shadow: 0 12px 32px rgba(139, 105, 20, 0.7);
            transform: scale(1.2);
        }

        .partner-info {
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(139, 105, 20, 0.95);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
            text-align: center;
            min-width: 200px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }

        .carousel-img:hover .partner-info {
            opacity: 1;
        }

        /* Position partners along the circle circumference */
        .carousel-img {
            --angle: calc(var(--i) * (360deg / 8));
            --radius: 160px; /* Same as the golden circle radius (320px / 2) */
            transform: 
                translate(-50%, -50%)
                rotate(var(--angle))
                translateY(calc(var(--radius) * -1));
        }

        .carousel-img img {
            transform: rotate(calc(var(--angle) * -1));
        }

        /* Smooth rotation animation for the carousel container */
        #circular-carousel {
            animation: rotateCarousel 40s linear infinite;
        }

        @keyframes rotateCarousel {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        #circular-carousel:hover {
            animation-play-state: paused;
        }

        .no-partners-message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #8B6914;
            font-size: 1.5rem;
            text-align: center;
        }

        /* Decorative elements */
        .founder-center::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 320px;
            height: 320px;
            border: 2px dashed rgba(139, 105, 20, 0.3);
            border-radius: 50%;
            animation: rotate 20s linear infinite;
            z-index: 1;
        }

        @keyframes rotate {
            from { transform: translate(-50%, -50%) rotate(0deg); }
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .partner {
                width: 140px;
                height: 190px;
            }

            .carousel-img {
                --radius: 140px;
                width: 100px;
                height: 100px;
            }

            .founder-img {
                width: 220px;
                height: 220px;
            }

            .founder-center::before {
                width: 280px;
                height: 280px;
            }

            #circular-carousel {
                max-width: 600px;
                height: 600px;
            }
        }

        @media (max-width: 768px) {
            .partner {
                width: 100px;
                height: 140px;
            }

            .partner:nth-child(1) { left: 5%; top: 8%; }
            .partner:nth-child(2) { left: 10%; top: 22%; }
            .partner:nth-child(3) { left: 15%; top: 36%; }
            .partner:nth-child(4) { left: 20%; top: 50%; }
            .partner:nth-child(5) { right: 5%; top: 8%; }
            .partner:nth-child(6) { right: 10%; top: 22%; }
            .partner:nth-child(7) { right: 15%; top: 36%; }
            .partner:nth-child(8) { right: 20%; top: 50%; }

            .founder-img {
                width: 160px;
                height: 160px;
            }

            .founder-center::before {
                width: 200px;
                height: 200px;
            }

            .carousel-img {
                --radius: 100px;
                width: 80px;
                height: 80px;
            }

            #circular-carousel {
                max-width: 450px;
                height: 450px;
            }

            .partner-info {
                font-size: 0.7rem;
                min-width: 150px;
                padding: 0.4rem 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="hero-partners-bg">
            <!-- Founder image in center -->
            <div class="founder-center">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop" 
                     alt="Sir Thomas Scanlen" 
                     class="founder-img">
                <div class="founder-label">Founder</div>
            </div>

            <!-- Old Partners in V-Shape (Left side descending) -->
            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&h=400&fit=crop" alt="Old Partner" class="partner">
            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=300&h=400&fit=crop" alt="Old Partner" class="partner">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=400&fit=crop" alt="Old Partner" class="partner">
            <img src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?w=300&h=400&fit=crop" alt="Old Partner" class="partner">
            
            <!-- Old Partners in V-Shape (Right side descending) -->
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&h=400&fit=crop" alt="Old Partner" class="partner">
            <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=300&h=400&fit=crop" alt="Old Partner" class="partner">
            <img src="https://images.unsplash.com/photo-1463453091185-61582044d556?w=300&h=400&fit=crop" alt="Old Partner" class="partner">
            <img src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?w=300&h=400&fit=crop" alt="Old Partner" class="partner">
        </div>
        
        <!-- 3D Carousel for current partners -->
        <div id="circular-carousel">
            <!-- Partner 1 -->
            <a href="#" class="carousel-img" style="--i:0;" title="John Smith">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=200&h=200&fit=crop" 
                     alt="John Smith" 
                     class="rounded-circle">
                <div class="partner-info">
                    John Smith - Senior Partner
                </div>
            </a>

            <!-- Partner 2 -->
            <a href="#" class="carousel-img" style="--i:1;" title="Sarah Johnson">
                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=200&h=200&fit=crop" 
                     alt="Sarah Johnson" 
                     class="rounded-circle">
                <div class="partner-info">
                    Sarah Johnson - Partner
                </div>
            </a>

            <!-- Partner 3 -->
            <a href="#" class="carousel-img" style="--i:2;" title="Michael Chen">
                <img src="https://images.unsplash.com/photo-1556157382-97eda2f9e2bf?w=200&h=200&fit=crop" 
                     alt="Michael Chen" 
                     class="rounded-circle">
                <div class="partner-info">
                    Michael Chen - Partner
                </div>
            </a>

            <!-- Partner 4 -->
            <a href="#" class="carousel-img" style="--i:3;" title="Emily Davis">
                <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=200&h=200&fit=crop" 
                     alt="Emily Davis" 
                     class="rounded-circle">
                <div class="partner-info">
                    Emily Davis - Partner
                </div>
            </a>

            <!-- Partner 5 -->
            <a href="#" class="carousel-img" style="--i:4;" title="Robert Wilson">
                <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=200&h=200&fit=crop" 
                     alt="Robert Wilson" 
                     class="rounded-circle">
                <div class="partner-info">
                    Robert Wilson - Partner
                </div>
            </a>

            <!-- Partner 6 -->
            <a href="#" class="carousel-img" style="--i:5;" title="Lisa Anderson">
                <img src="https://images.unsplash.com/photo-1594744803329-e58b31de8bf5?w=200&h=200&fit=crop" 
                     alt="Lisa Anderson" 
                     class="rounded-circle">
                <div class="partner-info">
                    Lisa Anderson - Partner
                </div>
            </a>

            <!-- Partner 7 -->
            <a href="#" class="carousel-img" style="--i:6;" title="David Martinez">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop" 
                     alt="David Martinez" 
                     class="rounded-circle">
                <div class="partner-info">
                    David Martinez - Partner
                </div>
            </a>

            <!-- Partner 8 -->
            <a href="#" class="carousel-img" style="--i:7;" title="Jennifer Taylor">
                <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=200&h=200&fit=crop" 
                     alt="Jennifer Taylor" 
                     class="rounded-circle">
                <div class="partner-info">
                    Jennifer Taylor - Partner
                </div>
            </a>
        </div>
    </div>
</body>
</html>
@extends('layouts.app')

<style>

    /* Hero Section */
    .hero-landing {
        min-height: 100vh;
        background: linear-gradient(135deg, rgba(60, 0, 8, 0.5) 0%, rgba(60, 0, 8, 0.5) 100%),
                    url('../images/scales.jpg') center/cover;
        position: relative;
        display: flex;
        align-items: center;
        padding: 10rem 0 4rem 0;
        overflow: hidden;
    }

    /* Timeline Ribbon - NOW AT TOP */
    .timeline-ribbon {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        padding-top: 0.5rem;
        height: 130px;
        z-index: 10;
        overflow: hidden;
        pointer-events: none;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0) 100%);
        border-bottom: 1px solid rgba(212, 175, 55, 0.2);
    }

    .timeline-track {
        display: flex;
        align-items: center;
        height: 100%;
        animation: scrollTimeline 60s linear infinite;
        will-change: transform;
    }

    .letter-spacing-2 {
        letter-spacing: 2px;
    }

    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15) !important;
    }

    @keyframes scrollTimeline {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    .timeline-item {
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 3rem;
        position: relative;
        opacity: 0.3;
    }

    .timeline-portrait {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid var(--gold);
        object-fit: cover;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
        background: white;
        padding: 3px;
        filter: grayscale(30%);
        transition: all 0.3s ease;
    }

    .timeline-year {
        margin-top: 0.5rem;
        background: rgba(215, 213, 208, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid var(--light-gray);
        color: var(--white);
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1px;
        white-space: nowrap;
    }

    .hero-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
        position: relative;
        z-index: 2;
    }

    .hero-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5rem;
        align-items: center;
    }

    /* LEFT SIDE - Carousel & Heading */
    .carousel-content-section {
        animation: fadeInLeft 1s ease-out;
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Heading Above Carousel */
    .carousel-heading {
        color: white;
        text-align: start;
        margin-bottom: 1rem;
    }

    .carousel-badge {
        display: inline-block;
        background: rgba(212, 175, 55, 0.1);
        border: 1px solid var(--light-gray);
        color: var(--light-gray);
        padding: 0.4rem 1.2rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 0;
        backdrop-filter: blur(10px);
    }

    .carousel-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        font-weight: 700;
        line-height: 1.2;
        display: none;
    }
    

    /* 3D Carousel Below Heading */
    .c-partners-container {
        /* width: 600px;  */
        /* height: 600px;  */
        display: flex; 
        align-items: center; 
        justify-content: center;
        margin: 0 auto;
        position: relative;
        perspective: 1200px;
    }

    /* Founder Center Image - Independent of carousel size */
    .founder-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 0;
    }

    .founder-center .founder-img {
        width: 380px;  
        height: 380px; 
        border-radius: 50%;
        border: 5px solid white;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
        object-fit: cover;
        background: var(--light-maroon);
        padding: 5px;
    }

    .founder-center .founder-label {
        margin-top: 0.8rem;
        background: var(--light-gray);
        color: var(--maroon);
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        box-shadow: 0 4px 15px rgba(255, 255, 255, 0.6);
        display: inline-block;
        text-transform: uppercase;
    }

    /* Carousel Circle - MUST MATCH .c-partners-container size */
    #circular-carousel {
        /* width: 600px;   */
        /* height: 600px;  */
        position: relative;
        margin: auto;
        border: none;
        background: transparent;
        transform-style: preserve-3d;
        z-index: 10;
    }

    /* Carousel Images */
    #circular-carousel .carousel-img {
        position: absolute;
        left: 50%;
        top: 50%;
        transform-style: preserve-3d;
        transition: all 0.3s ease;
        text-decoration: none;
        z-index: 10;
    }


    #circular-carousel img {
        width: 125px;
        height: 125px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 5px 20px rgba(0,0,0,0.4);
        transition: all 0.3s ease;
        object-fit: cover;
    }

    #circular-carousel .carousel-img:hover img {
        transform: scale(1.2);
        border-color: var(--maroon);
        box-shadow: 0 8px 30px var(--maroon);
    }

    /* When behind founder - hide completely */
    #circular-carousel .carousel-img.behind {
        z-index: 1;
        opacity: 0;
        pointer-events: none;
    }

    .partner-info {
        position: absolute;
        bottom: -40px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--maroon);
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        white-space: nowrap;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        z-index: 20;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    .carousel-img:hover .partner-info {
        opacity: 1;
    }

    .carousel-img.behind .partner-info {
        opacity: 0 !important;
    }

    /* RIGHT SIDE - Main Content */
    .main-content-section {
        color: white;
        animation: fadeInRight 1s ease-out;
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .content-tagline {
        font-size: 1rem;
        color: var(--light-gray);
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
    }

    .content-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 2rem;
    }

    .content-description {
        font-size: 1.15rem;
        line-height: 1.8;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 3rem;
        max-width: 550px;
    }

    /* Statistics Section */
    .stats-section {
        background: linear-gradient(135deg, rgba(60, 0, 8, 0.03) 0%, rgba(134, 16, 67, 0.05) 100%);
        padding: 10px;
        border-radius: 15px;
        text-align: center;
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 10px;
        margin: 0 auto;
    }

    .stat-item {
        background: rgba(255, 255, 255, 0.95);
        padding: 10px 8px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(60, 0, 8, 0.08);
        transition: transform 0.3s ease;
        border: 1px solid rgba(134, 16, 67, 0.08);
    }

    .stat-item:hover {
        transform: translateY(-5px);
    }

    .stat-card {
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(134, 16, 67, 0.15) !important;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--maroon);
    }

    .stat-label {
        font-size: 1rem;
        color: #5a6c7d;
        font-weight: 500;
    }

    .stat-icon {
        font-size: 3rem;
        color: var(--new-maroon);
    }

    /* CTA Buttons */
    .content-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-hero {
        padding: 1rem 2.5rem;
        font-size: 1rem;
        font-weight: 600;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        letter-spacing: 0.5px;
    }

    .btn-primary {
        background: var(--light-gray);
        color: var(--maroon);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        background: var(--maroon);
        color: var(--light-gray);
        box-shadow: 0 10px 25px var(--new-maroon);
    }

    .btn-outline {
        background: transparent;
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .btn-outline:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--light-gray);
        color: var(--light-gray);
        transform: translateY(-2px);
    }

    /* Scroll Hint */
    .scroll-hint {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.85rem;
        text-align: center;
        cursor: pointer;
        animation: bounce 2s infinite;
        z-index: 3;
    }

    .scroll-hint i {
        display: block;
        font-size: 1.5rem;
        margin-bottom: 0.3rem;
    }

    /* Mission & Vision Carousel Styles */
    .mission-vision-card {
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        border: 5px solid rgba(212, 175, 55, 0.3);
    }

    .mission-vision-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1) !important;
    }

    .mission-indicators {
        position: static;
        margin-bottom: 0;
    }

    .mission-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid var(--new-maroon);
        background: transparent;
        margin: 0 4px;
    }

    .mission-indicators button.active {
        background: var(--new-maroon);
    }

    .icon-wrapper {
        width: 60px;
        height: 60px;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .carousel-item.active .icon-wrapper {
        transform: scale(1.1);
    }

    .content-header {
        border-bottom: 2px solid #f8f9fa;
    }

    .vision-list li {
        border-bottom: 1px solid #f8f9fa;
    }

    .vision-list li:last-child {
        border-bottom: none;
    }

    .carousel-controls .carousel-control-prev,
    .carousel-controls .carousel-control-next {
        width: 45px;
        height: 45px;
        border: 2px solid var(--new-maroon);
        background: white;
        opacity: 1;
        transition: all 0.3s ease;
    }

    .carousel-controls .carousel-control-prev:hover,
    .carousel-controls .carousel-control-next:hover {
        background: var(--new-maroon);
    }

    .carousel-controls .carousel-control-prev:hover .carousel-control-prev-icon,
    .carousel-controls .carousel-control-next:hover .carousel-control-next-icon {
        filter: invert(1);
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(0.3);
    }

    .slide-indicator {
        font-size: 0.9rem;
    }

    /* Auto-slide animation enhancements */
    .carousel-item {
        transition: transform 0.8s ease-in-out;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .mission-vision-content {
            padding: 0.5rem 0;
        }
        
        .content-header {
            flex-direction: column;
            text-align: center;
            gap: 1rem !important;
        }
        
        .icon-wrapper {
            width: 50px;
            height: 50px;
        }
        
        .carousel-controls {
            flex-wrap: wrap;
        }
    }

    .features li .icon {
        width: 20px;
        height: 20px;
        line-height: 20px;
        background-color: var(--new-maroon);
        color: var(--bs-white);
    }

    .features__v2 .icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: var(--white);
        color: var(--new-maroon);
    }

    .features__v2 .content {
        background-color: rgba(var(--bs-secondary-rgb), 0.2);
    }

    .features__v2 .btn-play i {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: var(--bs-white);
        color: var(--bs-primary);
    }

    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(-10px); }
    }

    .membership-logo {
        width: 250px;
        height: 250px;
        object-fit: contain;
        background-color: #fff;
    }

    /* membership */
    .membership-section {
        padding: 3rem 0;
    }

    .logo-container {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 10px;
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        flex-shrink: 0;
        width: 200px;
    }

    .logo-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .membership-logo {
        max-width: 100%;
        max-height: 100px;
        object-fit: contain;
    }

    .carousel-track {
        display: flex;
        animation: scroll 20s linear infinite;
    }

    .carousel-container {
        overflow: hidden;
        position: relative;
        padding: 20px 0;
    }

    .carousel-container:hover .carousel-track {
        animation-play-state: paused;
    }

    .carousel-container::before,
    .carousel-container::after {
        content: '';
        position: absolute;
        top: 0;
        width: 100px;
        height: 100%;
        z-index: 2;
    }

    .carousel-container::before {
        left: 0;
        background: linear-gradient(to right, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%);
    }

    .carousel-container::after {
        right: 0;
        background: linear-gradient(to left, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%);
    }

    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .hero-grid {
            gap: 4rem;
        }
        
        .c-partners-container {
            width: 450px;
            height: 450px;
        }
        
        #circular-carousel {
            width: 450px;
            height: 450px;
        }
        
        .founder-center .founder-img {
            width: 250px;
            height: 250px;
        }
        
        #circular-carousel img {
            width: 65px;
            height: 65px;
        }
    }

    @media (max-width: 991px) {
        .hero-landing {
            padding: 8rem 0 3rem 0;
        }

        .hero-grid {
            grid-template-columns: 1fr;
            gap: 3rem;
        }
        
        .carousel-content-section {
            order: 1;
        }
        
        .main-content-section {
            order: 2;
            text-align: center;
        }
        
        .content-description {
            margin-left: auto;
            margin-right: auto;
        }
        
        .stats-grid {
            justify-content: center;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .content-buttons {
            justify-content: center;
        }
        
        .c-partners-container {
            width: 400px;
            height: 400px;
        }
        
        #circular-carousel {
            width: 400px;
            height: 400px;
        }
        
        .founder-center .founder-img {
            width: 200px;
            height: 200px;
        }
        
        .timeline-ribbon {
            height: 100px;
        }
        
        .timeline-portrait {
            width: 70px;
            height: 70px;
        }
    }

    @media (max-width: 768px) {
        .hero-landing {
            min-height: auto;
            padding: 7rem 0 3rem 0;
        }
        
        .c-partners-container {
            width: 350px;
            height: 350px;
        }
        
        #circular-carousel {
            width: 350px;
            height: 350px;
        }
        
        .founder-center .founder-img {
            width: 180px;
            height: 180px;
            border-width: 4px;
        }
        
        .founder-center .founder-label {
            font-size: 0.7rem;
            padding: 0.3rem 0.8rem;
        }
        
        #circular-carousel img {
            width: 55px;
            height: 55px;
            border-width: 2px;
        }
        
        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
        }
        
        .timeline-ribbon {
            height: 90px;
        }
        
        .timeline-portrait {
            width: 60px;
            height: 60px;
        }
        
        .timeline-item {
            margin: 0 2rem;
        }
    }

    @media (max-width: 576px) {
        .hero-landing {
            padding: 6rem 0 3rem 0;
        }

        .c-partners-container {
            width: 350px;
            height: 350px;
        }
        
        #circular-carousel {
            width: 350px;
            height: 350px;
        }
        
        .founder-center .founder-img {
            width: 190px;
            height: 190px;
        }
        
        #circular-carousel img {
            width: 50px;
            height: 50px;
        }
        
        .stats-grid {
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        .btn-hero {
            width: 100%;
            max-width: 280px;
        }
        
        .timeline-ribbon {
            height: 80px;
            padding-top: 3rem;
        }
        
        .timeline-portrait {
            width: 50px;
            height: 50px;
            border-width: 2px;
        }
        
        .timeline-year {
            font-size: 0.65rem;
            padding: 0.2rem 0.6rem;
        }
        
        .timeline-item {
            margin: 0 1.5rem;
        }
    }

    /* 2. STICKY FIND A LAWYER BUTTON */
    .find-lawyer-sticky-btn {
        position: fixed;
        bottom: 0px;
        right: 30px;
        z-index: 1000;
        background: var(--new-maroon);
        color: white;
        border: none;
        padding: 15px 50px;
        border-radius: 25px 25px 0 0;
        box-shadow: 0 10px 30px rgba(60, 0, 8, 0.4);
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .find-lawyer-sticky-btn:hover {
        background: var(--light-maroon);
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(60, 0, 8, 0.5);
    }

    .find-lawyer-sticky-btn i {
        font-size: 1.2rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Find Lawyer Popup Panel */
    .find-lawyer-panel {
        position: fixed;
        bottom: -100%;
        left: 0;
        right: 0;
        background: linear-gradient(135deg, var(--new-maroon) 0%, var(--maroon) 100%);
        padding: 30px 20px;
        z-index: 999;
        box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.3);
        transition: bottom 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        max-height: 300px;
        overflow-y: auto;
    }

    .find-lawyer-panel.active {
        bottom: 0;
    }

    .find-lawyer-panel .close-panel {
        position: absolute;
        top: 15px;
        right: 20px;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .find-lawyer-panel .close-panel:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .find-lawyer-panel h4 {
        color: white;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .find-lawyer-panel .form-control,
    .find-lawyer-panel .form-select {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid rgba(255, 255, 255, 0.2);
        color: var(--dark-gray);
    }

    .find-lawyer-panel .form-control:focus,
    .find-lawyer-panel .form-select:focus {
        background: white;
        border-color: var(--accent-gray);
        box-shadow: 0 0 0 0.2rem rgba(248, 249, 250, 0.25);
    }

    .find-lawyer-panel .btn-search {
        background: white;
        color: var(--primary-maroon);
        border: 2px solid white;
        font-weight: 600;
        padding: 10px 30px;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .find-lawyer-panel .btn-search:hover {
        background: transparent;
        color: white;
        border-color: white;
    }

/* About Section - Proper Layout */
    .about-overlap-section {
        position: relative;
        padding: 0;
        overflow: hidden;
        /* padding-bottom: 100px; */
        background: linear-gradient(135deg, #fdfbfc 0%, #f9f5f7 100%);
    }

    .about-overlap-wrapper {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .dark-content-area {
        background: linear-gradient(135deg, rgba(84, 42, 48, 0.783) 0%, rgba(60, 0, 8, 0.5) 100%);
        position: relative;
        padding: 80px 60px;
        width: 65%;
        min-height: 700px;
    }

    .dark-content-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="1" fill="rgba(248,249,250,0.05)"/></svg>');
        background-size: 30px 30px;
        opacity: 0.3;
    }

    .content-wrapper {
        position: relative;
        z-index: 2;
        max-width: 600px;
        color: white;
        text-align: justify;
    }

    .about-title{
        font-size: 3rem;
        font-weight: bold;
        text-align: start;
    }

    /* Video Container - Overlapping from Right */
    .video-container {
        position: absolute;
        right: 5%;
        top: 80px;
        width: 45%;
        max-width: 800px;
        z-index: 10;
    }

    .video-wrapper {
        position: relative;
        aspect-ratio: 16 / 10;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        border: 3px solid rgba(248, 249, 250, 0.2);
    }

    .video-wrapper video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .video-controls {
        position: absolute;
        bottom: 15px;
        right: 15px;
        z-index: 10;
    }

    .mute-btn {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .mute-btn:hover {
        background: var(--primary-maroon);
        transform: scale(1.1);
    }

    .mute-btn i {
        font-size: 1.1rem;
        color: var(--primary-maroon);
    }

    .mute-btn:hover i {
        color: white;
    }

    /* Mission/Vision Container - Below Video */
    .mission-vision {
        
    }

    .mv-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 4px;
        text-decoration: underline;
    }


    .mv-title h5 {
        margin: 0;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .mission-vision p,
    .mission-vision li {
        margin: 0;
        /* font-size: 0.85rem; */
        line-height: 1.4;
    }

    .mission-vision ul li {
        padding-left: 0;
    }


    /* Core Values - Inside Dark Area */
    .core-values-section {
        margin-top: 50px;
    }

    .core-values-section h3 {
        color: white;
        font-weight: 700;
        margin-bottom: 30px;
    }

    .value-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
    }

    .value-card:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px);
    }

    .value-card i {
        color: white;
        font-size: 2.5rem;
        margin-bottom: 15px;
    }

    .value-card h5 {
        color: white;
        font-weight: 600;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .dark-content-area {
            width: 60%;
            padding: 60px 40px;
        }

        .video-container,
        .mission-vision-container {
            width: 48%;
        }
    }

    @media (max-width: 991px) {
        .about-overlap-section {
            margin-bottom: 0;
        }

        .dark-content-area {
            width: 100%;
            padding: 60px 30px;
            min-height: auto;
        }

        .video-container {
            position: relative;
            width: 100%;
            max-width: 100%;
            right: auto;
            top: auto;
            padding: 0 30px;
            margin-top: -60px;
            margin-bottom: 30px;
        }

        .mission-vision-container {
            position: relative;
            width: 100%;
            max-width: 100%;
            right: auto;
            top: auto;
            padding: 0 30px;
            margin-bottom: 30px;
        }

        .core-values-section {
            margin-top: 30px;
        }
    }

    @media (max-width: 768px) {
        .dark-content-area {
            padding: 50px 20px;
        }

        .video-container,
        .mission-vision-container {
            padding: 0 20px;
            position: static;
            width: 100%;
            max-width: 100%;
            transform: none;
            margin-top: 30px;
        }

        .mv-card {
            padding: 20px;
        }

        .value-card {
            padding: 15px;
        }
    }

    /* ------------------------------
    AWARDS DIV - ABOUT SECTION
    --------------------------------- */
    .awards {
        position: absolute;
        right: 5%;
        top: 550px;
        width: 45%;
        max-width: 800px;
        z-index: 10;
        background: white;
        border-radius: 15px;
        padding: 5px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border: 3px solid rgba(248, 249, 250, 0.3);
    }

    .awards .row {
        margin: 0;
    }

    .awards img {
        width: 60px;
        height: 60px;
        object-fit: contain;
    }

    .awards .bg-light {
        width: 60px;
        height: 60px;
    }

    .awards .bi-trophy {
        font-size: 2rem;
    }

    .awards h5 {
        font-size: 0.9rem;
        color: var(--primary-maroon);
    }

    .awards p {
        font-size: 0.8rem;
        margin-bottom: 0.3rem;
    }

    .awards .col-md-3,
    .awards .col-6 {
        text-align: center;
        margin-bottom: 1rem;
    }

    /* Responsive for Awards */
    @media (max-width: 991px) {
        .awards {
            position: relative;
            width: 100%;
            max-width: 100%;
            right: auto;
            top: auto;
            padding: 10px 20px;
            margin: 30px 30px 30px 30px;
        }
    }

    @media (max-width: 768px) {
        .awards {
            padding: 15px 20px;
            margin: 30px 20px;
        }
    }

    

    /* INSIGHTS SECTION */
    .insights-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #faf8f9 0%, #f5f0f2 50%, #faf8f9 100%);
        overflow: visible;
    }

    .insights-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .insights-header h2 {
        font-weight: 700;
        color: var(--primary-maroon);
        font-size: 2.5rem;
        margin-bottom: 15px;
    }

    .insights-header p {
        color: var(--dark-gray);
        max-width: 600px;
        margin: 0 auto;
        font-size: 1.1rem;
    }

    .category-card {
        position: relative;
        height: 350px;
        /* border-radius: 15px; */
        overflow: hidden;
        cursor: pointer;
        transition: all 0.4s ease;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
    }

    .category-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .category-card:hover .category-card-img {
        transform: scale(1.15);
    }

    .category-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(60, 0, 8, 0.95) 0%, rgba(60, 0, 8, 0.7) 50%, transparent 100%);
        padding: 30px 25px;
        transition: all 0.4s ease;
    }

    .category-card:hover .category-overlay {
        background: linear-gradient(to top, rgba(60, 0, 8, 0.98) 0%, rgba(60, 0, 8, 0.9) 70%, rgba(60, 0, 8, 0.5) 100%);
        padding: 40px 25px;
    }

    .category-title {
        color: white;
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .category-count {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .category-count i {
        font-size: 0.8rem;
    }

    .category-description {
        color: rgba(255, 255, 255, 0.95);
        font-size: 0.95rem;
        line-height: 1.6;
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: all 0.4s ease;
    }

    .category-card:hover .category-description {
        max-height: 120px;
        opacity: 1;
        margin-top: 10px;
    }

    .category-arrow {
        position: absolute;
        bottom: 25px;
        right: 25px;
        width: 45px;
        height: 45px;
        background: white;
        color: var(--primary-maroon);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transform: translateX(60px);
        opacity: 0;
        transition: all 0.4s ease;
    }

    /* .category-card:hover .category-arrow {
        transform: translateX(0);
        opacity: 1;
    } */

    /* Edge arrows positioning */
    .insights-section .carousel-control-prev,
    .insights-section .carousel-control-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 60px;
        height: 60px;
        background: var(--maroon);
        border-radius: 50%;
        opacity: 0.9;
        z-index: 10;
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .insights-section .carousel-control-prev {
        left: 20px;
    }

    .insights-section .carousel-control-next {
        right: 20px;
    }

    /* Arrow icon styling */
    .insights-section .carousel-control-prev-icon,
    .insights-section .carousel-control-next-icon {
        background-image: none !important;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .insights-section .carousel-control-prev-icon:before,
    .insights-section .carousel-control-next-icon:before {
        font-family: "bootstrap-icons";
        font-size: 1.5rem;
        color: white;
        font-weight: bold;
        line-height: 1;
    }

    .insights-section .carousel-control-prev-icon:before {
        content: "\f12f"; 
    }

    .insights-section .carousel-control-next-icon:before {
        content: "\f138"; 
    }

    /* Hover effects */
    .insights-section .carousel-control-prev:hover,
    .insights-section .carousel-control-next:hover {
        opacity: 1;
        background: var(--new-maroon);
        transform: translateY(-50%) scale(1.1);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .insights-section .carousel-control-prev,
        .insights-section .carousel-control-next {
            width: 50px;
            height: 50px;
        }
        
        .insights-section .carousel-control-prev {
            left: 10px;
        }
        
        .insights-section .carousel-control-next {
            right: 10px;
        }
        
        .insights-section .carousel-control-prev-icon:before,
        .insights-section .carousel-control-next-icon:before {
            font-size: 1.2rem;
        }
    }


    @media (max-width: 768px) {
        .category-card {
            height: 350px;
        }

        .category-description {
            font-size: 0.85rem;
        }
    }

    /* ========================================
   OUR PEOPLE CAROUSEL SECTION STYLES
   ======================================== */
.our-people-section {
    /* padding: 100px 0; */
    background: white;
    position: relative;
    overflow: hidden;
}

/* Carousel container */
.our-people-section.carousel {
    position: relative;
}

.carousel-inner {
    overflow: visible;
    
}

.carousel-item {
    padding: 30px 0;
    height: 600px;
    /* overflow-y: auto; */
}

/* Person content layout */
.person-content {
    padding-right: 40px;
}

/* Badge */
.person-badge {
    display: inline-block;
    background: var(--maroon);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 20px;
}

/* Name */
.person-name {
    color: var(--maroon);
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    line-height: 1.2;
}

/* Main title above carousel */
.our-people-section .text-start .person-name {
    font-size: 2.8rem;
    color: #000;
    font-weight: 300;
    margin-bottom: 40px;
}

/* Person title */
.person-title {
    color: #666;
    font-size: 1.3rem;
    margin-bottom: 25px;
    font-weight: 500;
}

/* Bio */
.person-bio {
    color: #555;
    line-height: 1.7;
    margin-bottom: 25px;
    font-size: 1.1rem;
    max-width: 800px;
}

/* Expertise */
.person-expertise {
    margin-top: 30px;
}

.person-expertise h4 {
    color: var(--light-maroon);
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.expertise-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.expertise-tag {
    background: #f8f9fa;
    color: var(--maroon);
    padding: 6px 15px;
    border-radius: 15px;
    font-size: 0.9rem;
    border: 1px solid #e0e6ed;
    transition: all 0.3s ease;
}

.expertise-tag:hover {
    background: var(--maroon);
    color: white;
}

/* CTA Button */
.person-cta {
    display: inline-flex;
    align-items: center;
    background: var(--maroon);
    color: white;
    padding: 12px 25px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    margin-top: 20px;
}

.person-cta:hover {
    background: var(--light-maroon);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(60, 0, 8, 0.2);
    color: white;
}

.person-cta i {
    margin-left: 8px;
    transition: transform 0.3s ease;
}

.person-cta:hover i {
    transform: translateX(5px);
}

/* Image container */
.person-image-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.person-main-image {
    width: 100%;
    max-width: 400px;
    height: 400px;
    object-fit: contain;
    object-position: center;
    border-radius: 8px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    transition: transform 0.5s ease;
}

.carousel-item:hover .person-main-image {
    transform: scale(1.02);
}

/* Edge arrows positioning */
    .our-people-section .carousel-control-prev,
    .our-people-section .carousel-control-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 60px;
        height: 60px;
        background: var(--maroon);
        border-radius: 50%;
        opacity: 0.9;
        z-index: 10;
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .our-people-section .carousel-control-prev {
        left: 20px;
    }

    .our-people-section .carousel-control-next {
        right: 20px;
    }

    /* Arrow icon styling */
    .our-people-section .carousel-control-prev-icon,
    .our-people-section .carousel-control-next-icon {
        background-image: none !important;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .our-people-section .carousel-control-prev-icon:before,
    .our-people-section .carousel-control-next-icon:before {
        font-family: "bootstrap-icons";
        font-size: 1.5rem;
        color: white;
        font-weight: bold;
        line-height: 1;
    }

    .our-people-section .carousel-control-prev-icon:before {
        content: "\f12f"; 
    }

    .our-people-section .carousel-control-next-icon:before {
        content: "\f138"; 
    }

    /* Hover effects */
    .our-people-section .carousel-control-prev:hover,
    .our-people-section .carousel-control-next:hover {
        opacity: 1;
        background: var(--new-maroon);
        transform: translateY(-50%) scale(1.1);
    }

/* View All Button */
.btn-hero.btn-outline {
    display: inline-flex;
    align-items: center;
    padding: 12px 35px;
    border: 2px solid var(--white);
    color: var(--maroon);
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-hero.btn-outline:hover {
    background: var(--maroon);
    border: none;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(60, 0, 8, 0.2);
}

/* Carousel indicators (optional - if you want to add them) */
.carousel-indicators {
    position: absolute;
    bottom: -50px;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    gap: 12px;
    margin: 0;
}

.carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #ddd;
    border: none;
    opacity: 1;
    transition: all 0.3s ease;
    padding: 0;
}

.carousel-indicators button.active {
    background: var(--maroon);
    transform: scale(1.3);
}

/* Auto slide animation */
.carousel.slide {
    transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .person-name {
        font-size: 2.2rem;
    }
    
    .our-people-section .text-start .person-name {
        font-size: 2.5rem;
    }
    
    .person-main-image {
        max-width: 350px;
        height: 350px;
    }
}

@media (max-width: 992px) {
    .our-people-section {
        padding: 80px 0;
    }
    
    .person-content {
        padding-right: 0;
        margin-bottom: 40px;
        text-align: center;
    }
    
    .person-name {
        font-size: 2rem;
    }
    
    .our-people-section .text-start .person-name {
        font-size: 2.2rem;
        text-align: center;
    }
    
    .person-bio {
        max-width: 100%;
    }
    
    .expertise-tags {
        justify-content: center;
    }
    
    .person-main-image {
        max-width: 300px;
        height: 300px;
        margin: 0 auto;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
    }
    
    .carousel-control-prev {
        left: 10px;
    }
    
    .carousel-control-next {
        right: 10px;
    }
}

@media (max-width: 768px) {
    .person-name {
        font-size: 1.8rem;
    }
    
    .our-people-section .text-start .person-name {
        font-size: 2rem;
    }
    
    .person-title {
        font-size: 1.1rem;
    }
    
    .person-bio {
        font-size: 1rem;
    }
    
    .person-main-image {
        max-width: 250px;
        height: 250px;
    }
    
    .btn-hero.btn-outline {
        margin-top: 20px;
    }
}

@media (max-width: 576px) {
    .our-people-section {
        padding: 60px 0;
    }
    
    .person-name {
        font-size: 1.6rem;
    }
    
    .our-people-section .text-start .person-name {
        font-size: 1.8rem;
    }
    
    .person-badge {
        font-size: 0.9rem;
        padding: 8px 20px;
    }
    
    .person-cta {
        width: 100%;
        justify-content: center;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        width: 40px;
        height: 40px;
    }
    
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 20px;
        height: 20px;
        background-size: 20px 20px;
    }
}
   


/* ========================================
   EXPERTISE SECTION STYLES
   ======================================== */

    .expertise-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #faf8f9 0%, #f5f0f2 50%, #faf8f9 100%);
    }

    .expertise-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .expertise-header h2 {
        font-weight: 700;
        color: var(--primary-maroon);
        font-size: 2.5rem;
        margin-bottom: 15px;
    }

    .expertise-header p {
        color: var(--dark-gray);
        max-width: 600px;
        margin: 0 auto;
        font-size: 1.1rem;
    }

    .expertise-card {
        position: relative;
        height: 450px;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .expertise-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
    }

    .expertise-card-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--new-maroon) 0%, var(--maroon) 100%);
        transition: transform 0.4s ease;
    }

    .expertise-card:hover .expertise-card-bg {
        transform: scale(1.1);
    }

    .expertise-card-content {
        position: relative;
        height: 100%;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        z-index: 2;
        color: white;
    }

    .expertise-icon {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 1.5rem;
        transition: all 0.4s ease;
    }

    .expertise-card:hover .expertise-icon {
        background: white;
        color: var(--maroon);
        transform: scale(1.1);
    }

    .expertise-card h3 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: white;
    }

    .expertise-card-description {
        font-size: 1rem;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 1.5rem;
    }

    .expertise-stats {
        display: flex;
        gap: 2rem;
        margin-bottom: 1.5rem;
    }

    .expertise-stat {
        display: flex;
        flex-direction: column;
    }

    .expertise-stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: white;
    }

    .expertise-stat-label {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.8);
    }

    .expertise-arrow {
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: all 0.4s ease;
        align-self: flex-start;
    }

    .expertise-card:hover .expertise-arrow {
        background: white;
        color: var(--maroon);
        transform: translateX(5px);
    }

    /* ========================================
    RESPONSIVE STYLES
    ======================================== */

    @media (max-width: 991px) {
        .people-slide.active {
            flex-direction: column;
            gap: 2rem;
        }

        .person-image-container {
            flex: 0 0 auto;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .person-content {
            text-align: center;
        }

        .person-name {
            font-size: 2.5rem;
        }

        .person-bio {
            margin-left: auto;
            margin-right: auto;
        }

        .expertise-tags {
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .person-name {
            font-size: 2rem;
        }

        .expertise-card {
            height: 400px;
        }

        .expertise-card-content {
            padding: 30px;
        }
    }

</style>

@section('content')
    <section class="hero-landing">
        <!-- Timeline Ribbon - NOW AT TOP -->
        <div class="timeline-ribbon">
            <div class="timeline-track" id="timelineTrack">
                <!-- Timeline items will be generated via JavaScript -->
            </div>
        </div>

        <div class="hero-container">
            <div class="hero-grid">
                <!-- LEFT SIDE - Heading + 3D Carousel -->
                <div class="carousel-content-section">
                    

                    <!-- 3D Carousel -->
                    <div class="c-partners-container">
                        <!-- Founder Center -->
                        <div class="founder-center">
                            <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" 
                                alt="Sir Thomas Scanlen" 
                                class="founder-img">
                            <div class="founder-label">Current Partners</div>
                        </div>

                        <!-- 3D Carousel -->
                        <div id="circular-carousel">
                            @if(isset($partners) && $partners->count() > 0)
                                @foreach($partners as $index => $partner)
                                    <a href="{{ route('our-people.partner', $partner->slug) }}" 
                                    class="carousel-img" 
                                    title="{{ $partner->name }}">
                                        <img src="{{ $partner->avatar ? asset('storage/' . $partner->avatar) : asset('images/default-avatar.png') }}" 
                                            alt="{{ $partner->name }}">
                                        <div class="partner-info">
                                            {{ $partner->name }}
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <!-- Fallback -->
                                <a href="#" class="carousel-img">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Partner">
                                    <div class="partner-info">Current Partner</div>
                                </a>
                                <a href="#" class="carousel-img">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Partner">
                                    <div class="partner-info">Current Partner</div>
                                </a>
                                <a href="#" class="carousel-img">
                                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Partner">
                                    <div class="partner-info">Current Partner</div>
                                </a>
                                <a href="#" class="carousel-img">
                                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Partner">
                                    <div class="partner-info">Current Partner</div>
                                </a>
                                <a href="#" class="carousel-img">
                                    <img src="https://randomuser.me/api/portraits/men/86.jpg" alt="Partner">
                                    <div class="partner-info">Current Partner</div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE - Main Content -->
                <div class="main-content-section">
                    <!-- Heading Above Carousel -->
                    <div class="carousel-heading">
                        <div class="carousel-badge">Since 1894</div>
                    </div>
                    <div class="content-tagline">Heritage • Excellence • Trust</div>
                    
                    <h1 class="content-title">
                        Building On<br>
                        A Legacy Of Trust
                    </h1>

                    <p class="content-description">
                        For over a century, we've been delivering exceptional legal counsel 
                        to clients who demand excellence. Our heritage of distinguished service 
                        continues with today's leading attorneys.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="content-buttons">
                        <a href="{{route('contactUs')}}" class="btn-hero btn-primary">Schedule Consultation</a>
                        <a href="{{route('expertise.index')}}" class="btn-hero btn-outline">Learn More</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Hint -->
        <div class="scroll-hint" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
            <i class="fas fa-chevron-down"></i>
            <span>Scroll</span>
        </div>
    </section>

    <button class="find-lawyer-sticky-btn" id="findLawyerBtn">
        <i class="bi bi-arrow-down-left-circle-fill"></i>
        Find A Lawyer
        <i class="bi bi-arrow-up-right-circle-fill"></i>
    </button>

    <!-- Find Lawyer Panel (Hidden by default) -->
    <div class="find-lawyer-panel" id="findLawyerPanel">
        <button class="close-panel" id="closePanelBtn">
            <i class="bi bi-x-lg"></i>
        </button>
        
        <div class="container">
            <h4 class="text-center mb-4">Find The Right Lawyer For You</h4>
            <form action="{{ route('our-people.find-lawyer') }}" method="GET">
                <div class="row g-3 justify-content-center align-items-center">
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Search By Name" value="{{ request('name') }}">
                    </div>
                    <div class="col-md-1 text-center d-none d-md-block">
                        <span class="text-white fw-bold">OR</span>
                    </div>
                    <div class="col-md-3">
                        <select name="expertise" class="form-select">
                            <option value="">Select Expertise</option>
                            @if(isset($allExpertise))
                                @foreach($allExpertise as $expertise)
                                    <option value="{{ $expertise->id }}">{{ $expertise->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="category" class="form-select">
                            <option value="">Select Category</option>
                            @if(isset($sectors))
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-search w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. UPDATED ABOUT SECTION WITH MISSION/VISION CAROUSEL -->
    <section class="about-overlap-section border border-secondary-subtle" id="about" style="background: linear-gradient(135deg, #fff 0%, #dec6d4 50%);">
        <div class="about-overlap-wrapper">
            <!-- Dark Content Area -->
            <div class="dark-content-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="content-wrapper">
                                <span class="badge-est border border-danger-subtle rounded-5 py-2 px-3">EST. 1894</span>
                                <h2 class="about-title mt-2">About Scanlen & Holderness</h2>
                                <p class="about-subtitle mt-2">Legal Excellence Since 1894</p>
                                
                                <p class="about-text">
                                    Scanlen & Holderness is a premier Zimbabwean law firm offering you a full circle of legal services 
                                    whether you are a local, regional or international client.
                                </p>
                                
                                <p class="about-text">
                                    Throughout history Team Scanlen has proudly influenced jurisprudential development in Zimbabwe. 
                                    Our continued involvement in landmark cases sets precedent in many areas of law.
                                </p>
                                
                                <!-- Key Features -->
                                <div class="key-features">
                                    <div class="feature-item">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>Premier Legal Services</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>Top Rankings</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>Landmark Cases</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>Global Recognition</span>
                                    </div>
                                </div>

                                <div class="mission-vision mt-2">
                                    <div class="mv-title">
                                        {{-- <i class="bi bi-bullseye"></i> --}}
                                        <h5>Our Mission</h5>
                                    </div>
                                    <p>
                                        To continue to be the leading firm at all times offering the finest legal services
                                        timeously and efficiently in a friendly atmosphere.
                                    </p>
                                </div>

                                <div class="mission-vision mt-2">
                                    <div class="mv-title">
                                        {{-- <i class="bi bi-eye"></i> --}}
                                        <h5>Our Vision</h5>
                                    </div>
                                    <ul class="list-unstyled mb-0">
                                        <li><i class="bi bi-check-round-fill"></i>
                                            One stop firm for all corporate legal matters
                                        </li>
                                        <li><i class="bi bi-check-round-fill"></i>
                                            Clear choice with excellence and global recognition
                                        </li>
                                    </ul>
                                </div>


                                
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-4">
                        <h3 class="text-center fw-bold mb-4 text-white">Our Core Values</h3>
                        <div class="row g-4 justify-content-center">
                            <div class="col-6 col-md-3">
                                <div class="text-center p-2 bg-light rounded-3 h-100">
                                    <i class="bi bi-shield-check text-maroon fs-1 mb-3"></i>
                                    <h5 class="fw-bold">Integrity</h5>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="text-center p-2 bg-light rounded-3 h-100">
                                    <i class="bi bi-gem text-maroon fs-1 mb-3"></i>
                                    <h5 class="fw-bold">Excellence</h5>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="text-center p-2 bg-light rounded-3 h-100">
                                    <i class="bi bi-people text-maroon fs-1 mb-3"></i>
                                    <h5 class="fw-bold">Respect</h5>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="text-center p-2 bg-light rounded-3 h-100">
                                    <i class="bi bi-lightbulb text-maroon fs-1 mb-3"></i>
                                    <h5 class="fw-bold">Innovation</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Container -->
            <div class="video-container">
                <div class="video-wrapper">
                    <video id="aboutVideo" autoplay muted loop playsinline>
                        <source src="{{asset('videos/lex.mp4')}}" type="video/mp4">
                    </video>
                    <div class="video-controls">
                        <button class="mute-btn" id="muteToggle">
                            <i class="bi bi-volume-mute" id="muteIcon"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="awards">
                @if($awards->count() > 0)
                    <div class="text-center">
                        <span class="badge bg-maroon text-white">RECOGNITION</span>
                        {{-- <h2 class="display-6 fw-bold mb-3">Awards & Achievements</h2> --}}
                    </div>
                    <div class="row justify-content-between">
                        @foreach($awards as $award)
                        <div class="col-6 col-md-3">
                            @if($award->image_url)
                                <img src="{{ $award->image_url }}" alt="{{ $award->title }}" 
                                    class="img-fluid rounded-circle mb-2">
                            @else
                                <div class="bg-light rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" 
                                    style="width: 60px; height: 60px;">
                                    <i class="bi bi-trophy text-maroon"></i>
                                </div>
                            @endif
                            <h5 class="fw-bold mb-1">{{ $award->title }}</h5>
                            <p class="small text-muted mb-0">{{ $award->issuing_organization }}</p>
                            <p class="small text-maroon fw-semibold">{{ $award->year }}</p>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-3">
                        <div class="bg-light rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-trophy text-muted fs-1"></i>
                        </div>
                        <p class="text-muted mb-0">Our achievements will be showcased here soon.</p>
                    </div>
                @endif
            </div>

            
        </div>
    </section>

    {{-- FIND A LAWYER SECTION - Updated Background --}}
    <section class="find-lawyer text-center" style="background: linear-gradient(135deg, #fff 0%, #dec6d4 50%);">
        <div class="p-5 rounded" >
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
                        <select name="category" class="form-select">
                            <option value="">CATEGORIES</option>
                            @if(isset($sectors))
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}" {{ request('category') == $sector->id ? 'selected' : '' }}>
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

            <a href="{{route('our-people.find-lawyer')}}" class="btn btn-outline-danger mt-5">View All <i class="bi bi-arrow-up-right-circle-fill ms-2"></i></a>
        </div>
    </section>

    <!-- 3. INSIGHTS BY CATEGORY SECTION (Bowmans Style) -->
    <section class="insights-section position-relative" style="background: linear-gradient(135deg, #fff 0%, #dec6d4 50%);">
        <div class="container">
            <div class="insights-header">
                <h2>Insights By Practice Area</h2>
                <p>Explore our latest legal insights, articles, and commentary organized by practice area</p>
            </div>

            <div id="insightsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($categories->chunk(4) as $chunk)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="row g-4">
                            @foreach($chunk as $category)
                            <div class="col-md-6 col-lg-6">
                                <a href="{{ route('articles.category', $category->slug) }}" class="text-decoration-none">
                                    <div class="category-card">
                                        <img src="{{ $category->avatar ? asset('storage/' . $category->avatar) : asset('images/law.jpg') }}" 
                                            alt="{{ $category->name }}" 
                                            class="category-card-img">
                                        
                                        <div class="category-overlay">
                                            <h3 class="category-title">{{ $category->name }}</h3>
                                            <p class="category-count">{{ $category->articles_count }} Articles</p>
                                            <p class="category-description">
                                                {{ Str::limit($category->description ?? 'Explore our insights and expertise in ' . $category->name, 100) }}
                                            </p>
                                            <div class="category-arrow">
                                                <i class="bi bi-arrow-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('articles.index') }}" class="btn btn-maroon-outline btn-lg">
                    View All Insights
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        
        <!-- Move arrows outside container but inside section -->
        <button class="carousel-control-prev" type="button" data-bs-target="#insightsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#insightsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </section>

    <!-- OUR PEOPLE CAROUSEL SECTION -->
    <section id="peopleCarousel" class="our-people-section carousel slide bg-danger-subtle" data-bs-ride="carousel">
        <!-- Add indicators (optional) -->
        <div class="carousel-inner">
            @if(isset($featuredPeople) && $featuredPeople->count() > 0)
                @foreach($featuredPeople as $index => $person)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="container">
                            <div class="text-start mb-5">
                                <h2 class="person-name mb-0">MEET OUR TEAM</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="person-content">
                                        <span class="person-badge">{{ $person->employeeType->name ?? 'Partner' }}</span>
                                        <h3 class="person-name">{{ $person->name }}</h3>
                                        <p class="person-title">{{ $person->title ?? 'Senior Attorney' }}</p>
                                        
                                        <p class="person-bio">
                                            {{ Str::limit($person->bio ?? 'Experienced legal professional with a proven track record in delivering exceptional results for clients across various practice areas.', 200) }}
                                        </p>

                                        @if(isset($person->expertise) && $person->expertise->count() > 0)
                                            <div class="person-expertise">
                                                <h4>Areas of Expertise</h4>
                                                <div class="expertise-tags">
                                                    @foreach($person->expertise->take(4) as $exp)
                                                        <span class="expertise-tag">{{ $exp->name }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <a href="{{ route('our-people.partner', $person->slug) }}" class="person-cta">
                                            View Full Profile
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="person-image-container">
                                        <img src="{{ $person->avatar ? asset('storage/' . $person->avatar) : asset('images/law.jpg') }}" 
                                            alt="{{ $person->name }}" 
                                            class="person-main-image img-fluid">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="text-center mt-5">
                                <a href="{{ route('our-people.find-lawyer') }}" class="btn-hero btn-outline">
                                    View All Attorneys
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback content if no people data -->
                <div class="carousel-item active">
                    <div class="container">
                        <div class="text-start mb-5">
                            <h2 class="person-name mb-0">Meet Our Legal Experts</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="person-content">
                                    <span class="person-badge">Partner</span>
                                    <h3 class="person-name">Our Legal Team</h3>
                                    <p class="person-title">Experienced Legal Professionals</p>
                                    <p class="person-bio">
                                        Our team of dedicated attorneys brings decades of combined experience 
                                        in delivering exceptional legal services to clients across Zimbabwe and beyond.
                                    </p>
                                    <a href="{{ route('our-people.find-lawyer') }}" class="person-cta">
                                        Meet Our Team
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="person-image-container">
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="Attorney" class="person-main-image img-fluid">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="text-center mt-5">
                            <a href="{{ route('our-people.find-lawyer') }}" class="btn-hero btn-outline">
                                View All Attorneys
                                <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>
            @endif
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#peopleCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#peopleCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </section>


    <!-- EXPERTISE SECTION -->
    <section class="expertise-section" style="background: linear-gradient(135deg, #dec6d4 0%, #fff 50%); display:none;">
        <div class="container">
            <div class="expertise-header">
                <h2>Our Areas of Expertise</h2>
                <p>Comprehensive legal solutions across multiple practice areas</p>
            </div>

            <div class="row g-4 mb-5">
                @if(isset($featuredExpertise) && $featuredExpertise->count() > 0)
                    @foreach($featuredExpertise->take(3) as $expertise)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('expertise.show', $expertise->slug) }}" class="text-decoration-none">
                                <div class="expertise-card">
                                    <div class="expertise-card-bg"></div>
                                    <div class="expertise-card-content">
                                        <div>
                                            <div class="expertise-icon">
                                                <i class="bi bi-{{ $expertise->icon ?? 'briefcase' }}"></i>
                                            </div>
                                            <h3>{{ $expertise->name }}</h3>
                                            <p class="expertise-card-description">
                                                {{ Str::limit($expertise->description ?? 'Comprehensive legal services in ' . $expertise->name, 120) }}
                                            </p>
                                            @if(isset($expertise->lawyers_count))
                                                <div class="expertise-stats">
                                                    <div class="expertise-stat">
                                                        <span class="expertise-stat-number">{{ $expertise->lawyers_count }}</span>
                                                        <span class="expertise-stat-label">Specialists</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="expertise-arrow">
                                            <i class="bi bi-arrow-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback expertise cards -->
                    <div class="col-lg-4 col-md-6">
                        <div class="expertise-card">
                            <div class="expertise-card-bg"></div>
                            <div class="expertise-card-content">
                                <div>
                                    <div class="expertise-icon">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <h3>Corporate Law</h3>
                                    <p class="expertise-card-description">
                                        Comprehensive corporate legal services including mergers, acquisitions, and compliance.
                                    </p>
                                </div>
                                <div class="expertise-arrow">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="expertise-card">
                            <div class="expertise-card-bg"></div>
                            <div class="expertise-card-content">
                                <div>
                                    <div class="expertise-icon">
                                        <i class="bi bi-shield-check"></i>
                                    </div>
                                    <h3>Litigation</h3>
                                    <p class="expertise-card-description">
                                        Expert representation in commercial disputes and complex litigation matters.
                                    </p>
                                </div>
                                <div class="expertise-arrow">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="expertise-card">
                            <div class="expertise-card-bg"></div>
                            <div class="expertise-card-content">
                                <div>
                                    <div class="expertise-icon">
                                        <i class="bi bi-bank"></i>
                                    </div>
                                    <h3>Banking & Finance</h3>
                                    <p class="expertise-card-description">
                                        Specialized advice on financial transactions, regulatory compliance, and banking law.
                                    </p>
                                </div>
                                <div class="expertise-arrow">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="text-center">
                <a href="{{ route('expertise.index') }}" class="btn btn-maroon-outline btn-lg">
                    View All Practice Areas
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    
    


    


     {{-- PROFESSIONAL MEMBERSHIP - Updated Background --}} 
    <section class="membership-section p-5 border-top" style="background: linear-gradient(135deg, #fff 0%, #dec6d4 50%);">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="section-title mb-2 text-uppercase text-center">Professional Memberships</h2>
                    <p class="section-description mb-5 text-center">Our clients are our top priority, and we are committed to providing them with the highest level of service.</p>
                    <hr class="divider mb-5 mb-xl-9">
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="carousel-container">
                <div class="carousel-track">
                    <!-- Original Logos -->
                    <div class="logo-container">
                        <a href="https://chambers.com/" target="_blank" class="text-decoration-none">
                            <img src="{{asset('images/champers.jpg')}}" class="membership-logo" alt="Champers">
                        </a>
                    </div>
                    <div class="logo-container">
                        <a href="https://lexafrica.com/" target="_blank" class="text-decoration-none">
                            <img src="{{asset('images/lexafrica.png')}}" class="membership-logo" alt="Lex Africa">
                        </a>
                    </div>
                    <div class="logo-container">
                        <a href="https://www.meritas.org/" target="_blank" class="text-decoration-none">
                            <img src="{{asset('images/meritas_logo.png')}}" class="membership-logo" alt="Maritas">
                        </a>
                    </div>
                    
                    <!-- Duplicate Logos for Seamless Loop -->
                    <div class="logo-container">
                        <a href="https://chambers.com/" target="_blank" class="text-decoration-none">
                            <img src="{{asset('images/champers.jpg')}}" class="membership-logo" alt="Champers">
                        </a>
                    </div>
                    <div class="logo-container">
                        <a href="https://lexafrica.com/" target="_blank" class="text-decoration-none">
                            <img src="{{asset('images/lexafrica.png')}}" class="membership-logo" alt="Lex Africa">
                        </a>
                    </div>
                    <div class="logo-container">
                        <a href="https://www.meritas.org/" target="_blank" class="text-decoration-none">
                            <img src="{{asset('images/meritas_logo.png')}}" class="membership-logo" alt="Maritas">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ===== TIMELINE RIBBON =====
            const timelineTrack = document.getElementById('timelineTrack');
            
            // Historical partners data with years
            const historicalPartners = [
                { image: '{{ asset("images/oldpartners/scanlen.jpeg") }}', year: '1894' },
                { image: '{{ asset("images/oldpartners/op1.jpeg") }}', year: '1902' },
                { image: '{{ asset("images/oldpartners/op2.jpeg") }}', year: '1915' },
                { image: '{{ asset("images/oldpartners/op3.jpeg") }}', year: '1928' },
                { image: '{{ asset("images/oldpartners/op4.jpeg") }}', year: '1935' },
                { image: '{{ asset("images/oldpartners/op5.jpeg") }}', year: '1947' },
                { image: '{{ asset("images/oldpartners/op6.jpeg") }}', year: '1956' },
                { image: '{{ asset("images/oldpartners/op7.jpeg") }}', year: '1968' },
                { image: '{{ asset("images/oldpartners/op8.jpeg") }}', year: '1979' },
            ];
            
            function createTimelineItem(partner) {
                return `
                    <div class="timeline-item">
                        <img src="${partner.image}" alt="Partner ${partner.year}" class="timeline-portrait">
                        <div class="timeline-year">${partner.year}</div>
                    </div>
                `;
            }
            
            // Create timeline items (duplicate for seamless loop)
            let timelineHTML = '';
            historicalPartners.forEach(partner => {
                timelineHTML += createTimelineItem(partner);
            });
            // Duplicate for seamless infinite scroll
            historicalPartners.forEach(partner => {
                timelineHTML += createTimelineItem(partner);
            });
            
            timelineTrack.innerHTML = timelineHTML;
            
            // ===== 3D CAROUSEL =====
            const carousel = document.getElementById('circular-carousel');
            if (!carousel) return;
            
            const images = carousel.querySelectorAll('.carousel-img');
            const total = images.length;
            
            if (total === 0) return;
            
            let radius = 180;
            let angle = 0;
            let animationId;
            const rotationSpeed = 0.25;

            function getResponsiveValues() {
                const width = window.innerWidth;
                
                if (width <= 576) {
                    radius = 115;
                } else if (width <= 768) {
                    radius = 135;
                } else if (width <= 991) {
                    radius = 155;
                } else if (width <= 1200) {
                    radius = 170;
                } else {
                    radius = 180;
                }
            }

            function positionImages() {
                const angleStep = (2 * Math.PI) / total;
                
                for (let i = 0; i < total; i++) {
                    const currentAngle = (angle * Math.PI / 180) + (angleStep * i);
                    const x = Math.sin(currentAngle) * radius;
                    const z = Math.cos(currentAngle) * radius;
                    const scale = (z + radius) / (radius * 2) * 0.4 + 0.6;
                    
                    images[i].style.transform = `
                        translate(-50%, -50%)
                        translateX(${x}px)
                        translateZ(${z}px)
                        scale(${scale})
                    `;
                    
                    if (z < 0) {
                        images[i].classList.add('behind');
                        images[i].style.zIndex = 1;
                    } else {
                        images[i].classList.remove('behind');
                        images[i].style.zIndex = 10;
                    }
                }
            }

            function animate() {
                angle += rotationSpeed;
                if (angle >= 360) angle = 0;
                positionImages();
                animationId = requestAnimationFrame(animate);
            }

            function initialize() {
                getResponsiveValues();
                positionImages();
            }

            initialize();
            animate();
            
            carousel.addEventListener('mouseenter', () => cancelAnimationFrame(animationId));
            carousel.addEventListener('mouseleave', () => animationId = requestAnimationFrame(animate));
            
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    cancelAnimationFrame(animationId);
                    initialize();
                    animationId = requestAnimationFrame(animate);
                }, 250);
            });

            // Animate statistics on scroll
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const number = entry.target.querySelector('.stat-number');
                        const finalValue = parseInt(number.textContent);
                        const suffix = number.textContent.replace(/[0-9]/g, '');
                        
                        let current = 0;
                        const increment = finalValue / 50;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= finalValue) {
                                number.textContent = finalValue + suffix;
                                clearInterval(timer);
                            } else {
                                number.textContent = Math.floor(current) + suffix;
                            }
                        }, 30);
                    }
                });
            }, { threshold: 0.5 });

            document.querySelectorAll('.stat-item').forEach(stat => {
                statsObserver.observe(stat);
            });

            // Sticky Find Lawyer Button
            const findLawyerBtn = document.getElementById('findLawyerBtn');
            const findLawyerPanel = document.getElementById('findLawyerPanel');
            const closePanelBtn = document.getElementById('closePanelBtn');

            findLawyerBtn.addEventListener('click', function() {
                findLawyerPanel.classList.add('active');
                findLawyerBtn.style.display = 'none';
            });

            closePanelBtn.addEventListener('click', function() {
                findLawyerPanel.classList.remove('active');
                setTimeout(() => {
                    findLawyerBtn.style.display = 'flex';
                }, 300);
            });

            // Mission/Vision Carousel
            let currentSlide = 1;
            const indicators = document.querySelectorAll('.mv-indicator');
            const slides = {
                1: document.getElementById('mvSlide1'),
                2: document.getElementById('mvSlide2')
            };

            function showSlide(slideNum) {
                // Hide all slides
                Object.values(slides).forEach(slide => slide.style.display = 'none');
                // Show current slide
                slides[slideNum].style.display = 'block';
                
                // Update indicators
                indicators.forEach((ind, index) => {
                    ind.classList.toggle('active', index + 1 === slideNum);
                });
            }

            // Auto-rotate carousel
            setInterval(() => {
                currentSlide = currentSlide === 1 ? 2 : 1;
                showSlide(currentSlide);
            }, 5000);

            // Manual navigation
            indicators.forEach(indicator => {
                indicator.addEventListener('click', function() {
                    currentSlide = parseInt(this.dataset.slide);
                    showSlide(currentSlide);
                });
            });


            // ABOUT PAGE
            const video = document.getElementById('aboutVideo');
            const muteToggle = document.getElementById('muteToggle');
            const muteIcon = document.getElementById('muteIcon');
            
            if (video && muteToggle && muteIcon) {
                muteToggle.addEventListener('click', function() {
                    if (video.muted) {
                        video.muted = false;
                        muteIcon.classList.remove('bi-volume-mute');
                        muteIcon.classList.add('bi-volume-up');
                        muteToggle.title = 'Click to mute';
                    } else {
                        video.muted = true;
                        muteIcon.classList.remove('bi-volume-up');
                        muteIcon.classList.add('bi-volume-mute');
                        muteToggle.title = 'Click to unmute';
                    }
                });
            }


            
        });
    </script>
@endsection
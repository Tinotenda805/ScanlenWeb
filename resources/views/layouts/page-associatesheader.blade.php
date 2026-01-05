<header class="header bg-breadcrumb" id="heroHeader">
    <div class="header-content">
        <h1>{{ $title ?? 'Title' }}</h1>
    </div>
</header>

<style>
/*** Hero Section ***/
.bg-breadcrumb {
    background-color: rgba(128, 1, 49, 0.737);
    position: relative;
    min-height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 140px 0 60px 0;
}

/* Desktop: All 9 images layered */
@media (min-width: 768px) {
    .bg-breadcrumb {
        background:
            /* Center Image */
            url("{{ asset('images/gavel3.png') }}") center/290px no-repeat,
            
            /* Left Side Images */
            url("{{ asset('images/associates/in.png') }}") 76% 60%/140px no-repeat,
            url("{{ asset('images/associates/mvm.jpg') }}") 12% 35%/140px no-repeat,
            url("{{ asset('images/associates/km.jpg') }}") 24% 60%/140px no-repeat,
            url("{{ asset('images/associates/fs.jpg') }}") 1% 10%/140px no-repeat,
            
            /* Right Side Images */
            url("{{ asset('images/associates/tk.png') }}") 35% 80%/140px no-repeat,
            url("{{ asset('images/associates/tpw.jpeg') }}") 65% 80%/140px no-repeat,
            url("{{ asset('images/associates/ppm.png') }}") 88% 35%/140px no-repeat,
            url("{{ asset('images/associates/oc.png') }}") 99% 10%/140px no-repeat;
        background-color: rgba(128, 1, 49, 0.737);
        background-blend-mode: multiply;
        min-height: auto;
    }
}

/* Mobile: Only center image */
@media (max-width: 767px) {
    .bg-breadcrumb {
        background:
            /* rgba(128, 1, 50, 0.578), */
            url("{{ asset('images/justice.png') }}") center/280px no-repeat;
        background-color: rgba(58, 1, 23, 0.636);
        background-blend-mode: multiply;
        padding: 120px 0 60px 0;
        display: block;
        text-align: center;
        min-height: 400px; /* Increased height to ensure content is below image */
    }
}

.header {
    color: white;
    position: relative;
}

/* Mobile: Ensure content is below the image */
@media (max-width: 767px) {
    .header-content {
        position: relative;
        margin-top: 280px; /* Push content below the center image */
        padding: 20px 15px;
        /* background-color: rgba(128, 1, 50, 0.8); */
        border-radius: 10px;
        margin-left: 15px;
        margin-right: 15px;
        text-align: center;
    }
    
    /* Adjust header spacing for mobile */
    .header {
        padding-bottom: 40px;
    }
}

/* Desktop: Normal positioning */
@media (min-width: 768px) {
    .header-content {
        position: relative;
        z-index: 2;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
        margin-top: 100px;
        text-align: center;
    }
}

.header h1 {
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    font-weight: 300;
    letter-spacing: 3px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    margin: 0;
}

/* Mobile font size adjustments */
@media (max-width: 767px) {
    .header h1 {
        font-size: 1.8rem;
        letter-spacing: 2px;
        line-height: 1.4;
    }
}

/* Spinner while loading - desktop only */
@media (min-width: 768px) {
    .header::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 40px;
        height: 40px;
        margin: -20px 0 0 -20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top: 3px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        z-index: 1;
    }
    
    .header.loaded::before {
        opacity: 0;
    }
    
    /* Animation for desktop only */
    .header.loaded .header-content {
        opacity: 1;
        transform: translateY(0);
    }
    
    .header-content {
        opacity: 0;
        transform: translateY(30px);
    }
}

/* Mobile: Show content immediately without animation */
@media (max-width: 767px) {
    .header-content {
        opacity: 1 !important;
        transform: translateY(0) !important;
    }
    
    .header::before {
        display: none; /* Hide spinner on mobile */
    }
}

/* Optional: Add a subtle mobile animation */
@media (max-width: 767px) {
    .header.loaded .header-content {
        animation: fadeInUpMobile 0.6s ease-out;
    }
    
    @keyframes fadeInUpMobile {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('heroHeader');
    const isMobile = window.innerWidth < 768;

    // Load appropriate images based on screen size
    const imageUrls = isMobile 
        ? ["{{ asset('images/gavel3.png') }}"] // Only center image for mobile
        : [
            // All images for desktop
            "{{ asset('images/gavel3.png') }}",
            "{{ asset('images/associates/in.png') }}",
            "{{ asset('images/associates/mvm.jpg') }}",
            "{{ asset('images/associates/km.jpg') }}",
            "{{ asset('images/associates/fs.jpg') }}",
            "{{ asset('images/associates/tk.png') }}",
            "{{ asset('images/associates/tpw.jpeg') }}",
            "{{ asset('images/associates/ppm.png') }}",
            "{{ asset('images/associates/oc.png') }}"
        ];

    let loaded = 0;
    const total = imageUrls.length;

    function imageLoaded() {
        loaded++;
        if (loaded === total) {
            header.classList.add('loaded');
        }
    }

    // Preload images
    imageUrls.forEach(url => {
        const img = new Image();
        img.onload = imageLoaded;
        img.onerror = imageLoaded;
        img.src = url;
    });

    // Safety timeout
    setTimeout(() => {
        if (!header.classList.contains('loaded')) {
            header.classList.add('loaded');
        }
    }, 3000);
    
    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Force a re-render on resize
            header.classList.remove('loaded');
            setTimeout(() => {
                header.classList.add('loaded');
            }, 100);
        }, 250);
    });
});
</script>
<header class="header bg-breadcrumb" id="heroHeader">
    <div class="header-content text-center">
        <h1>{{ $title ?? 'Title Goes Here' }}</h1>
    </div>
</header>

<style>
/*** Hero Section ***/
.bg-breadcrumb {
    background-color: rgba(128, 1, 50, 0.578);
    position: relative;
    min-height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 140px 0 60px 0;
}

.header-content h1{
    font-weight: bold;
}

/* Desktop: All 9 images layered */
@media (min-width: 768px) {
    .bg-breadcrumb {
        background:
            /* Center Image */
            url("{{ asset('images/newpartners/br.png') }}") center/280px no-repeat,
            
            /* Left Side Images */
            url("{{ asset('images/newpartners/bm.png') }}") 12% 35%/140px no-repeat,
            url("{{ asset('images/newpartners/gg.png') }}") 33% 80%/140px no-repeat,
            url("{{ asset('images/newpartners/rmb.jpg') }}") 1% 10%/140px no-repeat,
            url("{{ asset('images/newpartners/pm.png') }}") 22% 60%/140px no-repeat,
            
            /* Right Side Images */
            url("{{ asset('images/newpartners/ftm.png') }}") 100% 10%/140px no-repeat,
            url("{{ asset('images/newpartners/ar.png') }}") 89% 35%/140px no-repeat,
            url("{{ asset('images/newpartners/nt.jpg') }}") 67% 80%/140px no-repeat,
            url("{{ asset('images/newpartners/r.png') }}") 78% 60%/140px no-repeat;
        background-color: rgba(71, 71, 71, 0.58);
        background-blend-mode: multiply;
        min-height: auto;
    }
}

/* Mobile: Only center image */
@media (max-width: 767px) {
    .bg-breadcrumb {
        background:
            url("{{ asset('images/newpartners/br.png') }}") center/280px no-repeat;
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
        margin-top: 280px; 
        padding: 10px 15px;
        /* background-color: rgba(128, 1, 50, 0.8); */
        border-radius: 10px;
        margin-left: 15px;
        margin-right: 15px;
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
        /* opacity: 0; */
        transform: translateY(30px);
        transition: all 0.8s ease-out;
        margin-top: 100px;
    }
}

.header-content h1 {
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    font-weight: 300;
    letter-spacing: 3px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    margin: 0;
}

/* Mobile font size adjustments */
@media (max-width: 767px) {
    .header-content h1 {
        font-size: 1.8rem;
        letter-spacing: 2px;
        line-height: 1.4;
    }
}

/* Animation for desktop only */
@media (min-width: 768px) {
    .header.loaded .header-content {
        opacity: 1;
        transform: translateY(0);
    }
    
    .header-content {
        /* opacity: 0; */
        transform: translateY(30px);
    }
}

/* Mobile: Show content immediately without animation */
@media (max-width: 767px) {
    .header-content {
        opacity: 1 !important;
        transform: translateY(0) !important;
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('heroHeader');
    const isMobile = window.innerWidth < 768;

    // For mobile, we only need to load the center image
    const imageUrls = isMobile 
        ? ["{{ asset('images/newpartners/br.png') }}"]
        : [
            "{{ asset('images/newpartners/br.png') }}",
            "{{ asset('images/newpartners/bm.png') }}",
            "{{ asset('images/newpartners/ftm.png') }}",
            "{{ asset('images/newpartners/gg.png') }}",
            "{{ asset('images/newpartners/pm.png') }}",
            "{{ asset('images/newpartners/rmb.jpg') }}",
            "{{ asset('images/newpartners/r.png') }}",
            "{{ asset('images/newpartners/nt.jpg') }}",
            "{{ asset('images/newpartners/ar.png') }}",
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
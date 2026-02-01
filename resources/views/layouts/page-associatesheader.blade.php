<header class="header bg-breadcrumb" id="heroHeader">
    <div class="header-content">
        <h1>{{ $title ?? 'Title' }}</h1>
    </div>
</header>

<style>
/* =============================
   Hero Section - Mobile First
============================= */
.bg-breadcrumb {
    background:
        linear-gradient(rgba(58, 1, 23, 0.636), rgba(58, 1, 23, 0.636)),
        url("{{ asset('images/justice-potrait.jpg') }}") center / cover no-repeat;
    background-color: rgba(58,1,23,0.636);
    min-height: 400px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 140px 0 140px 0;
    text-align: center;
}

.header {
    color: white;
    position: relative;
}

.header-content {
    margin: 0;
    transform: none;
}

.header-content h1 {
    font-size: 1.8rem;
    font-weight: 400;
    letter-spacing: 2px;
    line-height: 1.4;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    margin: 0;
    /* color: #000; */
}

/* Optional subtle mobile animation */
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

/* =============================
   Tablet / Mid-size screens
   (768px - 992px)
============================= */
@media (min-width: 768px) and (max-width: 1199px) {
    .bg-breadcrumb {
        justify-content: center;
        align-items: center; 
        background:
            url("{{ asset('images/justice.png') }}") center 90%/160px no-repeat,
            url("{{ asset('images/associates/km.jpg') }}") 1% 10%/140px no-repeat,
            url("{{ asset('images/associates/tk.png') }}") 25% 70%/140px no-repeat,
            url("{{ asset('images/associates/tpw.jpeg') }}") 75% 70%/140px no-repeat,
            url("{{ asset('images/associates/in.png') }}") 99% 10%/140px no-repeat;
        background-color: rgba(71, 71, 71, 0.58);
        background-blend-mode: multiply;
        min-height: auto;
        padding: 140px 0 140px 0;
    }

    .header-content {
        margin: 60px; 
        transform: none;
    }

    .header-content h1 {
        font-size: clamp(1.8rem, 2.5vw, 2.2rem);
        letter-spacing: 2.5px;
        /* color: #000; */
    }
}

/* =============================
   Desktop
   (≥ 993px)
============================= */
@media (min-width: 1200px) {
    .bg-breadcrumb {
        justify-content: center;
        align-items: center;
        background:
            url("{{ asset('images/associates/chishaka.jpeg') }}") 0.2% 10%/140px no-repeat,
            url("{{ asset('images/associates/fs.jpg') }}") 11% 30%/140px no-repeat,
            url("{{ asset('images/associates/mvm.jpg') }}") 22% 50%/140px no-repeat,
            url("{{ asset('images/associates/km.jpg') }}") 33% 70%/140px no-repeat,
            url("{{ asset('images/associates/tk.png') }}") 44% 90%/140px no-repeat,
            url("{{ asset('images/associates/tpw.jpeg') }}") 55% 90%/140px no-repeat,
            url("{{ asset('images/associates/in.png') }}") 66% 70%/140px no-repeat,
            url("{{ asset('images/associates/ppm.png') }}") 77% 50%/140px no-repeat,
            url("{{ asset('images/associates/oc.png') }}") 88% 30%/140px no-repeat,
            url("{{ asset('images/associates/tanya.jpeg') }}") 99% 10%/140px no-repeat;
        background-color: rgba(71, 71, 71, 0.58);
        background-blend-mode: multiply;
        min-height: auto;
        padding: 140px 0 140px 0;
    }

    .header-content {
        margin: 40px;
        transform: none;
    }

    .header-content h1 {
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        letter-spacing: 3px;
        color: #000;
    }
}

/* =============================
   Keyframes
============================= */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes fadeInUpMobile {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
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
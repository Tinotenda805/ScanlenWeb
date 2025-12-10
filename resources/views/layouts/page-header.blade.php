<header class="header bg-breadcrumb" id="heroHeader">
    <!-- Background pattern images (still in CSS) -->
    
    <!-- Center image as HTML element -->
    <div class="center-founder-frame">
        <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" 
             alt="Founder" 
             class="founder-portrait"
             loading="lazy">
        <div class="gold-frame"></div>
    </div>
    
    <!-- Header content -->
    <div class="header-content">
        <h1>{{$title ?? 'Scanlen & Holderness'}}</h1>
    </div>
</header>

<style>
/*** Single Page Hero Header Start ***/
.bg-breadcrumb {
    position: relative;
    overflow: hidden;
    background-color: rgba(128, 1, 50, 0.578);
    padding: 140px 0 60px 0;
    transition: all 0.8s ease-in-out;
    opacity: 0.7;
    min-height: 380px;
}

/* Remove scanlen from background CSS */
/* Desktop: Multiple background images */
@media (min-width: 768px) {
    .bg-breadcrumb {
        background: 
            url("{{ asset('images/oldpartners/op1.jpeg') }}") 16% 40% / 185px 170px no-repeat,
            url("{{ asset('images/oldpartners/op2.jpeg') }}") 99% 10% / 185px 170px no-repeat,
            url("{{ asset('images/oldpartners/op3.jpeg') }}") 31% 80% / 185px 170px no-repeat,
            url("{{ asset('images/oldpartners/op4.jpeg') }}") 69% 80% / 185px 170px no-repeat,
            url("{{ asset('images/oldpartners/op6.jpeg') }}") 84% 40% / 185px 170px no-repeat,
            url("{{ asset('images/oldpartners/op5.jpeg') }}") 1% 10% / 185px 170px no-repeat;
        background-color: rgba(128, 1, 50, 0.578);
        background-blend-mode: multiply;
    }
}

/* Mobile: No background images except color */
@media (max-width: 567px) {
    .bg-breadcrumb {
        background: none;
        background-color: rgba(128, 1, 50, 0.578);
    }
}

/* Center founder image container */
.center-founder-frame {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 310px;
    height: 350px;
    z-index: 2;
    opacity: 0;
    transition: opacity 0.8s ease;
}

.header.loaded .center-founder-frame {
    opacity: 1;
}

/* The actual portrait image */
.founder-portrait {
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* border-radius: 4px; */
    display: block;
    position: relative;
    z-index: 1;
    opacity: 0.6;
}

/* Gold frame overlay */
.gold-frame {
    position: absolute;
    top: -10px;
    left: -10px;
    right: -10px;
    bottom: -10px;
    border: 8px solid #D4AF37;
    /* border-radius: 8px; */
    z-index: 2;
    pointer-events: none;
    /* box-shadow: 
        0 0 25px rgba(212, 175, 55, 0.8),
        inset 0 0 25px rgba(212, 175, 55, 0.4),
        0 0 50px rgba(0, 0, 0, 0.3); */
}

/* Optional: Add corner decorations */
.gold-frame::before,
.gold-frame::after {
    content: '';
    position: absolute;
    width: 30px;
    height: 30px;
    border: 2px solid #D4AF37;
    z-index: 3;
}

.gold-frame::before {
    top: -5px;
    left: -5px;
    border-right: none;
    border-bottom: none;
}

.gold-frame::after {
    bottom: -5px;
    right: -5px;
    border-left: none;
    border-top: none;
}

/* Header Section */
.header {
    color: white;
    padding: 100px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

/* Header content - on top of everything */
.header-content {
    position: relative;
    z-index: 10; /* Higher than center image */
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s ease-out;
}

/* Content animation when loaded */
.header.loaded .header-content {
    opacity: 1;
    transform: translateY(0);
}

.header h1 {
    font-size: 4rem;
    margin-bottom: 20px;
    font-weight: 300;
    letter-spacing: 3px;
    text-shadow: 
        2px 2px 8px rgba(0,0,0,0.9),
        0 0 30px rgba(0,0,0,0.7);
    position: relative;
    z-index: 11;
}

/* Add a subtle vignette effect to improve text readability */
.header::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(
        ellipse at center,
        transparent 30%,
        rgba(128, 1, 50, 0.4) 100%
    );
    z-index: 1;
    pointer-events: none;
}

/* Responsive adjustments for center image */
@media (max-width: 992px) {
    .center-founder-frame {
        width: 280px;
        height: 320px;
    }
}

@media (max-width: 768px) {
    .center-founder-frame {
        width: 250px;
        height: 280px;
    }
    
    .header h1 {
        font-size: 3rem;
    }
}

@media (max-width: 567px) {
    .center-founder-frame {
        width: 220px;
        height: 220px;
        border-radius: 50%; /* Optional: Make it circular on mobile */
    }
    
    .founder-portrait {
        border-radius: 50%;
    }
    
    .gold-frame {
        border-radius: 50%;
        top: -8px;
        left: -8px;
        right: -8px;
        bottom: -8px;
    }
    
    /* Hide corner decorations on mobile if circular */
    .gold-frame::before,
    .gold-frame::after {
        display: none;
    }
    
    .header h1 {
        font-size: 2.2rem;
    }
}

/* Loading spinner (keep your existing) */
.header::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 40px;
    height: 40px;
    margin: -20px 0 0 -20px;
    border: 3px solid rgba(255,255,255,0.3);
    border-top: 3px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    z-index: 5;
    opacity: 1;
    transition: opacity 0.3s ease;
}

.header.loaded::before {
    opacity: 0;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
/*** Single Page Hero Header End ***/
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('heroHeader');
    const founderImage = document.querySelector('.founder-portrait');
    
    // Check screen size
    const isMobile = window.innerWidth < 768;
    
    // Background image URLs only
    const bgImageUrls = isMobile 
        ? []  // No background images on mobile
        : [
            "{{ asset('images/oldpartners/op1.jpeg') }}",
            "{{ asset('images/oldpartners/op2.jpeg') }}",
            "{{ asset('images/oldpartners/op3.jpeg') }}",
            "{{ asset('images/oldpartners/op4.jpeg') }}",
            "{{ asset('images/oldpartners/op5.jpeg') }}",
            "{{ asset('images/oldpartners/op6.jpeg') }}"
        ];
    
    let loadedImages = 0;
    const totalImages = bgImageUrls.length + 1; // +1 for founder image
    
    function imageLoaded() {
        loadedImages++;
        console.log(`Image loaded: ${loadedImages}/${totalImages}`);
        
        if (loadedImages === totalImages) {
            setTimeout(() => {
                header.classList.add('loaded');
                console.log('All images loaded, showing content');
            }, 200);
        }
    }
    
    // Preload founder image
    founderImage.onload = imageLoaded;
    founderImage.onerror = imageLoaded;
    
    // Preload background images
    bgImageUrls.forEach(url => {
        const img = new Image();
        img.onload = imageLoaded;
        img.onerror = imageLoaded;
        img.src = url;
    });
    
    // If no background images (mobile), check if founder image already loaded
    if (founderImage.complete && bgImageUrls.length === 0) {
        imageLoaded();
    }
    
    // Fallback timeout
    setTimeout(() => {
        if (!header.classList.contains('loaded')) {
            console.log('Fallback: Showing content after timeout');
            header.classList.add('loaded');
        }
    }, 3000);
    
    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const nowMobile = window.innerWidth < 768;
            if (nowMobile !== isMobile) {
                location.reload();
            }
        }, 250);
    });
});
</script>
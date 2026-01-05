<header class="header bg-breadcrumb" id="heroHeader">
    <!-- Background pattern overlay -->
    <div class="pattern-overlay"></div>
    
    <!-- Center founder image -->
    <div class="center-founder-frame">
        <img src="{{ asset('images/oldpartners/scanlen.jpeg') }}" 
             alt="Founder" 
             class="founder-portrait"
             loading="eager">
        <div class="gold-frame"></div>
    </div>
    
    <!-- Header content -->
    <div class="header-content">
        <h1>{{$title ?? 'Scanlen & Holderness'}}</h1>
    </div>
</header>

<style>
/*** Responsive Page Header ***/
:root {
    --maroon: #861043;
    --dark-maroon: #3c0008;
    --gold: #D4AF37;
}

.bg-breadcrumb {
    position: relative;
    overflow: hidden;
    background: 
        url("{{ asset('images/oldpartners/op1.jpeg') }}") 16% 40%/160px no-repeat,
        url("{{ asset('images/oldpartners/op2.jpeg') }}") 32% 80%/160px no-repeat,
        url("{{ asset('images/oldpartners/op3.jpeg') }}") 1% 10%/160px no-repeat,

        url("{{ asset('images/oldpartners/op4.jpeg') }}") 99% 10%/160px no-repeat,
        url("{{ asset('images/oldpartners/op5.jpeg') }}") 84% 40%/160px no-repeat,
        url("{{ asset('images/oldpartners/op6.jpeg') }}") 68% 80%/160px no-repeat;
    background-color: rgba(128, 1, 50, 0.692);
    background-blend-mode: multiply;
    padding: 140px 0 80px 0;
    min-height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Pattern overlay for texture */
.pattern-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        repeating-linear-gradient(
            45deg,
            transparent,
            transparent 10px,
            rgba(255, 255, 255, 0.02) 10px,
            rgba(255, 255, 255, 0.02) 20px
        );
    z-index: 1;
    pointer-events: none;
}

/* Desktop: Background portrait images */
@media (min-width: 768px) {
    .bg-breadcrumb::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.15;
        z-index: 1;
    }
}

/* Center founder frame */
.center-founder-frame {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 280px;
    height: 320px;
    z-index: 3;
    opacity: 0;
    transition: opacity 0.8s ease, transform 0.8s ease;
}

.center-founder-frame img{
    opacity: 0.8;
}

.header.loaded .center-founder-frame {
    opacity: 1;
}

/* Founder portrait */
.founder-portrait {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    position: relative;
    z-index: 1;
    filter: grayscale(20%);
    border-radius: 8px;
}

/* Gold frame */
.gold-frame {
    position: absolute;
    top: -12px;
    left: -12px;
    right: -12px;
    bottom: -12px;
    border: 6px solid var(--gold);
    border-radius: 12px;
    z-index: 2;
    pointer-events: none;
    box-shadow: 
        0 0 30px rgba(212, 175, 55, 0.4),
        inset 0 0 20px rgba(212, 175, 55, 0.1);
}

/* Corner decorations */
.gold-frame::before,
.gold-frame::after {
    content: '';
    position: absolute;
    width: 40px;
    height: 40px;
    border: 3px solid var(--gold);
    z-index: 3;
}

.gold-frame::before {
    top: -8px;
    left: -8px;
    border-right: none;
    border-bottom: none;
    border-radius: 4px 0 0 0;
}

.gold-frame::after {
    bottom: -8px;
    right: -8px;
    border-left: none;
    border-top: none;
    border-radius: 0 0 4px 0;
}

/* Header content - Desktop centered */
.header-content {
    position: relative;
    z-index: 10;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    text-align: center;
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s ease-out 0.3s;
}

.header.loaded .header-content {
    opacity: 1;
    transform: translateY(0);
}

.header-content h1 {
    font-size: 3.5rem;
    font-weight: 300;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: white;
    margin: 0;
    text-shadow: 
        3px 3px 12px rgba(0,0,0,0.8),
        0 0 40px rgba(0,0,0,0.6);
    font-family: 'Playfair Display', Georgia, serif;
}

/* Vignette effect */
.bg-breadcrumb::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(
        ellipse at center,
        transparent 40%,
        rgba(60, 0, 8, 0.5) 100%
    );
    z-index: 2;
    pointer-events: none;
}

/* Loading spinner */
.bg-breadcrumb::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 50px;
    height: 50px;
    margin: -25px 0 0 -25px;
    border: 4px solid rgba(212, 175, 55, 0.2);
    border-top: 4px solid var(--gold);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    z-index: 11;
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

/* ===== TABLET RESPONSIVE ===== */
@media (max-width: 992px) {
    .bg-breadcrumb {
        min-height: 400px;
        padding: 120px 0 70px 0;
    }

    .center-founder-frame {
        width: 240px;
        height: 280px;
    }

    .header-content h1 {
        font-size: 3rem;
        letter-spacing: 3px;
    }
}

/* ===== MOBILE RESPONSIVE ===== */
@media (max-width: 768px) {
    .bg-breadcrumb {
        min-height: 400px;
        padding: 100px 20px 40px 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: none;
    }

    /* Hide background patterns on mobile */
    .bg-breadcrumb::before {
        display: none;
    }

    /* Center founder - make it circular on mobile */
    .center-founder-frame {
        position: relative;
        top: auto;
        left: auto;
        transform: none;
        width: 200px;
        height: 200px;
        /* border-radius: 50%; */
        margin: 0 auto 30px auto;
        opacity: 1; /* Show immediately on mobile */
    }

    .founder-portrait {
        border-radius: 50%;
    }

    .gold-frame {
        border-radius: 50%;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        border-width: 5px;
    }

    /* Hide corner decorations */
    .gold-frame::before,
    .gold-frame::after {
        /* display: none; */
    }

    /* Title on bottom left */
    .header-content {
        position: relative;
        text-align: left;
        padding: 0 20px;
        margin: 0;
        transform: translateY(0);
        opacity: 1; /* Show immediately on mobile */
    }

    .header-content h1 {
        font-size: 2rem;
        letter-spacing: 2px;
        text-align: left;
        line-height: 1.2;
    }

    /* Adjust vignette for mobile */
    .bg-breadcrumb::after {
        background-color: rgba(174, 97, 126, 0.692);
        /* background-blend-mode: multiply; */
    }
}

/* ===== SMALL MOBILE ===== */
@media (max-width: 480px) {
    .bg-breadcrumb {
        min-height: 350px;
        padding: 80px 15px 30px 15px;
    }

    .center-founder-frame {
        width: 200px;
        height: 200px;
        margin-bottom: 25px;
    }

    .gold-frame {
        border-width: 4px;
        top: -8px;
        left: -8px;
        right: -8px;
        bottom: -8px;
    }

    .header-content {
        padding: 0 15px;
    }

    .header-content h1 {
        font-size: 1.6rem;
        letter-spacing: 1.5px;
    }
}

/* Smooth page load */
.header {
    opacity: 0;
    animation: fadeIn 0.5s ease-out forwards;
}

@keyframes fadeIn {
    to { opacity: 1; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('heroHeader');
    const founderImage = document.querySelector('.founder-portrait');
    
    // For mobile, show immediately
    if (window.innerWidth < 768) {
        header.classList.add('loaded');
        return;
    }
    
    // Desktop: Wait for images to load
    const bgImageUrls = [
        "{{ asset('images/oldpartners/op1.jpeg') }}",
        "{{ asset('images/oldpartners/op2.jpeg') }}",
        "{{ asset('images/oldpartners/op3.jpeg') }}",
        "{{ asset('images/oldpartners/op4.jpeg') }}",
        "{{ asset('images/oldpartners/op5.jpeg') }}",
        "{{ asset('images/oldpartners/op6.jpeg') }}"
    ];
    
    let loadedImages = 0;
    const totalImages = bgImageUrls.length + 1;
    
    function imageLoaded() {
        loadedImages++;
        if (loadedImages === totalImages) {
            setTimeout(() => {
                header.classList.add('loaded');
            }, 200);
        }
    }
    
    // Preload founder image
    if (founderImage.complete) {
        imageLoaded();
    } else {
        founderImage.onload = imageLoaded;
        founderImage.onerror = imageLoaded;
    }
    
    // Preload background images
    bgImageUrls.forEach(url => {
        const img = new Image();
        img.onload = imageLoaded;
        img.onerror = imageLoaded;
        img.src = url;
    });
    
    // Fallback timeout
    setTimeout(() => {
        if (!header.classList.contains('loaded')) {
            header.classList.add('loaded');
        }
    }, 3000);
});
</script>
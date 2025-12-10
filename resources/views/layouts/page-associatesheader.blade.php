<header class="header bg-breadcrumb" id="heroHeader">
    <div class="header-content">
        <h1>{{ $title ?? 'Title' }}</h1>
    </div>
</header>

<style>
/*** Hero Section ***/
.bg-breadcrumb {
    background:
        /* linear-gradient(135deg, #848484 0%, #848484 100%), */
        /* Center Image */
        url("{{ asset('images/gavel3.png') }}") center/300px no-repeat,

        /* Left Side Images */
        url("{{ asset('images/associates/in.png') }}") 76% 60%/140px no-repeat,
        url("{{ asset('images/associates/mvm.jpg') }}") 12% 35%/150px no-repeat,
        url("{{ asset('images/associates/km.jpg') }}") 24% 60%/140px no-repeat,
        url("{{ asset('images/associates/fs.jpg') }}") 1% 10%/160px no-repeat,
        
        /* Right Side Images */
        url("{{ asset('images/associates/tk.png') }}") 35% 80%/140px no-repeat,
        url("{{ asset('images/associates/tpw.jpeg') }}") 65% 80%/140px no-repeat,
        url("{{ asset('images/associates/ppm.png') }}") 88% 35%/160px no-repeat,
        url("{{ asset('images/associates/oc.png') }}") 99% 10%/140px no-repeat;
    background-color: rgba(128, 1, 50, 0.578);
    background-blend-mode: multiply;
    padding: 140px 0 60px 0;
}

/* Desktop: All 9 images layered */
@media (min-width: 768px) {
    .bg-breadcrumb {
        background:
            /* linear-gradient(135deg, #848484 0%, #848484 100%), */
            /* Center Image */
            url("{{ asset('images/gavel3.png') }}") center/300px no-repeat,

            /* Left Side Images */
            url("{{ asset('images/associates/in.png') }}") 76% 60%/140px no-repeat,
            url("{{ asset('images/associates/mvm.jpg') }}") 12% 35%/150px no-repeat,
            url("{{ asset('images/associates/km.jpg') }}") 24% 60%/140px no-repeat,
            url("{{ asset('images/associates/fs.jpg') }}") 1% 10%/160px no-repeat,
            
            /* Right Side Images */
            url("{{ asset('images/associates/tk.png') }}") 35% 80%/140px no-repeat,
            url("{{ asset('images/associates/tpw.jpeg') }}") 65% 80%/140px no-repeat,
            url("{{ asset('images/associates/ppm.png') }}") 88% 35%/160px no-repeat,
            url("{{ asset('images/associates/oc.png') }}") 99% 10%/140px no-repeat;
        background-color: rgba(128, 1, 49, 0.737);
        background-blend-mode: multiply;
        padding: 140px 0 60px 0;
    }
}

/* Mobile: Only 1 image */
@media (max-width: 767px) {
    .bg-breadcrumb {
        background:
            linear-gradient(135deg, #848484 0%, #848484 100%),
            url("{{ asset('images/gavel3.png') }}") center/220px no-repeat;
        background-blend-mode: multiply;
        padding: 120px 0 60px 0;
    }
}

.header {
    color: white;
    text-align: center;
    position: relative;
}

.header-content {
    position: relative;
    z-index: 2;
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s ease-out;
}

.header.loaded .header-content {
    opacity: 1;
    transform: translateY(0);
}

/* Spinner while loading */
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

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.header h1 {
    font-size: 4rem;
    font-weight: 300;
    letter-spacing: 3px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

@media (max-width: 768px) {
    .header h1 { font-size: 2.5rem; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('heroHeader');
    const isMobile = window.innerWidth < 768;

    const imageUrls = isMobile 
        ? ["{{ asset('images/newpartners/br.png') }}"]
        : [
            "{{ asset('images/newpartners/br.png') }}",
            "{{ asset('images/newpartners/bm.png') }}",
            "{{ asset('images/newpartners/ftm.png') }}",
            "{{ asset('images/newpartners/gg.png') }}",
            "{{ asset('images/newpartners/pm.png') }}",
            "{{ asset('images/newpartners/rmb.jpg') }}",
            "{{ asset('images/newpartners/rp.png') }}",
            "{{ asset('images/newpartners/nt.jpg') }}",
            "{{ asset('images/newpartners/r.png') }}",
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
});
</script>

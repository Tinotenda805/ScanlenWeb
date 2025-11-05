<header class="header bg-breadcrumb" id="heroHeader">
    <div class="header-content">
        <h1>{{ $title ?? 'Title Goes Here' }}</h1>
    </div>
</header>

<style>
/*** Hero Section ***/
.bg-breadcrumb {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #848484 0%, #848484 100%);
    transition: all 0.8s ease-in-out;
    opacity: 0.8;
}

/* Desktop: All 9 images layered */
@media (min-width: 768px) {
    .bg-breadcrumb {
        background:
            linear-gradient(135deg, #848484 0%, #848484 100%),
            /* Center Image */
            url("{{ asset('images/newpartners/br.png') }}") center/280px 330px no-repeat,

            /* Left Side Images */
            url("{{ asset('images/newpartners/bm.png') }}") 12% 35%/160px 200px no-repeat,
            url("{{ asset('images/newpartners/gg.png') }}") 33% 80%/140px 180px no-repeat,
            url("{{ asset('images/newpartners/rmb.jpg') }}") 1% 10%/140px 180px no-repeat,
            url("{{ asset('images/newpartners/pm.png') }}") 22% 60%/150px 180px no-repeat,

            /* Right Side Images */
            url("{{ asset('images/newpartners/ftm.png') }}") 100% 10%/140px 180px no-repeat,
            url("{{ asset('images/newpartners/ar.png') }}") 89% 35%/160px 200px no-repeat,
            url("{{ asset('images/newpartners/nt.jpg') }}") 67% 80%/140px 180px no-repeat,
            url("{{ asset('images/newpartners/r.png') }}") 78% 60%/150px 180px no-repeat;

        background-blend-mode: multiply;
        padding: 140px 0 60px 0;
    }
}

/* Mobile: Only 1 image */
@media (max-width: 767px) {
    .bg-breadcrumb {
        background:
            linear-gradient(135deg, #848484 0%, #848484 100%),
            url("{{ asset('images/newpartners/br.png') }}") center/220px 220px no-repeat;
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

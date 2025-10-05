
<header class="header bg-breadcrumb" id="heroHeader">
    <div class="header-content">
        <h1>{{$title ?? 'Title Goes Here'}}</h1>
        {{-- <p class="subtitle">{{$subtitle ?? 'Subtitle Goes Here'}}</p> --}}
        {{-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-white">Home</a></li>
                <li class="breadcrumb-item active text-white">{{ $breadcrumb ?? 'Page' }}</li>
            </ol>
        </nav> --}}
    </div>
</header>

<style>
/*** Single Page Hero Header Start ***/
.bg-breadcrumb {
    position: relative;
    overflow: hidden;
    /* Initially show a solid background or loading state */
    background: linear-gradient(135deg, #848484 0%, #848484 100%);
    transition: all 0.8s ease-in-out;
    opacity: 0.7; /* Start slightly faded */
}

/* This class will be added when all images are loaded */
.bg-breadcrumb {
    position: relative;
    overflow: hidden;
    background: 
        linear-gradient(135deg, #848484 0%, #848484 100%), /* strong dark overlay */
        url("{{ asset('images/oldpartners/scanlen.jpeg') }}") center/300px 350px no-repeat,
        url("{{ asset('images/oldpartners/op1.jpeg') }}") 15% 40%/180px 220px no-repeat,
        url("{{ asset('images/oldpartners/op2.jpeg') }}") 95% 20%/200px 240px no-repeat,
        url("{{ asset('images/oldpartners/op3.jpeg') }}") 30% 80%/190px 230px no-repeat,
        url("{{ asset('images/oldpartners/op4.jpeg') }}") 70% 75%/170px 210px no-repeat,
        url("{{ asset('images/oldpartners/op5.jpeg') }}") 1% 10%/160px 200px no-repeat,
        url("../img/carousel-1.jpg") center/cover no-repeat; /* keep main bg */
    background-blend-mode: multiply; /* blends images with gradient */
    transition: 0.5s;
}

@media (min-width: 992px) {
    .bg-breadcrumb {
        padding: 140px 0 60px 0;
    }
}

@media (max-width: 991px) {
    .bg-breadcrumb {
        padding: 60px 0 60px 0;
    }
}

.bg-breadcrumb .breadcrumb {
    position: relative;
}

.bg-breadcrumb .breadcrumb .breadcrumb-item a {
    color: white;
}

/* Header Section */
.header {
    color: white;
    padding: 100px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

/* Loading spinner */
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
    z-index: 1;
    opacity: 1;
    transition: opacity 0.3s ease;
}

/* Hide spinner when loaded */
.header.loaded::before {
    opacity: 0;
}

/* Animated background effect when loaded */
.header.loaded::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(52, 0, 25, 0.1) 0%, transparent 70%);
    animation: rotate 20s linear infinite;
    z-index: 1;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes rotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.header-content {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
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
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.header .subtitle {
    font-size: 1.4rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
    font-weight: 300;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .header h1 {
        font-size: 2.5rem;
        letter-spacing: 2px;
    }
    
    .header .subtitle {
        font-size: 1.2rem;
    }
}

/*** Single Page Hero Header End ***/
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('heroHeader');
    
    // Array of image URLs - replace with your actual image paths
    const imageUrls = [
        "{{ asset('images/oldpartners/scanlen.jpeg') }}",
        "{{ asset('images/oldpartners/op1.jpeg') }}",
        "{{ asset('images/oldpartners/op2.jpeg') }}",
        "{{ asset('images/oldpartners/op3.jpeg') }}",
        "{{ asset('images/oldpartners/op4.jpeg') }}",
        "{{ asset('images/oldpartners/op5.jpeg') }}",
    ];
    
    // Preload images
    let loadedImages = 0;
    const totalImages = imageUrls.length;
    
    function imageLoaded() {
        loadedImages++;
        if (loadedImages === totalImages) {
            // All images loaded, apply the loaded state
            setTimeout(() => {
                header.classList.add('loaded');
            }, 100); // Small delay for smoother transition
        }
    }
    
    // Preload each image
    imageUrls.forEach(url => {
        const img = new Image();
        img.onload = imageLoaded;
        img.onerror = imageLoaded; 
        img.src = url;
    });
    
    setTimeout(() => {
        if (!header.classList.contains('loaded')) {
            header.classList.add('loaded');
        }
    }, 5000);
});
</script>






{{-- /*** Single Page Hero Header Start ***/
.bg-breadcrumb {
    position: relative;
    overflow: hidden;
    background: 
        linear-gradient(135deg, #848484 0%, #848484 100%), /* strong dark overlay */
        url("{{ asset('images/oldpartners/scanlen.jpeg') }}") center/300px 350px no-repeat,
        url("{{ asset('images/oldpartners/op1.jpeg') }}") 15% 40%/180px 220px no-repeat,
        url("{{ asset('images/oldpartners/op2.jpeg') }}") 95% 20%/200px 240px no-repeat,
        url("{{ asset('images/oldpartners/op3.jpeg') }}") 30% 80%/190px 230px no-repeat,
        url("{{ asset('images/oldpartners/op4.jpeg') }}") 70% 75%/170px 210px no-repeat,
        url("{{ asset('images/oldpartners/op5.jpeg') }}") 1% 10%/160px 200px no-repeat,
        url("../img/carousel-1.jpg") center/cover no-repeat; /* keep main bg */
    background-blend-mode: multiply; /* blends images with gradient */
    transition: 0.5s;
} --}}
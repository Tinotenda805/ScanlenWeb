
<header class="header bg-breadcrumb" id="heroHeader">
    <div class="header-content">
        <h1>{{$title ?? 'Scanlen & Holderness'}}</h1>
        {{-- <h1>{{$subtitle ?? '-'}}</h1> --}}
        
    </div>
</header>

<style>
    /*** Single Page Hero Header Start ***/
    .bg-breadcrumb {
        position: relative;
        overflow: hidden;
        /* Initially show a solid background or loading state */
        background: 
            /* linear-gradient(135deg, #fff 0%, #dec6d4 50%), */
            url("{{ asset('images/oldpartners/scanlen.jpeg') }}") center/300px 350px no-repeat,
            url("{{ asset('images/oldpartners/op1.jpeg') }}") 16% 40% / 185px 170px no-repeat,
            url("{{ asset('images/oldpartners/op2.jpeg') }}") 99% 10% / 185px 170px no-repeat,
            url("{{ asset('images/oldpartners/op3.jpeg') }}") 31% 80% / 185px 170px no-repeat,
            url("{{ asset('images/oldpartners/op4.jpeg') }}") 69% 80% / 185px 170px no-repeat,
            url("{{ asset('images/oldpartners/op6.jpeg') }}") 84% 40% / 185px 170px no-repeat,
            url("{{ asset('images/oldpartners/op5.jpeg') }}") 1% 10% / 185px 170px no-repeat;
        background-color: rgba(128, 1, 50, 0.578);
        background-blend-mode: multiply;
        padding: 140px 0 60px 0;
        transition: all 0.8s ease-in-out;
        opacity: 0.7; /* Start slightly faded */
    }

    /* This class will be added when all images are loaded */
    /* Desktop: Multiple background images */
    @media (min-width: 768px) {
        .bg-breadcrumb {
            background: 
               /* linear-gradient(135deg, #fff 0%, #cf94b6 50%), */
                url("{{ asset('images/oldpartners/scanlen.jpeg') }}") center/300px 350px no-repeat,
                url("{{ asset('images/oldpartners/op1.jpeg') }}") 16% 40% / 185px 170px no-repeat,
                url("{{ asset('images/oldpartners/op2.jpeg') }}") 99% 10% / 185px 170px no-repeat,
                url("{{ asset('images/oldpartners/op3.jpeg') }}") 31% 80% / 185px 170px no-repeat,
                url("{{ asset('images/oldpartners/op4.jpeg') }}") 69% 80% / 185px 170px no-repeat,
                url("{{ asset('images/oldpartners/op6.jpeg') }}") 84% 40% / 185px 170px no-repeat,
                url("{{ asset('images/oldpartners/op5.jpeg') }}") 1% 10% / 185px 170px no-repeat;
            background-color: rgba(128, 1, 50, 0.578);
            background-blend-mode: multiply;
            padding: 140px 0 60px 0;
        }
    }

    /* Mobile: Only founder image */
    @media (max-width: 567px) {
        .bg-breadcrumb {
            background: 
                /* linear-gradient(135deg, #848484 0%, #848484 100%), */
                url("{{ asset('images/oldpartners/scanlen.jpeg') }}") center/220px 220px no-repeat;
            background-color: rgba(128, 1, 50, 0.578);
            background-blend-mode: multiply;
            padding: 140px 0 60px 0;
            /* min-height: 250px; */
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

    /* Responsive Typography */
        @media (max-width: 1200px) {
            .header h1 {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 992px) {
            .header h1 {
                font-size: 3rem;
                letter-spacing: 2px;
            }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.5rem;
                letter-spacing: 1.5px;
            }
        }

        @media (max-width: 576px) {
            .header h1 {
                font-size: 2rem;
                letter-spacing: 1px;
            }
        }

        @media (max-width: 400px) {
            .header h1 {
                font-size: 1.75rem;
            }
        }

    /*** Single Page Hero Header End ***/
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('heroHeader');
        
        // Check screen size and load appropriate images
        const isMobile = window.innerWidth < 768;
        
        // Image URLs
        const imageUrls = isMobile 
            ? ["{{ asset('images/oldpartners/scanlen.jpeg') }}"]  // Only founder on mobile
            : [
                "{{ asset('images/oldpartners/scanlen.jpeg') }}",
                "{{ asset('images/oldpartners/op1.jpeg') }}",
                "{{ asset('images/oldpartners/op2.jpeg') }}",
                "{{ asset('images/oldpartners/op3.jpeg') }}",
                "{{ asset('images/oldpartners/op4.jpeg') }}",
                "{{ asset('images/oldpartners/op5.jpeg') }}"
            ];
        
        // Preload images
        let loadedImages = 0;
        const totalImages = imageUrls.length;
        
        function imageLoaded() {
            loadedImages++;
            if (loadedImages === totalImages) {
                setTimeout(() => {
                    header.classList.add('loaded');
                }, 100);
            }
        }
        
        // Preload each image
        imageUrls.forEach(url => {
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
        
        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                // Reload if crossing mobile/desktop threshold
                const nowMobile = window.innerWidth < 768;
                if (nowMobile !== isMobile) {
                    location.reload();
                }
            }, 250);
        });
    });

    
</script>



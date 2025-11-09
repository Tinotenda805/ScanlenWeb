document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('circular-carousel');
    if (!carousel) return;
    
    const images = carousel.querySelectorAll('.carousel-img');
    const total = images.length;
    
    let radius = 200; // Default radius
    let imgSize = 80; // Default image size
    let centerX, centerY;
    let angle = 0;
    let animationId;
    let rotationSpeed = 0.2;

    // Function to get responsive values based on screen size
    function getResponsiveValues() {
        const width = window.innerWidth;
        
        if (width <= 359) {
            // Extra small mobile
            radius = 87.5; // (250 - 75) / 2
            imgSize = 45;
            rotationSpeed = 0.15;
        } else if (width <= 480) {
            // Mobile portrait
            radius = 97.5; // (280 - 85) / 2
            imgSize = 50;
            rotationSpeed = 0.15;
        } else if (width <= 576) {
            // Mobile landscape
            radius = 112.5; // (320 - 95) / 2
            imgSize = 55;
            rotationSpeed = 0.18;
        } else if (width <= 767) {
            // Small tablets
            radius = 135; // (380 - 110) / 2
            imgSize = 65;
            rotationSpeed = 0.18;
        } else if (width <= 991) {
            // Large tablets
            radius = 160; // (450 - 130) / 2
            imgSize = 75;
            rotationSpeed = 0.2;
        } else {
            // Desktop
            radius = 175; // (500 - 150) / 2
            imgSize = 80;
            rotationSpeed = 0.2;
        }
    }

    function updateCenterPosition() {
        centerX = carousel.offsetWidth / 2;
        centerY = carousel.offsetHeight / 2;
    }

    function positionImages() {
        for (let i = 0; i < total; i++) {
            // Calculate angle for each image
            const theta = ((360 / total) * i + angle) * Math.PI / 180;
            const x = centerX + Math.cos(theta) * radius - imgSize / 2;
            const y = centerY + Math.sin(theta) * radius - imgSize / 2;
            
            images[i].style.left = x + 'px';
            images[i].style.top = y + 'px';
            images[i].style.transform = 'rotate(0deg)'; // Always upright
        }
    }

    function animate() {
        angle += rotationSpeed; // Use dynamic rotation speed
        positionImages();
        animationId = requestAnimationFrame(animate);
    }

    function stopAnimation() {
        cancelAnimationFrame(animationId);
    }

    function startAnimation() {
        animationId = requestAnimationFrame(animate);
    }

    function initialize() {
        getResponsiveValues();
        updateCenterPosition();
        positionImages();
    }

    // Initialize
    initialize();
    startAnimation();
    
    // Pause animation on hover (desktop) or touch (mobile)
    carousel.addEventListener('mouseenter', stopAnimation);
    carousel.addEventListener('mouseleave', startAnimation);
    
    // Touch support for mobile
    let touchTimeout;
    images.forEach(img => {
        img.addEventListener('touchstart', function(e) {
            // Stop animation on touch
            stopAnimation();
            
            // Add touched class to show info
            this.classList.add('touched');
            
            // Remove touched class from others
            images.forEach(other => {
                if (other !== this) {
                    other.classList.remove('touched');
                }
            });
            
            // Clear existing timeout
            clearTimeout(touchTimeout);
            
            // Remove touched class after 3 seconds
            touchTimeout = setTimeout(() => {
                this.classList.remove('touched');
                startAnimation();
            }, 3000);
        });
    });

    // Reposition on window resize with debounce
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            // Stop current animation
            stopAnimation();
            
            // Recalculate everything
            getResponsiveValues();
            updateCenterPosition();
            positionImages();
            
            // Restart animation
            startAnimation();
        }, 250); // Wait 250ms after resize stops
    });

    // Handle orientation change
    window.addEventListener('orientationchange', function() {
        setTimeout(function() {
            stopAnimation();
            getResponsiveValues();
            updateCenterPosition();
            positionImages();
            startAnimation();
        }, 300);
    });

    /**
     * Frequently Asked Questions Toggle
     */
    document.querySelectorAll('.faq-item h3, .faq-item .faq-toggle').forEach((faqItem) => {
        faqItem.addEventListener('click', () => {
            faqItem.parentNode.classList.toggle('faq-active');
        });
    });
});
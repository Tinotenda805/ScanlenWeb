document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('circular-carousel');
    if (!carousel) return;
    
    const images = carousel.querySelectorAll('.carousel-img');
    const total = images.length;
    
    if (total === 0) return; // Exit if no images
    
    let radius = 200; // Default radius
    let imgSize = 80; // Default image size
    let angle = 0;
    let animationId;
    let rotationSpeed = 0.3;

    // Function to get responsive values based on screen size
    function getResponsiveValues() {
        const width = window.innerWidth;
        
        if (width <= 359) {
            radius = 87.5;
            imgSize = 45;
            rotationSpeed = 0.2;
        } else if (width <= 480) {
            radius = 97.5;
            imgSize = 50;
            rotationSpeed = 0.2;
        } else if (width <= 576) {
            radius = 112.5;
            imgSize = 55;
            rotationSpeed = 0.25;
        } else if (width <= 767) {
            radius = 135;
            imgSize = 65;
            rotationSpeed = 0.25;
        } else if (width <= 991) {
            radius = 160;
            imgSize = 75;
            rotationSpeed = 0.3;
        } else {
            radius = 175;
            imgSize = 80;
            rotationSpeed = 0.3;
        }
    }

    // Position images in 3D space around vertical axis
    function positionImages() {
        const angleStep = (2 * Math.PI) / total; // Divide circle into equal parts
        
        for (let i = 0; i < total; i++) {
            // Calculate the current angle for this image (in radians)
            const currentAngle = (angle * Math.PI / 180) + (angleStep * i);
            
            // Calculate X and Z positions (Y stays constant for vertical axis)
            const x = Math.sin(currentAngle) * radius;
            const z = Math.cos(currentAngle) * radius;
            
            // Calculate scale based on Z position (closer = bigger, farther = smaller)
            const scale = (z + radius) / (radius * 2) * 0.5 + 0.5; // Scale between 0.5 and 1
            
            // Apply 3D transform
            images[i].style.transform = `
                translate(-50%, -50%)
                translateX(${x}px)
                translateZ(${z}px)
                scale(${scale})
            `;
            
            // CRITICAL: Adjust z-index based on Z position
            // Negative Z = behind center, should have lower z-index (behind founder)
            // Positive Z = in front, should have higher z-index
            const zIndex = Math.round(z);
            images[i].style.zIndex = zIndex;
            
            // Add 'behind' class when Z is negative (behind the founder)
            if (z < 0) {
                images[i].classList.add('behind');
            } else {
                images[i].classList.remove('behind');
            }
        }
    }

    // Animation loop
    function animate() {
        angle += rotationSpeed;
        if (angle >= 360) angle = 0; // Reset angle
        positionImages();
        animationId = requestAnimationFrame(animate);
    }

    // Stop animation
    function stopAnimation() {
        cancelAnimationFrame(animationId);
    }

    // Start animation
    function startAnimation() {
        animationId = requestAnimationFrame(animate);
    }

    // Initialize
    function initialize() {
        getResponsiveValues();
        positionImages();
    }

    // Start everything
    initialize();
    startAnimation();
    
    // Pause animation on hover (desktop)
    carousel.addEventListener('mouseenter', stopAnimation);
    carousel.addEventListener('mouseleave', startAnimation);
    
    // Touch support for mobile
    let touchTimeout;
    images.forEach(img => {
        img.addEventListener('touchstart', function(e) {
            // Don't interact with images that are behind
            if (this.classList.contains('behind')) return;
            
            stopAnimation();
            this.classList.add('touched');
            
            images.forEach(other => {
                if (other !== this) {
                    other.classList.remove('touched');
                }
            });
            
            clearTimeout(touchTimeout);
            
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
            stopAnimation();
            getResponsiveValues();
            positionImages();
            startAnimation();
        }, 250);
    });

    // Handle orientation change
    window.addEventListener('orientationchange', function() {
        setTimeout(function() {
            stopAnimation();
            getResponsiveValues();
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
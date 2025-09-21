document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('circular-carousel');
    if (!carousel) return;
    
    const images = carousel.querySelectorAll('.carousel-img');
    const total = images.length;
    const radius = 200; // px, distance from center
    const centerX = carousel.offsetWidth / 2;
    const centerY = carousel.offsetHeight / 2;
    const imgSize = 110; // px, image width/height
    let angle = 0;
    let animationId;

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
        angle += 0.2; // rotation speed
        positionImages();
        animationId = requestAnimationFrame(animate);
    }

    function stopAnimation() {
        cancelAnimationFrame(animationId);
    }

    function startAnimation() {
        animationId = requestAnimationFrame(animate);
    }

    // Initialize and start animation
    positionImages();
    startAnimation();
    
    // Pause animation on hover
    carousel.addEventListener('mouseenter', stopAnimation);
    carousel.addEventListener('mouseleave', startAnimation);
    
    // Reposition on window resize
    window.addEventListener('resize', function() {
        // Recalculate center position
        centerX = carousel.offsetWidth / 2;
        centerY = carousel.offsetHeight / 2;
        positionImages();
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


document.addEventListener('DOMContentLoaded', function() {
    // ===== TIMELINE RIBBON =====
    const timelineTrack = document.getElementById('timelineTrack');
    
    // Historical partners data with years
    const historicalPartners = [
        { image: '/images/oldpartners/scanlen.jpeg', year: '1894' },
        { image: '/images/oldpartners/op1.jpeg', year: '1902' },
        { image: '/images/oldpartners/op2.jpeg', year: '1915' },
        { image: '/images/oldpartners/op3.jpeg', year: '1928' },
        { image: '/images/oldpartners/op4.jpeg', year: '1935' },
        { image: '/images/oldpartners/op5.jpeg', year: '1947' },
        { image: '/images/oldpartners/op6.jpeg', year: '1956' },
        { image: '/images/oldpartners/op7.jpeg', year: '1968' },
        { image: '/images/oldpartners/op8.jpeg', year: '1979' },
    ];
    
    function createTimelineItem(partner) {
        return `
            <div class="timeline-item">
                <img src="${partner.image}" alt="Partner ${partner.year}" class="timeline-portrait">
                <div class="timeline-year">${partner.year}</div>
            </div>
        `;
    }
    
    // Create timeline items (duplicate for seamless loop)
    let timelineHTML = '';
    historicalPartners.forEach(partner => {
        timelineHTML += createTimelineItem(partner);
    });
    // Duplicate for seamless infinite scroll
    historicalPartners.forEach(partner => {
        timelineHTML += createTimelineItem(partner);
    });
    
    timelineTrack.innerHTML = timelineHTML;
    
    // ===== 3D CAROUSEL =====
    const carousel = document.getElementById('circular-carousel');
    if (carousel) {
        const images = carousel.querySelectorAll('.carousel-img');
        const total = images.length;
        
        if (total > 0) {
            let angle = 0;
            let animationId;
            const rotationSpeed = 0.25;

            // ✅ ADJUST THIS VALUE TO CONTROL SPACING (higher = more space from center)
            const BASE_ORBIT_RADIUS = 250;  // Change this: try 250, 280, 300, 350, etc.

            function positionImages() {
                const angleStep = (2 * Math.PI) / total;

                for (let i = 0; i < total; i++) {
                    const currentAngle = (angle * Math.PI / 180) + (angleStep * i);

                    // Use the BASE_ORBIT_RADIUS directly
                    const x = Math.sin(currentAngle) * BASE_ORBIT_RADIUS;
                    const z = Math.cos(currentAngle) * BASE_ORBIT_RADIUS;

                    // Scale for depth effect
                    const scale = (z + BASE_ORBIT_RADIUS) / (BASE_ORBIT_RADIUS * 2) * 0.4 + 0.6;

                    images[i].style.transform = `
                        translate(-50%, -50%)
                        translateX(${x}px)
                        translateZ(${z}px)
                        scale(${scale})
                    `;

                    // Hide images behind the founder (when z is negative and far back)
                    if (z < -100) {
                        images[i].classList.add('behind');
                        images[i].style.zIndex = 1;
                    } else {
                        images[i].classList.remove('behind');
                        images[i].style.zIndex = Math.round(z + BASE_ORBIT_RADIUS + 100);
                    }
                }
            }

            function animate() {
                angle = (angle + rotationSpeed) % 360;
                positionImages();
                animationId = requestAnimationFrame(animate);
            }

            // Initialize
            positionImages();
            animate();

            // Pause on hover
            carousel.addEventListener('mouseenter', () => {
                cancelAnimationFrame(animationId);
            });

            carousel.addEventListener('mouseleave', () => {
                animationId = requestAnimationFrame(animate);
            });

            // Resize handling
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    cancelAnimationFrame(animationId);
                    positionImages();
                    animationId = requestAnimationFrame(animate);
                }, 200);
            });
        }
    }


    // Animate statistics on scroll
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const number = entry.target.querySelector('.stat-number');
                const finalValue = parseInt(number.textContent);
                const suffix = number.textContent.replace(/[0-9]/g, '');
                
                let current = 0;
                const increment = finalValue / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= finalValue) {
                        number.textContent = finalValue + suffix;
                        clearInterval(timer);
                    } else {
                        number.textContent = Math.floor(current) + suffix;
                    }
                }, 30);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.stat-item').forEach(stat => {
        statsObserver.observe(stat);
    });

    // Sticky Find Lawyer Button
    const findLawyerBtn = document.getElementById('findLawyerBtn');
    const findLawyerPanel = document.getElementById('findLawyerPanel');
    const closePanelBtn = document.getElementById('closePanelBtn');

    findLawyerBtn.addEventListener('click', function() {
        findLawyerPanel.classList.add('active');
        findLawyerBtn.style.display = 'none';
    });

    closePanelBtn.addEventListener('click', function() {
        findLawyerPanel.classList.remove('active');
        setTimeout(() => {
            findLawyerBtn.style.display = 'flex';
        }, 300);
    });

    // Mission/Vision Carousel
    let currentSlide = 1;
    const indicators = document.querySelectorAll('.mv-indicator');
    const slides = {
        1: document.getElementById('mvSlide1'),
        2: document.getElementById('mvSlide2')
    };

    function showSlide(slideNum) {
        // Hide all slides
        // Object.values(slides).forEach(slide => slide.style.display = 'none');
        // Show current slide
        // slides[slideNum].style.display = 'block';
        
        // Update indicators
        indicators.forEach((ind, index) => {
            ind.classList.toggle('active', index + 1 === slideNum);
        });
    }

    // Auto-rotate carousel
    setInterval(() => {
        currentSlide = currentSlide === 1 ? 2 : 1;
        showSlide(currentSlide);
    }, 5000);

    // Manual navigation
    indicators.forEach(indicator => {
        indicator.addEventListener('click', function() {
            currentSlide = parseInt(this.dataset.slide);
            showSlide(currentSlide);
        });
    });


    // ABOUT PAGE
    const video = document.getElementById('aboutVideo');
    const muteToggle = document.getElementById('muteToggle');
    const muteIcon = document.getElementById('muteIcon');
    
    if (video && muteToggle && muteIcon) {
        muteToggle.addEventListener('click', function() {
            if (video.muted) {
                video.muted = false;
                muteIcon.classList.remove('bi-volume-mute');
                muteIcon.classList.add('bi-volume-up');
                muteToggle.title = 'Click to mute';
            } else {
                video.muted = true;
                muteIcon.classList.remove('bi-volume-up');
                muteIcon.classList.add('bi-volume-mute');
                muteToggle.title = 'Click to unmute';
            }
        });
    }


    
});
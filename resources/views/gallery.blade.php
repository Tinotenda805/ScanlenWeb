@extends('layouts.app')

@section('content')

@include('layouts.page-header')

<style>
    /*--------------------------------------------------------------
# Professional Gallery Section for Law Firm
--------------------------------------------------------------*/
:root {
    --maroon: #3c0008;
    --light-maroon: #50010b;
    --white: #ffffff;
    --light-gray: #f8f9fa;
    --dark-gray: #343a40;
    --gold: #d4af37;
}

.gallery {
  background: #fafafa;
  padding: 80px 0;
}

.gallery .section-title {
  text-align: center;
  margin-bottom: 60px;
}

.gallery .section-title h2 {
  font-size: 2.5rem;
  font-weight: 700;
  color: black;
  margin-bottom: 20px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.gallery .section-title p {
  font-size: 1.1rem;
  color: #64748b;
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.6;
}

.gallery .gallery-filters {
  padding: 0;
  margin: 0 auto 50px auto;
  list-style: none;
  text-align: center;
  background: white;
  border-radius: 50px;
  padding: 10px 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  display: inline-flex;
  justify-content: center;
  width: auto;
}

.gallery .gallery-filters li {
  cursor: pointer;
  display: inline-block;
  padding: 12px 25px;
  font-size: 16px;
  font-weight: 600;
  margin: 0 5px;
  border-radius: 25px;
  transition: all 0.3s ease;
  color: #64748b;
  position: relative;
}

.gallery .gallery-filters li:hover,
.gallery .gallery-filters li.filter-active {
  color: white;
  background: linear-gradient(135deg, #3c0008, #50010b);
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
}

@media (max-width: 768px) {
  .gallery .gallery-filters {
    flex-wrap: wrap;
    border-radius: 15px;
    padding: 15px;
  }
  
  .gallery .gallery-filters li {
    font-size: 14px;
    padding: 10px 20px;
    margin: 5px;
  }
}

.gallery .gallery-item {
  margin-bottom: 30px;
}

.gallery .gallery-content {
  position: relative;
  overflow: hidden;
  border-radius: 15px;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
  transition: all 0.4s ease;
  background: white;
}

.gallery .gallery-content:hover {
  transform: translateY(-8px);
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
}

.gallery .gallery-content img {
  width: 100%;
  height: 300px;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.gallery .gallery-content:hover img {
  transform: scale(1.05);
}

.gallery .gallery-content .gallery-info {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
  padding: 40px 20px 20px;
  transform: translateY(100%);
  transition: transform 0.4s ease;
}

.gallery .gallery-content:hover .gallery-info {
  transform: translateY(0);
}

.gallery .gallery-content .gallery-info h4 {
  font-size: 18px;
  font-weight: 700;
  color: white;
  margin-bottom: 8px;
  letter-spacing: 0.5px;
}

.gallery .gallery-content .gallery-info p {
  font-size: 14px;
  color: #cbd5e1;
  margin-bottom: 15px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.gallery .gallery-content .gallery-info .gallery-links {
  display: flex;
  justify-content: center;
  gap: 15px;
}

.gallery .gallery-content .gallery-info .gallery-links a {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 45px;
  height: 45px;
  background: rgba(255, 255, 255, 0.2);
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  color: white;
  font-size: 18px;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
}

.gallery .gallery-content .gallery-info .gallery-links a:hover {
  background: white;
  color: var(--maroon);
  transform: scale(1.1);
  box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
}

/* Badge for categories */
.gallery .gallery-content .category-badge {
  position: absolute;
  top: 15px;
  left: 15px;
  background: linear-gradient(135deg, #3c0008, #50010b);
  color: white;
  padding: 8px 15px;
  border-radius: 25px;
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  z-index: 2;
  opacity: 0;
  transform: translateX(-20px);
  transition: all 0.3s ease;
}

.gallery .gallery-content:hover .category-badge {
  opacity: 1;
  transform: translateX(0);
}

/* Loading animation */
.gallery-container {
  opacity: 0;
  animation: fadeInUp 0.6s ease forwards;
}

/* Filter transition effects */
.gallery-item {
  transition: all 0.6s ease;
  opacity: 1;
  transform: scale(1);
}

.gallery-item.isotope-hidden {
  opacity: 0;
  transform: scale(0.8);
}

/* Isotope layout transitions */
.isotope-container {
  transition: opacity 0.3s ease;
}

.isotope,
.isotope .isotope-item {
  transition-duration: 0.6s;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}
</style>

<!-- Gallery Section -->
<section id="gallery" class="gallery">
  <div class="container">
    <!-- Section Title -->
    <div class="section-title" data-aos="fade-up">
        <h2>Our Legal Team & Expertise</h2>
        <p>
            Meet our distinguished attorneys and explore our areas of legal specialization. 
        </p>
    </div>

    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
      <!-- Enhanced Filters -->
      <div class="text-center mb-5" data-aos="fade-up" data-aos-delay="100">
        <ul class="gallery-filters isotope-filters">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-attorneys">Attorneys</li>
          <li data-filter=".filter-practice-areas">Practice Areas</li>
          <li data-filter=".filter-achievements">Achievements</li>
          <li data-filter=".filter-resources">Resources</li>
        </ul>
      </div>

      <div class="row gy-4 isotope-container gallery-container" data-aos="fade-up" data-aos-delay="200">
        
        <!-- Senior Partner -->
        <div class="col-lg-4 col-md-6 gallery-item isotope-item filter-attorneys">
          <div class="gallery-content h-100">
            <div class="category-badge">Senior Partner</div>
            <img src="{{asset('images/law.jpg')}}" class="img-fluid" alt="Senior Partner">
            <div class="gallery-info">
              <h4>John A. Mitchell</h4>
              <p>Senior Partner - Corporate Law</p>
              <div class="gallery-links">
                <a href="{{asset('images/law.jpg')}}" title="View Profile" data-gallery="gallery-attorneys" class="glightbox preview-link">
                  <i class="bi bi-zoom-in"></i>
                </a>
                <a href="#" title="Contact" class="details-link">
                  <i class="bi bi-person-lines-fill"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Practice Area -->
        <div class="col-lg-4 col-md-6 gallery-item isotope-item filter-practice-areas">
          <div class="gallery-content h-100">
            <div class="category-badge">Practice Area</div>
            <img src="{{asset('images/lexafrica.png')}}" class="img-fluid" alt="Corporate Law">
            <div class="gallery-info">
              <h4>Corporate & Business Law</h4>
              <p>Comprehensive Business Solutions</p>
              <div class="gallery-links">
                <a href="{{asset('images/lexafrica.png')}}" title="Learn More" data-gallery="gallery-practice" class="glightbox preview-link">
                  <i class="bi bi-zoom-in"></i>
                </a>
                <a href="#" title="More Details" class="details-link">
                  <i class="bi bi-briefcase"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Associate Attorney -->
        <div class="col-lg-4 col-md-6 gallery-item isotope-item filter-attorneys">
          <div class="gallery-content h-100">
            <div class="category-badge">Associate</div>
            <img src="{{asset('images/business.jpg')}}" class="img-fluid" alt="Associate Attorney">
            <div class="gallery-info">
              <h4>Sarah L. Johnson</h4>
              <p>Associate - Commercial Litigation</p>
              <div class="gallery-links">
                <a href="{{asset('images/business.jpg')}}" title="View Profile" data-gallery="gallery-attorneys" class="glightbox preview-link">
                  <i class="bi bi-zoom-in"></i>
                </a>
                <a href="#" title="Contact" class="details-link">
                  <i class="bi bi-person-lines-fill"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Legal Resource -->
        <div class="col-lg-4 col-md-6 gallery-item isotope-item filter-resources">
          <div class="gallery-content h-100">
            <div class="category-badge">Resources</div>
            <img src="{{asset('images/admin-law.jpg')}}" class="img-fluid" alt="Legal Resources">
            <div class="gallery-info">
              <h4>Administrative Law Guide</h4>
              <p>Comprehensive Legal Resources</p>
              <div class="gallery-links">
                <a href="{{asset('images/admin-law.jpg')}}" title="View Resource" data-gallery="gallery-resources" class="glightbox preview-link">
                  <i class="bi bi-zoom-in"></i>
                </a>
                <a href="#" title="Download" class="details-link">
                  <i class="bi bi-download"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Achievement -->
        <div class="col-lg-4 col-md-6 gallery-item isotope-item filter-achievements">
          <div class="gallery-content h-100">
            <div class="category-badge">Achievement</div>
            <img src="{{asset('images/law.jpg')}}" class="img-fluid" alt="Awards">
            <div class="gallery-info">
              <h4>Legal Excellence Award 2024</h4>
              <p>Outstanding Legal Service Recognition</p>
              <div class="gallery-links">
                <a href="{{asset('images/law.jpg')}}" title="View Award" data-gallery="gallery-achievements" class="glightbox preview-link">
                  <i class="bi bi-zoom-in"></i>
                </a>
                <a href="#" title="Learn More" class="details-link">
                  <i class="bi bi-award"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Practice Area -->
        <div class="col-lg-4 col-md-6 gallery-item isotope-item filter-practice-areas">
          <div class="gallery-content h-100">
            <div class="category-badge">Practice Area</div>
            <img src="{{asset('images/business.jpg')}}" class="img-fluid" alt="Employment Law">
            <div class="gallery-info">
              <h4>Employment & Labor Law</h4>
              <p>Workplace Legal Solutions</p>
              <div class="gallery-links">
                <a href="{{asset('images/business.jpg')}}" title="Learn More" data-gallery="gallery-practice" class="glightbox preview-link">
                  <i class="bi bi-zoom-in"></i>
                </a>
                <a href="#" title="More Details" class="details-link">
                  <i class="bi bi-people"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Include Isotope.js from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

<script>
// Enhanced gallery functionality with working filters
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Isotope
    var $grid = $('.isotope-container').isotope({
        itemSelector: '.gallery-item',
        layoutMode: 'fitRows',
        transitionDuration: '0.6s'
    });

    // Filter items on button click
    $('.gallery-filters').on('click', 'li', function() {
        var filterValue = $(this).attr('data-filter');
        
        // Add loading effect
        const container = document.querySelector('.isotope-container');
        container.style.opacity = '0.7';
        
        // Remove active class from all filter items
        $('.gallery-filters li').removeClass('filter-active');
        // Add active class to clicked item
        $(this).addClass('filter-active');
        
        // Apply filter
        $grid.isotope({ 
            filter: filterValue,
            transitionDuration: '0.6s'
        });
        
        // Remove loading effect
        setTimeout(() => {
            container.style.opacity = '1';
        }, 300);
    });

    // Layout Isotope after each image loads
    $grid.imagesLoaded().progress(function() {
        $grid.isotope('layout');
    });

    // Add intersection observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = `${Math.random() * 0.5}s`;
                entry.target.classList.add('animate__animated', 'animate__fadeInUp');
            }
        });
    }, observerOptions);

    // Observe gallery items
    document.querySelectorAll('.gallery-item').forEach(item => {
        observer.observe(item);
    });

    // Alternative pure JavaScript filter implementation (fallback)
    if (typeof $ === 'undefined') {
        const filterButtons = document.querySelectorAll('.gallery-filters li');
        const galleryItems = document.querySelectorAll('.gallery-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter');
                
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('filter-active'));
                this.classList.add('filter-active');
                
                // Filter items
                galleryItems.forEach(item => {
                    if (filterValue === '*') {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 50);
                    } else if (item.classList.contains(filterValue.substring(1))) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 50);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    }
});
</script>

@endsection
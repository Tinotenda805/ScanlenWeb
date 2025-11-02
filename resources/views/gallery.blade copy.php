@extends('layouts.app')

@section('content')

@include('layouts.page-header', ['title' => 'Our Gallery'])

<style>
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

.gallery-container {
  opacity: 0;
  animation: fadeInUp 0.6s ease forwards;
}

.gallery-item {
  transition: all 0.6s ease;
  opacity: 1;
  transform: scale(1);
}

.gallery-item.isotope-hidden {
  opacity: 0;
  transform: scale(0.8);
}

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
</style>

<section id="gallery" class="gallery">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
        <h2>Our Legal Team & Expertise</h2>
        <p>
            Meet our distinguished attorneys and explore our areas of legal specialization. 
        </p>
    </div>

    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
      <div class="text-center mb-5" data-aos="fade-up" data-aos-delay="100">
        <ul class="gallery-filters isotope-filters">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-attorneys">Our People</li>
          <li data-filter=".filter-practice-areas">Practice Areas</li>
          <li data-filter=".filter-achievements">Achievements</li>
          <li data-filter=".filter-resources">Resources</li>
        </ul>
      </div>

      <div class="row gy-4 isotope-container gallery-container" data-aos="fade-up" data-aos-delay="200">
        
        @forelse($gallery as $item)
        <div class="col-lg-4 col-md-6 gallery-item isotope-item {{ $item->filter_class }}">
          <div class="gallery-content h-100">
            @if($item->badge_label)
            <div class="category-badge">{{ $item->badge_label }}</div>
            @endif
            <img src="{{ $item->image_url }}" class="img-fluid" alt="{{ $item->title }}">
            <div class="gallery-info">
              <h4>{{ $item->title }}</h4>
              @if($item->description)
              <p>{{ Str::limit($item->description, 40) }}</p>
              @endif
              <div class="gallery-links">
                <a href="{{ $item->image_url }}" 
                   title="{{ $item->title }}" 
                   data-gallery="gallery-{{ $item->category }}" 
                   class="glightbox preview-link">
                  <i class="bi bi-zoom-in"></i>
                </a>
                @if($item->link_url)
                <a href="{{ $item->link_url }}" title="More Details" class="details-link" target="_blank">
                  <i class="bi bi-link-45deg"></i>
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-images" style="font-size: 4rem; color: #ccc;"></i>
            <p class="text-muted mt-3">No gallery items available at the moment.</p>
        </div>
        @endforelse

      </div>
    </div>
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var $grid = $('.isotope-container').isotope({
        itemSelector: '.gallery-item',
        layoutMode: 'fitRows',
        transitionDuration: '0.6s'
    });

    $('.gallery-filters').on('click', 'li', function() {
        var filterValue = $(this).attr('data-filter');
        
        const container = document.querySelector('.isotope-container');
        container.style.opacity = '0.7';
        
        $('.gallery-filters li').removeClass('filter-active');
        $(this).addClass('filter-active');
        
        $grid.isotope({ 
            filter: filterValue,
            transitionDuration: '0.6s'
        });
        
        setTimeout(() => {
            container.style.opacity = '1';
        }, 300);
    });

    $grid.imagesLoaded().progress(function() {
        $grid.isotope('layout');
    });
});
</script>

@endsection
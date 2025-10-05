@extends('layouts.app')

@section('content')

@include('layouts.page-header')

    

<!-- Team Start -->
<div class="container-fluid team py-5">
    <div class="container py-5">
        <div class="mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s">
            <h1 class="display-5 mb-4 text-center ">Meet Our Partners</h1>
            <p class="mb-0" style="text-align: justify">
                At the heart of our firm is a dedicated team of partners whose combined experience spans decades of legal practice. 
                Each partner brings unique expertise in areas such as corporate law, litigation, property, family law, and advisory services. 
                Together, they uphold the firm’s values of integrity, professionalism, and client-focused solutions — guiding both individuals 
                and businesses with clarity and confidence.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('images/law.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">David James</h4>
                        <p class="mb-0">Profession</p>
                    </div>
                    <div class="team-icon">
                        <a class="rounded-circle btn me-3" href="mailto:someone@email.com"><i class="fas fa-envelope"></i></a>
                        <a class="rounded-circle btn me-3" href="https://www.linkedin.com/in/username" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <a class="rounded-circle btn me-3" href="https://wa.me/1234567890" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <a class="rounded-circle btn me-0" href="tel:+1234567890"><i class="fas fa-phone"></i></a>
                    </div>
                    <div class="team-btn mt-3">
                        <a href="{{route('our-people.partner')}}" class="btn read-more-btn">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('images/2.jpeg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">David James</h4>
                        <p class="mb-0">Profession</p>
                    </div>
                    <div class="team-icon">
                        <a class="rounded-circle btn me-3" href="mailto:someone@email.com"><i class="fas fa-envelope"></i></a>
                        <a class="rounded-circle btn me-3" href="https://www.linkedin.com/in/username" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <a class="rounded-circle btn me-3" href="https://wa.me/1234567890" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <a class="rounded-circle btn me-0" href="tel:+1234567890"><i class="fas fa-phone"></i></a>
                    </div>
                    <div class="team-btn mt-3">
                        <a href="{{route('our-people.partner')}}" class="btn btn-sm read-more-btn">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('images/3.jpeg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">David James</h4>
                        <p class="mb-0">Profession</p>
                    </div>
                    <div class="team-icon">
                        <a class="rounded-circle btn me-3" href="mailto:someone@email.com"><i class="fas fa-envelope"></i></a>
                        <a class="rounded-circle btn me-3" href="https://www.linkedin.com/in/username" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <a class="rounded-circle btn me-3" href="https://wa.me/1234567890" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <a class="rounded-circle btn me-0" href="tel:+1234567890"><i class="fas fa-phone"></i></a>
                    </div>
                    <div class="team-btn mt-3">
                        <a href="#" class="btn btn-sm read-more-btn">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('images/4.jpeg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">David James</h4>
                        <p class="mb-0">Profession</p>
                    </div>
                    <div class="team-icon">
                        <a class="rounded-circle btn me-3" href="mailto:someone@email.com"><i class="fas fa-envelope"></i></a>
                        <a class="rounded-circle btn me-3" href="https://www.linkedin.com/in/username" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <a class="rounded-circle btn me-3" href="https://wa.me/1234567890" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <a class="rounded-circle btn me-0" href="tel:+1234567890"><i class="fas fa-phone"></i></a>
                    </div>
                    <div class="team-btn mt-3">
                        <a href="#" class="btn btn-sm read-more-btn">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->
    <div class="container" style="display: none">      
        <div class="section-title align-items-center text-center">
            <h3>Meet Our Partners</h3>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card partner-card shadow">
                    <div class="partner-img-container">
                        <img src="{{asset('images/1.jpeg')}}" class="partner-img img-fluid" alt="Partner 4">
                    </div>
                    <div class="card-body text-center">
                        <h3 class="partner-name">James Wilson</h3>
                        <p class="partner-position">Partner, Real Estate</p>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                        <p class="card-text">Focuses on complex real estate transactions and development projects nationwide.</p>
                        <button type="button" class="btn btn-read-more" data-bs-toggle="modal" data-bs-target="#partnerModal4">
                            Read More
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card partner-card shadow">
                    <div class="partner-img-container">
                        <img src="{{asset('images/2.jpeg')}}" class="partner-img img-fluid" alt="Partner 4">
                    </div>
                    <div class="card-body text-center">
                        <h3 class="partner-name">James Wilson</h3>
                        <p class="partner-position">Partner, Real Estate</p>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                        <p class="card-text">Focuses on complex real estate transactions and development projects nationwide.</p>
                        <button type="button" class="btn btn-read-more" data-bs-toggle="modal" data-bs-target="#partnerModal4">
                            Read More
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card partner-card shadow">
                    <div class="partner-img-container">
                        <img src="{{asset('images/law.jpg')}}" class="partner-img img-fluid" alt="Partner 4">
                    </div>
                    <div class="card-body text-center">
                        <h3 class="partner-name">James Wilson</h3>
                        <p class="partner-position">Partner, Real Estate</p>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                        <p class="card-text">Focuses on complex real estate transactions and development projects nationwide.</p>
                        <button type="button" class="btn btn-read-more" data-bs-toggle="modal" data-bs-target="#partnerModal4">
                            Read More
                        </button>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>

    <!-- Partner Modals -->
    <!-- Modal 1 -->
    <div class="modal fade" id="partnerModal1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Robert Johnson</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="modal-img" alt="Robert Johnson">
                        </div>
                        <div class="col-md-7">
                            <h3>Robert Johnson</h3>
                            <p class="text-muted">Senior Partner, Corporate Law</p>
                            <p>Robert Johnson leads our Corporate Practice Group and has extensive experience in mergers and acquisitions, corporate governance, and securities law.</p>
                            <p>He has represented clients in transactions totaling over $50 billion and has been recognized by Legal 500 as a leading lawyer in corporate law.</p>
                            <p>Robert graduated magna cum laude from Harvard Law School and joined the firm in 2001.</p>
                            <div class="social-icons mt-3">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        

    </div>


    
@endsection




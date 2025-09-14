@extends('layouts.app')

@section('content')

<section class="py-5">
    <div class="container">
        <h1 class="page-heading">Our Expertise</h1>
        <p class="intro-text mb-3">
            
        </p>
        <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title">Leadership Team</h2>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Partner 1 -->
            {{-- <div class="col-md-6 col-lg-4">
                <div class="card partner-card shadow">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="partner-img" alt="Partner 1">
                    <div class="card-body text-center">
                        <h3 class="partner-name">Robert Johnson</h3>
                        <p class="partner-position">Senior Partner, Corporate Law</p>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                        <p class="card-text">Specializing in corporate governance and M&A transactions with over 20 years of experience.</p>
                        <button type="button" class="btn btn-read-more" data-bs-toggle="modal" data-bs-target="#partnerModal1">
                            Read More
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Partner 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="card partner-card shadow">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="partner-img" alt="Partner 2">
                    <div class="card-body text-center">
                        <h3 class="partner-name">Sarah Williams</h3>
                        <p class="partner-position">Partner, Intellectual Property</p>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                        <p class="card-text">Expert in patent law and intellectual property disputes with a background in technology.</p>
                        <button type="button" class="btn btn-read-more" data-bs-toggle="modal" data-bs-target="#partnerModal2">
                            Read More
                        </button>
                    </div>
                </div>
            </div> --}}
            
            <!-- Partner 3 -->
            
            
            <!-- Partner 4 -->
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
</section>


    
@endsection



   
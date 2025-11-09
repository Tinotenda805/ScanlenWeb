@extends('layouts.app')

@section('content')
<style>
        :root {
            --primary-color: #3c0008;
            --secondary-color: #d4af37;
            --accent-color: #8b0000;
            --light-color: #f8f9fa;
            --dark-color: #1a1a1a;

        }
        
        
        
        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }
        
       
        
        .btn-primary {
            background-color: var(--secondary-color);
            border: none;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #b89a5d;
            transform: translateY(-2px);
        }
        
        .btn-outline-light {
            border: 2px solid white;
            color: white;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-outline-light:hover {
            background-color: white;
            color: var(--primary-color);
        }
        
        .hero-section {
            background: linear-gradient(rgba(94, 94, 94, 0.85), rgba(48, 0, 0, 0.9)), url('https://images.unsplash.com/photo-1589829545856-d10d557cf95f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 150px 0 100px;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 40px;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 3px;
            background-color: var(--secondary-color);
        }
        
        .practice-area-card {
            border: none;
            border-radius: 5px;
            transition: all 0.3s;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .practice-area-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .practice-area-icon {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }
        
        .attorney-card {
            border: none;
            border-radius: 5px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .attorney-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .testimonial-card {
            border-left: 4px solid var(--secondary-color);
            background-color: var(--light-color);
            padding: 30px;
            border-radius: 0 5px 5px 0;
        }
        
        .client-logo {
            filter: grayscale(100%);
            opacity: 0.6;
            transition: all 0.3s;
        }
        
        .client-logo:hover {
            filter: grayscale(0);
            opacity: 1;
        }
        
        .footer {
            background-color: var(--primary-color);
            color: white;
            padding: 70px 0 30px;
        }
        
        .footer a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer a:hover {
            color: var(--secondary-color);
        }
        
        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin-right: 10px;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }
        
        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            margin-top: 50px;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0;
        }
        
        .stat-label {
            font-size: 1rem;
            color: var(--dark-color);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .contact-info-box {
            background-color: var(--light-color);
            padding: 30px;
            border-radius: 5px;
            height: 100%;
        }
        
        .contact-icon {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }
    </style>


    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-4 fw-bold mb-4">Your Trusted Legal Partners For Over 25 Years</h1>
                    <p class="lead mb-4">At Sterling Legal Partners, we provide exceptional legal representation with a commitment to integrity, excellence, and personalized service for each of our clients.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#contact" class="btn btn-primary">Schedule Consultation</a>
                        <a href="#practice-areas" class="btn btn-outline-light">Our Practice Areas</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Optional: Could add a form or image here -->
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4">
                    <p class="stat-number">500+</p>
                    <p class="stat-label">Cases Won</p>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <p class="stat-number">25+</p>
                    <p class="stat-label">Years Experience</p>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <p class="stat-number">98%</p>
                    <p class="stat-label">Client Satisfaction</p>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <p class="stat-number">15</p>
                    <p class="stat-label">Expert Attorneys</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="section-title">About Our Firm</h2>
                    <p class="mb-4">Founded in 1998, Sterling Legal Partners has established itself as a premier law firm dedicated to providing comprehensive legal solutions to individuals, businesses, and organizations.</p>
                    <p class="mb-4">Our team of experienced attorneys brings together diverse expertise and a shared commitment to achieving the best possible outcomes for our clients. We pride ourselves on our personalized approach, treating each case with the attention and dedication it deserves.</p>
                    <p class="mb-4">With a track record of success spanning over two decades, we have earned the trust of our clients and the respect of our peers in the legal community.</p>
                    <a href="#attorneys" class="btn btn-primary">Meet Our Team</a>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1589391886645-d51941baf7fb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Law firm office" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Practice Areas -->
    <section class="py-5 bg-light" id="practice-areas">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Our Practice Areas</h2>
                    <p class="lead">Comprehensive legal services tailored to your specific needs</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card practice-area-card h-100 p-4">
                        <div class="practice-area-icon">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <h4>Corporate Law</h4>
                        <p>We provide strategic counsel for business formation, contracts, mergers, acquisitions, and corporate governance matters.</p>
                        <a href="#" class="text-decoration-none">Learn More <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card practice-area-card h-100 p-4">
                        <div class="practice-area-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h4>Real Estate Law</h4>
                        <p>From residential transactions to commercial property development, we handle all aspects of real estate law.</p>
                        <a href="#" class="text-decoration-none">Learn More <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card practice-area-card h-100 p-4">
                        <div class="practice-area-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <h4>Family Law</h4>
                        <p>Compassionate representation for divorce, child custody, adoption, and other family-related legal matters.</p>
                        <a href="#" class="text-decoration-none">Learn More <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card practice-area-card h-100 p-4">
                        <div class="practice-area-icon">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <h4>Criminal Defense</h4>
                        <p>Aggressive defense representation for individuals facing criminal charges at both state and federal levels.</p>
                        <a href="#" class="text-decoration-none">Learn More <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card practice-area-card h-100 p-4">
                        <div class="practice-area-icon">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <h4>Estate Planning</h4>
                        <p>Comprehensive estate planning services including wills, trusts, probate, and asset protection strategies.</p>
                        <a href="#" class="text-decoration-none">Learn More <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card practice-area-card h-100 p-4">
                        <div class="practice-area-icon">
                            <i class="fas fa-briefcase-medical"></i>
                        </div>
                        <h4>Personal Injury</h4>
                        <p>Dedicated representation for victims of accidents, medical malpractice, and other personal injury cases.</p>
                        <a href="#" class="text-decoration-none">Learn More <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Attorneys Section -->
    <section class="py-5" id="attorneys">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Our Legal Team</h2>
                    <p class="lead">Meet our experienced attorneys dedicated to your success</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card attorney-card">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" class="card-img-top" alt="Robert Johnson">
                        <div class="card-body text-center p-4">
                            <h5 class="card-title">Robert Johnson</h5>
                            <p class="text-muted">Managing Partner</p>
                            <p class="card-text">Specializing in corporate law with over 20 years of experience.</p>
                            <div class="social-icons d-flex justify-content-center mt-3">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card attorney-card">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" class="card-img-top" alt="Sarah Williams">
                        <div class="card-body text-center p-4">
                            <h5 class="card-title">Sarah Williams</h5>
                            <p class="text-muted">Senior Partner</p>
                            <p class="card-text">Expert in family law and estate planning with 15 years of practice.</p>
                            <div class="social-icons d-flex justify-content-center mt-3">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card attorney-card">
                        <img src="https://images.unsplash.com/photo-1562788863-8cc48c0eaf7b?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" class="card-img-top" alt="Michael Chen">
                        <div class="card-body text-center p-4">
                            <h5 class="card-title">Michael Chen</h5>
                            <p class="text-muted">Partner</p>
                            <p class="card-text">Focused on real estate law and commercial transactions.</p>
                            <div class="social-icons d-flex justify-content-center mt-3">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card attorney-card">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" class="card-img-top" alt="Jennifer Martinez">
                        <div class="card-body text-center p-4">
                            <h5 class="card-title">Jennifer Martinez</h5>
                            <p class="text-muted">Partner</p>
                            <p class="card-text">Specializes in criminal defense and personal injury cases.</p>
                            <div class="social-icons d-flex justify-content-center mt-3">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-light" id="testimonials">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Client Testimonials</h2>
                    <p class="lead">What our clients say about our legal services</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="fst-italic mb-3">"Sterling Legal Partners handled my corporate merger with exceptional expertise. Their attention to detail and strategic approach saved our company millions."</p>
                        <h5>James Wilson</h5>
                        <p class="text-muted">CEO, Tech Innovations Inc.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="fst-italic mb-3">"During my difficult divorce, Sarah Williams provided not only excellent legal representation but also emotional support. I couldn't have asked for a better attorney."</p>
                        <h5>Amanda Roberts</h5>
                        <p class="text-muted">Client</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="fst-italic mb-3">"The real estate team at Sterling Legal made our commercial property acquisition seamless. Their expertise in negotiations was invaluable to our business."</p>
                        <h5>David Thompson</h5>
                        <p class="text-muted">Property Developer</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5" id="contact">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Contact Us</h2>
                    <p class="lead">Get in touch for a confidential consultation</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-8">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Subject">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="contact-info-box">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h5>Our Office</h5>
                        <p class="mb-4">123 Legal Avenue, Suite 500<br>New York, NY 10001</p>
                        
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h5>Phone Number</h5>
                        <p class="mb-4">+1 (555) 123-4567</p>
                        
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5>Email Address</h5>
                        <p class="mb-0">info@sterlinglegal.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
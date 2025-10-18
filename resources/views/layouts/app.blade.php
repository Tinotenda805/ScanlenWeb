<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanlen & Holderness - Law Firm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/style2.css')}}"> --}}
    <link href="{{ asset('images/avitar.png')}}" rel="shortcut icon">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- Libraries Stylesheet -->
    {{-- <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> --}}

    {{-- FONTS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/clients/client-2/assets/css/client-2.css">
    
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="{{ url('/') }}" style="letter-spacing:2px;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:55px; width:auto; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); background:#fff;">
            </a>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('history') ? 'active' : '' }}" href="{{route('history.index')}}">Our History</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('our-partners*') || Request::is('our-associates*') || Request::is('gallery*') ? 'active' : '' }}" 
                        href="#" id="ourPeopleDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Our People
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="ourPeopleDropdown">
                            <li><a class="dropdown-item {{ Request::is('partners') ? 'active' : '' }}" href="{{ route('our-people.partners') }}">Partners</a></li>
                            <li><a class="dropdown-item {{ Request::is('associates') ? 'active' : '' }}" href="{{ route('our-people.associates') }}">Associates</a></li>
                            <li><a class="dropdown-item {{ Request::is('gallery') ? 'active' : '' }}" href="{{ route('our-people.gallery') }}">Gallery</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('expertise*') ? 'active' : '' }}" href="{{ route('expertise.index') }}">Expertise</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('articles*') || Request::is('judgements*') ? 'active' : '' }}" 
                        href="#" id="briefcaseDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Briefcase
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="briefcaseDropdown">
                            <li><a class="dropdown-item {{ Request::is('articles') ? 'active' : '' }}" href="{{ route('articles.index') }}">Articles</a></li>
                            <li><a class="dropdown-item {{ Request::is('blogs') ? 'active' : '' }}" href="{{route('blogs.index')}}">Blogs</a></li>
                            <li><a class="dropdown-item {{ Request::is('judgements') ? 'active' : '' }}" href="{{ route('judgements.index') }}">Judgements</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('contactUs') ? 'active' : '' }}" href="{{ route('contactUs') }}">Contact Us</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link px-1" href="#!">
                    <i class="fab fa-facebook-square"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-1" href="#!">
                    <i class="fab fa-youtube"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-1" href="#!">
                    <i class="fab fa-linkedin"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-1" href="#!">
                    <i class="fab fa-whatsapp"></i>
                    </a>
                </li>
            </ul>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>


    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        
        <div class="p-3">
            <div class="row gy-4 footer-top border-bottom border-danger-subtle pb-2">
                <div class="first-dev col-lg-3 col-md-3">
                    <a class="navbar-brand fw-bold text-white d-flex " href="{{ url('/') }}" >
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="image-fluid" style="height:auto; width:100%; border-radius:8px; ">
                    </a>
                    
                </div>

                <div class="our-location col-lg-3 col-md-3 ">
                    <h5 class="footer-heading border-start border-5 border-danger-subtle ps-2 bold">WHERE TO FIND US</h5>
                    
                    <p class="">
                        Address: 13th Floor, CABS Centre,
                        74 Jason Moyo Avenue, Harare, Zimbabwe. <br>
                        Phone: +263 (0) 242 799636-42 || +263 (0) 242 702561-8 <br>
                        Fax: +263 (0) 242 702569 || +263 (0) 242 700826  <br>
                        Email: info@scanlen.co.zw
                    </p>
                    <ul class="navbar-nav flex-row">
                        <li class="nav-item">
                            <a class="nav-link px-1" href="#!">
                            <i class="fab fa-facebook-square"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-1" href="#!">
                            <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-1" href="#!">
                            <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-1" href="#!">
                            <i class="fab fa-whatsapp"></i>
                            </a>
                        </li>
                    </ul>
                    {{-- <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3798.181788370157!2d31.04833597384885!3d-17.830111076366077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1931a517c27efdef%3A0x2be3aeb168c64e6d!2sSCANLEN%20%26%20HOLDERNESS%20-%20LAW%20FIRM%20HARARE%20ZIMBABWE!5e0!3m2!1sen!2sza!4v1757508528678!5m2!1sen!2sza" 
                        referrerpolicy="no-referrer-when-downgrade" 
                        width="100%" 
                        height="120" 
                        style="border:0; border-radius: 8px;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe> --}}
                </div>

                <div class="diclaimer col-lg-3 col-md-3">
                    <h5 class="footer-heading border-start border-5 border-danger-subtle ps-2">DISCLAIMER</h5>
                    {{-- <p>Feel free to leave your email address so that we keep you informed on all our activities.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <button class="btn btn-outline-warning" type="button" id="button-addon1">Submit</button>
                    </div> --}}
                    {{-- <strong>Disclaimer:</strong>  --}}
                    <p class="justify-info">
                        The materials appearing on this website are for information 
                        purposes only and do not constitute legal advice. You should not take action 
                        based on this information without consulting a legal practitioner. This site is
                         not intended to create a legal practitioner – client relationship.

                    </p>
                </div>
                <div class="col-lg-3 col-md-3">
                    <h5 class="footer-heading border-start border-5 border-danger-subtle ps-2 bold">USEFUL LINKS</h5>
                    <div class="useful-links">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link"  href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Our History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Our People</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Expertise</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="footer-bottom p-2 text-center">
            &copy; {{ date('Y') }} Scanlen & Holderness. All rights reserved.
            {{-- <div style="font-size: 0.8em; color: #6c757d;">
                Developed by <a href="mailto:your.email@example.com" class="text-decoration-none">sjrdlomo</a>
            </div> --}}
        </div>
    </footer>

    <!-- Bootstrap & JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/script.js')}}"></script>

    
    
    
</body>
</html>
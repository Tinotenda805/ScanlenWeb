<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Scanlen & Holderness - Law Firm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="{{ asset('images/avitar.png')}}" rel="shortcut icon">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}


    {{-- FONTS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/clients/client-2/assets/css/client-2.css">

    @stack('styles')
    
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="{{ url('/') }}" style="letter-spacing:2px;">
                <img src="{{ asset('images/logo.png') }}" class="rounded" alt="Logo" style="height:55px; width:auto; box-shadow:0 2px 6px rgba(0,0,0,0.1); background:#fff;">
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" id="navToggler"
                    aria-label="Toggle navigation"
                    aria-expanded="false"
                    aria-controls="navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="navbar-collapse collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('history') ? 'active' : '' }}" href="{{route('history.index')}}">Our History</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Route::is('our-people*') ? 'active' : '' }}" 
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Our People
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ Route::is('our-people.partners*') ? 'active' : '' }}" href="{{ route('our-people.partners') }}">Partners</a></li>
                            <li><a class="dropdown-item {{ Route::is('our-people.associates*') ? 'active' : '' }}" href="{{ route('our-people.associates') }}">Associates</a></li>
                            <li><a class="dropdown-item {{ Route::is('our-people.gallery*') ? 'active' : '' }}" href="{{ route('our-people.gallery') }}">Gallery</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('expertise*') ? 'active' : '' }}" href="{{ route('expertise.index') }}">Expertise</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('articles*') || Request::is('judgements*') ? 'active' : '' }}" 
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Briefcase
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ Request::is('articles') ? 'active' : '' }}" href="{{ route('articles.index') }}">Articles</a></li>
                            <li><a class="dropdown-item {{ Request::is('blogs') ? 'active' : '' }}" href="{{route('blogs.index')}}">Blogs</a></li>
                            <li><a class="dropdown-item {{ Request::is('judgements') ? 'active' : '' }}" href="{{ route('judgements.index') }}">Judgements</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('contactUs') ? 'active' : '' }}" href="{{ route('contactUs') }}">Contact Us</a>
                    </li>
                </ul>
                <ul class="navbar-nav flex-row social-links">
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
            </div>
        </div>
        
        <!-- Mobile Menu Overlay -->
        <div class="mobile-overlay" id="mobileOverlay"></div>
    </nav>



    <main>
        {{-- TOASTS --}}
        <div class="toast-container position-fixed top-0 end-0 p-3">
            @foreach(['success','error'] as $msg)
                @if(session($msg))
                    <div class="toast show text-bg-{{ $msg == 'success' ? 'success' : 'danger' }}">
                        <div class="toast-body">{{ session($msg) }}</div>
                    </div>
                @endif
            @endforeach
        </div>
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
                    <h5 class="footer-heading border-start border-5 border-danger-subtle ps-2">WHERE TO FIND US</h5>
                    
                    <p class="">
                        Address: 13th Floor, CABS Centre,
                        74 Jason Moyo Avenue, Harare, Zimbabwe. <br>
                        Phone: +263 (0) 242 799636-42 || +263 (0) 242 702561-8 <br>
                        Fax: +263 (0) 242 702569 || +263 (0) 242 700826  <br>
                        Email: info@scanlen.co.zw
                    </p>
                    <ul class="navbar-nav flex-row">
                        <li class="nav-item">
                            <a class="social-icon px-1" href="#!">
                            <i class="fab fa-facebook-square"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="social-icon px-1" href="#!">
                            <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="social-icon px-1" href="#!">
                            <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="social-icon px-1" href="#!">
                            <i class="fab fa-whatsapp"></i>
                            </a>
                        </li>
                    </ul>
                    
                </div>

                <div class="diclaimer col-lg-3 col-md-3">
                    <h5 class="footer-heading border-start border-5 border-danger-subtle ps-2">DISCLAIMER</h5>
                    <p class="justify-info">
                        The materials appearing on this website are for information 
                        purposes only and do not constitute legal advice. You should not take action 
                        based on this information without consulting a legal practitioner. This site is
                         not intended to create a legal practitioner – client relationship.

                    </p>
                </div>
                <div class="col-lg-3 col-md-3">
                    <h5 class="footer-heading border-start border-5 border-danger-subtle ps-2">USEFUL LINKS</h5>
                    <div class="useful-links">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link"  href="{{route('homePage')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('history.index')}}">Our History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('our-people.partners')}}">Our Partners</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('our-people.associates')}}">Our Associates</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('expertise.index')}}">Expertise</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('contactUs')}}">Contact Us</a>
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
    {{-- <script src="{{asset('js/analytics-tracker.js')}}"></script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Toast notifications
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            toastElList.map(function (toastEl) {
                var toast = new bootstrap.Toast(toastEl, {
                    autohide: true,
                    delay: 3000
                })
                toast.show()
            })

            // Navigation elements
            const navToggler = document.getElementById('navToggler');
            const navbarCollapse = document.getElementById('navbarNav');
            const mobileOverlay = document.getElementById('mobileOverlay');
            let isMenuOpen = false;

            // Initialize - Ensure menu is closed on page load
            function initializeMenu() {
                // Remove any existing 'show' classes
                navbarCollapse.classList.remove('show');
                mobileOverlay.classList.remove('show');
                navToggler.classList.remove('active');
                document.body.classList.remove('menu-open');
                isMenuOpen = false;
                
                // Set ARIA attributes
                navToggler.setAttribute('aria-expanded', 'false');
                navbarCollapse.setAttribute('aria-hidden', 'true');
                
            }

            // Initialize on page load
            initializeMenu();

            // Toggle menu with animation
            navToggler.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                
                if (isMenuOpen) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });

            function openMenu() {
                navToggler.classList.add('active');
                navbarCollapse.classList.add('show');
                mobileOverlay.classList.add('show');
                document.body.classList.add('menu-open');
                
                // Update ARIA attributes
                navToggler.setAttribute('aria-expanded', 'true');
                navbarCollapse.setAttribute('aria-hidden', 'false');
                
                isMenuOpen = true;
            }

            function closeMenu() {
                navToggler.classList.remove('active');
                navbarCollapse.classList.remove('show');
                mobileOverlay.classList.remove('show');
                document.body.classList.remove('menu-open');
                
                // Update ARIA attributes
                navToggler.setAttribute('aria-expanded', 'false');
                navbarCollapse.setAttribute('aria-hidden', 'true');
                
                isMenuOpen = false;
            }

            // Close menu when clicking overlay
            mobileOverlay.addEventListener('click', function(e) {
                if (isMenuOpen) {
                    closeMenu();
                }
            });

            // Close menu when clicking a nav link (mobile only)
            document.querySelectorAll('.nav-link:not(.dropdown-toggle)').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992 && isMenuOpen) {
                        closeMenu();
                    }
                });
            });

            // Close menu when clicking dropdown items (mobile only)
            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    if (window.innerWidth < 992 && isMenuOpen) {
                        closeMenu();
                    }
                });
            });

            // Close menu on escape key press
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && isMenuOpen) {
                    closeMenu();
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992 && isMenuOpen) {
                    closeMenu();
                }
            });

            // Close menu when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth < 992 && 
                    isMenuOpen && 
                    !navbarCollapse.contains(e.target) && 
                    !navToggler.contains(e.target)) {
                    closeMenu();
                }
            });

        });
    </script>
    
    @stack('scripts')
    
</body>
</html>
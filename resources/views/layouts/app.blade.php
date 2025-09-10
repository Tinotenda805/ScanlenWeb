<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanlen & Holderness - Law Firm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="{{ asset('images/avitar.png')}}" rel="shortcut icon">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="{{ url('/') }}" style="letter-spacing:2px;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:55px; width:auto; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); background:#fff; margin-right:14px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Our History</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="ourPeopleDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Our People
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="ourPeopleDropdown">
                            <li><a class="dropdown-item" href="#">Partners</a></li>
                            <li><a class="dropdown-item" href="#">Associates</a></li>
                            <li><a class="dropdown-item" href="#">Gallery</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="{{route('expertise')}}" id="expertiseDropdown" >
                            Expertise
                        </a>
                        {{-- <ul class="dropdown-menu" aria-labelledby="expertiseDropdown">
                            <li><a class="dropdown-item" href="#">Corporate and commercial law</a></li>
                            <li><a class="dropdown-item" href="#">Dispute resolution and litigation</a></li>
                            <li><a class="dropdown-item" href="#">Constitutional and administrative law</a></li>
                            <li><a class="dropdown-item" href="#">Employment law</a></li>
                            <li><a class="dropdown-item" href="#">Conveyancing and property law</a></li>
                            <li><a class="dropdown-item" href="#">Insolvency law and debt</a></li>
                            <li><a class="dropdown-item" href="#">Restructuring</a></li>
                            <li><a class="dropdown-item" href="#">Criminal law</a></li>
                            <li><a class="dropdown-item" href="#">Immigration law</a></li>
                            <li><a class="dropdown-item" href="#">Family law</a></li>
                            <li><a class="dropdown-item" href="#">Estate planning and administration</a></li>
                            <li><a class="dropdown-item" href="#">Intellectual property</a></li>
                            <li><a class="dropdown-item" href="#">Licensing</a></li>
                            <li><a class="dropdown-item" href="#">Compliance and regulatory law</a></li>
                        </ul> --}}
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="briefcaseDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Briefcase
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="briefcaseDropdown">
                            <li><a class="dropdown-item" href="#">Articles</a></li>
                            <li><a class="dropdown-item" href="#">Judgements</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="p-2">
            <div class="d-flex d-grid gap-3 footer-top border-bottom border-secondary pb-2">
                <a class="navbar-brand fw-bold text-white d-flex " href="{{ url('/') }}" style="letter-spacing:2px;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:55px; width:auto; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); background:#fff; margin-right:14px;">
                </a>

                <div class="our-location col-sm d-flex flex-column ">
                    <h5 class="footer-heading border-start border-5 border-secondary ps-2 bold">WHERE TO FIND US</h5>
                    <p>
                        Address: 13th Floor, CABS Centre,
                        74 Jason Moyo Avenue, Harare, Zimbabwe. <br>
                        Phone: +263 (0) 242 799636-42 || +263 (0) 242 702561-8 <br>
                        Fax: +263 (0) 242 702569 || +263 (0) 242 700826  <br>
                        Email: info@scanlen.co.zw
                    </p>
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3798.181788370157!2d31.04833597384885!3d-17.830111076366077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1931a517c27efdef%3A0x2be3aeb168c64e6d!2sSCANLEN%20%26%20HOLDERNESS%20-%20LAW%20FIRM%20HARARE%20ZIMBABWE!5e0!3m2!1sen!2sza!4v1757508528678!5m2!1sen!2sza" 
                        referrerpolicy="no-referrer-when-downgrade" 
                        width="100%" 
                        height="100" 
                        style="border:0; border-radius: 8px;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>

                <div class="diclaimer col-sm d-flex flex-column">
                    <h5 class="footer-heading border-start border-5 border-secondary ps-2">JOIN OUR NEWSLETTER</h5>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <button class="btn btn-outline-warning" type="button" id="button-addon1">Submit</button>
                    </div>
                    <strong>Disclaimer:</strong> The materials appearing on this website are for information 
                    purposes only and do not constitute legal advice. You should not take action 
                    based on this information without consulting a legal practitioner. This site is
                     not intended to create a legal practitioner – client relationship.
                </div>

            </div>
            <div class="footer-bottom centre pt-3">
                &copy; {{ date('Y') }} Scanlen & Holderness. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap & JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/script.js')}}"></script>
    
</body>
</html>
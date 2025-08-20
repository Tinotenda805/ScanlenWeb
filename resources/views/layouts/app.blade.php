<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Scanlen & Holderness')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @vite(['resources/sass/app/scss', 'resources/js/app.js'])
    <style>
        
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg shadow">
    <div class="container py-2">
        <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="{{ url('/') }}" style="letter-spacing:2px;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:55px; width:auto; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); background:#fff; margin-right:14px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto gap-2">
                <li class="nav-item"><a class="nav-link text-white px-3 rounded" href="{{ route('homePage') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3 rounded" href="#">About Us</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3 rounded" href="#">Our People</a></li>
                <li class="nav-item"><a class="nav-link text-white px-3 rounded" href="#">Expertise</a></li>
            </ul>
            <!-- Search Icon -->
            <form class="d-flex ms-3" role="search">
                <button class="btn btn-link text-white" type="submit" title="Search">
                    <i class="bi bi-search" style="font-size: 1.5rem;"></i>
                </button>
            </form>
            <!-- Social Icons -->
            <div class="d-flex align-items-center ms-3">
                <a href="https://www.linkedin.com/" target="_blank" class="btn btn-link text-white px-2" title="LinkedIn">
                    <i class="bi bi-linkedin" style="font-size: 1.5rem;"></i>
                </a>
                <a href="https://www.facebook.com/" target="_blank" class="btn btn-link text-white px-2" title="Facebook">
                    <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
                </a>
                <a href="https://www.youtube.com/" target="_blank" class="btn btn-link text-white px-2" title="YouTube">
                    <i class="bi bi-youtube" style="font-size: 1.5rem;"></i>
                </a>
            </div>
        </div>
    </div>
</nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer text-center py-3 mt-5">
        <div class="container">
            &copy; {{ date('Y') }} Scanlen & Holderness. All rights reserved.
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
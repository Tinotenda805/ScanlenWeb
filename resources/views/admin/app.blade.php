<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Scanlen') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts and Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<body>

    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar d-md-block">
                <div class="text-start mb-4">
                    <h4>Scanlen & Holderness</h4>
                    <p class="text-white-50">Admin Panel</p>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.people.*') ? 'active' : '' }}" href="{{ route('admin.people.index') }}">
                        <i class="fas fa-users"></i> Our People
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.expertise.*') ? 'active' : '' }}" href="{{ route('admin.expertise.index') }}">
                        <i class="fa fa-briefcase" aria-hidden="true"></i> Our Expertise
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.articles.*') ? 'active' : '' }}" href="{{ route('admin.articles.index') }}">
                        <i class="fas fa-newspaper"></i> Articles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.blogs.*') ? 'active' : '' }}" href="{{ route('admin.blogs.index') }}">
                        <i class="fas fa-blog"></i> Blogs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-folder"></i> Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.tags.*') ? 'active' : '' }}" href="{{ route('admin.tags.index') }}">
                        <i class="fas fa-tags"></i> Tags
                    </a>
                </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-bell"></i> Judgements
                        </a>
                    </li>
                    <li class="nav-item mt-4">
                        <a class="nav-link" href="#">
                            <i class="fas fa-user"></i> User Management
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Header -->
                @yield('header')
                {{-- ALERTS --}}
                <div aria-live="polite" aria-atomic="true" class="position-relative">
                    <div class="toast-container top-0 end-0 p-3">

                        {{-- Success Toast --}}
                        @if(session('success'))
                        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                    data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif

                        {{-- Error Toast --}}
                        @if(session('error'))
                        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('error') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                    data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif

                        {{-- Validation Errors Toast --}}
                        @if($errors->any())
                        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ $errors->first() }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                    data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>


                @yield('page_actions')
                @yield('content')
                
                
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
        });

        document.addEventListener("DOMContentLoaded", function () {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            toastElList.map(function (toastEl) {
                var toast = new bootstrap.Toast(toastEl, {
                    autohide: true,
                    delay: 3000 // 3 seconds
                })
                toast.show()
            })
        });
    </script>

    @yield('scripts')
</body>
</html>
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
</head>
<body>

    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar d-md-block">
                <div class="text-start mb-4">
                    <h4>Scanlen & Holderness</h4>
                    <p class="text-muted">Admin Panel</p>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('clients.index') ? 'active' : '' }}" href="">
                            <i class="fas fa-users"></i> Our People
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('systems.index') ? 'active' : '' }}" href="">
                            <i class="fas fa-cube"></i> Our History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('licenses.index') ? 'active' : '' }}" href="">
                            <i class="fas fa-certificate"></i> Articles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="fas fa-money-bill-wave"></i> Blogs
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
                <div class="header ps-4" style="display: ">
                    <h2 class="mb-0">Admin Manager</h2>
                    <div class="ms-3 " >
                        <button class="btn btn-outline-danger" type="button"  data-bs-toggle="modal" data-bs-target="#logout">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>

                        <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{route('logout')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            Are you sure you want to logout of the system?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Logout</button>
                                        </div>

                                    </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                </div>
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
        // Simple JavaScript for interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Add active class to clicked nav links
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            // Example of showing a toast notification (you can implement this for actions)
            function showToast(message, type = 'info') {
                // You can implement a toast notification system here
                console.log(`${type.toUpperCase()}: ${message}`);
            }
            
            // Example button actions
            // document.querySelectorAll('.action-btn').forEach(button => {
            //     button.addEventListener('click', function() {
            //         const action = this.querySelector('i').className;
            //         if (action.includes('eye')) {
            //             showToast('Viewing license details', 'info');
            //         } else if (action.includes('edit')) {
            //             showToast('Editing license', 'warning');
            //         } else if (action.includes('trash')) {
            //             if (confirm('Are you sure you want to delete this license?')) {
            //                 showToast('License deleted', 'danger');
            //             }
            //         } else if (action.includes('sync')) {
            //             showToast('Renewing license', 'success');
            //         } else if (action.includes('envelope')) {
            //             showToast('Sending notification to client', 'info');
            //         }
            //     });
            // });
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

    {{-- @stack('scripts') --}}
    @yield('scripts')
</body>
</html>
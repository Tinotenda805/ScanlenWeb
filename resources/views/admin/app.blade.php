<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') | Scanlen & Holderness</title>

    <!-- CSS CND -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root{
            --brand: #3c0008;
            --brand-soft: #861043;
            --bg-main: #f4f6f9;
            --text-muted: #6c757d;
        }

        body{
            font-family: 'Poppins', sans-serif;
            background: var(--bg-main);
            margin:0;
        }

        /* Topbar */
        .admin-topbar{
            height:70px;
            background: linear-gradient(90deg, #3c0008, #50010b);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display:flex;
            align-items:center;
            padding:0 1rem;
            position:fixed;
            top:0;
            left:0;
            right:0;
            z-index:1030;
        }

        .admin-topbar .nav-link {
            font-weight: 500;
        }

        .admin-topbar .dropdown-menu {
            min-width: 200px;
        }

        /* Sidebar */
        .admin-sidebar{
            position:fixed;
            top:70px;
            left:0;
            width:260px;
            height:calc(100vh - 60px);
            background:var(--brand);
            overflow-y:auto;
            z-index: 100;
        }

        .admin-sidebar h6{
            color:#fff;
            font-size:.75rem;
            text-transform:uppercase;
            letter-spacing:1px;
            padding:1rem 1.25rem 0.5rem;
        }

        .admin-sidebar .nav-link{
            color:#e0e0e0;
            padding:0.65rem 1.25rem;
            display:flex;
            align-items:center;
            font-size:0.95rem;
            gap:10px;
        }

        .admin-sidebar .nav-link:hover{
            background:rgba(255,255,255,0.08);
            color:#fff;
        }

        .admin-sidebar .nav-link.active{
            background:#fff;
            color:var(--brand);
            font-weight:600;
        }

        /* Content */
        .admin-content{
            margin-left:260px;
            padding:85px 1.5rem 2rem;
        }

        /* Mobile adjustments */
        @media (max-width: 991px){
            .admin-sidebar{
                transform:translateX(-100%);
                transition:.3s ease;
            }
            .admin-sidebar.show{
                transform:translateX(0);
            }
            .admin-content{
                margin-left:0;
                padding-top:85px;
            }
            .logo{
                display: none
            }
        }
    </style>

    @yield('head')
</head>
<body>

<!-- TOPBAR -->
<div class="admin-topbar d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
        <button class="btn btn-sm btn-outline-secondary d-lg-none" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand fw-bold text-white d-flex align-items-center " href="{{ route('admin.index') }}" style="letter-spacing:2px;">
            <img src="{{ asset('images/logo.png') }}" class="rounded logo" alt="Logo" style="height:55px; width:auto; box-shadow:0 2px 6px rgba(0,0,0,0.1); background:#fff;">
        </a>

    </div>

    <!-- RIGHT: User dropdown -->
    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white d-flex align-items-center"
               href="#"
               role="button"
               data-bs-toggle="dropdown"
               aria-expanded="false">

                <i class="fas fa-user-circle me-2 fs-4"></i>
                {{ Auth::user()->name ?? ''}}
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-id-badge me-2"></i> Profile
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
    
</div>

<!-- SIDEBAR -->
<aside class="admin-sidebar" id="adminSidebar">
    <h6>MAIN</h6>
    <nav class="nav flex-column">
        <a class="nav-link {{ Route::is('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}"><i class="fas fa-gauge"></i> Dashboard</a>
        <a class="nav-link {{ Route::is('admin.people.*') ? 'active' : '' }}" href="{{ route('admin.people.index') }}"><i class="fas fa-users"></i> Our People</a>
        <a class="nav-link {{ Route::is('admin.expertise.*') ? 'active' : '' }}" href="{{ route('admin.expertise.index') }}"><i class="fas fa-briefcase"></i> Expertise</a>
        <a class="nav-link {{ Route::is('admin.articles.*') ? 'active' : '' }}" href="{{ route('admin.articles.index') }}"><i class="fas fa-newspaper"></i> Articles</a>
        <a class="nav-link {{ Route::is('admin.blogs.*') ? 'active' : '' }}" href="{{ route('admin.blogs.index') }}"><i class="fas fa-blog"></i> Blogs</a>
        <a class="nav-link {{ Route::is('admin.judgements.*') ? 'active' : '' }}" href="{{ route('admin.judgements.index') }}"><i class="fas fa-scale-balanced"></i> Judgements</a>
        <a class="nav-link {{ Route::is('admin.gallery.*') ? 'active' : '' }}" href="{{ route('admin.gallery.index') }}"><i class="fas fa-image"></i> Gallery</a>
        <a class="nav-link {{ Route::is('admin.contact-messages.*') ? 'active' : '' }}" href="{{ route('admin.contact-messages.index') }}"><i class="fas fa-envelope"></i> Messages</a>
    </nav>

    <h6 class="mt-4">MANAGEMENT</h6>
    <nav class="nav flex-column mb-4">
        <a class="nav-link {{ Route::is('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}"><i class="fas fa-folder"></i> Categories</a>
        <a class="nav-link {{ Route::is('admin.tags.*') ? 'active' : '' }}" href="{{ route('admin.tags.index') }}"><i class="fas fa-tags"></i> Tags</a>
        <a class="nav-link {{ Route::is('admin.history.*') ? 'active' : '' }}" href="{{ route('admin.history.index') }}"><i class="fas fa-clock"></i> History</a>
        <a class="nav-link {{ Route::is('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"><i class="fas fa-user-shield"></i> Users</a>
    </nav>
</aside>

<!-- CONTENT -->
<main class="admin-content">

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

    @yield('header')
    @yield('page_actions')
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('js/quill-editor.js')}}?v={{ time() }}"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', function(){
        document.getElementById('adminSidebar').classList.toggle('show');
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

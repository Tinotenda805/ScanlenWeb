@extends('layouts.guest') {{-- use your guest layout --}}

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">

                    {{-- Logo --}}
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="60">
                    </div>

                    {{-- Session Status --}}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                            >
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                required
                                autocomplete="current-password"
                            >
                        </div>

                        {{-- Remember Me --}}
                        <div class="mb-3 form-check">
                            <input
                                type="checkbox"
                                name="remember"
                                class="form-check-input"
                                id="remember_me"
                            >
                            <label class="form-check-label" for="remember_me">
                                Remember me
                            </label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="small">
                                    Forgot your password?
                                </a>
                            @endif

                            <button type="submit" class="btn btn-primary">
                                Log in
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

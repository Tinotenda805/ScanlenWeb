<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scanlen & Holderness - Law Firm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('images/avitar.png')}}" rel="shortcut icon">
</head>
<body>
    <section class="vh-100" >
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h1 class="mb-5 bold">Sign in</h1>
                        <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                            @csrf

                            @session('status')
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ $value }}
                                </div>
                            @endsession

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" name="email" :value="old('email')" required autofocus autocomplete="username" id="typeEmailX-2" class="form-control form-control-lg" />
                                <label class="form-label" for="typeEmailX-2">Email</label>
                            </div>
                
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password" required autocomplete="current-password" />
                                <label class="form-label" for="typePasswordX-2" >Password</label>
                            </div>
                
                            <div class="align-items-center d-flex justify-content-between mb-4">
                                <!-- Checkbox -->
                                <div class="form-check d-flex ">
                                    <input class="form-check-input me-1" type="checkbox" value="" id="form1Example3" />
                                    <label class="form-check-label" for="form1Example3"> Remember password </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <p class="underline"><a class="text-white-20" href="{{ route('password.request') }}">Forgot password?</a></p>
                                @endif
                                
                            </div>
                
                            <button class="btn btn-primary " type="submit">Login</button>

                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

    <style>
        .card{
            background: linear-gradient(90deg, #3c0008 0%, #555555 100%) !important
        }
    </style>
</body>
</html>
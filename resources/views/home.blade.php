@extends('layouts.app')

@section('content')

<div id="hero" class="hero-section d-flex align-items-center">
    <div class="container">
        <div class="d-sm-flex align-items-center">
            <!-- Left content -->
            <div class="col-lg-7 col-md-12 mb-4 mb-lg-0 text-start">
                <h1 class="fw-bold">Welcome to Scanlen and Holderness</h1>
                <p class="lead">
                    A premier Zimbabwean law firm offering you a full 
                    circle of legal services whether you are a local, regional or international 
                    client. Our quality of expertise consistently earns us and our lawyers a top 
                    ranking in both local and international legal surveys.
                </p>
            </div>

            <!-- Right circular carousel -->
            <div class="col-lg-5 col-md-12 text-center">
                <div id="circular-carousel" class="position-relative">
                    <a href="#period1" class="carousel-img" style="--i:0;" title="1894-1920">
                        <img src="{{ asset('images/period1.jpg') }}" alt="1894-1920" class="rounded-circle">
                    </a>
                    <a href="#period2" class="carousel-img" style="--i:1;" title="1921-1960">
                        <img src="{{ asset('images/period2.jpg') }}" alt="1921-1960" class="rounded-circle">
                    </a>
                    <a href="#period3" class="carousel-img" style="--i:2;" title="1961-2000">
                        <img src="{{ asset('images/period3.jpg') }}" alt="1961-2000" class="rounded-circle">
                    </a>
                    <a href="#period4" class="carousel-img" style="--i:3;" title="2001-Present">
                        <img src="{{ asset('images/law.jpg') }}" alt="2001-Present" class="rounded-circle">
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

    
{{-- <div id="hero" class="p-5 text-center">
    <div class="container">
        <div class="d-sm-flex">
            <div>
                <h1> Welcome to Scanlen and Holderness</h1>
                <p>
                    Scanlen & Holderness is a premier Zimbabwean law firm offering you a full 
                    circle of legal services whether you are a local, regional or international 
                    client. Our quality of expertise consistently earns us and our lawyers a top 
                    ranking in both local and international legal surveys. 
                </p>
            </div>
            <div id="circular-carousel" class="">
                <a href="#period1" class="carousel-img" style="--i:0;" title="1894-1920">
                    <img src="{{ asset('images/period1.jpg') }}" alt="1894-1920" style="width:70px;height:70px;border-radius:50%;" data-bs-toggle="tooltip" data-bs-placement="top" title="1894-1920">
                </a>
                <a href="#period2" class="carousel-img" style="--i:1;"><img src="{{ asset('images/period2.jpg') }}" alt="1921-1960" style="width:70px;height:70px;border-radius:50%;"></a>
                <a href="#period3" class="carousel-img" style="--i:2;"><img src="{{ asset('images/period3.jpg') }}" alt="1961-2000" style="width:70px;height:70px;border-radius:50%;"></a>
                <a href="#period4" class="carousel-img" style="--i:3;"><img src="{{ asset('images/period4.jpg') }}" alt="2001-Present" style="width:70px;height:70px;border-radius:50%;"></a>
            </div>
        </div>

    </div>
    
</div> --}}
{{-- <div class="row">
    <div class="col-12">
        <h1 class="text-uppercase display-1 fw-semi-bold"> Welcome to Scanlen and Holderness</h1>
        <div id="circular-carousel" >
            <a href="#period1" class="carousel-img" style="--i:0;" title="1894-1920">
                <img src="{{ asset('images/period1.jpg') }}" alt="1894-1920" style="width:70px;height:70px;border-radius:50%;" data-bs-toggle="tooltip" data-bs-placement="top" title="1894-1920">
            </a>
            <a href="#period2" class="carousel-img" style="--i:1;"><img src="{{ asset('images/period2.jpg') }}" alt="1921-1960" style="width:70px;height:70px;border-radius:50%;"></a>
            <a href="#period3" class="carousel-img" style="--i:2;"><img src="{{ asset('images/period3.jpg') }}" alt="1961-2000" style="width:70px;height:70px;border-radius:50%;"></a>
            <a href="#period4" class="carousel-img" style="--i:3;"><img src="{{ asset('images/period4.jpg') }}" alt="2001-Present" style="width:70px;height:70px;border-radius:50%;"></a>
        </div>
    </div>
</div> --}}

    
@endsection
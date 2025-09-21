@extends('layouts.app')

@section('content')

<section class="py-5">
    <div class="container">
        <h1 class="page-heading">Our Expertise</h1>
        <p class="intro-text mb-3">
            We specialize in providing comprehensive legal solutions across various practice areas. 
            Our team of experienced attorneys is dedicated to delivering exceptional service and 
            achieving the best possible outcomes for our clients. Explore our areas of expertise below.
        </p>
        <div class="row">
            <div class="col-sm-6">
                <div class="expertise-card">
                    <img src="{{asset('images/business.jpg')}}" class="expertise-img rounded-bottom" alt="Corporate Law">
                    <div class="overlay">
                        <h3 class="fw-bold text-uppercase">Corporate and Commercial Law</h3>
                        <a href="#" class="btn btn-maroon btn-lg">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="expertise-card">
                    <img src="{{asset('images/5.jpeg')}}" class="expertise-img rounded-bottom" alt="Corporate Law">
                    <div class="overlay">
                        <h3 class="fw-bold text-uppercase">Family Law</h3>
                        <a href="#" class="btn btn-maroon btn-lg">Read More</a>
                    </div>
                </div>
            </div>
        </div>


        

    </div>
</section>


    
@endsection



   
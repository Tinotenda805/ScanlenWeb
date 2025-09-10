@extends('layouts.app')

@section('content')

<section class="py-5">
    <div class="container">
        <h3 class="page-heading">Our Expertise</h3>
        <div class="d-flex justify-content-sm-between d-grid gap-3">
            <div class="card expertise-card shadow border-0 col-sm bg-light d-flex flex-column">
                <a href="" class="links">
                    <img src="{{asset('images/business.jpg')}}" class="card-img-top expertise-img" alt="...">
                    <div class="card-body flex-grow-1">
                        <h5 class="card-title fw-bold">Corporate and Commercial Law</h5>
                        <p class="card-text">
                            Our corporate law team is well placed to provide a full circle of legal services. Engineered to serve our corporate clients throughout all economic sectors…
                        </p>
                        {{-- <a href="#" class="btn btn-primary">Read More</a> --}}
                    </div>
                </a>
                <a href="#" class="card-footer btn btn-maroon mt-auto ">Read More</a>
            </div>
            <div class="card expertise-card shadow border-0 col-sm bg-light d-flex flex-column">
                <a href="" class="links">
                    <img src="{{asset('images/property-law.jpg')}}" class="card-img-top expertise-img" alt="...">
                    <div class="card-body flex-grow-1">
                        <h5 class="card-title fw-bold">Conveyancing and Property Law</h5>
                        <p class="card-text">
                            The practice of conveyancing at Scanlen & Holderness goes back to the inception of the firm in 1894. Through the decades the practice of conveyancing…
                        </p>
                        {{-- <a href="#" class="btn btn-primary">Read More</a> --}}
                    </div>
                </a>
                <a href="#" class="card-footer btn btn-maroon mt-auto ">Read More</a>
            </div>
            <div class="card expertise-card shadow border-0 col-sm bg-light d-flex flex-column">
                <a href="" class="links">
                    <img src="{{asset('images/admin-law.jpg')}}" class="card-img-top expertise-img" alt="...">
                    <div class="card-body flex-grow-1">
                        <h5 class="card-title fw-bold">Constitutional and Administrative Law</h5>
                        <p class="card-text">
                            Our firm has traditionally fearlessly fought many human rights legal battles prior to the crystalisation of constitutional law in Zimbabwe in its current form…
                        </p>
                        {{-- <a href="#" class="btn btn-primary">Read More</a> --}}
                    </div>
                </a>
                <a href="#" class="card-footer btn btn-maroon mt-auto ">Read More</a>
            </div>
        </div>

        

    </div>
</section>


    
@endsection



   
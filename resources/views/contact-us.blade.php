@extends('layouts.app')

@section('content')

<section class="py-5">
    <div class="container">
        <h1 class="page-heading">Contact Us</h1>
        <p class="intro-text mb-3">
            We're always on the lookout to work with new clients. If you're interested in working with us, 
            please get in touch in one of the following ways.
        </p>
        <!-- Contact 3 - Bootstrap Brain Component -->
        <!--Section: Contact v.2-->
        <section class="mb-4 bg-light p-3">

            <div class="row">

                <!--Grid column-->
                <div class="col-md-9 mb-md-0 mb-5 border-end border-black">
                    <form id="contact-form" name="contact-form" action="" method="POST">

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="name" class="">Your name</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="email" class="">Your email</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <label for="subject" class="">Subject</label>
                                    <input type="text" id="subject" name="subject" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-12">

                                <div class="md-form">
                                    <label for="message">Your message</label>
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                </div>

                            </div>
                        </div>
                        <!--Grid row-->

                        <div class="text-end text-md-left mt-3">
                            <a class="btn btn-maroon" >Send Message</a>
                        </div>
                    </form>

                    <div class="status"></div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-3 ">
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex flex-row ">
                            <i class="fas fa-map-marker-alt fa-1x mt-2 me-2 text-maroon"></i>
                            <p>13th Floor, CABS Centre, 74 Jason Moyo Avenue, Harare, Zimbabwe.</p>
                        </li>

                        <li class="d-flex flex-row ">
                            <i class="fas fa-phone fa-1x mt-2 me-2 text-maroon"></i>
                            <p>+263 (0) 242 799636-42 <br> +263 (0) 242 702561-8</p>
                        </li>

                        <li class="d-flex flex-row ">
                            <i class="fas fa-envelope fa-1x mt-2 me-2 text-maroon"></i>
                            <p>info@scanlen.co.zw</p>
                        </li>
                        <li class="d-flex flex-row mt-2">
                            <i class="fa fa-fax fa-1x mt-2 me-2 text-maroon"></i>
                            <p> +263 (0) 242 702569 <br> +263 (0) 242 700826</p>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

            </div>

        </section>

        <section>
            {{-- <h4>Need Direction!!!</h4> --}}
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3798.181788370157!2d31.04833597384885!3d-17.830111076366077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1931a517c27efdef%3A0x2be3aeb168c64e6d!2sSCANLEN%20%26%20HOLDERNESS%20-%20LAW%20FIRM%20HARARE%20ZIMBABWE!5e0!3m2!1sen!2sza!4v1757508528678!5m2!1sen!2sza" 
                referrerpolicy="no-referrer-when-downgrade" 
                width="100%" 
                height="300px" 
                style="border:0; border-radius: 8px;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </section>
<!--Section: Contact v.2-->

        

    </div>
</section>


    
@endsection



   
@extends('layouts.app')

@section('content')
@include('layouts.page-header', ['title'=>'Contact Us'])

<section class="py-5">
    <div class="container">
        <h1 class="page-heading">Contact Us</h1>
        <p class="intro-text mb-3">
            We're always on the lookout to work with new clients. If you're interested in working with us, 
            please get in touch in one of the following ways.
        </p>
        <!-- Contact 3 - Bootstrap Brain Component -->
        <!--Section: Contact v.2-->
        <!-- Contact Section -->
    <section id="contact" class="contact section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="row gy-4">
  
            <div class="col-lg-4">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <div class="mr-2">
                  <i class="bi bi-geo-alt flex-shrink-0 btn btn-maroon rounded-circle"></i>
                </div>
                <div>
                  <h3>Address</h3>
                  <p>13th Floor, CABS Centre, 74 Jason Moyo Avenue, Harare, Zimbabwe.</p>
                </div>
              </div><!-- End Info Item -->
  
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <div class="mr-2">
                  <i class="bi bi-telephone flex-shrink-0 btn btn-maroon rounded-circle"></i>

                </div>
                <div>
                  <h3>Call Us</h3>
                  <p>+263 (0) 242 799636-42 || +263 (0) 242 702561-8</p>
                </div>
              </div><!-- End Info Item -->
  
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                <div class="mr-2">
                  <i class="bi bi-envelope flex-shrink-0 btn btn-maroon rounded-circle"></i>

                </div>
                <div>
                  <h3>Email Us</h3>
                  <p>info@scanlen.co.zw</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                <div class="mr-2">
                  <i class="bi bi-printer-fill flex-shrink-0 btn btn-maroon rounded-circle"></i>

                </div>
                <div>
                  <h3>Fax</h3>
                  <p>+263 (0) 242 702569 || +263 (0) 242 700826</p>
                </div>
              </div><!-- End Info Item -->
  
            </div>
  
            <div class="col-lg-8 ">
              <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                <div class="row gy-4">
  
                  <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                  </div>
  
                  <div class="col-md-6 ">
                    <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                  </div>
  
                  <div class="col-md-12">
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                  </div>
  
                  <div class="col-md-12">
                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                  </div>
  
                  <div class="col-md-12 ">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
  
                    <button type="submit" class="btn btn-maroon">Send Message</button>
                  </div>
  
                </div>
              </form>
            </div><!-- End Contact Form -->
  
          </div>

        <div class="mt-4 border border-secondary rounded" data-aos="fade-up" data-aos-delay="200">
          <iframe style="border:0; width: 100%; height: 270px;" class="rounded"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3798.181788370157!2d31.04833597384885!3d-17.830111076366077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1931a517c27efdef%3A0x2be3aeb168c64e6d!2sSCANLEN%20%26%20HOLDERNESS%20-%20LAW%20FIRM%20HARARE%20ZIMBABWE!5e0!3m2!1sen!2sza!4v1757508528678!5m2!1sen!2sza" 
          frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End Google Maps -->


      </div>

    </section><!-- /Contact Section -->

        
<!--Section: Contact v.2-->

        

    </div>
</section>


    
@endsection



   
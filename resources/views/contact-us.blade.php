@extends('layouts.app')

@section('content')
@include('layouts.page-header', ['title'=>'Contact Us'])

<section class="py-5">
  
    <div class="container">
      <div class="row">
        <div class="col-6 col-md-4">
          <h1 class="page-heading">Contact Us</h1>
        </div>
        <div class="col-sm-6 col-md-8">
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
        </div>
      </div>
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
                <div class="me-2">
                  <i class="bi bi-geo-alt flex-shrink-0 btn btn-maroon rounded-circle"></i>
                </div>
                <div>
                  <h3>Address</h3>
                  <p>13th Floor, CABS Centre, 74 Jason Moyo Avenue, Harare, Zimbabwe.</p>
                </div>
              </div><!-- End Info Item -->
  
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <div class="me-2">
                  <i class="bi bi-telephone flex-shrink-0 btn btn-maroon rounded-circle"></i>

                </div>
                <div>
                  <h3>Call Us</h3>
                  <p>+263 (0) 242 799636-42 || +263 (0) 242 702561-8</p>
                </div>
              </div><!-- End Info Item -->
  
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                <div class="me-2">
                  <i class="bi bi-envelope flex-shrink-0 btn btn-maroon rounded-circle"></i>

                </div>
                <div>
                  <h3>Email Us</h3>
                  <p>info@scanlen.co.zw</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                <div class="me-2">
                  <i class="bi bi-printer-fill flex-shrink-0 btn btn-maroon rounded-circle"></i>

                </div>
                <div>
                  <h3>Fax</h3>
                  <p>+263 (0) 242 702569 || +263 (0) 242 700826</p>
                </div>
              </div><!-- End Info Item -->
  
            </div>
  
            <div class="col-lg-8 ">
              <form action="{{route('storeMessage')}}" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                @csrf
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
                    {{-- <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                    --}}
                    <button type="submit" class="btn btn-maroon">Send Message</button>
                  </div>
  
                </div>
              </form>
            </div><!-- End Contact Form -->
  
          </div>



      </div>

    </section><!-- /Contact Section -->

        
<!--Section: Contact v.2-->

        

    </div>
</section>

<script>
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
    
@endsection



   
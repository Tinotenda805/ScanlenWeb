@extends('layouts.app')

@section('content')
@include('layouts.page-contact', ['title'=>'Contact Us', 'subtitle' => 'Let’s discuss how we can assist you'])
{{-- <div class="col-md-6">
    @if(session('success'))
        <div class="toast align-items-center text-bg-success border-0 show float-md-end" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif
</div> --}}

<style>
  .contact-info-box .info-item {
    display: flex;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 6px;
    margin-bottom: 15px;
}

.contact-info-box i {
    font-size: 22px;
    color: #3c0008;
}

.contact-info-box h6 {
    margin: 0;
    font-weight: 600;
}

.contact-info-box p {
    margin: 0;
    font-size: 0.9rem;
    color: #555;
}

</style>

<section class="py-5">
    <div class="container">

        <!-- Heading + Toast -->
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h1 class="page-heading mb-2">Contact Us</h1>
                <p class="text-muted">
                    We're always open to new engagements. Reach out using the details below or send us a message.
                </p>
            </div>

            
        </div>

        <!-- Content -->
        <div class="row g-4">

            <!-- LEFT: Contact Info -->
            <div class="col-lg-4">
                <div class="contact-info-box">

                    <div class="info-item">
                        <i class="bi bi-geo-alt"></i>
                        <div>
                            <h6>Address</h6>
                            <p>13th Floor, CABS Centre, 74 Jason Moyo Avenue, Harare</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-telephone"></i>
                        <div>
                            <h6>Call Us</h6>
                            <p>+263 242 799636-42<br>+263 242 702561-8</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-envelope"></i>
                        <div>
                            <h6>Email</h6>
                            <p>info@scanlen.co.zw</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-printer-fill"></i>
                        <div>
                            <h6>Fax</h6>
                            <p>+263 242 702569<br>+263 242 700826</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT: Contact Form -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <form action="{{ route('storeMessage') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control"
                                           placeholder="Your Name" required>
                                </div>

                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control"
                                           placeholder="Your Email" required>
                                </div>

                                <div class="col-12">
                                    <input type="text" name="subject" class="form-control"
                                           placeholder="Subject" required>
                                </div>

                                <div class="col-12">
                                    <textarea name="message" rows="6" class="form-control"
                                              placeholder="Your Message" required></textarea>
                                </div>

                                <div class="col-12 text-end">
                                    <button class="btn btn-maroon px-4">
                                        <i class="bi bi-send me-1"></i> Send Message
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
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



   
@extends('layouts.app',['title' => 'Contact Us'])
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-5">
                <h2 class="display-4 text-danger fw-bold">Contact Us</h2>
                <p class="lead text-muted">Get in touch with us</p>
            </div>

            <div class="row g-4">
                <!-- Contact Information -->
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-4">
                                <div class="d-flex align-items-center">
                                    <span class="flex-shrink-0" style="margin-right: 16px;">
                                        <i class="fas fa-map-marker-alt fa-2x text-danger"></i>
                                    </span>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1">Sacred Heart Shrine</h5>
                                        <p class="mb-0 text-muted">Idaikattur, Sivagangai-630602, Tamilnadu, India</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-4">
                                <div class="flex-shrink-0" style="margin-right: 16px;">
                                    <i class="fas fa-envelope fa-2x text-danger"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Email Us</h5>
                                    <p class="mb-0">
                                        <a href="mailto:sacredheartblessings@gmail.com" class="text-decoration-none">
                                            sacredheartblessings@gmail.com
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0" style="margin-right: 16px;">
                                    <i class="fas fa-phone-alt fa-2x text-danger"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">Call Us</h5>
                                    <p class="mb-0">+91 91596 96893<br>04574 267212</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <form action="forms/contact.php" method="post" role="form">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <label for="name">Full name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-floating">
                                            <label for="subject">Subject</label>
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>                                            
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-floating">
                                            <label for="message">Message</label>
                                            <textarea class="form-control" id="message" name="message" style="height: 150px" placeholder="Message" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="alert alert-success d-none" id="success-message">
                                            Your message has been sent. Thank you!
                                        </div>
                                        <div class="alert alert-danger d-none" id="error-message"></div>
                                    </div>
                                    <div class="col-12 text-center mt-2">
                                        <button type="submit" class="btn btn-danger btn-lg px-5">
                                            <i class="fas fa-paper-plane me-2"></i> Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="card shadow-sm mt-4">
                <div class="card-body p-0">
                    <div class="ratio ratio-21x9">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3932.0575941795505!2d78.38584871428053!3d9.761189179779953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b00e15d96c28b7f%3A0x2b32496c2e787fcb!2sSacred%20Heart%20Shrine!5e0!3m2!1sen!2sin!4v1648369561274!5m2!1sen!2sin"
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

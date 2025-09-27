<footer class="bg-dark text-light py-3 mt-5">
  <div class="container">
    <div class="row">
      <!-- Contact Info -->
      <div class="col-md-4 mb-4">
        <h5 class="mb-3">Contact Us</h5>
        <ul class="list-unstyled">
          <li class="mb-2">
            <i class="fas fa-map-marker-alt me-2"></i>
            Sacred Heart Shrine, Idaikattur, Sivagangai
          </li>
          <li class="mb-2">
            <i class="fas fa-phone me-2"></i>
            <a href="tel:+919159696893" class="text-light text-decoration-none">+91 91596 96893</a>
          </li>
          <li class="mb-2">
            <i class="fas fa-envelope me-2"></i>
            <a href="mailto:sacredheartblessing@gmail.com" class="text-light text-decoration-none">sacredheartblessing@gmail.com</a>
          </li>
          <li class="mb-2">
            <a href="https://www.youtube.com/channel/UCkj4XX11IQ-3uuqeOcFPZGA" class="text-light text-decoration-none" target="_blank"><i class="fab fa-youtube me-2"></i></a> Idaikattur Church Official
          </li>
        </ul>
      </div>

      <!-- Quick Links -->
      <div class="col-md-4 mb-4">
        <h5 class="mb-3">Quick Links</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="{{ url('/') }}" class="text-light text-decoration-none">Home</a></li>
          <li class="mb-2"><a href="{{ url('/about') }}" class="text-light text-decoration-none">About Us</a></li>
          <li class="mb-2"><a href="{{ url('/schedule') }}" class="text-light text-decoration-none">Mass Schedule</a></li>
          <li class="mb-2"><a href="{{ url('/gallery') }}" class="text-light text-decoration-none">Gallery</a></li>
          <li class="mb-2"><a href="{{ url('/contact') }}" class="text-light text-decoration-none">Contact</a></li>
        </ul>
      </div>

      <!-- Social Media -->
      <div class="col-md-4 mb-4">
        <h5 class="mb-3">Follow Us</h5>
        <div class="social-links">
          <a href="#" class="text-light me-3 text-decoration-none"><i class="fab fa-facebook-f fa-lg"></i></a>
          <a href="#" class="text-light me-3 text-decoration-none"><i class="fab fa-twitter fa-lg"></i></a>
          <a href="#" class="text-light me-3 text-decoration-none"><i class="fab fa-instagram fa-lg"></i></a>
          <a href="https://www.youtube.com/channel/UCkj4XX11IQ-3uuqeOcFPZGA" class="text-light text-decoration-none" target="_blank"><i class="fab fa-youtube fa-lg"></i></a>
        </div>
        <div class="mt-4">
          <h5 class="mb-3">Newsletter</h5>
          <form class="d-flex">
            <input type="email" class="form-control me-2" placeholder="Enter your email">
            <button type="submit" class="btn btn-outline-light">Subscribe</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Copyright -->
    <hr class="bg-light">
    <div class="text-center">
      <small>
        <i class="far fa-copyright"></i> {{ date('Y') }} Sacred Heart Shrine. All Rights Reserved
      </small>
    </div>
  </div>
</footer>
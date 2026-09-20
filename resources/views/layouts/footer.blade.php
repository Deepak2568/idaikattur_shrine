<footer class="sh-footer">
  <div class="container">
    <div class="row g-4 mb-2">
      <div class="col-12">
        <p class="mb-0" style="font-family: var(--sh-font-display); font-size: 1.6rem; color: #fff;">Sacred Heart Shrine</p>
        <p class="small mb-0" style="letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.55);">Idaikattur · Sivagangai</p>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <h5>Contact Us</h5>
        <ul class="list-unstyled mb-0">
          <li class="mb-2">
            <i class="fas fa-map-marker-alt me-2"></i>
            Sacred Heart Shrine, Idaikattur, Sivagangai
          </li>
          <li class="mb-2">
            <i class="fas fa-phone me-2"></i>
            <a href="tel:+919159696893">+91 91596 96893</a>
          </li>
          <li class="mb-2">
            <i class="fas fa-envelope me-2"></i>
            <a href="mailto:idaikatturchurch@gmail.com">idaikatturchurch@gmail.com</a>
          </li>
          <li class="mb-2">
            <a href="https://www.youtube.com/channel/UCkj4XX11IQ-3uuqeOcFPZGA" target="_blank" rel="noopener">
              <i class="fab fa-youtube me-2"></i>Idaikattur Church Official
            </a>
          </li>
        </ul>
      </div>

      <div class="col-md-4">
        <h5>Quick Links</h5>
        <ul class="list-unstyled mb-0">
          <li class="mb-2"><a href="{{ url('/') }}">Home</a></li>
          <li class="mb-2"><a href="{{ url('/about') }}">About Us</a></li>
          <li class="mb-2"><a href="{{ url('/schedule') }}">Mass Timings</a></li>
          <li class="mb-2"><a href="{{ url('/gallery') }}">Gallery</a></li>
          <li class="mb-2"><a href="{{ url('/contact') }}">Contact</a></li>
        </ul>
      </div>

      <div class="col-md-4">
        <h5>Follow Us</h5>
        <div class="social-links mb-4">
          <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
          <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="https://www.youtube.com/channel/UCkj4XX11IQ-3uuqeOcFPZGA" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        </div>
        <h5>Newsletter</h5>
        <form class="d-flex flex-column flex-sm-row gap-2" onsubmit="return false;">
          <input type="email" class="form-control" placeholder="Enter your email" aria-label="Email for newsletter">
          <button type="submit" class="btn btn-outline-light">Subscribe</button>
        </form>
      </div>
    </div>

    <hr class="my-4">
    <div class="text-center">
      <small>
        <i class="far fa-copyright"></i> {{ date('Y') }} Sacred Heart Shrine, Idaikattur. All Rights Reserved.
      </small>
    </div>
  </div>
</footer>

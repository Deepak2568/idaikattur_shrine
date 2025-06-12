<marquee behavior="scroll" direction="left" style="background-color: #000; color: #fff; padding: 10px;">
ஜூலை மாதம் 4 ஆம் தேதி மாதத்தின் முதல் வெள்ளிகிழமை. அன்று காலை 7 மணிக்கும், 11 மணிக்கும், மாலை 6 மணிக்கும் திருப்பலி நடைபெரும்.
July 4th, being the first Friday of the month, Holy Mass will be celebrated at 7:00 AM, 11:00 AM, and 6:00 PM.</marquee>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="{{ asset('images/idai1.png') }}" alt="" height="40" class="d-inline-block align-top">
      <span class="ml-2 font-weight-bold text-primary"><a href="{{ url('/') }}">SACRED HEART SHRINE</a></span>
    </a>
    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link px-3 text-dark" href="{{ url('/') }}">
            <i class="fas fa-home mr-1"></i>Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 text-dark" href="{{ url('/about') }}">
            <i class="fas fa-info-circle mr-1"></i>About
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 text-dark" href="{{ url('/gallery') }}">
            <i class="fas fa-images mr-1"></i>Gallery
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 text-dark" href="{{ url('/priest') }}">
            <i class="fas fa-user-tie mr-1"></i>Priests
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 text-dark" href="https://www.youtube.com/channel/UCkj4XX11IQ-3uuqeOcFPZGA" target="_blank">
            <i class="fab fa-youtube mr-1 text-danger"></i>YouTube
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3 text-dark" href="#" id="massDropdown" role="button" data-toggle="dropdown">
            <i class="fas fa-church mr-1"></i>Mass
          </a>
          <div class="dropdown-menu border-0 shadow-sm" aria-labelledby="massDropdown">
            <a class="dropdown-item py-2" href="{{ url('/videos') }}">
              <i class="fas fa-video mr-2"></i>Mass Videos
            </a>
            <a class="dropdown-item py-2" href="{{ url('/schedule') }}">
              <i class="fas fa-calendar-alt mr-2"></i>Mass Schedule
            </a>
            <a class="dropdown-item py-2" href="">
              <i class="fas fa-comments mr-2"></i>Mass Comments
            </a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 text-dark" href="{{ url('/contact') }}">
            <i class="fas fa-envelope mr-1"></i>Contact Us
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

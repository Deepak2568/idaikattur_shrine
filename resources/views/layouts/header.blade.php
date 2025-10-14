@php
    use Carbon\Carbon;

    $today = Carbon::now();

    // First day of this month
    $firstDayOfThisMonth = $today->copy()->startOfMonth();

    // Helper: get first Friday for a given month's first day
    $getFirstFriday = function (Carbon $firstDay) {
        $weekdayOfFirst = $firstDay->dayOfWeek; // 0 = Sunday ... 6 = Saturday
        $target = Carbon::FRIDAY;                // constant for Friday (5)
        $daysToAdd = ($target - $weekdayOfFirst + 7) % 7;
        return $firstDay->copy()->addDays($daysToAdd);
    };

    // First Friday of this month
    $firstFridayThisMonth = $getFirstFriday($firstDayOfThisMonth);

    // If today's after this month's first Friday, use next month's first Friday
    if ($today->gt($firstFridayThisMonth)) {
        $firstDayOfNextMonth = $today->copy()->startOfMonth()->addMonth();
        $firstFriday = $getFirstFriday($firstDayOfNextMonth);
    } else {
        $firstFriday = $firstFridayThisMonth;
    }

    // Formats
    $formattedDate = $firstFriday->format('F jS');      // e.g. "November 7th"
    $monthName     = $firstFriday->locale('ta')->translatedFormat('F'); // month in Tamil
    $day           = $firstFriday->day;
@endphp

<marquee behavior="scroll" direction="left" style="background: linear-gradient(90deg, #dc3545 0%, #ffc107 100%); color: #fff; padding: 12px 0; font-size: 1.15rem; font-weight: 600; letter-spacing: 1px; border-radius: 0 0 16px 16px; box-shadow: 0 4px 16px rgba(220,53,69,0.15); text-shadow: 1px 1px 4px rgba(0,0,0,0.25);">
  <span style="margin-right: 32px;">
    <i class="fas fa-church" style="color: #fff; margin-right: 8px;"></i>
    அன்பிற்குரியவர்களே நமது திருத்தலத்தில் ஒவ்வொரு நாளும் காலை 11 மணிக்கு திருப்பலி நடைபெறுகின்றது.
  </span>
  <span style="margin-right: 32px;">
    <i class="fas fa-calendar-day" style="color: #fff; margin-right: 8px;"></i>
    {{$monthName}} மாதம் {{$day}} ஆம் தேதி மாதத்தின் முதல் வெள்ளிகிழமை.
  </span>
  <span style="margin-right: 32px;">
    <i class="fas fa-clock" style="color: #fff; margin-right: 8px;"></i>
    அன்று காலை 7 மணிக்கும், 11 மணிக்கும், மாலை 6 மணிக்கும் திருப்பலி மற்றும் குணமளிக்கும் ஆராதனையும் நடைபெறும்.
  </span>
  <span style="margin-right: 32px;">
    <i class="fas fa-church" style="color: #fff; margin-right: 8px;"></i>
    Daily mass will be conducted at 11 am in our shrine.
  </span>
  <span style="margin-right: 32px;">
    <i class="fas fa-calendar-day" style="color: #fff; margin-right: 8px;"></i>
    {{$formattedDate}}, being the first Friday of the month.
  </span>
  <span>
    <i class="fas fa-clock" style="color: #fff; margin-right: 8px;"></i>
    On that day, rituals and blessings will be conducted at 7 AM, 11 AM, and 6 PM.
  </span>
</marquee>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-lg" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); border-bottom: 2px solid #e9ecef;">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" style="transition: all 0.3s ease;">
      <img src="{{ asset('images/idai1.png') }}" alt="Sacred Heart Shrine" height="65" class="d-inline-block align-top me-3" style="filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2)); transform: scale(1.2); border-radius: 8px;">
      <span class="fw-bold text-danger fs-4" style="text-shadow: 0 1px 2px rgba(0,0,0,0.1); letter-spacing: 0.5px;">SACRED HEART SHRINE</span>
    </a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link px-2 text-dark fw-semibold position-relative d-flex align-items-center" href="{{ url('/') }}" style="transition: all 0.3s ease; border-radius: 8px; margin: 0 1px; white-space: nowrap;">
              <i class="fas fa-home me-1" style="color: #dc3545;"></i>Home
              <span class="nav-hover-effect"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-2 text-dark fw-semibold position-relative d-flex align-items-center" href="{{ url('/about') }}" style="transition: all 0.3s ease; border-radius: 8px; margin: 0 1px; white-space: nowrap;">
              <i class="fas fa-info-circle me-1" style="color: #dc3545;"></i>About
              <span class="nav-hover-effect"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-2 text-dark fw-semibold position-relative d-flex align-items-center" href="{{ url('/schedule') }}" style="transition: all 0.3s ease; border-radius: 8px; margin: 0 1px; white-space: nowrap;">
                <i class="fas fa-calendar-alt me-2" style="color: #dc3545;"></i>Mass Schedule
                <span class="nav-hover-effect"></span>
              </a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-2 text-dark fw-semibold position-relative d-flex align-items-center" href="{{ url('/gallery') }}" style="transition: all 0.3s ease; border-radius: 8px; margin: 0 1px; white-space: nowrap;">
              <i class="fas fa-images me-1" style="color: #dc3545;"></i>Gallery
              <span class="nav-hover-effect"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-2 text-dark fw-semibold position-relative d-flex align-items-center" href="{{ url('/priest') }}" style="transition: all 0.3s ease; border-radius: 8px; margin: 0 1px; white-space: nowrap;">
              <i class="fas fa-user-tie me-1" style="color: #dc3545;"></i>Priests
              <span class="nav-hover-effect"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-2 text-dark fw-semibold position-relative d-flex align-items-center" href="https://www.youtube.com/channel/UCkj4XX11IQ-3uuqeOcFPZGA" target="_blank" style="transition: all 0.3s ease; border-radius: 8px; margin: 0 1px; white-space: nowrap;">
              <i class="fab fa-youtube me-1" style="color: #dc3545;"></i>YouTube
              <span class="nav-hover-effect"></span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle px-2 text-dark fw-semibold position-relative d-flex align-items-center" href="#" id="massDropdown" role="button" data-bs-toggle="dropdown" style="transition: all 0.3s ease; border-radius: 8px; margin: 0 1px; white-space: nowrap;">
              <i class="fas fa-church me-1" style="color: #dc3545;"></i>Mass
              <span class="nav-hover-effect"></span>
            </a>
            <div class="dropdown-menu border-0 shadow-lg" aria-labelledby="massDropdown" style="border-radius: 12px; padding: 8px; min-width: 200px; background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
              <a class="dropdown-item py-3 px-3 fw-semibold d-flex align-items-center" href="{{ url('/videos') }}" style="border-radius: 8px; transition: all 0.3s ease; margin: 2px 0;">
                <i class="fas fa-video me-2" style="color: #dc3545;"></i>Mass Videos
              </a>
              <!--<a class="dropdown-item py-3 px-3 fw-semibold d-flex align-items-center" href="{{ url('/schedule') }}" style="border-radius: 8px; transition: all 0.3s ease; margin: 2px 0;">-->
              <!--  <i class="fas fa-calendar-alt me-2" style="color: #dc3545;"></i>Mass Schedule-->
              <!--</a>-->
              <!-- <a class="dropdown-item py-3 px-3 fw-semibold d-flex align-items-center" href="{{ url('/comments') }}" style="border-radius: 8px; transition: all 0.3s ease; margin: 2px 0;">
                <i class="fas fa-comments me-2" style="color: #dc3545;"></i>Mass Comments
              </a> -->
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link px-2 text-dark fw-semibold position-relative d-flex align-items-center" href="{{ url('/contact') }}" style="transition: all 0.3s ease; border-radius: 8px; margin: 0 1px; white-space: nowrap;">
              <i class="fas fa-envelope me-1" style="color: #dc3545;"></i>Contact Us
              <span class="nav-hover-effect"></span>
            </a>
          </li>
          <!--<li class="nav-item">-->
          <!--  <a class="nav-link px-2 text-dark fw-semibold position-relative d-flex align-items-center" href="{{ url('/matrimony') }}" style="transition: all 0.3s ease; border-radius: 8px; margin: 0 1px; white-space: nowrap;">-->
          <!--    <i class="fas fa-heart me-1" style="color: #dc3545;"></i>Matrimony-->
          <!--    <span class="nav-hover-effect"></span>-->
          <!--  </a>-->
          <!--</li>-->
        </ul>
    </div>
  </div>
</nav>

<style>
/* Navbar hover effects */
.navbar-nav .nav-link:hover {
  background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
  color: white !important;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

.navbar-nav .nav-link:hover i {
  color: white !important;
  transform: scale(1.1);
}

/* Dropdown hover effects */
.dropdown-item:hover {
  background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
  color: white !important;
  transform: translateX(5px);
  box-shadow: 0 2px 8px rgba(220, 53, 69, 0.2);
}

.dropdown-item:hover i {
  color: white !important;
  transform: scale(1.1);
}

/* Navbar brand hover effect */
.navbar-brand:hover {
  transform: scale(1.05);
}

/* Active state styling */
.navbar-nav .nav-link.active {
  background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
  color: white !important;
  box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

.navbar-nav .nav-link.active i {
  color: white !important;
}

/* Smooth transitions */
.navbar-nav .nav-link,
.dropdown-item,
.navbar-brand {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Icon animations */
.navbar-nav .nav-link i,
.dropdown-item i {
  transition: all 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
  .navbar-nav .nav-link {
    margin: 4px 0;
    padding: 12px 16px !important;
  }

  .dropdown-menu {
    border: none;
    box-shadow: none;
    background: transparent;
  }

  .dropdown-item {
    background: rgba(220, 53, 69, 0.1);
    margin: 2px 0;
    border-radius: 8px;
  }
}

/* Navbar shadow animation */
.navbar {
  transition: box-shadow 0.3s ease;
}

.navbar:hover {
  box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}
</style>

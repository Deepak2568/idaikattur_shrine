@php
    use Carbon\Carbon;

    $today = Carbon::now();
    $firstDayOfThisMonth = $today->copy()->startOfMonth();

    $getFirstFriday = function (Carbon $firstDay) {
        $weekdayOfFirst = $firstDay->dayOfWeek;
        $target = Carbon::FRIDAY;
        $daysToAdd = ($target - $weekdayOfFirst + 7) % 7;
        return $firstDay->copy()->addDays($daysToAdd);
    };

    $firstFridayThisMonth = $getFirstFriday($firstDayOfThisMonth);

    if ($today->gt($firstFridayThisMonth)) {
        $firstDayOfNextMonth = $today->copy()->startOfMonth()->addMonth();
        $firstFriday = $getFirstFriday($firstDayOfNextMonth);
    } else {
        $firstFriday = $firstFridayThisMonth;
    }

    $formattedDate = $firstFriday->format('F jS');
    $monthName = $firstFriday->locale('ta')->translatedFormat('F');
    $day = $firstFriday->day;
@endphp

<div class="sh-announce" role="region" aria-label="Shrine announcements">
  <div class="sh-announce__glow" aria-hidden="true"></div>
  <div class="sh-announce__track">
    <span class="sh-announce__item sh-announce__item--rose">
      <i class="fas fa-church"></i>
      <em>அன்பிற்குரியவர்களே</em> நமது திருத்தலத்தில் ஒவ்வொரு நாளும் காலை <b>11 மணிக்கு</b> திருப்பலி நடைபெறுகின்றது.
    </span>
    <span class="sh-announce__sep" aria-hidden="true">✦</span>
    <span class="sh-announce__item sh-announce__item--amber">
      <i class="fas fa-calendar-day"></i>
      <b>{{ $monthName }} மாதம் {{ $day }} ஆம் தேதி</b> மாதத்தின் முதல் வெள்ளிகிழமை.
    </span>
    <span class="sh-announce__sep" aria-hidden="true">✦</span>
    <span class="sh-announce__item sh-announce__item--sky">
      <i class="fas fa-clock"></i>
      அன்று காலை <b>7 மணி</b>, <b>11 மணி</b>, மாலை <b>6 மணி</b> க்கு திருப்பலி மற்றும் குணமளிக்கும் ஆராதனையும் நடைபெறும்.
    </span>
    <span class="sh-announce__sep" aria-hidden="true">✦</span>
    <span class="sh-announce__item sh-announce__item--mint">
      <i class="fas fa-church"></i>
      Daily mass will be conducted at <b>11 am</b> in our shrine.
    </span>
    <span class="sh-announce__sep" aria-hidden="true">✦</span>
    <span class="sh-announce__item sh-announce__item--gold">
      <i class="fas fa-calendar-day"></i>
      <b>{{ $formattedDate }}</b>, being the first Friday of the month.
    </span>
    <span class="sh-announce__sep" aria-hidden="true">✦</span>
    <span class="sh-announce__item sh-announce__item--lilac">
      <i class="fas fa-clock"></i>
      Rituals and blessings at <b>7 AM</b>, <b>11 AM</b>, and <b>6 PM</b>.
    </span>
  </div>
</div>

<nav class="navbar navbar-expand-lg sh-nav sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <img src="{{ asset('images/idai1.png') }}" alt="Sacred Heart Shrine">
      <span class="sh-brand-text">
        <strong>Sacred Heart Shrine</strong>
        <small>Idaikattur</small>
      </span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}"><i class="fas fa-info-circle me-1"></i>About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('schedule') ? 'active' : '' }}" href="{{ url('/schedule') }}"><i class="fas fa-calendar-alt me-1"></i>Mass Schedule</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('gallery') ? 'active' : '' }}" href="{{ url('/gallery') }}"><i class="fas fa-images me-1"></i>Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('priest') ? 'active' : '' }}" href="{{ url('/priest') }}"><i class="fas fa-user-tie me-1"></i>Priests</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.youtube.com/channel/UCkj4XX11IQ-3uuqeOcFPZGA" target="_blank" rel="noopener"><i class="fab fa-youtube me-1"></i>YouTube</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ request()->is('videos') ? 'active' : '' }}" href="#" id="massDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-church me-1"></i>Mass
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="massDropdown">
            <li>
              <a class="dropdown-item" href="{{ url('/videos') }}"><i class="fas fa-video me-2"></i>Mass Videos</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('matrimony') ? 'active' : '' }}" href="{{ url('/matrimony') }}"><i class="fas fa-heart me-1"></i>Matrimony</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}"><i class="fas fa-envelope me-1"></i>Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

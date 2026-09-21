@extends('layouts.app',['title' => 'Home'])

@section('content')
@php
    use App\Models\Setting;
    $homeSettings = Setting::orderByDesc('updated_at')->first();
    $eventDate = $homeSettings?->event_date ?? now()->addMonth()->toDateString();
    $displayText = $homeSettings?->display_text ?? 'Idaikattur Shrine';
@endphp

<section class="sh-home-hero" style="background-image: url('{{ asset('images/shs.png') }}');">
  <div class="sh-home-hero__overlay"></div>
  <div class="container sh-animate-in">
    <div class="row">
      <div class="col-lg-8 col-xl-7">
        <p class="lead-date">{{ \Carbon\Carbon::parse($eventDate)->format('d M Y') }}</p>
        <h1>{{ $displayText }}</h1>

        <div class="sh-countdown" aria-live="polite">
          <div class="sh-countdown__item">
            <span class="sh-countdown__value" id="days">0</span>
            <span class="sh-countdown__label">Days</span>
          </div>
          <div class="sh-countdown__item">
            <span class="sh-countdown__value" id="hours">0</span>
            <span class="sh-countdown__label">Hours</span>
          </div>
          <div class="sh-countdown__item">
            <span class="sh-countdown__value" id="minutes">0</span>
            <span class="sh-countdown__label">Minutes</span>
          </div>
          <div class="sh-countdown__item">
            <span class="sh-countdown__value" id="seconds">0</span>
            <span class="sh-countdown__label">Seconds</span>
          </div>
        </div>

        <p class="sh-home-quote">எமது இதய அன்பில் நிலைத்திருந்தால் எல்லா நன்மைகளும் பெறுவீர்கள்"</p>
        <p class="sh-home-quote">இயேசுவின் திரு இருதய ஆண்டவர் திருத்தலம் - இடைக்காட்டூர்</p>
        <p class="sh-home-quote mb-0">Sacred Heart of Jesus Shrine — Idaikattur</p>
      </div>
    </div>
  </div>
</section>

<section class="sh-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="sh-donate-cta sh-animate-in">
          <p class="sh-donate-cta__eyebrow">New</p>
          <h2 class="sh-donate-cta__title">Support Sacred Heart Shrine</h2>
          <p class="sh-donate-cta__text">If you wish to donate to the shrine, share your interest. Online payment will be available soon.</p>
          <a href="{{ url('/donate') }}" class="btn btn-danger btn-lg px-4">
            <i class="fas fa-donate me-2"></i> Donation interest
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sh-section pt-0">
  <div class="container">
    <h2 class="sh-section-title sh-animate-in">Blessings</h2>
    <p class="sh-section-lead">Messages from our bishop and parish priest.</p>
    <div class="row g-4 sh-blessing-grid sh-animate-in-delay">
      <div class="col-lg-6">
        <article class="sh-blessing">
          <div class="sh-blessing__photo">
            <img src="{{ asset('images/bishop.jpg') }}" alt="Bishop Rev.Fr.Lourdu Anantham">
          </div>
          <div class="sh-blessing__body">
            <p class="sh-blessing__eyebrow">From the Diocese</p>
            <h3 class="sh-blessing__title">Bishop Message</h3>
            <p class="sh-blessing__message">I am extremely happy to share that the Sacred Heart of Jesus Shrine website is now online. I am confident that it will help people learn more about the Sacred Heart of Jesus and the marvelous happenings taking place here. May all pilgrims who visit this holy place continue to receive God’s blessings through the loving intercession of the Blessed Mother of God.</p>
            <footer class="sh-blessing__sign">
              <p class="sh-blessing__closing">With prayers and blessings</p>
              <p class="sh-blessing__name">Bishop Rev. Fr. Lourdu Anantham</p>
              <p class="sh-blessing__role">Sivagangai Diocese</p>
            </footer>
          </div>
        </article>
      </div>
      <div class="col-lg-6">
        <article class="sh-blessing">
          <div class="sh-blessing__photo">
            <img src="{{ asset('images/jvk.jpg') }}" alt="Rev.Fr.S.John Vasantha Kumar">
          </div>
          <div class="sh-blessing__body">
            <p class="sh-blessing__eyebrow">From the Parish</p>
            <h3 class="sh-blessing__title">Parish Priest Message</h3>
            <p class="sh-blessing__message">I am extremely happy to share that the Sacred Heart of Jesus Shrine website is now online. I am sure it will help people learn more about the Sacred Heart of Jesus and the marvelous happenings taking place here.</p>
            <footer class="sh-blessing__sign">
              <p class="sh-blessing__closing">With prayers and blessings</p>
              <p class="sh-blessing__name">Rev. Fr. S. John Vasantha Kumar</p>
              <p class="sh-blessing__role">Parish Priest</p>
            </footer>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>

<section class="sh-section pt-0">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card">
          <div class="card-header bg-danger text-white text-center fw-semibold">
            <i class="fas fa-bullhorn me-2"></i>
            Announcements & Mass Schedule
          </div>
          <div class="card-body p-0">
            <div style="height:190px; position:relative;">
              <marquee direction="up" scrollamount="4" onmouseover="this.stop();" onmouseout="this.start();" style="height: 190px; padding: 1rem 1.5rem;">
                <div class="mb-2 d-flex align-items-start">
                  <i class="fas fa-church text-danger me-2 mt-1"></i>
                  <div><b>Daily Mass:</b> 11:00 AM (Shrine)</div>
                </div>
                <div class="mb-2 d-flex align-items-start">
                  <i class="fas fa-calendar-day text-warning me-2 mt-1"></i>
                  <div><b>First Friday of the Month:</b> Special Mass at 7:00 AM, 11:00 AM, and 6:00 PM</div>
                </div>
                <div class="mb-2 d-flex align-items-start">
                  <i class="fas fa-clock text-danger me-2 mt-1"></i>
                  <div><b>Adoration & Healing Service:</b> All Fridays after each mass</div>
                </div>
                <div class="mb-2 d-flex align-items-start">
                  <i class="fas fa-church text-success me-2 mt-1"></i>
                  <div><b>Sunday Mass:</b> 8:30 AM & 11:00 AM</div>
                </div>
                <div class="mb-2 d-flex align-items-start">
                  <i class="fas fa-info-circle text-info me-2 mt-1"></i>
                  <div>Special prayers and intentions can be submitted at the Shrine Office.</div>
                </div>
                <div class="d-flex align-items-start">
                  <i class="fas fa-calendar-alt text-secondary me-2 mt-1"></i>
                  <div><b>Confession:</b> Available before each Mass</div>
                </div>
              </marquee>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var countDownDate = new Date("{{ $eventDate }}T00:00:00").getTime();

    function updateCountdown() {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        if (distance < 0) {
            document.getElementById('days').textContent = '0';
            document.getElementById('hours').textContent = '0';
            document.getElementById('minutes').textContent = '0';
            document.getElementById('seconds').textContent = '0';
            return;
        }

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('days').textContent = days;
        document.getElementById('hours').textContent = hours;
        document.getElementById('minutes').textContent = minutes;
        document.getElementById('seconds').textContent = seconds;
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
});
</script>
@endsection

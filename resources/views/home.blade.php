@extends('layouts.app',['title' => 'Home'])

@section('content')
@php
    use App\Models\Setting;
    $homeSettings = Setting::orderByDesc('updated_at')->first();
    $eventDate = $homeSettings->event_date;
@endphp
<!-- Hero Section -->
<div class="bg-primary text-center py-5" style="background: url('{{ asset('images/shs.png') }}') no-repeat center center; background-size: cover; color: white; position: relative;">
  <div class="overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(29, 233, 182, 0.8) 0%, rgba(183, 33, 255, 0.8) 100%);"></div>
  <div class="container" style="position: relative; z-index: 1;">
    <div class="row align-items-center">
      <div class="col-md-3">
        <!-- <img src="{{ asset('images/shs.png') }}" alt="Left Image" class="img-fluid"> -->
      </div>
      <div class="col-md-6">
        <h3 class="display-6 text-uppercase fw-bold mb-3" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">{{$homeSettings->display_text}}</h3>
        <p class="lead mb-4 fw-bold" style="font-size:2.5rem; letter-spacing: 2px;">
            {{ \Carbon\Carbon::parse($eventDate)->format('d-m-Y') }}
        </p>
        <div class="d-flex justify-content-center mb-4">
            <div class="mx-3 text-center">
                <div class="h2 bg-white text-primary rounded-circle p-3 shadow-sm" style="width: 80px; height: 80px; line-height: 50px;" id="days">0</div>
                <small class="text-white fw-bold mt-2 d-block" style="font-size: 0.9rem; letter-spacing: 1px;">Days</small>
            </div>
            <div class="mx-3 text-center">
                <div class="h2 bg-white text-primary rounded-circle p-3 shadow-sm" style="width: 80px; height: 80px; line-height: 50px;" id="hours">0</div>
                <small class="text-white fw-bold mt-2 d-block" style="font-size: 0.9rem; letter-spacing: 1px;">Hours</small>
            </div>
            <div class="mx-3 text-center">
                <div class="h2 bg-white text-primary rounded-circle p-3 shadow-sm" style="width: 80px; height: 80px; line-height: 50px;" id="minutes">0</div>
                <small class="text-white fw-bold mt-2 d-block" style="font-size: 0.9rem; letter-spacing: 1px;">Minutes</small>
            </div>
            <div class="mx-3 text-center">
                <div class="h2 bg-white text-primary rounded-circle p-3 shadow-sm" style="width: 80px; height: 80px; line-height: 50px;" id="seconds">0</div>
                <small class="text-white fw-bold mt-2 d-block" style="font-size: 0.9rem; letter-spacing: 1px;">Seconds</small>
            </div>
        </div>
        <p class="text-white fw-bold" style="font-size: 16px;">எமது இதய அன்பில் நிலைத்திருந்தால் எல்லா நன்மைகளும் பெறுவீர்கள்"</p>
        <p class="text-white fw-bold" style="font-size: 16px;">இயேசுவின் திரு இருதய ஆண்டவர் திருத்தலம் - IDAIKATTUR</p>
        <p class="text-white fw-bold" style="font-size: 16px;">இடைக்காட்டூர், சிவகங்கை.</p>
        <p class="text-white fw-bold" style="font-size: 16px;">SACRED HEART OF JESUS SHRINE - IDAIKATTUR</p>
      </div>
      <div class="col-md-3">
        <!-- <img src="{{ asset('images/jvk.jpg') }}" alt="Right Image" class="img-fluid"> -->
      </div>
    </div>
  </div>
</div>

<!-- Blessings Section -->
<div class="container my-5">
  <h3>Blessings</h3>
  <div class="row">
    <div class="col-md-6 mb-4">
      <div class="card">
        <img src="{{ asset('images/bishop.jpg') }}" class="card-img-top" alt="Bishop" style="height: 200px; object-fit: scale-down;">
        <div class="card-body text-center">
          <i class="fas fa-cross fa-2x mb-2"></i>
          <h5 class="card-title">Bishop Message</h5>
          <p class="card-text">I am extremely happy to share that the Sacred Heart of Jesus Shrine website is now online. I am confident that it will help people learn more about the Sacred Heart of Jesus and the marvelous happenings taking place here. May all pilgrims who visit this holy place continue to receive God’s blessings through the loving intercession of the Blessed Mother of God.</p>
          <p class="text-danger fw-bold small">With prayers and blessings<br>Bishop Rev.Fr.Lourdu Anantham,<br>Sivagangai Diocese</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-4">
      <div class="card">
        <img src="{{ asset('images/jvk.jpg') }}" class="card-img-top" alt="Parish Priest" style="height: 200px; object-fit: scale-down;">
        <div class="card-body text-center">
          <i class="fas fa-church fa-2x mb-2"></i>
          <h5 class="card-title">Parish Priest Message</h5>
          <p class="card-text">I am extremely happy to share that the Sacred Heart of Jesus Shrine website is now online. I am sure it will help people learn more about the Sacred Heart of Jesus and the marvelous happenings taking place here.</p>
          <p class="text-primary fw-bold small">With prayers and blessings<br>Rev.Fr.S.John Vasantha Kumar,<br>Pariesh Priest</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set the date we're counting down to (YYYY-MM-DD format)

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

    updateCountdown(); // Initial call
    setInterval(updateCountdown, 1000); // Update every second
});
</script>
@endsection

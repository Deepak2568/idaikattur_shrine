<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sacred Heart Shrine - {{ $title ?? 'Home' }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#0f3d3e">
  <link rel="icon" type="image/png" href="{{ asset('images/home_page.jpeg') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/home_page.jpeg') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  @production
  <link rel="stylesheet" href="{{ url('/public/css/shrine-theme.css') }}?v=14">
  @else
  <link rel="stylesheet" href="{{ asset('css/shrine-theme.css') }}?v=14">
  @endproduction
  @yield('styles')
</head>
<body>
  @include('layouts.header')
  <main id="main-content">
    @yield('content')
  </main>
  @include('layouts.footer')

  @unless(request()->is('donate'))
  <div id="donatePrompt" class="sh-donate-banner" hidden role="region" aria-label="Donation interest">
    <div class="sh-donate-banner__inner">
      <div class="sh-donate-banner__text">
        <strong><i class="fas fa-donate me-1" aria-hidden="true"></i> Support Sacred Heart Shrine</strong>
        <span>Share your donation interest. Online payment coming soon.</span>
      </div>
      <div class="sh-donate-banner__actions">
        <a href="{{ url('/donate') }}" class="btn btn-sm btn-danger">Donate</a>
        <button type="button" class="sh-donate-banner__close" id="donatePromptClose" aria-label="Dismiss">
          <i class="fas fa-times" aria-hidden="true"></i>
        </button>
      </div>
    </div>
  </div>
  @endunless

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @unless(request()->is('donate'))
  <script>
  (function () {
    var key = 'shrine_donate_prompt_dismissed_at';
    var banner = document.getElementById('donatePrompt');
    if (!banner) return;

    var dismissedAt = 0;
    try { dismissedAt = parseInt(localStorage.getItem(key) || '0', 10) || 0; } catch (e) {}

    var oneDayMs = 24 * 60 * 60 * 1000;
    if (Date.now() - dismissedAt < oneDayMs) return;

    banner.hidden = false;

    var closeBtn = document.getElementById('donatePromptClose');
    if (closeBtn) {
      closeBtn.addEventListener('click', function () {
        banner.hidden = true;
        try { localStorage.setItem(key, String(Date.now())); } catch (e) {}
      });
    }
  })();
  </script>
  @endunless
  @yield('scripts')
</body>
</html>

@extends('layouts.app',['title'=>'Mass Videos'])
@section('content')
<section class="sh-page-hero" style="background-image: url('{{ asset('images/shs.png') }}');">
    <div class="container sh-animate-in">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold">Mass Videos</h1>
                <p class="lead">Watch special novena and Sunday masses</p>
            </div>
        </div>
    </div>
</section>

<div class="container sh-section">
    <div class="row g-4">
        @php
            $videos = [
                ['src' => 'https://www.youtube.com/embed/ffQn_nO2Xj8', 'title' => 'அக்டோபர் 2 ஆம் வெள்ளி சிறப்பு நவநாள்'],
                ['src' => 'https://www.youtube.com/embed/zMM91TSlqfE', 'title' => 'செப்டம்பர் 4ஆம் வெள்ளி சிறப்பு நவநாள்'],
                ['src' => 'https://www.youtube.com/embed/wxjUs0t-iH8', 'title' => '5th Friday Special Novena Mass'],
                ['src' => 'https://www.youtube.com/embed/dcEboTWizMI', 'title' => 'ஞாயிறு திருப்பலி'],
                ['src' => 'https://www.youtube.com/embed/ufICXrd9nJU', 'title' => 'செப்டம்பர் முதல் வெள்ளி'],
                ['src' => 'https://www.youtube.com/embed/OMSZ_n2QMTs', 'title' => 'சிறப்பு நற்கருணை ஆராதனை'],
                ['src' => 'https://www.youtube.com/embed/PefE3xXOJfA', 'title' => 'ஆகஸ்ட் 3வது வெள்ளி திருப்பலி'],
                ['src' => 'https://www.youtube.com/embed/K-WoMF_Qq-w', 'title' => 'ஆகஸ்ட் 1 வெள்ளி மாலை திருப்பலி'],
                ['src' => 'https://www.youtube.com/embed/ph2N4iY7uJA', 'title' => '2ஆம் வெள்ளி சிறப்பு நவநாள்'],
                ['src' => 'https://www.youtube.com/embed/FzlS3GvJFSk', 'title' => 'First Friday meditation'],
                ['src' => 'https://www.youtube.com/embed/aGokdzDdDUA', 'title' => 'திரு இருதய மாதம் 12ஆம் நாள்'],
                ['src' => 'https://www.youtube.com/embed/zsPRLXAHhS4', 'title' => 'Mass video'],
                ['src' => 'https://www.youtube.com/embed/FeKGYxbtBY4', 'title' => 'Mass video'],
                ['src' => 'https://www.youtube.com/embed/YXHvzp48LC8', 'title' => 'Mass video'],
                ['src' => 'https://www.youtube.com/embed/w1bXgJu023s', 'title' => 'Mass video'],
                ['src' => 'https://www.youtube.com/embed/wIF9SjTWo-s', 'title' => 'திரு இருதய மாதம் 11 ஆம் நாள்'],
                ['src' => 'https://www.youtube.com/embed/23WOgRdqZWo', 'title' => 'Mass video'],
                ['src' => 'https://www.youtube.com/embed/R8CHoqFX2-k', 'title' => 'Mass video'],
            ];
        @endphp

        @foreach($videos as $video)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 overflow-hidden">
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ $video['src'] }}" title="{{ $video['title'] }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="card-body py-3">
                        <p class="mb-0 small fw-semibold">{{ $video['title'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

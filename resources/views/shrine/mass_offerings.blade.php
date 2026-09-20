@extends('layouts.app', ['title' => 'Mass Offerings'])

@section('content')
<section class="sh-page-hero" style="background-image: url('{{ asset('images/shs.png') }}');">
    <div class="container sh-animate-in">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold">Mass Offerings</h1>
                <p class="lead">Offer intentions and support the Sacred Heart Shrine</p>
            </div>
        </div>
    </div>
</section>

<div class="container sh-section">
    <div class="row justify-content-center">
        <div class="col-lg-7 text-center">
            <div class="sh-coming-soon">
                <p class="sh-coming-soon__eyebrow">Sacred Heart Shrine</p>
                <h2 class="sh-coming-soon__title">Coming Soon</h2>
                <p class="sh-coming-soon__text mb-0">
                    Mass offerings will be available here shortly. Please check back soon, or contact the shrine office for intentions in the meantime.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app', ['title' => 'Mass Schedule'])

@section('content')
<section class="sh-page-hero" style="background-image: url('{{ asset('images/shs.png') }}');">
    <div class="container sh-animate-in">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold">Mass Schedule</h1>
                <p class="lead">Join us in prayer and worship at Sacred Heart Shrine</p>
            </div>
        </div>
    </div>
</section>

<div class="container sh-section">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 fs-5"><i class="fas fa-calendar-alt me-2"></i> Friday Mass</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive mb-0">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Day</th>
                                    <th>Timing</th>
                                    <th>Intention</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-danger">1<sup>st</sup></span></td>
                                    <td>7 AM, 11 AM, 6 PM</td>
                                    <td>General</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-danger">2<sup>nd</sup></span></td>
                                    <td>11 AM, 6:30 PM</td>
                                    <td>Maternity & Marriage</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-danger">3<sup>rd</sup></span></td>
                                    <td>11 AM, 6:30 PM</td>
                                    <td>Patients</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-danger">4<sup>th</sup></span></td>
                                    <td>11 AM, 6:30 PM</td>
                                    <td>Education & Work</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-danger">5<sup>th</sup></span></td>
                                    <td>11 AM, 6:30 PM</td>
                                    <td>General</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 fs-5"><i class="fas fa-sun me-2"></i> Sunday Mass</h4>
                </div>
                <div class="card-body">
                    <div class="sh-stat border-0 shadow-none p-3 mb-0" style="background: var(--sh-teal-soft);">
                        <p class="text-uppercase small fw-semibold mb-2" style="color: var(--sh-teal); letter-spacing: 0.08em;">All Sundays</p>
                        <p class="h4 mb-2" style="color: var(--sh-teal);">8:30 AM &amp; 11:00 AM</p>
                        <p class="mb-0 text-muted">Prayers for general peoples</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 fs-5"><i class="fas fa-calendar-week me-2"></i> Weekdays</h4>
                </div>
                <div class="card-body">
                    <div class="sh-stat border-0 shadow-none p-3 mb-0" style="background: var(--sh-bg-soft);">
                        <p class="text-uppercase small fw-semibold mb-2" style="color: var(--sh-teal); letter-spacing: 0.08em;">Mon – Sat</p>
                        <p class="h4 mb-2" style="color: var(--sh-teal);">11:00 AM</p>
                        <p class="mb-0 text-muted">Daily mass at the shrine</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

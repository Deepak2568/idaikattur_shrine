@extends('layouts.app', ['title' => 'Mass Timings'])

@section('content')
<section class="sh-page-hero" style="background-image: url('{{ asset('images/shs.png') }}');">
    <div class="container sh-animate-in">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold">Mass Timings</h1>
                <p class="lead">Join us in prayer and worship at Sacred Heart Shrine</p>
            </div>
        </div>
    </div>
</section>

<div class="container sh-section">
    <div class="row g-4 align-items-stretch">
        <div class="col-lg-5">
            <div class="card h-100 sh-schedule-card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 fs-5 text-white"><i class="fas fa-calendar-alt me-2"></i>Friday Mass</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive mb-0">
                        <table class="table table-hover mb-0 sh-schedule-table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 22%;">Day</th>
                                    <th scope="col" style="width: 40%;">Timing</th>
                                    <th scope="col" style="width: 38%;">Intention</th>
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
                                    <td>11 AM, 6 PM</td>
                                    <td>Maternity &amp; Marriage</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-danger">3<sup>rd</sup></span></td>
                                    <td>11 AM, 6 PM</td>
                                    <td>Patients</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-danger">4<sup>th</sup></span></td>
                                    <td>11 AM, 6 PM</td>
                                    <td>Education &amp; Work</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-danger">5<sup>th</sup></span></td>
                                    <td>11 AM, 6 PM</td>
                                    <td>General</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="row g-4 h-100">
                <div class="col-md-6">
                    <div class="card h-100 sh-schedule-card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0 fs-5 text-white"><i class="fas fa-sun me-2"></i>Sunday Mass</h4>
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <div class="sh-schedule-panel w-100">
                                <p class="sh-schedule-panel__label">All Sundays</p>
                                <p class="sh-schedule-panel__time">8:30 AM &amp; 11:00 AM</p>
                                <p class="sh-schedule-panel__note mb-0">Prayers for general peoples</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 sh-schedule-card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0 fs-5 text-white"><i class="fas fa-calendar-week me-2"></i>Weekdays</h4>
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <div class="sh-schedule-panel w-100">
                                <p class="sh-schedule-panel__label">Mon – Sat</p>
                                <p class="sh-schedule-panel__time">11:00 AM</p>
                                <p class="sh-schedule-panel__note mb-0">Daily mass at the shrine</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

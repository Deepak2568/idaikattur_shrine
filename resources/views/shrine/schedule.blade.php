@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-5">
                <h2 class="display-4 text-danger font-weight-bold">Mass Schedule</h2>
                <p class="lead text-muted">Join us in prayer and worship</p>
            </div>

            <!-- Friday Mass Schedule -->
            <div class="card shadow-sm mb-5">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-calendar-alt mr-2"></i> Friday Mass</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Days</th>
                                    <th>Mass Timing</th>
                                    <th>Importance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge badge-danger text-dark">1<sup>st</sup> Friday</span></td>
                                    <td><i class="far fa-clock text-primary mr-2"></i> 7 A.M, 11 A.M, 6 P.M</td>
                                    <td>Prayers for General Peoples</td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-danger text-dark">2<sup>nd</sup> Friday</span></td>
                                    <td><i class="far fa-clock text-primary mr-2"></i> 11 A.M, 6.30 P.M</td>
                                    <td>Prayers for Maternity and Marriage Alliances</td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-danger text-dark">3<sup>rd</sup> Friday</span></td>
                                    <td><i class="far fa-clock text-primary mr-2"></i> 11 A.M, 6.30 P.M</td>
                                    <td>Prayers for Patients</td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-danger text-dark">4<sup>th</sup> Friday</span></td>
                                    <td><i class="far fa-clock text-primary mr-2"></i> 11 A.M, 6.30 P.M</td>
                                    <td>Prayers for Educational and Industrial growths</td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-danger text-dark">5<sup>th</sup> Friday</span></td>
                                    <td><i class="far fa-clock text-primary mr-2"></i> 11 A.M, 6.30 P.M</td>
                                    <td>Prayers for General Peoples</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sunday Mass Schedule -->
            <div class="card shadow-sm mb-5">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-sun mr-2"></i> Sunday Mass</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Days</th>
                                    <th>Mass Timing</th>
                                    <th>Importance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge badge-success text-dark">All Sundays</span></td>
                                    <td><i class="far fa-clock text-primary mr-2"></i> 8.30 A.M, 11 A.M</td>
                                    <td>Prayers for General Peoples</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Weekday Mass Schedule -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-calendar-week mr-2"></i> Week Days</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Days</th>
                                    <th>Mass Timing</th>
                                    <th>Importance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge badge-info text-dark">All Weekdays</span></td>
                                    <td><i class="far fa-clock text-primary mr-2"></i> 11 A.M</td>
                                    <td>Prayers for General Peoples</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app',["title"=>"Admin Dashboard"])
@section('content')
<div class="container py-4">
    <div class="d-flex gap-2 mb-4 justify-content-end">
        <a href="{{ route('settings.home') }}" class="btn btn-outline-secondary ripple">
            <i class="fas fa-cog me-1"></i> Home Page Settings
        </a>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary ripple float-end">
            <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
        </a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger ripple">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </button>
        </form>
    </div>
    @if(session('success'))
        <div class="alert alert-success fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('removed'))
        <div class="alert alert-danger fade show" role="alert">
            {{ session('removed') }}
        </div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0" style="border-left: 4px solid var(--sh-teal, #0f3d3e) !important;">
                <div class="card-body">
                    <p class="text-muted small mb-1 text-uppercase fw-semibold" style="letter-spacing: 0.06em;">Visitors today</p>
                    <p class="display-6 fw-bold mb-0" style="color: var(--sh-teal, #0f3d3e);">{{ $visitorsToday ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <p class="text-muted small mb-2 text-uppercase fw-semibold" style="letter-spacing: 0.06em;">Last 7 days</p>
                    <div class="table-responsive mb-0">
                        <table class="table table-sm mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th class="text-end">Unique visitors</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($visitorsLast7Days ?? []) as $day)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($day['date'])->format('d M Y') }}</td>
                                        <td class="text-end fw-semibold">{{ $day['total'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-muted">No visitor data yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <p class="text-muted small mb-2 text-uppercase fw-semibold" style="letter-spacing: 0.06em;">Locations (last 7 days)</p>
                    <div class="table-responsive mb-0">
                        <table class="table table-sm mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th>Place</th>
                                    <th class="text-end">Visitors</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($visitorLocations ?? []) as $loc)
                                    <tr>
                                        <td>{{ $loc['label'] }}</td>
                                        <td class="text-end fw-semibold">{{ $loc['total'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-muted">No location data yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm h-100 border-0" style="border-left: 4px solid #b91c1c !important;">
                <div class="card-body">
                    <p class="text-muted small mb-1 text-uppercase fw-semibold" style="letter-spacing: 0.06em;">Donation interests</p>
                    <p class="display-6 fw-bold mb-1" style="color: #b91c1c;">{{ $donationRequestsCount ?? 0 }}</p>
                    <p class="small text-muted mb-0">{{ $donationRequestsPending ?? 0 }} pending</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <p class="text-muted small mb-2 text-uppercase fw-semibold" style="letter-spacing: 0.06em;">Recent donation requests</p>
                    <div class="table-responsive mb-0" style="max-height: 220px; overflow-y: auto;">
                        <table class="table table-sm mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th class="text-end">Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($donationRequests ?? []) as $req)
                                    <tr>
                                        <td>{{ $req->name }}</td>
                                        <td>{{ $req->phone }}</td>
                                        <td class="text-start small" style="max-width: 180px;">{{ $req->address ?: '—' }}</td>
                                        <td class="text-end">{{ $req->amount !== null ? '₹'.number_format((float) $req->amount, 2) : '—' }}</td>
                                        <td>{{ $req->created_at?->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-muted">No donation requests yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>S No</th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone number</th>
                <th>Gender</th>
                <th>Active status</th>
                <th>Member Since</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- {{$i = 1}} -->
            @foreach($data as $user)
                @if($user->is_admin != 'yes')
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>SHM{{ str_pad($user->id, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $user->fname.' '.$user->lname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->gender == 'female' ? 'Female' : 'Male' }}</td>
                        <td>
                            <span class="badge {{ $user->active_status == '1' ? 'bg-success' : 'bg-danger' }}">
                                {{ $user->active_status == '1' ? 'Paid' : 'Not paid' }}
                            </span>
                        </td>
                        <td>{{ $user->created_at->format('F j, Y') }}</td>

                        <!-- Activate -->
                        <td>
                            <form action="{{ url('update', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                @if($user->active_status == '0')
                                    <button class="btn btn-primary btn-sm" type="submit">
                                        <i class="fas fa-check"></i> Activate
                                    </button>
                                @else
                                    <span class="badge bg-success">Activated</span>
                                @endif
                            </form>
                        </td>

                        <!-- Deactivate -->
                        <td>
                            <form action="{{ url('deactivate', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                @if($user->active_status == '1')
                                    <button class="btn btn-warning btn-sm" type="submit">
                                        <i class="fas fa-times"></i> Deactivate
                                    </button>
                                @else
                                    <span class="badge bg-secondary">Deactivated</span>
                                @endif
                            </form>
                        </td>

                        <!-- Delete -->
                        <td>
                            <form action="{{ url('delete', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection

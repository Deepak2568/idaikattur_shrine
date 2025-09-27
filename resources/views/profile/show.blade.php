@extends('layouts.app', ["title" => "Profile Settings"])
@section('content')
<div class="container py-4">
    <!-- Hero/Heading -->
    <div class="p-4 p-md-5 mb-4 rounded-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #eef3ff 60%, #e8f5ff 100%); border: 1px solid #e9ecef;">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
                <h4 class="mb-1 fw-semibold" style="letter-spacing:.2px;">Profile Settings</h4>
                <div class="text-muted small">Manage your profile information and account settings</div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary ripple">
                    <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Profile Actions Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 action-card">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="action-icon bg-primary bg-opacity-10 text-primary rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-eye fa-2x"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-semibold mb-2">View Profile</h5>
                    <p class="text-muted small mb-3">View your complete profile information as others see it</p>
                    <button type="button" class="btn btn-primary w-100 ripple" data-bs-toggle="modal" data-bs-target="#viewProfileModal">
                        <i class="fas fa-eye me-1"></i> View Profile
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 action-card">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="action-icon bg-success bg-opacity-10 text-success rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-edit fa-2x"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-semibold mb-2">Edit Profile</h5>
                    <p class="text-muted small mb-3">Update your personal information and profile details</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-success w-100 ripple">
                        <i class="fas fa-edit me-1"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 action-card">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="action-icon bg-danger bg-opacity-10 text-danger rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-trash-alt fa-2x"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-semibold mb-2">Delete Account</h5>
                    <p class="text-muted small mb-3">Permanently delete your account and all associated data</p>
                    <button type="button" class="btn btn-outline-danger w-100 ripple" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        <i class="fas fa-trash-alt me-1"></i> Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Profile Summary -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0 fw-semibold">
                <i class="fas fa-user-circle text-primary me-2"></i>Profile Summary
            </h5>
        </div>
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3 text-center mb-3 mb-md-0">
                    @if($customer->profile_image)
                        <img src="{{ asset('storage/' . $customer->profile_image) }}" alt="Profile photo" class="img-fluid" style="width: 250px; height: 250px; object-fit: fill; border-radius: 8px; border: 3px solid #dc3545; background-color: #f8f9fa;">
                    @else
                        <div class="avatar-initials-large">{{ strtoupper(mb_substr($customer->fname,0,1) . mb_substr($customer->lname,0,1)) }}</div>
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user text-muted me-2" style="width: 20px;"></i>
                                <span class="fw-semibold">{{ $customer->fname }} {{ $customer->lname }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-envelope text-muted me-2" style="width: 20px;"></i>
                                <span>{{ $customer->email }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-phone text-muted me-2" style="width: 20px;"></i>
                                <span>{{ $customer->phone }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar text-muted me-2" style="width: 20px;"></i>
                                <span>{{ \Carbon\Carbon::parse($customer->dob)->age }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-map-marker-alt text-muted me-2" style="width: 20px;"></i>
                                <span>{{ ucfirst($customer->city) }}, {{ ucfirst($customer->state) }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users text-muted me-2" style="width: 20px;"></i>
                                <span>{{ ucfirst($customer->religion) }} @if($customer->subcaste) - {{ ucfirst($customer->subcaste) }} @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Profile Modal -->
<div class="modal fade" id="viewProfileModal" tabindex="-1" aria-labelledby="viewProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewProfileModalLabel">
                    <i class="fas fa-user-circle text-primary me-2"></i>Complete Profile
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-3">
                        @if($customer->profile_image)
                            <img src="{{ asset('storage/' . $customer->profile_image) }}" alt="Profile photo" class="img-fluid" style="width: 250px; height: 250px; object-fit: fill; border-radius: 8px; border: 3px solid #dc3545; background-color: #f8f9fa;">
                        @else
                            <div class="avatar-initials-large">{{ strtoupper(mb_substr($customer->fname,0,1) . mb_substr($customer->lname,0,1)) }}</div>
                        @endif
                        <div class="mt-2">
                            <span class="badge bg-primary">Profile ID: SHM{{ str_pad($customer->id, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="mb-3">{{ $customer->fname }} {{ $customer->lname }}</h4>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label text-muted small">Full Name</label>
                                <p class="mb-0 fw-semibold">{{ $customer->fname }} {{ $customer->lname }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small">Email</label>
                                <p class="mb-0">{{ $customer->email }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small">Phone</label>
                                <p class="mb-0">{{ $customer->phone }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small">Date of Birth</label>
                                <p class="mb-0">{{ \Carbon\Carbon::parse($customer->dob)->format('F j, Y') }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small">Age</label>
                                <p class="mb-0">{{ \Carbon\Carbon::parse($customer->dob)->age }} years</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small">Gender</label>
                                <p class="mb-0">
                                    @if(strtolower($customer->gender) === 'male')
                                        <i class="fas fa-mars text-primary me-1"></i> Male
                                    @else
                                        <i class="fas fa-venus text-danger me-1"></i> Female
                                    @endif
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small">Religion</label>
                                <p class="mb-0">{{ ucfirst($customer->religion) }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small">Subcaste</label>
                                <p class="mb-0">{{ $customer->subcaste ? ucfirst($customer->subcaste) : 'Not specified' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small">State</label>
                                <p class="mb-0">{{ ucfirst($customer->state) }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small">City</label>
                                <p class="mb-0">{{ ucfirst($customer->city) }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small">Member Since</label>
                                <p class="mb-0">{{ $customer->created_at->format('F j, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    <i class="fas fa-edit me-1"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger" id="deleteAccountModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Delete Account
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                    <h6 class="fw-semibold">Are you sure you want to delete your account?</h6>
                    <p class="text-muted small">This action cannot be undone. All your profile data will be permanently deleted.</p>
                </div>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete your account and all associated data.
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('profile.delete') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-1"></i> Delete Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.action-card {
    transition: all 0.3s ease;
    border-radius: 12px;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.action-icon {
    transition: all 0.3s ease;
}

.action-card:hover .action-icon {
    transform: scale(1.1);
}

.avatar-initials-large {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1, #22c55e, #06b6d4);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 auto;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.ripple {
    position: relative;
    overflow: hidden;
}

.ripple:after {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle, rgba(0,0,0,.08) 10%, transparent 10.5%) center/0% 0% no-repeat;
    opacity: 0;
    transition: background-size .35s, opacity .45s;
}

.ripple:active:after {
    background-size: 250% 250%;
    opacity: 1;
    transition: 0s;
}

@media (max-width: 768px) {
    .action-card {
        margin-bottom: 1rem;
    }
}
</style>
@endsection

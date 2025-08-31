@extends('layouts.app',["title"=>"Matrimony Dashboard"])
@section('content')
<div class="container py-4">
    <!-- Hero/Heading -->
    <div class="p-4 p-md-5 mb-4 rounded-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #eef3ff 60%, #e8f5ff 100%); border: 1px solid #e9ecef;">
        <div class="row align-items-center">
            <!-- Profile Image - Left Side -->
            <div class="col-md-3 text-center mb-3 mb-md-0">
                <div class="avatar-ring" style="width:120px; height:120px; margin:0 auto;">
                    @if($customer->profile_image)
                        <img src="{{ asset('storage/' . $customer->profile_image) }}" alt="Your profile photo" class="shadow-sm" style="width:100%; height:100%; border-radius:8px;">
                    @else
                        <div class="avatar-initials" style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#f3f4f6; color:#dc3545; font-weight:bold; font-size:2.5rem; border-radius:8px;">
                            {{ strtoupper(mb_substr($customer->fname,0,1) . mb_substr($customer->lname,0,1)) }}
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Welcome Content - Right Side -->
            <div class="col-md-9">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <div class="mb-3 mb-md-0">
                        <h4 class="mb-1 fw-semibold" style="letter-spacing:.2px;">Welcome, {{ $customer->fname }} {{ $customer->lname }}</h4>
                        <div class="text-muted small">Discover thoughtful {{ $oppositeGender === 'female' ? 'bride' : 'groom' }} matches curated for you</div>
                    </div>
                    <div class="d-flex gap-2">
                        @if($customer->is_admin == 'yes')
                        <a href="{{route('admin')}}" class="btn btn-success border ripple">
                            <i class="fas fa-user-edit me-1"></i> Admin Settings
                        </a>
                        @endif
                        <a href="{{ route('profile.show') }}" class="btn btn-light border ripple">
                            <i class="fas fa-user-edit me-1"></i> Update Profile
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger ripple">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">
                <i class="fas fa-heart text-danger me-2"></i>{{ $oppositeGender === 'female' ? 'Bride' : 'Groom' }} Profiles
            </h5>
            <span class="badge rounded-pill bg-light text-dark border">{{ $profiles->total() }} total</span>
        </div>
        <div class="card-body pt-0">
            @if($profiles->count() > 0)
                @foreach($profiles as $p)
                @php
                    $initials = strtoupper(mb_substr($p->fname,0,1) . mb_substr($p->lname,0,1));
                    $recentActive = \Carbon\Carbon::parse($p->last_dashboard_visit)->gt(now()->subDays(7));
                    $verified = (int)($p->active_status ?? 0) === 1;
                    $summary = trim(implode(' • ', array_filter([
                        (\Carbon\Carbon::parse($p->dob)->age).' yrs',
                        ucfirst($p->city),
                        $p->state != '' ? 'Tamilnadu' : '',
                    ])));
                    $bio = $p->subcaste ? (ucfirst($p->subcaste).' • '.ucfirst($p->religion)) : ucfirst($p->religion);
                    $profile_image = $p->profile_image ?? '';
                @endphp
                <div class="card mb-3 profile-card border-0 shadow-sm lift-glow">
                    <div class="row g-0 align-items-stretch">
                        <!-- Avatar / Photo with initials and colored ring -->
                        <div class="col-12 col-md-4 d-flex align-items-center justify-content-center p-4">
                            <div class="avatar-ring" aria-label="profile avatar">
                                @if($profile_image)
                                    <img src="{{ asset('storage/' . $profile_image) }}" alt="Profile photo" class="shadow-sm" style="width: 100%; height: 100%; border-radius: 5px;">
                                @else
                                    <div class="avatar-initials">{{ $initials }}</div>
                                @endif
                            </div>
                            <div class="ms-3 d-none d-md-flex flex-column align-items-start gap-1">
                                @if($verified)
                                    <span class="badge bg-success" data-bs-toggle="tooltip" title="Verified profile"><i class="fas fa-check-circle me-1"></i>Verified</span>
                                @endif
                                @if($recentActive)
                                    <span class="badge bg-info text-dark" data-bs-toggle="tooltip" title="Active within last 7 days"><i class="fas fa-bolt me-1"></i>Recently active</span>
                                @endif
                            </div>
                        </div>
                        <!-- Details -->
                        <div class="col-12 col-md-8">
                            <div class="card-body h-100 d-flex flex-column">
                                <!-- Profile ID on top -->
                                <div class="mb-2">
                                    <span class="id-badge small">
                                        <i class="far fa-id-badge me-1"></i> SHM{{ str_pad($p->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>

                                <!-- Name -->
                                <h5 class="card-title mb-1 fw-semibold profile-title">{{ $p->fname }} {{ $p->lname }}</h5>

                                <!-- Compact info pills -->
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="pill"><i class="far fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($p->dob)->age }} yrs</span>
                                    <span class="pill"><i class="fas fa-map-marker-alt me-1"></i>{{ ucfirst($p->city) }}</span>
                                    <span class="pill"><i class="fas fa-globe-asia me-1"></i>{{ $p->state != '' ? 'Tamilnadu' : '' }}</span>
                                </div>

                                <!-- Two-line bio / intro -->
                                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                                    <!-- Gender -->
                                    <span class="badge bg-light text-dark border d-flex align-items-center px-2 py-1" style="font-size: 0.95em;">
                                        @if(strtolower($p->gender) === 'male')
                                            <i class="fas fa-mars text-primary me-1"></i> Male
                                        @elseif(strtolower($p->gender) === 'female')
                                            <i class="fas fa-venus text-danger me-1"></i> Female
                                        @else
                                            <i class="fas fa-genderless text-secondary me-1"></i> {{ ucfirst($p->gender) }}
                                        @endif
                                    </span>
                                    <!-- Caste/Subcaste -->
                                    <span class="badge bg-light text-dark border d-flex align-items-center px-2 py-1" style="font-size: 0.95em;">
                                        <i class="fas fa-users text-warning me-1"></i>
                                        @if($p->subcaste)
                                            {{ ucfirst($p->subcaste) }}
                                        @else
                                            {{ ucfirst($p->religion) }}
                                        @endif
                                    </span>
                                    <!-- Religion -->
                                    <span class="badge bg-light text-dark border d-flex align-items-center px-2 py-1" style="font-size: 0.95em;">
                                        <i class="fas fa-praying-hands text-success me-1"></i>
                                        {{ ucfirst($p->religion) }}
                                    </span>
                                </div>
                                <!-- <p class="text-muted small mb-0 clamp-2">{{ $summary }}</p> -->

                                <div class="mt-auto d-flex flex-wrap gap-2">
                                    <button type="button" class="btn btn-primary btn-sm ripple view-profile-btn" data-profile-id="{{ $p->id }}">
                                        <i class="fas fa-eye me-1"></i> View Profile
                                    </button>
                                    <button type="button" class="btn btn-outline-success btn-sm ripple send-interest-btn" data-profile-id="{{ $p->id }}">
                                        <i class="fas fa-heart me-1"></i> Send Interest
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm ripple">
                                        <i class="fas fa-bookmark me-1"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Pagination: aligned number and controls -->
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-2 mt-4">
                    <!-- <div class="text-muted small">
                        Showing {{ $profiles->firstItem() }} to {{ $profiles->lastItem() }} of {{ $profiles->total() }} results
                    </div> -->
                    <div>
                        {{ $profiles->onEachSide(1)->links() }}
                    </div>
                </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h6 class="mb-1">No profiles found</h6>
                <div class="text-muted small">Please check back later</div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.profile-card { border: 1px solid #edf2f7; border-radius: .75rem; }
.lift-glow { transition: box-shadow .2s ease, transform .2s ease; }
.lift-glow:hover { box-shadow: 0 14px 28px rgba(16,24,40,.12), 0 2px 6px rgba(16,24,40,.06); transform: translateY(-2px); }

/* Square avatar with gradient background - Large size */
.avatar-ring {
    width: 200px; height: 200px;
    border-radius: 8px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #22c55e 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.avatar-initials { 
    font-size: 3rem; 
    font-weight: 700; 
    color: #ffffff; 
    letter-spacing: .5px; 
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

/* Pills */
.pill { background:#f8fafc; border:1px solid #e5e7eb; color:#334155; border-radius:999px; padding:.25rem .6rem; font-size:.85rem; }

/* Two-line clamp */
.clamp-2 { display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }

/* Ripple on buttons */
.ripple { position: relative; overflow: hidden; }
.ripple:after { content:""; position:absolute; inset:0; background:radial-gradient(circle, rgba(0,0,0,.08) 10%, transparent 10.5%) center/0% 0% no-repeat; opacity:0; transition:background-size .35s, opacity .45s; }
.ripple:active:after { background-size:250% 250%; opacity:1; transition:0s; }

/* Profile ID badge */
.id-badge { display:inline-block; padding:.25rem .6rem; border-radius:999px; background:#eef2ff; color:#1d4ed8; font-weight:600; border:1px solid #dbe2ff; }

/* Modal styling */
.modal-header.bg-warning {
    background: linear-gradient(135deg, #ffc107 0%, #ffca2c 100%) !important;
}

.modal-body .form-label {
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.modal-body p {
    font-size: 1rem;
    margin-bottom: 0;
}
</style>

<!-- Profile View Modal -->
<div class="modal fade" id="profileViewModal" tabindex="-1" aria-labelledby="profileViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileViewModalLabel">
                    <i class="fas fa-user-circle text-primary me-2"></i>Profile Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="profileModalBody">
                <!-- Profile content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Membership Alert Modal -->
<div class="modal fade" id="membershipAlertModal" tabindex="-1" aria-labelledby="membershipAlertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <h5 class="modal-title" id="membershipAlertModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Membership Required
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="mb-3" style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-lock fa-2x text-white"></i>
                    </div>
                    <h6 class="mb-3 fw-bold" style="color: #667eea;">Premium Membership Required</h6>
                    <p class="text-muted mb-4" id="membershipAlertMessage">
                        You need to upgrade to a premium membership to access this feature.
                    </p>
                    <div class="d-grid gap-2">
                        <button type="button" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
                            <i class="fas fa-crown me-2"></i>Upgrade Membership
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize Bootstrap tooltips (with error handling)
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
    } else {
        console.warn('Bootstrap is not loaded');
    }

    console.log('DOM loaded, setting up event listeners...');
    
    // View Profile functionality
    const viewButtons = document.querySelectorAll('.view-profile-btn');
    console.log('Found view buttons:', viewButtons.length);
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('View profile button clicked');
            const profileId = this.getAttribute('data-profile-id');
            console.log('Profile ID:', profileId);
            
            // Test alert to see if click is working
            // alert('Button clicked! Profile ID: ' + profileId);
            
            viewProfile(profileId);
        });
    });


});

function viewProfile(profileId) {
    console.log('viewProfile function called with ID:', profileId);
    
    // Find the button that was clicked and show loading state
    const button = document.querySelector(`[data-profile-id="${profileId}"].view-profile-btn`);
    if (!button) {
        console.error('Button not found for profile ID:', profileId);
        return;
    }
    
    const originalText = button.innerHTML;
    button.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Loading...';
    button.disabled = true;

    console.log('Making fetch request to:', `/profile/${profileId}`);
    
    fetch(`/profile/${profileId}`, {
        method: 'GET',
        // headers: {
        //     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        //     'Accept': 'application/json'
        // }
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
            .then(data => {
            console.log('Response data:', data);
            if (data.status) {
                // Show profile in modal
                displayProfileModal(data.profile);
            } else {
                if (data.type === 'membership_required') {
                    // Show membership alert
                    document.getElementById('membershipAlertMessage').textContent = data.message;
                    if (typeof bootstrap !== 'undefined') {
                        new bootstrap.Modal(document.getElementById('membershipAlertModal')).show();
                    } else {
                        alert(data.message);
                    }
                } else {
                    alert(data.message || 'Error loading profile');
                }
            }
        })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while loading the profile');
    })
    .finally(() => {
        // Reset button state
        button.innerHTML = originalText;
        button.disabled = false;
    });
}



function displayProfileModal(profile) {
    console.log('displayProfileModal called with profile:', profile);
    
    const modalBody = document.getElementById('profileModalBody');
    if (!modalBody) {
        console.error('Modal body element not found');
        return;
    }
    
    modalBody.innerHTML = `
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    ${profile.profile_image ? 
                        `<img src="/storage/${profile.profile_image}" alt="Profile" class="img-fluid" style="width: 250px; height: 250px; object-fit: fill; border-radius: 8px; border: 3px solid #dc3545; background-color: #f8f9fa;">` :
                        `<div class="bg-primary text-white d-inline-flex align-items-center justify-content-center" style="width: 250px; height: 250px; font-size: 4rem; font-weight: bold; border-radius: 8px; border: 3px solid #dc3545;">
                            ${profile.fname.charAt(0)}${profile.lname.charAt(0)}
                        </div>`
                    }
                </div>
                <h5 class="fw-bold">${profile.fname} ${profile.lname}</h5>
                <p class="text-muted">${profile.profile_id}</p>
            </div>
            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Age</label>
                        <p class="mb-0">${profile.age} years</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Gender</label>
                        <p class="mb-0">${profile.gender.charAt(0).toUpperCase() + profile.gender.slice(1)}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Religion</label>
                        <p class="mb-0">${profile.religion.charAt(0).toUpperCase() + profile.religion.slice(1)}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Subcaste</label>
                        <p class="mb-0">${profile.subcaste || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">State</label>
                        <p class="mb-0">${profile.state}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">City</label>
                        <p class="mb-0">${profile.city}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Email</label>
                        <p class="mb-0">${profile.email}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Phone</label>
                        <p class="mb-0">${profile.phone}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Member Since</label>
                        <p class="mb-0">${profile.created_at}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Last Visited</label>
                        <p class="mb-0">${profile.last_dashboard_visit}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Physical Details -->
        <div class="row mt-4">
            <div class="col-12">
                <h6 class="fw-bold text-primary mb-3">Physical Details</h6>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Height</label>
                        <p class="mb-0">${profile.height == null || profile.height == '' ? 'Not specified' : profile.height + 'cm'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Weight</label>
                        <p class="mb-0">${profile.weight == null || profile.weight == '' ? 'Not specified' : profile.weight + 'kg'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Body Type</label>
                        <p class="mb-0">${profile.body_type ? profile.body_type.replace('_', ' ').charAt(0).toUpperCase() + profile.body_type.replace('_', ' ').slice(1) : 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Complexion</label>
                        <p class="mb-0">${profile.complexion ? profile.complexion.replace('_', ' ').charAt(0).toUpperCase() + profile.complexion.replace('_', ' ').slice(1) : 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Blood Group</label>
                        <p class="mb-0">${profile.blood_group || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Physical Status</label>
                        <p class="mb-0">${profile.physical_status ? profile.physical_status.replace('_', ' ').charAt(0).toUpperCase() + profile.physical_status.replace('_', ' ').slice(1) : 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Marital Status</label>
                        <p class="mb-0">${profile.marital_status ? profile.marital_status.charAt(0).toUpperCase() + profile.marital_status.slice(1) : 'Not specified'}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Education & Occupation -->
        <div class="row mt-4">
            <div class="col-12">
                <h6 class="fw-bold text-primary mb-3">Education & Occupation</h6>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Education</label>
                        <p class="mb-0">${profile.education ? profile.education.replace('_', ' ').charAt(0).toUpperCase() + profile.education.replace('_', ' ').slice(1) : 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Education Details</label>
                        <p class="mb-0">${profile.education_details || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Employed In</label>
                        <p class="mb-0">${profile.employed_in ? profile.employed_in.charAt(0).toUpperCase() + profile.employed_in.slice(1) : 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Occupation</label>
                        <p class="mb-0">${profile.occupation_details || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Occupation Category</label>
                        <p class="mb-0">${profile.occupation_category || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Working Place</label>
                        <p class="mb-0">${profile.working_place || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Working State</label>
                        <p class="mb-0">${profile.working_state || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Salary</label>
                        <p class="mb-0">${profile.salary || 'Not specified'}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Family Details -->
        <div class="row mt-4">
            <div class="col-12">
                <h6 class="fw-bold text-primary mb-3">Family Details</h6>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Father Name</label>
                        <p class="mb-0">${profile.father_name || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Father Occupation</label>
                        <p class="mb-0">${profile.father_occupation || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Mother Name</label>
                        <p class="mb-0">${profile.mother_name || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Mother Occupation</label>
                        <p class="mb-0">${profile.mother_occupation || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Brother Name</label>
                        <p class="mb-0">${profile.brother_name || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Brother Occupation</label>
                        <p class="mb-0">${profile.brother_occupation || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Brother Status</label>
                        <p class="mb-0">${profile.brother_status ? profile.brother_status.charAt(0).toUpperCase() + profile.brother_status.slice(1) : 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Sister Name</label>
                        <p class="mb-0">${profile.sister_name || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Sister Occupation</label>
                        <p class="mb-0">${profile.sister_occupation || 'Not specified'}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold text-muted">Sister Status</label>
                        <p class="mb-0">${profile.sister_status ? profile.sister_status.charAt(0).toUpperCase() + profile.sister_status.slice(1) : 'Not specified'}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Partner Preference -->
        ${profile.partner_preference ? `
        <div class="row mt-4">
            <div class="col-12">
                <h6 class="fw-bold text-primary mb-3">Partner Preference</h6>
                <p class="mb-0">${profile.partner_preference}</p>
            </div>
        </div>
        ` : ''}
    `;
    
    console.log('Modal content set, trying to show modal...');
    
    if (typeof bootstrap !== 'undefined') {
        const modal = new bootstrap.Modal(document.getElementById('profileViewModal'));
        modal.show();
        console.log('Modal show() called');
    } else {
        console.error('Bootstrap is not available for modal');
        // Fallback: show profile info in a simple alert
        const profileInfo = `
Profile: ${profile.fname} ${profile.lname}
Age: ${profile.age} years
Gender: ${profile.gender}
Religion: ${profile.religion}
Location: ${profile.city}, ${profile.state}
Email: ${profile.email}
Phone: ${profile.phone}
        `;
        alert(profileInfo);
    }
}
</script>
@endsection
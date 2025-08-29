@extends('layouts.app',["title"=>"Matrimony Dashboard"])
@section('content')
<div class="container py-4">
    <!-- Hero/Heading -->
    <div class="p-4 p-md-5 mb-4 rounded-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #eef3ff 60%, #e8f5ff 100%); border: 1px solid #e9ecef;">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
                <h4 class="mb-1 fw-semibold" style="letter-spacing:.2px;">Welcome, {{ $customer->fname }} {{ $customer->lname }}</h4>
                <div class="text-muted small">Discover thoughtful {{ $oppositeGender === 'female' ? 'bride' : 'groom' }} matches curated for you</div>
            </div>
            <div class="d-flex gap-2">
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
                    $recentActive = \Carbon\Carbon::parse($p->updated_at)->gt(now()->subDays(7));
                    $verified = (int)($p->active_status ?? 0) === 1;
                    $summary = trim(implode(' • ', array_filter([
                        (\Carbon\Carbon::parse($p->dob)->age).' yrs',
                        ucfirst($p->city),
                        $p->state === 'tamil-nadu' ? 'Tamilnadu' : $p->state,
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
                                    <img src="{{ asset('storage/' . $profile_image) }}" alt="Profile photo" class="rounded-circle shadow-sm" style="width: 100px; height: 100px; border: 3px solid #e3e6f0;">
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
                                    <span class="pill"><i class="fas fa-globe-asia me-1"></i>{{ $p->state === 'tamil-nadu' ? 'Tamilnadu' : $p->state }}</span>
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
                                    <button type="button" class="btn btn-primary btn-sm ripple">
                                        <i class="fas fa-eye me-1"></i> View Profile
                                    </button>
                                    <button type="button" class="btn btn-outline-success btn-sm ripple">
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

/* Initials avatar with colored ring */
.avatar-ring {
    width: 104px; height: 104px;
    border-radius: 50%;
    background: radial-gradient(circle at 30% 30%, #ffffff 0%, #f8fafc 70%);
    display: grid; place-items: center;
    position: relative;
}
.avatar-ring:before {
    content: ""; position: absolute; inset: -4px;
    border-radius: 50%; padding: 4px;
    background: linear-gradient(135deg,#6366f1,#22c55e,#06b6d4);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor; mask-composite: exclude;
}
.avatar-initials { font-size: 1.75rem; font-weight: 700; color: #1f2937; letter-spacing: .5px; }

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
</style>

<script>
// Initialize Bootstrap tooltips
const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
</script>
@endsection
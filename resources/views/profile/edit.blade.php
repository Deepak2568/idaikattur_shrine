@extends('layouts.app', ["title" => "Edit Profile"])
@section('content')
<div class="container py-4">
    <!-- Hero/Heading -->
    <div class="p-4 p-md-5 mb-4 rounded-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #eef3ff 60%, #e8f5ff 100%); border: 1px solid #e9ecef;">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
                <h4 class="mb-1 fw-semibold" style="letter-spacing:.2px;">Edit Profile</h4>
                <div class="text-muted small">Update your personal information and profile details</div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('profile.show') }}" class="btn btn-outline-primary ripple">
                    <i class="fas fa-arrow-left me-1"></i> Back to Settings
                </a>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-user-edit text-primary me-2"></i>Profile Information
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Profile Image Upload -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                @if($customer->profile_image)
                                    <img src="{{ asset('storage/' . $customer->profile_image) }}" alt="Current profile photo" class="rounded-circle shadow-sm mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <div class="avatar-initials-large mb-3">{{ strtoupper(mb_substr($customer->fname,0,1) . mb_substr($customer->lname,0,1)) }}</div>
                                @endif
                                <div class="position-absolute bottom-0 end-0">
                                    <label for="profile_image" class="btn btn-primary btn-sm rounded-circle" style="width: 40px; height: 40px; padding: 0;">
                                        <i class="fas fa-camera"></i>
                                    </label>
                                    <input type="file" id="profile_image" name="profile_image" class="d-none" accept="image/*">
                                </div>
                            </div>
                            <div class="text-muted small">Click the camera icon to change your profile photo</div>
                        </div>

                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-md-6">
                                <label for="fname" class="form-label fw-semibold">
                                    <i class="fas fa-user text-muted me-1"></i>First Name
                                </label>
                                <input type="text" class="form-control @error('fname') is-invalid @enderror" id="fname" name="fname" value="{{ old('fname', $customer->fname) }}" required>
                                @error('fname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6">
                                <label for="lname" class="form-label fw-semibold">
                                    <i class="fas fa-user text-muted me-1"></i>Last Name
                                </label>
                                <input type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" name="lname" value="{{ old('lname', $customer->lname) }}" required>
                                @error('lname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="fas fa-envelope text-muted me-1"></i>Email Address
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-semibold">
                                    <i class="fas fa-phone text-muted me-1"></i>Phone Number
                                </label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div class="col-md-6">
                                <label for="dob" class="form-label fw-semibold">
                                    <i class="fas fa-calendar text-muted me-1"></i>Date of Birth
                                </label>
                                <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob', $customer->dob) }}" required>
                                @error('dob')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="col-md-6">
                                <label for="gender" class="form-label fw-semibold">
                                    <i class="fas fa-venus-mars text-muted me-1"></i>Gender
                                </label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', $customer->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $customer->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Religion -->
                            <div class="col-md-6">
                                <label for="religion" class="form-label fw-semibold">
                                    <i class="fas fa-praying-hands text-muted me-1"></i>Religion
                                </label>
                                <input type="text" class="form-control @error('religion') is-invalid @enderror" id="religion" name="religion" value="{{ old('religion', $customer->religion) }}" required>
                                @error('religion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Subcaste -->
                            <div class="col-md-6">
                                <label for="subcaste" class="form-label fw-semibold">
                                    <i class="fas fa-users text-muted me-1"></i>Subcaste (Optional)
                                </label>
                                <input type="text" class="form-control @error('subcaste') is-invalid @enderror" id="subcaste" name="subcaste" value="{{ old('subcaste', $customer->subcaste) }}">
                                @error('subcaste')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="col-md-6">
                                <label for="state" class="form-label fw-semibold">
                                    <i class="fas fa-map text-muted me-1"></i>State
                                </label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state', $customer->state) }}" required>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="col-md-6">
                                <label for="city" class="form-label fw-semibold">
                                    <i class="fas fa-city text-muted me-1"></i>City
                                </label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $customer->city) }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Password Change Section -->
                        <div class="mb-4">
                            <h6 class="fw-semibold mb-3">
                                <i class="fas fa-lock text-muted me-2"></i>Change Password (Optional)
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Leave blank to keep current password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary ripple">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary ripple">
                                <i class="fas fa-save me-1"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
}

.form-label {
    color: #374151;
    margin-bottom: 0.5rem;
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
    .card-body {
        padding: 1.5rem;
    }
}
</style>

<script>
// Preview image before upload
document.getElementById('profile_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.querySelector('.rounded-circle');
            if (img) {
                img.src = e.target.result;
            } else {
                const initialsDiv = document.querySelector('.avatar-initials-large');
                if (initialsDiv) {
                    initialsDiv.innerHTML = `<img src="${e.target.result}" alt="Profile preview" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">`;
                }
            }
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection

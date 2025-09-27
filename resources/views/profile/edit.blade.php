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
                                    <img src="{{ asset('storage/' . $customer->profile_image) }}" alt="Current profile photo" class="img-fluid profile-preview" style="width: 250px; height: 250px;border-radius: 8px; border: 3px solid #dc3545; background-color: #f8f9fa;">
                                @else
                                    <div class="avatar-initials-large mb-3" id="initials-div">{{ strtoupper(mb_substr($customer->fname,0,1) . mb_substr($customer->lname,0,1)) }}</div>
                                @endif
                                <div class="position-absolute bottom-0 end-0">
                                    <label for="profile_image" class="btn btn-primary btn-sm rounded-circle" style="width: 40px; height: 40px; padding: 0; cursor: pointer;">
                                        <i class="fas fa-camera"></i>
                                    </label>
                                    <input type="file" id="profile_image" name="profile_image" class="d-none" accept="image/*" onchange="previewImage(this)">
                                </div>
                            </div>
                            <div class="text-muted small">Click the camera icon to change your profile photo</div>
                            <div id="upload-status" class="mt-2"></div>
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
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $customer->email) }}" readonly required>
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
                                <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob', \Carbon\Carbon::parse($customer->dob)->format('Y-m-d')) }}"  required>
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
                                <input type="text" class="form-control @error('religion') is-invalid @enderror" id="religion" name="religion" value="{{ old('religion', ucfirst($customer->religion)) }}" readonly>
                                @error('religion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Subcaste -->
                            <div class="col-md-6">
                                <label for="subcaste" class="form-label fw-semibold">
                                    <i class="fas fa-users text-muted me-1"></i>Subcaste (Optional)
                                </label>
                                <input type="text" class="form-control @error('subcaste') is-invalid @enderror" id="subcaste" name="subcaste" value="{{ old('subcaste', ucfirst($customer->subcaste)) }}">
                                @error('subcaste')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="col-md-6">
                                <label for="state" class="form-label fw-semibold">
                                    <i class="fas fa-map text-muted me-1"></i>State
                                </label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state', $customer->state != '' ? 'Tamilnadu' : 'Tamilnadu') }}" readonly>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="col-md-6">
                                <label for="city" class="form-label fw-semibold">
                                    <i class="fas fa-city text-muted me-1"></i>City
                                </label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', ucfirst($customer->city)) }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="col-12">
                                <label for="address" class="form-label fw-semibold">
                                    <i class="fas fa-map-marker-alt text-muted me-1"></i>Address
                                </label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Enter your complete address">{{ old('address', $customer->address ?? '') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Physical Details Section -->
                        <div class="mb-4">
                            <h6 class="fw-semibold mb-3">
                                <i class="fas fa-user-circle text-muted me-2"></i>Physical Details
                            </h6>
                            <div class="row g-3">
                                <!-- Height -->
                                <div class="col-md-6">
                                    <label for="height" class="form-label fw-semibold">
                                        <i class="fas fa-ruler-vertical text-muted me-1"></i>Height
                                    </label>
                                    <input type="text" class="form-control @error('height') is-invalid @enderror" id="height" name="height" value="{{ old('height', $customer->height ?? '') }}" placeholder="e.g., 160cm"">
                                    @error('height')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Weight -->
                                <div class="col-md-6">
                                    <label for="weight" class="form-label fw-semibold">
                                        <i class="fas fa-weight text-muted me-1"></i>Weight
                                    </label>
                                    <input type="text" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight', $customer->weight ?? '') }}" placeholder="e.g., 65 kg">
                                    @error('weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Body Type -->
                                <div class="col-md-6">
                                    <label for="body_type" class="form-label fw-semibold">
                                        <i class="fas fa-user text-muted me-1"></i>Body Type
                                    </label>
                                    <select class="form-select @error('body_type') is-invalid @enderror" id="body_type" name="body_type">
                                        <option value="">Select Body Type</option>
                                        <option value="slim" {{ old('body_type', $customer->body_type ?? '') === 'slim' ? 'selected' : '' }}>Slim</option>
                                        <option value="average" {{ old('body_type', $customer->body_type ?? '') === 'average' ? 'selected' : '' }}>Average</option>
                                        <option value="athletic" {{ old('body_type', $customer->body_type ?? '') === 'athletic' ? 'selected' : '' }}>Athletic</option>
                                        <option value="curvy" {{ old('body_type', $customer->body_type ?? '') === 'curvy' ? 'selected' : '' }}>Curvy</option>
                                        <option value="plus_size" {{ old('body_type', $customer->body_type ?? '') === 'plus_size' ? 'selected' : '' }}>Plus Size</option>
                                    </select>
                                    @error('body_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Complexion -->
                                <div class="col-md-6">
                                    <label for="complexion" class="form-label fw-semibold">
                                        <i class="fas fa-palette text-muted me-1"></i>Complexion
                                    </label>
                                    <select class="form-select @error('complexion') is-invalid @enderror" id="complexion" name="complexion">
                                        <option value="">Select Complexion</option>
                                        <option value="very_fair" {{ old('complexion', $customer->complexion ?? '') === 'very_fair' ? 'selected' : '' }}>Very Fair</option>
                                        <option value="fair" {{ old('complexion', $customer->complexion ?? '') === 'fair' ? 'selected' : '' }}>Fair</option>
                                        <option value="wheatish" {{ old('complexion', $customer->complexion ?? '') === 'wheatish' ? 'selected' : '' }}>Wheatish</option>
                                        <option value="wheatish_brown" {{ old('complexion', $customer->complexion ?? '') === 'wheatish_brown' ? 'selected' : '' }}>Wheatish Brown</option>
                                        <option value="black" {{ old('complexion', $customer->complexion ?? '') === 'black' ? 'selected' : '' }}>Black</option>
                                    </select>
                                    @error('complexion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Blood Group -->
                                <div class="col-md-6">
                                    <label for="blood_group" class="form-label fw-semibold">
                                        <i class="fas fa-tint text-muted me-1"></i>Blood Group
                                    </label>
                                    <input type="text" class="form-control @error('blood_group') is-invalid @enderror" id="blood_group" name="blood_group" value="{{ old('blood_group', $customer->blood_group ?? '') }}" placeholder="e.g., A+, B-, O+">
                                    @error('blood_group')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Physical Status -->
                                <div class="col-md-6">
                                    <label for="physical_status" class="form-label fw-semibold">
                                        <i class="fas fa-wheelchair text-muted me-1"></i>Physical Status
                                    </label>
                                    <select class="form-select @error('physical_status') is-invalid @enderror" id="physical_status" name="physical_status">
                                        <option value="">Select Physical Status</option>
                                        <option value="normal" {{ old('physical_status', $customer->physical_status ?? '') === 'normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="physically_challenged" {{ old('physical_status', $customer->physical_status ?? '') === 'physically_challenged' ? 'selected' : '' }}>Physically Challenged</option>
                                    </select>
                                    @error('physical_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Marital Status -->
                                <div class="col-md-6">
                                    <label for="marital_status" class="form-label fw-semibold">
                                        <i class="fas fa-heart text-muted me-1"></i>Marital Status
                                    </label>
                                    <select class="form-select @error('marital_status') is-invalid @enderror" id="marital_status" name="marital_status">
                                        <option value="">Select Marital Status</option>
                                        <option value="unmarried" {{ old('marital_status', $customer->marital_status ?? '') === 'unmarried' ? 'selected' : '' }}>Unmarried</option>
                                        <option value="married" {{ old('marital_status', $customer->marital_status ?? '') === 'married' ? 'selected' : '' }}>Married</option>
                                        <option value="widowed" {{ old('marital_status', $customer->marital_status ?? '') === 'widowed' ? 'selected' : '' }}>Widowed</option>
                                        <option value="divorced" {{ old('marital_status', $customer->marital_status ?? '') === 'divorced' ? 'selected' : '' }}>Divorced</option>
                                    </select>
                                    @error('marital_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Education Section -->
                        <div class="mb-4">
                            <h6 class="fw-semibold mb-3">
                                <i class="fas fa-graduation-cap text-muted me-2"></i>Education Details
                            </h6>
                            <div class="row g-3">
                                <!-- Education -->
                                <div class="col-md-6">
                                    <label for="education" class="form-label fw-semibold">
                                        <i class="fas fa-certificate text-muted me-1"></i>Education
                                    </label>
                                    <select class="form-select @error('education') is-invalid @enderror" id="education" name="education">
                                        <option value="">Select Education</option>
                                        <option value="high_school" {{ old('education', $customer->education ?? '') === 'high_school' ? 'selected' : '' }}>High School</option>
                                        <option value="diploma" {{ old('education', $customer->education ?? '') === 'diploma' ? 'selected' : '' }}>Diploma</option>
                                        <option value="bachelor" {{ old('education', $customer->education ?? '') === 'bachelor' ? 'selected' : '' }}>Bachelor's Degree</option>
                                        <option value="master" {{ old('education', $customer->education ?? '') === 'master' ? 'selected' : '' }}>Master's Degree</option>
                                        <option value="phd" {{ old('education', $customer->education ?? '') === 'phd' ? 'selected' : '' }}>PhD</option>
                                        <option value="other" {{ old('education', $customer->education ?? '') === 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('education')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Education Details -->
                                <div class="col-md-6">
                                    <label for="education_details" class="form-label fw-semibold">
                                        <i class="fas fa-book text-muted me-1"></i>Education Details
                                    </label>
                                    <input type="text" class="form-control @error('education_details') is-invalid @enderror" id="education_details" name="education_details" value="{{ old('education_details', $customer->education_details ?? '') }}" placeholder="e.g., B.Tech Computer Science">
                                    @error('education_details')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Occupation Section -->
                        <div class="mb-4">
                            <h6 class="fw-semibold mb-3">
                                <i class="fas fa-briefcase text-muted me-2"></i>Occupation Details
                            </h6>
                            <div class="row g-3">
                                <!-- Employed In -->
                                <div class="col-md-6">
                                    <label for="employed_in" class="form-label fw-semibold">
                                        <i class="fas fa-building text-muted me-1"></i>Employed In
                                    </label>
                                    <select class="form-select @error('employed_in') is-invalid @enderror" id="employed_in" name="employed_in">
                                        <option value="">Select Employment Type</option>
                                        <option value="private" {{ old('employed_in', $customer->employed_in ?? '') === 'private' ? 'selected' : '' }}>Private</option>
                                        <option value="government" {{ old('employed_in', $customer->employed_in ?? '') === 'government' ? 'selected' : '' }}>Government</option>
                                        <option value="others" {{ old('employed_in', $customer->employed_in ?? '') === 'others' ? 'selected' : '' }}>Others</option>
                                    </select>
                                    @error('employed_in')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Occupation Details -->
                                <div class="col-md-6">
                                    <label for="occupation_details" class="form-label fw-semibold">
                                        <i class="fas fa-user-tie text-muted me-1"></i>Occupation Details
                                    </label>
                                    <input type="text" class="form-control @error('occupation_details') is-invalid @enderror" id="occupation_details" name="occupation_details" value="{{ old('occupation_details', $customer->occupation_details ?? '') }}" placeholder="e.g., Software Engineer">
                                    @error('occupation_details')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Occupation Category -->
                                <div class="col-md-6">
                                    <label for="occupation_category" class="form-label fw-semibold">
                                        <i class="fas fa-tags text-muted me-1"></i>Occupation Category
                                    </label>
                                    <input type="text" class="form-control @error('occupation_category') is-invalid @enderror" id="occupation_category" name="occupation_category" value="{{ old('occupation_category', $customer->occupation_category ?? '') }}" placeholder="e.g., IT/Software">
                                    @error('occupation_category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Working State -->
                                <div class="col-md-6">
                                    <label for="working_state" class="form-label fw-semibold">
                                        <i class="fas fa-map text-muted me-1"></i>Working State
                                    </label>
                                    <input type="text" class="form-control @error('working_state') is-invalid @enderror" id="working_state" name="working_state" value="{{ old('working_state', $customer->working_state ?? '') }}" placeholder="e.g., Tamil Nadu">
                                    @error('working_state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Working Place -->
                                <div class="col-md-6">
                                    <label for="working_place" class="form-label fw-semibold">
                                        <i class="fas fa-location-dot text-muted me-1"></i>Working Place
                                    </label>
                                    <input type="text" class="form-control @error('working_place') is-invalid @enderror" id="working_place" name="working_place" value="{{ old('working_place', $customer->working_place ?? '') }}" placeholder="e.g., Chennai">
                                    @error('working_place')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Salary -->
                                <div class="col-md-6">
                                    <label for="salary" class="form-label fw-semibold">
                                        <i class="fas fa-money-bill text-muted me-1"></i>Salary (per month)
                                    </label>
                                    <input type="text" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary" value="{{ old('salary', $customer->salary ?? '') }}" placeholder="e.g., ₹50,000">
                                    @error('salary')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Family Details Section -->
                        <div class="mb-4">
                            <h6 class="fw-semibold mb-3">
                                <i class="fas fa-users text-muted me-2"></i>Family Details
                            </h6>
                            <div class="row g-3">
                                <!-- Father Name -->
                                <div class="col-md-6">
                                    <label for="father_name" class="form-label fw-semibold">
                                        <i class="fas fa-male text-muted me-1"></i>Father Name
                                    </label>
                                    <input type="text" class="form-control @error('father_name') is-invalid @enderror" id="father_name" name="father_name" value="{{ old('father_name', $customer->father_name ?? '') }}" placeholder="Enter father's name">
                                    @error('father_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Father Occupation -->
                                <div class="col-md-6">
                                    <label for="father_occupation" class="form-label fw-semibold">
                                        <i class="fas fa-briefcase text-muted me-1"></i>Father Occupation
                                    </label>
                                    <input type="text" class="form-control @error('father_occupation') is-invalid @enderror" id="father_occupation" name="father_occupation" value="{{ old('father_occupation', $customer->father_occupation ?? '') }}" placeholder="e.g., Business">
                                    @error('father_occupation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Mother Name -->
                                <div class="col-md-6">
                                    <label for="mother_name" class="form-label fw-semibold">
                                        <i class="fas fa-female text-muted me-1"></i>Mother Name
                                    </label>
                                    <input type="text" class="form-control @error('mother_name') is-invalid @enderror" id="mother_name" name="mother_name" value="{{ old('mother_name', $customer->mother_name ?? '') }}" placeholder="Enter mother's name">
                                    @error('mother_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Mother Occupation -->
                                <div class="col-md-6">
                                    <label for="mother_occupation" class="form-label fw-semibold">
                                        <i class="fas fa-briefcase text-muted me-1"></i>Mother Occupation
                                    </label>
                                    <input type="text" class="form-control @error('mother_occupation') is-invalid @enderror" id="mother_occupation" name="mother_occupation" value="{{ old('mother_occupation', $customer->mother_occupation ?? '') }}" placeholder="e.g., Homemaker">
                                    @error('mother_occupation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Brother Name -->
                                <div class="col-md-6">
                                    <label for="brother_name" class="form-label fw-semibold">
                                        <i class="fas fa-male text-muted me-1"></i>Brother Name
                                    </label>
                                    <input type="text" class="form-control @error('brother_name') is-invalid @enderror" id="brother_name" name="brother_name" value="{{ old('brother_name', $customer->brother_name ?? '') }}" placeholder="Enter brother's name">
                                    @error('brother_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Brother Occupation -->
                                <div class="col-md-6">
                                    <label for="brother_occupation" class="form-label fw-semibold">
                                        <i class="fas fa-briefcase text-muted me-1"></i>Brother Occupation
                                    </label>
                                    <input type="text" class="form-control @error('brother_occupation') is-invalid @enderror" id="brother_occupation" name="brother_occupation" value="{{ old('brother_occupation', $customer->brother_occupation ?? '') }}" placeholder="e.g., Engineer">
                                    @error('brother_occupation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Brother Status -->
                                <div class="col-md-6">
                                    <label for="brother_status" class="form-label fw-semibold">
                                        <i class="fas fa-heart text-muted me-1"></i>Brother Status
                                    </label>
                                    <select class="form-select @error('brother_status') is-invalid @enderror" id="brother_status" name="brother_status">
                                        <option value="">Select Status</option>
                                        <option value="married" {{ old('brother_status', $customer->brother_status ?? '') === 'married' ? 'selected' : '' }}>Married</option>
                                        <option value="unmarried" {{ old('brother_status', $customer->brother_status ?? '') === 'unmarried' ? 'selected' : '' }}>Unmarried</option>
                                    </select>
                                    @error('brother_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Sister Name -->
                                <div class="col-md-6">
                                    <label for="sister_name" class="form-label fw-semibold">
                                        <i class="fas fa-female text-muted me-1"></i>Sister Name
                                    </label>
                                    <input type="text" class="form-control @error('sister_name') is-invalid @enderror" id="sister_name" name="sister_name" value="{{ old('sister_name', $customer->sister_name ?? '') }}" placeholder="Enter sister's name">
                                    @error('sister_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Sister Occupation -->
                                <div class="col-md-6">
                                    <label for="sister_occupation" class="form-label fw-semibold">
                                        <i class="fas fa-briefcase text-muted me-1"></i>Sister Occupation
                                    </label>
                                    <input type="text" class="form-control @error('sister_occupation') is-invalid @enderror" id="sister_occupation" name="sister_occupation" value="{{ old('sister_occupation', $customer->sister_occupation ?? '') }}" placeholder="e.g., Doctor">
                                    @error('sister_occupation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Sister Status -->
                                <div class="col-md-6">
                                    <label for="sister_status" class="form-label fw-semibold">
                                        <i class="fas fa-heart text-muted me-1"></i>Sister Status
                                    </label>
                                    <select class="form-select @error('sister_status') is-invalid @enderror" id="sister_status" name="sister_status">
                                        <option value="">Select Status</option>
                                        <option value="married" {{ old('sister_status', $customer->sister_status ?? '') === 'married' ? 'selected' : '' }}>Married</option>
                                        <option value="unmarried" {{ old('sister_status', $customer->sister_status ?? '') === 'unmarried' ? 'selected' : '' }}>Unmarried</option>
                                    </select>
                                    @error('sister_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Partner Preference Section -->
                        <div class="mb-4">
                            <h6 class="fw-semibold mb-3">
                                <i class="fas fa-search text-muted me-2"></i>Partner Preference
                            </h6>
                            <div class="row g-3">
                                <!-- Partner Preference -->
                                <div class="col-12">
                                    <label for="partner_preference" class="form-label fw-semibold">
                                        <i class="fas fa-comments text-muted me-1"></i>Partner Preference
                                    </label>
                                    <textarea class="form-control @error('partner_preference') is-invalid @enderror" id="partner_preference" name="partner_preference" rows="4" placeholder="Describe your partner preferences...">{{ old('partner_preference', $customer->partner_preference ?? '') }}</textarea>
                                    @error('partner_preference')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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
function previewImage(input) {
    const file = input.files[0];
    const reader = new FileReader();
    const uploadStatus = document.getElementById('upload-status');

    if (file) {
        // Validate file type
        if (!file.type.startsWith('image/')) {
            uploadStatus.innerHTML = '<div class="alert alert-danger">Please select a valid image file.</div>';
            return;
        }

        // Validate file size (2MB limit)
        if (file.size > 2 * 1024 * 1024) {
            uploadStatus.innerHTML = '<div class="alert alert-danger">Image size should be less than 2MB.</div>';
            return;
        }

        reader.onload = function(e) {
            const img = document.querySelector('.profile-preview');
            if (img) {
                img.src = e.target.result;
            } else {
                const initialsDiv = document.getElementById('initials-div');
                if (initialsDiv) {
                    initialsDiv.innerHTML = `<img src="${e.target.result}" alt="Profile preview" class="profile-preview" style="width: 100%; height: 100%; object-fit: cover;">`;
                }
            }
            uploadStatus.innerHTML = '<div class="alert alert-success">Image selected successfully!</div>';
        };
        reader.readAsDataURL(file);
    } else {
        // If file input is cleared, revert to default initials or current image
        const img = document.querySelector('.profile-preview');
        if (img) {
            img.src = "{{ asset('storage/' . $customer->profile_image) }}";
        } else {
            const initialsDiv = document.getElementById('initials-div');
            if (initialsDiv) {
                initialsDiv.innerHTML = "{{ strtoupper(mb_substr($customer->fname,0,1) . mb_substr($customer->lname,0,1)) }}";
            }
        }
        uploadStatus.innerHTML = '';
    }
}

// Add form submission debugging
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const fileInput = document.getElementById('profile_image');
        if (fileInput.files.length > 0) {
            console.log('File selected:', fileInput.files[0].name);
            console.log('File size:', fileInput.files[0].size);
            console.log('File type:', fileInput.files[0].type);
        }
    });
});
</script>
@endsection

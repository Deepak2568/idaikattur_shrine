@extends('layouts.app',['title'=>'Matrimony'])
@section('content')

<!-- Hero Section -->
<div class="bg-primary text-center py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; position: relative;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8 mx-auto">
        <h1 class="display-4 fw-bold mb-4">Sacred Heart Matrimony</h1>
        <p class="lead mb-4">Find your soulmate in faith. Join our Christian matrimony service to discover meaningful relationships built on shared values and beliefs.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
          <button type="button" class="btn btn-light btn-lg px-4 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="fas fa-sign-in-alt me-2"></i>Login
          </button>
          <button type="button" class="btn btn-outline-light btn-lg px-4 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#registerModal">
            <i class="fas fa-user-plus me-2"></i>Register Now
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

@php
    use App\Models\Customer;
    $featuredProfiles = Customer::where('is_admin', '!=', 'yes')
        ->orderByDesc('created_at')
        ->take(5)
        ->get();
@endphp

@if($featuredProfiles->count())
<section class="py-5 bg-light border-bottom">
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col-lg-8 mx-auto">
                <h2 class="fw-bold text-primary mb-2">Recent Profiles</h2>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($featuredProfiles as $profile)
                @php
                    $initials = strtoupper(mb_substr($profile->fname,0,1) . mb_substr($profile->lname,0,1));
                    $profile_image = $profile->profile_image ?? '';
                    $age = $profile->dob ? \Carbon\Carbon::parse($profile->dob)->age : null;
                    $location = trim(implode(', ', array_filter([ucfirst($profile->city), $profile->state ? 'Tamilnadu' : ''])));
                    $bio = $profile->subcaste ? (ucfirst($profile->subcaste).' • '.ucfirst($profile->religion)) : ucfirst($profile->religion);
                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <div class="mx-auto mb-3" style="width:90px; height:90px;">
                                @if($profile_image)
                                    <img src="{{ asset('storage/app/public/' . $profile_image) }}" alt="Profile photo" class="rounded-circle shadow" style="width:100%; height:100%;">
                                @else
                                    <div class="avatar-initials rounded-circle d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary fw-bold" style="width:100%; height:100%; font-size:2.2rem;">
                                        {{ $initials }}
                                    </div>
                                @endif
                            </div>
                            <h5 class="fw-semibold mb-1">{{ $profile->fname }} {{ $profile->lname }}</h5>
                            <div class="text-muted small mb-1">
                                @if($age) {{ $age }} yrs • @endif {{ $location }}
                            </div>
                            <div class="text-secondary small mb-2">{{ $bio }}</div>
                            <span class="badge bg-success bg-opacity-75">{{ ucfirst($profile->gender) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Features Section -->
<section class="py-5">
  <div class="container">
    <div class="row text-center mb-5">
      <div class="col-lg-8 mx-auto">
        <h2 class="display-5 fw-bold text-danger mb-3">Why Choose Sacred Heart Matrimony?</h2>
        <p class="lead text-muted">We help Christian families find their perfect match through our trusted matrimony platform.</p>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 text-center">
          <div class="card-body p-4">
            <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
              <i class="fas fa-shield-alt fa-2x text-danger"></i>
            </div>
            <h5 class="card-title fw-bold">Safe & Secure</h5>
            <p class="card-text text-muted">Your privacy and security are our top priorities. All profiles are verified and protected.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 text-center">
          <div class="card-body p-4">
            <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
              <i class="fas fa-cross fa-2x text-danger"></i>
            </div>
            <h5 class="card-title fw-bold">Faith-Based</h5>
            <p class="card-text text-muted">Connect with individuals who share your Christian values and beliefs.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 text-center">
          <div class="card-body p-4">
            <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
              <i class="fas fa-users fa-2x text-danger"></i>
            </div>
            <h5 class="card-title fw-bold">Large Community</h5>
            <p class="card-text text-muted">Join thousands of Christian families looking for meaningful relationships.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 text-center">
          <div class="card-body p-4">
            <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
              <i class="fas fa-heart fa-2x text-danger"></i>
            </div>
            <h5 class="card-title fw-bold">Success Stories</h5>
            <p class="card-text text-muted">Many happy couples have found their life partners through our platform.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- How It Works Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row text-center mb-5">
      <div class="col-lg-8 mx-auto">
        <h2 class="display-5 fw-bold text-danger mb-3">How It Works</h2>
        <p class="lead text-muted">Simple steps to find your perfect match</p>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-4">
        <div class="text-center">
          <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
            <span class="fw-bold fs-4">1</span>
          </div>
          <h5 class="fw-bold">Create Profile</h5>
          <p class="text-muted">Sign up and create your detailed profile with photos and preferences.</p>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="text-center">
          <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
            <span class="fw-bold fs-4">2</span>
          </div>
          <h5 class="fw-bold">Search & Connect</h5>
          <p class="text-muted">Browse profiles and connect with potential matches who share your values.</p>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="text-center">
          <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
            <span class="fw-bold fs-4">3</span>
          </div>
          <h5 class="fw-bold">Meet & Marry</h5>
          <p class="text-muted">Get to know each other and take the next step towards marriage.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Success Stories Section -->
<section class="py-5">
  <div class="container">
    <div class="row text-center mb-5">
      <div class="col-lg-8 mx-auto">
        <h2 class="display-5 fw-bold text-danger mb-3">Success Stories</h2>
        <p class="lead text-muted">Real stories from couples who found love through Sacred Heart Matrimony</p>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body p-4">
            <div class="d-flex align-items-center mb-3">
              <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                <i class="fas fa-quote-left fa-lg text-danger"></i>
              </div>
              <div>
                <h6 class="fw-bold mb-1">John & Mary</h6>
                <small class="text-muted">Married in 2023</small>
              </div>
            </div>
            <p class="card-text">"We found each other through Sacred Heart Matrimony and it was truly a blessing. Our shared faith brought us together and we couldn't be happier."</p>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body p-4">
            <div class="d-flex align-items-center mb-3">
              <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                <i class="fas fa-quote-left fa-lg text-danger"></i>
              </div>
              <div>
                <h6 class="fw-bold mb-1">David & Sarah</h6>
                <small class="text-muted">Married in 2022</small>
              </div>
            </div>
            <p class="card-text">"The platform helped us connect on a deeper level. We're grateful for Sacred Heart Matrimony for bringing us together in faith and love."</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action Section -->
<section class="py-5 bg-danger text-white">
  <div class="container">
    <div class="row text-center">
      <div class="col-lg-8 mx-auto">
        <h2 class="display-5 fw-bold mb-4">Ready to Find Your Soulmate?</h2>
        <p class="lead mb-4">Join thousands of Christian families who have found their perfect match through Sacred Heart Matrimony.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
          <button type="button" class="btn btn-light btn-lg px-4 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#registerModal">
            <i class="fas fa-user-plus me-2"></i>Create Free Profile
          </button>
          <a href="#" class="btn btn-outline-light btn-lg px-4 py-2 fw-bold">
            <i class="fas fa-search me-2"></i>Browse Profiles
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">
        <h3 class="fw-bold text-danger mb-4">Need Help?</h3>
        <p class="text-muted mb-4">Our support team is here to help you with any questions about our matrimony service.</p>
        <div class="d-flex justify-content-center gap-4 flex-wrap">
          <div class="text-center">
            <i class="fas fa-phone fa-2x text-danger mb-2"></i>
            <p class="mb-1 fw-bold">Call Us</p>
            <small class="text-muted">+91 91596 96893</small>
          </div>
          <div class="text-center">
            <i class="fas fa-envelope fa-2x text-danger mb-2"></i>
            <p class="mb-1 fw-bold">Email Us</p>
            <small class="text-muted">matrimony@sacredheart.com</small>
          </div>
          <div class="text-center">
            <i class="fas fa-clock fa-2x text-danger mb-2"></i>
            <p class="mb-1 fw-bold">Support Hours</p>
            <small class="text-muted">Mon-Sat: 9 AM - 6 PM</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  </section>

  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title fw-bold text-danger" id="loginModalLabel">
            <i class="fas fa-sign-in-alt me-2"></i>Login to Sacred Heart Matrimony
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="loginForm">
            @csrf
            <span class="text-danger error-text invalid_cred_error"></span>
            <div class="mb-3">
              <label for="loginEmail" class="form-label fw-bold">Email Address</label>
              <input type="email" class="form-control" name="username" id="loginEmail" placeholder="Enter your email">
              <span class="text-danger error-text username_error"></span>
            </div>
            <div class="mb-3">
              <label for="loginPassword" class="form-label fw-bold">Password</label>
              <input type="password" class="form-control" name="password" id="loginPassword" placeholder="Enter your password">
              <span class="text-danger error-text password_error"></span>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" name="rememberMe" class="form-check-input" id="rememberMe">
              <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <div class="d-grid">
              <button type="submit" id="loginBtn" class="btn btn-danger btn-lg fw-bold">
                <i class="fas fa-sign-in-alt me-2"></i>Login
              </button>
            </div>
            <p id="loginError" style="color:red;display:none;"></p>
          </form>
          <hr class="my-4">
          <div class="text-center">
            <p class="mb-2">Don't have an account?</p>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">
              <i class="fas fa-user-plus me-2"></i>Create New Account
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Register Modal -->
  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title fw-bold text-danger" id="registerModalLabel">
            <i class="fas fa-user-plus me-2"></i>Create Your Matrimony Profile
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="registerForm">
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <label for="firstName" class="form-label fw-bold">First Name *</label>
                <input type="text" name="fname" class="form-control" id="firstName" placeholder="Enter first name">
                <span class="text-danger error-text fname_error"></span>
              </div>
              <div class="col-md-6">
                <label for="lastName" class="form-label fw-bold">Last Name *</label>
                <input type="text" name="lname" class="form-control" id="lastName" placeholder="Enter last name">
                <span class="text-danger error-text lname_error"></span>
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label fw-bold">Email Address *</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email address">
                <span class="text-danger error-text email_error"></span>
              </div>
              <div class="col-md-6">
                <label for="phone" class="form-label fw-bold">Phone Number *</label>
                <input type="tel" name="phone" class="form-control" id="phone" placeholder="Enter phone number">
                <span class="text-danger error-text phone_error"></span>
              </div>
              <div class="col-md-6">
                <label for="dateOfBirth" class="form-label fw-bold">Date of Birth *</label>
                <input type="date" name="dob" class="form-control" id="dateOfBirth">
                <span class="text-danger error-text dob_error"></span>
              </div>
              <div class="col-md-6">
                <label for="gender" class="form-label fw-bold">Gender *</label>
                <select class="form-select" name="gender" id="gender">
                  <option value="">Select gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
                <span class="text-danger error-text gender_error"></span>
              </div>
              <div class="col-md-6">
                <label for="religion" class="form-label fw-bold">Religion *</label>
                <select class="form-select" name="religion" id="religion">
                  <option value="">Select religion</option>
                  <option value="Christian">Christian</option>
                </select>
                <span class="text-danger error-text religion_error"></span>
              </div>
              <div class="col-md-6">
                <label for="subcaste" class="form-label fw-bold">Subcaste *</label>
                <select class="form-select" name="subcaste" id="subcaste">
                  <option value="">Select subcaste</option>
                  <option value="vellalar">Vellalar</option>
                  <option value="udayar">Udayar</option>
                  <option value="nadar">Nadar</option>
                  <option value="pillai">Pillai</option>
                  <option value="mukkulathor">Mukkulathor (Thevar, Maravar, Agamudayar)</option>
                  <option value="paravar">Paravar</option>
                  <option value="chettiar">Chettiar</option>
                  <option value="vanniyar">Vanniyar</option>
                  <option value="adhidravidar">Adhidravidar</option>
                  <option value="other">Other</option>
                </select>
                <span class="text-danger error-text subcaste_error"></span>
              </div>
              <div class="col-md-6">
                <label for="state" class="form-label fw-bold">State *</label>
                <select class="form-select" name="state" id="state">
                  <option value="">Select State</option>
                  <option value="Tamil Nadu" selected>Tamil Nadu</option>
                </select>
                <span class="text-danger error-text state_error"></span>
              </div>

              <div class="col-md-6">
                <label for="city" class="form-label fw-bold">City/District *</label>
                <select class="form-select" name="city" id="city">
                  <option value="">Select City/District</option>
                </select>
                <span class="text-danger error-text city_error"></span>
              </div>
              <div class="col-md-6">
                <label for="profile_image" class="form-label fw-bold">Profile Image</label>
                <input type="file" class="form-control" name="profile_image" id="profile_image" accept="image/*">
                <span class="text-danger error-text profile_image_error"></span>
              </div>
              <div class="col-12">
                <label for="password" class="form-label fw-bold">Password *</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Create a strong password">
                <span class="text-danger error-text password_error"></span>
              </div>
              <div class="col-12">
                <label for="confirmPassword" class="form-label fw-bold">Confirm Password *</label>
                <input type="password" name="password_confirmation" class="form-control" id="confirmPassword" placeholder="Confirm your password">
                <span class="text-danger error-text password_error"></span>
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="termsAccepted" id="termsAccepted">
                  <label class="form-check-label" for="termsAccepted">
                    I agree to the <a href="{{ route('terms') }}" target="_blank" class="text-success">Terms & Conditions</a> and <a href="{{ route('privacy') }}" target="_blank" class="text-success">Privacy Policy</a>
                  </label><br/>
                  <span class="text-danger error-text termsAccepted_error"></span>
                </div>
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button type="submit" id="registerBtn" class="btn btn-danger btn-lg fw-bold">
                    <i class="fas fa-user-plus me-2"></i>Create Account
                  </button>
                </div>
              </div>
            </div>
            <div id="responseMsg"></div>
          </form>

          <hr class="my-4">
          <div class="text-center">
            <p class="mb-2">Already have an account?</p>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">
              <i class="fas fa-sign-in-alt me-2"></i>Login Here
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  @section('scripts')
  <script src="{{ asset('shrine.js') }}"></script>
  <script>
    var registerUrl = "{{ route('register') }}";
    var loginUrl = "{{ route('login.check') }}";

    // Update login form to use the correct route
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Clear previous errors
        document.querySelectorAll('.error-text').forEach(span => span.textContent = '');
        document.getElementById('loginError').style.display = 'none';

        const formData = new FormData(this);

        fetch(loginUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                window.location.href = data.redirect;
            } else {
                // Handle field-specific errors
                if (data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        const errorSpan = document.querySelector('.' + field + '_error');
                        if (errorSpan) {
                            errorSpan.textContent = data.errors[field][0];
                        }
                    });
                } else {
                    document.getElementById('loginError').textContent = data.message || 'Login failed';
                    document.getElementById('loginError').style.display = 'block';
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('loginError').textContent = 'An error occurred during login';
            document.getElementById('loginError').style.display = 'block';
        });
    });
  </script>
  @endsection

  @endsection

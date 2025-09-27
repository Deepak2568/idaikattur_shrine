@extends('layouts.app', ['title' => 'Terms & Conditions'])

@section('content')
<!-- Hero Section -->
<div class="bg-primary text-center py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; position: relative;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8 mx-auto">
        <h1 class="display-4 fw-bold mb-4">Terms & Conditions</h1>
        <p class="lead mb-4">Please read these terms carefully before using our services</p>
        <div class="d-flex justify-content-center">
          <i class="fas fa-file-contract fa-3x text-white-50"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Terms Content Section -->
<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <!-- Main Terms Card -->
        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
          <div class="card-header bg-danger text-white text-center py-4" style="border-radius: 20px 20px 0 0; border: none;">
            <h3 class="mb-0 fw-bold">
              <i class="fas fa-file-contract me-3"></i>Terms & Conditions
            </h3>
            <p class="mb-0 mt-2 opacity-75">Last updated: {{ date('F d, Y') }}</p>
          </div>
          
          <div class="card-body p-5">
            <!-- Acceptance of Terms -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-check-circle text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">Acceptance of Terms</h4>
              </div>
              <p class="lead text-muted">
                By registering with Sacred Heart Matrimony, you agree to abide by these Terms & Conditions. Please read them carefully before using our services.
              </p>
            </div>

            <!-- Eligibility -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-user-check text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">Eligibility</h4>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="card border-0 bg-light h-100">
                    <div class="card-body">
                      <h6 class="fw-bold text-danger"><i class="fas fa-birthday-cake me-2"></i>Age Requirement</h6>
                      <p class="mb-0">You must be at least 18 years old to register and use this website.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card border-0 bg-light h-100">
                    <div class="card-body">
                      <h6 class="fw-bold text-danger"><i class="fas fa-shield-alt me-2"></i>Information Accuracy</h6>
                      <p class="mb-0">All information provided must be accurate and truthful.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- User Responsibilities -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-users text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">User Responsibilities</h4>
              </div>
              <div class="row g-3">
                <div class="col-md-4">
                  <div class="text-center p-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                      <i class="fas fa-key fa-2x text-danger"></i>
                    </div>
                    <h6 class="fw-bold">Maintain Confidentiality</h6>
                    <p class="small text-muted">Keep your login credentials secure and private.</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="text-center p-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                      <i class="fas fa-handshake fa-2x text-danger"></i>
                    </div>
                    <h6 class="fw-bold">Respect Others</h6>
                    <p class="small text-muted">Respect the privacy and dignity of other members.</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="text-center p-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                      <i class="fas fa-ban fa-2x text-danger"></i>
                    </div>
                    <h6 class="fw-bold">No Misleading Info</h6>
                    <p class="small text-muted">Do not share offensive, false, or misleading information.</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Account Termination -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-exclamation-triangle text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">Account Termination</h4>
              </div>
              <div class="alert alert-warning border-0" style="border-radius: 15px;">
                <div class="d-flex">
                  <i class="fas fa-exclamation-circle fa-2x text-warning me-3"></i>
                  <div>
                    <h6 class="fw-bold">Important Notice</h6>
                    <p class="mb-0">Sacred Heart Matrimony reserves the right to suspend or terminate accounts that violate these terms or engage in inappropriate conduct.</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Limitation of Liability -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-balance-scale text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">Limitation of Liability</h4>
              </div>
              <div class="card border-0 bg-light">
                <div class="card-body">
                  <p class="mb-0">
                    We are not responsible for any direct or indirect damages arising from the use of our services. Members are solely responsible for their interactions and should exercise caution when communicating with other users.
                  </p>
                </div>
              </div>
            </div>

            <!-- Modification of Terms -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-edit text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">Modification of Terms</h4>
              </div>
              <div class="card border-0 bg-light">
                <div class="card-body">
                  <p class="mb-0">
                    We may update these Terms & Conditions at any time. Continued use of the website constitutes acceptance of the revised terms. We will notify users of significant changes via email or website notification.
                  </p>
                </div>
              </div>
            </div>

            <!-- Privacy Policy Link -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-user-shield text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">Privacy Policy</h4>
              </div>
              <div class="card border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <div class="card-body text-center">
                  <h6 class="fw-bold mb-2">Your Privacy Matters</h6>
                  <p class="mb-3">Your privacy is important to us. Please review our Privacy Policy to understand how we collect, use, and protect your information.</p>
                  <a href="{{ route('privacy') }}" target="_blank" class="btn btn-light btn-sm fw-bold">
                    <i class="fas fa-external-link-alt me-2"></i>Read Privacy Policy
                  </a>
                </div>
              </div>
            </div>

            <!-- Contact Information -->
            <div class="mb-0">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-phone text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">Contact Information</h4>
              </div>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="card border-0 bg-light h-100">
                    <div class="card-body text-center">
                      <i class="fas fa-envelope fa-2x text-danger mb-3"></i>
                      <h6 class="fw-bold">Email Support</h6>
                      <a href="mailto:support@sacredheartmatrimony.com" class="text-decoration-none">
                        support@sacredheartmatrimony.com
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card border-0 bg-light h-100">
                    <div class="card-body text-center">
                      <i class="fas fa-phone fa-2x text-danger mb-3"></i>
                      <h6 class="fw-bold">Phone Support</h6>
                      <a href="tel:+919159696893" class="text-decoration-none">
                        +91 91596 96893
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">
        <h3 class="fw-bold text-danger mb-3">Ready to Find Your Soulmate?</h3>
        <p class="lead text-muted mb-4">Join thousands of Christian families who have found their perfect match through Sacred Heart Matrimony.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
          <a href="{{ route('matrimony') }}" class="btn btn-danger btn-lg px-4 py-2 fw-bold">
            <i class="fas fa-heart me-2"></i>Join Now
          </a>
          <a href="{{ route('privacy') }}" target="_blank" class="btn btn-outline-danger btn-lg px-4 py-2 fw-bold">
            <i class="fas fa-shield-alt me-2"></i>Privacy Policy
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.bg-danger.bg-opacity-10 {
    background-color: rgba(220, 53, 69, 0.1) !important;
}

.rounded-circle {
    transition: transform 0.3s ease;
}

.rounded-circle:hover {
    transform: scale(1.1);
}

@media (max-width: 768px) {
    .display-4 {
        font-size: 2.5rem;
    }
    
    .card-body {
        padding: 2rem !important;
    }
    
    .d-flex.align-items-center {
        flex-direction: column;
        text-align: center;
    }
    
    .d-flex.align-items-center .me-3 {
        margin-right: 0 !important;
        margin-bottom: 1rem;
    }
}
</style>
@endsection

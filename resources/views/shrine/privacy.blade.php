@extends('layouts.app', ['title' => 'Privacy Policy'])

@section('content')
<!-- Hero Section -->
<div class="bg-primary text-center py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; position: relative;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8 mx-auto">
        <h1 class="display-4 fw-bold mb-4">Privacy Policy</h1>
        <p class="lead mb-4">How we collect, use, and protect your personal information</p>
        <div class="d-flex justify-content-center">
          <i class="fas fa-user-shield fa-3x text-white-50"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Privacy Content Section -->
<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <!-- Main Privacy Card -->
        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
          <div class="card-header bg-danger text-white text-center py-4" style="border-radius: 20px 20px 0 0; border: none;">
            <h3 class="mb-0 fw-bold">
              <i class="fas fa-user-shield me-3"></i>Privacy Policy
            </h3>
            <p class="mb-0 mt-2 opacity-75">Last updated: {{ date('F d, Y') }}</p>
          </div>
          
          <div class="card-body p-5">
            <!-- Introduction -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-shield-alt text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">Your Privacy Matters</h4>
              </div>
              <div class="card border-0 bg-light">
                <div class="card-body">
                  <p class="lead text-muted mb-0">
                    At Sacred Heart Matrimony, we value your privacy and are committed to protecting your personal information. This Privacy Policy explains how we collect, use, and safeguard your data when you use our services.
                  </p>
                </div>
              </div>
            </div>

            <!-- Information We Collect -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-database text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">Information We Collect</h4>
              </div>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="card border-0 bg-light h-100">
                    <div class="card-body">
                      <h6 class="fw-bold text-danger"><i class="fas fa-user me-2"></i>Personal Details</h6>
                      <p class="mb-0">Name, email, phone number, date of birth, gender, religion, subcaste, state, and city.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card border-0 bg-light h-100">
                    <div class="card-body">
                      <h6 class="fw-bold text-danger"><i class="fas fa-id-card me-2"></i>Profile Information</h6>
                      <p class="mb-0">Physical details, education, occupation, family background, and profile images.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card border-0 bg-light h-100">
                    <div class="card-body">
                      <h6 class="fw-bold text-danger"><i class="fas fa-comments me-2"></i>Interaction Data</h6>
                      <p class="mb-0">Information you provide while creating your profile and interacting with other users.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card border-0 bg-light h-100">
                    <div class="card-body">
                      <h6 class="fw-bold text-danger"><i class="fas fa-image me-2"></i>Media Content</h6>
                      <p class="mb-0">Profile images and other media you upload to your profile.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- How We Use Your Information -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-cogs text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">How We Use Your Information</h4>
              </div>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="text-center p-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                      <i class="fas fa-user-plus fa-2x text-danger"></i>
                    </div>
                    <h6 class="fw-bold">Profile Management</h6>
                    <p class="small text-muted">To create and manage your matrimony profile effectively.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="text-center p-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                      <i class="fas fa-comments fa-2x text-danger"></i>
                    </div>
                    <h6 class="fw-bold">Communication</h6>
                    <p class="small text-muted">To facilitate communication between members.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="text-center p-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                      <i class="fas fa-chart-line fa-2x text-danger"></i>
                    </div>
                    <h6 class="fw-bold">Service Improvement</h6>
                    <p class="small text-muted">To improve our services and provide customer support.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="text-center p-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                      <i class="fas fa-bell fa-2x text-danger"></i>
                    </div>
                    <h6 class="fw-bold">Notifications</h6>
                    <p class="small text-muted">To send you important updates and notifications.</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Data Security -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-lock text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">Data Security</h4>
              </div>
              <div class="alert alert-success border-0" style="border-radius: 15px;">
                <div class="d-flex">
                  <i class="fas fa-shield-check fa-2x text-success me-3"></i>
                  <div>
                    <h6 class="fw-bold">Industry-Standard Protection</h6>
                    <p class="mb-0">We implement industry-standard security measures to protect your data from unauthorized access, alteration, or disclosure. Your personal information is encrypted and stored securely.</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Sharing of Information -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-share-alt text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">Sharing of Information</h4>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="card border-0 bg-light h-100">
                    <div class="card-body text-center">
                      <i class="fas fa-times-circle fa-2x text-danger mb-3"></i>
                      <h6 class="fw-bold">We Don't Sell Data</h6>
                      <p class="mb-0">We do not sell or rent your personal information to third parties.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card border-0 bg-light h-100">
                    <div class="card-body text-center">
                      <i class="fas fa-users fa-2x text-danger mb-3"></i>
                      <h6 class="fw-bold">Member Sharing</h6>
                      <p class="mb-0">Profile information is shared with other members as part of our matrimony service.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Your Rights -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-user-edit text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">Your Rights</h4>
              </div>
              <div class="row g-3">
                <div class="col-md-4">
                  <div class="card border-0 bg-light h-100">
                    <div class="card-body text-center">
                      <i class="fas fa-eye fa-2x text-danger mb-3"></i>
                      <h6 class="fw-bold">Access & Update</h6>
                      <p class="small text-muted">You have the right to access, update, or delete your personal information.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card border-0 bg-light h-100">
                    <div class="card-body text-center">
                      <i class="fas fa-sliders-h fa-2x text-danger mb-3"></i>
                      <h6 class="fw-bold">Privacy Controls</h6>
                      <p class="small text-muted">You can control your privacy settings and choose what information to share.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card border-0 bg-light h-100">
                    <div class="card-body text-center">
                      <i class="fas fa-download fa-2x text-danger mb-3"></i>
                      <h6 class="fw-bold">Data Export</h6>
                      <p class="small text-muted">You can request a copy of your data or ask us to stop processing your information.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Terms & Conditions Link -->
            <div class="mb-5">
              <div class="d-flex align-items-center mb-3">
                <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                  <i class="fas fa-file-contract text-danger"></i>
                </div>
                <h4 class="mb-0 fw-bold text-danger">Terms & Conditions</h4>
              </div>
              <div class="card border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <div class="card-body text-center">
                  <h6 class="fw-bold mb-2">Complete Information</h6>
                  <p class="mb-3">This Privacy Policy is part of our overall Terms & Conditions. Please review our Terms & Conditions for complete information about using our services.</p>
                  <a href="{{ route('terms') }}" target="_blank" class="btn btn-light btn-sm fw-bold">
                    <i class="fas fa-external-link-alt me-2"></i>Read Terms & Conditions
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
                      <a href="tel:+919159698893" class="text-decoration-none">
                        +91 91596 98893
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
        <h3 class="fw-bold text-danger mb-3">Your Privacy is Our Priority</h3>
        <p class="lead text-muted mb-4">We are committed to protecting your personal information and ensuring a safe, secure environment for finding your soulmate.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
          <a href="{{ route('matrimony') }}" class="btn btn-danger btn-lg px-4 py-2 fw-bold">
            <i class="fas fa-heart me-2"></i>Join Now
          </a>
          <a href="{{ route('terms') }}" target="_blank" class="btn btn-outline-danger btn-lg px-4 py-2 fw-bold">
            <i class="fas fa-file-contract me-2"></i>Terms & Conditions
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

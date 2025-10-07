@extends('layouts.app',['title'=>'Gallery'])
@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endsession

            <!-- Admin Upload Form (Only visible to admin) -->
            @auth('customer')
                @if(Auth::guard('customer')->check())
                    <h2 class="text-center mb-5">Gallery</h2>
                    <div class="card shadow-sm border-0 mb-5">
                        <div class="card-header bg-gradient-primary text-white d-flex align-items-center">
                            <i class="fas fa-images me-2 text-primary"></i>
                            <h5 class="mb-0 fw-semibold text-primary">Upload Image to Gallery</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="folder_name" class="form-label fw-semibold">Folder Name</label>
                                        <input type="text" class="form-control @error('folder_name') is-invalid @enderror"
                                               id="folder_name" name="folder_name"
                                               value="{{ old('folder_name') }}"
                                               placeholder="e.g. Events, Festivals, etc." required>
                                        @error('folder_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="image" class="form-label fw-semibold">Select Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                id="image" name="image" accept="image/*" required>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        Supported: JPEG, PNG, JPG, GIF, WebP. Max size: 10MB
                                    </small>
                                </div>
                                <div class="mt-4 text-end">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-upload me-1"></i> Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            @endauth


            <!-- Gallery Display -->
            @if(count($folders) > 0)
                <!-- Navigation Tabs -->
                <ul class="nav nav-tabs" id="galleryTabs" role="tablist">
                    @foreach($folders as $index => $folder)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                    id="{{ Str::slug($folder) }}-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#{{ Str::slug($folder) }}"
                                    type="button"
                                    role="tab"
                                    aria-controls="{{ Str::slug($folder) }}"
                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                {{ $folder }}
                                <span class="badge bg-secondary ms-2">{{ count($galleryData[$folder]) }}</span>
                            </button>
                        </li>
                    @endforeach
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="galleryTabContent">
                    @foreach($folders as $index => $folder)
                        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                             id="{{ Str::slug($folder) }}"
                             role="tabpanel"
                             aria-labelledby="{{ Str::slug($folder) }}-tab">

                            <div class="row mt-4">
                                @forelse($galleryData[$folder] as $image)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                        <div class="card gallery-card">
                                            <div class="card-img-container position-relative">
                                                <img src="{{ asset('storage/app/public' . $image->image_path) }}"
                                                     class="card-img-top"
                                                     alt="{{ $image->original_name }}"
                                                     style="height: 200px; object-fit: cover; cursor: pointer;"
                                                     data-bs-toggle="modal"
                                                     data-bs-target="#imageModal"
                                                     data-image-src="{{ asset('storage/app/public' . $image->image_path) }}"
                                                     data-image-title="{{ $image->original_name }}">

                                                <!-- Admin Delete Button -->
                                                @auth('customer')
                                                    @if(Auth::guard('customer')->check())
                                                    <div class="position-absolute top-0 end-0 p-2">
                                                        <form action="{{ route('gallery.destroy', $image->id) }}"
                                                              method="POST"
                                                              class="d-inline"
                                                              onsubmit="return confirm('Are you sure you want to delete this image?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    @endif
                                                @endauth
                                            </div>
                                            <div class="card-body p-2">
                                                <small class="text-muted">
                                                    {{ $image->original_name }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="text-center py-5">
                                            <i class="fas fa-images fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">No images found in this folder.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <i class="fas fa-images fa-5x text-muted mb-4"></i>
                    <h4 class="text-muted">No Gallery Images Yet</h4>
                    <p class="text-muted">Images will appear here once they are uploaded.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Gallery Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Gallery Image">
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle image modal
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('imageModalLabel');

    imageModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const imageSrc = button.getAttribute('data-image-src');
        const imageTitle = button.getAttribute('data-image-title');

        modalImage.src = imageSrc;
        modalTitle.textContent = imageTitle;
    });
});
</script>
@endsection

@section('styles')
<style>
.gallery-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.gallery-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.card-img-container {
    overflow: hidden;
    border-radius: 0.375rem 0.375rem 0 0;
}

.card-img-container img {
    transition: transform 0.3s ease;
}

.gallery-card:hover .card-img-container img {
    transform: scale(1.05);
}

.nav-tabs .nav-link {
    border: none;
    border-bottom: 3px solid transparent;
    color: #6c757d;
    font-weight: 500;
}

.nav-tabs .nav-link.active {
    color: #0d6efd;
    border-bottom-color: #0d6efd;
    background-color: transparent;
}

.nav-tabs .nav-link:hover {
    border-bottom-color: #0d6efd;
    color: #0d6efd;
}

.badge {
    font-size: 0.7rem;
}
</style>
@endsection

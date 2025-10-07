@extends('layouts.app',['title' => 'Parish Priest'])

@section('content')
<section class="team mt-3" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
      <div class="container">

        @auth('customer')
            @if(auth('customer')->user()->is_admin === 'yes')
                <!-- Admin Form Section -->
                <div class="card mb-5">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            @if(isset($priest))
                                <i class="fas fa-edit"></i> Edit Priest
                            @else
                                <i class="fas fa-plus"></i> Add New Priest
                            @endif
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($priest) ? route('priest.update', $priest->id) : route('priest.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($priest))
                                @method('PUT')
                            @endif

        <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="father_name" class="form-label">Father Name</label>
                                    <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                                           id="father_name" name="father_name"
                                           value="{{ old('father_name', isset($priest) ? $priest->father_name : '') }}"
                                           placeholder="Enter Father's full name" required>
                                    @error('father_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="designation" class="form-label">Designation</label>
                                    <input type="text" class="form-control @error('designation') is-invalid @enderror"
                                           id="designation" name="designation"
                                           value="{{ old('designation', isset($priest) ? $priest->designation : '') }}"
                                           placeholder="Enter designation (e.g., Parish Priest, Assistant Priest)" required>
                                    @error('designation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
            </div>
          </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="from_year" class="form-label">From Year</label>
                                    <input type="number" class="form-control @error('from_year') is-invalid @enderror"
                                           id="from_year" name="from_year"
                                           value="{{ old('from_year', isset($priest) ? $priest->from_year : '') }}"
                                           min="1900" max="{{ date('Y') + 10 }}" required>
                                    @error('from_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="to_year" class="form-label">To Year (Leave empty if current)</label>
                                    <input type="number" class="form-control @error('to_year') is-invalid @enderror"
                                           id="to_year" name="to_year"
                                           value="{{ old('to_year', isset($priest) ? $priest->to_year : '') }}"
                                           min="1900" max="{{ date('Y') + 10 }}">
                                    @error('to_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
            </div>
          </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Priest Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" accept="image/*" {{ !isset($priest) ? 'required' : '' }}>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if(isset($priest) && $priest->image_path)
                                    <small class="text-muted">Current image: {{ $priest->original_name }}</small>
                                @endif
                </div>

                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Supported formats: JPEG, PNG, JPG, GIF, WebP. Max size: 4MB<br>
                                    Leave "To Year" empty for current priest
                                </small>
          </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    {{ isset($priest) ? 'Update Priest' : 'Add Priest' }}
                                </button>
                                @if(isset($priest))
                                    <a href="{{ route('priest.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                @endif
                </div>
                        </form>
          </div>
                </div>
            @endif
        @endauth

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Priests Display Section -->
        <div class="row">
            @forelse($priests as $priestItem)
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-4">
            <div class="member">
              <div class="member-img">
                            @if($priestItem->image_path)
                                <img src="{{ Storage::url('app/public/'. $priestItem->image_path) }}"
                                     class="img-fluid" alt="{{ $priestItem->father_name }}"
                                     style="height: 357px;width: 357px;">
                            @else
                                <img src="{{ asset('images/default-priest.jpg') }}"
                                     class="img-fluid" alt="{{ $priestItem->father_name }}"
                                     style="height: 357px;width: 357px;object-fit: cover;">
                            @endif
                <!-- <div class="social">
                  <a href=""><i class="fab fa-twitter"></i></a>
                  <a href=""><i class="fab fa-facebook"></i></a>
                  <a href=""><i class="fab fa-instagram"></i></a>
                  <a href=""><i class="fab fa-linkedin"></i></a>
                </div> -->
              </div>
              <div class="member-info">
                            <h4>{{ $priestItem->father_name }}</h4>
                            <span>{{ $priestItem->designation }}</span>
                            <p class="text-danger">{{ $priestItem->year_range }}</p>

                            @auth('customer')
                                @if(auth('customer')->user()->is_admin === 'yes')
                                    <div class="admin-actions mt-2">
                                        <a href="{{ route('priest.edit', $priestItem->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('priest.destroy', $priestItem->id) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this priest?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
              </div>
                                @endif
                            @endauth
            </div>
          </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-user-tie fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No priests found</h4>
                        <p class="text-muted">Priest information will be displayed here once added.</p>
              </div>
            </div>
            @endforelse
        </div>

      </div>
    </section><!-- End Team Section -->
@endsection

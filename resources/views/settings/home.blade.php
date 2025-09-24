@extends('layouts.app', ['title' => 'Home Page Settings'])

@section('content')
<div class="container py-4">
    <div class="d-flex gap-2 mb-4 justify-content-end">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary ripple">
            <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
        </a>
    </div>

    <div class="row justify-content-center">
        <!-- Form on the left -->
        <div class="col-md-5">
            <div class="card shadow-sm mb-4">
                @if(session('success'))
                    <div class="alert alert-success fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger fade show" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-header bg-white fw-bold">
                    <i class="fas fa-cog me-1"></i> Update Home Page Settings
                </div>
                <div class="card-body">
                    <form action="{{ $setting ? route('settings.home.update', $setting->id) : route('settings.home.save') }}" method="POST">
                        @csrf
                        @if($setting)
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="display_text" class="form-label fw-semibold">Display Text</label>
                            <input type="text" class="form-control" id="display_text" name="display_text"
                                value="{{ old('display_text', $setting->display_text ?? '') }}">
                            @error('display_text')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_date" class="form-label fw-semibold">Event Date</label>
                            <input type="date" class="form-control" id="event_date" name="event_date"
                                value="{{ old('event_date', $setting->event_date ?? '') }}">
                            @error('event_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-1"></i> {{ $setting ? 'Update' : 'Save' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Table on the right -->
        <div class="col-md-7">
            <div class="card shadow-sm mb-4">
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Display Text</th>
                                <th>Event Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($adminsettings as $setting)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $setting->display_text }}</td>
                                <td>{{ \Carbon\Carbon::parse($setting->event_date)->format('F j, Y') }}</td>
                                <td>
                                    <a href="{{ route('settings.home.edit', $setting->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('settings.home.delete', $setting->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this setting?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

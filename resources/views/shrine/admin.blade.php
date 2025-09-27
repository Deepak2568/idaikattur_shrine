@extends('layouts.app',["title"=>"Admin Dashboard"])
@section('content')
<div class="container py-4">
    <div class="d-flex gap-2 mb-4 justify-content-end">
        <a href="{{ route('settings.home') }}" class="btn btn-outline-secondary ripple">
            <i class="fas fa-cog me-1"></i> Home Page Settings
        </a>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary ripple float-end">
            <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
        </a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger ripple">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </button>
        </form>
    </div>
    @if(session('success'))
        <div class="alert alert-success fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('removed'))
        <div class="alert alert-danger fade show" role="alert">
            {{ session('removed') }}
        </div>
    @endif
    <table class="table table-striped table-hover table-bordered align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>S No</th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone number</th>
                <th>Gender</th>
                <th>Active status</th>
                <th>Member Since</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- {{$i = 1}} -->
            @foreach($data as $user)
                @if($user->is_admin != 'yes')
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>SHM{{ str_pad($user->id, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $user->fname.' '.$user->lname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->gender == 'female' ? 'Female' : 'Male' }}</td>
                        <td>
                            <span class="badge {{ $user->active_status == '1' ? 'bg-success' : 'bg-danger' }}">
                                {{ $user->active_status == '1' ? 'Paid' : 'Not paid' }}
                            </span>
                        </td>
                        <td>{{ $user->created_at->format('F j, Y') }}</td>

                        <!-- Activate -->
                        <td>
                            <form action="{{ url('update', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                @if($user->active_status == '0')
                                    <button class="btn btn-primary btn-sm" type="submit">
                                        <i class="fas fa-check"></i> Activate
                                    </button>
                                @else
                                    <span class="badge bg-success">Activated</span>
                                @endif
                            </form>
                        </td>

                        <!-- Deactivate -->
                        <td>
                            <form action="{{ url('deactivate', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                @if($user->active_status == '1')
                                    <button class="btn btn-warning btn-sm" type="submit">
                                        <i class="fas fa-times"></i> Deactivate
                                    </button>
                                @else
                                    <span class="badge bg-secondary">Deactivated</span>
                                @endif
                            </form>
                        </td>

                        <!-- Delete -->
                        <td>
                            <form action="{{ url('delete', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection

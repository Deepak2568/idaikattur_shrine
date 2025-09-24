@extends('layouts.app',["title"=>"Admin Dashboard"])
@section('content')
<div class="container py-4">
    <div class="d-flex gap-2 mb-4 justify-content-end">
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
    <table class='table table-bordered'>
        <thead>
            <th>S No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone number</th>
            <th>Gender</th>
            <th>Active status</th>
            <th>Member Since</th>
            <th colspan='2'>Action</th>
        </thead>
        <tbody>
            <!-- {{$i = 1}} -->
            @foreach($data as $user)
                @if($user->is_admin != 'yes')
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$user->fname.' '.$user->lname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->gender == 'female' ? 'Female' : 'Male'}}</td>
                    <td>{{$user->active_status == '1' ? 'Paid' : 'Not paid'}}</td>
                    <td>{{$user->created_at->format('F j, Y')}}</td>
                    <td>
                        <form action="{{url('update',$user->id)}}" method='POST'>
                            @csrf
                            @method('PUT')
                            @if($user->active_status == '0')
                                <button class='btn btn-primary' type='submit' id={{$user->id}}><i class='fas fa-check'></i> Activate</button>
                            @else
                                <span class="badge bg-success" readonly>Activated</span>
                            @endif
                        </form>
                    </td>
                    <td>
                        <form action="{{url('delete',$user->id)}}" method='POST'>
                            @csrf
                            @method('DELETE')
                            <button class='btn btn-danger' type='submit' id={{$user->id}}><i class='fas fa-trash'></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection

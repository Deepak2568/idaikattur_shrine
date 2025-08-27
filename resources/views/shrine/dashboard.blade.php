@extends('layouts.app',['title'=>'Dashoard'])
@section('content')
<div style="display:flex; justify-content:space-between; align-items:center;">
    <h2>Welcome, {{ $customer->fname }} {{ $customer->lname }}</h2>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

<div>
    <h3>Customer Profile</h3>
    <p>Email: {{ $customer->email }}</p>
    <p>Phone: {{ $customer->phone }}</p>
    <p>DOB: {{ $customer->dob }}</p>
    <p>Gender: {{ $customer->gender }}</p>
</div>
@endsection
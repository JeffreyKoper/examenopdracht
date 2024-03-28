@extends('layouts.default')
@section('content')
<div class="dashboard">
    <div class="dashboard_info">
        <ul class="account">
            <li>Name: {{$data->name}}</li>
            <li>Email: {{$data->email}}</li>
            <li class="role">Role: {{$data->role}}</li>
        </ul>
    </div>
    <div class="dashboard_buttons">
        <button class="edit">Edit Account Information</button>
        <button class="delete">Delete Account</button>
        @if($data->role == "admin")
        <button class="create">Create New Account</button>
        @endif
    </div>
</div>
@endsection

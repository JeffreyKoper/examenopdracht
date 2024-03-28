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
        <form method="post" action="{{route('user.delete')}}">
            @csrf
            <button type="submit" class="delete">Delete Account</button>
        </form>
        @if($data->role == "admin")
        <button class="create">Create New Account</button>
        @endif
    </div>
    <div class="dashboard_edit">
        <br>
        <form method="POST" action="{{route('user.update')}}" class="dashboard_edit_form">
            @csrf
            <label for="accountName">Name</label>
            <input type="text" name="accountName" id="accountName" value="{{$data->name}}">
            <label for="accountEmail">Email</label>
            <input type="email" name="accountEmail" id="accountEmail" value="{{$data->email}}">
            <button type="submit">Save</button>
        </form>
    </div>
</div>
<script src="js/dashboard_script.js"></script>
@endsection

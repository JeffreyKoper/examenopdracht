@extends('layouts.default')
@section('content')
    <div class="create-form">
        <h2>Create a New User</h2>
        <form action="{{route('user.create')}}" method="POST">
            @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="accountName" value="" placeholder="Example: John Doe" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="accountEmail" value="" placeholder="example: John.Doe@hotmail.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" id="password" name="accountPassword" value="" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="Role">Role:</label>
                    <select id="Role" name="accountRole" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Create user</button>
                </div>
        </form>
    </div>
@endsection
